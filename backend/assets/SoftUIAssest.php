<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class SoftUIAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'themes/soft-ui-dashboard-main/assets/css/nucleo-icons.css',
        'themes/soft-ui-dashboard-main/assets/css/nucleo-svg.css',
        'themes/soft-ui-dashboard-main/assets/css/soft-ui-dashboard.css"'
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap5\BootstrapAsset',
    ];
}
