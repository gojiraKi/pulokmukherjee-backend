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
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = OutreachProgramme::find();

        $query->thmb_photo_frnt = "http://" . $query->thmb_photo_frnt;
        print_r($query);
        die('');

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
