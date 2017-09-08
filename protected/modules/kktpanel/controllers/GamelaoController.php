<?php
    class GamelaoController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Game Lào','link'=>$url->createUrl('gamelao/index'),'class'=>'');
        }

        public function actionIndex()
        {
            $row_per_page = 5;
            $this->breadcrumbs[] = array('name'=>'DS Game Lào','link'=>'#','class'=>'active');

            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
            $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
            $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):0;
            $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $data_cat = ACategory::getAllData(8);
            //var_dump($data_cat);die;
            list($max_page,$count,$data) = AGamelao::getDataSearch($from_date,$to_date,$keyword,$type,$status,$orderBy,$compare,$page,$row_per_page);

            //var_dump($max_page);die;
            //var_dump(2);die;
            $this->render('index',array('data_cat'=>$data_cat,"max_page"=>$max_page,"count"=>$count,"data"=>$data,
                "from_date"=>$from_date,"to_date"=>$to_date,"keyword"=>$keyword,"type"=>$type,
                "status"=>$status,"orderBy"=>$orderBy,"compare"=>$compare,"page"=>$page));

        }

        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Game Lào','link'=>'#','class'=>'active');
            $data_cat = ACategory::getAllData(8);
            $this->render('create',array('data_cat'=>$data_cat));
        }

        public function actionAjaxSaveGame()
        {
            $time_now = time();
            $file_jar = "";
            $file_jad = "";
            $file_apk = "";
            $file_ipa = "";
            $file_plist = "";

            $create_user = Yii::app()->user->name;


            $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
            $file_game=ltrim($file_game,";");
            $link_store = isset($_POST["link_store"])? trim(strip_tags($_POST['link_store'])) :"";
            $title_game = isset($_POST['title_game'])? trim(strip_tags($_POST['title_game'])): "";
            $price = isset($_POST['price'])? intval($_POST['price']): 0;
            $app_type = isset($_POST['app_type'])? intval($_POST['app_type']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $isHot = isset($_POST['isHot'])? intval($_POST['isHot']): 0;
            $image = isset($_POST['picture'])? trim($_POST['picture']): 0;
            $description_short = isset($_POST['description_short'])? trim(strip_tags($_POST['description_short'])): "";
            $description = isset($_POST['description'])? ($_POST['description']) : "";
            //var_dump($description);die;
            $categoryId = isset($_POST['categoryId'])? intval($_POST['categoryId']): 0;
            $arr_game = explode(";",$file_game);

            foreach($arr_game as $key=>$value)
            {
                if(substr($value,strlen($value)-3,strlen($value))=="jar")
                {
                    $file_jar=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="jad")
                {
                    $file_jad=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="apk")
                {
                    $file_apk=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="ipa")
                {
                    $file_ipa=$value;
                }
                elseif(substr($value,strlen($value)-5,strlen($value))=="plist")
                {
                    $file_plist=$value;
                }
            }
            //var_dump($link_store);die;
            //var_dump($file_jar);die;

            if($title_game=="")
            {
                echo "Tên app game không được để trống";
                exit;
            }
            if($image=="")
            {
                echo "Chưa up ảnh";
                exit;
            }

            if($link_store!="")
            {
                $status_link=1;
            }
            else
            {
                $status_link=0;
            }

            $data = array(
                "title"=>array("value"=>$title_game,"type"=>2),
                "image"=>array("value"=>$image,"type"=>2),
                "price"=>array("value"=>$price,"type"=>1),
                "app_type"=>array("value"=>$app_type,"type"=>1),
                "description_short"=>array("value"=>$description_short,"type"=>2),
                "description"=>array("value"=>$description,"type"=>2),
                "cat_id"=>array("value"=>$categoryId,"type"=>1),
                "file_jar"=>array("value"=>$file_jar,"type"=>2),
                "file_jad"=>array("value"=>$file_jad,"type"=>2),
                "file_apk"=>array("value"=>$file_apk,"type"=>2),
                "file_ipa"=>array("value"=>$file_ipa,"type"=>2),
                "file_plist"=>array("value"=>$file_plist,"type"=>2),
                "link_store"=>array("value"=>$link_store,"type"=>2),
                "status_link"=>array("value"=>$status_link,"type"=>1),    
                "status"=>array("value"=>$status,"type"=>1),
                "isHot"=>array("value"=>$isHot,"type"=>1), 
                "create_date"=>array("value"=>$time_now,"type"=>1),    
                "create_user"=>array("value"=>$create_user,"type"=>2),
            );
            $table = "c_game_lao";
            $game_app_id = CommonDB::insertRow($table,$data);

            if($game_app_id >0)
            {
                echo 1;
            }
            else
            {
                echo "Có lỗi xảy ra trong quá trình xử lý";exit;
            }

        }


        public function actionAjaxDeleteFile()
        {
            /*Xóa file trên server*/
            $file_game_new ="";
            $id = isset($_POST["id"])? intval($_POST['id']) :0; 
            //var_dump($id);die;
            $path = isset($_POST["path"])? trim(strip_tags($_POST['path'])) :"/gameapp/2012/0205";
            //var_dump($path);die;
            $file_name = isset($_POST["filename"])? trim(strip_tags($_POST['filename'])) :"";
            //var_dump($file_name);die;
            $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
            $file_game=ltrim($file_game,";");
            $arr_game = explode(";",$file_game);
            for($i=0;$i<count($arr_game);$i++){
                if($arr_game[$i]==$file_name ){
                    unset($arr_game[$i]);
                }
            }
            /* Xử lý xóa field trên db */
            
            $arr_ext = explode(".",$file_name);
            if(end($arr_ext)=="apk"){
                $field ="file_apk";
            }else if(end($arr_ext)=="jar"){
                $field ="file_jar";
            }else if(end($arr_ext)=="jad"){
                $field ="file_jad";
            } else if(end($arr_ext)=="ipa"){
                $field ="file_ipa";
            } else if(end($arr_ext)=="plist"){
                $field ="file_plist";
            }  
            
            AGamelao::updateDeleteField($id,$field) ;

            $arr_game_new = array_values($arr_game);
            for($i=0;$i<count($arr_game_new);$i++){
                $file_game_new.=";".$arr_game_new[$i];
            }
            $file_game_new=ltrim($file_game_new,";");
            $file_location = getcwd();
            //var_dump($file_location); 
            //var_dump($path); 
            $file_location .="/upload/".$path;

            //var_dump($file_location);die; 

            $result = unlink($file_location);
            if($result >0){
                echo 1;exit();
                echo $file_game_new;exit();
            }else{
                echo 0;
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

                $table = "c_game_lao";
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
                $data = AGamelao::getDataById($id);
                $file_location = getcwd();
                $file_location1 = getcwd();
                $file_location.="/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['image'];
                $file_location1.="/upload/gamelao/".date('Y/md',$data['create_date'])."/"."m_".$data['image'];
                $result1 = unlink($file_location);
                $result1 = unlink($file_location1);
                /*Xóa file trên server*/


                $file_location = getcwd();
                if($data['file_jar']!=""){
                    $file_location_jar = $file_location."/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['file_jar'];
                    $result1 = unlink($file_location_jar);
                }
                if($data['file_jad']!=""){
                    $file_location_jad = $file_location."/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['file_jad'];
                    $result1 = unlink($file_location_jad);
                }
                if($data['file_apk']!=""){
                    $file_location_apk = $file_location."/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['file_apk'];
                    $result1 = unlink($file_location_apk);
                }
                if($data['file_ipa']!=""){
                    $file_location_ipa = $file_location."/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['file_ipa'];
                    $result1 = unlink($file_location_ipa);
                }
                if($data['file_plist']!=""){
                    $file_location_ipa = $file_location."/upload/gamelao/".date('Y/md',$data['create_date'])."/".$data['file_plist'];
                    $result1 = unlink($file_location_ipa);
                }
                $table = "c_game_lao";
                $result = CommonDB::deleteRow($table,array("id"=>$id));
                if($result >0){
                    echo 1;exit();
                }else{
                    echo "Chưa thay đổi dữ liệu";
                }
            }
        }


        public function actionEdit()
        {
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;

            $data = AGamelao::getDataById($id);

            $this->breadcrumbs[] = array('name'=>'Sửa Game Lào '.$data["title"],'link'=>'#','class'=>'active');

            $data_cat = ACategory::getAllData(8);
            //var_dump(2);die;
            //var_dump($data);die;
            $this->render("edit",array("data"=>$data,'data_cat'=>$data_cat));
        }

        public function actionAjaxUpdateGame()
        {
            $time_now = time();
            $file_jar = "";
            $file_jad = "";
            $file_apk = "";
            $file_ipa = "";
            $file_plist = "";

            $create_user = Yii::app()->user->name;


            $file_game = isset($_POST["file_game"])? $_POST['file_game'] :"";
            $file_game=ltrim($file_game,";");
            $link_store = isset($_POST["link_store"])? trim(strip_tags($_POST['link_store'])) :"";
            $title_game = isset($_POST['title_game'])? trim(strip_tags($_POST['title_game'])): "";
            $price = isset($_POST['price'])? intval($_POST['price']): 0;
            $app_type = isset($_POST['app_type'])? intval($_POST['app_type']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $isHot = isset($_POST['isHot'])? intval($_POST['isHot']): 0;
            $image = isset($_POST['picture'])? trim($_POST['picture']): 0;
            $categoryId = isset($_POST['categoryId'])? intval($_POST['categoryId']): 0;
            $description_short = isset($_POST['description_short'])? trim(strip_tags($_POST['description_short'])): "";
            $description = isset($_POST['description'])? ($_POST['description']): "";
            $id = isset($_POST["id"])? intval($_POST['id']) :0;

            $arr_game = explode(";",$file_game);

            foreach($arr_game as $key=>$value)
            {
                if(substr($value,strlen($value)-3,strlen($value))=="jar")
                {
                    $file_jar=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="jad")
                {
                    $file_jad=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="apk")
                {
                    $file_apk=$value;
                }
                elseif(substr($value,strlen($value)-3,strlen($value))=="ipa")
                {
                    $file_ipa=$value;
                }
                elseif(substr($value,strlen($value)-5,strlen($value))=="plist")
                {
                    $file_plist=$value;
                    //var_dump($file_plist);die;
                }
            }
            //var_dump($id);die;
            //var_dump($file_jar);die;

            if($title_game=="")
            {
                echo "Tên app game không được để trống";
                exit;
            }
            if($image=="")
            {
                echo "Chưa up ảnh";
                exit;
            }

            if($link_store!="")
            {
                $status_link=1;
            }
            else
            {
                $status_link=0;
            }

            $data = array(
                "id"=>array("value"=>$id,"type"=>1),
                "title"=>array("value"=>$title_game,"type"=>2),
                "image"=>array("value"=>$image,"type"=>2),
                "price"=>array("value"=>$price,"type"=>1),
                "app_type"=>array("value"=>$app_type,"type"=>1),
                "description_short"=>array("value"=>$description_short,"type"=>2),
                "description"=>array("value"=>$description,"type"=>2),
                "cat_id"=>array("value"=>$categoryId,"type"=>1),
                "file_jar"=>array("value"=>$file_jar,"type"=>2),
                "file_jad"=>array("value"=>$file_jad,"type"=>2),
                "file_apk"=>array("value"=>$file_apk,"type"=>2),
                "file_ipa"=>array("value"=>$file_ipa,"type"=>2),
                "file_plist"=>array("value"=>$file_plist,"type"=>2),
                "link_store"=>array("value"=>$link_store,"type"=>2),
                "status_link"=>array("value"=>$status_link,"type"=>1),    
                "status"=>array("value"=>$status,"type"=>1),
                "isHot"=>array("value"=>$isHot,"type"=>1), 
                "modify_date"=>array("value"=>$time_now,"type"=>1),    
                "modify_user"=>array("value"=>$create_user,"type"=>2),
            );
            $table = "c_game_lao";
            $game_app_id = CommonDB::updateRow($table,$data,array("id"));

            if($game_app_id >0)
            {
                echo 1;
            }
            else
            {
                echo "Có lỗi xảy ra trong quá trình xử lý";exit;
            }
        }



    }
?>
