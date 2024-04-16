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

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-2">
        <?= $form->field($model, 'lecture_type')->widget(Select2::class, [
                'data'  => ['1' => 'International', '2' => 'National'],
                //'language' => 'en',
                'options' => ['placeholder' => 'Select...'],
                'pluginOptions' => [
                    // 'allowClear' => true
                ],
            ]);
        ?>
        </div>

        <div class="col-md-10">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
	$(document).ready(function(){
		tinymce.init({
            selector: '#lecture-article',
            height: 300
        });
        
	});
JS;
$this->registerJs($script, View::POS_READY);
?>
