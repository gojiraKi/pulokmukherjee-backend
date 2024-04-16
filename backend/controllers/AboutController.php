<?php

namespace backend\controllers;

use app\models\About;
use app\models\AboutSearch;
use app\models\AboutResearchSearch;
use app\models\LastUpdate;
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
     * Update last updated on LastUpdate
     * 
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Update last_updated attribute in LastUpdate
        $model = LastUpdate::findOne(['id' => 1]);
        if ($model !== null) {
            $model->updateAttributes(['last_updated' => date("Y-m-d")]);
        }
    }

    /**
     * Lists all About models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $rowCount = About::find()->count();
        if($rowCount == 1){
            $this->redirect(['view', 'id' => 1]);
        }

        $searchModel = new AboutSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single About model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // About Research Section
        $searchModel = new AboutResearchSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
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
                if ($image = UploadedFile::getInstance($model,"file")) {
                    $name = $image->name;
                    $ext = (explode(".", $name));
                    $ext = end($ext);
                    $random = \Yii::$app->security->generateRandomString(12);
                    $fileName = $random;
                    
                    $temp = explode("/", \Yii::getAlias('@webroot'));
                    $length = count($temp);

                    // get the webroot path
                    $path = "";
                    for ($i = 0; $i < $length - 1; $i++) {
                        $path = $path . $temp[$i] . '/';
                    }

                    // image folder subpath
                    $folderPath = 'uploads/images/about';
                    $pathDoc = $path . $folderPath;
                
                    // create the folder if it doesn't exist else return false if the folder already exist
                    FileHelper::createDirectory($pathDoc);
                    
                    // save the image in storage e.g. hard disk
                    $image->saveAs($pathDoc . '/' . $fileName . ".{$ext}");

                    // save the path
                    $imgPath = $_SERVER['HTTP_HOST'] . \Yii::getAlias('@front') . '/' . $folderPath;
                    $model->photo = "https://" . $imgPath . '/' . $fileName . ".{$ext}";
                     
                    // $model->save(false);
                }
                date_default_timezone_set('Asia/Kolkata');
                $model->created_on = date('Y-m-d H:i:s');
                
                $model->save();

                // Update last_updated attribute in LastUpdate
                $model = LastUpdate::findOne(['id' => 1]);
                if ($model !== null) {
                    $model->updateAttributes(['last_updated' => date("Y-m-d")]);
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $this->layout = "main-mce";
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($image = UploadedFile::getInstance($model,"file")) {
                $name = $image->name;
                $ext = (explode(".", $name));
                $ext = end($ext);
                $random = \Yii::$app->security->generateRandomString(12);
                $fileName = $random;
                
                $temp = explode("/", \Yii::getAlias('@webroot'));
                $length = count($temp);

                // get the webroot path
                $path = "";
                for ($i = 0; $i < $length - 1; $i++) {
                    $path = $path . $temp[$i] . '/';
                }

                // image folder subpath
                $folderPath = 'uploads/images/about';
                $pathDoc = $path . $folderPath;
            
                // create the folder if it doesn't exist else return false if the folder already exist
                FileHelper::createDirectory($pathDoc);
                
                // save the image in storage e.g. hard disk
                $image->saveAs($pathDoc . '/' . $fileName . ".{$ext}");

                // save the path
                $imgPath = $_SERVER['HTTP_HOST'] . \Yii::getAlias('@front') . '/' . $folderPath;
                $model->photo = "https://" . $imgPath . '/' . $fileName . ".{$ext}";
                 
                // $model->save(false);
            }
            date_default_timezone_set('Asia/Kolkata');
            $model->updated_on = date('Y-m-d H:i:s');
            
            $model->save();

            // Update last_updated attribute in LastUpdate
            $model = LastUpdate::findOne(['id' => 1]);
            if ($model !== null) {
                $model->updateAttributes(['last_updated' => date("Y-m-d")]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->layout = "main-mce";
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
        return $this->goBack();

        // $this->findModel($id)->delete();

        // return $this->redirect(['index']);
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

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
