<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-programme-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>  
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 10, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $models[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'photo',
                'caption',
                'status',
            ],
        ]); ?>

        <div class="container-items row"><!-- widgetContainer -->
        <?php foreach ($models as $i => $model): ?>
            <div class="item card card-primary mb-3 col-lg-6"><!-- widgetBody -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="card-title pull-left">Photo</h3>
                        </div>
                        <div class="col-lg-4">
                            <div class="float-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="fas fa-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <!-- <div class="clearfix"></div> -->
                </div>
                <div class="card-body">
                    <?php
                        // necessary for update action.
                        if (! $model->isNewRecord) {
                            echo Html::activeHiddenInput($model, "[{$i}]id");
                        }
                    ?>
                    <?php // $form->field($model, "[{$i}]photo")->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, "[{$i}]imageFile")->widget(FileInput::class,[
					//'id' => 'fileImage',
					'options' => ['accept' => 'image/*', 'id' => 'fileImage'],
					'pluginOptions'=>[
						'initialPreview'=>[
							$model->photo,
						],
						'initialPreviewAsData' => true,
						'allowedFileExtensions'=>['jpg', 'jpeg', 'png'],
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
                    <?= $form->field($model, "[{$i}]caption")->textInput(['maxlength' => true]) ?>
                    
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php DynamicFormWidget::end(); ?>

    <?php ActiveForm::end(); ?>

</div>
