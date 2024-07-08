<?php

namespace api\controllers;

use Yii;
use app\models\Status;
use app\models\OutreachProgramme;
use app\models\ContactForm;
use app\models\RecentHighlight;
use app\models\RecentHighlights;
use app\models\OutreachActivity;
use app\models\LastUpdate;
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
            'contact-us' => ['POST'],
            // 'recent-hightlights' => ['GET']
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_on' => SORT_DESC,
                ]
            ],
        ]);

        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $dataProvider
        ];
    }

    public function contactUs()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new ContactForm();
        $params = Yii::$app->request->post();

        $model->name = $params['name'];
        $regexName = '/^[a-zA-Z. ]+$/';

        // Perform the regex match
        if (!preg_match($regexName, $model->name)) {
            Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
            return [
                'status' => Status::STATUS_BAD_REQUEST,
                'message' => "Names should consist exclusively of letters, dots, and spaces",
            ];
        }

        $model->email = $params['email'];
        $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (!preg_match($regexEmail, $model->email)) {
            Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
            return [
                'status' => Status::STATUS_BAD_REQUEST,
                'message' => "Invalid Email",
            ];
        }

        if (!$model->validate()) {
            Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
            return [
                'status' => Status::STATUS_BAD_REQUEST,
                'message' => "There was an error sending your message.",
            ];
        }
    }

    public function actionRecentHighlight()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = RecentHighlight::find()->where(['status' => 10]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // 'pagination' => [
            //     'pageSize' => 10,
            // ]
            'sort' => [
                'defaultOrder' => [
                    'created_on' => SORT_DESC,
                ]
            ],
        ]);

        Yii::$app->response->statusCode = Status::STATUS_OK;
        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $dataProvider
        ];
    }

    public function actionRecentHighlights()
    {
        $params = Yii::$app->request->get();
        $id = $params['id'];
        $model = RecentHighlights::findOne(['id' => $id, 'status' => 10]);

        if ($model) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->statusCode = Status::STATUS_OK;
            $response['isSuccess'] = 200;
            $response['message'] = 'ok';

            return [
                'status' => Status::STATUS_OK,
                'message' => 'success',
                'data' => $model
            ];
        } else {
            $this->hasError($model);
        }
    }

    // public function actionOutreachActiviy() {
    //     Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //     $model = OutreachActivity::find()->asArray()->all();
    //     return $model;
    // }

    // return error message
    public function hasError($model)
    {
        Yii::$app->response->statusCode = Status::STATUS_BAD_REQUEST;
        $model->getErrors();
        $response['hasErrors'] = $model->hasErrors();
        $response['errors'] = $model->getErrors();
        return [
            'status' => Status::STATUS_BAD_REQUEST,
            'message' => 'Error saving data!',
            'data' => [
                'hasErrors' => $model->hasErrors(),
                'getErrors' => $model->getErrors(),
            ]
        ];
    }

    // endpoint to return last updated date
    public function actionLastUpdated()
    {
        $model = LastUpdate::findOne(['id' => 1]);

        // Create a DateTime object from the given date
        $dateTime = new \DateTime($model->last_updated);

        // Format the date to dd/mm/yyyy
        $formattedDate = $dateTime->format('d/m/Y');

        if ($model) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            Yii::$app->response->statusCode = Status::STATUS_OK;
            $response['isSuccess'] = 200;
            $response['message'] = 'ok';

            return [
                'status' => Status::STATUS_OK,
                'message' => 'success',
                'data' => $formattedDate
            ];
        } else {
            $this->hasError($model);
        }
    }
}
