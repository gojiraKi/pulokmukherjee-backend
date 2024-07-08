<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PhdProjectOngoing $model */

$this->title = Yii::t('app', 'Create Phd Project Ongoing');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phd Project Ongoings'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="phd-project-ongoing-create">

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