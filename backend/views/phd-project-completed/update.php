<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PhdProjectCompleted $model */

$this->title = Yii::t('app', 'Update Phd Project Completed: {id}', [
    'id' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phd Project Completeds'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="phd-project-completed-update">

    <div class="card shadow-sm">
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
