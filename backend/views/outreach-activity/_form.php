<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OutreachActivity $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-activity-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'dynamic-form'
        ]
    ]); ?>

    <div class="row mb-4">
        <div class="col-md-10">
        <?= $form->field($model, 'activity_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
        <?= $form->field($model, 'remark_one')->textInput(['maxlength' => true, 'placeholder' => "YYYY-MM-DD"]) ?>
        </div>
    </div>
    
    <?php echo $this->render('_form_image', [
        'form' => $form,
        'model' => $model,
    ]); ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>

</div>
