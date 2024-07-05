<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\web\View;

/** @var yii\web\View $this */
/** @var app\models\MyFamily $model */

$this->title = "My Family";
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'My Families'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="my-family-view">
    <div class="card shadow">
        <div class="card-header text-success-emphasis bg-success-subtle">
            <div class="d-flex">
                <div class="p-1 flex-grow-1 bd-highlight">
                    <h1 class="roboto-medium mb-0"><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="my-family-photo-tab" data-bs-toggle="tab" data-bs-target="#my-family-photo" type="button" role="tab" aria-controls="my-family-photo" aria-selected="true">
                            <h4 class="roboto-medium header-title">My Family Photo</h4>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                            <h4 class="roboto-medium header-title">Profile</h4>
                        </button>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 rounded-bottom" id="myTabContent">
                    <!-- my family photo -->
                    <div class="tab-pane fade show active" id="my-family-photo" role="tabpanel" aria-labelledby="my-family-photo-tab">
                        <div class="p-4 bd-highlight align-self-center float-end">
                            <?php echo Html::a(Yii::t('app', 'Create Family Photo'), ['my-family-photo/create'], ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="clearfix"></div>
                        <?php
                        $listOptions = ['class' => 'masonary-grid'];
                        $itemOptions = ['class' => 'masonary-grid-item'];
                        $summaryOptions = ['class' => 'masonary-grid-listview-summary text-right'];
                        $pagerOptions = ['class' => 'masonary-grid-listview-pager'];
                        // $layout = sprintf('%s{items}%s', $summaryEnable ? '{summary}' : '', $pagerEnable ? '{pager}' : '');
                        $layout = sprintf('%s{items}%s', '{summary}', '{pager}');
                        ?>
                        <?php echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => '_photo',
                            'layout' => $layout,
                            'options' => $listOptions,
                            'itemOptions' => $itemOptions,
                            'summaryOptions' => $summaryOptions,
                            'pager' => [
                                'firstPageLabel' => 'first',
                                'lastPageLabel' => 'last',
                                'prevPageLabel' => '<span class="fa fa-arrow-left"></span>',
                                'nextPageLabel' => '<span class="fa fa-arrow-right"></span>',
                                'maxButtonCount' => 8,
                                'options' => $pagerOptions,
                            ],
                        ]);
                        ?>
                    </div>
                    <!-- end my family photo -->

                    <!-- My family profile -->
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="pt-4 pe-4 bd-highlight align-self-center float-end">
                            <?php echo Html::a(Yii::t('app', 'Update Profile'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="mt-4 p-4">
                            <?php echo $model->article ?>
                        </div>
                    </div>
                    <!-- end My family profile -->
                </div>

            </div>

            <div class="mt-4">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'created_on:date',
                        [
                            'attribute' => 'updated_on',
                            'value' => $model->updated_on ? \Yii::$app->formatter->asDate($model->updated_on, 'long') : '',
                        ],
                        // 'remark_one',
                        // 'remark_two',
                    ],
                ]) ?>
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