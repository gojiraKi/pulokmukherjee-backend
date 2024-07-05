<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MyFamily $model */

$this->title = Yii::t('app', 'Update My Family');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Families'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="my-family-update">
    <div class="card">
        <div class="card-header">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>

</div>
