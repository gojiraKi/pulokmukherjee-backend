<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */

$this->title = 'Update Outreach Programme: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Outreach Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outreach-programme-update">

    <div class="p-2 rounded shadow bg-white mb-3">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="card">
        <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>
</div>
