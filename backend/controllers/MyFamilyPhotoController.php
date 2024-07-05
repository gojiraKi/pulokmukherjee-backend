<?php

namespace backend\controllers;

use app\models\MyFamily;
use app\models\MyFamilyPhoto;
use app\models\MyFamilyPhotoSearch;
use app\models\LastUpdate;
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
 * MyFamilyPhotoController implements the CRUD actions for MyFamilyPhoto model.
 */
class MyFamilyPhotoController extends Controller
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
     * Lists all MyFamilyPhoto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MyFamilyPhotoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MyFamilyPhoto model.
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
     * Creates a new MyFamilyPhoto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MyFamilyPhoto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {  
                    $flag = false;
                    if($images = UploadedFile::getInstances($model,'imageFiles')) {
                        date_default_timezone_set('Asia/Kolkata');
                        foreach($images as $image) {   
                            $modelPhoto = new MyFamilyPhoto();
                            
                            $name = $image->name;
                            $ext = (explode(".", $name));
                            $ext = end($ext);
                            $random = \Yii::$app->security->generateRandomString(12);

                            $modelLast = MyFamilyPhoto::find()->orderBy(['id' => SORT_DESC])->one();
                            $id = 0;
                            if ($modelLast === NULL ) {
                                $id = 1;
                            } else {
                                $id = $modelLast['id'] + 1;
                            }

                            $fileName = 'MFP-' . $id . '-' . $random;

                            $temp = explode("/", \Yii::getAlias('@webroot'));
                            $length = count($temp);

                            // get the webroot path
                            $path = "";
                            for ($i = 0; $i < $length - 1; $i++) {
                                $path = $path . $temp[$i] . '/';
                            }

                            // image folder subpath
                            $folderPath = 'uploads/images/my-family';
                            $pathDoc = $path . $folderPath;
                            
                            // image folder subpath
                            // $dbPath = 'uploads/images/' . date('Y') . '/' . date('m') . '/';
                            // $pathDoc = $path . $dbPath;
                            
                            // create the folder if it doesn't exist else return false if the folder already exist
                            FileHelper::createDirectory($pathDoc);
                            
                            // save the image in storage e.g. hard disk
                            $image->saveAs($pathDoc . '/' . $fileName . ".{$ext}");
                            
                            // save the path in db column 
                            $modelPhoto->file_path = $folderPath . '/' . $fileName . ".{$ext}";
                            
                            // db path for images API
                            $imgPath = "https://" . $_SERVER['HTTP_HOST'] . \Yii::getAlias('@front') . '/' . $folderPath;
                            $modelPhoto->url = $imgPath . '/' . $fileName . ".{$ext}";
                                                     
                            $modelPhoto->status = 10;
                            $modelPhoto->alt = "My family photo " . $id;
                            
				            $modelPhoto->created_on = time();
                            
                                                            
                            if (! ($flag = $modelPhoto->save(false))) {
                                $transaction->rollBack();
                            }
                        }

                        if ($flag) {
                            // return $this->redirect(['view', 'id' => $model->id]);
                            
                            // Update last_updated attribute in LastUpdate
                            $model = LastUpdate::findOne(['id' => 1]);
                            if ($model !== null) {
                                $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                            }

                            $modelMyFamily = MyFamily::findOne(['id' => 1]);
                            $modelMyFamily->updated_on = time();
                            $modelMyFamily->save(false);

                            $transaction->commit();

                            return $this->redirect(['my-family/index']);
                        }
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
     * Updates an existing MyFamilyPhoto model.
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
     * Deletes an existing MyFamilyPhoto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        // return $this->redirect(['index']);
        return $this->redirect(['my-family/index']);
    }

    /**
     * Finds the MyFamilyPhoto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MyFamilyPhoto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MyFamilyPhoto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
