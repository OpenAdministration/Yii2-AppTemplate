<?php


namespace app\controllers;


use app\models\config\AdminConfigModel;
use app\models\db\ConfigRecord;
use app\models\config\InitConfigModel;
use DirectoryIterator;
use Yii;
use yii\base\InvalidRouteException;
use yii\console\controllers\MigrateController;
use yii\console\Exception;
use yii\web\Application;

class ConfigController extends \yii\web\Controller
{
    public function loadConfig() : void {
        $res = ConfigRecord::find()->all();
        $config = [];
        foreach ($res as $row){
            /* @var ConfigRecord $row */
            $config[$row->category][$row->name] = json_decode($row->value, true);
        }
        if(isset($config['app']['language'])){
            Yii::$app->language = $config['app']['language'];
            unset($config['app']['language']);
        }
        if(isset($config['app']['name'])){
            Yii::$app->name = $config['app']['name'][Yii::$app->language];
            unset($config['app']['name']);
        }
        Yii::$app->params['config'] = $config;
    }

    public function actionInstall()
    {
        if(!defined('START_INSTALLER')){
            return $this->redirect('admin');
        }
        $model = new InitConfigModel();
        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        return $this->render('formInitialConf', ['model' => $model]);
    }

    public function actionAdmin() : string
    {
        $model = new AdminConfigModel('app');
        $allLanguages = $this->getSupportedLanguages();
        return $this->render('admin', [
            'allLang' => $allLanguages,
            'model' => $model,
        ]);
    }

    public function getSupportedLanguages() : array
    {
        $translations = [];
        $dirs = new DirectoryIterator(Yii::getAlias('@locale'));
        foreach($dirs as $dir) {
            if($dir->isDir() && !$dir->isDot()) {
                $translations[$dir->getFilename()] = $dir->getFilename();
            }
        }
        return $translations;
    }

}