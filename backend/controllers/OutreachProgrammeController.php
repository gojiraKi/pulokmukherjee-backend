<?php

namespace backend\controllers;

use Yii;
use app\models\OutreachProgramme;
use app\models\OutreachProgrammeSearch;
use app\models\Model;
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
 * OutreachProgrammeController implements the CRUD actions for OutreachProgramme model.
 */
class OutreachProgrammeController extends Controller
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
     * Lists all OutreachProgramme models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OutreachProgrammeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OutreachProgramme model.
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
     * Creates a new OutreachProgramme model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // $model = new OutreachProgramme();
        $models = [new OutreachProgramme()];

        if ($this->request->isPost) {
            // if ($model->load($this->request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id' => $model->id]);
            // }
            $models = Model::createMultiple(OutreachProgramme::class);
            Model::loadMultiple($models, Yii::$app->request->post());

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($models as $i => $model) {
                    if ($model->load($this->request->post())) {
                        /* upload photo */
                        if ($image = UploadedFile::getInstance($model,"[{$i}]imageFile")) {
                            $name = $image->name;
                            $ext = (explode(".", $name));
                            $ext = end($ext);
                            $random = Yii::$app->security->generateRandomString(12);
                            $fileName = $random;
                            
                            $temp = explode("/", Yii::getAlias('@webroot'));
                            $length = count($temp);

                            // get the webroot path
                            $path = "";
                            for ($i = 0; $i < $length - 1; $i++) {
                                $path = $path . $temp[$i] . '/';
                            }

                            // image folder subpath
                            $folderPath = 'uploads/images';
                            $pathDoc = $path . $folderPath;
                        
                            // create the folder if it doesn't exist else return false if the folder already exist
                            FileHelper::createDirectory($pathDoc);
                            
                            // save the image in storage e.g. hard disk
                            $image->saveAs($pathDoc . '/' . $fileName . ".{$ext}");
                            
                            /* for saving thumbnail */
                            $save_photo = $pathDoc . '/' . $fileName . ".{$ext}";
                            $save_path = $pathDoc . '/thumbnails/';
                            
                            // save the path in db column 
                            $model->photo = $folderPath . '/' . $fileName . ".{$ext}";

                            // db path for images API
                            $imgPath = $_SERVER['HTTP_HOST'] . Yii::getAlias('@front') . '/' . $folderPath;
                            $model->thmb_photo_frnt = $imgPath . '/' . $fileName . ".{$ext}";
                            
                            /* thumbnail */
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
                            $model->thmb_photo = $folderPath . ('/thumbnails/') . $fileName . "_thm" . ".{$ext}";

                            /* thumbnail frontend*/
                            $thumbnail = Image::thumbnail($save_photo, $img_size = 300, $img_size = 425);
                        
                            FileHelper::createDirectory($save_path);
                            /* save in hdd */
                            $thumbnail->save($save_path . '/' .  $fileName . "_thm_frnt" . ".{$ext}", ['quality' => 90]);
                            /* save in db */
                            
                            if (! ($flag = $model->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        /* end upload photo */

                        if (! ($flag = $model->save())) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
            
                if ($flag) {
                    $transaction->commit();
                    return $this->redirect('index');
                }
            } catch (ErrorException $e) {
                $transaction->rollBack();
            }
        } else {
            // $model->loadDefaultValues();
        }

        return $this->render('create', [
            'models' => $models,
        ]);
    }

    /**
     * Updates an existing OutreachProgramme model.
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
     * Deletes an existing OutreachProgramme model.
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
     * Finds the OutreachProgramme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OutreachProgramme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OutreachProgramme::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
