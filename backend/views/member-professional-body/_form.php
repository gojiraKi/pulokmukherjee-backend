<?php

// use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
// use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\MemberProfessionalBody $model */
/** @var yii\widgets\ActiveForm $form */
$form_name = "member-professional-body-form";
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
        <div class="col-md-9">
            <?= $form->field($model, 'title')->textInput(['class' => 'form-control title_input', 'maxlength' => true]) ?>
        </div>
        <div class="col-md-3">

            <?= $form->field($model, 'status')->dropDownList(['9' => 'Inactive', '10' => 'Active'], ['prompt' => '--- Select ---']) ?>
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
    <span class="roboto-medium">${document.querySelector('#memberprofessionalbody-title').value ?? ''}</span>
    ${document.querySelector('#memberprofessionalbody-article').value ?? ''}
    </p>`;
    }
    // console.log(document.querySelector("#memberprofessionalbody-title").value);
    // let temp = document.querySelector("#memberprofessionalbody-title").value;
    // document.querySelector('#frontend_view').innerHTML = `<p>
    // <strong>${document.querySelector('#memberprofessionalbody-title').value ?? ''}</strong>
    // ${document.querySelector('#memberprofessionalbody-article').value ?? ''}
    // </p>`;

    document.querySelector('#memberprofessionalbody-title').addEventListener('keyup', function(){
        frontendView();
    });

    document.querySelector('#memberprofessionalbody-article').addEventListener('keyup', function(){
        frontendView();
    });

    frontendView();
</script>