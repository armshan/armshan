<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        '/static/css/public.css'
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    /**
     * 定义按需加载JS方法，注意加载顺序在最后
     * @param $view
     * @param $jsFile
     */
    public static function addScript(View $view, $jsFile)
    {
        $view->registerJsFile($jsFile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }

    /**
     * 定义按需加载css方法，注意加载顺序在最后
     * @param $view
     * @param $cssFile
     */
    public static function addCss(View $view, $cssFile)
    {
        $view->registerCssFile($cssFile);
    }
}
