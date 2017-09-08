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
            'errorAction'=>'kktMember/error',
        ),
       'urlManager'=>array(
        	'urlFormat'=>'path',
            'showScriptName'=>false,            
            'caseSensitive' => true,
        	'rules'=>array(
                '/tim-kiem'=>'kktSearch/index',       
                '/<id:\d+>/<alias>'=>'kktDownload/app',                  
				'/cac-cau-hoi-thuong-gap'=>'kktGeneral/qa',                         
                '/quy-dinh-su-dung'=>'kktGeneral/privacy',
                '/quy-dinh-thanh-toan'=>'kktGeneral/paymentRule',
                '/tro-giup-cong-tac-vien'=>'kktGeneral/help',
                '/chinh-sach-hop-tac'=>'kktGeneral/policy',
                
                '/clip/download/<alias>-<video_id:\d+>.jad'=>'kktVideo/download',
                '/clip/vi/<alias>-d<video_id:\d+>'=>'kktVideo/vi',
                '/clip/<alias>-d<video_id:\d+>.3gp'=>'kktVideo/detail',
                '/clip/<alias>-c<cat_id:\d+>-p<page:\d+>'=>'kktVideo/cat',
                '/clip/<alias>-c<cat_id:\d+>'=>'kktVideo/cat',
                '/clip/moi-nhat/<page:\d+>'=>'kktVideo/latest',
                '/clip/hot-nhat/<page:\d+>'=>'kktVideo/hot',
                '/clip/moi-nhat'=>'kktVideo/latest',
                '/clip/hot-nhat'=>'kktVideo/hot',
                '/clip'=>'kktVideo/index',
                
                '/anh-sexy/download/<alias>-<album_id:\d+>.jad'=>'kktAlbum/download',
                '/anh-sexy/vi/<alias>-d<album_id:\d+>'=>'kktAlbum/vi',
                '/anh-sexy/<alias>-d<album_id:\d+>'=>'kktAlbum/detail',
                '/anh-sexy/<alias>-c<cat_id:\d+>-p<page:\d+>'=>'kktAlbum/cat',
                '/anh-sexy/<alias>-c<cat_id:\d+>'=>'kktAlbum/cat',
                '/anh-sexy/<page:\d+>'=>'kktAlbum/index',
                '/anh-sexy'=>'kktAlbum/index',
                
                '/game/download/<alias>-<game_id:\d+>.jad'=>'kktGame/download',
                '/game/kinh-dien/<alias>-c<cat_id:\d+>/<page:\d+>'=>'kktGame/catGameKD',
                '/game/kinh-dien/<alias>-c<cat_id:\d+>'=>'kktGame/catGameKD',
                '/game/kinh-dien/<alias>-d<game_id:\d+>'=>'kktGame/gameKDDetail',
                '/game/kinh-dien/moi-nhat/<page:\d+>'=>'kktGame/latestGameKD',
                '/game/kinh-dien/moi-nhat'=>'kktGame/latestGameKD',
                '/game/kinh-dien/hot-nhat/<page:\d+>'=>'kktGame/hotGameKD',
                '/game/kinh-dien/hot-nhat'=>'kktGame/hotGameKD',
                '/game/kinh-dien'=>'kktGame/gameKD',
                '/game/online/<alias>-c<cat_id:\d+>-p<page:\d+>'=>'kktGame/catGameOnline',
                '/game/online/<alias>-c<cat_id:\d+>'=>'kktGame/catGameOnline',
                '/game/online/moi-nhat/<page:\d+>'=>'kktGame/latestGameOnline',
                '/game/online/moi-nhat'=>'kktGame/latestGameOnline',
                '/game/online/hot-nhat/<page:\d+>'=>'kktGame/hotGameOnline',
                '/game/online/hot-nhat'=>'kktGame/hotGameOnline',
                '/game/online'=>'kktGame/gameOnline',
                
                '/tin-tuc/vi/<alias>-d<new_id:\d+>'=>'kktNews/vi',
                '/tin-tuc/<alias>-d<new_id:\d+>'=>'kktNews/detail',
                '/tin-tuc/<alias>-c<cat_id:\d+>-p<page:\d+>'=>'kktNews/cat',
                '/tin-tuc/<alias>-c<cat_id:\d+>'=>'kktNews/cat',
                '/tin-tuc/<page:\d+>'=>'kktNews/index',
                '/tin-tuc'=>'kktNews/index',
                
                
                '/kenh-18/'=>'kktMember/kenh18',                
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
	
	'params'=>require(dirname(__FILE__).'/../config_member/params.php')
);
?>