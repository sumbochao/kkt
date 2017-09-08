<?php
    class FootBallerController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Cầu thủ','link'=>$url->createUrl("footBallVideo/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Cầu thủ','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $country = isset($_GET["country"]) ? trim($_GET["country"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBaller::getAllData($from_date,$to_date,$name,$country,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page,"country"=>$country));

        }


        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Cầu thủ','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Cầu thủ','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            $footballer = FootBaller::getFootballerById($id);

            $this->render('edit',array('footballer'=>$footballer,'page'=>$page));
        }

        public function actionAjaxSave()
        {
                                                                                                            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $avatar_up = isset($_POST['avatar'])? trim(mysql_escape_string($_POST['avatar'])): "";
          
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $birthday = isset($_POST['birthday'])? trim(mysql_escape_string($_POST['birthday'])): "";
            $height = isset($_POST['height'])? trim(mysql_escape_string($_POST['height'])): "";
            $weight = isset($_POST['weight'])? trim(mysql_escape_string($_POST['weight'])): "";
            $club_id = intval(isset($_POST['club_id'])? $_POST['club_id']: "0");
            $position = intval(isset($_POST['position'])? $_POST['position']: "0");      
            $join_date = isset($_POST['join_date'])? $_POST['join_date']: "";      
            $transfer_free = isset($_POST['transfer_free'])? $_POST['transfer_free']: "0";      
            $former_club = isset($_POST['former_club'])? $_POST['former_club']: "";      
            $one_club = isset($_POST['one_club'])? $_POST['one_club']: "";      
            $conveniently_foot= isset($_POST['conveniently_foot'])? $_POST['conveniently_foot']: "";      
            $clubshirtno = isset($_POST['clubshirtno'])? $_POST['clubshirtno']: "";      
            $achievement =isset($_POST['achievement'])? $_POST['achievement']: "";      
            $id_7m = isset($_POST['id_7m'])? $_POST['id_7m']: "";
            
            if($name == "")
            {
                echo "Tên cầu thủ không được để trống"; exit;
            }
            
             if($avatar == "")
            {
                echo "Chưa upload avatar "; exit;
            }
            
             // $avatar = Yii::app()->params['urlImages']."bongda/footballer/".date('Y/md')."/".$avatar;    
         
               
            $result = FootBaller::insertFootballer($name,$avatar,$country,$birthday,$height,$weight,$club_id,$position,$join_date
        ,$transfer_free,$former_club,$one_club,$conveniently_foot,$achievement,$clubshirtno,$id_7m);
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
            $avatar_up = isset($_POST['avatar'])? trim(mysql_escape_string($_POST['avatar'])): "";
            $avatar_link = isset($_POST['avatar_link'])? trim(mysql_escape_string($_POST['avatar_link'])): "";    
            $country = isset($_POST['country'])?trim(mysql_escape_string( $_POST['country'])): "";
            $birthday = isset($_POST['birthday'])? trim(mysql_escape_string($_POST['birthday'])): "";
            $height = isset($_POST['height'])? trim(mysql_escape_string($_POST['height'])): "";
            $weight = isset($_POST['weight'])? trim(mysql_escape_string($_POST['weight'])): "";
            $club_id = intval(isset($_POST['club_id'])? $_POST['club_id']: "0");
            $position = intval(isset($_POST['position'])? $_POST['position']: "0");      
            $join_date = isset($_POST['join_date'])? $_POST['join_date']: "";      
            $transfer_free = isset($_POST['transfer_free'])? $_POST['transfer_free']: "0";      
            $former_club = isset($_POST['former_club'])? $_POST['former_club']: "";      
            $one_club = isset($_POST['one_club'])? $_POST['one_club']: "";      
            $conveniently_foot= isset($_POST['conveniently_foot'])? $_POST['conveniently_foot']: "";      
            $clubshirtno = isset($_POST['clubshirtno'])? $_POST['clubshirtno']: "";      
            $achievement =isset($_POST['achievement'])? $_POST['achievement']: "";      
            $id_7m = isset($_POST['id_7m'])? $_POST['id_7m']: "";      
            $id = isset($_POST['id'])? $_POST['id']: "0";
            

            if($name == "")
            {
                echo "Tên cầu thủ không được để trống"; exit;
            }
            
             $avatar = "";
            if($avatar_up != "") {
                $avatar = $avatar_up;
            }
            
            if($avatar == "")
            {
                echo "Chưa upload avatar "; exit;
            }
            
            $result = FootBaller::updateFootballer($id,$name,$avatar,$country,$birthday,$height,$weight,$club_id,$position,$join_date
        ,$transfer_free,$former_club,$one_club,$conveniently_foot,$achievement,$clubshirtno,$id_7m);
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
