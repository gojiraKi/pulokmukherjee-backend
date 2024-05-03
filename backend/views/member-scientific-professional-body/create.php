<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MemberScientificProfessionalBody $model */

$this->title = Yii::t('app', 'Create Member Scientific Professional Body');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Scientific Professional Bodies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-scientific-professional-body-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
