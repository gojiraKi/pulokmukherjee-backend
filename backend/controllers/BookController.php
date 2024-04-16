<?php

namespace backend\controllers;

use app\models\BookAuthored;
use app\models\BookAuthoredSearch;
use app\models\BookContributed;
use app\models\BookContributedSearch;

class BookController extends \yii\web\Controller
{
    // public function actionCreate()
    // {
    //     return $this->render('create');
    // }

    // public function actionDelete()
    // {
    //     return $this->render('delete');
    // }

    public function actionIndex()
    {
        $searchModelBa = new BookAuthoredSearch();
        $dataProviderBA = $searchModelBa->search($this->request->queryParams);

        $searchModelBC = new BookContributedSearch();
        $dataProviderBC = $searchModelBC->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            'dataProviderBA' => $dataProviderBA,
            'dataProviderBC' => $dataProviderBC,
        ]);
        // return $this->render('index');
    }

    // public function actionUpdate()
    // {
    //     return $this->render('update');
    // }

}
