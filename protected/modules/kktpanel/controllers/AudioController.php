<?php
    class AudioController extends CpController
    {
        public function init(){
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Audio','link'=>$url->createUrl("audio/index"),'class'=>'');
        }
        public function actionIndex(){
            $row_per_page = 20; 
            $this->breadcrumbs[] = array('name'=>'DS audio','link'=>'#','class'=>'active');
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $categoryId = isset($_GET["categoryId"]) ? intval($_GET["categoryId"]):0;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
            $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
            $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):0;
            $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
            $condition = isset($_GET["condition"]) ? intval($_GET["condition"]):2;
            $view = isset($_GET["view"]) ? intval($_GET["view"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $data_cat = ACategory::getAllData(5);
            
            list($max_page,$count,$data) = AAudio::getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$orderBy,$compare,$condition,$view,$page,$row_per_page);

            $this->render("index",array("data_cat"=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
            "from_date"=>$from_date,"to_date"=>$to_date,"categoryId"=>$categoryId,"keyword"=>$keyword,"type"=>$type,
            "status"=>$status,"orderBy"=>$orderBy,"compare"=>$compare,"condition"=>$condition,"view"=>$view,"page"=>$page));
            
            
        }
        public function actionCreate(){
            $this->breadcrumbs[] = array('name'=>'Thêm mới audio','link'=>'#','class'=>'active');
            $file_name = AAudio::getFilenameById(0);
            $data_cat = ACategory::getAllData(5);
            $arr_app = AVideo::getAppByType(5);
            $this->render("create",array("data_cat"=>$data_cat,"file_name"=>$file_name,"arr_app"=>$arr_app));
        }
        public function actionAjaxSaveAudio(){

            $time_now = time();
            $create_user = Yii::app()->user->name;
            $arr = isset($_POST["arr"])? $_POST['arr'] :"";
            $title_audio = isset($_POST["title_audio"])? trim(strip_tags($_POST['title_audio'])) :"";
            $author = isset($_POST["author"])? trim(strip_tags($_POST['author'])) :"";
            $reader = isset($_POST["reader"])? trim(strip_tags($_POST['reader'])) :"";
            $chapter = isset($_POST["chapter"])? trim(strip_tags($_POST['chapter'])) :"";
            $picture_240_320 = isset($_POST["picture_240_320"])? trim($_POST['picture_240_320']) :"";
            $description = isset($_POST["description"])? trim(strip_tags($_POST['description'])) :"";
            $status = isset($_POST["status"])? intval($_POST['status']) :0;
            $price = isset($_POST["price"])? intval($_POST['price']) :0;
            $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;

            if($title_audio == ''){ echo "Tên audio không được để trống";exit;}
            if(Common::generate_slug($title_audio)==''){
                echo "Tên audio không hợp lệ";exit;
            }
            if($author == ''){ echo "Tên tác giả không được để trống";exit;}
            if($reader == ''){ echo "Tên người đọc không được để trống";exit;}
            if($arr == ""){ echo "Danh mục không được để trống";exit;}
            if($appId == ""){ echo "Bạn chưa chọn app";exit;}
            if($picture_240_320 == ''){ echo "Chưa up ảnh";exit;}

            $data = array(
            "title"=>array("value"=>$title_audio,"type"=>2),
            "title_no_sign"=>array("value"=>StringUtils::RemoveSign($title_audio),"type"=>2),
            "author"=>array("value"=>$author,"type"=>2),
            "image"=>array("value"=>$picture_240_320,"type"=>2),
            "reader"=>array("value"=>$reader,"type"=>2),
            "description"=>array("value"=>$description,"type"=>2),
            "status"=>array("value"=>$status,"type"=>1), 
            "app_ids"=>array("value"=>$appId,"type"=>1),    
            "c_chapter"=>array("value"=>$chapter,"type"=>1),    
            "create_date"=>array("value"=>$time_now,"type"=>1),    
            "update_date"=>array("value"=>$time_now,"type"=>1),
            "create_user"=>array("value"=>$create_user,"type"=>2),     
            "price"=>array("value"=>$price,"type"=>1),
            );
            $table = "c_story_audio";
            $story_id = CommonDB::insertRow($table,$data);

            foreach($arr as $key=>$value){
                $data_audio_category = array(
                "story_audio_id"=>array("value"=>$story_id,"type"=>1),
                "cat_id"=>array("value"=>$value,"type"=>1),    
                );
                $table = "c_category_story_audio";
                $insert = CommonDB::insertRow($table,$data_audio_category);
            }

            $table = "c_story_audio_file";
            $audio_file_id = AAudio::updateStoryAudioId($story_id);


            if($story_id >0 && $audio_file_id>0){
                echo 1;
            }else{
                echo "Bạn chưa nhập file audio";exit;
            }
        }
        public function actionAjaxSaveAudioDetail(){

            $time_now = isset($_POST["create_date"])? trim(strip_tags($_POST['create_date'])) : time();
            $story_audio_id = isset($_POST["id"])? trim(strip_tags($_POST['id'])) :0;
            $file_upload = isset($_POST["file_audio"])? trim(strip_tags($_POST['file_audio'])) :"";
            $file_ftp =isset($_POST["file_audio_ftp"])? trim(strip_tags($_POST['file_audio_ftp'])) :"";
            $title_chapter = isset($_POST["title_chapter"])? trim(strip_tags($_POST['title_chapter'])) :"";
            $size = isset($_POST["size"])? trim(strip_tags($_POST['size'])) :"";
            $duration = isset($_POST["duration"])? trim(strip_tags($_POST['duration'])) :"";
            $upload = isset($_POST["upload"])? intval($_POST['upload']) :0;

            $file_upload = Common::remove_duplicate(ltrim(str_replace(";",",",$file_upload),","));
            $file_ftp = Common::remove_duplicate(ltrim(str_replace(";",",",$file_ftp),","));  

            if($upload == 1){
                if($file_upload==""){
                    echo " Bạn chưa upload file";die;
                }else{
                    $file_audio = $file_upload;
                }
            } 
            if($upload==0){
                if($file_ftp==""){
                    echo "Bạn chưa nhập tên tên file upload";die;
                }else{
                    $file_audio = $file_ftp;
                }  
            }

            if($file_audio==''){ 
                echo "Chưa upload file audio";exit;
            }
            if($title_chapter==''){ 
                echo "Chưa nhập tên chương";exit;
            }   

            if($size == ''){ echo "Chưa nhập dung lượng";exit;}
            if($duration == ''){ echo "Chưa nhập thời gian";exit;}     

            $data_audio = array(
            "story_audio_id"=>array("value"=>$story_audio_id,"type"=>1),
            "title"=>array("value"=>$title_chapter,"type"=>2),
            "file"=>array("value"=>$file_audio,"type"=>2),
            "duration"=>array("value"=>$duration,"type"=>2),    
            "size"=>array("value"=>$size,"type"=>2),    
            "create_date"=>array("value"=>$time_now,"type"=>1),    
            );

            $table = "c_story_audio_file";
            $audio_file_id = CommonDB::insertRow($table,$data_audio);


            if($audio_file_id >0 ){
                $file_name = AAudio::getFilenameById($story_audio_id);
                $this->renderPartial("ajaxTableDetail",array("file_name"=>$file_name));
            }
        }
        public function actionAjaxQuickUpdate(){
            $time_now = time();
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            if($id >0){
                $result = AData::updateStatusByDataId($id,$status);
                $data = array(
                "status"=>array("value"=>$status,"type"=>1),
                "id"=>array("value"=>$id,"type"=>1)
                );

                $table = "c_story_audio";
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
                /*Xóa ảnh trên server*/
                $data = AAudio::getDataById($id);
                $file_location = getcwd();
                $file_location1 = getcwd();
                $file_location.="/upload/audio/".date('Y/md',$data['create_date'])."/".$data['image'];
                $file_location1.="/upload/audio/".date('Y/md',$data['create_date'])."/"."m_".$data['image'];
                $result1 = unlink($file_location);
                $result1 = unlink($file_location1);
                /*Xóa file trên server*/
                $data_detail = AAudio::getFilenameById($id);
                foreach($data_detail as $key =>$value){
                    $file_location = getcwd();
                    $file_location.="/upload/audio/".date('Y/md',$value['create_date'])."/".$value['file'];
                    $result1 = unlink($file_location);
                }

                $table  = "c_data";
                $result = CommonDB::deleteRow($table,array("dataId"=>$id));
                $table = "c_story_audio";
                $result = CommonDB::deleteRow($table,array("id"=>$id));
                $table = "c_story_audio_file";
                $result = CommonDB::deleteRow($table,array("story_audio_id"=>$id));

                if($result >0){
                    echo 1;exit();
                }else{
                    echo "Chưa thay đổi dữ liệu";
                }
            }
        }
        public function actionEdit(){
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $data = AAudio::getDataById($id);
            $check = AAudio::getCheckCategory($id);
            $this->breadcrumbs[] = array('name'=>'Sửa audio '.$data["title"],'link'=>'#','class'=>'active');
            if($data){
                $file_name = AAudio::getFilenameById($id);
                $data_cat = ACategory::getAllData(5);
                $arr_app = AVideo::getAppByType(5);
                $this->render("edit",array("data"=>$data,"data_cat"=>$data_cat,"file_name"=>$file_name,"arr_app"=>$arr_app,"check"=>$check));
            }
        }
        public function actionAjaxUpdateAudio(){

            $time_now = time();
            $update_user = Yii::app()->user->name;
            $arr = isset($_POST["arr"]) ? $_POST["arr"]:"";
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $title_audio = isset($_POST["title_audio"])? trim(strip_tags($_POST['title_audio'])) :"";
            $author = isset($_POST["author"])? trim(strip_tags($_POST['author'])) :"";
            $reader = isset($_POST["reader"])? trim(strip_tags($_POST['reader'])) :"";
            $chapter = isset($_POST["chapter"])? trim(strip_tags($_POST['chapter'])) :"";
            $picture_240_320 = isset($_POST["picture_240_320"])? trim($_POST['picture_240_320']) :"";
            $description = isset($_POST["description"])? trim(strip_tags($_POST['description'])) :"";
            $status = isset($_POST["status"])? intval($_POST['status']) :0;
            $price = isset($_POST["price"])? intval($_POST['price']) :0;
            $appId = isset($_POST["appId"])? intval($_POST['appId']) :0;

            if($title_audio == ''){ echo "Tên audio không được để trống";exit;}
            if(Common::generate_slug($title_audio)==''){
                echo "Tên audio không hợp lệ";exit;
            }
            if($author == ''){ echo "Tên tác giả không được để trống";exit;}
            if($reader == ''){ echo "Tên người đọc không được để trống";exit;}
            if($arr == ""){ echo "Danh mục không được để trống";exit;}
            if($appId == 0){ echo "App không được để trống";exit;}

            foreach($arr as $key =>$value){
                $arr_new[$value] = $value;
            }
            if($arr_new==null){
                $arr_new=array();
            }
            $arr_old = AAudio::getCheckCategory($id);
            if($arr_old==null){
                $arr_old=array();
            }
            $arr_check = array_diff($arr_new,$arr_old);
            $arr_del = array_diff($arr_old,$arr_new);

            if(!empty($arr_check)){
                foreach($arr_check as $key=>$value){
                    $check = AAudio::insertCategory($id,$value);
                }
            }
            if(!empty($arr_del)){
                foreach($arr_del as $key=>$value){
                    $del =AAudio::deleteCategory($id,$value);
                }
            }

            $data = array(
            "title"=>array("value"=>$title_audio,"type"=>2),
            "title_no_sign"=>array("value"=>StringUtils::RemoveSign($title_audio),"type"=>2),
            "author"=>array("value"=>$author,"type"=>2),
            "image"=>array("value"=>$picture_240_320,"type"=>2),
            "reader"=>array("value"=>$reader,"type"=>2),
            "description"=>array("value"=>$description,"type"=>2),
            "status"=>array("value"=>$status,"type"=>1), 
            "app_ids"=>array("value"=>$appId,"type"=>1),    
            "c_chapter"=>array("value"=>$chapter,"type"=>1),    
            "update_date"=>array("value"=>$time_now,"type"=>1),    
            "id"=>array("value"=>$id,"type"=>1),
            "update_user"=>array("value"=>$update_user,"type"=>2),     
            "price"=>array("value"=>$price,"type"=>1),
            );

            $table = "c_story_audio";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;
            }else{
                echo "Có lỗi trong quá trình xử lý! Hãy báo với kỹ thuật";exit;
            }
        }
        public function actionAjaxGetEditAudioDetail(){
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $upload = isset($_POST["upload"]) ? intval($_POST["upload"]):0;
            $data_edit = AAudio::getAudioDetailById($id);
            $this->renderPartial("ajaxDataEdit",array("data_edit"=>$data_edit,"upload" =>$upload));
        }
        public function actionAjaxUpdateAudioDetail(){
            $time_now = time();
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $story_audio_id = isset($_POST["story_audio_id"]) ? intval($_POST["story_audio_id"]):0;
            $title_chapter = isset($_POST["title_chapter"])? trim(strip_tags($_POST['title_chapter'])) :"";
            $size = isset($_POST["size"])? trim(strip_tags($_POST['size'])) :"";
            $duration = isset($_POST["duration"])? trim(strip_tags($_POST['duration'])) :"";
            $upload = isset($_POST["upload"])? intval($_POST['upload']) :0;
            $file_audio_upload = isset($_POST["file_audio"])? trim(strip_tags($_POST['file_audio'])) :"";
            $file_audio_ftp = isset($_POST["file_audio_ftp"])? trim(strip_tags($_POST['file_audio_ftp'])) :"";

            $file_audio_upload = Common::remove_duplicate(ltrim(str_replace(";",",",$file_audio_upload),","));
            $file_audio_ftp = Common::remove_duplicate(ltrim(str_replace(";",",",$file_audio_ftp),","));
            if($upload == 1){
                if($file_audio_upload==''){ 
                    echo "Chưa upload file audio";exit;
                }else{
                    $file_audio =$file_audio_upload;
                }
            } 

            if($upload == 0){
                if($file_audio_ftp==''){ 
                    echo "Chưa upload file audio";exit;
                }else{
                    $file_audio=$file_audio_ftp;
                }
            }
            if($title_chapter==''){ 
                echo "Tên chương không được để trống";exit;
            }  
            if($size == ''){ echo "Dung lượng không được để trống";exit;}
            if($duration == ''){ echo "Thời gian không được để trống";exit;}
            $data_audio = array(
            "id"=>array("value"=>$id,"type"=>1),
            "title"=>array("value"=>$title_chapter,"type"=>2),
            "file"=>array("value"=>$file_audio,"type"=>2),
            "duration"=>array("value"=>$duration,"type"=>2),  
            "size"=>array("value"=>$size,"type"=>2),  
            );
            $table = "c_story_audio_file";
            $result1 = CommonDB::updateRow($table,$data_audio,array("id"));

            $file_name = AAudio::getFilenameById($story_audio_id);
            $this->renderPartial("ajaxTableDetail",array("file_name"=>$file_name));



        }
        public function actionAjaxDeleteAudioDetail(){
            $time_now = time();
            $id_del = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $id = isset($_POST["content_id"]) ? intval($_POST["content_id"]):0;

            /*Xóa file trên server*/
            $data = AAudio::getAudioDetailById($id_del);
            $file_location = getcwd();
            $file_location.="/upload/audio/".date('Y/md',$data[0]['create_date'])."/".$data[0]['file'];
            //var_dump($file_location);die;
            $result1 = unlink($file_location);

            $table = "c_story_audio_file";
            $result = CommonDB::deleteRow($table,array("id"=>$id_del));
            if($result >0){
                $file_name = AAudio::getFilenameById($id);
                $this->renderPartial("ajaxTableDetail",array("file_name"=>$file_name));
            }

        }

        public function actionShow(){
            phpinfo();
        }
        public function actionTest(){
            //$str= "/home/webhome/kenhkiemtien.com/upload/audio/2013/0416/icon_audio_18.png";
            var_dump(umask());die;
            $str = getcwd();

            $str.="/upload/audio/2013/0416/m_icon_audio_18.png";
            echo $str;
            unlink($str);
        }
        
          public function actionAjaxGetNotify()
        {
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            
            $data = AAudioNotice::getNotice($object_id);
        
            $result = "";
            foreach ($data as $key=>$value)
            {
                $key +=1;
                $result .= "<tr id='". $object_id ."". $value['id'] ."'>";
                $result .= "<td>". $key ."</td>";
                $result .= "<td>". $value['content'] ."</td>";
                if($value['status'] == 0)
                {
                    $result .= "<td>Inactive</td>";
                }
                else
                {
                    $result .= "<td>Active</td>";
                }
                $result .= "<td>". $value['time_sent'] ."</td>";
                $result .= "<td>". $value['create_date'] ."</td>";
                $result .= "<td><a href='javascript:void(0);' onclick='ajaxDeleteNotify(". $value['id'] .",". $object_id ."". $value['id'] .");'>Delete</a></td>";
                $result .= "</tr>";
            }
        
            echo $result;
        
        }
        
        public function actionAjaxDeleteNotify()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
        
            $result = AAudioNotice::deleteNotice($id);
        
            if($result > 0)
            {
                echo $result;
            }
        }
        
        public function actionAjaxSaveNotify()
        {
            $create_date = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $content = isset($_POST['content'])? trim(strip_tags($_POST['content'])): "";
            $time = isset($_POST['time'])? trim(strip_tags($_POST['time'])): "";
     
            $status = 1;
           
            $audio = AAudio::getDataById($object_id);
            
            $ctime =    date("Y/md",$audio['create_date']);
             if($audio['image']!="")
             $audio['image'] = "http://kenhkiemtien.com/upload/audio/".$ctime."/".$audio['image'];
             $icon = $audio["image"];
             
            if($content == "")
            {
                echo "Nội dung không được để trống";exit;
            }
            if($time == "")
            {
                echo "Thời gian gửi không được để trống";exit;
            }
            if(strtotime($time) === false)
            {
                echo "Thời gian gửi không đúng định dạng";exit;
            }
             
            $result = AAudioNotice::insertNoticeGame($object_id, $content, $status, $time, $create_date, $create_user,$icon);
             
            if($result>0)
            {
                echo $result;exit;
            }
        }
    }
?>
