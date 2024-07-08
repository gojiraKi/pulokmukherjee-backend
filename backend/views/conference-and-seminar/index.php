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
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-and-seminar-index">
    <div class="card shadow-sm">
        <div class="card-header card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                    <?php // echo Html::a(Yii::t('app', 'Create Conference And Seminar'), ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::button(Yii::t('app', 'Create Conference And Seminar'), ['value' => Url::to(['create']), 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalPL"]); ?>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php Pjax::begin([
                "timeout" => false,
                'id' => 'conference-and-seminar-form'
            ]); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'title',
                    'article:html',
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return $data->status == 10 ? 'Active' : 'Inactive';
                        }
                    ],
                    // 'created_on',
                    //'updated_on',
                    //'remark_one',
                    //'remark_two',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, ConferenceAndSeminar $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::button('View', [
                                    'value' => Url::toRoute(['conference-and-seminar/view', 'id' => $model->id]),
                                    'title' => "Conference and Seminar, ID: " . $model->id,
                                    'class' => 'btn btn-outline-success btn-sm showModalButton',
                                    'data' => [
                                        'bs-toggle' => "modal",
                                        'bs-target' => "#modalPL"
                                    ]
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::button('Update', [
                                    'value' => Url::toRoute(['conference-and-seminar/update', 'id' => $model->id]),
                                    'title' => "Update Conference and Seminar, ID: " . $model->id,
                                    'class' => 'btn btn-outline-primary btn-sm showModalButton',
                                    // 'onclick' => 'updateForm()',
                                    'data' => [
                                        'bs-toggle' => "modal",
                                        'bs-target' => "#modalPL"
                                    ]
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a(
                                    'Delete',
                                    ['conference-and-seminar/delete', 'id' => $model->id],
                                    [
                                        'title' => "Delete",
                                        'class' => 'btn btn-outline-danger btn-sm',
                                        'data' => [
                                            'pjax' => "0",
                                            'confirm' => "Are you sure you want to delete this item?",
                                            'method' => "post"
                                        ]
                                    ]
                                );
                            },
                        ]
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>