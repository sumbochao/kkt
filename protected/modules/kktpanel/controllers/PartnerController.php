<?php
class PartnerController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Partner','link'=>$url->createUrl("partner/index"),'class'=>'');
    }
    public function actionIndex(){
        $this->breadcrumbs[] = array('name'=>'DS Partner','link'=>'#','class'=>'active');
        $data = APartner::getAllPartner();
        $this->render("index",array("data"=>$data));
    }
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $name = isset($_POST["name"]) ? trim($_POST["name"]):"";
        if($name==""){
            echo "Tên đối tác không được để trống";exit();
        }
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $data_old = APartner::getDataById($id);
            $data = array(
            "name"=>array("value"=>$name,"type"=>2),
            "id"=>array("value"=>$id,"type"=>1)
            );

            $table = "c_partner";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                $act = 2;
                $obj = 15;
                $content = LogConfig::$action[$act].' '.LogConfig::$object[$obj].': {id: '.$id.',name: '.$data_old["name"].'} thành';
                $content .= ' {id: '.$id.',name: '.$name.'}';
                $result = AAdminLog::insertAdminLog($act,$obj,$content);
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionAjaxSavePartner(){
        $time_now = time();
        $name = isset($_POST["name"]) ? trim($_POST["name"]):"";
        if($name==""){
            echo "Tên đối tác không được để trống";exit();
        }

        $data = array(
            "name"=>array("value"=>$name,"type"=>2),
            "create_date"=>array("value"=>$time_now,"type"=>1),
        );
        $table = "c_partner";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            $act = 1;
            $obj = 15;
            $content = LogConfig::$action[$act].' '.LogConfig::$object[$obj].': {id: '.$last_id.',name: '.$name.'}';
            $result = AAdminLog::insertAdminLog($act,$obj,$content);
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0; 
        if($id >0){
            $data_game = AGame::getDataByPartner($id);
            if($data_game){
                echo "Đối tác đã gắn với 1 số Game! Không được xóa";exit;
            }
            $data_old = APartner::getDataById($id); 
            $table = "c_partner";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                $act = 3;
                $obj = 15;
                $content = LogConfig::$action[$act].' '.LogConfig::$object[$obj].': {id: '.$id.',name: '.$data_old["name"].'}';
                $result = AAdminLog::insertAdminLog($act,$obj,$content);
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
}
