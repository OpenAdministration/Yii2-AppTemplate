<?php

use yii\log\FileTarget;
use yii\caching\FileCache;
use yii\gii\Module;

if(file_exists(__DIR__ . '/secrets.php')){
    $secrets = require  __DIR__ . '/secrets.php';
}else{
    $secrets = require  __DIR__ . '/secrets.sample.php';
    define('START_INSTALLER', true);
}

$config = [
    'id' => 'yii-app-console',
    'name' => 'Yii App',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower',
        '@npm'   => '@vendor/npm',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $secrets['db'] ?? [],
    ],
    'params' => [],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => Module::class,
    ];
}

return $config;
