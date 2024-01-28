<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\OutreachProgramme $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Outreach Programmes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="outreach-programme-view">
<div class="card">
        <div class="card-header">
            <div class="d-flex">
                <div class="p-2 flex-grow-1 bd-highlight"><h1><?= Html::encode($this->title) ?></h1></div>
                <div class="p-2 bd-highlight align-self-center">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'photo',
                'thmb_photo',
                'thmb_photo_frnt',
                'caption',
                'status',
                // 'remark_one',
                // 'remark_two',
            ],
        ]) ?>
        </div>
    </div>
</div>
