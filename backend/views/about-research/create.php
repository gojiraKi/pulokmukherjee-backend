<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AboutResearch $model */

$this->title = Yii::t('app', 'Create About Research');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About'), 'url' => ['about/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'About'), 'url' => ['about/view', 'id' => 1]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-research-create">

    <div class="card">
        <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>

</div>
