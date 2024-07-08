<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\PhdProjectOngoing $model */

$this->title = "Phd Project Ongoing #" . $model->id;
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phd Project Ongoings'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="phd-project-ongoing-view">

    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
        </div>
        <div class="card-body roboto-regular">
            <div class="py-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',
                        'title:ntext',
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