<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */

$this->title = 'Create Bulk Outreach Programme';
$this->params['breadcrumbs'][] = ['label' => 'Outreach Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outreach-programme-create card bg-white rounded shadow p-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formBulk', [
        'models' => $models,
    ]) ?>

</div>
