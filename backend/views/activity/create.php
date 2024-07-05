<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Activity $model */

$this->title = Yii::t('app', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>