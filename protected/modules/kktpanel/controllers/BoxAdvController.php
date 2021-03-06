<?php
class BoxAdvController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Box quảng cáo','link'=>$url->createUrl("boxAdv/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 20; 
        $this->breadcrumbs[] = array('name'=>'DS Box quảng cáo','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        list($max_page,$count,$data) = ABoxAdv::getDataSearch($from_date,$to_date,$keyword,$status,$page,$row_per_page);

        $this->render("index",array("max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"keyword"=>$keyword,
        "status"=>$status,"page"=>$page));
    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm box quảng cáo','link'=>'#','class'=>'active');
        $this->render("create");
    }
    public function actionAjaxSaveBanner(){
        $create_user = Yii::app()->user->name;
        $time_now = time();
        $title_adv = isset($_POST["title_adv"]) ? trim(strip_tags($_POST["title_adv"])):"";
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $link = isset($_POST["link"]) ? trim(strip_tags($_POST["link"])):"";
        if($title_adv==""){echo "Tiêu đề không được để trống";exit;}
        if($picture==""){echo "Chưa upload ảnh";exit;}
        $data = array(
        "title"=>array("value"=>$title_adv,"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),
        "link"=>array("value"=>$link,"type"=>2),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "create_user"=>array("value"=>$create_user,"type"=>2),
        );
        $table = "c_box_adv";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            echo 1;exit;
        }else{
            echo "Dữ liệu chưa được thêm";exit;
        }
    }
    public function actionAjaxQuickUpdate(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;   
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $link = isset($_POST["link"]) ? trim(strip_tags($_POST["link"])):"";
        $data = array(
        "status"=>array("value"=>$status,"type"=>1),
        "link"=>array("value"=>$link,"type"=>2),
        "id"=>array("value"=>$id,"type"=>1),
        );
        $table = "c_box_adv";
        $result = CommonDB::updateRow($table,$data,array("id"));
        if($result >0){
            echo 1;exit;
        }else{
            echo "Chưa thay đổi dữ liệu";exit;
        }
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $this->breadcrumbs[] = array('name'=>'Sửa Box quảng cáo','link'=>'#','class'=>'active');
        $data = ABoxAdv::getDataById($id);
        $this->render("edit",array("data"=>$data));
    }
    public function actionAjaxUpdateBanner(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $title_adv = isset($_POST["title_adv"]) ? trim(strip_tags($_POST["title_adv"])):"";
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $link = isset($_POST["link"]) ? trim(strip_tags($_POST["link"])):"";
        if($title_adv==""){echo "Tiêu đề không được để trống";exit;}
        if($picture==""){echo "Chưa upload ảnh";exit;}
        $data = array(
        "title"=>array("value"=>$title_adv,"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),
        "link"=>array("value"=>$link,"type"=>2),
        "id"=>array("value"=>$id,"type"=>1),
        );
        $table = "c_box_adv";
        $result = CommonDB::updateRow($table,$data,array("id"));
        if($result >0){
            echo 1;exit;
        }else{
            echo "Chưa thay đổi dữ liệu";exit;
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_box_adv";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit;
            }else{
                echo "Chưa thay đổi dữ liệu";exit;
            }
        }
    }
}
