<?php
    class Ketqua_dientoan123 extends CActiveRecord
    {
        
        public static function getDataToDay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_dientoan123 ORDER BY id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataByDate($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_dientoan123 WHERE ngay_quay='$date' ORDER BY id DESC";
            //var_dump($sql);
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
    }
?>
