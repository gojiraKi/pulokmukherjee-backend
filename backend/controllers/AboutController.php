<?php

namespace backend\controllers;

use Yii;
use backend\models\About;
use backend\models\AboutSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * AboutController implements the CRUD actions for About model.
 */
class AboutController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all About models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // check if about us section is created
        // only one about us is required so redirecting to view
        $model = About::findOne(['created' => 1]);
        if ($model !== null) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index');
    }

    /**
     * Displays a single About model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new About model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new About();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                /* upload photo */
				if ($image = UploadedFile::getInstance($model,'imageFile')) {
					$name = $image->name;
					$ext = (explode(".", $name));
					$ext = end($ext);
					$fileName = Yii::$app->security->generateRandomString(12);

                    $temp = explode("/", Yii::getAlias('@webroot'));
                    $length = count($temp);

                    $one = Yii::getAlias('@webroot');
                    $two = Yii::getAlias('@web');
                    $three = Yii::getAlias('@yii');
                    $four = Yii::getAlias('@app');

                    $path = "";
                    for ($i = 0; $i < $length - 2; $i++) {
                        $path = $path . $temp[$i] . '/';
                    }
					
					/* required for saving physical file in hard disk */
					$pathFolder = 'frontend/web/uploads/';
					$pathDoc = $path . $pathFolder;
				
					// create the folder if it doesn't exist else return false if the folder already exist
					FileHelper::createDirectory($pathDoc);
					
					// save the image in storage e.g. hard disk
					$image->saveAs($pathDoc . $fileName . ".{$ext}");
					
					// save the path in db column 
					// $model->bio_photo = Yii::getAlias('@frontend/') . $pathFolder . $fileName . ".{$ext}";
					$model->bio_photo = Yii::getAlias('@front') . '/' . $pathFolder . $fileName . ".{$ext}";
					
					$model->save(false);
				}
				/* end upload photo */
                $model->created_by = Yii::$app->user->id;
                date_default_timezone_set('Asia/Kolkata');
                $model->created_on = time();
                $model->created = 1;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing About model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing About model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the About model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return About the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = About::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
