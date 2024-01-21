<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="outreach-programme-form">

    <?php $form = ActiveForm::begin(); ?>
    <div id="dynamicDivsContainer" class="row gx-4">
        <button id="addFormButton" class="btn btn-info">Add New Form</button>
        <?php foreach ($models as $i => $model) { ?>
        <div class="col-lg-6">
        <?= $form->field($model, "[{$i}]photo")->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, "[{$i}]caption")->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, "[{$i}]status")->textInput() ?>
        </div>
        <?php } ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script>
        // Assuming you have an array of models in JavaScript
        const models = [
            { photo: 'Photo1', caption: 'Caption1', status: 'Status1' },
            { photo: 'Photo2', caption: 'Caption2', status: 'Status2' },
            // Add more model data as needed
        ];

        // Function to generate a dynamic div for each model
        function generateDynamicDiv(model) {
            const container = document.getElementById('dynamicDivsContainer');
            const newDiv = document.createElement('div');
            newDiv.className = 'col-lg-6';

            // Customize the content based on the model properties
            newDiv.innerHTML = `
                <?= $form->field($model, "[{$i}]photo")->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, "[{$i}]caption")->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, "[{$i}]status")->textInput() ?>
            `;

            container.appendChild(newDiv);
        }

        // Function to handle the "Add New Form" button click
        function handleAddFormClick() {
            const newModel = { photo: '', caption: '', status: '' };
            generateDynamicDiv(newModel);
        }

        // Loop through the models array and generate dynamic divs
        models.forEach(model => {
            generateDynamicDiv(model);
        });

        // Add an event listener for the "Add New Form" button
        document.getElementById('addFormButton').addEventListener('click', handleAddFormClick);
    </script>

</div>
