<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    "/css/slick.css",
    "/css/slick-theme.css",
    "/css/normalize.css",
    "/css/jquery.scrollbar.css",
    "/css/swiper.min.css",
    "/css/style.css?v=2",
    "/css/jquery.fancybox.min.css",
    "/css/jquery.bxslider.css",
    "/css/sm.css?v=2",
    "/css/xs.css?v=2",
    "/css/none.css",
    "/css/site.css?v=2",
    "/css/fraht.css",
    ];
    public $js = [
        // "/js/jquery.min.js",
        "/js/slick.min.js",
        "/js/jquery-ui.min.js",
        "/js/jquery.ui.touch-punch.min.js",
        "/js/jquery.fancybox.min.js",
        "/js/select.js",
        "/js/jquery.scrollbar.min.js",
        "/js/swiper.min.js",
        "/js/readmore.min.js",
        "/js/main.js?v=2"
    ];
    //    public $depends = [
    //        'yii\web\YiiAsset',
    //        'yii\bootstrap\BootstrapAsset',
    //    ];
}
