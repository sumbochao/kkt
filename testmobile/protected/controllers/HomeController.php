<?php

    class HomeController extends Controller
    {

        public function actionError()
        {
            $this->layout = false;
            $error = Yii::app()->errorHandler->error;  
            var_dump($error);die;       
            //if($_SERVER["HTTP_HOST"]=="localhost"){
//                var_dump($error);die;
//            }           
//            $this->render("error"
//                , array(
//                    "error"=>$error
//                )            
//            ); 
        }

        public function actionIndex()
        {
            $date = date('H');
            //var_dump($date);
            if($date == '18')
            {
                $this->redirect(Yii::app()->createUrl('home/tuongthuatmienbac'));
            }
            if($date == '17')
            {
                $this->redirect(Yii::app()->createUrl('home/tuongthuatmientrung'));
            }
            if($date == '16')
            {
                $this->redirect(Yii::app()->createUrl('home/tuongthuatmiennam'));
            }

            $ketqua = Ketqua_mienbac::getDataToDay();
            //var_dump($ketqua);
            $loto = Thongke_loto_mienbac::getDataToday($ketqua['ngay_quay']);
            $this->render('index',array('ketqua'=>$ketqua,'loto'=>$loto));
        }
        
        public function actionMienBac()
        {
            $ketqua = Ketqua_mienbac::getDataToDay();
            //var_dump($ketqua);
            $loto = Thongke_loto_mienbac::getDataToday($ketqua['ngay_quay']);
            $this->render('mienbac',array('ketqua'=>$ketqua,'loto'=>$loto));
        }
        
        public function actionMiennam()
        {
            $time = time();
            $date = date("N",$time);
            //var_dump($date);
            $region = 3;
            switch($date)
            {
                case "1":
                {
                    $day = "Thứ hai";
                    $id = Province::getIdByMon($region);
                    list($id1,$id2,$id3) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "2":
                {
                    $day = "Thứ ba";
                    $id = Province::getIdByTue($region);
                    list($id1,$id2,$id3) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "3":
                {
                    $day = "Thứ tư";
                    $id = Province::getIdByWed($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "4":
                {
                    $day = "Thứ năm";
                    $id = Province::getIdByThu($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "5":
                {
                    $day = "Thứ sáu";
                    $id = Province::getIdByFri($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "6":
                {
                    $day = "Thứ bảy";
                    $id = Province::getIdBySat($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }
                case "7":
                {
                    $day = "Chủ nhật";
                    $id = Province::getIdBySun($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataToDay($id1['id']);
                    $data2 = Ketqua_miennam::getDataToDay($id2['id']);
                    $data3 = Ketqua_miennam::getDataToDay($id3['id']);
                    break;
                }

            }
            $this->render('miennam',array('data1'=>$data1,'data2'=>$data2,
            'data3'=>$data3,'id1'=>$id1,'id2'=>$id2,'id3'=>$id3,'day'=>$day));
        }
        
        public function actionMientrung()
        {
            $time = time();
            $date = date("N",$time);
            //var_dump($date);
            $region = 2;
            switch($date)
            {
                case "1":
                {
                    $day = "Thứ hai";
                    $id = Province::getIdByMon($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "2":
                {
                    $day = "Thứ ba";
                    $id = Province::getIdByTue($region);
                    list($id1,$id2) = $id;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "3":
                {
                    $day = "Thứ tư";
                    $id = Province::getIdByWed($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "4":
                {
                    $day = "Thứ năm";
                    $id = Province::getIdByThu($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "5":
                {
                    $day = "Thứ sáu";
                    $id = Province::getIdByFri($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "6":
                {
                    $day = "Thứ bảy";
                    $id = Province::getIdBySat($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }
                case "7":
                {
                    $day = "Chủ nhật";
                    $id = Province::getIdBySun($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataToDay($id1['id']);
                    $data2 = Ketqua_mientrung::getDataToDay($id2['id']);
                    break;
                }

            }
            $this->render('mientrung',array('data1'=>$data1,'data2'=>$data2,
            'id1'=>$id1,'id2'=>$id2,'day'=>$day));
        }

        public function actionChat()
        {    
            if(isset($_GET['messenger']))
            {
                if($_GET['messenger']=="")
                {
                    echo 0;
                    exit;
                }
                if(empty($_SESSION['username']))
                {
                    echo 1;
                    exit;
                }
                $messenger = stripcslashes($_GET['messenger']);
                $date = time();
                $date = date('Y-m-d H:i:s',$date);
                $username = $_SESSION['username'];
                $data_user = User_veso::checkUserName($username);
                $avatar_url = $data_user['avatar_url'];
                $id_user = $data_user['id'];
                $device = "Web";
                Xs_chat::insertDataChat($messenger,$date,$username,$avatar_url,$id_user,$device);
                $data = Xs_chat::getDataChat();
                $this->renderPartial('chat',array('data'=>$data));
            }
            else
            {
                $data = Xs_chat::getDataChat();
                //var_dump($data);die;
                $this->renderPartial('chat',array('data'=>$data)); 
            }
        }
        
        public function actionDientoan()
        {
            $data1 = Ketqua_dientoan123::getDataToDay();
            $data2 = Ketqua_thantai::getDataToDay();
            $data3 = Ketqua_dientoan6x36::getDataToDay();
            //var_dump($data1);die;
            $this->render('dientoan',array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
        }
        
        public function actionBoxSearch()
        {
            $vung = isset($_POST['vung'])? $_POST['vung']: "1";
            $tinh = isset($_POST['tinh'])? $_POST['tinh']: "1";
            $tinh = Province::getDataById($tinh);
            $ngay = isset($_POST['ngay'])? $_POST['ngay']: date('Y-m-d');
            $quay = isset($_POST['quay'])? $_POST['quay']: "1";
            $truoc = isset($_POST['truoc'])? $_POST['truoc']: "0";
            //var_dump($vung);
            $this->renderPartial('boxsearch',array('vung'=>$vung,'tinh'=>$tinh,'ngay'=>$ngay,'quay'=>$quay,
            'truoc'=>$truoc));
        }
        
        public function actionTuongthuatMienbac()
        {
            $this->render('tuongthuatmienbac');
        }
        
        public function actionLoadMienBac()
        {
            $this->renderPartial('MienBacTT');
        }
        
        public function actionTuongthuatMienTrung()
        {
            $this->render('tuongthuatmientrung');
        }
        
        public function actionLoadMienTrung()
        {
            $this->renderPartial('MienTrungTT');
        }
        
        public function actionTuongthuatMienNam()
        {
            $this->render('tuongthuatmiennam');
        }
        
        public function actionLoadMienNam()
        {
            $this->renderPartial('MienNamTT');
        }
        
        public function actionBoxNote()
        {
            $data = Xs_feed::getData();
            $this->renderPartial('boxnote',array('data'=>$data));
        }

    }
?>
