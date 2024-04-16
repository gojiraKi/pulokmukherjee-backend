<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AboutResearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-research-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'id' => 'create-about-research-form'
        ]
    ]); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
