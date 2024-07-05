<?php

namespace api\controllers;

use Yii;
use app\models\MyFamily;
use app\models\MyFamilyPhoto;
use app\models\Status;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class MyFamilyController extends Controller
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

        $model = MyFamily::findOne(1);
        $modelFamilyPhotos = MyFamilyPhoto::findAll(['status' => 10]);

        $data = [];
        
        $order = 0;
        $photo_data = [];
        foreach ($modelFamilyPhotos as $familyPhoto) {
            $order = $order + 1;
            $url = $familyPhoto['url'];
            $alt = $familyPhoto['alt'];
            $photo_data[] = [
                'order' => $order,
                'url' => $url,
                'alt' => $alt,
            ];
        }

        $data[] = [
            'article' => $model->article,
            'family_photo' => $photo_data
        ];

        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $data
        ];
    }
}
