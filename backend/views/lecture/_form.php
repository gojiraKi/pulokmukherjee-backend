<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lecture-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'ajax-form'
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'lecture_type')->dropDownList(\app\models\Lecture::getLecture(), ['prompt' => ' --Select-- ']) ?>
        </div>

        <div class="col-md-9">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(\app\models\Lecture::getStatus(), ['prompt'=>' --Select-- ']) ?>

    <!-- <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
<?php
// $script = <<< JS
//     tinymce.init({
//         selector: '#lecture-article',
//         height: 300
//     });   
// JS;
// $this->registerJs($script, View::POS_LOAD);
?>