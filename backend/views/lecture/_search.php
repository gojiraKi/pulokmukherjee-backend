<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LectureSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="lecture-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-2"><?= $form->field($model, 'lecture_type')->dropDownList(\app\models\Lecture::getLecture(), ['prompt' => ' --Select-- ']) ?></div>

        <div class="col-md-8"><?= $form->field($model, 'content') ?></div>

        <div class="form-group col-md-2">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
