<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VisitingScientistUniversityResearchCentre $model */

$this->title = Yii::t('app', 'Update Visiting Scientist University Research Centre: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visiting Scientist University Research Centres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="visiting-scientist-university-research-centre-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
