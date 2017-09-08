<?php
    class FootBallCoachController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Huấn luyện viên','link'=>$url->createUrl("footBallVideo/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Huấn luyện viên','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $country = isset($_GET["country"]) ? trim($_GET["country"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallCoach::getAllData($from_date,$to_date,$name,$country,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page,"country"=>$country));

        }

        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Huấn luyện viên','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Huấn luyện viên','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            $coach = FootBallCoach::getCoachById($id);

            $this->render('edit',array('coach'=>$coach,'page'=>$page));
        }

        public function actionAjaxSaveCoach()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(mysql_escape_string($_POST['name_en'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $birthday = isset($_POST['birthday'])? trim(mysql_escape_string($_POST['birthday'])): "";
            $height = isset($_POST['height'])? trim(mysql_escape_string($_POST['height'])): "";
            $weight = isset($_POST['weight'])? trim(mysql_escape_string($_POST['weight'])): ""; 
            $joindate = isset($_POST['joindate'])? trim(mysql_escape_string($_POST['joindate'])): ""; 
            $avatar_up = isset($_POST['avatar'])? trim(mysql_escape_string($_POST['avatar'])): "";
            $formerclub = isset($_POST['formerclub'])? trim(mysql_escape_string($_POST['formerclub'])): "";   
            $onceclub = isset($_POST['onceclub'])? trim(mysql_escape_string($_POST['onceclub'])): "";   
            $id_7m = isset($_POST['id_7m'])? trim(mysql_escape_string($_POST['id_7m'])): "";   
          
            if($name == "")
            {
                echo "Tên giải đấu không được để trống"; exit;
            }
             
             $avatar = "";
            if($avatar_up != "") {
                $avatar = $avatar_up;
            }
             
            if($avatar == "")
            {
                echo "Chưa upload avatar "; exit;
            }
               
            $result = FootBallCoach::insertCoach($name,$name_en,$birthday,$height,$weight,$joindate,$avatar,$country,
        $formerclub,$onceclub,$id_7m)  ;
           
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdate()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(mysql_escape_string($_POST['name_en'])): "";
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $birthday = isset($_POST['birthday'])? trim(mysql_escape_string($_POST['birthday'])): "";
            $height = isset($_POST['height'])? trim(mysql_escape_string($_POST['height'])): "";
            $weight = isset($_POST['weight'])? trim(mysql_escape_string($_POST['weight'])): ""; 
            $joindate = isset($_POST['joindate'])? trim(mysql_escape_string($_POST['joindate'])): ""; 
            $avatar_up = isset($_POST['avatar'])? trim(mysql_escape_string($_POST['avatar'])): "";
            //$avatar_link = isset($_POST['avatar_link'])? trim(strip_tags($_POST['avatar_link'])): ""; 
            $formerclub = isset($_POST['formerclub'])? trim(mysql_escape_string($_POST['formerclub'])): "";   
            $onceclub = isset($_POST['onceclub'])? trim(mysql_escape_string($_POST['onceclub'])): "";   
            $id_7m = isset($_POST['id_7m'])? trim(mysql_escape_string($_POST['id_7m'])): "";   
            $id = intval( isset($_POST['id'])? $_POST['id']:"0");     
          
            if($name == "")
            {
                echo "Tên giải đấu không được để trống"; exit;
            }
            
            $avatar = "";
            if($avatar_up != "") {
                $avatar = $avatar_up;
            }
            
             
            if($avatar == "")
            {
                echo "Chưa upload avatar "; exit;
            }

            $result = FootBallCoach::updateCoach($id,$name,$name_en,$birthday,$height,$weight,$joindate,$avatar,$country,
        $formerclub,$onceclub,$id_7m);
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
