<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OutreachActivitySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_name') ?>

    <?= $form->field($model, 'slug') ?>

    <?= $form->field($model, 'created_on') ?>

    <?= $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'remark_one') ?>

    <?php // echo $form->field($model, 'remark_two') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
