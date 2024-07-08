<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MemberScientificProfessionalBody $model */
/** @var yii\widgets\ActiveForm $form */
$form_name = "member-scientific-professional-body-form";
?>

<div class="member-scientific-professional-body-form">

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
    ${document.querySelector('#memberscientificprofessionalbody-article').value ?? ''}
    </p>`;
    }

    document.querySelector('#memberscientificprofessionalbody-article').addEventListener('keyup', function(){
        frontendView();
    });

    frontendView();
</script>
