<?php
class ComicController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Truyện Tranh','link'=>$url->createUrl("comic/index"),'class'=>'');
    }
    public function actionIndex(){   

        $row_per_page = 20; 
        $this->breadcrumbs[] = array('name'=>'DS Truyện tranh','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $data_cat = ACategory::getAllData(6);
        list($max_page,$count,$data) = AComic::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$page,$row_per_page);
        $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
        "status"=>$status,"page"=>$page));

    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới truyện tranh','link'=>'#','class'=>'active');
        $data_cat = ACategory::getAllData(6);
        $arr_app = AVideo::getAppByType(6);
        $this->render("create",array("data_cat"=>$data_cat,"arr_app"=>$arr_app));
    }
    public function actionAjaxSaveComic(){
        $time_now = time();
        $create_user = Yii::app()->user->name;
        $arr = isset($_POST["arr"])? $_POST['arr'] :"";
        $title_comic = isset($_POST["title_comic"])? trim(strip_tags($_POST['title_comic'])) :"";
        $author = isset($_POST["author"])? trim(strip_tags($_POST['author'])) :"";
        $chapter = isset($_POST["chapter"])? intval($_POST['chapter']) :0;
        $image = isset($_POST["picture"])? trim($_POST['picture']) :"";
        $content = isset($_POST["content"])? trim(strip_tags($_POST['content'])) :"";
        $tags = isset($_POST["tags"])? trim(strip_tags($_POST['tags'])) :"";
        $status = isset($_POST["status"])? intval($_POST['status']) :0;
        $status_comic = isset($_POST["status_comic"])? intval($_POST['status_comic']) :0;
        $isHot = isset($_POST["isHot"])? intval($_POST['isHot']) :0;
        $getLink = isset($_POST["getLink"])? intval($_POST['getLink']) :0;
        $price = isset($_POST["price"])? intval($_POST['price']) :0;
        $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;
        
        $image_path .= "/upload/comic/".date("Y/md",$time_now)."/".$image;
        
        if($title_comic == ''){ echo "Tên truyện không được để trống";exit;}
        if($author == ''){ echo "Tên tác giả không được để trống";exit;}
        if($arr == ""){ echo "Danh mục không được để trống";exit;}
        if($appId == ""){ echo "Bạn chưa chọn app";exit;}
        if($image == ''){ echo "Chưa up ảnh";exit;}
        
         /*foreach($arr as $key =>$value){
            $arr_new[$value] = $value;
        }
        if($arr_new==null){
            $arr_new=array();
        }
        $arr_old = AComic::getCheckCategory($id);
        if($arr_old==null){
            $arr_old=array();
        }
        $arr_check = array_diff($arr_new,$arr_old);
        $arr_del = array_diff($arr_old,$arr_new);

        if(!empty($arr_check)){
            foreach($arr_check as $key=>$value){
                $check = AComic::insertCategory($id,$value);
            }
        }
        if(!empty($arr_del)){
            foreach($arr_del as $key=>$value){
                $del =AComic::deleteCategory($value);
            }
        }*/
        
        $data = array(
        "title"=>array("value"=>$title_comic,"type"=>2),
        "title_no_sign"=>array("value"=>StringUtils::RemoveSign($title_comic),"type"=>2),
        "image"=>array("value"=>$image_path,"type"=>2),
        "author"=>array("value"=>$author,"type"=>2),
        "c_chapter"=>array("value"=>$chapter,"type"=>1),
        "price"=>array("value"=>$price,"type"=>1),
        "tags"=>array("value"=>$tags,"type"=>2),
        "content"=>array("value"=>$content,"type"=>2),
        "app_ids"=>array("value"=>$appId,"type"=>1),    
        "status_view"=>array("value"=>$status,"type"=>1), 
        "status"=>array("value"=>$status_comic,"type"=>1), 
        "isHot"=>array("value"=>$isHot,"type"=>1), 
        "get_link_by"=>array("value"=>$getLink,"type"=>1), 
        "create_date"=>array("value"=>$time_now,"type"=>1),    
        "create_user"=>array("value"=>$create_user,"type"=>2),     

        );
        $table = "c_comic";
        $comic_id = CommonDB::insertRow($table,$data);
        foreach($arr as $key=>$value){
            $data_audio_category = array(
            "comic_id"=>array("value"=>$comic_id,"type"=>1),
            "cat_id"=>array("value"=>$value,"type"=>1),    
            );
            $table = "c_category_comic";
            $insert = CommonDB::insertRow($table,$data_audio_category);
        }
        if($comic_id >0 && $insert>0){
            echo 1;
        }else{
            echo "Có lỗi xảy ra trong quá trình xử lý";exit;
        }
    }
    
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $data = array(
            "status_view"=>array("value"=>$status,"type"=>1),
            "isHot"=>array("value"=>$isHot,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );

            $table = "c_comic";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $data = AComic::getDataById($id);
        $check = AComic::getCheckCategory($id);
        $this->breadcrumbs[] = array('name'=>'Sửa truyện tranh '.$data["title"],'link'=>'#','class'=>'active');
        if($data){
            $data_cat = ACategory::getAllData(6);
            $arr_app = AVideo::getAppByType(6);
            $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat,"arr_app"=>$arr_app,"check"=>$check));
        }
    }
    public function actionAjaxUpdateComic(){
        $time_now = time();
        $modify_user = Yii::app()->user->name;
        $arr = isset($_POST["arr"])? $_POST['arr'] :"";
        $title_comic = isset($_POST["title_comic"])? trim(strip_tags($_POST['title_comic'])) :"";
        $author = isset($_POST["author"])? trim(strip_tags($_POST['author'])) :"";
        $chapter = isset($_POST["chapter"])? intval($_POST['chapter']) :0;
        $image = isset($_POST["picture"])? trim($_POST['picture']) :"";
        $content = isset($_POST["content"])? trim(strip_tags($_POST['content'])) :"";
        $tags = isset($_POST["tags"])? trim(strip_tags($_POST['tags'])) :"";
        $status = isset($_POST["status"])? intval($_POST['status']) :0;
        $status_comic = isset($_POST["status_comic"])? intval($_POST['status_comic']) :0;
        $isHot = isset($_POST["isHot"])? intval($_POST['isHot']) :0;
        $getLink = isset($_POST["getLink"])? intval($_POST['getLink']) :0;
        $price = isset($_POST["price"])? intval($_POST['price']) :0;
        $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;
        $id = isset($_POST["id"])? intval($_POST['id']) :0;
        $create_date = isset($_POST["create_date"])? intval($_POST['create_date']) :0;
        
//        $image_path .= "/upload/comic/".date("Y/md",$create_date)."/".$image;
        
        if($title_comic == ''){ echo "Tên truyện không được để trống";exit;}
        if($author == ''){ echo "Tên tác giả không được để trống";exit;}
        if($arr == ""){ echo "Danh mục không được để trống";exit;}
        if($appId == ""){ echo "Bạn chưa chọn app";exit;}
        if($image == ''){ echo "Chưa up ảnh";exit;}
        

        foreach($arr as $key =>$value){
            $arr_new[$value] = $value;
        }
        if($arr_new==null){
            $arr_new=array();
        }
        $arr_old = AComic::getCheckCategory($id);
        if($arr_old==null){
            $arr_old=array();
        }
        $arr_check = array_diff($arr_new,$arr_old);
        $arr_del = array_diff($arr_old,$arr_new);

        if(!empty($arr_check)){
            foreach($arr_check as $key=>$value){
                $check = AComic::insertCategory($id,$value);
            }
        }
        if(!empty($arr_del)){
            foreach($arr_del as $key=>$value){
                $del =AComic::deleteCategory($id,$value);
            }
        }

        $data = array(
        "id"=>array("value"=>$id,"type"=>1),
        "title"=>array("value"=>$title_comic,"type"=>2),
        "title_no_sign"=>array("value"=>StringUtils::RemoveSign($title_comic),"type"=>2),
        "image"=>array("value"=>$image,"type"=>2),
        "author"=>array("value"=>$author,"type"=>2),
        "c_chapter"=>array("value"=>$chapter,"type"=>1),
        "price"=>array("value"=>$price,"type"=>1),
        "tags"=>array("value"=>$tags,"type"=>2),
        "content"=>array("value"=>$content,"type"=>2),
        "app_ids"=>array("value"=>$appId,"type"=>1),    
        "status_view"=>array("value"=>$status,"type"=>1), 
        "status"=>array("value"=>$status_comic,"type"=>1), 
        "isHot"=>array("value"=>$isHot,"type"=>1), 
        "get_link_by"=>array("value"=>$getLink,"type"=>1), 
        "modify_date"=>array("value"=>$time_now,"type"=>1),    
        "modify_user"=>array("value"=>$modify_user,"type"=>2),     

        );
        $table = "c_comic";
        $result = CommonDB::updateRow($table,$data,array("id"));

        if($result >0){
            echo 1;
        }else{
            echo "Có lỗi xảy ra trong quá trình xử lý";exit;
        }
    }
    public function actionAjaxDelete(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_comic";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            $table = "c_category_comic";
            $result = CommonDB::deleteRow($table,array("comic_id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }

}
