<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\MemberProfessionalBody;
use app\models\VisitingScientistUniversityResearchCentre;

/** @var yii\web\View $this */
/** @var app\models\Activity $model */

$this->title = "Activities";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="activity-view">

    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">

                    <?php // Html::a(Yii::t('app', 'Create About Research'), ['create'], ['class' => 'btn btn-success']) 
                    ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="true">
                        <h5 class="roboto-medium header-title">Activity<br> </h5>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="member-professional-body-tab" data-bs-toggle="tab" data-bs-target="#member-professional-body" type="button" role="tab" aria-controls="member-professional-body" aria-selected="false">
                        <h5 class="roboto-medium header-title">Member Professional Body</h5>
                    </button>
                </li>

                <!-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="visiting-scientist-university-research-centre-tab" data-bs-toggle="tab" data-bs-target="#visiting-scientist-university-research-centre" type="button" role="tab" aria-controls="visiting-scientist-university-research-centre" aria-selected="false">
                        <h5 class="roboto-medium header-title">Visiting scientist<br>international university research centre</h5>
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="member_scientific_professional_body-tab" data-bs-toggle="tab" data-bs-target="#member_scientific_professional_body" type="button" role="tab" aria-controls="member_scientific_professional_body" aria-selected="false">
                        <h5 class="roboto-medium header-title">Member scientific/professional body</h5>
                    </button>
                </li> -->
            </ul>
            <div class="tab-content border border-top-0 rounded-bottom" id="myTabContent">
                <!-- activity -->
                <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                    <div class="px-4 pt-4 bd-highlight align-self-center float-end">
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="px-4 pb-4">
                        <?php echo $model->article ?>
                    </div>
                    <div>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'id',
                                // 'article:ntext',
                                'created_on:date',
                                [
                                    'attribute' => 'updated_on',
                                    'value' => $model->updated_on ? \Yii::$app->formatter->asDate($model->updated_on, 'long') : '',
                                ],
                                // 'remark_one',
                                // 'remark_two',
                            ],
                        ]) ?>
                    </div>
                </div>
                <!-- end activity -->

                <!-- member professional body -->
                <div class="tab-pane fade" id="member-professional-body" role="tabpanel" aria-labelledby="member-professional-body-tab">
                    <div class="pt-4 pe-4 bd-highlight align-self-center float-end">
                        <?= Html::button(Yii::t('app', 'Create Member Professional Body'), ['value' => Url::to(['member-professional-body/create']), 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalPL"]); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="px-4 pb-4">
                        <?php Pjax::begin([
                            "timeout" => false,
                            'id' => 'datatable-pjax'
                        ]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderMemberProfessionalBody,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                'title',
                                'article:ntext',
                                'status',
                                'created_on',
                                'updated_on',
                                //'remark_one',
                                //'remark_two',
                                [
                                    'class' => ActionColumn::class,
                                    'urlCreator' => function ($action, MemberProfessionalBody $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            return Html::button('View', [
                                                'value' => Url::toRoute(['member-professional-body/view', 'id' => $model->id]),
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
                                                'value' => Url::toRoute(['member-professional-body/update', 'id' => $model->id]),
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
                                                ['member-professional-body/delete', 'id' => $model->id],
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
                <!-- end member professional body -->

                <!-- Visiting scientist in international universities and research centre -->
                <div class="tab-pane fade" id="visiting-scientist-university-research-centre" role="tabpanel" aria-labelledby="visiting-scientist-university-research-centre-tab">
                    <div class="pt-4 pe-4 bd-highlight align-self-center float-end">
                        <?= Html::button(Yii::t('app', 'Create Visiting Scientist'), ['value' => Url::to(['visiting-scientist-university-research-centre/create']), 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalPL"]); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="px-4 pb-4">
                        <?php Pjax::begin([
                            "timeout" => false,
                            'id' => 'datatable-pjax'
                        ]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderVisitingScientistUniversityResearchCentre,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                'title',
                                'article:ntext',
                                'status',
                                'created_on',
                                'updated_on',
                                //'remark_one',
                                //'remark_two',
                                [
                                    'class' => ActionColumn::class,
                                    'urlCreator' => function ($action, VisitingScientistUniversityResearchCentre $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            return Html::button('View', [
                                                'value' => Url::toRoute(['member-professional-body/view', 'id' => $model->id]),
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
                                                'value' => Url::toRoute(['member-professional-body/update', 'id' => $model->id]),
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
                                                ['member-professional-body/delete', 'id' => $model->id],
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
                <!-- end Visiting scientist in international universities and research centre -->

                <!-- Member of the scientific/professional bodies -->
                <div class="tab-pane fade" id="member_scientific_professional_body" role="tabpanel" aria-labelledby="member_scientific_professional_body-tab">
                    <div class="pt-4 pe-4 bd-highlight align-self-center float-end">
                        <?= Html::button(Yii::t('app', 'Create Visiting Scientist'), ['value' => Url::to(['visiting-scientist-university-research-centre/create']), 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalPL"]); ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="px-4 pb-4">
                        <?php Pjax::begin([
                            "timeout" => false,
                            'id' => 'datatable-pjax'
                        ]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProviderVisitingScientistUniversityResearchCentre,
                            // 'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'id',
                                'title',
                                'article:ntext',
                                'status',
                                'created_on',
                                'updated_on',
                                //'remark_one',
                                //'remark_two',
                                [
                                    'class' => ActionColumn::class,
                                    'urlCreator' => function ($action, VisitingScientistUniversityResearchCentre $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'buttons' => [
                                        'view' => function ($url, $model, $key) {
                                            return Html::button('View', [
                                                'value' => Url::toRoute(['member-professional-body/view', 'id' => $model->id]),
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
                                                'value' => Url::toRoute(['member-professional-body/update', 'id' => $model->id]),
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
                                                ['member-professional-body/delete', 'id' => $model->id],
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
                <!-- end Member of the scientific/professional bodies -->
            </div>
        </div>
    </div>
</div>