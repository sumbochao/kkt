<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Wap Content',
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

	//'defaultController'=>'home',
	'modules' => array(
      'kktpanel',
    ),
	'components'=>array(
		'user'=>array(			
			'allowAutoLogin'=>true,
		),        
    
		/*'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=vtc_kenhkiemtien',
            'emulatePrepare' => true,
            'username' => 'usoicaudep',
            'password' => 'pVTCscd@)!@',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
        ),*/
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=wapcontent',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'class'=>'CDbConnection'            
        ),
		
		'errorHandler'=>array(			
            'errorAction'=>'kktMember/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path',
            'showScriptName'=>false,            
            'caseSensitive' => true,
        	'rules'=>array(
				'/cac-cau-hoi-thuong-gap'=>'kktGeneral/qa',
                '/chinh-sach-hop-tac'=>'kktGeneral/policy',
                '/quy-dinh-su-dung'=>'kktGeneral/privacy',
                '/quy-dinh-thanh-toan'=>'kktGeneral/paymentRule',
                '/download-video/<video_id:\d+>/<alias>.jad'=>'kktVideo/download1',
                '/download-image/<album_id:\d+>/<alias>.jad'=>'kktAlbum/download',
                '/download-game/<game_id:\d+>/<alias>.jad'=>'kktGame/download',
                'vi/news/<alias>-a<new_id:\d+>'=>'kktNews/vi',
                '/news/<alias>-a<new_id:\d+>'=>'kktNews/detail',
                '/news/<alias>-<cat_id:\d+>/<page:\d+>'=>'kktNews/cat',
                '/news/<alias>-<cat_id:\d+>'=>'kktNews/cat',
                '/news/<page:\d+>'=>'kktNews/index',
                '/news'=>'kktNews/index',
                '/vi/album/<alias>-a<album_id:\d+>'=>'kktAlbum/vi',
                '/album/<alias>-a<album_id:\d+>'=>'kktAlbum/detail',
                '/album/<alias>-<cat_id:\d+>/<page:\d+>'=>'kktAlbum/cat',
                '/album/<alias>-<cat_id:\d+>'=>'kktAlbum/cat',
                '/album/<page:\d+>'=>'kktAlbum/index',
                '/album'=>'kktAlbum/index',
                '/vi/video/<alias>-v<video_id:\d+>'=>'kktVideo/vi',
                '/video/<alias>-v<video_id:\d+>'=>'kktVideo/detail',
                '/video/<alias>-<cat_id:\d+>/<page:\d+>'=>'kktVideo/cat',
                '/video/<alias>-<cat_id:\d+>'=>'kktVideo/cat',
                '/video/new/<page:\d+>'=>'kktVideo/latest',
                '/video/new'=>'kktVideo/latest',
                '/video'=>'kktVideo/index',
                '/kenh18'=>'kktMember/kenh18',
                '/mobile-game-kinh-dien/<alias>-c<cat_id:\d+>/<page:\d+>'=>'kktGame/catGameKD',
                '/mobile-game-kinh-dien/<alias>-c<cat_id:\d+>'=>'kktGame/catGameKD',
                '/mobile-game-kinh-dien/<alias>-<game_id:\d+>'=>'kktGame/gameKDDetail',
                '/mobile-game-kinh-dien-moi/<page:\d+>'=>'kktGame/latestGameKD',
                '/mobile-game-kinh-dien-moi'=>'kktGame/latestGameKD',
                '/mobile-game-kinh-dien-hot/<page:\d+>'=>'kktGame/hotGameKD',
                '/mobile-game-kinh-dien-hot'=>'kktGame/hotGameKD',
                '/mobile-game-kinh-dien'=>'kktGame/gameKD',
                '/mobile-game-online/<alias>-c<cat_id:\d+>/<page:\d+>'=>'kktGame/catGameOnline',
                '/mobile-game-online/<alias>-c<cat_id:\d+>'=>'kktGame/catGameOnline',
                '/mobile-game-online-new/<page:\d+>'=>'kktGame/latestGameOnline',
                '/mobile-game-online-new'=>'kktGame/latestGameOnline',
                '/mobile-game-online-hot/<page:\d+>'=>'kktGame/hotGameOnline',
                '/mobile-game-online-hot/'=>'kktGame/hotGameOnline',
                '/mobile-game-online/'=>'kktGame/gameOnline',
                '/'=>'kktMember/index',
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
	
	'params'=>require(dirname(__FILE__).'/../config/params.php')
);
?>