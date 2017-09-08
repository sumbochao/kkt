<?php
    class Thongke_loto_mientrung extends CActiveRecord
    {
        
        public static function getDataToday($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT boso FROM thongke_loto_mientrung WHERE ngay_quay='$date' ";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
