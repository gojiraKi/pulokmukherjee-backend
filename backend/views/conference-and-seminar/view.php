<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminar $model */

$this->title = 'Conference And Seminars ID: ' . $model->id;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conference And Seminars'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="conference-and-seminar-view">
    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                    <?php // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) 
                    ?>
                    <?php
                    //     echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    //     'class' => 'btn btn-danger',
                    //     'data' => [
                    //         'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    //         'method' => 'post',
                    //     ],
                    // ]) 
                    ?>
                </div>
            </div>
        </div>
        <div class="card-body roboto-regular">
            <div class="py-4">
                <p><strong><?= $model->title ?></strong> <?= $model->article ?></p>
            </div>

            <div>
                <p class="h4 font-blueish-grey roboto-regular">Details:</p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                        'title',
                        'article:html',
                        // [
                        //     'label' => 'Frontend View',
                        //     'format' => 'html',
                        //     'value' => "<p><strong>$model->title</strong> $model->article</p>"
                        // ],
                        [
                            'attribute' => 'status',
                            'value' =>  $model->status == 10 ? 'Active' : 'Inactive'
                        ],
                        'created_on:date',
                        [
                            'attribute' => 'updated_on',
                            'value' => $model->updated_on ? date("M d, Y", $model->updated_on) : '',
                        ],
                        // 'remark_one',
                        // 'remark_two',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>