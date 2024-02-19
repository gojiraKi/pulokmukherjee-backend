<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\RecentHighlight $model */

$this->title = Yii::t('app', 'Create Recent Highlight');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recent Highlights'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recent-highlight-create">

    <div class="card">
        <div class="card-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>
</div>
