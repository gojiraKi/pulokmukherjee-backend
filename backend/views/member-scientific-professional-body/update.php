<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MemberScientificProfessionalBody $model */

$this->title = Yii::t('app', 'Update Member Scientific Professional Body: {name}', [
    'name' => $model->id,
]);
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Scientific Professional Bodies'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
// $this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="member-scientific-professional-body-update">

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
