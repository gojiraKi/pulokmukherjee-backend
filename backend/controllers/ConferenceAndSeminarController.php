<?php

namespace backend\controllers;

use Yii;
use app\models\ConferenceAndSeminar;
use app\models\ConferenceAndSeminarSearch;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * ConferenceAndSeminarController implements the CRUD actions for ConferenceAndSeminar model.
 */
class ConferenceAndSeminarController extends Controller
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
     * Lists all ConferenceAndSeminar models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ConferenceAndSeminarSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConferenceAndSeminar model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // return $this->renderAjax('view', [
        //     'model' => $this->findModel($id),
        // ]);

        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Conference and Seminar #" . $id,
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
     * Creates a new ConferenceAndSeminar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ConferenceAndSeminar();
        $request = Yii::$app->request;

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post())) {
        //         date_default_timezone_set('Asia/Kolkata');
		// 		$model->created_on = time();

        //         $model->save();
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create Conference and Seminar",
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
                    'title'=> "Created Conference and Seminar#" . $model->id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($model->id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                return [
                    'title'=> "Create Conference and Seminar",
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
     * Updates an existing ConferenceAndSeminar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);

        // if ($this->request->isPost && $model->load($this->request->post())) {
        //     date_default_timezone_set('Asia/Kolkata');
		// 	$model->updated_on = time();

        //     $model->save();
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);

        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Conference and Seminar#" . $id,
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
                    'title'=> "Updated Conference and Seminar#" . $id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                return [
                    'title'=> "Updated Conference and Seminar#" . $id,
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
     * Deletes an existing ConferenceAndSeminar model.
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
     * Finds the ConferenceAndSeminar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ConferenceAndSeminar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConferenceAndSeminar::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
