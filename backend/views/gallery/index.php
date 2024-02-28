<?php

use app\models\Gallery;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\GallerySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Galleries');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2 flex-grow-1 bd-highlight">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-2 bd-highlight align-self-center">
                    <?= Html::a(Yii::t('app', 'Add Photo to Gallery'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                // 'photo',
                'photo_thmb',
                // 'photo_frnt',
                'caption',
                //'alt_text',
                //'file_absolute_path',
                //'remark_one',
                //'remark_two',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Gallery $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
        </div>
    </div>
</div>
