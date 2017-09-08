<?php
class TipsController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản trị Tip','link'=>$url->createUrl("tips/index"),'class'=>'');
    }

    public function actionIndex(){
        $this->breadcrumbs[] = array('name'=>'Danh sách Tip','link'=>"#",'class'=>'active');
        $data = ATips::getAllData();
        $this->render("index",array("data"=>$data));
    }

    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới tip','link'=>"#",'class'=>'active');
        $this->render("create");
    }

    public function actionAjaxSaveTips(){
        $time_now = time();
        $title_tip = isset($_POST["title_tip"]) ? trim($_POST["title_tip"]):"";
        $url = isset($_POST["url"]) ? trim($_POST["url"]):"";
        if($title_tip==""){
            echo "Tiêu đề được để trống";exit();
        }
        if($url==""){
            echo "Link không được để trống";exit();
        }
        $data = array(
        "title"=>array("value"=>$title_tip,"type"=>2),
        "url"=>array("value"=>$url,"type"=>2),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        );
        $table = "c_tips";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = ATips::getDataById($id);
        if($data){
            $this->render("edit",array("data"=>$data));
        }
    }
    public function actionAjaxUpdateTips(){
        $time_now = time();
        $title_tip = isset($_POST["title_tip"]) ? trim($_POST["title_tip"]):"";
        $url = isset($_POST["url"]) ? trim($_POST["url"]):"";
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($title_tip==""){
            echo "Tiêu đề được để trống";exit();
        }
        if($url==""){
            echo "Link không được để trống";exit();
        }
        if($id >0){
            $data = array(
            "title"=>array("value"=>$title_tip,"type"=>2),
            "url"=>array("value"=>$url,"type"=>2),
            "id"=>array("value"=>$id,"type"=>1),
            );
            $table = "c_tips";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0; 
        if($id >0){
            $table = "c_tips";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
}
