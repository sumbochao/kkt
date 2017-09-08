<?php

    class KetquaController extends Controller
    {

        public function actionMienBac()
        {
            $ketqua = Ketqua_mienbac::getDataToDay();
            $loto = Thongke_loto_mienbac::getDataToday($ketqua['ngay_quay']);
            $this->render('mienbac',array('ketqua'=>$ketqua,'loto'=>$loto));
        }

        public function actionKetquaMienBac()
        {
            $date = isset($_GET['date'])? $_GET['date']: "";
            if(isset($_GET['last']))
            {
                $last = $_GET['last'];
                $date = date("Y-m-d",strtotime("-1 day",strtotime($last)));
                //var_dump($date);die;
            }
            if(isset($_GET['next']))
            {
                $next = $_GET['next'];
                $date = date("Y-m-d",strtotime("+1 day",strtotime($next)));
                //var_dump($date);die;
            }
            $ketqua = Ketqua_mienbac::getDataOtherDay($date);
            $loto = Thongke_loto_mienbac::getDataToday($ketqua['ngay_quay']);
            if(empty($ketqua))
            {
                echo 1; exit;
            }
            $data = $this->renderPartial('ketquamienbac',array('ketqua'=>$ketqua,'loto'=>$loto));
        }

        public function actionMienNam()
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

        public function actionKetQuaMienNam()
        {
            $time = isset($_GET['date'])? $_GET['date']: "";
            $day = strtotime($time);
            $day = date('l',$day);
            $day = substr($day,0,3);
            $date = substr($time,-10,10);
            if(isset($_GET['last']))
            {
                $last = $_GET['last'];
                $day = strtotime($last);
                $day = date('l',$day);
                $day = substr($day,0,3);
                $last = substr($last,-10,10);
                $date = date("Y-m-d",strtotime("-7 day",strtotime($last)));
                //var_dump($time);die;
            }
            if(isset($_GET['next']))
            {
                $next = $_GET['next'];
                $day = strtotime($next);
                $day = date('l',$day);
                $day = substr($day,0,3);
                $next = substr($next,-10,10);
                $date = date("Y-m-d",strtotime("+7 day",strtotime($next)));
                //var_dump($day);die;
            }
            $region = 3;
            switch($day)
            {
                case "Mon":
                {
                    $day = "Thứ hai";
                    $id = Province::getIdByMon($region);
                    list($id1,$id2,$id3) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Tue":
                {
                    $day = "Thứ ba";
                    $id = Province::getIdByTue($region);
                    list($id1,$id2,$id3) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Wed":
                {
                    $day = "Thứ tư";
                    $id = Province::getIdByWed($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Thu":
                {
                    $day = "Thứ năm";
                    $id = Province::getIdByThu($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Fri":
                {
                    $day = "Thứ sáu";
                    $id = Province::getIdByFri($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Sat":
                {
                    $day = "Thứ bảy";
                    $id = Province::getIdBySat($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }
                case "Sun":
                {
                    $day = "Chủ nhật";
                    $id = Province::getIdBySun($region);
                    list($id1,$id2,$id3) = $id;
                    $data1 = Ketqua_miennam::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_miennam::getDataOtherDay($date,$id2['id']);
                    $data3 = Ketqua_miennam::getDataOtherDay($date,$id3['id']);
                    break;
                }

            }
            if(empty($data1))
            {
                echo 1;
            }
            else
            {
                $this->renderPartial('ketquamiennam',array('data1'=>$data1,'data2'=>$data2,
                    'data3'=>$data3,'id1'=>$id1,'id2'=>$id2,'id3'=>$id3,'day'=>$day));
            }
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

        public function actionKetQuaMienTrung()
        {
            $time = isset($_GET['date'])? $_GET['date']: "";
            $day = strtotime($time);
            $day = date('l',$day);
            $day = substr($day,0,3);
            $date = substr($time,-10,10);
            if(isset($_GET['last']))
            {
                $last = $_GET['last'];
                $day = strtotime($last);
                $day = date('l',$day);
                $day = substr($day,0,3);
                $last = substr($last,-10,10);
                $date = date("Y-m-d",strtotime("-7 day",strtotime($last)));
                //var_dump($time);die;
            }
            if(isset($_GET['next']))
            {
                $next = $_GET['next'];
                $day = strtotime($next);
                $day = date('l',$day);
                $day = substr($day,0,3);
                $next = substr($next,-10,10);
                $date = date("Y-m-d",strtotime("+7 day",strtotime($next)));
                //var_dump($day);die;
            }
            $region = 2;
            switch($day)
            {
                case "Mon":
                {
                    $day = "Thứ hai";
                    $id = Province::getIdByMon($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Tue":
                {
                    $day = "Thứ ba";
                    $id = Province::getIdByTue($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Wed":
                {
                    $day = "Thứ tư";
                    $id = Province::getIdByWed($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Thu":
                {
                    $day = "Thứ năm";
                    $id = Province::getIdByThu($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Fri":
                {
                    $day = "Thứ sáu";
                    $id = Province::getIdByFri($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Sat":
                {
                    $day = "Thứ bảy";
                    $id = Province::getIdBySat($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }
                case "Sun":
                {
                    $day = "Chủ nhật";
                    $id = Province::getIdBySun($region);
                    list($id1,$id2) = $id;
                    //var_dump($id1);die;
                    $data1 = Ketqua_mientrung::getDataOtherDay($date,$id1['id']);
                    $data2 = Ketqua_mientrung::getDataOtherDay($date,$id2['id']);
                    break;
                }

            }
            if(empty($data1))
            {
                echo 1;
            }
            else
            {
                $this->renderPartial('ketquamientrung',array('data1'=>$data1,'data2'=>$data2,
                    'id1'=>$id1,'id2'=>$id2,'day'=>$day));
            }
        }

        public function actionSearch()
        {
            $vung = isset($_POST['vung'])? $_POST['vung']: "1";
            $tinh = isset($_POST['tinh'])? $_POST['tinh']: "1";
            $ngay = isset($_POST['ngay'])? $_POST['ngay']: "";
            $quay = isset($_POST['quay'])? $_POST['quay']: "1";
            $truoc = isset($_POST['truoc'])? $_POST['truoc']: "0";
            //var_dump($truoc);die;
            switch($vung)
            {
                case "1":
                {
                    $data = Ketqua_mienbac::getDataByProvince($tinh,$ngay,$quay,$truoc);
                    $this->render('search',array('data'=>$data,'tinh'=>$tinh,
                        'vung'=>$vung,'quay'=>$quay,'truoc'=>$truoc,'ngay'=>$ngay));
                    break;
                }
                case "2":
                {
                    $data = Ketqua_mientrung::getDataByProvince($tinh,$ngay,$quay,$truoc);
                    $tinh = Province::getNameByProvince($tinh);
                    //var_dump($tinh);die;
                    $this->render('searchmientrung',array('data'=>$data,'tinh'=>$tinh,
                        'vung'=>$vung,'quay'=>$quay,'truoc'=>$truoc,'ngay'=>$ngay));
                    break;
                }
                case "3":
                {
                    $data = Ketqua_miennam::getDataByProvince($tinh,$ngay,$quay,$truoc);
                    $tinh = Province::getNameByProvince($tinh);
                    //var_dump($tinh);die;
                    $this->render('searchmiennam',array('data'=>$data,'tinh'=>$tinh,
                        'vung'=>$vung,'quay'=>$quay,'truoc'=>$truoc,'ngay'=>$ngay));
                    break;
                }
            }
        }

        public function actionSelect()
        {
            $region = isset($_GET['id'])? $_GET['id']: "1";
            $tinh = isset($_GET['tinh'])? $_GET['tinh']: "1";
            $data = Province::getNameByRegion($region);
            //var_dump($tinh);
            foreach($data as $region)
            {
                if($tinh == $region['id'])
                {
                    echo '<option value="'.$region['id'].'" selected="selected">'.$region['name'].'</option>';
                }
                else
                {
                    echo '<option value="'.$region['id'].'">'.$region['name'].'</option>';
                }
            }
        }

        public function actionDientoan()
        {
            if(isset($_GET['last']))
            {
                $last = $_GET['last'];
                $date = date("Y-m-d",strtotime("-1 day",strtotime($last)));
                $data1 = Ketqua_dientoan123::getDataByDate($date);
                $data2 = Ketqua_thantai::getDataByDate($date);
                $data3 = Ketqua_dientoan6x36::getDataByDate($date);
                $this->renderPartial('ketquadientoan',array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
                //var_dump($date);die;
            }
            elseif(isset($_GET['next']))
            {
                $next = $_GET['next'];
                $date = date("Y-m-d",strtotime("+1 day",strtotime($next)));
                $data1 = Ketqua_dientoan123::getDataByDate($date);
                $data2 = Ketqua_thantai::getDataByDate($date);
                $data3 = Ketqua_dientoan6x36::getDataByDate($date);
                $this->renderPartial('ketquadientoan',array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
                //var_dump($date);die;
            }
            elseif(isset($_GET['date']))
            {
                $date = $_GET['date'];
                $data1 = Ketqua_dientoan123::getDataByDate($date);
                $data2 = Ketqua_thantai::getDataByDate($date);
                $data3 = Ketqua_dientoan6x36::getDataByDate($date);
                //var_dump($data2);
                $this->renderPartial('ketquadientoan',array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
            }
            else
            {
                $data1 = Ketqua_dientoan123::getDataToDay();
                $data2 = Ketqua_thantai::getDataToDay();
                $data3 = Ketqua_dientoan6x36::getDataToDay();
                //var_dump($data1);die;
                $this->render('dientoan',array('data1'=>$data1,'data2'=>$data2,'data3'=>$data3));
            }
        }

    }

?>
