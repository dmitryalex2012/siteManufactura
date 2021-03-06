<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/main_page.css',
        'css/presentation.css',
        'css/contact.css',
        'css/works.css',
        'css/list.css',
        'css/shop.css',
        'css/ourProducts.css',
        'css/cartList.css',
        'css/index.css',
        'css/details.css',
        'css/mainAdmin.css',
        'css/admin.css',
    ];
    public $js = [
//        'js/scripts.js',
//        'js/util.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
