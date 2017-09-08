<?php
    class FootBallMatchController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Giải Đấu','link'=>$url->createUrl("footBallVideo/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Giải Đấu','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $code = isset($_GET["code"]) ? trim($_GET["code"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $order_by = isset($_GET["order_by"]) ? trim($_GET["order_by"]):"id DESC";  
            $cup_id = isset($_GET["cup_id"]) ? trim($_GET["cup_id"]):"";  
            $status = isset($_GET["status"]) ? trim($_GET["status"]):"";    
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallMatch::getAllData($from_date,$to_date,$cup_id,$name,$code,$status,$order_by,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,
            'count'=>$count,"max_page"=>$max_page,"code"=>$code,"cup_id"=>$cup_id,"order_by"=>$order_by,"status"=>$status));

        }


        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Giải đấu','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật trận đấu','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            $match = FootBallMatch::getMatchByID($id);
          
            $arrSpotcat = array();
            if(!empty($match["sopcast_link"]))
            $arrSpotcat =  json_decode($match["sopcast_link"]);

            $this->render('edit',array('match'=>$match,'spotcast'=>$arrSpotcat,'page'=>$page));
        }

        public function actionAjaxSaveCup()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $code = isset($_POST['code'])? trim(strip_tags($_POST['code'])): "";
            $country = isset($_POST['country'])?trim(strip_tags( $_POST['country'])): "";
            $continent = isset($_POST['continent'])? trim(strip_tags($_POST['continent'])): "";
            $refe = isset($_POST['refe'])? trim(strip_tags($_POST['refe'])): "";
            $logo = isset($_POST['logo'])? trim(strip_tags($_POST['logo'])): "";
            $rate = intval(isset($_POST['rate'])? trim(strip_tags($_POST['rate'])): "0");

            if($name == "")
            {
                echo "Tên giải đấu không được để trống"; exit;
            }
            if($code == "")
            {
                echo "Mã giải đấu không được để trống"; exit;
            }

            if($logo == "")
            {
                echo "Chưa upload logo "; exit;
            }
               
            $result = FootBallCup::insertCup($code,$name,$country,$continent,$refe,$logo,$rate)  ;
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdate()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $round = isset($_POST['round'])? trim(strip_tags(mysql_escape_string($_POST['round']))): "";
            $match_time = isset($_POST['match_time'])? trim(strip_tags($_POST['match_time'])): "";
            $match_minute = isset($_POST['match_minute'])?trim(strip_tags( $_POST['match_minute'])): "";
            $season = isset($_POST['season'])? trim(strip_tags($_POST['season'])): "";
            $result = isset($_POST['result'])? trim(strip_tags($_POST['result'])): "";
            $result_1 = isset($_POST['result_1'])? trim(strip_tags($_POST['result_1'])): "";
            $status = isset($_POST['status'])? trim(strip_tags($_POST['status'])): "";
            $stadium = isset($_POST['stadium'])? trim(strip_tags($_POST['stadium'])): "";    
            $referee = isset($_POST['referee'])? trim(strip_tags($_POST['referee'])): "";   
            
            $spotcast1 = isset($_POST['spotcast1'])? trim(strip_tags($_POST['spotcast1'])): "";
            $spotcast2 = isset($_POST['spotcast2'])? trim(strip_tags($_POST['spotcast2'])): "";
            $spotcast3 = isset($_POST['spotcast3'])? trim(strip_tags($_POST['spotcast3'])): "";
            $spotcast4 = isset($_POST['spotcast4'])? trim(strip_tags($_POST['spotcast4'])): "";
            $spotcast5 = isset($_POST['spotcast5'])? trim(strip_tags($_POST['spotcast5'])): ""; 
            
            $arrSpotcat = array($spotcast1,$spotcast2,$spotcast3,$spotcast4,$spotcast5);
            $linkSpotcat = json_encode($arrSpotcat);
            
            $id = intval(isset($_POST['id'])? $_POST['id']: "0");


            if($id == "")
            {
                echo "Thiếu ID"; exit;
            }
           
             
            $result = FootBallMatch::updateMatch($id,$round,$match_time,$match_minute,$season,$result,$result_1,$status,$stadium,$referee,$linkSpotcat);
            if($result>0)
            {
                echo $result;exit;
            } else
            {
                echo "Chưa thay đổi dữ liệu"; exit;
            }

        }



    }
?>
