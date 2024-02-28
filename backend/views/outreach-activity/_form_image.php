<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\helpers\Url;
//use wbraganca\dynamicform\DynamicFormWidget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="card card-info mt-2">
    <div class="card-header">
        <i class="fa fa-envelope"></i>
        <?php if ($model->isNewRecord) { ?> 
            Select Images
        <?php } else { ?> 
            Add More Images
        <?php } ?>
    </div>

    <div class="card-body container-items">
                
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
            
    </div>
</div>
