<?php
    class Thongke_boso_ve_lientiep extends CActiveRecord
    {
        
        public static function getTKBoSoRaLienTiep()
        {
            $today = "2014-03-20";
            $connect = Yii::app()->db;
            $sql = "SELECT boso,start_date,end_date,length FROM thongke_boso_ve_lientiep WHERE province_id = 1   AND LENGTH > 1 AND end_date = '$today'";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
