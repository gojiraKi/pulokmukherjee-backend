<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MyFamilyPhoto $model */

$this->title = Yii::t('app', 'Create My Family Photo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Family Photos'), 'url' => ['my-family/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-family-photo-create">

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
