<?php
    class FootBallCountryController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Quốc gia','link'=>$url->createUrl("footBallCountry/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Quốc gia','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallCountry::getAllData($from_date,$to_date,$name,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page));

        }

        public function actionCreate()
        {
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Quốc gia','link'=>'#','class'=>'active');
            $this->render('create',array());
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Quốc gia','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1; 
            $country = FootBallCountry::getCountryById($id);

            $this->render('edit',array('country'=>$country,'page'=>$page));
        }

        public function actionAjaxSaveCountry()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): "";  
            $flag = isset($_POST['flag'])? trim(strip_tags($_POST['flag'])): "";

            if($name == "")
            {
                echo "Tên Quốc gia không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên Quốc gia tiếng anh không được để trống"; exit;
            }

            if($flag == "")
            {
                echo "Hình ảnh lá cờ không được để trống"; exit;
            }


            $result = FootBallCountry::insertCountry($name,$name_en,$flag)  ;
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdateCountry()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags(mysql_escape_string($_POST['name']))): "";
            $name_en = isset($_POST['name_en'])? trim(strip_tags(mysql_escape_string($_POST['name_en']))): "";  
            $flag = isset($_POST['flag'])? trim(strip_tags($_POST['flag'])): "";
            $id = intval(isset($_POST['id'])? $_POST['id']: "0");

            if($name == "")
            {
                echo "Tên Quốc gia không được để trống"; exit;
            }
            if($name_en == "")
            {
                echo "Tên Quốc gia tiếng anh không được để trống"; exit;
            }

            if($flag == "")
            {
                echo "Hình ảnh lá cờ không được để trống"; exit;
            }

            $result = FootBallCountry::updateCountry($id,$name,$name_en,$flag);
            if($result>0)
            {
                echo $result;exit;
            } else
            {
                echo "Chưa thay đổi dữ liệu"; exit;
            }

        }
        
        public function actionAjaxDeleteCountry()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FootBallCountry::deleteCountry($id);

            if($result>0)
            {
                echo 1;exit;
            }
        }



    }
?>
