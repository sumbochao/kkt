<?php
    class KktUserController extends Controller
    {
        public $json = array();

        public function actionIndex()
        {      
            $this->metaTitle = "ca nhan - kenhkiemtien.com";  
            $this->direct();
            $userId = $_SESSION["userId"];
            $username = $_SESSION["username"];
            $month = date("m",time());
            $year = date("Y",time());
            $data_rate = Rate::getDataByMonthAndYear($month,$year);
            /* danh sách các chia sẻ */
            $myAdv = User::getListAdv($userId);

            $type = isset($_GET["type"]) ? intval($_GET["type"]) : 1;
            /* Thống kê doanh số cho thành viên */
            $report = Report::getReportByUser($type, $userId);
            $data_refUID = Member::getAllUserByrefUID($userId);
            $total_kkt = 0;
            foreach($data_refUID as $refUID){ 
                $data_report_UID = Report::getReportByUser($type, $refUID);
                $total_kkt += $data_report_UID["total_money_sms_user"];
            }
            $total_user_ref =  $total_kkt * 5 /100;

            list($data_game,$max_page) = Game::getDataGameOffline(1,8);
            list($data_video,$max_page) = Video::getDataVideo(1,5);
            list($data_album,$max_page) = Album::getDataAlbum(1,5);
            $this->render(
            "index"
            , array(
            "myAdv"=>$myAdv                                
            , "username"=>$username
            , "type"=>$type
            , "report"=>$report
            , "total_user_ref"=>$total_user_ref
            , "data_refUID"=>$data_refUID
            , "data_game"=>$data_game
            , "data_video"=>$data_video
            , "data_album"=>$data_album
            , "data_rate"=>$data_rate
            )
            );
        }
        public function actionListData(){
            $this->direct();
            $month = date("m",time());
            $year = date("Y",time());
            $data_rate = Rate::getDataByMonthAndYear($month,$year);
            $row_per_page = 10;
            $typeCat = isset($_GET["typeCat"]) ? intval($_GET["typeCat"]):0;   
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            switch($typeCat){
                case 1:
                    list($data,$max_page) = Game::getDataGameOffline($page,$row_per_page);
                    break;
                case 2:
                    list($data,$max_page) = Video::getDataVideo($page,$row_per_page);
                    break;
                case 3:
                    list($data,$max_page) = Album::getDataAlbum($page,$row_per_page);
                    break;
                default:
                    list($data,$max_page) = array(array(),0);
                    break;
            } 
            $this->render("list_data",array(
            "page"=>$page,
            "typeCat"=>$typeCat,
            "data"=>$data,
            "max_page"=>$max_page,
            "data_rate"=>$data_rate
            )); 
        }
        public function actionListDevice(){
            $this->layout = false;
            $this->direct();        
            $username = $_SESSION["username"];
            $gameId = isset($_GET["gameId"]) ? intval($_GET["gameId"]):0;
            $data_file = Game::getGameFileByID($gameId);
            $data_game = Game::getGameById($gameId);
            if($data_file){
                for($i=0;$i<count($data_file);$i++){
                    $data_file[$i]["handset"] = Download::getDataHandsetByFile($data_file[$i]["id"]);
                } 
                $this->render("list_device",array("data_file"=>$data_file,"data_game"=>$data_game,"username"=>$username));
            }
        }
        public function actionDataDetail(){
            $url = new Url();   
            $this->direct();
            $userId = $_SESSION["userId"];
            $username = $_SESSION["username"];

            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $typeCat = isset($_GET["typeCat"]) ? intval($_GET["typeCat"]):0;         
            $blacklist = Home::getPattern();
            $pattern = !empty($blacklist) ? $blacklist["pattern"] : array();
            $replace = !empty($blacklist) ? $blacklist["replace"] : array();

            $report = array();
            switch($typeCat){
                case 1: //game
                    $data_detail = Game::getGameById($id);
                    if(isset($data_detail["categoryId"])){
                        $data_lastest = Game::getLastestGameByCat($data_detail["categoryId"],1,5);
                    }

                    /* Lấy doanh số chia sẻ */
                    $report["5000"] = ($data_detail["percent_wapmaster"] / 100) * 5000 * 0.45 * 0.85;
                    $report["10000"] = ($data_detail["percent_wapmaster"] / 100) * 10000 * 0.45 * 0.85;
                    $report["15000"] = ($data_detail["percent_wapmaster"] / 100) * 15000 * 0.45 * 0.85;
                    $report["card"] = round(($data_detail["percent_wapmaster"] / 100) * 0.85, 3) * 100;

                    break;
                case 2: //video
                    $data_detail = Video::getVideoById($id);
                    if(isset($data_detail["categoryId"])){
                        $data_lastest = Video::getLastestVideoByCat($data_detail["categoryId"],1,5);
                    }

                    /* Lấy rate của tháng hiện tại */
                    $rate = Rate::getDataByMonthAndYear(date("m"), date("Y"));
                    $report["15000"] = 15000 * 0.45 * 0.85 * ($rate["rate_of_user"] / 100);

                    break;
                case 3: //image
                    $data_detail = Album::getAlbumById($id);
                    if(isset($data_detail["categoryId"])){
                        $data_lastest = Album::getLastestAlbumByCat($data_detail["categoryId"],1,5);
                    }

                    /* Lấy rate của tháng hiện tại */
                    $rate = Rate::getDataByMonthAndYear(date("m"), date("Y"));
                    $report["15000"] = 15000 * 0.45 * 0.85 * ($rate["rate_of_user"] / 100);

                    break;
                default:
                    $data_detail = false;
                    $data_lastest = false;
                    break;
            }

            if($data_detail && $data_lastest){
                if(isset($_POST["content"])){
                    $data = array();
                    $data["userId"] = $_SESSION["userId"];
                    $data["username"] = $_SESSION["username"];
                    $data["content"] = trim($_POST["content"]);
                    $data["dataId"] = intval($_POST["dataId"]);
                    $data["type"] = intval($_POST["type"]);
                    $data["content"] = preg_replace($pattern, $replace, $data["content"]);
                    $data["create_date"] = time() - 1;

                    if(!empty($data["content"])){
                        $result = User::insertNewShare($data);
                    }
                    $this->redirect(Url::createUrl("/kktUser/dataDetail", array("alias"=>$data_detail["alias"], "id"=>$data_detail["id"],"typeCat"=>$typeCat)));
                }
                $month = date("m",time());
                $year = date("Y",time());
                $data_rate = Rate::getDataByMonthAndYear($month,$year);
                /* Lấy danh sách các chia sẻ */
                $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
                $currentPage = $currentPage==0 ? 1 : $currentPage;
                $numberRecordPerPage = 20;

                $share = User::getShare($currentPage, $numberRecordPerPage,$id,$typeCat); 

                $totalShare = User::getTotalShare($id,$typeCat);     

                $numberPage = ceil($totalShare / $numberRecordPerPage); 

                $this->render("data_detail",array(
                "data_detail"=>$data_detail
                ,"data_lastest"=>$data_lastest
                ,"typeCat"=>$typeCat
                , "data_rate"=>$data_rate
                ,"share"=>$share                    
                , "totalShare"=>$totalShare                    
                , "numberPage"=>$numberPage                    
                , "currentPage"=>$currentPage
                , "report"=>$report
                )
                );
            }
        }

        public function actionReportAll()
        {
            $this->direct();

            $userId = $_SESSION["userId"];

            /* danh sách các chia sẻ */
            $myAdv = User::getListAdv($userId);

            /* danh sách đầu số và giá tiền các đầu số */
            $serviceCode = Common::serviceCode();

            /* Thống kê tất cả doanh thu của thành viên theo năm */        
            $year = isset($_GET["year"]) ? intval($_GET["year"]) : date("Y");

            /* Tính tổng doanh thu phát sinh từng tháng trong năm của user */
            $total = ReportSms::getTotalMoney($userId, $year);

            /* lấy tỷ lệ trong các tháng trong năm */
            $rate = ReportSms::getRate($total, $year);

            $report = ReportSms::getReportUserAll($rate, $userId, $year);

            $this->render(
            "report_all"
            , array(
            "myAdv"=>$myAdv
            , "report"=>$report
            , "serviceCode"=>$serviceCode                
            , "year"=>$year
            )
            );
        }

        public function actionProfile()
        {
            $this->metaTitle = "thong tin ca nhan - kenhkiemtien.com";    
            $this->direct();

            $info = User::getUserInfo($_SESSION["userId"]);
            $this->render(
            "profile"
            , array(
            "info"=>$info
            )
            );   
        }

        public function actionEditProfile()
        {
            $this->metaTitle = "sua ca nhan - kenhkiemtien.com";    
            $this->direct();

            $info = Login::getUserInfo($_SESSION["userId"]);
            if(isset($_POST["full_name"])){
                $data = array();
                $data["id"] = $info["id"];
                $data["full_name"] = trim(strip_tags($_POST["full_name"]));
                $data["mobile"] = trim(strip_tags($_POST["mobile"]));
                $data["gender"] = trim(strip_tags($_POST["gender"]));
                $data["birthday"] = "";
                $data["day_birthday"] = 0;
                $data["address"] = trim(strip_tags($_POST["address"]));
                $data["permanent_address"] = trim(strip_tags($_POST["permanent_address"]));
                $data["identity_number"] = trim(strip_tags($_POST["identity_number"]));
                $data["date_of_identity"] = strtotime($_POST["date_of_identity"]);
                $data["which_of_identity"] = trim(strip_tags($_POST["which_of_identity"]));
                $data["account_owner"] = trim(strip_tags($_POST["account_owner"]));
                $data["account_number"] = trim(strip_tags($_POST["account_number"]));
                $data["account_bank"] = trim(strip_tags($_POST["account_bank"]));
                $data["account_branch"] = trim(strip_tags($_POST["account_branch"]));
                $data["personal_tax_code"] = trim(strip_tags($_POST["personal_tax_code"]));

                $result = Login::updateInfo($data);
                if($result >= 0){
                    $this->redirect(Url::createUrl("/kktUser/profile"));
                }
            }

            $this->render(
            "edit_profile"
            , array(
            "info"=>$info
            )
            );
        }
        public function actionEditAvatar(){
            $this->metaTitle = "sua avatar - kenhkiemtien.com";    
            $this->direct();
            $info = User::getUserInfo($_SESSION["userId"]); 
            $error = "";
            $data = array();
            if(isset($_FILES["avatar_url"]["name"])){
                if(empty($error)){
                    $create_date = time();

                    $filename = $_FILES["avatar_url"]["name"];
                    $ext = end(explode(".", $filename));
                    $filename = Common::cleanFileName($filename);                                           
                    $filename = basename($filename, "." . $ext);

                    $image_location = getcwd();                
                    $image_location .= "/upload/avatar/";                                    
                    $image_location .= date("Y/md/", $create_date);

                    if(@chdir($image_location) == false) @mkdir($image_location, 0777, true);
                    $image_location .= $filename . "." . $ext;                
                    $tmp_name = $_FILES["avatar_url"]["tmp_name"];
                    if(@move_uploaded_file($tmp_name, $image_location)){
                        $path_db = '/'.date("Y/md/", $create_date).$filename . "." . $ext; 
                        $params = array(
                        "avatar_url"=>array("value"=>$path_db,"type"=>2),
                        "id"=>array("value"=>intval($_SESSION["userId"]),"type"=>1),
                        );
                        $table = "c_user";
                        $result = CommonDB::updateRow($table,$params,array("id"));
                        if($result > 0){
                            $this->redirect(Url::createUrl("/kktUser/editAvatar"));
                        }
                    }
                }
            }
            $this->render(
            "edit_avatar"
            , array(
            "info"=>$info,
            "error"=>$error
            )
            );  
        }

        public function actionChangePassword()
        {
            $this->direct();
            $error = "";
            if(isset($_POST["password_old"])){
                $userId = $_SESSION["userId"];

                /* Kiểm tra mật khẩu */
                $password_old = trim(strip_tags($_POST["password_old"]));
                $password_old = Common::genPass($password_old);            
                $checkPass = User::checkPass($userId, $password_old);
                $error .= empty($checkPass) ? "<p>- Mật khẩu cũ không đúng</p>" : "";

                $password = trim(strip_tags($_POST["password"]));
                $password_retype = trim(strip_tags($_POST["password_retype"]));

                $error .= empty($password) ? "<p>- Mật khẩu không thể rỗng.</p>" : "";
                $error .= empty($password_retype) ? "<p>- Mật khẩu xác nhận không thể rỗng.</p>" : "";
                if(!empty($password) && !empty($password_retype)){
                    if($password != $password_retype){
                        $error .= "<p>- Hai mật khẩu không trùng khớp</p>";
                    } else {
                        $error .= Common::CheckPassword($password);
                    }
                }

                if(empty($error)){
                    $pass = $password;
                    $password = Common::genPass($password);
                    $password_forum = md5(md5($pass));
                    $result = Login::changePassword($userId, $password, $password_forum);

                    if($result >= 0){
                        if(Yii::app()->params["sendEmail"]){
                        }
                        $this->redirect(Url::createUrl("/kktUser/msgChangePassword"));
                    }
                }
            }

            $this->render(
            "change_password"
            , array(
            "error"=>$error
            )
            );
        }

        public function actionWork()
        {     
            $this->metaTitle = "tien ich - kenhkiemtien.com";   
            $this->direct();

            /* Lấy 1 game mới nhất */        
            $game = User::getLastestGame();
            $month = date("m",time());
            $year = date("Y",time());
            $data_rate = Rate::getDataByMonthAndYear($month,$year);
            list($data_game,$max_page) = Game::getDataGameOffline(1,8);
            list($data_video,$max_page) = Video::getDataVideo(1,5);
            list($data_album,$max_page) = Album::getDataAlbum(1,5);
            $this->render(
            "work"
            , array(
            "game"=>$game
            , "data_game"=>$data_game
            , "data_video"=>$data_video
            , "data_album"=>$data_album
            , "data_rate"=>$data_rate
            )
            );
        }

        public function actionInvite(){
            $this->direct();
            $userId = $_SESSION["userId"];
            $data_user = User::getUserInfo($userId);
            $this->render("invite",array("data_user"=>$data_user));
        }

        public function actionListApp()
        {
            $this->metaTitle = "ban le noi dung so video, game, hinh anh - kenhkiemtien.com";    
            $this->direct();

            /* Lấy 1 game mới nhất */
            $game = User::getLastestGame();

            /* Lấy các danh sách ứng dụng hiện có */
            $app = User::getListApp();

            $this->render(
            "list_app"
            , array(
            "app"=>$app    
            , "game"=>$game
            )
            );
        }
        public function actionGameOnline(){
            $this->metaTitle = "phan phoi game online, ung dung di dong - kenhkiemtien.com";
            $this->direct();
            $game_new = User::getLastestGame();
            $game = User::getDataGameOnline();
            $this->render("game_online",array("game"=>$game,"game_new"=>$game_new));
        }

        public function actionSellNowGame(){
            $this->direct();

            $username = $_SESSION["username"];
            $gameId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
            if(empty($gameId)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }

            /* Lấy thông tin về app */                
            $game = Game::getGameById($gameId);
            $data_game = Data::getDataByDataId($gameId);
            if(empty($game)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }

            if(isset($_POST["content"])){
                $data = array();
                $data["userId"] = $_SESSION["userId"];
                $data["username"] = $_SESSION["username"];
                $data["content"] = $_POST["content"];
                $data["create_date"] = time() - 1;
                $result = User::InsertShare($data);
                $this->redirect(Url::createUrl("/kktUser/sellNowGame", array("id"=>$gameId)));
            }

            /* Lấy danh sách các chia sẻ */
            $share = User::getShare();

            $this->render(
            "sell_now_game"
            , array(
            "game"=>$game,"data_game"=>$data_game                    
            , "username"=>$username                    
            , "share"=>$share                    
            )
            );
        }

        public function actionSellNow()
        {
            $this->direct();

            $username = $_SESSION["username"];
            $appId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
            if(empty($appId)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }

            /* Lấy thông tin về app */                
            $app = User::getInfoApp($appId);
            if(empty($app)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }

            if(isset($_POST["content"])){
                $data = array();
                $data["userId"] = $_SESSION["userId"];
                $data["username"] = $_SESSION["username"];
                $data["content"] = $_POST["content"];
                $data["create_date"] = time() - 1;
                $result = User::InsertShare($data);
                $this->redirect(Url::createUrl("/kktUser/sellNow", array("id"=>$appId)));
            }

            /* Lấy danh sách các chia sẻ */
            $share = User::getShare();

            $this->render(
            "sell_now"
            , array(
            "app"=>$app                    
            , "username"=>$username                    
            , "share"=>$share                    
            )
            );
        }

        public function actionMyAdv()
        {
            $this->direct();

            /* Lấy 1 game mới nhất */
            $game = User::getLastestGame();

            $error = "";
            $data = array();
            if(isset($_POST["title"])){
                $data["title"] = trim(strip_tags($_POST["title"]));
                $data["alias"] = Common::generate_slug($data["title"]);
                $data["type"] = isset($_POST["type"]) ? $_POST["type"] : "";                        

                $error .= empty($data["title"]) ? "<p>- Bạn chưa nhập tiêu đề</p>" : "";
                $error .= $data["type"]=="" ? "<p>- Bạn chưa chọn loại ứng dụng</p>" : "";

                $create_date = time();
                $filename =isset($_FILES["picture"]["name"]) ? $_FILES["picture"]["name"]:"";
                if($filename ==""){
                    $error .= "<p>- Chưa upload ảnh</p>";
                }
                $ext = end(explode(".", $filename));
                $arr_ext = array("jpg","png","jpeg","gif");
                if(!in_array(strtolower($ext),$arr_ext)){
                    $error .= "<p>- Upload sai định dạng file ảnh</p>";
                }
                if(empty($error)){
                    $filename = Common::cleanFileName($filename);                                           
                    $filename = basename($filename, "." . $ext);

                    $image_location = getcwd();                
                    $image_location .= "/upload/user/" . $_SESSION["username"] . "/picture/";                                    
                    $image_location .= date("Y/md/", $create_date);

                    if(@chdir($image_location) == false) @mkdir($image_location, 0777, true);
                    $image_location .= $filename . "." . $ext;                
                    $tmp_name = $_FILES["picture"]["tmp_name"];
                    if(@move_uploaded_file($tmp_name, $image_location)){
                        $data["userId"] = $_SESSION["userId"];
                        $data["username"] = $_SESSION["username"];
                        $data["picture"] = $filename . "." . $ext;
                        $data["create_date"] = $create_date;

                        $advId = User::InsertMyAdv($data);
                        if($advId > 0){
                            $this->redirect(Url::createUrl("/kktUser/myAdvDetail", array("id"=>$advId)));
                        }
                    }
                }
            }

            $this->render(
            "my_adv"
            , array(
            "game"=>$game    
            , "data"=>$data    
            , "error"=>$error    
            )
            );
        }

        public function actionDeleteMyAdv()
        {
            $this->direct();

            if(isset($_GET["id"]) && isset($_GET["userId"]) && $_SESSION["userId"]==$_GET["userId"]){
                $id = intval($_GET["id"]);
                $result = User::deleteMyAdv($id);
                if($result >= 0){
                    $this->redirect(Url::createUrl("/kktUser/index"));        
                }   
            } else {            
                $this->redirect(Yii::app()->params["base_url"]);    
            }        
        }

        public function actionMyAdvDetail()
        {
            $this->direct();

            $username = $_SESSION["username"];
            $advId = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
            if(empty($advId)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }

            /* Lấy thông tin về quảng cáo */                
            $adv = User::getInfoMyAdv($advId);
            if(empty($adv)) {
                throw new CHttpException(404, "Trang yêu cầu không tồn tại");
            }                

            if(isset($_POST["content"])){
                $data = array();
                $data["userId"] = $_SESSION["userId"];
                $data["username"] = $_SESSION["username"];
                $data["content"] = $_POST["content"];
                $data["create_date"] = time() - 1;
                $result = User::InsertShare($data);
                $this->redirect(Url::createUrl("/kktUser/myAdvDetail", array("id"=>$advId)));
            }

            /* Lấy danh sách các chia sẻ */
            $share = User::getShare();

            $this->render(
            "my_adv_detail"
            , array(
            "adv"=>$adv                    
            , "username"=>$username                    
            , "share"=>$share    
            )
            );
        }

        public function actionBoxAdv()
        {
            $this->direct();

            /* Lấy 1 game mới nhất */
            $boxAdv = User::getBoxAdv();

            $this->render(
            "box_adv"
            , array(
            "boxAdv"=>$boxAdv      
            , "username"=>$_SESSION["username"]    
            )
            );
        }

        public function actionLogout()
        {
            $this->direct();
            if(isset($_SESSION["userId"])){
                unset($_SESSION["userId"], $_SESSION["username"]);
                unset($_SESSION["uid"], $_SESSION["ups"]);
            }

            $this->redirect(Yii::app()->params["base_url"]);    
        }
        public function actionRegister()
        {
            if(isset($_SESSION["userId"])){
                $this->redirect(Url::createUrl("/kktUser/index"));
            }        

            /* regx */
            $regxUsername = "/^[a-z](?=[a-z0-9]{3,24}$)[a-z0-9]*\.?[a-z0-9]*$/";
            $regxEmail = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";

            /* Lấy các từ khóa bị cấm */
            $blacklist = Login::getBlacklist();

            $data = array();        
            $error = "";
            if(isset($_POST["username"])){
                $refUID = 0;
                $userId = isset($_GET["userId"]) ? intval($_GET["userId"]):0;
                if($userId >0){
                    $data_user_invite = User::getUserInfo($userId);
                    if($data_user_invite){
                        $refUID = intval($userId);
                    }
                }
                $data["username"] = trim(strip_tags($_POST["username"]));
                $data["email"] = trim(strip_tags($_POST["email"]));
                $data["password"] = trim(strip_tags($_POST["password"]));
                $data["password_retype"] = trim(strip_tags($_POST["password_retype"]));
                $data["mobile"] = trim(strip_tags($_POST["mobile"]));
                $data["refUID"] = $refUID;
                $code = trim(strip_tags($_POST["code"]));

                if(empty($data["username"])){
                    $error .= "<p>- Tên đăng nhập không thể rỗng</p>";
                } else {
                    if(!preg_match($regxUsername, $data["username"])){
                        $error .= "<p>- Tên đăng nhập không đúng định dạng. Tên đăng nhập phải có ít nhất 4 ký tự và dài nhất 25 ký tự. Tên đăng nhập chỉ bao gồm chữ cái thường và số</p>";    
                    } else {
                        /* Kiểm tra blacklist */
                        $username = strtolower($data["username"]);                    
                        if(!empty($blacklist) && preg_match($blacklist, $username)){
                            $error .= "<p>- Tên đăng nhập dùng từ nhạy cảm trái với quy định của kenhkiemtien.com</p>";       
                        }
                    }               
                }

                if(empty($data["email"])){
                    $error .= "<p>- Email không thể rỗng</p>";
                } else {
                    if(!preg_match($regxEmail, $data["email"]) || strlen($data["email"])>50 || strlen($data["email"])<5){
                        $error .= "<p>- Email không đúng định dạng</p>";    
                    }                
                }
                if(empty($data["mobile"])){
                    $error .= "<p>- Di dộng không thể rỗng</p>";
                }
                $error .= empty($data["password"]) ? "<p>- Mật khẩu không thể rỗng.</p>" : "";
                $error .= empty($data["password_retype"]) ? "<p>- Mật khẩu xác nhận không thể rỗng.</p>" : "";
                if(!empty($data["password"]) && !empty($data["password_retype"])){
                    if($data["password_retype"] != $data["password"]){
                        $error .= "<p>- Hai mật khẩu không trùng khớp</p>";
                    } else {
                        $error .= Common::CheckPassword($data["password"]);
                    }
                }            
                if(strpos($data["mobile"],'0')===0){
                    $data["mobile"] = '84'.substr($data["mobile"],1);
                }
                $checkUsername = Login::checkUsername($data["username"]);
                $checkEmail = Login::checkEmail($data["email"]);
                $checkMobile = Login::checkMobile($data["mobile"]);
                $error .= $checkUsername>0 ? "<p>- Tên đăng nhập đã tồn tại</p>" : "";
                $error .= $checkEmail>0 ? "<p>- Email đã tồn tại</p>" : "";
                $error .= $checkMobile>0 ? "<p>- Số điện thoại đã tồn tại</p>" : "";
                $data_code = User::getDataByMobileAndCode($data["mobile"],$code);
                if(!$data_code){
                    $error .= "<p>- Mã kích hoạt không chính xác! Vui lòng nhập lại</p>";
                }
                if(empty($error)){
                    /* sinh mã xác nhận */
                    $random_str = md5(microtime());
                    $random_str = substr($random_str, 0, 9);
                    $data["key_active"] = $random_str;            
                    $password_forum = md5(md5($data["password"]));
                    $data["password"] = Common::genPass($data["password"]);
                    $data["active"] = 1;
                    $data["create_date"] = time();

                    /* Insert vào db */                
                    unset($data["password_retype"]);
                    $result = Login::InsertUsername($data, $password_forum);
                    if($result >= 0){          
                        $result1 = User::updateStatusMobileAndCode($data["mobile"],$code);          
                        /* Gửi mail */
                        if(Yii::app()->params["sendEmail"]){

                        }

                        /* Tạo thư mục */
                        $location = getcwd();
                        $location .= "/upload/user/" . $data["username"] . "/";                    
                        if(@chdir($location) == false) mkdir($location, 0777, true);

                        $this->redirect(Url::createUrl("/kktUser/msgRegister"));
                    }
                }
            }
            $this->render(
            "register"
            , array(
            "error"=>$error
            , "data"=>$data
            )
            );
        }

        public function actionMsgRegister()
        {
            $this->layout = "main_index";
            $this->render(
            "msg_register"
            );
        }

        public function actionMsgChangePassword()
        {
            $this->render(
            "msg_change_password"
            );
        }

        public function actionActive()
        {
            $this->layout = "main_index";        
            $email = isset($_GET["email"]) ? Common::cleanQuery($_GET["email"]) : "";
            $key_active = isset($_GET["invite"]) ? Common::cleanQuery($_GET["invite"]) : "";
            if(empty($key_active) || empty($email)){
                throw new CHttpException(404, "Không tìm thấy trang yêu cầu");
            }

            $userInfo = User::getUserByKey($email, $key_active);
            if(empty($userInfo)){
                $result = "Mã kích hoạt không đúng hoặc tài khoản này đã được kích hoạt";
            } else {
                $result = User::activeUser($userInfo["id"]);
                if($result >= 0){
                    $result = "Bạn đã kích hoạt tài khoản thành công.";

                    /* Tạo thư mục cho user */
                    //$image_location = getcwd();       
                    //                $image_location .= "/upload/user/";    
                    //                $image_location .= $userInfo["username"];                    
                    //                if(@chdir($image_location) == false) mkdir($image_location, 0777, true);
                } else {
                    $result = "Kích hoạt tài khoản thất bại. Vui lòng liên lạc với quản trị về vấn đề này";
                }
            }

            $this->render(
            "active"
            , array(
            "result"=>$result
            )
            );
        }

        public function actionForgotPassword()
        {
            $this->layout = "main_index";
            $regxEmail = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";         
            $error = "";
            $email = "";
            if(isset($_POST["email"])){
                $email = trim(strip_tags($_POST["email"]));
                /* Kiểm tra email có tồn tại không */
                if(empty($email)){
                    $error .= "<p>- Email không thể rỗng</p>";
                } else {
                    if(!preg_match($regxEmail, $email)){
                        $error .= "<p>- Email không đúng định dạng</p>";    
                    }                
                }

                $checkEmail = User::checkEmail($email);
                $error .= $checkEmail==0 ? "<p>- Email không tồn tại</p>" : "";

                if(empty($error)){
                    /* sinh mã xác nhận */
                    $random_str = md5(microtime());
                    $key_active_password = substr($random_str, 0, 9);
                    /* Cập nhật mã xác nhận quên mật khẩu */                
                    $result = User::UpdateKeyActivePassword($email, $key_active_password);
                    if($result >= 0){
                        if(Yii::app()->params["sendEmail"]){
                        }
                        $this->redirect(Url::createUrl("/kktUser/msgForgotPassword"));
                    }
                }          
            }

            $this->render(
            "forgot_password"
            , array(
            "error"=>$error
            , "email"=>$email
            )
            );
        }

        public function actionMsgForgotPassword()
        {
            $this->layout = "main_index";
            $this->render(
            "msg_forgot_password"
            );
        }

        public function actionActiveForgotPassword()
        {
            $this->layout = "main_index";        
            $email = isset($_GET["email"]) ? Common::cleanQuery($_GET["email"]) : "";
            $key_active_password = isset($_GET["invite"]) ? Common::cleanQuery($_GET["invite"]) : "";
            if(empty($key_active_password) || empty($email)){
                throw new CHttpException(404, "Không tìm thấy trang yêu cầu");
            }

            $error = "";
            $userInfo = User::getUserByKeyPassword($email, $key_active_password);
            if(empty($userInfo)){
                $error .= "<p>- Mã kích hoạt không đúng</p>";
            } else {
                if(isset($_POST["password"])){
                    /* Kiểm tra mật khẩu */
                    $userId = $userInfo["id"];

                    $password = trim(strip_tags($_POST["password"]));
                    $password_retype = trim(strip_tags($_POST["password_retype"]));

                    $error .= empty($password) ? "<p>- Mật khẩu không thể rỗng.</p>" : "";
                    $error .= empty($password_retype) ? "<p>- Mật khẩu xác nhận không thể rỗng.</p>" : "";
                    if(!empty($password) && !empty($password_retype)){
                        if($password != $password_retype){
                            $error .= "<p>- Hai mật khẩu không trùng khớp</p>";
                        } else {
                            $error .= Common::CheckPassword($password);
                        }
                    }

                    if(empty($error)){
                        $pass = $password;
                        $password = Common::genPass($password);
                        $result = User::changePassword($userId, $password);

                        if($result >= 0){
                            if(Yii::app()->params["sendEmail"]){
                            }
                            $this->redirect(Url::createUrl("/kktUser/msgChangeForgotPassword"));
                        }
                    }
                }            
            }

            $this->render(
            "active_forgot_password"
            , array(
            "error"=>$error
            )
            );
        }

        public function actionMsgChangeForgotPassword()
        {
            $this->layout = "main_index";        
            $this->render(
            "msg_change_forgot_password"
            );    
        }  

        public function actionDomain(){
            $this->direct();
            $user_id   = isset($_SESSION["userId"])  ? $_SESSION["userId"]:0;
            $user_name = isset($_SESSION["username"])? $_SESSION["username"]:'';
            $mes='';
            $domain = isset($_POST['domain']) ? trim($_POST['domain']) :''; 
            $domain = str_replace('www.','',$domain);
            $domain = str_replace('http://','',$domain);
            $domain = str_replace('https://','',$domain);
            $domain = rtrim($domain,'/');
            $domain_return='';
            if($domain){
                $array_input = array('user_id'=>$user_id,'user_name'=>$user_name,'domain '=>$domain,'date_create'=>time()); 
                $user_domain = ShopDomain::getOneDomain($domain); 
                if($user_domain){
                    $mes = 'Domain này đã có người dùng, vui lòng liên hệ với admin kenhkiemtien.com!'; 
                    $domain_return=$domain;                    

                } else {
                    $table = "c_shop_domain";
                    $data = array(
                    "user_id"=>array("value"=>$user_id,"type"=>1),
                    "user_name"=>array("value"=>$user_name,"type"=>2),
                    "domain"=>array("value"=>$domain,"type"=>2),
                    "date_create"=>array("value"=>time(),"type"=>1),
                    );
                    $last_id = CommonDB::insertRow($table,$data); 
                    if($last_id <=0){
                        $mes = 'Có lỗi trong quá trình xử lý!'; 
                        $domain_return=$domain;
                    }
                }
            }          
            // danh sách domain của 1 user
            $list_domain = ShopDomain::getDomainByUser($user_id);

            $this->render("domain"
            , array('list_domain'=>$list_domain,'mes'=>$mes,'domain_return'=>$domain_return)
            );
        } 
        // xóa domain
        public function actionDeleteDomain()
        {
            $this->direct();  
            $url = new Url();
            $user_id   = isset($_SESSION["userId"])  ? $_SESSION["userId"]:0;
            $user_name = isset($_SESSION["username"])? $_SESSION["username"]:'';            
            $domain_id = isset($_GET['id'])? $_GET['id']:0; 
            $do        = isset($_GET['do'])? $_GET['do']:'';
            if($do=="delete"){
                $table = "c_shop_domain";
                $result = CommonDB::deleteRow($table,array("id"=>$domain_id,"user_id"=>$user_id));
                $this->redirect($url->createUrl('kktUser/domain'));
                exit();
            }
            $this->render("domain_delete"
            , array('d_id'=>$domain_id)
            );   
        }

        public function actionSeoPage(){
            $this->direct();
            $userId = $_SESSION["userId"];
            $username = $_SESSION["username"];
            $typePage = isset($_GET["typePage"]) ? intval($_GET["typePage"]):0;
            $metaTitle = isset($_POST["metaTitle"]) ? Common::cleanQuery($_POST["metaTitle"]):"";
            $metaDescription = isset($_POST["metaDescription"]) ? Common::cleanQuery($_POST["metaDescription"]):"";
            $metaKeyword = isset($_POST["metaKeyword"]) ? Common::cleanQuery($_POST["metaKeyword"]):"";
            if(!isset(LoadConfig::$page_seo[$typePage])){
                $this->redirect(Url::createUrl("kktUser/seoPage"));
                exit;
            }
            $data = ShopSeo::getDataByUserAndType($userId,$typePage);
            if($metaTitle !="" && $metaDescription != "" && $metaKeyword !=""){
                if($data){
                    $data_u = array(
                    "id"=>array("value"=>$data["id"],"type"=>1),
                    "metaTitle"=>array("value"=>$metaTitle,"type"=>2),
                    "metaDescription"=>array("value"=>$metaDescription,"type"=>2),
                    "metaKeyword"=>array("value"=>$metaKeyword,"type"=>2),
                    );
                    $last_id = CommonDB::updateRow("c_shop_seo",$data_u,array("id"));
                }else{
                    $data = array(
                    "userId"=>array("value"=>$userId,"type"=>1),
                    "username"=>array("value"=>$username,"type"=>2),
                    "type"=>array("value"=>$typePage,"type"=>1),
                    "metaTitle"=>array("value"=>$metaTitle,"type"=>2),
                    "metaDescription"=>array("value"=>$metaDescription,"type"=>2),
                    "metaKeyword"=>array("value"=>$metaKeyword,"type"=>2),
                    );
                    $last_id = CommonDB::insertRow("c_shop_seo",$data);
                }

                if($last_id >0){
                    $this->redirect(Url::createUrl("kktUser/seoPage",array("typePage"=>$typePage)));
                }
            }     
            $this->render("seo_page",array(
            "typePage"=>$typePage,
            "metaTitle"=>$metaTitle,
            "metaDescription"=>$metaDescription,
            "metaKeyword"=>$metaKeyword,
            "data"=>$data
            ));
        }
        public function actionGaPage(){
            $this->direct();
            $userId = $_SESSION["userId"];
            $username = $_SESSION["username"];
            $data = ShopConfig::getDataByUsername($username);
            $ga = isset($_POST["ga"]) ? trim($_POST["ga"]):"";
            $upload = isset($_POST["upload"]) ? intval($_POST["upload"]):0;
            $error = "";
            if($ga !=""){
                $filename =isset($_FILES["file_ga"]["name"]) ? $_FILES["file_ga"]["name"]:"";
                if(!empty($filename)){
                    $arr_ext = array("html","htm");
                    $ext = end(explode(".", $filename)); 
                    if(in_array(strtolower($ext),$arr_ext)){
                        $filename = Common::cleanFileName($filename);                                           
                        $filename = basename($filename, "." . $ext);

                        $image_location = getcwd().'/';                

                        if(@chdir($image_location) == false) @mkdir($image_location, 0777, true);
                        $image_location .= $filename . "." . $ext;               
                        $tmp_name = $_FILES["file_ga"]["tmp_name"];
                        @move_uploaded_file($tmp_name, $image_location);
                    }                    
                }
                if($data){
                    $data_u = array(
                    "id"=>array("value"=>$data["id"],"type"=>1),
                    "ga"=>array("value"=>$ga,"type"=>2),
                    );
                    $last_id = CommonDB::updateRow("c_shop_config",$data_u,array("id"));
                }else{
                    $data = array(
                    "userId"=>array("value"=>$userId,"type"=>1),
                    "username"=>array("value"=>$username,"type"=>2),
                    "ga"=>array("value"=>$ga,"type"=>2),
                    );
                    $last_id = CommonDB::insertRow("c_shop_config",$data);
                }
                if($last_id >0){
                    $this->redirect(Url::createUrl("kktUser/gaPage",array("upload"=>1)));
                }



            }
            $this->render("ga_page",array(
            "ga"=>$ga,
            "data"=>$data,
            "error"=>$error,
            "upload"=>$upload,
            ));
        }

        public function direct(){
            if(!isset($_SESSION["userId"])){
                $this->redirect(Yii::app()->params["base_url"]);
            }           
        }  
    }
?>
