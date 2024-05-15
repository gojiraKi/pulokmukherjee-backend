<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MyFamilyPhoto $model */

$this->title = Yii::t('app', 'Create My Family Photo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Family Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-family-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
