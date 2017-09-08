<?php
class BlacklistController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản trị Blacklist','link'=>$url->createUrl("blacklist/index"),'class'=>'');
    }

    public function actionIndex(){
        $this->breadcrumbs[] = array('name'=>'Danh sách Blacklist','link'=>"#",'class'=>'active');
        $data = ABlacklist::getAllData();
        $this->render("index",array("data"=>$data));
    }

    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới Blacklist','link'=>"#",'class'=>'active');
        $this->render("create");
    }

    public function actionAjaxSaveBlacklist(){
        $keyword = isset($_POST["keyword"]) ? trim($_POST["keyword"]):"";
        if($keyword==""){
            echo "Chưa nhập keyword";exit();
        }
        $keyword_register = Common::generate_slug_register($keyword);
        $data = array(
        "keyword"=>array("value"=>$keyword,"type"=>2),
        "keyword_register"=>array("value"=>$keyword_register,"type"=>2)
        );
        $table = "c_blacklist";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0; 
        if($id >0){
            $table = "c_blacklist";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
}
