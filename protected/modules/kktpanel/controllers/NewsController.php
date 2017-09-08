<?php
class NewsController extends CpController
{
    public function init(){
        $url = new Url();
        $arr_page =LoadConfig::$arr_page;
        $this->breadcrumbs[] = array('name'=>'QT Tin tức','link'=>$url->createUrl("news/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 20; $arr_game_id = array();  
        $this->breadcrumbs[] = array('name'=>'DS tin tức','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $isHot = isset($_GET["isHot"]) ? intval($_GET["isHot"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $data_cat = ACategory::getAllData(4);
        list($max_page,$count,$data) = ANews::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$isHot,$page,$row_per_page);

        $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
        "status"=>$status,"isHot"=>$isHot,"page"=>$page));
    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới tin tức','link'=>'#','class'=>'active');
        $data_cat = ACategory::getAllData(4);
        $this->render("create",array("data_cat"=>$data_cat));
    }

    public function actionAjaxSaveNews(){ 
        $time_now = time();    
        $create_user = Yii::app()->user->name;        
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0; 
        $title_news = isset($_POST["title_news"]) ? trim(strip_tags($_POST["title_news"])):""; 
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):""; 
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):""; 
        $description = isset($_POST["description"]) ? trim($_POST["description"]):""; 
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0; 
        $page_id = isset($_POST["page_id"])? intval($_POST['page_id']) :1;
        $tags = isset($_POST["tags"])? trim(strip_tags($_POST['tags'])) :"";
        if($title_news == ''){ echo "Tiêu đề tin không được để trống";exit;}
        if(Common::generate_slug($title_news)==''){
            echo "Tiêu đề tin không hợp lệ";exit;
        }
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}
        $data_cat = ACategory::getDataById($categoryId);
        $data = array(
        "categoryId"=>array("value"=>$categoryId,"type"=>1),
        "title"=>array("value"=>$title_news,"type"=>2),
        "page_id"=>array("value"=>$page_id,"type"=>1),
        "tags"=>array("value"=>$tags,"type"=>2),
        "alias"=>array("value"=>Common::generate_slug($title_news),"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "introtext"=>array("value"=>$introtext,"type"=>2),
        "description"=>array("value"=>$description,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1),    
        "create_date"=>array("value"=>$time_now,"type"=>1),    
        "update_date"=>array("value"=>$time_now,"type"=>1),
        "create_user"=>array("value"=>$create_user,"type"=>2),    
        );
        $table = "c_news";
        $newsId = CommonDB::insertRow($table,$data);
        /* them trong bang c_data*/        
        $data_c = array(
        "categoryId"=>array("value"=>$data_cat["id"],"type"=>1),
        "type"=>array("value"=>$data_cat["type"],"type"=>1),
        "dataId"=>array("value"=>$newsId,"type"=>1),
        "status"=>array("value"=>$status,"type"=>1),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "update_date"=>array("value"=>$time_now,"type"=>1),
        );
        $table = "c_data";
        $data_id = CommonDB::insertRow($table,$data_c);
        if($newsId >0){
            echo 1;
        }else{
            echo "Có lỗi trong quá trình xử lý! Hãy báo với kỹ thuật";exit;
        }
    }
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $isHome = isset($_POST["isHome"]) ? intval($_POST["isHome"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $result = AData::updateStatusByDataId($id,$status);
            $data = array(
            "isHot"=>array("value"=>$isHot,"type"=>1),
            "isHome"=>array("value"=>$isHome,"type"=>1),
            "status"=>array("value"=>$status,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );
            if($isHot ==1){
                $data["date_of_hot"] = array("value"=>$time_now,"type"=>1);
            }
            if($isHome ==1){
                $data["date_of_home"] = array("value"=>$time_now,"type"=>1);
            }
            $table = "c_news";
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
            $table  = "c_data";
            $result = CommonDB::deleteRow($table,array("dataId"=>$id));
            $table = "c_news";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = ANews::getDataById($id);
        $this->breadcrumbs[] = array('name'=>'Sửa game '.$data["title"],'link'=>'#','class'=>'active');
        if($data){
            $data_cat = ACategory::getAllData(4);
            $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat));
        }
    }
    
    public function actionAjaxUpdateNews(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $title_news = isset($_POST["title_news"]) ? trim(strip_tags($_POST["title_news"])):"";
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0;
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
        $page_id = isset($_POST["page_id"])? intval($_POST['page_id']) :1;
        $tags = isset($_POST["tags"])? trim(strip_tags($_POST['tags'])) :"";
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):"";
        $description = isset($_POST["description"]) ? $_POST["description"]:"";
        if($title_news == ''){ echo "Tiêu đề tin không được để trống";exit;}
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}
        $data_news = ANews::getDataById($id);
        if($data_news){
            if($data_news["categoryId"] != $categoryId){
                $result = AData::updateCategoryByDataId($id,$categoryId);
            }
            $data = array(
            "categoryId"=>array("value"=>$categoryId,"type"=>1),
            "title"=>array("value"=>$title_news,"type"=>2),
            "picture"=>array("value"=>$picture,"type"=>2),
            "page_id"=>array("value"=>$page_id,"type"=>1),
            "tags"=>array("value"=>$tags,"type"=>2),
            "introtext"=>array("value"=>$introtext,"type"=>2),
            "description"=>array("value"=>$description,"type"=>2),
            "update_date"=>array("value"=>$time_now,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1),
            );
            $table = "c_news";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
}
