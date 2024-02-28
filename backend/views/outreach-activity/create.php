<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OutreachActivity $model */

$this->title = Yii::t('app', 'Create Outreach Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outreach Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outreach-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
