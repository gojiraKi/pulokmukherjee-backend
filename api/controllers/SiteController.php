<?php

namespace api\controllers;

use app\models\Status;
use Yii;
use yii\rest\Controller;

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
}
