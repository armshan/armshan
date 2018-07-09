<?php
/**
 * Created by PhpStorm.
 * User: mayunfeng
 * Date: 2017/12/19
 * Time: 14:46
 */

namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\View;

class LayoutAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/static/plugins/font-awesome/css/font-awesome.min.css',
    //    '/static/plugins/bootstrap/css/bootstrap.min.css',
        '/static/css/main.css?v=1.01.171218',
    ];
    public $js = [
//        '/static/plugins/jquery/jquery-1.12.4.min.js',
        '/static/plugins/metismenu/metisMenu.min.js',
//        '/static/plugins/bootstrap/js/bootstrap.min.js',
//        '/static/plugins/bootstrap/js/bootstrap-hover-dropdown.min.js',
        '/static/plugins/layer/layer.js',
        '/static/js/core.js',
        '/static/js/tool.js',
        '/static/js/main.js',
        '/js/main.js',
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
        $view->registerJsFile($jsFile, ['depends'=>LayoutAsset::className()]);
    }

    /**
     * 定义按需加载css方法，注意加载顺序在最后
     * @param $view
     * @param $cssFile
     */
    public static function addCss(View $view, $cssFile)
    {
        $view->registerCssFile($cssFile,['depends'=>LayoutAsset::className()]);
    }

}