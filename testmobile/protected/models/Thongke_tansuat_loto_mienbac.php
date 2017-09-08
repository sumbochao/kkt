<?php
    class Thongke_tansuat_loto_mienbac extends CActiveRecord
    {
        
        public static function getTK12BoSoRaNhieu()
        {
            $date = "2014-03-20";
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thongke_tansuat_loto_mienbac WHERE create_date='$date' AND khoang_thoigian=10 ORDER BY so_lan_ve DESC LIMIT 10 ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTK12BoSoRaIt()
        {
            $date = "2014-03-20";
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thongke_tansuat_loto_mienbac WHERE create_date='$date' AND khoang_thoigian=10 ORDER BY so_lan_ve ASC LIMIT 10 ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getBoSoRaLienTiepTrong10Ngay()
        {
            $date = "2014-03-20";
            $connect = Yii::app()->db;
            $sql = "SELECT boso,so_ngay_ve FROM thongke_tansuat_loto_mienbac WHERE create_date='$date' AND khoang_thoigian=10 AND so_ngay_ve>=2 ORDER BY so_ngay_ve DESC LIMIT 12";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getBoSoTrong10Ngay()
        {
            $date = "2014-03-20";
            $connect = Yii::app()->db;
            $sql = "SELECT boso,so_lan_ve,p_so_lan_ve FROM thongke_tansuat_loto_mienbac WHERE create_date='$date' AND khoang_thoigian=10 ORDER BY boso ASC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
