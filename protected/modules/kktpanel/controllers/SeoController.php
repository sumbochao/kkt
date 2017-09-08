
<?php
class SeoController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản trị SEO','link'=>$url->createUrl("seo/index"),'class'=>'');
    }
    public function actionCategory(){
        $this->breadcrumbs[] = array('name'=>'Seo Danh Mục','link'=>"#",'class'=>'active');
        $catId = isset($_GET["catId"]) ? intval($_GET["catId"]):0;
        $data = ACategory::getDataById($catId); 
        if($data){
            $this->render("category",array("data"=>$data));
        }
    }  
    public function actionAjaxSaveSeoCategory(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $meta_title = isset($_POST["meta_title"]) ? trim($_POST["meta_title"]):"";
        $meta_keyword = isset($_POST["meta_keyword"]) ? trim($_POST["meta_keyword"]):"";
        $meta_description = isset($_POST["meta_description"]) ? trim($_POST["meta_description"]):"";
        $top_content = isset($_POST["top_content"]) ? trim($_POST["top_content"]):"";
        if($id >0){
            $data = array(
                "meta_title"=>array("value"=>$meta_title,"type"=>2),
                "meta_keyword"=>array("value"=>$meta_keyword,"type"=>2),
                "meta_description"=>array("value"=>$meta_description,"type"=>2),
                "top_content"=>array("value"=>$top_content,"type"=>2),
                "id"=>array("value"=>$id,"type"=>1)
            );
            $table = "c_category";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;
            }else{
                echo "Hãy thay đổi dữ liệu trước khi lưu";
            }
        }
    }
    public function actionDetail(){        
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        switch($type){
            case 1: //Game
                $data = AGame::getDataById($id);
                break;
            case 2: //Video
                $data = AVideo::getDataById($id);
                break;
            case 3: //Hinh anh
                $data = AAlbum::getDataById($id);
                break;
            case 4: //Tin tuc
                $data = ANews::getDataById($id);
                break;
            default:
                $data = false;
                break;
        }
        if($data){
            $type_cat = LoadConfig::$type_cat;
            $this->breadcrumbs[] = array('name'=>'Seo '.$type_cat[$type].' Chi tiết ','link'=>"#",'class'=>'active');
            $this->render("detail",array("data"=>$data,"type"=>$type));
        }
    }
    public function actionAjaxSaveSeoDetail(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $type = isset($_POST["type"]) ? intval($_POST["type"]):0;
        $meta_title = isset($_POST["meta_title"]) ? trim($_POST["meta_title"]):"";
        $meta_keyword = isset($_POST["meta_keyword"]) ? trim($_POST["meta_keyword"]):"";
        $meta_description = isset($_POST["meta_description"]) ? trim($_POST["meta_description"]):"";
        $data = array(
            "meta_title"=>array("value"=>$meta_title,"type"=>2),
            "meta_keyword"=>array("value"=>$meta_keyword,"type"=>2),
            "meta_description"=>array("value"=>$meta_description,"type"=>2),
            "id"=>array("value"=>$id,"type"=>1)
        );
        switch($type){
            case 1: //Game
                $table = "c_game";
                break;
            case 2: //Video
                $table = "c_video";
                break;
            case 3: //Hinh anh
                $table = "c_album";
                break;
            case 4: //Tin tuc
                $table = "c_news";
                break;
            default:
                $table = "";
                break;
        }
        if($table !=""){
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;
            }else{
                echo "Hãy thay đổi dữ liệu trước khi lưu";
            }
        }
    }
}