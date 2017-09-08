<?php
/**
* Controller is the customized base controller class.
* All controller classes for this application should extend from this base class.
*/
date_default_timezone_set('Asia/Ho_Chi_Minh');
class CpController extends CController
{  

    public $breadcrumbs=array();    
    public function getBreadcrumbs(){
        $breadcrumbs = $this->breadcrumbs;
        $str = '<li><a href="'.Yii::app()->baseUrl.'"><span class="home1">Trang quản trị</span></a></li>'; 
        foreach($breadcrumbs as $key=>$value){
            if(isset($value["name"]) && isset($value["link"]) && isset($value["class"])){              
                $str .= '<li class="'.$value["class"].'"><a href="'.$value["link"].'"><span class="home1">'.$value["name"].'</span></a></li>';                
            }
        } 
        return $str;                                       
    }
    
    public function beforeAction($action)
    {    
        return true;
         if(in_array(Yii::app()->getModule('kktpanel')->user->name, array("adminkkt"))){
            return true;
        }
        
        $url = new Url(); 
        if(function_exists('lcfirst') === false) {
            function lcfirst($str) {
                $str[0] = strtolower($str[0]);
                return $str;
            }
        }
        $controllerId = Yii::app()->controller->id;
        $actionId = lcfirst($action->id);
        $route = $controllerId . '/' . $actionId;
        if(Yii::app()->getModule('kktpanel')->user->isGuest){
            if(Yii::app()->getRequest()->getIsAjaxRequest()){
                echo "Bạn đã bị logout khỏi hệ thống ! Vui lòng Nhấn F5 để đăng nhập lại";exit();
            }else{
                if($controllerId == "admin" && $actionId=="login"){
                    return true;
                }else{
                    $this->redirect($url->createUrl("admin/login"));
                }
            }

        }else{    
              
            $data_admin = AdminUser::getDataById(Yii::app()->getModule('kktpanel')->user->id);
            if(!$data_admin || $data_admin["status"]=="reject"){
                Yii::app()->getModule("kktpanel")->user->logout();
            }
            $publicPages = array('admin/login','admin/profile','admin/logout','admin/ajaxChangePass',"home/index");
            if(in_array($route,$publicPages)){
                return true;
            }
            $check = $this->checkPermit($controllerId,$actionId);
            if($check == 1){
                return true; 
            }else{
                if(Yii::app()->getRequest()->getIsAjaxRequest()){ 
                    echo "Không có quyền vào phần quản lý này";exit;
                }else{
                    $this->render("application.modules.kktpanel.views.home.no_permit");exit;
                }

            }
        }        
    }
    public function checkPermit($controller,$action){
        $adminId = Yii::app()->getModule('kktpanel')->user->id;
        $module_id = 0;
        $permission_name = "";

        $modules = PermitConfig::$permission_module;
        foreach($modules as $key=>$module){
            if($module["value"]==$controller){
                $module_id = $key;break;
            }
        }     
        $actions_module = PermitConfig::$$controller;        
        foreach($actions_module as $key=>$value){
            if(in_array($action,$value)){
                $permission_name = $key;break;
            }
        }
        if($permission_name !=""){
            $action_id = PermitConfig::$permission[$permission_name];
            $data_permit = AdminUser::getDataByAdminModulePermit($adminId,$module_id,$action_id);
            if($data_permit){
                return 1;  //co quyen
            }else{
                return -1;  //ko quyen
            }
        }else{
            return -1;  //ko quyen
        }
    }
}

