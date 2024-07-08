<?php

// use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PhdProjectOngoing $model */
/** @var yii\widgets\ActiveForm $form */
$form_name = "phd-project-ongoing-form";
?>

<div class="<?= $form_name ?>">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
            // 'id' => $form_name
        ]
    ]); ?>

    <input type="hidden" name="form_name" id="form-name" value="<?= $form_name ?>">

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(['9' => 'Inactive', '10' => 'Active'], ['prompt' => '--- Select ---']) ?>
        </div>
    </div>

    <?= $form->field($model, 'title')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?php // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) 
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>