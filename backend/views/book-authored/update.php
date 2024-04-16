<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookAuthored $model */

$this->title = Yii::t('app', 'Update Book Authored: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Authoreds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="book-authored-update">

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
