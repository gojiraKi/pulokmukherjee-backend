<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgrammeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-programme-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'photo') ?>

    <?= $form->field($model, 'thmb_photo') ?>

    <?= $form->field($model, 'caption') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark_one') ?>

    <?php // echo $form->field($model, 'remark_two') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
