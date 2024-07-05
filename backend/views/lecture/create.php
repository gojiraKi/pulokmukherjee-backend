<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */

$this->title = Yii::t('app', 'Create Lecture');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lectures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
