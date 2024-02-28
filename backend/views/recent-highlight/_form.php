<?php

// use app\models\RecentHighlight;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
// use kartik\date\DatePicker;
use kartik\select2\Select2;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\RecentHighlight $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recent-highlight-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row border rounded mb-4">
        <div class="col-md-10">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
        <?php if (!$model->isNewRecord) { ?> 
        <?= $form->field($model, 'status')->widget(Select2::class, [
                'data'  => ['8' => 'Draft', '9' => 'Archived', '10' => 'Published'],
                //'language' => 'en',
                'options' => ['placeholder' => 'Select...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
        <?php } ?>
        </div>
    </div>
    
    <div style="height: 700px;">
    <?= $form->field($model, 'article')->widget(Summernote::class, [
        'enableFullScreen' => true,
        'options' => ['placeholder' => 'Edit your blog content here...'],
        'pluginOptions' => [
            'height' => 600,
        ],
        'container' => [
            'class' => 'kv-editor-container',
        ],
    ]); ?>
    </div>
    

    <?php // $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
