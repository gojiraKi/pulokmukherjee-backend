<?php

namespace backend\controllers;

use Yii;
use app\models\OutreachActivity;
use app\models\OutreachActivitySearch;
use app\models\OutreachActivityPhoto;
// use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * OutreachActivityController implements the CRUD actions for OutreachActivity model.
 */
class OutreachActivityController extends Controller
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
     * Lists all OutreachActivity models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OutreachActivitySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OutreachActivity model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = OutreachActivity::findOne($id);
        $modelsPhoto = $model->outreachActivityPhotos;

        return $this->render('view2', [
            'model' => $model,
            'modelsPhoto' => $modelsPhoto
        ]);
    }

    /**
     * Creates a new OutreachActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OutreachActivity();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                date_default_timezone_set('Asia/Kolkata');
				$model->created_on = time();

                $valid = $model->validate();

                if ($valid) {
					$transaction = \Yii::$app->db->beginTransaction();
					try {
						
						if ($flag = $model->save(false)) {    
							if($images = UploadedFile::getInstances($model,'imageFiles')) {
								foreach($images as $image) {   
									$modelPhoto = new OutreachActivityPhoto();
									$modelPhoto->outreach_activity_id = $model->id;
									
									$name = $image->name;
									$ext = (explode(".", $name));
									$ext = end($ext);
									$random = Yii::$app->security->generateRandomString(12);
									$fileName = $model->id . '-' . $random;

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
                                    $imgPath = "https://" . $_SERVER['HTTP_HOST'] . Yii::getAlias('@front') . '/' . $folderPath;
                                    $modelPhoto->url = $imgPath . '/' . $fileName . ".{$ext}";
									
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
                                    $modelPhoto->thumbnail = $folderPath . ('/thumbnails/') . $fileName . "_thm" . ".{$ext}";
                                    
                                    $alt = trim($modelPhoto->alt);
                                    if (empty($alt)) {
                                        $modelPhoto->alt = $model->slug . "-" . $modelPhoto->id;
                                    }
																	
									if (! ($flag = $modelPhoto->save(false))) {
										$transaction->rollBack();
									}
								}
							}
						}

						if ($flag) {
							$transaction->commit();
							return $this->redirect(['view', 'id' => $model->id]);
						}
					} catch (ErrorException $e) {
						$transaction->rollBack();
					}
				} else {
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
     * Updates an existing OutreachActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            date_default_timezone_set('Asia/Kolkata');
				$model->updated_on = time();

                $valid = $model->validate();

                if ($valid) {
					$transaction = \Yii::$app->db->beginTransaction();
					try {
						
						if ($flag = $model->save(false)) {    
							if($images = UploadedFile::getInstances($model,'imageFiles')) {
								foreach($images as $image) {   
									$modelPhoto = new OutreachActivityPhoto();
									$modelPhoto->outreach_activity_id = $model->id;
									
									$name = $image->name;
									$ext = (explode(".", $name));
									$ext = end($ext);
									$random = Yii::$app->security->generateRandomString(12);
									$fileName = $model->id . '-' . $random;

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
									
									// save the path in db column 
									$modelPhoto->file_path = $folderPath . '/' . $fileName . ".{$ext}";
									
									// db path for images API
                                    $imgPath = "https://" . $_SERVER['HTTP_HOST'] . Yii::getAlias('@front') . '/' . $folderPath;
                                    $modelPhoto->url = $imgPath . '/' . $fileName . ".{$ext}";
									
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
                                    $modelPhoto->thumbnail = $folderPath . ('/thumbnails/') . $fileName . "_thm" . ".{$ext}";
                                    
                                    $alt = trim($modelPhoto->alt);
                                    if (empty($alt)) {
                                        $modelPhoto->alt = $model->slug . "-" . $modelPhoto->id;
                                    }
																	
									if (! ($flag = $modelPhoto->save(false))) {
										$transaction->rollBack();
									}
								}
							}
						}

						if ($flag) {
							$transaction->commit();
							return $this->redirect(['view', 'id' => $model->id]);
						}
					} catch (ErrorException $e) {
						$transaction->rollBack();
					}
				} else {
					$errors = $model->errors;
					print_r($errors);
					
					exit();
				}

            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OutreachActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = OutreachActivity::findOne(['id' => $id]);
        $modelPhotos = $model->outreachActivityPhotos;

        $transaction = \Yii::$app->db->beginTransaction();
		try {
            foreach ($modelPhotos as $modelPhoto) {
                $tempFilename = $modelPhoto->file_path;
                if (! ($flag = $modelPhoto->delete())) {
                    $transaction->rollBack();
                }
                if(file_exists($tempFilename)){
                    unlink($tempFilename);
                }
            }

            if ($flag) {
                $model->delete();
                $transaction->commit();
                return $this->redirect(['index']);
            }
        } catch (ErrorException $e) {
            $transaction->rollBack();
        }

        // return $this->redirect(['index']);
    }

    /**
     * Finds the OutreachActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OutreachActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OutreachActivity::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
