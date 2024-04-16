<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\BookAuthored $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-authored-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'book_art')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, "imageFile")->widget(FileInput::class,[
        //'id' => 'fileImage',
        'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
        'pluginOptions'=>[
            'initialPreview'=>[
                $model->book_art,
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

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
