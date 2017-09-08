<?php
class AlbumController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT album ảnh','link'=>$url->createUrl("news/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 20; $arr_game_id = array();  
        $this->breadcrumbs[] = array('name'=>'DS album ảnh','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $isHot = isset($_GET["isHot"]) ? intval($_GET["isHot"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $data_cat = ACategory::getAllData(3);
        list($max_page,$count,$data) = AAlbum::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$isHot,$page,$row_per_page);

        $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
        "status"=>$status,"isHot"=>$isHot,"page"=>$page));
    }

    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới album','link'=>'#','class'=>'active');
        $data_cat = ACategory::getAllData(3);
        $this->render("create",array("data_cat"=>$data_cat));
    }
    public function actionAjaxSaveAlbum(){
        $create_user = Yii::app()->user->name; 
        $time_now = time();            
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0; 
        $title_album = isset($_POST["title_album"]) ? trim(strip_tags($_POST["title_album"])):""; 
        $title_sms = isset($_POST["title_sms"]) ? trim(strip_tags($_POST["title_sms"])):""; 
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):""; 
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):""; 
        $filename = isset($_POST["filename"]) ? rtrim($_POST["filename"],":|:"):""; 
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):""; 
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0; 
        $price = isset($_POST["price"]) ? intval($_POST["price"]):0; 
        if($title_album == ''){ echo "Tên album không được để trống";exit;}
        if($title_sms == ""){echo "Tiêu đề tin nhắn không được để trống";exit;}
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}
        if($filename == ''){ echo "Chưa upload ảnh cho album";exit;}
        if(Common::generate_slug($title_album)==''){
            echo "Tên album không hợp lệ";exit;
        }
        $data_cat = ACategory::getDataById($categoryId);
        $data = array(
        "categoryId"=>array("value"=>$categoryId,"type"=>1),
        "title"=>array("value"=>$title_album,"type"=>2),
        "title_sms"=>array("value"=>$title_sms,"type"=>2),
        "alias"=>array("value"=>Common::generate_slug($title_album),"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
        "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
        "introtext"=>array("value"=>$introtext,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),   
        "app_ids"=>array("value"=>$appId,"type"=>1), 
        "price"=>array("value"=>$price,"type"=>1), 
        "create_date"=>array("value"=>$time_now,"type"=>1),    
        "update_date"=>array("value"=>$time_now,"type"=>1),    
        "create_user"=>array("value"=>$create_user,"type"=>2),
        );
        $table = "c_album";
        $albumId = CommonDB::insertRow($table,$data);
        /* them trong bang c_data*/        
        $data_c = array(
        "categoryId"=>array("value"=>$data_cat["id"],"type"=>1),
        "type"=>array("value"=>$data_cat["type"],"type"=>1),
        "dataId"=>array("value"=>$albumId,"type"=>1),
        "status"=>array("value"=>$status,"type"=>1),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "update_date"=>array("value"=>$time_now,"type"=>1),       
        );
        $table = "c_data";
        $data_id = CommonDB::insertRow($table,$data_c); 
        if($albumId >0){
            /* them anh vao album*/
            $arr_file = explode(":|:",$filename);
            $arr_key = array("albumId","file","create_date","update_date");
            $arr_values = array();
            for($i=0;$i<count($arr_file);$i++){
                $arr_values[] = array($albumId,$arr_file[$i],$time_now,$time_now);
            }
            $table = "c_image";
            $result = CommonDB::insertManyRows($table,$arr_key,$arr_values);
            echo 1;
        }else{
            echo "Có lỗi trong quá trình xử lý! Hãy báo với kỹ thuật";exit;
        }
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = AAlbum::getDataById($id);
        $this->breadcrumbs[] = array('name'=>'Sửa album '.$data["title"],'link'=>'#','class'=>'active');
        if($data){
            $data_cat = ACategory::getAllData(3);
            $data_image = AImage::getDataByAlbum($id);
            $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat,"data_image"=>$data_image));
        }
    }
    public function actionAjaxUpdateAlbum(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0; 
        $title_album = isset($_POST["title_album"]) ? trim(strip_tags($_POST["title_album"])):""; 
        $title_sms = isset($_POST["title_sms"]) ? trim(strip_tags($_POST["title_sms"])):""; 
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):""; 
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):"";
        $filename = isset($_POST["filename"]) ? rtrim($_POST["filename"],":|:"):""; 
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):""; 
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0; 
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0;
        $price = isset($_POST["price"]) ? intval($_POST["price"]):0;
        if($title_album == ''){ echo "Tên album không được để trống";exit;}
        if($title_sms == ""){echo "Tiêu đề tin nhắn không được để trống";exit;}
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}
        if($filename == ''){ echo "Chưa upload ảnh cho album";exit;}
        $data_album = AAlbum::getDataById($id);
        if($data_album){
            if($data_album["categoryId"] != $categoryId){
                $result = AData::updateCategoryByDataId($id,$categoryId);
            }
            /* xoa du lieu va them lai du lieu image*/
            $table = "c_image";
            $result = CommonDB::deleteRow($table,array("albumId"=>$id));
            /* them anh vao album*/
            $arr_file = explode(":|:",$filename);
            $arr_key = array("albumId","file","create_date","update_date");
            $arr_values = array();
            for($i=0;$i<count($arr_file);$i++){
                $arr_values[] = array($id,$arr_file[$i],$data_album["create_date"],$data_album["create_date"]);
            }
            $table = "c_image";
            $result = CommonDB::insertManyRows($table,$arr_key,$arr_values);
            $data = array(
            "categoryId"=>array("value"=>$categoryId,"type"=>1),
            "title"=>array("value"=>$title_album,"type"=>2),
            "title_sms"=>array("value"=>$title_sms,"type"=>2),
            "picture"=>array("value"=>$picture,"type"=>2),
            "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
            "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
            "introtext"=>array("value"=>$introtext,"type"=>2),
            "update_date"=>array("value"=>$time_now,"type"=>1),
            "app_ids"=>array("value"=>$appId,"type"=>1),
            "price"=>array("value"=>$price,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1),
            );
            $table = "c_album";
            $result = CommonDB::updateRow($table,$data,array("id"));


            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $isHome = isset($_POST["isHome"]) ? intval($_POST["isHome"]):0;
        $isHotApp = isset($_POST["isHotApp"]) ? intval($_POST["isHotApp"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $result = AData::updateStatusByDataId($id,$status);
            $data = array(
            "isHot"=>array("value"=>$isHot,"type"=>1),
            "isHome"=>array("value"=>$isHome,"type"=>1),
            "isHotApp"=>array("value"=>$isHotApp,"type"=>1),
            "status"=>array("value"=>$status,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );
            if($isHot ==1){
                $data["date_of_hot"] = array("value"=>$time_now,"type"=>1);
            }
            if($isHome ==1){
                $data["date_of_home"] = array("value"=>$time_now,"type"=>1);
            }
            if($isHotApp ==1){
                $data["date_of_hot_app"] = array("value"=>$time_now,"type"=>1);
            }
            $table = "c_album";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionAjaxDelete(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_image";
            $result = CommonDB::deleteRow($table,array("albumId"=>$id));
            $table  = "c_data";
            $result = CommonDB::deleteRow($table,array("dataId"=>$id));
            $table = "c_album";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }

    public function actionImage(){

        $albumId = isset($_GET["albumId"]) ? intval($_GET["albumId"]):0;
        $data_album = AAlbum::getDataById($albumId);
        if($data_album){
            $this->breadcrumbs[] = array('name'=>'Danh sách ảnh của album: '.$data_album["title"],'link'=>'#','class'=>'active');
            $data_image = AImage::getDataByAlbum($albumId);
            $this->render("image",array("data_image"=>$data_image,"data_album"=>$data_album));
        }
    }

    public function actionAjaxDeleteImage(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_image";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
}
