<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MemberProfessionalBody $model */

$this->title = Yii::t('app', 'Create Member Professional Body');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Professional Bodies'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-professional-body-create">

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