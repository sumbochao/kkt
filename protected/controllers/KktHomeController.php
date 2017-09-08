<?php
class KktHomeController extends Controller
{
    public $layout;
    public function actionError()
    {        
        $this->layout = false;
        $error = Yii::app()->errorHandler->error;
        $this->render(
            "error"            
        );        
    }
    public function actionIndex()
    {          
        $this->metaTitle = "kenh kiem tien online hieu qua - kenhkiemtien.com";     
        if(!isset($_SESSION["userId"])){
            /* Trang chủ khi chưa đăng nhập */
            $this->layout = "main_index";
            
            $error = "";
            if(isset($_POST["username"]) && isset($_POST["password"])){                    
                $error .= (empty($_POST["username"]) || empty($_POST["password"])) ? "Tên đăng nhập hoặc mật khẩu không đúng" : "";
                
                if(empty($error)) {
                    $username = trim(strip_tags(Common::cleanQuery($_POST["username"])));
                    $password = trim(strip_tags(Common::cleanQuery($_POST["password"])));
                    $pass_no_md5 = $password;
                    $password = Common::genPass($password);
                    
                    $data["password"] = $password;
                    $data["username"] = $username;
                    $result = User::getUser($data);
                    if(empty($result)){                
                        $error .= "Tên đăng nhập hoặc mật khẩu không đúng";                        
                    } else {
                        if($result["active"]==0){                    
                            $error .= "Tài khoản chưa được kích hoạt";                            
                        } else if ($result["isBan"]==1){                    
                            $error .= "Tài khoản đã bị khóa";                                
                        } else {                        
                            $_SESSION["userId"] = $result["id"];
                            $_SESSION["username"] = $result["username"];
                            Login::setSessionForum($result["username"],$pass_no_md5);        
                            $this->redirect(Url::createUrl("/kktHome/index"));
                        }
                    }
                }    
            }
            
            /* Danh sách thành viên top */
            $topUser = User::getTopUser();
            
            /* Lấy tổng số sms */
            $total_sms = ReportSms::getTotalSms();
            
            /* Lấy tổng số sms */
            $total_card = ReportSms::getTotalCard();        
            
            /* Lấy tổng doanh thu */
            $total_money = ReportSms::getAllMoney();
            
            $many_download = Data::getDataManyDownload(6); 
            
            $this->render(
                "index"
                , array(
                    "error"=>$error
                    , "topUser"=>$topUser                    
                    , "many_download"=>$many_download
                    , "total_sms"=>$total_sms
                    , "total_card"=>$total_card
                    , "total_money"=>$total_money
                )
            );    
        } else {
            /* Trang chủ khi đã đăng nhập */
            $blacklist = Home::getPattern();            
            $pattern = !empty($blacklist) ? $blacklist["pattern"] : array();
            $replace = !empty($blacklist) ? $blacklist["replace"] : array();
            if(isset($_POST["content"])){
                $data = array();
                $data["userId"] = $_SESSION["userId"];
                $data["username"] = $_SESSION["username"];
                $data["content"] = $_POST["content"];
                $data["create_date"] = time() - 1;
                if(!empty($data["content"])){
                    $result = Home::InsertChat($data);
                }
                $this->redirect(Url::createUrl("/kktHome/index"));
            }
            
            /* Lấy danh sách các chia sẻ */
            $chat = User::getChat();
            
            /* Đếm tổng số thành viên */
            $totalUser = User::getTotalUser();                        
            
            $day = date("d");
            $month = date("m");
            $year = date("Y");
        
            /* Tính tổng doanh thu phát sinh trong tháng của user */
            $total_money = ReportSms::getTotalMoneyInMonth($_SESSION["userId"], $month, $year);
            
            /* lấy tỷ lệ trong tháng */
            $rate = ReportSms::getRateInMonth($total_money, $month, $year);
            
            /* Thống kê doanh thu hôm nay */
            $report = ReportSms::getReportUserToday($_SESSION["userId"], $day, $month, $year);            
            
            /* Thống kê doanh thu sms game hôm nay */
            $report_sms_game = ReportSms::getReportSmsGameToday($_SESSION["userId"], $day, $month, $year);
                                                
            $total_sms_of_user = 0;            
            $total_sms = 0;
            foreach($report as $code=>$sms) { 
                $total_sms += $sms;
                $money = Common::priceServiceCode($code) / 1.1;
                $money_of_user = ($money * $rate["rate_of_user"] / 100) * $sms;                             
                $total_sms_of_user += $money_of_user;                
            }
            
            foreach($report_sms_game as $code=>$sms) { 
                $total_sms += $sms;
                $money = Common::priceServiceCode($code) / 1.1;
                $money_of_user = ($money * $rate["rate_of_user"] / 100) * $sms;                             
                $total_sms_of_user += $money_of_user;                
            }                        
            
            /* Thống kê doanh thu card game trong ngày */
            $report_card_game = ReportSms::getReportCardGameToday($_SESSION["userId"], $day, $month, $year);
            $total_card = $report_card_game["total_card"];
            $money = $report_card_game["total_price"] / 1.1;
            $total_card_of_user = ($money * $rate["issue_rate_of_user"]) / 100;                        
                              
            /* tips */
            $tips = User::getTips();
            $month = date("m",time());
            $year = date("Y",time());
            $data_rate = Rate::getDataByMonthAndYear($month,$year);
            list($data_game,$max_page) = Game::getDataGameOffline(1,8);
            list($data_video,$max_page) = Video::getDataVideo(1,5);
            list($data_album,$max_page) = Album::getDataAlbum(1,5);
            $this->render(
                "index_login"
                , array(
                    "chat"=>$chat
                    , "totalUser"=>$totalUser
                    , "total_card_of_user"=>$total_card_of_user
                    , "total_card"=>$total_card
                    , "total_sms_of_user"=>$total_sms_of_user
                    , "total_sms"=>$total_sms                  
                    , "tips"=>$tips
                    , "data_game"=>$data_game
                    , "data_video"=>$data_video
                    , "data_album"=>$data_album
                    , "data_rate"=>$data_rate
                )
            );                       
        }            
    }       
}
?>
