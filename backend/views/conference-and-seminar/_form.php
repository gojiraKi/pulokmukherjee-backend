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
$form_name = "conference-and-seminar-form";
?>

<div class="<?= $form_name ?>">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
        ]
    ]); ?>

    <input type="hidden" name="form_name" id="form-name" value="<?= $form_name ?>">

    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">

            <?= $form->field($model, 'status')->dropDownList(['9' => 'Inactive', '10' => 'Active'], ['prompt' => ' Select']) ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->textarea(['rows' => '6']) ?>

    <div class="form-group">
        <?php // echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) 
        ?>
    </div>

    <?php ActiveForm::end(); ?>

    <hr class="mt-2">
    <div class="p-2 rounded bg-light">
        <p class="font-blueish-grey roboto-medium">Frontend View:</p>
        <p id="frontend_view" class="font-color"></p>
    </div>

</div>

<script>
    function frontendView() {
        document.querySelector('#frontend_view').innerHTML = `<p>
    <span class="roboto-medium">${document.querySelector('#conferenceandseminar-title').value ?? ''}</span>
    ${document.querySelector('#conferenceandseminar-article').value ?? ''}
    </p>`;
    }

    document.querySelector('#conferenceandseminar-title').addEventListener('keyup', function() {
        frontendView();
    });

    document.querySelector('#conferenceandseminar-article').addEventListener('keyup', function() {
        frontendView();
    });

    frontendView();
</script>