<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
$routes = require(__DIR__ . '/routes.php');

$config = [
    'id' => 'Vacosa',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => "pt-BR",
    'sourceLanguage' => "pt-BR",
    'timezone' => 'America/Sao_Paulo',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'KobXEKeAw85RibiS3RIuetTo0DWeB3hV',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'R$ ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/login']
        ],
        'errorHandler' => YII_ENV_DEV && YII_DEBUG ? [
            'class' => 'lucidtaz\yii2whoops\ErrorHandler',
        ] : [
            'class' => 'yii\web\ErrorHandler',
            'errorAction' => 'site/error'
        ],
        'mailer' => [
            'class' => 'wadeshuler\sendgrid\Mailer',
            'viewPath' => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'apiKey' => 'sendgrid_api_key'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'defaultRoute' => 'vacosas',
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => $routes,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['contribuinte'],
        ],
    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'traceLine' => '<a href="phpstorm://open?url={file}&line={line}">{file}:{line}</a>',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
