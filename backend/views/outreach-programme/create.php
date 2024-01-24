<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */

$this->title = 'Create Outreach Programme';
$this->params['breadcrumbs'][] = ['label' => 'Outreach Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outreach-programme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
