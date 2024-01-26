<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-programme-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-8">
        <?= $form->field($model, "imageFile")->widget(FileInput::class,[
            //'id' => 'fileImage',
            'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
            'pluginOptions'=>[
                'initialPreview'=>[
                    $model->photo,
                ],
                'initialPreviewAsData' => true,
                'allowedFileExtensions'=>['jpg', 'jpeg', 'png'],
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
        <div class="col-lg-4">
        <?= $form->field($model, 'caption')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
