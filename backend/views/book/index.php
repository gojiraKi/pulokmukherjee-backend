<?php
/** @var yii\web\View $this */

use app\models\BookAuthored;
use app\models\BookContributed;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Book');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <div class="card">
        <div class="card-header card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center btn-group" role="group">
                    <?php // Html::a(Yii::t('app', 'Create Conference And Seminar'), ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Create Book Authored'), ['book-authored/create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Create Book Contributed'), ['book-contributed/create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="book-authored-tab" data-bs-toggle="tab" data-bs-target="#book-authored-tab-pane" type="button" role="tab" aria-controls="book-authored-tab-pane" aria-selected="true">Book Authored</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="book-contributed-tab" data-bs-toggle="tab" data-bs-target="#book-contributed-tab-pane" type="button" role="tab" aria-controls="book-contributed-tab-pane" aria-selected="false">Book Contributed</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="book-authored-tab-pane" role="tabpanel" aria-labelledby="book-authored-tab" tabindex="0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderBA,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'book_art',
                            'author',
                            'title',
                            'book_art_path',
                            //'created_on',
                            //'updated_on',
                            //'remark_one',
                            //'remarl_two',
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, BookAuthored $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                    </div>
                    <div class="tab-pane fade" id="book-contributed-tab-pane" role="tabpanel" aria-labelledby="book-contributed-tab" tabindex="0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderBC,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'author',
                            'title',
                            'created_on',
                            'updated_on',
                            //'remark_one',
                            //'remark_two',
                            [
                                'class' => ActionColumn::class,
                                'urlCreator' => function ($action, BookContributed $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
