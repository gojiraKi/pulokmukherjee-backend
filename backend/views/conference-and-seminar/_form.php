<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
// use kartik\date\DatePicker;
use kartik\select2\Select2;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminar $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="conference-and-seminar-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-10">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
        <?= $form->field($model, 'status')->widget(Select2::class, [
                'data'  => ['9' => 'Inactive', '10' => 'Active'],
                //'language' => 'en',
                'options' => ['placeholder' => 'Select...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        </div>
    </div>

    <?= $form->field($model, 'article')->widget(Summernote::class, [
        'enableFullScreen' => true,
        'options' => ['placeholder' => 'Edit your article content here...'],
        'pluginOptions' => [
            'height' => 200,
            'toolbar' => [
                // ['style1', ['style']],
                ['style2', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript']],
                ['font', ['fontname', 'fontsize', 'color', 'clear']],
                // ['para', ['ul', 'ol', 'paragraph', 'height']],
                // ['insert', ['link', 'picture', 'video', 'table', 'hr']],
            ],
        ],
        'container' => [
            'class' => 'kv-editor-container',
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
