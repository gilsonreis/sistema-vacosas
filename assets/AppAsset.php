<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'theme/font-awesome/css/font-awesome.min.css',
        'css/sweetalert/sweetalert.css',
        'theme/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
        'theme/iCheck/skins/flat/green.css',
        'css/custom.css',
        'css/site.css',
    ];
    public $js = [
        'theme/fastclick/lib/fastclick.js',
        'theme/nprogress/nprogress.js',
        'theme/bootstrap-progressbar/bootstrap-progressbar.js',
        'js/sweetalert/sweetalert.min.js',
        'theme/iCheck/icheck.min.js',
        'js/custom.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
