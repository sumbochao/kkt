<?php
    class Ketqua_dientoan6x36 extends CActiveRecord
    {
        
        public static function getDataToDay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_dientoan6x36 ORDER BY id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataByDate($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_dientoan6x36 WHERE ngay_quay='$date' ORDER BY id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
    }
?>
