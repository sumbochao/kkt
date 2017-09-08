<?php

    return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'wapgame',

    'preload'=>array('log'),

    'import'=>array(
    'application.models.*',        
    'application.components.*',
    'application.extensions.*', 
    'application.extensions.url.*', 
    'application.utilities.*', 
    'zii.widgets.CPortlet',
    ),

    'defaultController'=>'home',
    'layout'=>'layouts/main',
    'modules' => array(
    '',
    ),

    'components'=>array(
    'user'=>array(			
    'allowAutoLogin'=>true,
    ),
    'import'=>array(
    'application.models.*',
    'application.components.*',
    'ext.Calendar.jCalendar',
    ),
    'counter' => array(
    'class' => 'UserCounter',
    ),

    'db'=>array(
    'connectionString' => 'mysql:host=127.0.0.1;dbname=vtc_10h_xs',
    'emulatePrepare' => true,
    'username' => 'uxoso10h',
    'password' => 'pxoso10h!@#456',
    'charset' => 'utf8',
    ),

    'errorHandler'=>array(			
    'errorAction'=>'home/error',
    ),
    'urlManager'=>array(
    'urlFormat'=>'path',
    'showScriptName'=>false,            
    'caseSensitive' => true,
    ),
    'cache' => array (
    'class'=>'system.caching.CFileCache',
    /*'class' => 'CMemCache',
    'servers'=>array(
    array(
    'host'=>'localhost',
    'port'=>11211,
    'weight'=>100,
    ),
    ),*/
    ),
    'log'=>array(
    'class'=>'CLogRouter',
    'routes'=>array(
    array(
    'class'=>'CFileLogRoute',
    'levels'=>'error, warning',
    ),
    ),
    ),
    ),

    'params'=>require(dirname(__FILE__).'/params.php'),
    );
?>