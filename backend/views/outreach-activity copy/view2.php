<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\widgets\DetailView;
use kartik\detail\DetailView;

/** @var yii\web\View $this */
/** @var app\models\RecentHighlight $model */

$this->title = $model->slug;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Outreach Activity'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\OutreachActivity */
?>
<div class="outreach-activity-view">
    <div class="card">
        <div class="card-header">
            <h3><?= Html::encode($this->title) ?></h3>
            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> 
                <?php // Html::a(Yii::t('app', 'Update Image Info'), ['update-image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>

        <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'activity_name',
                'slug'
                // 'created_on',
                // 'updated_on',
                // 'remark_one',
                // 'remark_two',
            ],
        ]) ?>

        </div>

        <div class="card-body">
            <p><strong>Image Details:</strong></p>
        </div>
        
        <div class="row">
            <?php
            if (isset($modelsPhoto)) {
                foreach ($modelsPhoto as $modelPhoto) {
                    ?>
                <div class="col-md-6">
                    <div class="card-body">
                    <?php
                        $attributes = [
                            'id',
                            //'image',
                            // [
                            //     'attribute' => 'image',
                            //     'label' => 'Image Path'
                            // ],
                            [
                                //'attribute' => 'image',
                                'label' => 'Photo',
                                'format' => 'html',
                                'value' => '<img src="' . Yii::getAlias('@front') . '/' . $modelPhoto->file_path . '" class="img-responsive" alt="' . $modelPhoto->alt .'" style="height: 200px;">',
                            ],
                            //'full_path',
                            // 'caption',
                            // 'status',
                        ];

                        echo DetailView::widget([
                            'model' => $modelPhoto,
                            'hover' => true,
                            'mode' => DetailView::MODE_VIEW,
                            'attributes' => $attributes,
                        ]);
                    ?>
                    </div>
                </div>  
                <?php }
            } ?>
        </div>
    </div>

</div>
