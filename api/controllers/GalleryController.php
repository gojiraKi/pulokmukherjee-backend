<?php

namespace api\controllers;

use Yii;
use app\models\Status;
use app\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class GalleryController extends Controller
{
    // // Set the response format to JSON
    // public $response = [
    //     'format' => Response::FORMAT_JSON,
    // ];

    /**
     * Action to retrieve all examples.
     * URL: GET /examples
     */
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $models = Gallery::find()->asArray()->orderBy('id')->all();

        $data = [];
        $order = 0;
        foreach ($models as $model) {
            $order = $order + 1;
            $url = $model['photo_frnt'];
            $alt = $model['alt_text'];
            $data[] = [
                'order' => $order,
                'url' => $url,
                'alt' => $alt,
            ];
        }
        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ]
        // ]);

        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $data
        ];
        // $modelsPhoto = $model->outreachActivityPhotos;

    }
}
