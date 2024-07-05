<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var app\models\MyFamilyPhoto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="my-family-photo-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'family-form'
        ]
    ]); ?>

    <?php echo FileInput::widget([
            'model' => $model,
            'attribute' => 'imageFiles[]',
            'name' => 'imageFiles[]',
            'options' => ['multiple' => true],

            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'jpeg', 'png'],
                'showUpload' => false,
            ],
    ]);  ?>

    <div class="form-group mt-3 d-grid col-6 mx-auto">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
