<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/imgareaselect-default.css',
        ''
    ];
    public $js = [
        //'js/bootstrap.min.js',
        'js/html2canvas.js',
        'js/jquery.imgareaselect.min.js',
        'js/jquery.imgareaselect.pack.js',


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
