<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lectures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lecture-view">
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
                'id',
                [
                    'attribute' => 'lecture_type',
                    'value' => \app\models\Lecture::LectureType($model->lecture_type)
                ],
                'title',
                'article:html',
                [
                    'label' => 'Frontend View',
                    'format' => 'raw',
                    'value' => "<strong>" . $model->title . "</strong> " . $model->article
                ],
                [
                    'attribute' => 'status',
                    'value' => \app\models\Lecture::Status($model->status)
                ],
                'created_on:date',
                [                      
                    'attribute' => 'updated_on',
                    'value' => $model->updated_on ? date("Y-m-d", $model->updated_on) : '',
                ],
                // 'remark_one',
                // 'remark_two',
            ],
        ]) ?>
        </div>
    </div>
</div>
