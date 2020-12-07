<?php

// comment out the following two lines when deployed to production
use yii\web\Application;
use app\controllers\ConfigController;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

$app = new Application($config);
if(defined('START_INSTALLER')){
    $app->defaultRoute = 'config/install';
}else{
    $app->defaultRoute = 'site/home';
}
$app->run();