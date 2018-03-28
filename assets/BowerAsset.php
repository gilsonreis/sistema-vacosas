<?php
/**
 * Created by PhpStorm.
 * User: gilsonreis
 * Date: 15/12/16
 * Time: 20:55
 */

namespace app\assets;


use yii\web\AssetBundle;

class BowerAsset extends AssetBundle
{
    public $sourcePath = '@bower';
    public $css = [
        //'fancybox/source/jquery.fancybox.css'
    ];
    public $js = [
//        'webcamjs/webcam.js',
        //'fancybox/source/jquery.fancybox.js'
    ];
}