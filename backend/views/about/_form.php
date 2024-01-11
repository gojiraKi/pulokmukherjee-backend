<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\editors\Summernote;

/** @var yii\web\View $this */
/** @var app\models\About $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'bio_photo')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm p-2">
            <?= $form->field($model, "imageFile")->widget(FileInput::class,[
                //'id' => 'fileImage',
                'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
                'pluginOptions'=>[
                    'initialPreview'=>[
                        $model->bio_photo,
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
                    // 'maxFileSize' => 256
                ],
            ])->label(false); ?>
            </div>
        
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm p-2">
            <?= $form->field($model, 'article')->widget(Summernote::class, [
                'options' => ['placeholder' => 'Edit your blog content here...']
            ])->label(false); ?>

            </div>
            <?php // $form->field($model, 'article')->textarea(['rows' => 6]) ?>

            <div class="form-group mt-4">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success col-6 mx-auto float-end']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
