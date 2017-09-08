<?php
    class Wap2uController extends CpController
    {
        public function init(){
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT app wap2u','link'=>$url->createUrl("wap2u/index"),'class'=>'');
        }
        public function actionIndex(){
            $row_per_page = 20;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            list($max_page,$count,$data) = AWap2u::getDataSearch($keyword,$page,$row_per_page);
            $this->render("index",array("max_page"=>$max_page,"count"=>$count,"data"=>$data,"keyword"=>$keyword,"page"=>$page));
        }
        public function actionCreate(){
            $this->breadcrumbs[] = array('name'=>'Thêm mới app','link'=>'#','class'=>'active');
            $this->render("create");
        }
        public function actionAjaxSaveApp(){
            $time_now = time();
            $create_user = Yii::app()->user->name;
            $title = isset($_POST["title"]) ? trim(strip_tags($_POST["title"])):"";
            $type_cat = isset($_POST["type_cat"]) ? intval($_POST["type_cat"]):0;
            $version = isset($_POST["version"]) ? $_POST["version"]:"";
            $picture = isset($_POST["picture"]) ? $_POST["picture"]:"";
            $description = isset($_POST["description"]) ? $_POST["description"]:"";
            $link_ios = isset($_POST["link_ios"]) ? $_POST["link_ios"]:"";
            $link_android = isset($_POST["link_android"]) ? $_POST["link_android"]:"";
            $link_java = isset($_POST["link_java"]) ? $_POST["link_java"]:"";
            $link_window = isset($_POST["link_window"]) ? $_POST["link_window"]:"";
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $order_app = isset($_POST["order_app"]) ? intval($_POST["order_app"]):0;

            if($title ==""){
                echo "Tên danh mục không được để trống";exit;
            }
            if($type_cat == 0){
                echo "Chưa chọn loại danh mục";exit;
            }
            if($order_app == 0){
                echo "Chưa chọn vị trí app";exit;
            }
            if(Common::generate_slug($title)==''){
                echo "Tên danh mục không hợp lệ";exit;
            }
            $update=AWap2u::updateOrderOtherApp($order_app);
            $result = AWap2u::getCountId();
            $value =$result['value'];
            $app_value = pow(2,$value);
            $data = array(
            "type"=>array("value"=>$type_cat,"type"=>1),
            "title"=>array("value"=>$title,"type"=>2),
            "alias"=>array("value"=>Common::generate_slug($title),"type"=>2),
            "picture"=>array("value"=>$picture,"type"=>2),
            "version"=>array("value"=>$version,"type"=>2),
            "description"=>array("value"=>$description,"type"=>2),
            "link_java"=>array("value"=>$link_java,"type"=>2),
            "link_android"=>array("value"=>$link_android,"type"=>2),
            "link_ios"=>array("value"=>$link_ios,"type"=>2),
            "link_window"=>array("value"=>$link_window,"type"=>2),
            "status"=>array("value"=>$status,"type"=>1),
            "order_app"=>array("value"=>$order_app,"type"=>1),
            "app_value"=>array("value"=>$app_value,"type"=>1),
            "create_date"=>array("value"=>$time_now,"type"=>1),
            "create_user"=>array("value"=>$create_user,"type"=>2)
            );
            $table = "c_app_wap2u";
            $last_id = CommonDB::insertRow($table,$data);
            if($last_id >0){
                echo 1;exit();
            }
        }
        public function actionAjaxUpdateApp(){
            $time_now = time();
            $modify_user = Yii::app()->user->name;
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $title = isset($_POST["title"]) ? trim(strip_tags($_POST["title"])):"";
            $type_cat = isset($_POST["type_cat"]) ? intval($_POST["type_cat"]):0;
            $version = isset($_POST["version"]) ? $_POST["version"]:"";
            $picture = isset($_POST["picture"]) ? $_POST["picture"]:"";
            $description = isset($_POST["description"]) ? $_POST["description"]:"";
            $link_ios = isset($_POST["link_ios"]) ? $_POST["link_ios"]:"";
            $link_android = isset($_POST["link_android"]) ? $_POST["link_android"]:"";
            $link_java = isset($_POST["link_java"]) ? $_POST["link_java"]:"";
            $link_window = isset($_POST["link_window"]) ? $_POST["link_window"]:"";
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $order_app = isset($_POST["order_app"]) ? intval($_POST["order_app"]):0;
            if($title ==""){
                echo "Tên danh mục không được để trống";exit;
            }
            if($type_cat == 0){
                echo "Chưa chọn loại danh mục";exit;
            }
            if(Common::generate_slug($title)==''){
                echo "Tên danh mục không hợp lệ";exit;
            }

            $update=AWap2u::updateOrderOtherApp($order_app);
            $update=AWap2u::updateOrderApp($id,$order_app);

            $data = array(
            "id"=>array("value"=>$id,"type"=>1),
            "type"=>array("value"=>$type_cat,"type"=>1),
            "title"=>array("value"=>$title,"type"=>2),
            "alias"=>array("value"=>Common::generate_slug($title),"type"=>2),
            "picture"=>array("value"=>$picture,"type"=>2),
            "version"=>array("value"=>$version,"type"=>2),
            "description"=>array("value"=>$description,"type"=>2),
            "link_java"=>array("value"=>$link_java,"type"=>2),
            "link_android"=>array("value"=>$link_android,"type"=>2),
            "link_ios"=>array("value"=>$link_ios,"type"=>2),
            "link_window"=>array("value"=>$link_window,"type"=>2),
            "status"=>array("value"=>$status,"type"=>1),
            "modify_date"=>array("value"=>$time_now,"type"=>1),
            "modify_user"=>array("value"=>$modify_user,"type"=>2)
            );
            $table = "c_app_wap2u";
            $last_id = CommonDB::updateRow($table,$data,array("id"));
            if($last_id >0){
                echo 1;exit();
            }
        }
        public function actionEdit(){
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $data = AWap2u::getDataById($id);
            $this->breadcrumbs[] = array('name'=>'Sửa App '.$data["title"],'link'=>'#','class'=>'active');
            if($data){
                $this->render("edit",array("data"=>$data));
            }
        }
        public function actionAjaxQuickUpdate(){
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $data = array(
            "status"=>array("value"=>$status,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );
            $table = "c_app_wap2u";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
        public function actionAjaxDelete(){
            $time_now = time();
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            if($id >0){
                $table  = "c_app_wap2u";
                $result = CommonDB::deleteRow($table,array("id"=>$id));
                if($result >0){
                    echo 1;exit();
                }else{
                    echo "Chưa thay đổi dữ liệu";
                }
            }
        }
    }
?>