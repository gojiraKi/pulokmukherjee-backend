<?php

namespace backend\controllers;

use Yii;
// use app\models\About;
use app\models\AboutResearch;
use app\models\AboutResearchSearch;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * AboutResearchController implements the CRUD actions for AboutResearch model.
 */
class AboutResearchController extends Controller
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
     * Lists all AboutResearch models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $url = Url::toRoute('about/view') . "?id=1#about-research";      
        return $this->redirect($url);
    }

    /**
     * Displays a single AboutResearch model.
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
     * Creates a new AboutResearch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateOri()
    {
        $model = new AboutResearch();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                date_default_timezone_set('Asia/Kolkata');
                $model->created_on = date('Y-m-d H:i:s');
                
                $model->save();

                // Update last_updated attribute in LastUpdate
                $model = LastUpdate::findOne(['id' => 1]);
                if ($model !== null) {
                    $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                }

                return $this->redirect(['about/view', 'id' => 1]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new AboutResearch();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create New About Research Area",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            } else if($model->load($request->post())){
                date_default_timezone_set('Asia/Kolkata');
	            $model->created_on = date('Y-m-d H:i:s');
                $model->save(false);

                $id = $model->id;

                // Update last_updated attribute in LastUpdate
                $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
                if ($modelLastUpdated !== null) {
                    $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
              
                Yii::$app->response->format = Response::FORMAT_JSON;
                // return [
                //     'forceReload'=>'#datatable-pjax',
                //     'title'=> "Success",
                //     'content'=>'<span class="text-success">Create Research Area success</span>',
                //     // 'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
                //     //         Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                //     'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])

                // ];

                return [
                    // 'forceReload'=>'#datatable-pjax',
                    'title'=> "New Research Area Created #" . $id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    // 'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                    //         Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "Create new Gallery",
                    'content'=>$this->renderAjax('create', [
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
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Updates an existing AboutResearch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
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
                    'title'=> "Update About Research Area #" . $model->id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                                Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])

                ];
            } else if($model->load($request->post())){
                date_default_timezone_set('Asia/Kolkata');
	            $model->updated_on = date('Y-m-d H:i:s');
                $model->save(false);

                $id = $model->id;

                // Update last_updated attribute in LastUpdate
                $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
                if ($modelLastUpdated !== null) {
                    $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
              
                Yii::$app->response->format = Response::FORMAT_JSON;

                return [
                    'title'=> "Updated About Research Area #" . $id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
                ];
            } else {
                return [
                    'title'=> "Update About Research Area #" . $model->id,
                    'content'=>$this->renderAjax('create', [
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
     * Deletes an existing AboutResearch model.
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
     * Finds the AboutResearch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AboutResearch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AboutResearch::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
