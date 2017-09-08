<?php

	function getSubDomain()
	{
		$path = $_SERVER['HTTP_HOST'];
		if (strpos($path,'.')!=FALSE)
		{
			$path = explode('.',$path);
			$path = $path[0];
		}
		else $path='';
		return $path;
	}

	$domain=getSubDomain();
	
    @session_start();
    error_reporting(E_ALL & ~E_DEPRECATED);
    $yii=dirname(__FILE__).'/../framework/yii.php';
 
   if($domain!=''&&$domain!='kenhkiemtien'){
       $config=dirname(__FILE__).'/protected/config_member/main.php'; 
      // echo $_SERVER['HTTP_HOST'];die;
   } else {
        $config=dirname(__FILE__).'/protected/config/main.php'; 
   }        
        
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    require_once($yii);
    Yii::createWebApplication($config)->run();
?>