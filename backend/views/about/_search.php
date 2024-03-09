<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AboutSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'photo') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'qualification') ?>

    <?= $form->field($model, 'field_one') ?>

    <?php // echo $form->field($model, 'field_two') ?>

    <?php // echo $form->field($model, 'field_three') ?>

    <?php // echo $form->field($model, 'field_four') ?>

    <?php // echo $form->field($model, 'field_five') ?>

    <?php // echo $form->field($model, 'field_six') ?>

    <?php // echo $form->field($model, 'field_seven') ?>

    <?php // echo $form->field($model, 'article') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'remark_one') ?>

    <?php // echo $form->field($model, 'remark_two') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
