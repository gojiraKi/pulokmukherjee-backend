<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VisitingScientistUniversityResearchCentre $model */

$this->title = Yii::t('app', 'Create Visiting Scientist University Research Centre');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visiting Scientist University Research Centres'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visiting-scientist-university-research-centre-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
