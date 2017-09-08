<?php
    class FootBallCupController extends CpController
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
            $country = isset($_GET["country"]) ? $_GET["country"]:"";
            $code = isset($_GET["code"]) ? $_GET["code"]:"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallCup::getAllData($from_date,$to_date,$name,$code,$country,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page,"country"=>$country,"code"=>$code));

        }
 
        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Giải đấu','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Giải đấu','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            $cup = FootBallCup::getCupByID($id);

            $this->render('edit',array('cup'=>$cup,'page'=>$page));
        }

        public function actionAjaxSaveCup()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): "";  
            $code = isset($_POST['code'])? trim(mysql_escape_string($_POST['code'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $country_en = isset($_POST['country_en'])?trim(mysql_escape_string( $_POST['country_en'])): "";
            $continent = isset($_POST['continent'])? trim(mysql_escape_string($_POST['continent'])): "";
            $refe = isset($_POST['refe'])? trim(mysql_escape_string($_POST['refe'])): "";
            $logo = isset($_POST['logo'])? trim(mysql_escape_string($_POST['logo'])): "";
            $rate = intval(isset($_POST['rate'])? trim(mysql_escape_string($_POST['rate'])): "0");

            if($name == "")
            {
                echo "Tên giải đấu không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên giải đấu tiếng anh không được để trống"; exit;
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
                echo "Mã giải đấu không được để trống"; exit;
            }

            if($logo == "")
            {
                echo "Chưa upload logo "; exit;
            }
               
            $result = FootBallCup::insertCup($code,$name,$name_en,$country,$country_en,$continent,$refe,$logo,$rate)  ;
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdateCup()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): "";  
            $code = isset($_POST['code'])? trim(mysql_escape_string($_POST['code'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $country_en = isset($_POST['country_en'])?trim(mysql_escape_string( $_POST['country_en'])): ""; 
            $continent = isset($_POST['continent'])? trim(mysql_escape_string($_POST['continent'])): "";
            $refe = isset($_POST['refe'])? trim(mysql_escape_string($_POST['refe'])): "";
            $logo = isset($_POST['logo'])? trim(mysql_escape_string($_POST['logo'])): "";
            $rate = intval(isset($_POST['rate'])? $_POST['rate']: "0");
            $id = intval(isset($_POST['id'])? $_POST['id']: "0");


            if($name == "")
            {
                echo "Tên giải đấu không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên giải đấu tiếng anh không được để trống"; exit;
            }
            
            if($country == "")
            {
                echo "Tên quốc gia không được để trống"; exit;
            }
            
            if($country_en == "")
            {
                echo "Tên quốc gia tiếng anh không được để trống"; exit;
            }

            if($logo == "")
            {
                echo "Chưa upload logo "; exit;
            }
                
            $result = FootBallCup::updateCup($id,$name,$name_en,$country,$country_en,$continent,$refe,$logo,$rate);
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
