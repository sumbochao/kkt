<?php
    class FootBallClubController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Câu lạc bộ','link'=>$url->createUrl("footBallClub/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Câu lạc bộ','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $country = isset($_GET["country"]) ? trim($_GET["country"]):"";
            $code = isset($_GET["code"]) ? trim($_GET["code"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallClub::getAllData($from_date,$to_date,$code,$name,$country,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page,"country"=>$country,"code"=>$code));

        }


        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Câu lạc bộ','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Câu lạc bộ','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $club = FootBallClub::getClubByID($id);
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;    
            
            $this->render('edit',array('club'=>$club,"page"=>$page));
        }

        public function actionAjaxSaveClub()
        {
            //CODE,NAME,name_en,city,country,info, 
    //logo,stadium,stadium_capacity,address,website,fan_page,email,established_date,coach_id,map,avgage,create_date,create_user,refe,id_7m
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): ""; 
            $code = isset($_POST['code'])? trim(mysql_escape_string($_POST['code'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
             $country_en = isset($_POST['country_en'])?trim(mysql_escape_string( $_POST['country_en'])): "";
            $city = isset($_POST['city'])?trim(mysql_escape_string( $_POST['city'])): "";
            $info = isset($_POST['info'])? trim(mysql_escape_string($_POST['info'])): "";
            $logo = isset($_POST['logo'])? trim(mysql_escape_string($_POST['logo'])): "";  
            $stadium = isset($_POST['stadium'])? trim(mysql_escape_string($_POST['stadium'])): "";  
            $stadium_capacity = isset($_POST['stadium_capacity'])? trim(mysql_escape_string($_POST['stadium_capacity'])): "";  
            $address = isset($_POST['address'])? trim(mysql_escape_string($_POST['address'])): "";  
            $website = isset($_POST['website'])? trim(mysql_escape_string($_POST['website'])): "";       
            $fan_page = isset($_POST['fan_page'])? trim(mysql_escape_string($_POST['fan_page'])): "";       
            $email = isset($_POST['email'])? trim(mysql_escape_string($_POST['email'])): "";       
            $established_date = isset($_POST['established_date'])? trim(mysql_escape_string($_POST['established_date'])): "";     
            $coach_id = isset($_POST['coach_id'])? trim(mysql_escape_string($_POST['coach_id'])): "0";  
            $map = isset($_POST['map'])? trim(mysql_escape_string($_POST['map'])): "";        
            $avgage = isset($_POST['avgage'])? trim(mysql_escape_string($_POST['avgage'])): "";        
            $id_7m = isset($_POST['id_7m'])? trim(mysql_escape_string($_POST['id_7m'])): "0";        
            $refe = isset($_POST['refe'])? trim(mysql_escape_string($_POST['refe'])): "";
           
            if($name == "")
            {
                echo "Tên câu lạc bộ không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên câu lạc bộ tiếng anh không được để trống"; exit;
            }
            
             if($country == "")
            {
                echo "Tên quốc gia không được để trống"; exit;
            }
            if($country_en == "")
            {
                echo "Tên quốc gia tiếng anh không được để trống"; exit;
            }
            
            if($code == "")
            {
                echo "Mã cậu lạc bộ không được để trống"; exit;
            }
            
            if($logo == "")
            {
                echo "Chưa upload logo "; exit;
            }
             $logo = $logo;        
            $result = FootBallClub::insertClub($code,$name,$name_en,$city,$country,$country_en,$info, 
    $logo,$stadium,$stadium_capacity,$address,$website,$fan_page,$email,$established_date,$coach_id,$map,$avgage,$refe,$id_7m);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdateClub()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): ""; 
            $code = isset($_POST['code'])? trim(mysql_escape_string($_POST['code'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $country_en = isset($_POST['country_en'])?trim(mysql_escape_string( $_POST['country_en'])): ""; 
            $city = isset($_POST['city'])?trim(strip_tags(mysql_escape_string( $_POST['city']))): "";
            $info = isset($_POST['info'])? trim(mysql_escape_string($_POST['info'])): "";
            $logo_up = isset($_POST['logo'])? trim(mysql_escape_string($_POST['logo'])): "";  
            $logo_link = isset($_POST['logo_link'])? trim(strip_tags($_POST['logo_link'])): "";  
            $stadium = isset($_POST['stadium'])? trim(mysql_escape_string($_POST['stadium'])): "";  
            $stadium_capacity = isset($_POST['stadium_capacity'])? trim(mysql_escape_string($_POST['stadium_capacity'])): "";  
            $address = isset($_POST['address'])? trim(mysql_escape_string($_POST['address'])): "";  
            $website = isset($_POST['website'])? trim(mysql_escape_string($_POST['website'])): "";       
            $fan_page = isset($_POST['fan_page'])? trim(mysql_escape_string($_POST['fan_page'])): "";       
            $email = isset($_POST['email'])? trim(mysql_escape_string($_POST['email'])): "";       
            $established_date = isset($_POST['established_date'])? trim(mysql_escape_string($_POST['established_date'])): "";     
            $coach_id = isset($_POST['coach_id'])? trim(mysql_escape_string($_POST['coach_id'])): "0";  
            $map = isset($_POST['map'])? trim(mysql_escape_string($_POST['map'])): "";        
            $avgage = isset($_POST['avgage'])? trim(mysql_escape_string($_POST['avgage'])): "";        
            $id_7m = isset($_POST['id_7m'])? trim(mysql_escape_string($_POST['id_7m'])): "0";        
            $refe = isset($_POST['refe'])? trim(mysql_escape_string($_POST['refe'])): "";
            
            $id = intval(isset($_POST['id'])? $_POST['id']: "0");
            $id_7m = intval($id_7m );
            
           //echo $address;die;
            if($name == "")
            {
                echo "Tên câu lạc bộ không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên câu lạc bộ tiếng anh không được để trống"; exit;
            }
            
             if($country == "")
            {
                echo "Tên quốc gia không được để trống"; exit;
            }
            if($country_en == "")
            {
                echo "Tên quốc gia tiếng anh không được để trống"; exit;
            }
            
            if($code == "")
            {
                echo "Mã cậu lạc bộ không được để trống"; exit;
            }

            $logo = "";
            if($logo_up != "") {
                $logo = $logo_up;
            }
            
            if($logo == "")
            {
                echo "Chưa upload logo "; exit;
            }

            $result = FootBallClub::updateClub($id,$code,$name,$name_en,$city,$country,$country_en,$info, 
    $logo,$stadium,$stadium_capacity,$address,$website,$fan_page,$email,$established_date,$coach_id,$map,$avgage,$refe,$id_7m);
    
                 
            if($result>0)
            {
                $club = FootBallClub::getClubByID($id);
                $date=date_create($club["create_date"]);
                $ymd = date_format($date,"/Y/md/");
                $logo_2 = $ymd.$logo;
                if(strcasecmp($logo,$logo_link)>0||strcasecmp($logo,$logo_link)<0) FootBallMatch::updateMatchLogoClub1($id,$logo_2);
                if(strcasecmp($logo,$logo_link)>0||strcasecmp($logo,$logo_link)<0)  FootBallMatch::updateMatchLogoClub2($id,$logo_2);
                echo $result;exit;
            } else
            {
                echo "Chưa thay đổi dữ liệu"; exit;
            }

        }



    }
?>
