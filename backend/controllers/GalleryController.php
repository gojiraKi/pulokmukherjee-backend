<?php

namespace backend\controllers;

use app\models\Gallery;
use app\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Gallery models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {  
                    $flag = false;
                    if($images = UploadedFile::getInstances($model,'imageFiles')) {
                        foreach($images as $image) {   
                            $modelPhoto = new Gallery();
                            
                            $name = $image->name;
                            $ext = (explode(".", $name));
                            $ext = end($ext);
                            $random = \Yii::$app->security->generateRandomString(12);

                            $modelLast = Gallery::find()->orderBy(['id' => SORT_DESC])->one();
                            $id = 0;
                            if ($modelLast === NULL ) {
                                $id = 1;
                            } else {
                                $id = $modelLast['id'] + 1;
                            }

                            $fileName = 'GLR-' . $id . '-' . $random;

                            $temp = explode("/", \Yii::getAlias('@webroot'));
                            $length = count($temp);

                            // get the webroot path
                            $path = "";
                            for ($i = 0; $i < $length - 1; $i++) {
                                $path = $path . $temp[$i] . '/';
                            }

                            // image folder subpath
                            $folderPath = 'uploads/images';
                            $pathDoc = $path . $folderPath;
                            
                            // image folder subpath
                            // $dbPath = 'uploads/images/' . date('Y') . '/' . date('m') . '/';
                            // $pathDoc = $path . $dbPath;
                            
                            // create the folder if it doesn't exist else return false if the folder already exist
                            FileHelper::createDirectory($pathDoc);
                            
                            // save the image in storage e.g. hard disk
                            $image->saveAs($pathDoc . '/' . $fileName . ".{$ext}");
                            
                            // save the path in db column 
                            $modelPhoto->photo = $folderPath . '/' . $fileName . ".{$ext}";
                            
                            // db path for images API
                            $imgPath = "https://" . $_SERVER['HTTP_HOST'] . \Yii::getAlias('@front') . '/' . $folderPath;
                            $modelPhoto->photo_frnt = $imgPath . '/' . $fileName . ".{$ext}";
                            
                            // save thumbnail
                            /* thumbnail */
                            $save_photo = $pathDoc . '/' . $fileName . ".{$ext}";
                            $save_path = $pathDoc . '/thumbnails/';

                            $thumbnail = Image::thumbnail($save_photo, $img_size = 150, $img_size = 150);
                            $size = $thumbnail->getSize();
                            if ($size->getWidth() < $img_size or $size->getHeight() < $img_size) {
                                $white = Image::getImagine()->create(new Box($img_size, $img_size));
                                $thumbnail = $white->paste($thumbnail, new Point($img_size / 2 - $size->getWidth() / 2, $img_size / 2 - $size->getHeight() / 2));
                            }

                            FileHelper::createDirectory($save_path);                                    

                            /* save in hdd */
                            $thumbnail->save($save_path . '/' .  $fileName . "_thm" . ".{$ext}", ['quality' => 90]);
                            /* save in db */
                            $modelPhoto->photo_thmb = $folderPath . ('/thumbnails/') . $fileName . "_thm" . ".{$ext}";
                            
                            $caption = trim($modelPhoto->caption);
                            if (!empty($caption)) {
                                $modelPhoto->alt_text = $caption . " photo " . $id;
                            } else {
                                $modelPhoto->alt_text = "Gallery photo " . $id;
                            }
                                                            
                            if (! ($flag = $modelPhoto->save(false))) {
                                $transaction->rollBack();
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        // return $this->redirect(['view', 'id' => $model->id]);
                        return $this->redirect(['index']);
                    }
                } catch (ErrorException $e) {
                    $transaction->rollBack();

                    $errors = $model->errors;
                    print_r($errors);
                    
                    exit();
                }

                // return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
