<?php
    class Thongke_chuky_boso extends CActiveRecord
    {
        
        public static function getBoSoKhongRaTrong10Ngay()
        {
            $date = "2014-03-20";
            $date_ago = date('Y-m-d',strtotime("-10 days",strtotime($date)));
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thongke_chuky_boso WHERE start_date>='2014-03-10' AND end_date IS NULL ORDER BY start_date ASC LIMIT 12 ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKChuKyLoTo($boso)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT boso,start_date,end_date,LENGTH AS dodai_chuky,is_special FROM thongke_chuky_boso WHERE DATEDIFF(CURRENT_DATE,end_date)<=30 AND end_date IS NOT NULL AND boso = $boso ORDER BY end_date DESC ";
            //var_dump($sql);
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
