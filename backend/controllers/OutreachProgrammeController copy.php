<?php

namespace backend\controllers;

use Yii;
use app\models\OutreachProgramme;
use app\models\OutreachProgrammeSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
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
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all OutreachProgramme models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutreachProgrammeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single OutreachProgramme model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "OutreachProgramme #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new OutreachProgramme model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $models = [new OutreachProgramme()];

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;

            if($request->isGet){
                return [
                    'title'=> "Create new OutreachProgramme",
                    'content'=>$this->renderAjax('create', [
                        'models' => $models,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }else if($request->isPost){
                $models = Model::createMultiple(OutreachProgramme::class);
                foreach ($models as $model) {
                    if ($model->load($request->post())) {
                        /* upload photo */
                        if ($image = UploadedFile::getInstance($model,'')) {
                            $name = $image->name;
                            $ext = (explode(".", $name));
                            $ext = end($ext);
                            $random = Yii::$app->security->generateRandomString(12);
                            $fileName = $model->registration_no . '-' . $random;
                            
                            $temp = explode("/", Yii::getAlias('@webroot'));
                            $length = count($temp);
                            
                            /* required for saving physical file in hard disk */
                            $pathFolder = 'uploads/' . $model->transactionID . '/';
                            $pathDoc = Yii::getAlias('@webroot/') . $pathFolder;
                        
                            // create the folder if it doesn't exist else return false if the folder already exist
                            FileHelper::createDirectory($pathDoc);
                            
                            // save the image in storage e.g. hard disk
                            $image->saveAs($pathDoc . $fileName . ".{$ext}");
                            
                            /* for saving thumbnail */
                            $save_photo = $pathDoc . $fileName . ".{$ext}";
                            $save_path = Yii::getAlias('@webroot/') . 'uploads/images/thumbnails/';
                            
                            // save the path in db column 
                            $model->photo = Yii::getAlias('@web/') . $pathFolder . $fileName . ".{$ext}";
                            
                            /* thumbnail */
                            $thumbnail = Image::thumbnail($save_photo, $img_size = 150, $img_size = 150);
                            $size = $thumbnail->getSize();
                            if ($size->getWidth() < $img_size or $size->getHeight() < $img_size) {
                                $white = Image::getImagine()->create(new Box($img_size, $img_size));
                                $thumbnail = $white->paste($thumbnail, new Point($img_size / 2 - $size->getWidth() / 2, $img_size / 2 - $size->getHeight() / 2));
                            }
                            /* save in hdd */
                            $thumbnail->save($save_path . $fileName . "thm" . ".{$ext}", ['quality' => 90]);
                            /* save in db */
                            $model->remark_two = Yii::getAlias('@web/uploads/images/thumbnails/') . $fileName . "thm" . ".{$ext}";
                            
                            // $model->save(false);
                        }
                        /* end upload photo */

                        $model->save();
                    }
                }
                return $this->redirect('index');
                
                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Create new OutreachProgramme",
                //     'content'=>'<span class="text-success">Create OutreachProgramme success</span>',
                //     'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                //             Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])

                // ];
            }else{
                return [
                    'title'=> "Create new OutreachProgramme",
                    'content'=>$this->renderAjax('create', [
                        'models' => $models,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if($request->isPost) {
                foreach ($models as $model) {
                    if ($model->load($request->post())) {
                        $model->save();
                    }
                }
                return $this->redirect('index');
            } else {
                return $this->render('create', [
                    'models' => $models,
                ]);
            }
        }

    }

    /**
     * Updates an existing OutreachProgramme model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update OutreachProgramme #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "OutreachProgramme #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Update OutreachProgramme #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing OutreachProgramme model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

     /**
     * Delete multiple existing OutreachProgramme model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the OutreachProgramme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OutreachProgramme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OutreachProgramme::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
