<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AboutResearch $model */

$this->title = Yii::t('app', 'Update About Research: {name}', [
    'name' => $model->title,
]);
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About Researches'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About'), 'url' => ['about/view', 'id' => 1]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="about-research-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
