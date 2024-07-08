<?php

use app\models\Gallery;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap5\LinkPager;
use yii\web\View;
// use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\GallerySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Galleries');
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-index">
    <div class="card shadow">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="header-title roboto-medium"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="p-1 bd-highlight align-self-center">
                    <?= Html::a(Yii::t('app', 'Add Photo to Gallery'), ['create'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <!-- <?php GridView::widget([
                        'dataProvider' => $dataProvider,
                        // 'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id',
                            // 'photo',
                            [
                                'attribute' => 'photo',
                                'format' => 'raw',
                                'value' => function ($data) {
                                    return  '<img src="' . Yii::getAlias('@front') . '/' . $data->photo_thmb . '" class="img-responsive" style="height: 200px;">';
                                }

                            ],
                            // 'photo_thmb',
                            // 'photo_frnt',
                            // 'caption',
                            //'alt_text',
                            //'file_absolute_path',
                            //'remark_one',
                            //'remark_two',
                            [
                                'class' => ActionColumn::class,
                                'template' => '{view} {delete}',
                                'urlCreator' => function ($action, Gallery $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model->id]);
                                }
                            ],
                        ],
                    ]); ?> -->

            <?php Pjax::end(); ?>
            <div class="card">
                <div class="card-body">
                    <div class="row gx-0 gy-4">
                        <?php
                        $models = $dataProvider->getModels();
                        if ($models !== NULL) {
                            foreach ($models as $model) {
                                echo '<div id="' . $model->id . '" class="col-md-3 px-2 ">';
                                echo '<div class="position-relative bg-dark hover-container">';

                                echo '<img class="img-fluid mx-auto d-block" src="' . Yii::getAlias('@front') . '/' . $model->photo . '" style="height: 200px;">';
                                echo '<div class="overlay"></div>';
                                echo '<div class="gallery-btn">';
                                echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]);
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            echo LinkPager::widget([
                                'pagination' => $dataProvider->pagination,
                            ]);
                        } else {
                            echo '<span class="h3">No Images</span>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
	$(document).ready(function(){
        const hoverContainers = document.querySelectorAll('.hover-container');

        hoverContainers.forEach(container => {
            const overlay = container.querySelector('.overlay');

            container.addEventListener('mouseover', function() {
                overlay.style.display = 'block';
            });

            container.addEventListener('mouseout', function() {
                overlay.style.display = 'none';
            });
        });
        
	});
JS;
$this->registerJs($script, View::POS_READY);
?>