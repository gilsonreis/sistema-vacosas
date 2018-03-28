<?php

if(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'db-local.php')) {
    return require(__DIR__ . DIRECTORY_SEPARATOR . 'db-local.php');
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=vacosa',
    'username' => 'user',
    'password' => 'pass',
    'charset' => 'utf8',
];
