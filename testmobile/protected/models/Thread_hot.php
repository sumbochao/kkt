<?php
    class Thread_hot extends CActiveRecord
    {
        
        public static function countData()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thread_hot";
            $command = Yii::app()->db->createCommand($sql);
            $sql1 = "SELECT COUNT(id) FROM thread_hot";
            $data = $command->execute();
            return $data;
        }

        public static function getData($start,$row_page)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thread_hot ORDER BY id DESC LIMIT $start,$row_page";
            $command = Yii::app()->db->createCommand($sql);  
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getDataDetail($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM thread_hot WHERE id=$id";
            $command = Yii::app()->db->createCommand($sql);  
            $data = $command->queryRow();
            return $data;
        }

    }
?>
