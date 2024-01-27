<?php

namespace api\controllers;

use app\models\Status;
use app\models\OutreachProgramme;
use Yii;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function actions()
    // {
    //     return [
    //         'error' => [
    //             'class' => \yii\web\ErrorAction::class,
    //         ],
    //     ];
    // }

    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'login' => ['POST'],
            'verify-otp' => ['POST'],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return [
            'status' => Status::STATUS_OK,
            'message' => 'Hello :)',
            // 'data' => $post
        ];
    }

    public function actionOutreachProgramme()
    {
        $query = OutreachProgramme::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $dataProvider
        ];
    }
}
