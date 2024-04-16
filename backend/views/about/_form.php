<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;
use yii\web\View;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\About $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row gx-2">
        <div class="col-md-4">
        <?= $form->field($model, "file")->widget(FileInput::class,[
            //'id' => 'fileImage',
            'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
            'pluginOptions'=>[
                'initialPreview'=>[
                    $model->photo,
                ],
                'initialPreviewAsData' => true,
                'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
                'showUpload' => false,
                //'showRemove' => false,
                'mainClass' => 'input-group-lg',
                //'browseClass' => 'btn btn-success',
                //'uploadClass' => 'btn btn-info',
                'removeClass' => 'btn btn-warning',
                'cancelClass' => 'btn btn-success',
                'removeIcon' => '<i class="fas fa-trash"></i> ',
                //'browseClass' => 'btn btn-primary btn-block',
                'browseIcon' => '<i class="fas fa-camera"></i> ',
                'browseLabel' =>  'Select Photo',
                'maxFileSize' => 1024
            ],
        ])->label(false); ?>
        </div>

        <div class="col-md-8 p-2 border rounded">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_one')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_two')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_three')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_four')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_five')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_six')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'field_seven')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email_one') ?>

        <?= $form->field($model, 'email_two') ?>
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
            selector: '#about-article',
            height: 700
        });
        
	});
JS;
$this->registerJs($script, View::POS_READY);
?>
