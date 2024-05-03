<?php

namespace backend\controllers;

use Yii;
use app\models\BookContributed;
use app\models\BookContributedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

/**
 * BookContributedController implements the CRUD actions for BookContributed model.
 */
class BookContributedController extends Controller
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
     * Lists all BookContributed models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookContributedSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookContributed model.
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
                    'title'=> "Gallery #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new BookContributed model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new BookContributed();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BookContributed model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);
        $temp = $model->load(\Yii::$app->request->post());

        if ($model->load(\Yii::$app->request->post())) {
            date_default_timezone_set('Asia/Kolkata');
			$model->updated_on = time();
            $model->save();
            // return $this->redirect(['view', 'id' => (string) $model->id]);
            return $this->renderAjax('view', [
                'model' => $model,
            ]);
        }elseif (\Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        } else {
            return $this->render('_form', [
                'model' => $model
            ]);
        }

        // $request = Yii::$app->request;
        // $model = $this->findModel($id);

        // if($request->isAjax){
        //     /*
        //     *   Process for ajax request
        //     */
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     if($request->isGet){
        //         return [
        //             'title'=> "Update Gallery #".$id,
        //             'content'=>$this->renderAjax('update', [
        //                 'model' => $model,
        //             ]),
        //             'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
        //                         Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        //         ];
        //     }else if($model->load($request->post()) && $model->save()){
        //         return [
        //             'forceReload'=>'#crud-datatable-pjax',
        //             'title'=> "Gallery #".$id,
        //             'content'=>$this->renderAjax('view', [
        //                 'model' => $model,
        //             ]),
        //             'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
        //                     Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
        //         ];
        //     }else{
        //          return [
        //             'title'=> "Update Gallery #".$id,
        //             'content'=>$this->renderAjax('update', [
        //                 'model' => $model,
        //             ]),
        //             'footer'=> Html::button('Close',['class'=>'btn btn-secondary float-left','data-dismiss'=>"modal"]).
        //                         Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
        //         ];
        //     }
        // }else{
        //     /*
        //     *   Process for non-ajax request
        //     */
        //     if ($model->load($request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     } else {
        //         return $this->render('update', [
        //             'model' => $model,
        //         ]);
        //     }
        // }
    }

    /**
     * Deletes an existing BookContributed model.
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
     * Finds the BookContributed model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BookContributed the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookContributed::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
