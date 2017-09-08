<?php
    class ThongkeController extends Controller
    {

        public function actionIndex()
        {
            $tongboso = Thongke_loto_mienbac::countTongBoSoMoThuong();
            
            
            $nhieu = Thongke_loto_mienbac::getTK12BoSoRaNhieu();
            //var_dump($nhieu);die;
            foreach($nhieu as $ranhieu)
            {
                $ranhieu['percent'] = round($ranhieu['sl']/$tongboso['sl']*100,2);
                $bosoranhieu[] = $ranhieu;
            }
            
             
            $it = Thongke_loto_mienbac::getTK12BoSoRaIt();
             
            foreach($it as $rait)
            {
                $rait['percent'] = round($rait['sl']/$tongboso['sl']*100,2);
                $bosorait[] = $rait;
            } 
            //var_dump($bosorait);die;
            
            $bosolientiep = Thongke_loto_mienbac::getTKBoSoRaLienTiep();
            $bosokhan = Thongke_loto_mienbac::getTKBoSoMBGanTren10Ngay();
            
            $tongdauso = Thongke_loto_mienbac::countTongDauSoMoThuong();
            //var_dump($tongdauso);die;
            $dau = Thongke_loto_mienbac::getTKDauSoMoThuong();
            foreach($dau as $dau)
            {
                $dau['percent'] = round($dau['sl']/$tongdauso['sl']*100,2);
                $arr_dau[] = $dau;
            }
            
            
            $dit = Thongke_loto_mienbac::getTKDuoiSoMoThuong();
            foreach($dit as $dit)
            {
                $dit['percent'] = round($dit['sl']/$tongdauso['sl']*100,2);
                $arr_dit[] = $dit;
            }
            //var_dump($arr_dit);die;
            
            $this->render('index',array('bosoranhieu'=>$bosoranhieu,'bosorait'=>$bosorait,
                'bosolientiep'=>$bosolientiep,'bosokhan'=>$bosokhan,'arr_dau'=>$arr_dau,
                'arr_dit'=>$arr_dit));
        }

        public function actionThongke()
        {
            //$nhieunhat = Thongke_tansuat_loto_mienbac::getBoSoNhieuNhatTrong10Ngay();
            //            $itnhat = Thongke_tansuat_loto_mienbac::getBoSoItNhatTrong10Ngay();
            //            $bosolientiep = Thongke_tansuat_loto_mienbac::getBoSoRaLienTiepTrong10Ngay();
            $boso = Thongke_tansuat_loto_mienbac::getBoSoTrong10Ngay();

            for($i=0;$i<count($boso);$i++)
            {
                if(substr($boso[$i]['boso'],-2,1)==0)
                {
                    $sum[$i] = $boso[$i]['so_lan_ve'];
                    $sum1[$i] = $boso[$i]['p_so_lan_ve'];
                    $so_lan_ve = array_sum($sum);
                    $p_so_lan_ve = array_sum($sum1);
                    //var_dump($boso);
                    var_dump(floor($p_so_lan_ve));
                }
            }
            //$this->render('thongke');

            //$bosokhonglientiep = Thongke_chuky_boso::getBoSoKhongRaTrong10Ngay();
            //var_dump($bosokhonglientiep);die;
            //foreach($bosokhonglientiep as $data)
            //            {
            //                $now = strtotime('2014-03-20');
            //                $date = strtotime($data['start_date']);
            //                $day = abs($now - $date);
            //                $day = floor($day/(60*60*24));
            //                var_dump($data['boso']);
            //                var_dump($day);
            //            }
        }

    }
?>
