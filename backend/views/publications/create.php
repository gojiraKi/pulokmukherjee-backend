<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Publications $model */

$this->title = Yii::t('app', 'Create Publications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publications-create">

    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="card-body">
        <?= $this->render('_formCreate', [
            'models' => $models,
        ]) ?>
        </div>
    </div>

</div>
