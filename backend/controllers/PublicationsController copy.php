<?php

namespace backend\controllers;

use Yii;
use app\models\Publications;
use app\models\PublicationsSearch;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\ErrorException;
use yii\filters\VerbFilter;

/**
 * PublicationsController implements the CRUD actions for Publications model.
 */
class PublicationsController extends Controller
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
     * Lists all Publications models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PublicationsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publications model.
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
     * Creates a new Publications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // $model = new Publications();
        $models = [new Publications()];

        if ($this->request->isPost) {
            // if ($model->load($this->request->post()) && $model->save()) {
            //     return $this->redirect(['view', 'id' => $model->id]);
            // }
            $models = Model::createMultiple(Publications::class);
            Model::loadMultiple($models, Yii::$app->request->post());

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach ($models as $i => $model) {
                    if ($model->load($this->request->post())) {
                        if (! ($flag = $model->save())) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
            
                if ($flag) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'New publication records saved.');
                    return $this->redirect('index');
                }
            } catch (ErrorException $e) {
                $transaction->rollBack();
            }
        } 
        // else {
        //     Yii::$app->session->setFlash('error', 'Contact System Admin.');
        //     // $model->loadDefaultValues();
        // }

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        return $this->render('create', [
            'models' => $models,
        ]);
    }

    /**
     * Updates an existing Publications model.
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
     * Deletes an existing Publications model.
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
     * Finds the Publications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Publications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publications::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
