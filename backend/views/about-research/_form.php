<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\AboutResearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-research-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
        ]
    ]); ?>

    <?php $temp = \app\models\AboutResearch::getStatus(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'status')->dropDownList(\app\models\AboutResearch::getStatus(), ['prompt'=>' --Select-- ']) ?>

    <!-- <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-form']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
