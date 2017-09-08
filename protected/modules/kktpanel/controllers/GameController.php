<?php
class GameController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT Game','link'=>$url->createUrl("game/index"),'class'=>'');
    }
    public function actionIndex(){   

        $row_per_page = 20; 
        $this->breadcrumbs[] = array('name'=>'DS App Game','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
        $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
        $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):3;
        $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $data_cat = ACategory::getAllData(1);
        list($max_page,$count,$data) = AGame::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$orderBy,$compare,$page,$row_per_page);
        $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
        "status"=>$status,"orderBy"=>$orderBy,"compare"=>$compare,"page"=>$page));

    }
    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới app game','link'=>'#','class'=>'active');
        $data_cat = ACategory::getAllData(1);
        $arr_app = AVideo::getAppByType(1);
        $this->render("create",array("data_cat"=>$data_cat,"arr_app"=>$arr_app));
    }
    public function actionAjaxSaveGame(){
        $time_now = time();
        $file_jar="";
        $file_jad="";
        $file_apk="";
        $file_ipa="";

        $create_user = Yii::app()->user->name;
        $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
        $file_game=ltrim($file_game,";");
        $arr = isset($_POST["arr"])? $_POST['arr'] :"";
        $title_game = isset($_POST["title_game"])? trim(strip_tags($_POST['title_game'])) :"";
        $link_store = isset($_POST["link_store"])? trim(strip_tags($_POST['link_store'])) :"";
        $image = isset($_POST["picture"])? trim($_POST['picture']) :"";
        $description = isset($_POST["description"])? trim(strip_tags($_POST['description'])) :"";
        $description_short = isset($_POST["description_short"])? trim(strip_tags($_POST['description_short'])) :"";
        $status = isset($_POST["status"])? intval($_POST['status']) :0;
        $isHot = isset($_POST["isHot"])? intval($_POST['isHot']) :0;
        $price = isset($_POST["price"])? intval($_POST['price']) :0;
        $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;  
        $partnerId = isset($_POST["partnerId"])? intval($_POST['partnerId']) :0;
        $arr_game =explode(";",$file_game);
        foreach($arr_game as $key=>$value){
            if(substr($value,strlen($value)-3,strlen($value))=="jar"){
                $file_jar=$value;
            } else if(substr($value,strlen($value)-3,strlen($value))=="jad"){
                    $file_jad=$value;
                } else if(substr($value,strlen($value)-3,strlen($value))=="apk"){
                        $file_apk=$value;
                    } else if(substr($value,strlen($value)-3,strlen($value))=="ipa"){
                            $file_ipa=$value;
                        } 
        }
        if($link_store!=""){
            $status_link=1;
        }else{
            $status_link=0;
        }
        if($title_game == ''){ echo "Tên app game không được để trống";exit;}
        if($arr == ""){ echo "Danh mục không được để trống";exit;}
        if($appId == ""){ echo "Bạn chưa chọn app";exit;}
        if($image == ''){ echo "Chưa up ảnh";exit;}

        $data = array(
        "title"=>array("value"=>$title_game,"type"=>2),
        "image"=>array("value"=>$image,"type"=>2),
        "price"=>array("value"=>$price,"type"=>1),
        "description_short"=>array("value"=>$description_short,"type"=>2),
        "description"=>array("value"=>$description,"type"=>2),
        "file_jar"=>array("value"=>$file_jar,"type"=>2),
        "file_jad"=>array("value"=>$file_jad,"type"=>2),
        "file_apk"=>array("value"=>$file_apk,"type"=>2),
        "file_ipa"=>array("value"=>$file_ipa,"type"=>2),
        "link_store"=>array("value"=>$link_store,"type"=>2),
        "status_link"=>array("value"=>$status_link,"type"=>1),    
        "appIds"=>array("value"=>$appId,"type"=>1),
        "partnerId"=>array("value"=>$partnerId,"type"=>1),    
        "status"=>array("value"=>$status,"type"=>1), 
        "isHot"=>array("value"=>$isHot,"type"=>1), 
        "create_date"=>array("value"=>$time_now,"type"=>1),    
        "create_user"=>array("value"=>$create_user,"type"=>2),     

        );
        $table = "c_game_app";
        $game_app_id = CommonDB::insertRow($table,$data);
        foreach($arr as $key=>$value){
            $data_audio_category = array(
            "game_app_id"=>array("value"=>$game_app_id,"type"=>1),
            "cat_id"=>array("value"=>$value,"type"=>1),    
            );
            $table = "c_category_game_app";
            $insert = CommonDB::insertRow($table,$data_audio_category);
        }
        if($game_app_id >0 && $insert>0){
            echo 1;
        }else{
            echo "Có lỗi xảy ra trong quá trình xử lý";exit;
        }
    }
     public function actionAjaxDeleteFile(){
        /*Xóa file trên server*/
        $file_game_new ="";
        $id = isset($_POST["id"])? trim(strip_tags($_POST['id'])) :0;  
        $path = isset($_POST["path"])? trim(strip_tags($_POST['path'])) :"/gameapp/2012/0205";
        $file_name = isset($_POST["filename"])? trim(strip_tags($_POST['filename'])) :"";
        $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
        $file_game=ltrim($file_game,";");
        $arr_game = explode(";",$file_game);
        for($i=0;$i<count($arr_game);$i++){
            if($arr_game[$i]==$file_name ){
                unset($arr_game[$i]);
                //var_dump(getcwd()."/".$path.$arr_game[$i])  ;
                //unlink(getcwd()."/".$path.$arr_game[$i]);
            }
        }
        /* Xử lý xóa field trên db */
        $arr_ext = explode(".",$file_name);
        if($arr_ext[1]=="apk"){
            $field ="file_apk";
        }else if($arr_ext[1]=="jar"){
            $field ="file_jar";
        }else if($arr_ext[1]=="jad"){
            $field ="file_jad";
        } else if($arr_ext[1]=="ipa"){
            $field ="file_ipa";
        } else if($arr_ext[1]=="plist"){
            $field ="file_plist";
        }  
        AGame::updateDeleteField($id,$field) ;
        /* End */
        $arr_game_new = array_values($arr_game);
        for($i=0;$i<count($arr_game_new);$i++){
            $file_game_new.=";".$arr_game_new[$i];
        }
        $file_game_new=ltrim($file_game_new,";");
        $file_location = getcwd();
        $file_location.="/upload/".$path;
        $result = unlink($file_location);
        //var_dump($result);die;
        if($result==true){
            if(empty($file_game_new)){
                echo 1;die;
            }else{
               echo $file_game_new;die; 
            }
        }else{
            echo 0;die;
        }
    }
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
        $isHot = isset($_POST["isHot"]) ? intval($_POST["isHot"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $data = array(
            "status"=>array("value"=>$status,"type"=>1),
            "isHot"=>array("value"=>$isHot,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );

            $table = "c_game_app";
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
        $data = AGame::getDataById($id);
        $check = AGame::getCheckCategory($id);     
        $this->breadcrumbs[] = array('name'=>'Sửa audio '.$data["title"],'link'=>'#','class'=>'active');
        if($data){
            $data_cat = ACategory::getAllData(1);
            $arr_app = AVideo::getAppByType(1);
            $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat,"arr_app"=>$arr_app,"check"=>$check));
        }
    }
    public function actionAjaxUpdateGame(){
        $time_now = time();
        $file_jar="";
        $file_jad="";
        $file_apk="";
        $file_ipa="";

        $modify_user = Yii::app()->user->name;
        $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
        $file_game=ltrim($file_game,";");
        $arr = isset($_POST["arr"])? $_POST['arr'] :"";
        $title_game = isset($_POST["title_game"])? trim(strip_tags($_POST['title_game'])) :"";
        $link_store = isset($_POST["link_store"])? trim(strip_tags($_POST['link_store'])) :"";
        $image = isset($_POST["picture"])? trim($_POST['picture']) :"";
        $description = isset($_POST["description"])? trim(strip_tags($_POST['description'])) :"";
        $description_short = isset($_POST["description_short"])? trim(strip_tags($_POST['description_short'])) :"";
        $status = isset($_POST["status"])? intval($_POST['status']) :0;
        $isHot = isset($_POST["isHot"])? intval($_POST['isHot']) :0;
        $price = isset($_POST["price"])? intval($_POST['price']) :0;
        $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;
        $partnerId = isset($_POST["partnerId"])? intval($_POST['partnerId']) :0;
        $id = isset($_POST["id"])? intval($_POST['id']) :0;
        $arr_game =explode(";",$file_game);
        foreach($arr_game as $key=>$value){
            if(substr($value,strlen($value)-3,strlen($value))=="jar"){
                $file_jar=$value;
            } else if(substr($value,strlen($value)-3,strlen($value))=="jad"){
                    $file_jad=$value;
                } else if(substr($value,strlen($value)-3,strlen($value))=="apk"){
                        $file_apk=$value;
                    } else if(substr($value,strlen($value)-3,strlen($value))=="ipa"){
                            $file_ipa=$value;
                        } 
        }
        if($link_store!=""){
            $status_link=1;
        }else{
            $status_link=0;
        }
        if($title_game == ''){ echo "Tên app game không được để trống";exit;}
        if($arr == ""){ echo "Danh mục không được để trống";exit;}
        if($appId == ""){ echo "Bạn chưa chọn app";exit;}
        if($image == ''){ echo "Chưa up ảnh";exit;}

        foreach($arr as $key =>$value){
            $arr_new[$value] = $value;
        }
        $arr_old = AGame::getCheckCategory($id);

        $arr_check = array_diff($arr_new,$arr_old);
        $arr_del = array_diff($arr_old,$arr_new);

        if(!empty($arr_check)){
            foreach($arr_check as $key=>$value){
                $check = AGame::insertCategory($id,$value);
            }
        }
        if(!empty($arr_del)){
            foreach($arr_del as $key=>$value){
                $del =AGame::deleteCategory($id,$value);
            }
        }

        $data = array(
        "id"=>array("value"=>$id,"type"=>1),
        "title"=>array("value"=>$title_game,"type"=>2),
        "image"=>array("value"=>$image,"type"=>2),
        "price"=>array("value"=>$price,"type"=>1),
        "description_short"=>array("value"=>$description_short,"type"=>2),
        "description"=>array("value"=>$description,"type"=>2),
        "file_jar"=>array("value"=>$file_jar,"type"=>2),
        "file_jad"=>array("value"=>$file_jad,"type"=>2),
        "file_apk"=>array("value"=>$file_apk,"type"=>2),
        "file_ipa"=>array("value"=>$file_ipa,"type"=>2),
        "link_store"=>array("value"=>$link_store,"type"=>2),
        "status_link"=>array("value"=>$status_link,"type"=>1),    
        "appIds"=>array("value"=>$appId,"type"=>1), 
        "partnerId"=>array("value"=>$partnerId,"type"=>1),   
        "status"=>array("value"=>$status,"type"=>1), 
        "isHot"=>array("value"=>$isHot,"type"=>1), 
        "modify_date"=>array("value"=>$time_now,"type"=>1),    
        "create_user"=>array("value"=>$modify_user,"type"=>2),     

        );
        $table = "c_game_app";
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
            /*Xóa ảnh trên server*/
            $data = AGame::getDataById($id);
            $file_location = getcwd();
            $file_location1 = getcwd();
            $file_location.="/upload/gameapp/".date('Y/md',$data['create_date'])."/".$data['image'];
            $file_location1.="/upload/gameapp/".date('Y/md',$data['create_date'])."/"."m_".$data['image'];
            $result1 = unlink($file_location);
            $result1 = unlink($file_location1);
            /*Xóa file trên server*/


            $file_location = getcwd();
            if($data['file_jar']!=""){
                $file_location_jar = $file_location."/upload/audio/".date('Y/md',$value['create_date'])."/".$data['file_jar'];
                $result1 = unlink($file_location);
            }
            if($data['file_jad']!=""){
                $file_location_jar = $file_location."/upload/audio/".date('Y/md',$value['create_date'])."/".$data['file_jad'];
                $result1 = unlink($file_location);
            }
            if($data['file_apk']!=""){
                $file_location_jar = $file_location."/upload/audio/".date('Y/md',$value['create_date'])."/".$data['file_apk'];
                $result1 = unlink($file_location);
            }
            if($data['file_ipa']!=""){
                $file_location_jar = $file_location."/upload/audio/".date('Y/md',$value['create_date'])."/".$data['file_ipa'];
                $result1 = unlink($file_location);
            }
            $table = "c_game_app";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            $table = "c_category_game_app";
            $result = CommonDB::deleteRow($table,array("game_app_id"=>$id));

            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }

}
