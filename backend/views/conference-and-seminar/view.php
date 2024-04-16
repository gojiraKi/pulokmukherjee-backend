<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ConferenceAndSeminar $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conference And Seminars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
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
                // 'id',
                'title',
                'article:html',
                'status',
                'created_on',
                'updated_on',
                // 'remark_one',
                // 'remark_two',
            ],
        ]) ?>
        </div>
    </div>
</div>
