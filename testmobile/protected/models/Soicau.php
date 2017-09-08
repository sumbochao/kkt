<?php
    class Soicau extends CActiveRecord
    {
        
        public static function getDataToDay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM soicau ORDER id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
    }
?>
