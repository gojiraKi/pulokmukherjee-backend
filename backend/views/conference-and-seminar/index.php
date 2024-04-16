<?php

use app\models\ConferenceAndSeminar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminarSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Conference And Seminars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-and-seminar-index">
    <div class="card">
        <div class="card-header card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                    <?= Html::a(Yii::t('app', 'Create Conference And Seminar'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                'title',
                'article:html',
                'status',
                // 'created_on',
                //'updated_on',
                //'remark_one',
                //'remark_two',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, ConferenceAndSeminar $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
        </div>
    </div>
</div>
