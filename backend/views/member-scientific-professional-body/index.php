<?php

use app\models\MemberScientificProfessionalBody;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MemberScientificProfessionalBodySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Member Scientific Professional Bodies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-scientific-professional-body-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Member Scientific Professional Body'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article:ntext',
            'status',
            'created_on',
            'updated_on',
            //'remark_one',
            //'remark_two',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MemberScientificProfessionalBody $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
