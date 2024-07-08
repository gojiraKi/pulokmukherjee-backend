<?php
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use kartik\bs5dropdown\Dropdown;

?>
<?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandOptions' => ['class' => 'p-0'],
        'options' => ['class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            [
                'label' => 'Profile',
                'items' => [
                    ['label' => 'About', 'url' => Url::toRoute(['about/index'])],
                    ['label' => 'Research', 'url' => '#'],
                    ['label' => 'Lectures', 'url' => Url::toRoute(['lecture/index'])],
                ],
            ],
            ['label' => 'Outreach & Reports', 'url' => Url::toRoute(['outreach-activity/index'])],
            [
                'label' => 'Publication',
                'items' => [
                    ['label' => 'Research Papers', 'url' => Url::toRoute(['publications/index'])],
                    ['label' => 'Books', 'url' => Url::toRoute(['book/index'])]
                ],
            ],
            [
                'label' => 'Achivement',
                'items' => [
                    ['label' => 'Honors and Awards', 'url' => Url::toRoute(['about/index'])],
                    ['label' => 'Government and Industry Projects', 'url' => '#'],
                    ['label' => 'PhD Projects', 'url' => Url::toRoute(['phd-project/index'])],
                ],
            ],
            [
                'label' => 'Activities',
                'items' => [
                    ['label' => 'Professional Activities', 'url' => Url::toRoute(['activity/index'])],
                    ['label' => 'Conference Seminar', 'url' => Url::toRoute(['conference-and-seminar/index'])],
                    // ['label' => 'Outreach Activity', 'url' => Url::toRoute(['outreach-activity/index'])],
                ],
            ],
            [
                'label' => 'More',
                'items' => [
                    ['label' => 'Gallery', 'url' => Url::toRoute(['gallery/index'])],
                    ['label' => 'My Family', 'url' => Url::toRoute(['my-family/index'])]
                ],
            ],
            ['label' => 'Recent Highlights', 'url' => Url::toRoute(['recent-highlight/index'])],
            [
                'label' => 'Misc',
                'items' => [
                    ['label' => 'Media', 'url' => Url::toRoute(['media/index'])]
                ],
            ]
        ],
        'dropdownClass' => Dropdown::class, // use the custom dropdown
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
    ]);
    NavBar::end();

    // Configuring the Bootstrap 5 Dropdown widget
    // echo Html::tag('span', 'Dropdown Span', [
    //     'id' => 'dropdownMenuButton',
    //     'class' => 'btn btn-link text-info dropdown-toggle',
    //     'data-bs-toggle' => 'dropdown',
    //     'aria-haspopup' => 'true',
    //     'aria-expanded' => 'false'
    // ]);
    // echo Dropdown::widget([
    //     'items' => [
    //         ['label' => 'Section 1', 'url' => '/'],
    //         ['label' => 'Section 2', 'url' => '#'],
    //         [
    //             'label' => 'Section 3',
    //             'items' => [
    //                 ['label' => 'Section 3.1', 'url' => '/'],
    //                 ['label' => 'Section 3.2', 'url' => '#'],
    //                 [
    //                     'label' => 'Section 3.3',
    //                     'items' => [
    //                         ['label' => 'Section 3.3.1', 'url' => '/'],
    //                         ['label' => 'Section 3.3.2', 'url' => '#'],
    //                     ],
    //                 ],
    //             ],
    //         ],
    //     ],
    //     'options' => ['aria-labelledby' => 'dropdownMenuButton']
    // ]);
?>