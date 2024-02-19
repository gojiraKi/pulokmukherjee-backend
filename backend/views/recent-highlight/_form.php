<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
use kartik\date\DatePicker;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\RecentHighlight $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recent-highlight-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
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
