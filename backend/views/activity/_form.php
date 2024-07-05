<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\Activity $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6]) ?>

    <div class="form-group mt-3 d-grid col-6 mx-auto">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
	$(document).ready(function(){
		tinymce.init({
            selector: '#activity-article',
            height: 700
        });
        
	});
JS;
$this->registerJs($script, View::POS_READY);
?>
