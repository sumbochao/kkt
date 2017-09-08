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
    
    'modules' => array(
      'kktpanel',
    ),
    'components'=>array(
        'user'=>array(            
            'allowAutoLogin'=>true,
        ),        
    
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=hdc_wap_content',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'So9/SIFdnuo=',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
            'class'=>'CDbConnection'            
        ),        
        
        'errorHandler'=>array(            
            'errorAction'=>'ajax/error',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,            
            'caseSensitive' => true,
            'rules'=>array(
                
                '/link-file-<id:\d+>.html'=>'kktDownload/app',
                                                      
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
    
    'params'=>require(dirname(__FILE__).'/params.php'),
);
