<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\About $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_one')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_two')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_three')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_four')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_five')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_six')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'field_seven')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'remark_one')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark_two')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
