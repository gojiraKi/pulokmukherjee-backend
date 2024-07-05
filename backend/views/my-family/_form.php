<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\MyFamily $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="my-family-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article')->textarea(['rows' => 6])->label(false) ?>

    <div class="form-group mt-3 d-grid col-6 mx-auto">
        <?php echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    function tinyEditor(){
        tinymce.init({
            selector: '#myfamily-article',
            height: 700
        });
    }

    tinyEditor();
    
JS;
$this->registerJs($script, View::POS_READY);
?>