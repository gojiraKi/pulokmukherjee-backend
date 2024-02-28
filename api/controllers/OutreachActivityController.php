<?php

namespace api\controllers;

use Yii;
use app\models\Status;
use app\models\OutreachActivity;
use app\models\OutreachActivityPhoto;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class OutreachActivityController extends Controller
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
        $models = OutreachActivity::find()->asArray()->orderBy(['remark_one' => SORT_DESC])->all();

        $viewPath = "https://" . $_SERVER['HTTP_HOST'] . "/pkmukherjee/api/web/outreach-activity/";

        $data = [];
        foreach ($models as $model) {
            $id = $model['id'];
            $galleryProfileImage = OutreachActivity::FirstPhotos($id);
            $urlPP = $galleryProfileImage->url;
            $data[] = [
                'id' => $model['id'],
                'gallery_name' => $model['activity_name'],
                'gallery_profile_image' => $urlPP,
                'gallery_url' => $viewPath . $model['slug'],
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

    /**
     * Action to retrieve a specific example.
     * URL: GET /examples/{id}
     */
    // public function actionView($id)
    // {
    //     $example = 'example' . $id;

    //     return $example;
    // }

    /**
     * Action to retrieve a specific example by slug.
     * URL: GET /examples/{slug}
     */
    public function actionView($slug)
    {
        // $model = $this->findModelBySlug($slug);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = OutreachActivity::findOne(['slug' => $slug]);
        $modelPhotos = OutreachActivityPhoto::findall(['outreach_activity_id' => $model->id]);

        if ($model === null) {
            throw new \yii\web\NotFoundHttpException("Page with slug '{$slug}' not found");
        }

        $photos = [];
        // $modelPhotos = $model->outreachActivityPhoto;
        foreach ($modelPhotos as $modelPhoto) {
            $photos[] = [
                'id' => $modelPhoto->id,
                'url' => $modelPhoto->url,
                'alt' => $modelPhoto->alt
            ];
        }

        $data = [
            'gallery_name' => $model->activity_name,
            'photos' => $photos
        ];
        
        return [
            'status' => Status::STATUS_OK,
            'message' => 'success',
            'data' => $data
        ];

        // return $model;
    }

     /**
     * Helper method to find an example by slug.
     *
     * @param string $slug
     * @return array|null
     */
    protected function findModelBySlug($slug)
    {
        if (($model = OutreachActivity::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
}
