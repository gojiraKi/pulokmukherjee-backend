<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Media */
?>
<div class="media-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'file_name',
            'file_type',
            'url:url',
            // 'created_on',
        ],
    ]) ?>

</div>
