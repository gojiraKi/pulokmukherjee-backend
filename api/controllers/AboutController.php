<?php

namespace api\controllers;

use Yii;
use app\models\About;
use app\models\AboutResearch;
use app\models\Status;
// use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class AboutController extends Controller
{
    // // Set the response format to JSON
    // public $response = [
    //     'format' => Response::FORMAT_JSON,
    // ];

    /**
     * Action to retrieve all examples.
     * URL: GET /examples
     */
    public function actionIndex() {
        // $params = Yii::$app->request->get();
        $id = '1';
        $model = About::findOne(['id' => $id]);
        $modelResearchs = AboutResearch::find()->where(['status' => '10'])->asArray()->orderBy('id')->all();

        $dataResearch = [];
        foreach ($modelResearchs as $modelResearch) {
            $title = $modelResearch['title'];

            $dataResearch[] = [
                'title' => $title
            ];
        }

        $data[] = [
            'photo' => $model['photo'],
            'name' => $model['name'],
            'qualification' => $model['qualification'],
            'field_one' => $model['field_one'],
            'field_two' => $model['field_two'],
            'field_three' => $model['field_three'],
            'field_four' => $model['field_four'],
            'field_five' => $model['field_five'],
            'field_six' => $model['field_six'],
            'field_seven' => $model['field_seven'],
            'email_one' => $model['email_one'],
            'email_two' => $model['email_two'],
            'article' => $model['article'],
            'dataResearch' => $dataResearch
        ];
        
        if ($model && $modelResearch) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->statusCode = Status::STATUS_OK;
            $response['isSuccess'] = 200;
            $response['message'] = 'ok';

            return [
                'status' => Status::STATUS_OK,
                'message' => 'success',
                'data' => $data
            ];
        } else {
            $this->hasError($model);
        }  
    }

    // return error message
    public function hasError($model) {
        Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
        $model->getErrors();
        $response['hasErrors'] = $model->hasErrors();
        $response['errors'] = $model->getErrors();
        return [
            'status' => Status::STATUS_BAD_REQUEST,
            'message' => 'Error!',
            'data' => [
                'hasErrors' => $model->hasErrors(),
                'getErrors' => $model->getErrors(),
            ]
        ];
    }
}
