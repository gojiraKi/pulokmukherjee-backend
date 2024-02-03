<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gallery */
?>
<div class="gallery-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'photo',
            'photo_thmb',
            'photo_frnt',
            'caption',
            'alt_text',
            'remark_one',
            'remark_two',
        ],
    ]) ?>

</div>
