<?php


namespace app\controllers;


use app\models\install\ConfigRecord;
use app\models\install\InitConfigModel;
use yii\db\ActiveRecord;

class ConfigController extends \yii\web\Controller
{
    public function loadConfig() : void {
        $res = ConfigRecord::find()->all();
        $config = [];
        foreach ($res as $row){
            /* @var ConfigRecord $row  */
            $config[$row->name] = json_decode($row->value, true);
        }
        if(isset($config['language'])){
            \Yii::$app->language = $config['language'];
            unset($config['language']);
        }
        if(isset($config['name'])){
            \Yii::$app->name = $config['name'][\Yii::$app->language];
            unset($config['name']);
        }
        \Yii::$app->params['config'] = $config;
    }

    public function actionWelcome(): string
    {
        $model = new InitConfigModel();
        if($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
        }
        return $this->render('formInitialConf', ['model' => $model]);
    }

}