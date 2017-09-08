<?php
class VideoController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Video','link'=>$url->createUrl("video/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 20; 
        $this->breadcrumbs[] = array('name'=>'DS video','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $isHot = isset($_GET["isHot"]) ? intval($_GET["isHot"]):2;
        $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):0;
        $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
        $condition = isset($_GET["condition"]) ? intval($_GET["condition"]):2;
        $view = isset($_GET["view"]) ? intval($_GET["view"]):0;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $data_cat = ACategory::getAllData(2);
        list($max_page,$count,$data) = AVideo::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$isHot,$orderBy,$compare,$condition,$view,$page,$row_per_page);

        $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
        "status"=>$status,"isHot"=>$isHot,"orderBy"=>$orderBy,"compare"=>$compare,"condition"=>$condition,"view"=>$view,"page"=>$page));
    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới video','link'=>'#','class'=>'active');
        $data_cat = ACategory::getAllData(2);
        $app = AVideo::getAppByType(2);
        $this->render("create",array("data_cat"=>$data_cat,"app"=>$app));
    }

    public function actionAjaxSaveVideo(){
        $time_now = time();    
        $link ="";
        $link_mp4 =""; 
        $create_user = Yii::app()->user->name;       
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0; 
        $title_video = isset($_POST["title_video"]) ? trim(strip_tags($_POST["title_video"])):""; 
        $duration = isset($_POST["duration"]) ? trim(strip_tags($_POST["duration"])):"0"; 
        $price = isset($_POST["price"]) ? intval($_POST["price"]):0;       
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):""; 
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):""; 
        $file_video = isset($_POST["file_video"]) ? trim($_POST["file_video"]):""; 
        $file_video_other = isset($_POST["file_video_other"]) ? trim($_POST["file_video_other"]):""; 
        $filename_video = isset($_POST["filename_video"]) ? trim($_POST["filename_video"]):""; 
        $filename_mp4 = isset($_POST["filename_mp4"]) ? trim($_POST["filename_mp4"]):""; 
        $link_video_3gp = isset($_POST["link"]) ? trim($_POST["link"]):""; 
        $link_video_mp4 = isset($_POST["link_mp4"]) ? trim($_POST["link_mp4"]):""; 
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):""; 
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0;   
        $arr = isset($_POST["arr"])? $_POST['arr'] :"";
        $upload = isset($_POST["upload"]) ? intval($_POST["upload"]):0;   
        if($upload==1){
            if($file_video=="" && $file_video_other==""){
                echo "Chưa upload file video";exit;
            } else{
                $file =$file_video;
                $file_mp4 =$file_video_other;
            } 
        }
        if($upload==0){
            if($filename_video=="" && $filename_mp4==""){
                echo "Chưa nhập tên file";exit;
            }else{
                $file =$filename_video;
                $file_mp4 =$filename_mp4;
            } 
        }
        if($upload==2){
            if($link_video_3gp=="" && $link_video_mp4==""){
                echo "Chưa nhập link video";exit;

            }else{
                $link =$link_video_3gp;
                $link_mp4 =$link_video_mp4;
            } 
        }
        if($title_video == ''){ echo "Tên video không được để trống";exit;}
        $title_sms = Common::generate_slug($title_video);
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}

        $data_cat = ACategory::getDataById($categoryId);
        $data = array(
        "categoryId"=>array("value"=>$categoryId,"type"=>1),
        "title"=>array("value"=>$title_video,"type"=>2),
        "title_sms"=>array("value"=>$title_sms,"type"=>2),
        "alias"=>array("value"=>Common::generate_slug($title_video),"type"=>2),
        "picture"=>array("value"=>$picture,"type"=>2),
        "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
        "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
        "file"=>array("value"=>$file,"type"=>2),
        "file_mp4"=>array("value"=>$file_mp4,"type"=>2),
        "link"=>array("value"=>$link,"type"=>2),
        "link_mp4"=>array("value"=>$link_mp4,"type"=>2),
        "introtext"=>array("value"=>$introtext,"type"=>2),
        "status"=>array("value"=>$status,"type"=>1), 
        "app_ids"=>array("value"=>$appId,"type"=>1),    
        "create_date"=>array("value"=>$time_now,"type"=>1),    
        "update_date"=>array("value"=>$time_now,"type"=>1), 
        "isHot"=>array("value"=>$isHot,"type"=>1), 
        "create_user"=>array("value"=>$create_user,"type"=>2),     
        "duration"=>array("value"=>$duration,"type"=>2),  
        "price"=>array("value"=>$price,"type"=>1),
        );

        $table = "c_video";
        $videoId = CommonDB::insertRow($table,$data);
        if($arr == null){
             $arr =array();
        }
        foreach($arr as $key=>$value){
            $data_audio_category = array(
            "video_id"=>array("value"=>$videoId,"type"=>1),
            "cat_id"=>array("value"=>$value,"type"=>1),    
            );
            $table = "c_category_video";
            $insert = CommonDB::insertRow($table,$data_audio_category);
        }
        /* them trong bang c_data*/        
        $data_c = array(
        "categoryId"=>array("value"=>$data_cat["id"],"type"=>1),
        "type"=>array("value"=>$data_cat["type"],"type"=>1),
        "dataId"=>array("value"=>$videoId,"type"=>1),
        "status"=>array("value"=>$status,"type"=>1),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "update_date"=>array("value"=>$time_now,"type"=>1),        
        );
        $table = "c_data";
        $data_id = CommonDB::insertRow($table,$data_c);
        if($videoId >0){
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
            $table = "c_video";
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
        $data = AVideo::getDataById($id);
        $check = AVideo::getCheckCategory($id);
        $this->breadcrumbs[] = array('name'=>'Sửa video '.$data["title"],'link'=>'#','class'=>'active');
        if($data){
            $data_cat = ACategory::getAllData(2);
            $app = AVideo::getAppByType(2);
            $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat,"app"=>$app,"check"=>$check));
        }
    }

    public function actionAjaxUpdateVideo(){
        $time_now = time();
        $link="";
        $link_mp4="";
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $categoryId = isset($_POST["categoryId"]) ? intval($_POST["categoryId"]):0; 
        $title_video = isset($_POST["title_video"]) ? trim(strip_tags($_POST["title_video"])):""; 
        $duration = isset($_POST["duration"]) ? trim(strip_tags($_POST["duration"])):"0"; 
        $price = isset($_POST["price"]) ? intval($_POST["price"]):0;       
        $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):""; 
        $picture_320_240 = isset($_POST["picture_320_240"]) ? trim($_POST["picture_320_240"]):""; 
        $picture_240_320 = isset($_POST["picture_240_320"]) ? trim($_POST["picture_240_320"]):""; 
        $file_video = isset($_POST["file_video"]) ? trim($_POST["file_video"]):""; 
        $file_video_other = isset($_POST["file_video_other"]) ? trim($_POST["file_video_other"]):""; 
        $filename_video = isset($_POST["filename_video"]) ? trim($_POST["filename_video"]):""; 
        $filename_mp4 = isset($_POST["filename_mp4"]) ? trim($_POST["filename_mp4"]):""; 
        $link_video_3gp = isset($_POST["link"]) ? trim($_POST["link"]):""; 
        $link_video_mp4 = isset($_POST["link_mp4"]) ? trim($_POST["link_mp4"]):""; 
        $introtext = isset($_POST["introtext"]) ? trim(strip_tags($_POST["introtext"])):""; 
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $appId = isset($_POST["appId"]) ? intval($_POST["appId"]):0;   
        $arr = isset($_POST["arr"]) ? $_POST["arr"]:"";
        $upload = isset($_POST["upload"]) ? intval($_POST["upload"]):0;   
        if($upload==1){
            if($file_video=="" && $file_video_other==""){
                echo "Chưa upload file video";exit;
            } else{
                $file =$file_video;
                $file_mp4 =$file_video_other;
            } 
        }
        if($upload==0){
            if($filename_video=="" && $filename_mp4==""){
                echo "Chưa nhập tên file";exit;
            }else{
                $file = $filename_video;
                $file_mp4 =$filename_mp4;
            } 
        }
        if($upload==2){
            if($link_video_3gp=="" && $link_video_mp4==""){
                echo "Chưa nhập link video";exit;

            }else{
                $link =$link_video_3gp;
                $link_mp4 =$link_video_mp4;
            } 
        }
        if($title_video == ''){ echo "Tên video không được để trống";exit;}
        $title_sms = Common::generate_slug($title_video);
        if($categoryId == 0){ echo "Danh mục không được để trống";exit;}
        if($picture == ''){ echo "Chưa up ảnh";exit;}

        if($arr == null){
            $arr=array();
        }
        $arr_new=array();
        foreach($arr as $key=>$value){
            $arr_new[$value] = $value;  
        }


        if($arr_new==null){
            $arr_new=array();
        } 

        $arr_old = AVideo::getCheckCategory($id);
        if($arr_old==null){
            $arr_old=array();
        }
        $arr_check = array_diff($arr_new,$arr_old);
        $arr_del = array_diff($arr_old,$arr_new);
        if(!empty($arr_check)){
            foreach($arr_check as $key=>$value){
                $check = AVideo::insertCategory($id,$value);
            }
        }
        if(!empty($arr_del)){
            foreach($arr_del as $key=>$value){
                $del =AVideo::deleteCategory($id,$value);
            }
        }    

        $data_video = AVideo::getDataById($id);
        if($data_video){
            if($data_video["categoryId"] != $categoryId){
                $result = AData::updateCategoryByDataId($id,$categoryId);
            }
            $data = array(
            "categoryId"=>array("value"=>$categoryId,"type"=>1),
            "title"=>array("value"=>$title_video,"type"=>2),
            "title_sms"=>array("value"=>$title_sms,"type"=>2),
            "picture"=>array("value"=>$picture,"type"=>2),
            "picture_320_240"=>array("value"=>$picture_320_240,"type"=>2),
            "picture_240_320"=>array("value"=>$picture_240_320,"type"=>2),
            "app_ids"=>array("value"=>$appId,"type"=>1),
            "price"=>array("value"=>$price,"type"=>1),
            "file"=>array("value"=>$file,"type"=>2),
            "file_mp4"=>array("value"=>$file_mp4,"type"=>2),
            "link"=>array("value"=>$link,"type"=>2),
            "link_mp4"=>array("value"=>$link_mp4,"type"=>2),
            "introtext"=>array("value"=>$introtext,"type"=>2),
            "update_date"=>array("value"=>$time_now,"type"=>1),
            "isHot"=>array("value"=>$isHot,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1),
            "duration"=>array("value"=>$duration,"type"=>2),  
            );
            $table = "c_video";
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

            /*Xóa file trên server*/
            $data = AVideo::getDataById($id);
            $current_folder = getcwd();
            $file_location_file=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/".$data['file'];
            $file_location_file_mp4=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/".$data['file_mp4'];
            $file_location_picture=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/".$data['picture'];
            $file_location_picture_m=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/"."m_".$data['picture'];
            $file_location_picture_320_240=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/".$data['picture_320_240'];
            $file_location_picture_320_240_m=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/"."m_".$data['picture_320_240'];
            $file_location_picture_240_320=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/".$data['picture_240_320'];
            $file_location_picture_240_320_m=$current_folder."/upload/video/".date('Y/md',$data['create_date'])."/"."m_".$data['picture_240_320'];

            unlink($file_location_file);
            unlink($file_location_file_mp4);
            unlink($file_location_picture);
            unlink($file_location_picture_m);
            unlink($file_location_picture_320_240);
            unlink($file_location_picture_320_240_m);
            unlink($file_location_picture_240_320);
            unlink($file_location_picture_240_320_m);

            $table  = "c_data";
            $result = CommonDB::deleteRow($table,array("dataId"=>$id));
            $table = "c_video";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionShow(){
        $link = isset($_GET["link"]) ? trim($_GET["link"]):"";
        $this->breadcrumbs[] = array('name'=>'Xem thử video ','link'=>'#','class'=>'active');
        if($link !=""){
            $this->render("show",array("link"=>$link));
        }
    }
}
