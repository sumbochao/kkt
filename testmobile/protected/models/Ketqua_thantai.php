<?php
    class Ketqua_thantai extends CActiveRecord
    {
        
        public static function getDataToDay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_thantai ORDER BY id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataByDate($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_thantai WHERE ngay_quay='$date' ORDER BY id DESC";
            //var_dump($sql);
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
    }
?>
