<?php

namespace backend\controllers;

use Yii;
use app\models\MyFamily;
use app\models\MyFamilySearch;
use app\models\MyFamilyPhoto;
use app\models\Media;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/**
 * MyFamilyController implements the CRUD actions for MyFamily model.
 */
class MyFamilyController extends Controller
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
     * Update last updated on LastUpdate
     * 
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Update last_updated attribute in LastUpdate
        $model = LastUpdate::findOne(['id' => 1]);
        if ($model !== null) {
            $model->updateAttributes(['last_updated' => date("Y-m-d")]);
        }
    }

    /**
     * Lists all MyFamily models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $rowCount = MyFamily::find()->count();
        if($rowCount == 1){
            $this->redirect(['view', 'id' => 1]);
        }

        $searchModel = new MyFamilySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MyFamily model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // get photo
        $dataProvider = new ActiveDataProvider([
            'query' => MyFamilyPhoto::find()->where(['status' => 10]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        // $this->layout = "main-mce";
        return $this->render('view', [
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MyFamily model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MyFamily();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                date_default_timezone_set('Asia/Kolkata');
                $model->created_on = time();
                
                $model->save();

                // Update last_updated attribute in LastUpdate
                $model = LastUpdate::findOne(['id' => 1]);
                if ($model !== null) {
                    $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $this->layout = "main-mce";
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MyFamily model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            date_default_timezone_set('Asia/Kolkata');
            $model->updated_on = time();
            
            $model->save();

            // Update last_updated attribute in LastUpdate
            $model = LastUpdate::findOne(['id' => 1]);
            if ($model !== null) {
                $model->updateAttributes(['last_updated' => date("Y-m-d")]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->layout = "main-mce";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    // public function actionUpdate($id)
    // {
    //     $request = Yii::$app->request;
    //     $model = $this->findModel($id);

    //     if($request->isAjax){
    //         /*
    //         *   Process for ajax request
    //         */
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         if($request->isGet){
    //             return [
    //                 'title'=> "Update Gallery #".$id,
    //                 'content'=>$this->renderAjax('update', [
    //                     'model' => $model,
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
    //                             Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])
    //             ];
    //         }else if($model->load($request->post())){
    //             date_default_timezone_set('Asia/Kolkata');
    //             $model->updated_on = time();
                
    //             $model->save();

    //             // Update last_updated attribute in LastUpdate
    //             $model = LastUpdate::findOne(['id' => 1]);
    //             if ($model !== null) {
    //                 $model->updateAttributes(['last_updated' => date("Y-m-d")]);
    //             }

    //             Yii::$app->response->format = Response::FORMAT_JSON;

    //             return [
    //                 'title'=> "Updated My Family",
    //                 'content'=>$this->renderAjax('view', [
    //                     'model' => $this->findModel($id),
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"])
    //             ];
    //         }else{
    //              return [
    //                 'title'=> "Update My Family",
    //                 'content'=>$this->renderAjax('update', [
    //                     'model' => $model,
    //                 ]),
    //                 'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
    //                             Html::button('Save',['id' => 'submit-btn', 'class'=>'btn btn-primary','type'=>"submit"])
    //             ];
    //         }
    //     }else{
    //         /*
    //         *   Process for non-ajax request
    //         */
    //         if ($model->load($request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         } else {
    //             return $this->render('update', [
    //                 'model' => $model,
    //             ]);
    //         }
    //     }
    // }

    /**
     * Deletes an existing MyFamily model.
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
     * Finds the MyFamily model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MyFamily the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MyFamily::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
