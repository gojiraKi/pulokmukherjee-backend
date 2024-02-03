<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
FontAwesomeAsset::register($this);

/** @var yii\web\View $this */
/** @var app\models\Publications $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="publications-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
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
                'year',
                'authors',
                'title',
                'published_to',
                'link',
            ],
        ]); ?>

        <div class="container-items"><!-- widgetContainer -->

        <?php foreach ($models as $i => $model): ?>
            <div class="item mb-3"><!-- widgetBody -->
                <div class="card card-primary px-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="card-title float-left h4 mb-0">Publication</p>
                            </div>
                            <div class="col-lg-6">
                                <div class="float-right">
                                    <button type="button" class="add-item btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-sm"><i class="fas fa-minus"></i></button>
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
                        <?php // $form->field($model, "[{$i}]year")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-lg-4">
                            <?php
                                $data = \app\models\Publications::PublicationYears();
                                // Prepare the array, which you already do
                                $yearRange = \yii\helpers\ArrayHelper::map($data, 'id', 'range',);
                                // Prepare the extras array, where all extra data will be
                                // $categoryTypeData = [];
                                // foreach ( $categories as $category ) {
                                // 	$categoryTypeData[$category['id']] = ['data-required' => $category['remark_one']];
                                // }
                            ?>
                            <?= $form->field($model, "[{$i}]year")->widget(Select2::class, [
                                'data'  => $yearRange,
                                'language' => 'en',
                                'options' => [
                                    'placeholder' => 'Select Year',
                                    // 'options' => $categoryTypeData,
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]);
                            ?>
                            </div>
                        </div>
                        
                        <?= $form->field($model, "[{$i}]authors")->textInput(['maxlength' => true, 'id' => $i . "-authorEditor"]) ?>
                                             
                        
                        <?= $form->field($model, "[{$i}]title")->textInput(['maxlength' => true]) ?>

                        <div class="row">
                            <div class="col-lg-6">
                            <?= $form->field($model, "[{$i}]published_to")->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class="col-lg-6">
                            <?= $form->field($model, "[{$i}]link")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>                     
                    </div>
                </div><!--  end card -->
            </div><!-- end widgetBody -->
        <?php endforeach; ?>
        </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    $(document).ready(function() {
        $('#authorEditor').summernote();
    });

    $(".dynamicform_wrapper").on("beforeInsert", function(e, item, index) {
        console.log(item.index);
    });

    $(".dynamicform_wrapper").on("afterInsert", function(e, item, index) {
        console.log(item.index);
    });
JS;
$this->registerJs($script);
?>
