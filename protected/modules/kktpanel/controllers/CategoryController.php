<?php
class CategoryController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Danh mục','link'=>$url->createUrl("category/index"),'class'=>'');
    }
    public function actionIndex(){ 
        $row_per_page = 20;
        $type_cat = isset($_GET["type_cat"]) ? intval($_GET["type_cat"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $this->breadcrumbs[] = array('name'=>'DS danh mục','link'=>'#','class'=>'active');
        list($max_page,$count,$data) = ACategory::getDataSearch($type_cat,$keyword,$type,$status,$page,$row_per_page);
        $this->render("index",array("type_cat"=>$type_cat,"keyword"=>$keyword,"type"=>$type,"status"=>$status,"page"=>$page,
        "max_page"=>$max_page,"count"=>$count,"data"=>$data,"row_per_page"=>$row_per_page));
    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm danh mục','link'=>'#','class'=>'active');       
        $this->render("create");
    }

    public function actionAjaxSaveCategory(){
        $time_now = time();
        $create_user = Yii::app()->user->name;
        $cat_name = isset($_POST["cat_name"]) ? trim(strip_tags($_POST["cat_name"])):"";
        $type_cat = isset($_POST["type_cat"]) ? intval($_POST["type_cat"]):0;
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):"";
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):"";     
        $isSex = isset($_POST["isSex"]) ? intval($_POST["isSex"]):0;
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0;

        if($cat_name ==""){
            echo "Tên danh mục không được để trống";exit;
        }
        if($type_cat == 0){
            echo "Chưa chọn loại danh mục";exit;
        }
        if(Common::generate_slug($cat_name)==''){
            echo "Tên danh mục không hợp lệ";exit;
        }
        $data_cat = ACategory::getDataByNameAndType($cat_name,$type_cat);
        if($data_cat){
            echo "Đã tồn tại danh mục có tên và loại này rồi";exit;
        }
        $data = array(
        "name"=>array("value"=>$cat_name,"type"=>2),
        "alias"=>array("value"=>Common::generate_slug($cat_name),"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
        "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
        "introtext"=>array("value"=>$introtext,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),
        "isSex"=>array("value"=>$isSex,"type"=>1),
        "type"=>array("value"=>$type_cat,"type"=>1),
        "app_ids"=>array("value"=>$appId,"type"=>1),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "create_user"=>array("value"=>$create_user,"type"=>2),
        );
        $table = "c_category";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            echo 1;exit();
        }
    }
    public function actionAjaxQuickUpdate(){
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isSex = isset($_POST["isSex"]) ? intval($_POST["isSex"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $data = array(
        "isSex"=>array("value"=>$isSex,"type"=>1),
        "status"=>array("value"=>$status,"type"=>1),
        "id"=>array("value"=>$id,"type"=>1)
        );
        $table = "c_category";
        $result = CommonDB::updateRow($table,$data,array("id"));
        if($result >0){
            echo 1;exit();
        }else{
            echo "Chưa thay đổi dữ liệu";
        }
    }
    public function actionEdit(){
        $this->breadcrumbs[] = array('name'=>'Sửa danh mục','link'=>'#','class'=>'active');
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = ACategory::getDataById($id);
        if($data){
            $this->render("edit",array("data"=>$data));
        }
    }
    public function actionAjaxUpdate(){
        $cat_name = isset($_POST["cat_name"]) ? trim(strip_tags($_POST["cat_name"])):"";
        $type_cat = isset($_POST["type_cat"]) ? intval($_POST["type_cat"]):0;
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):"";
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isSex = isset($_POST["isSex"]) ? intval($_POST["isSex"]):0;
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):"";
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $data_cat_old = ACategory::getDataById($id);
        if(!$data_cat_old){echo "Không tồn tại danh mục này";exit();}
        if($cat_name ==""){
            echo "Tên danh mục không được để trống";exit;
        }
        $data_cat = ACategory::getDataByNameAndType($cat_name,$type_cat);
        if($data_cat && $data_cat_old["name"] != $cat_name){
            echo "Đã tồn tại danh mục có tên và loại này rồi";exit;
        }  
        $data = array(
        "name"=>array("value"=>$cat_name,"type"=>2),
        "alias"=>array("value"=>Common::generate_slug($cat_name),"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
        "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
        "introtext"=>array("value"=>$introtext,"type"=>2),
        "type"=>array("value"=>$type_cat,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),
        "isSex"=>array("value"=>$isSex,"type"=>1),
        "type"=>array("value"=>$type_cat,"type"=>1),
        "app_ids"=>array("value"=>$appId,"type"=>1),
        "id"=>array("value"=>$id,"type"=>1),
        );
        $table = "c_category";
        $result = CommonDB::updateRow($table,$data,array("id")); 
        if($result >0){
            echo 1;exit();
        }else{
            echo "Chưa thay đổi dữ liệu";
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $data_cat_old = ACategory::getDataById($id);
            if($data_cat_old["type"]==1){
                $data_game = AGame::getDataByCat($id);
                if($data_game){
                    echo "Có game thuộc danh mục này.Hãy xóa game trước";exit;
                }
            }
            if($data_cat_old["type"]==2){
                $data_video = AVideo::getDataByCat($id);
                if($data_video){
                    echo "Có video thuộc danh mục này.Hãy xóa video trước";exit;
                }
            }
            $data_album = AAlbum::getDataByCat($id);
            if($data_album){
                echo "Có album thuộc danh mục này.Hãy xóa album trước";exit;
            }

            $data_news = ANews::getDataByCat($id);
            if($data_news){
                echo "Có tin tức thuộc danh mục này.Hãy xóa tin tức trước";exit;
            }

            $table = "c_category";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Không tồn tại danh mục này";
            }
        }
    }

}
