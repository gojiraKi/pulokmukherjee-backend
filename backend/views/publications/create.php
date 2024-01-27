<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Publications $model */

$this->title = Yii::t('app', 'Create Publications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
