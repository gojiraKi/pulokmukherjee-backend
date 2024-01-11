<?php

use backend\models\About;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AboutSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Abouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card p-2 shadow-sm col-6 mx-auto text-center">
        <p class="display-1">
            Hi!
        </p>
        <p class="display-4">
            Create a new bio here!
        </p>
        <p>
        <?= Html::a('Create Bio', ['create'], ['class' => 'btn btn-success col-6 mx-auto mt-4']) ?>
        </p>
    </div>



</div>
