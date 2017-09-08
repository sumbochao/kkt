<?php
    error_reporting(E_ALL);
    //$yii=dirname(__FILE__).'/framework/yii.php';
    $yii=dirname(__FILE__).'/../yii/framework2/yii.php';
    $config=dirname(__FILE__).'/protected/config/console.php';
    defined('YII_DEBUG') or define('YII_DEBUG',true);
     
    require_once($yii);
    Yii::createConsoleApplication($config)->run();
?>