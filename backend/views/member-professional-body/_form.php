<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MemberProfessionalBody $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="member-professional-body-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-9">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        
        <?= $form->field($model, 'status')->dropDownList(['9' => 'Inactive', '10' => 'Active'], ['prompt'=>'--- Select ---']) ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?php // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
