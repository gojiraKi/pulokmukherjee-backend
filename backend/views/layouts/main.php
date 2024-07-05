<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<!-- <body class="d-flex flex-column h-100 bg-white"> -->
<body class="d-flex flex-column h-100 bg-brownish">
<?php $this->beginBody() ?>

<header>
    <?= $this->render('navbar') ?>
</header>

<main role="main" class="flex-shrink-0 pt-5">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => [
                'label' => '<i class="fa fa-home"></i> ' . Html::encode(Yii::t('yii', 'Home')),
                'url' => Url::toRoute(['default/index']),
                'encode' => false,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'p-2 bg-light border rounded shadow-sm']
        ]) ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted bg-white">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end">Powered by: <a href='https://whitesoul-ds.co.in/' target='_blank'>WhiteSoul</a></p>
    </div>
</footer>



<?php $this->endBody() ?>
<?php
\yii\bootstrap5\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modalPL',
    'size' => 'modal-lg',
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
    "footer" => "",
]);
echo "<div id='modalContent'><div style='text-align:center'><img src='" . Url::home() . "img/Spinning_gear.gif'></div></div>";
\yii\bootstrap5\Modal::end();
?>

<script>
    const dropdown = document.getElementsByClassName("dropdown-btn");
    let i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            let dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</body>

</html>
<?php $this->endPage();
