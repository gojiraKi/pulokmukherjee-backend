<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
// use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
// use kartik\date\DatePicker;
use kartik\select2\Select2;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="conference-and-seminar-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-10">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
        
        <?= $form->field($model, 'status')->dropDownList(['9' => 'Inactive', '10' => 'Active'], ['prompt'=>' Select']) ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?php // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
