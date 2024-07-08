<?php

use app\models\PhdProjectOngoing;
use app\models\PhdProjectCompleted;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Phd Project');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="phd-project-index">

    <div class="card">
        <div class="card-header card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="phd_project_ongoing-tab" data-bs-toggle="tab" data-bs-target="#phd_project_ongoing" type="button" role="tab" aria-controls="phd_project_ongoing" aria-selected="true">
                        <h4 class="roboto-medium header-title">Phd Project Ongoing</h4>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="phd_project_completed-tab" data-bs-toggle="tab" data-bs-target="#phd_project_completed" type="button" role="tab" aria-controls="phd_project_completed" aria-selected="false">
                        <h4 class="roboto-medium header-title">Phd Project Completed</h4>
                    </button>
                </li>
            </ul>

            <div class="tab-content border border-top-0 rounded-bottom p-2" id="myTabContent">
                <!-- phd project ongoing -->
                <div class="tab-pane fade show active" id="phd_project_ongoing" role="tabpanel" aria-labelledby="phd_project_ongoing-tab">
                    <div class="px-2 pt-4 bd-highlight align-self-center float-end">
                        <?php echo Html::button('Create Phd Project Ongoing', [
                                            'value' => Url::toRoute(['phd-project-ongoing/create']),
                                            'title' => "Create Phd Project Ongoing",
                                            'class' => 'btn btn-success showModalButton',
                                            'data' => [
                                                'bs-toggle' => "modal",
                                                'bs-target' => "#modalPL"
                                            ]
                                        ]) ?>
                    </div>
                    <div class="clearfix"></div>

                    <?php Pjax::begin([
                            "timeout" => false,
                            'id' => 'phd-project-ongoing-form'
                        ]); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPhdProjectOngoing,
                        // 'filterModel' => $searchModel,
                        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'title:ntext',
                            'status',
                            'created_on',
                            'updated_on',
                            //'remark_one',
                            //'remark_two',
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, PhdProjectOngoing $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::button('View', [
                                            'value' => Url::toRoute(['phd-project-ongoing/view', 'id' => $model->id]),
                                            'title' => "Phd Project Ongoing, ID: " . $model->id,
                                            'class' => 'btn btn-outline-success btn-sm showModalButton',
                                            'data' => [
                                                'bs-toggle' => "modal",
                                                'bs-target' => "#modalPL"
                                            ]
                                        ]);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        return Html::button('Update', [
                                            'value' => Url::toRoute(['phd-project-ongoing/update', 'id' => $model->id]),
                                            'title' => "Update Phd Project Ongoing, ID: " . $model->id,
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
                                            ['phd-project-ongoing/delete', 'id' => $model->id],
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
                <!-- end phd project ongoing -->

                <!-- phd project completed -->
                <div class="tab-pane fade" id="phd_project_completed" role="tabpanel" aria-labelledby="phd_project_completed-tab">
                    <div class="px-2 pt-4 bd-highlight align-self-center float-end">
                        <?php echo Html::button('Create Phd Project Completed', [
                                            'value' => Url::toRoute(['phd-project-completed/create']),
                                            'title' => "Create Phd Project Completed",
                                            'class' => 'btn btn-success showModalButton',
                                            'data' => [
                                                'bs-toggle' => "modal",
                                                'bs-target' => "#modalPL"
                                            ]
                                        ]) ?>
                    </div>
                    <div class="clearfix"></div>
                    <?php Pjax::begin([
                            "timeout" => false,
                            'id' => 'phd-project-completed-form'
                        ]); ?>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); 
                    ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProviderPhdProjectCompleted,
                        // 'filterModel' => $searchModel,
                        'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            'title:ntext',
                            'status',
                            'created_on',
                            'updated_on',
                            //'remark_one',
                            //'remark_two',
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, PhdProjectCompleted $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                },
                                'buttons' => [
                                    'view' => function ($url, $model, $key) {
                                        return Html::button('View', [
                                            'value' => Url::toRoute(['phd-project-completed/view', 'id' => $model->id]),
                                            'title' => "Phd Project Ongoing, ID: " . $model->id,
                                            'class' => 'btn btn-outline-success btn-sm showModalButton',
                                            'data' => [
                                                'bs-toggle' => "modal",
                                                'bs-target' => "#modalPL"
                                            ]
                                        ]);
                                    },
                                    'update' => function ($url, $model, $key) {
                                        return Html::button('Update', [
                                            'value' => Url::toRoute(['phd-project-completed/update', 'id' => $model->id]),
                                            'title' => "Update Phd Project Ongoing, ID: " . $model->id,
                                            'class' => 'btn btn-outline-primary btn-sm showModalButton',
                                            'data' => [
                                                'bs-toggle' => "modal",
                                                'bs-target' => "#modalPL"
                                            ]
                                        ]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a(
                                            'Delete',
                                            ['phd-project-completed/delete', 'id' => $model->id],
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
                <!-- end phd project completed -->
            </div>
        </div>
    </div>
</div>