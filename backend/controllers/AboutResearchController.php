<?php

namespace backend\controllers;

// use app\models\About;
use app\models\AboutResearch;
use app\models\AboutResearchSearch;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

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
        $searchModel = new AboutResearchSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

                // Update last_updated attribute in LastUpdate
                $model = LastUpdate::findOne(['id' => 1]);
                if ($model !== null) {
                    $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
                // return $this->redirect(['about/view', 'id' => 1]);

                $url = Url::toRoute('about/view')."?id=1#about-research";      
                return $this->redirect($url);
            }
        } elseif (\Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        } else {
            return $this->render('create', [
                'model' => $model
            ]);
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
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            date_default_timezone_set('Asia/Kolkata');
                $model->updated_on = date('Y-m-d H:i:s');
                
                $model->save();

                // Update last_updated attribute in LastUpdate
                $model = LastUpdate::findOne(['id' => 1]);
                if ($model !== null) {
                    $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                }
            $url = Url::toRoute('about/view')."?id=1#about-research";      
            return $this->redirect($url);
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
