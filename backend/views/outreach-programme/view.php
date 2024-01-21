<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OutreachProgramme */
?>
<div class="outreach-programme-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'photo',
            'thmb_photo',
            'caption',
            'status',
            'remark_one',
            'remark_two',
        ],
    ]) ?>

</div>
