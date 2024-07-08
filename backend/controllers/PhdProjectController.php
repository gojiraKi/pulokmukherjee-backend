<?php

namespace backend\controllers;

use app\models\PhdProjectOngoingSearch;
use app\models\PhdProjectCompletedSearch;
// use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;

class PhdProjectController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModelPhdProjectOngoing = new PhdProjectOngoingSearch();
        $dataProviderPhdProjectOngoing = $searchModelPhdProjectOngoing->search($this->request->queryParams);

        $searchModelPhdProjectSearch = new PhdProjectCompletedSearch();
        $dataProviderPhdProjectCompleted = $searchModelPhdProjectSearch->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModelPhdProjectOngoing,
            'dataProviderPhdProjectOngoing' => $dataProviderPhdProjectOngoing,
            'dataProviderPhdProjectCompleted' => $dataProviderPhdProjectCompleted,
        ]);
    }

}
