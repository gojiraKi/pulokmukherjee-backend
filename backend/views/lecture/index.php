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
                    <?= Html::a(Yii::t('app', 'Create Lecture'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?php Pjax::begin([
            "timeout" => false
        ]); ?>
            <!-- <div class="p-2 border rounded">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            </div> -->
        

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
                'title',
                'article:html',
                'created_on',
                //'updated_on',
                //'remark_one',
                //'remark_two',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, Lecture $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
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
