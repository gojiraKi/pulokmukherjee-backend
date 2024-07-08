<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Media */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="media-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'file_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, "file")->widget(FileInput::class,[
            //'id' => 'fileImage',
            'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
            'pluginOptions'=>[
                'initialPreview'=>[
                    $model->url,
                ],
                'initialPreviewAsData' => true,
                'allowedFileExtensions'=>['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'],
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
                'maxFileSize' => 1024
            ],
        ])->label(false); ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
