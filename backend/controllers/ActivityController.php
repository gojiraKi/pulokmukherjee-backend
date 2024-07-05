<?php

namespace backend\controllers;

use Yii;
use app\models\Activity;
use app\models\ActivitySearch;
use app\models\MemberProfessionalBodySearch;
use app\models\VisitingScientistUniversityResearchCentreSearch;
use app\models\MemberScientificProfessionalBodySearch;
use app\models\LastUpdate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use \yii\web\Response;
// use yii\helpers\Html;

/**
 * ActivityController implements the CRUD actions for Activity model.
 */
class ActivityController extends Controller
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
     * Lists all Activity models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $rowCount = Activity::find()->count();
        if ($rowCount == 1) {
            $this->redirect(['view', 'id' => 1]);
        }

        $searchModel = new ActivitySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Activity model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchMemberProfessionalBody = new MemberProfessionalBodySearch();
        $dataProviderMemberProfessionalBody = $searchMemberProfessionalBody->search($this->request->queryParams);

        $searchVisitingScientistUniversityResearchCentre = new VisitingScientistUniversityResearchCentreSearch();
        $dataProviderVisitingScientistUniversityResearchCentre = $searchVisitingScientistUniversityResearchCentre->search($this->request->queryParams);

        $searchMemberScientificProfessionalBody = new MemberScientificProfessionalBodySearch();
        $dataProviderMemberScientificProfessionalBody = $searchMemberScientificProfessionalBody->search($this->request->queryParams);
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderMemberProfessionalBody' => $dataProviderMemberProfessionalBody,
            'dataProviderVisitingScientistUniversityResearchCentre' => $dataProviderVisitingScientistUniversityResearchCentre,
            'dataProviderMemberScientificProfessionalBody' => $dataProviderMemberScientificProfessionalBody
        ]);
    }

    /**
     * Creates a new Activity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Activity();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                date_default_timezone_set('Asia/Kolkata');
                $model->created_on = time();
                $model->save(false);

                // Update last_updated attribute in LastUpdate
                $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
                if ($modelLastUpdated !== null) {
                    $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
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
     * Updates an existing Activity model.
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
            $model->save(false);

            // Update last_updated attribute in LastUpdate
            $modelLastUpdated = LastUpdate::findOne(['id' => 1]);
            if ($modelLastUpdated !== null) {
                $modelLastUpdated->updateAttributes(['last_updated' => date("Y-m-d")]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->layout = "main-mce";
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Activity model.
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
     * Finds the Activity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Activity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Activity::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
