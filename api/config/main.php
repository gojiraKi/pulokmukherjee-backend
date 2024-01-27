<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    // 'aliases' => [
    //     '@app' => __DIR__.'/../',
    // ],
    'components' => [
        // 'request' => [
        //     'csrfParam' => '_csrf-api',
        // ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
            // 'enableAutoLogin' => true,
            // 'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        // 'session' => [
        //     // this is the name of the session cookie used for login on the api
        //     'name' => 'advanced-api',
        // ],
        // 'log' => [
        //     'traceLevel' => YII_DEBUG ? 3 : 0,
        //     'targets' => [
        //         [
        //             'class' => \yii\log\FileTarget::class,
        //             'levels' => ['error', 'warning'],
        //         ],
        //     ],
        // ],
        // 'errorHandler' => [
        //     'errorAction' => 'site/error',
        // ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // '<alias:\w+>' => 'site/<alias>',
                '<alias:[\w\-]+>' => 'site/<alias>',           
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfCookie' => false,
        ],
    ],
    'params' => $params,
];
