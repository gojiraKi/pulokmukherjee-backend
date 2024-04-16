<?php

use app\models\AboutResearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var app\models\About $model */

$this->title = "About";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Abouts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="about-view">
    <div class="card">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php // Html::a(Yii::t('app', 'Create About Research'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row gx-0">
                <div class="col-md-6">
                    <img src="<?= $model->photo ?>" class="img-responsive" alt="Director photo" style="height: 400px;">,
                </div>

                <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'qualification',
                        'field_one',
                        'field_two',
                        'field_three',
                        'field_four',
                        'field_five',
                        'field_six',
                        'field_seven',
                        'email_one',
                        'email_two',
                        // 'article:ntext',
                        'created_on',
                        'updated_on',
                        // 'remark_one',
                        // 'remark_two',
                    ],
                ]) ?>
                </div>
            </div>
        </div>
        <div class="mt-4 p-4">
        <?php echo $model->article ?>
        </div>
        <div id="about-research" class="card-body">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="p-1 flex-grow-1 bd-highlight">
                            <h1>About Research</h1>
                        </div>
                        <div class="p-2 bd-highlight align-self-center">
                            <?php // Html::a(Yii::t('app', 'Create About Research'), ['about-research/create'], ['class' => 'showModalButton btn btn-success']) ?>
                            <?= Html::button(Yii::t('app', 'Create About Research'), ['value' => Url::to(['about-research/create']), 'title' => 'Creating New Research', 'class' => 'showModalButton btn btn-success', 'data-bs-toggle' => "modal", 'data-bs-target' => "#modal"]); ?>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'title:ntext',
                        'created_on',
                        'updated_on',
                        // 'remark_one',
                        //'remark_two',
                        [
                            'class' => ActionColumn::class,
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, AboutResearch $modelAR, $key, $index, $column) {
                                return Url::toRoute(['about-research/' . $action, 'id' => $modelAR->id]);
                            }
                        ],
                    ],
                ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
