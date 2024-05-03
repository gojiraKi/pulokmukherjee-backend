<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MemberProfessionalBody $model */

$this->title = Yii::t('app', 'Create Member Professional Body');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Professional Bodies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-professional-body-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
