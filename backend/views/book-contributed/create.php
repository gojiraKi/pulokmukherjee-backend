<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookContributed $model */

$this->title = Yii::t('app', 'Create Book Contributed');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Book Contributeds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-contributed-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
