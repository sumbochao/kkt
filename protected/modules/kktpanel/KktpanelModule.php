<?php
class KktpanelModule extends CWebModule
{
    public $defaultController = 'home';    

    public function init()
    {                 
        $this->setImport(
            array(
                'kktpanel.models.*',
                'kktpanel.components.*', 
                'application.utilities.*',                               
            )
        );    
        $this->defaultController = "home";
        $this->layout = 'main';
        $this->setComponents(
            array(
                'errorHandler' => array('errorAction' => 'home/index'),
                'user' => array(
                    'class' => 'CWebUser',
                    'loginUrl' => Yii::app()->createUrl('kktpanel/admin/login'),
                )
            )
        );
    }
}
