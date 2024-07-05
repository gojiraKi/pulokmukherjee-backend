<?php

use app\models\Lecture;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\LectureSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lectures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-index">

    <div class="card">
        <div class="card-header card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                    <?php // echo Html::a(Yii::t('app', 'Create Lecture'), ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::button(Yii::t('app', 'Create Lecture'), ['value' => Url::to(['create']), 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modalPL"]); ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?php Pjax::begin([
            "timeout" => false,
            'id' => 'datatable-pjax'
        ]); ?>
            <!-- <div class="p-3 border mb-3">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            </div> -->
        

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'pager' => ['class' => \yii\bootstrap5\LinkPager::class],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                // 'id',
                // 'lecture_type',
                [
                    'attribute' => 'lecture_type',
                    'value' => function ($data) {
                        return \app\models\Lecture::LectureType($data->lecture_type); 
                    },
                    'filter' => ['1' => 'International', '2' => 'National'],
                    'filterInputOptions' => ['prompt' => '---Select---', 'class' => 'form-control', 'id' => null]
                ],
                // 'title',
                // 'article:html',
                [
                    'attribute' => "content",
                    'format' => 'html',
                    'value' => function ($data) {
                        return "<p><strong>" . $data->title . "</strong> " . $data->article . "</p>";
                    }
                ],
                'created_on',
                //'updated_on',
                //'remark_one',
                //'remark_two',
                [
                    'class' => ActionColumn::class,
                    // 'urlCreator' => function ($action, Lecture $model, $key, $index, $column) {
                    //     return Url::toRoute([$action, 'id' => $model->id]);
                    // },
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::button('View', [
                                'value' => Url::toRoute(['lecture/view', 'id' => $model->id]),
                                'title' => "View Book Contributed, ID: " . $model->id,
                                'class' => 'btn btn-outline-success btn-sm showModalButton',
                                'data' => [
                                    'bs-toggle' => "modal",
                                    'bs-target' => "#modalPL"
                                ]
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::button('Update', [
                                'value' => Url::toRoute(['lecture/update', 'id' => $model->id]),
                                'title' => "Update Book Contributed, ID: " . $model->id,
                                'class' => 'btn btn-outline-primary btn-sm showModalButton',
                                'data' => [
                                    'bs-toggle' => "modal",
                                    'bs-target' => "#modalPL"
                                ]
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('Delete', 
                                ['lecture/delete', 'id' => $model->id],
                                [
                                    'title' => "Delete",
                                    'class' => 'btn btn-outline-danger btn-sm',
                                    'data' => [
                                        'pjax' => "0",
                                        'confirm' => "Are you sure you want to delete this item?",
                                        'method' => "post"
                                    ]
                                ]);
                        },
                    ]
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).on("pjax:beforeSend",function(){
    const container = document.querySelector("#w0");
    // const divLoading = "<div class='pjax-loading'></div>";
    // container.innerHTML = divLoading;
    const loadingDiv = document.createElement("div");
    loadingDiv.className = "pjax-loading";
    container.appendChild(loadingDiv);
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
