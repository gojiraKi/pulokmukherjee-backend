<?php
use yii\helpers\Html;

$first = \app\models\MyFamilyPhoto::find()->one()->id;
?>
<div id="mfp-<?= $model->id ?>" class="px-2">
    <div class="position-relative bg-dark bg-gradient hover-container">
        <img class="img-fluid mx-auto d-block" src="<?= Yii::getAlias('@front') . '/' . $model->file_path ?>" style="height: 200px;">
        <div class="overlay"></div>
        <div class="gallery-btn">
            <?php
                if ($first != $model->id) {
                    echo Html::a(Yii::t('app', 'Delete'), ['my-family-photo/delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]); 
                }        
            ?>
        </div>
    </div>
</div>