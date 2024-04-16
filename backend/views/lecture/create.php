<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */

$this->title = Yii::t('app', 'Create Lecture');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lectures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-create">

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
