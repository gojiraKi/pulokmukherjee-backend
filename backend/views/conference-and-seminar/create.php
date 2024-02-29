<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminar $model */

$this->title = Yii::t('app', 'Create Conference And Seminar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conference And Seminars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-and-seminar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
