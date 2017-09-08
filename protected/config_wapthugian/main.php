<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Kiếm tiền hiệu quả ',
    'language'=>'vi',
	
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
	'modules' => array(
      'kktpanel',
    ),
	'components'=>array(
		'user'=>array(			
			'allowAutoLogin'=>true,
		),        
    
		'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=vtc_kenhkiemtien',
            'emulatePrepare' => true,
            'username' => 'uvtc_kkt2012',
            'password' => 'pvtc_@)!@kkt',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
        ),
          
		'db_forum'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=vtc_diendan_kkt',
            'emulatePrepare' => true,
            'username' => 'uvtc_kkt2012',
            'password' => 'pvtc_@)!@kkt',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
        ),
        	 
		'errorHandler'=>array(			
            'errorAction'=>'kktWapthugian/error',
        ),
       'urlManager'=>array(
        	'urlFormat'=>'path',
            'showScriptName'=>false,            
            'caseSensitive' => true,
        	'rules'=>array(                  
                '<username>/<alias>-<id:\d+>'=>'kktDownload/app',
                '/tai-ngay-<alias>-<id:\d+>'=>'kktDownload/downloadMyAdv',
                '/tai-ngay-<alias>-t<type:\d+>'=>'kktDownload/hotHome',
                '/<alias>-d<id:\d+>u<userId:\d+>'=>'kktDownload/downloadGame',
                '/tai-ngay-bo-anh-hot-<id>-<dataId>'=>'kktAlbumDetail/index',
                '/tai-ngay-video-<id>-<dataId>'=>'kktDownload/video',
                '/tai-ngay-anh-hot-<id>-<dataId>'=>'kktDownload/image',
                '/tai-ngay-game-<id>-<dataId>'=>'kktDownload/game',
         
                '/'=>'kktWapthugian/index',
                'kktpanel/<controller:\w+>/<action:\w+>'=>'kktpanel/<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        	),
        ),
        'cache' => array (
            'class'=>'system.caching.CFileCache',
            /*
            'class' => 'CMemCache',
               'servers'=>array(
            array(
                   'host'=>'localhost',
                'port'=>11211,
                'weight'=>60,
                ),
            ),
            */
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
	
	'params'=>require(dirname(__FILE__).'/../config_wapthugian/params.php')
);
?>