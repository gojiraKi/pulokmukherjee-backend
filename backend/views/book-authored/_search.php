<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\BookAuthoredSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-authored-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'book_art') ?>

    <?= $form->field($model, 'author') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'book_art_path') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <?php // echo $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'remark_one') ?>

    <?php // echo $form->field($model, 'remarl_two') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
