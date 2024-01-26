<?php

use app\models\OutreachProgramme;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\OutreachProgrammeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Outreach Programmes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outreach-programme-index">

    <div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2 flex-grow-1 bd-highlight"><h1><?= Html::encode($this->title) ?></h1></div>
                <div class="p-2 bd-highlight align-self-center"><?= Html::a('Create Outreach Programme', ['create'], ['class' => 'btn btn-success']) ?></div>
            </div>
        </div>

        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
                    // 'photo',
                    // 'thmb_photo',
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'photo',
                        'format' => 'raw',
                        'hAlign' => 'center',
                        'vAlign' => 'center',
                        'value' => function ($model) {
                            $photo = Yii::getAlias('@front') . '/' .$model->thmb_photo;
                            return '<div><img class="img-fluid" src="' . $photo .'"></div>';
                        }
                    ],
                    'caption',
                    'status',
                    //'remark_one',
                    //'remark_two',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, OutreachProgramme $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
                'panel' => [
                    'type' => GridView::TYPE_SECONDARY
                ],
                'bordered' => true,
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
