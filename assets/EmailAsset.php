<?php
/**
 * Created by PhpStorm.
 * User: gilso
 * Date: 20/10/2017
 * Time: 18:31
 */

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

class EmailAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//fonts.googleapis.com/css?family=Rancho|Open+Sans:400,300,300italic,400italic,600,600italic,700,800italic,700italic,800',
        'https://vacosas-homolog.redmage.com.br/email/minify/rgen_min.css',
        'https://vacosas-homolog.redmage.com.br/email/css/configstyle.css?rgGd1',
        'https://vacosas-homolog.redmage.com.br/email/css/custom.css'
    ];
    public $js = [
        'https://vacosas-homolog.redmage.com.br/email/minify/rgen_min.js',
        'https://vacosas-homolog.redmage.com.br/email/js/rgen.js',
    ];

    public $jsOptions = [
        'position' => View::EVENT_END_BODY
    ];
}