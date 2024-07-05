<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MemberProfessionalBody $model */

$this->title = Yii::t('app', 'Update Member Professional Body: {name}', [
    'name' => $model->id,
]);
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Professional Bodies'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="member-professional-body-update">

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