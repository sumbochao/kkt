<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    class Controller extends CController
    {    
        public $metaTitle;            
        public $metaKeywords;         
        public $metaDescription;      
        public $metaIndex;      
        public $metaFollow;      
        public $linkCanoncical;       
        public $menuUserActive;

        public function beforeAction($action)
        {
            $arr_child_permit = array();
            $url = new Url();
            $id_controller = Yii::app()->controller->id;
            $id_action = $action->id;

            switch(Yii::app()->controller->id){
                case "home":
                    $this->menuUserActive = 1;
                    break;
                case "user":{
                    $arr_ac_profile = array("index","changePassword","profile","editProfile","reportAll");
                    if(in_array($action->id,$arr_ac_profile)){
                        $this->menuUserActive = 2;
                    }else{
                        $this->menuUserActive = 3; 
                    }
                    break;   
                }                
                default:                
                    $this->menuUserActive = 0;
                    break;
            }

            /*echo $id_controller;
            echo $id_action;
            exit();
            */
            return true;
        }
    }
?>
