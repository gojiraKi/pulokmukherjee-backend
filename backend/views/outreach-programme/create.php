<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */

$this->title = 'Create Outreach Programme';
$this->params['breadcrumbs'][] = ['label' => 'Outreach Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outreach-programme-create">

    <div class="p-2 rounded shadow bg-white mb-3">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <?= $this->render('_formCreate', [
        'models' => $models,
    ]) ?>

</div>
