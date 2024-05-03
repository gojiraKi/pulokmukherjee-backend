<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MemberScientificProfessionalBodySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="member-scientific-professional-body-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'created_on') ?>

    <?= $form->field($model, 'updated_on') ?>

    <?php // echo $form->field($model, 'remark_one') ?>

    <?php // echo $form->field($model, 'remark_two') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
