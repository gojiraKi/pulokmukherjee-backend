<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\About $model */

$this->title = "Director Bio";
$this->params['breadcrumbs'][] = ['label' => 'Abouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="about-view card p-3 shadow-sm">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <div>
        <img src="<?= Yii::getAlias('@webroot') . $model->bio_photo ?>" alt="" class="img-fluid">
        <?= Html::img($model->bio_photo, ['alt' => 'My image']) ?>

    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bio_photo',
            'article:ntext',
            'created_by',
            'created_on',
            'updated_by',
            'updated_on',
            'created',
        ],
    ]) ?>

</div>
