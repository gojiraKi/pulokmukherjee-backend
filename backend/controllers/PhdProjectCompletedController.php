<?php

namespace backend\controllers;

use Yii;
use app\models\PhdProjectCompleted;
use app\models\PhdProjectCompletedSearch;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * PhdProjectCompletedController implements the CRUD actions for PhdProjectCompleted model.
 */
class PhdProjectCompletedController extends Controller
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
     * Lists all PhdProjectCompleted models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    //     $searchModel = new PhdProjectCompletedSearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);

    //     return $this->render('index', [
    //         'searchModel' => $searchModel,
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }

    /**
     * Displays a single PhdProjectCompleted model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Phd Project Ongoing #" . $id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                    // .Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new PhdProjectCompleted model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new PhdProjectCompleted();

        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create Phd Project Completed",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            } else if ($model->load($request->post())) {
                date_default_timezone_set('Asia/Kolkata');
	            $model->created_on = time();
                $model->save(false);

                // Update last_updated attribute in LastUpdate
                $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
                if ($modelLastUpdated !== null) {
                    $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
              
                Yii::$app->response->format = Response::FORMAT_JSON;

                return [
                    'title'=> "Created Phd Project Completed#" . $model->id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($model->id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                return [
                    'title'=> "Create Phd Project Completed",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->loadDefaultValues();
            }
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhdProjectCompleted model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $request = Yii::$app->request;

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Phd Project Completed#" . $id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            } else if ($model->load($request->post())) {
                date_default_timezone_set('Asia/Kolkata');
	            $model->updated_on = time();
                $model->save(false);

                // Update last_updated attribute in LastUpdate
                $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
                if ($modelLastUpdated !== null) {
                    $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
              
                Yii::$app->response->format = Response::FORMAT_JSON;

                return [
                    'title'=> "Updated Phd Project Completed#" . $id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                return [
                    'title'=> "Updated Phd Project Completed#" . $id,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->loadDefaultValues();
            }
            
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhdProjectCompleted model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['phd-project/index']);
    }

    /**
     * Finds the PhdProjectCompleted model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return PhdProjectCompleted the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhdProjectCompleted::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
