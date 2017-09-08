<?php
    class VipController extends Controller
    {

        public function actionIndex()
        {
            $gancucdai = Thongke_loto_gan_cucdai::getTKLotoGanCucDai();
            $kycucdai = Thongke_loto_denky::getTKLotoDenKySoVoiKyCucDai();
            $kygannhat = Thongke_loto_denky::getTKLotoDenKySoVoiKyGanNhat();
            $this->render('index',array('gancucdai'=>$gancucdai,'kycucdai'=>$kycucdai,'kygannhat'=>$kygannhat));
        }
        
        public function actionTkChuKy()
        {
            if(isset($_POST['boso']))
            {
                $boso = $_POST['boso'];
                if(is_numeric($boso) == false)
                {
                    echo 1;exit;
                }
                $data = Thongke_chuky_boso::getTKChuKyLoTo($boso);
                //var_dump($data);die;
                $this->renderPartial('chuky',array('data'=>$data));
            }
            else
            {
                $this->render('chuky');
            }
        }
        
        public function actionTkGiaiDacBiet()
        {
            if(isset($_POST['ngay']))
            {
                $ngay = $_POST['ngay'];
                if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])$/",$ngay))
                {
                    echo 1; exit;
                }
                $data = Ketqua_mienbac::getTKGiaiDacBietTheoNgay($ngay);
                $this->renderPartial('giaidacbiet',array('data'=>$data));
            }
            else
            {
                $this->render('giaidacbiet');
            }
        }

    }
?>
