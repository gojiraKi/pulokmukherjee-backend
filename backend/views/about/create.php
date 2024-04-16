<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\About $model */

$this->title = Yii::t('app', 'Create About');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Abouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-create">

    <div class="card">
        <div class="card-header text-info-emphasis bg-info-subtle">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="card-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
    </div>

</div>
