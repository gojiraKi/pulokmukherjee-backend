<?php

use app\models\RecentHighlight;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\RecentHighlightSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Recent Highlights');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recent-highlight-index">
    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2 flex-grow-1 bd-highlight">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-2 bd-highlight align-self-center">
                    <?= Html::a(Yii::t('app', 'Create Recent Highlight'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'title',
                // 'article:html',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        $status = [
                            '8' => 'Draft',
                            '9' => 'Archived',
                            '10' => 'Published'
                        ];
                        return $status[$data->status];
                    }
                ],
                'created_on',
                //'updated_on',
                //'remark_one',
                //'remark_two',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, RecentHighlight $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
        </div>
    </div>
</div>
