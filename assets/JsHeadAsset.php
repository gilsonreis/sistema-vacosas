<?php
/**
 * Created by PhpStorm.
 * User: gilsonreis
 * Date: 19/07/16
 * Time: 18:18
 */

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\View;

class JsHeadAsset extends AssetBundle
{
    public $js = [
        'js/jquery-2.1.1.js',
        'js/bootstrap.min.js'
    ];
    public $jsOptions = [
        'position' => View::POS_HEAD
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}