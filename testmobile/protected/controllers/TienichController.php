<?php
    class TienichController extends Controller
    {

        public function actionCalendar()
        {
            $mon = Province::getDataByMon();
            $tue = Province::getDataByTue();
            $wed = Province::getDataByWed();
            $thu = Province::getDataByThu();
            $fri = Province::getDataByFri();
            $sat = Province::getDataBySat();
            $sun = Province::getDataBySun();
            //var_dump($mon);
            $this->render('calendar',array('mon'=>$mon,'tue'=>$tue,'wed'=>$wed,'thu'=>$thu,
                'fri'=>$fri,'sat'=>$sat,'sun'=>$sun));
        }

        public function actionSomo()
        {
            $page = isset($_GET['page'])? $_GET['page']: 1;
            //var_dump($page);
            $row_page = 15;
            $start = ($page-1)*$row_page;
            $total_data = Dream_book::countAll();
            $total_page = ceil($total_data/$row_page);
            $data = Dream_book::getAll($start,$row_page);
            //var_dump($total_page);
            $this->render('somo',array('data'=>$data,'total_page'=>$total_page,'page'=>$page));
        }

        public function actionSearch()
        {
            if(isset($_GET['search']))
            {
                $search = isset($_GET['search'])? $_GET['search'] : "";
                $page = isset($_GET['page'])? $_GET['page']: "1";
                $row_page = 15;
                $start = ($page-1)*$row_page;
                $total_data = Dream_book::countSearch($search);
                $total_page = ceil($total_data/$row_page);
                $data = Dream_book::getSearch($start,$row_page,$search);
                //var_dump($page);die;
                $this->render('somosearch',array('data'=>$data,'total_page'=>$total_page,'page'=>$page,'search'=>$search));
            }
            elseif(isset($_POST['search']))
            {
                $search = isset($_POST['search'])? $_POST['search'] : "";
                $page = isset($_POST['page'])? $_POST['page']: "1";
                $row_page = 15;
                $start = ($page-1)*$row_page;
                $total_data = Dream_book::countSearch($search);
                $total_page = ceil($total_data/$row_page);
                $data = Dream_book::getSearch($start,$row_page,$search);
                //var_dump($page);die;
                $this->renderPartial('somosearch',array('data'=>$data,'total_page'=>$total_page,'page'=>$page,'search'=>$search));
            }
        }

        public function actionQuayThu()
        {
            if(isset($_POST['tinh']))
            {
                $name = $_POST['tinh'];
                $data = Province::getDataByName($name);
                $region = $data['region'];
                //var_dump($data);die;
                if($region == 1)
                {
                    $date = time();
                    $date = date('N',$date);
                    switch($date)
                    {
                        case "1":
                        {
                            $tinh = Province::getDataByMon();
                            break;
                        }
                        case "2":
                        {
                            $tinh = Province::getDataByTue();
                            break;
                        }
                        case "3":
                        {
                            $tinh = Province::getDataByWed();
                            break;
                        }
                        case "4":
                        {
                            $tinh = Province::getDataByThu();
                            break;
                        }
                        case "5":
                        {
                            $tinh = Province::getDataByFri();
                            break;
                        }
                        case "6":
                        {
                            $tinh = Province::getDataBySat();
                            break;
                        }
                        case "7":
                        {
                            $tinh = Province::getDataBySun();
                            break;
                        }
                    }
                    $this->renderPartial('quaythumienbac',array('tinh'=>$tinh,'data'=>$data));
                }
                else
                {
                    $date = time();
                    $date = date('N',$date);
                    switch($date)
                    {
                        case "1":
                        {
                            $tinh = Province::getDataByMon();
                            break;
                        }
                        case "2":
                        {
                            $tinh = Province::getDataByTue();
                            break;
                        }
                        case "3":
                        {
                            $tinh = Province::getDataByWed();
                            break;
                        }
                        case "4":
                        {
                            $tinh = Province::getDataByThu();
                            break;
                        }
                        case "5":
                        {
                            $tinh = Province::getDataByFri();
                            break;
                        }
                        case "6":
                        {
                            $tinh = Province::getDataBySat();
                            break;
                        }
                        case "7":
                        {
                            $tinh = Province::getDataBySun();
                            break;
                        }
                    }
                    $this->renderPartial('quaythumientrung',array('tinh'=>$tinh,'data'=>$data));
                }
            }
            else
            {
                $date = time();
                $date = date('N',$date);
                switch($date)
                {
                    case "1":
                    {
                        $tinh = Province::getDataByMon();
                        break;
                    }
                    case "2":
                    {
                        $tinh = Province::getDataByTue();
                        break;
                    }
                    case "3":
                    {
                        $tinh = Province::getDataByWed();
                        break;
                    }
                    case "4":
                    {
                        $tinh = Province::getDataByThu();
                        break;
                    }
                    case "5":
                    {
                        $tinh = Province::getDataByFri();
                        break;
                    }
                    case "6":
                    {
                        $tinh = Province::getDataBySat();
                        break;
                    }
                    case "7":
                    {
                        $tinh = Province::getDataBySun();
                        break;
                    }
                }
                $this->render('quaythu',array('tinh'=>$tinh));
            }
        }

        public function actionQuayThuMienBac()
        {
            $giai = isset($_POST['giai'])? $_POST['giai']: '';
            if($giai<=4)
            {
                echo rand(10,99);
            }
            elseif($giai>4 && $giai<=7)
            {
                echo rand(100,999);
            }
            elseif($giai>7 && $giai<=13)
            {
                echo rand(1000,9999);
            }
            elseif($giai>13 && $giai<=17)
            {
                echo rand(1000,9999);
            }
            elseif($giai>17 && $giai<=27)
            {
                echo rand(10000,99999);
            }
        }

        public function actionQuayThuMienTrung()
        {
            $giai = isset($_POST['giai'])? $_POST['giai']: '';
            if($giai<=1)
            {
                echo rand(10,99);
            }
            elseif($giai>1 && $giai<=2)
            {
                echo rand(100,999);
            }
            elseif($giai>2 && $giai<=5)
            {
                echo rand(1000,9999);
            }
            elseif($giai>5 && $giai<=6)
            {
                echo rand(1000,9999);
            }
            elseif($giai>6 && $giai<=17)
            {
                echo rand(10000,99999);
            }
            elseif($giai>17 && $giai<=18)
            {
                echo rand(100000,999999);
            }
        }

    }
?>
