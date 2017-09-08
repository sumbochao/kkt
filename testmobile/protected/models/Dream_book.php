<?php
    class Dream_book extends CActiveRecord
    {
        
        public static function countAll()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM dream_book";
            $command = Yii::app()->db->createCommand($sql);
            $sql1 = "SELECT COUNT(id) FROM dream_book";
            $data = $command->execute();
            return $data;
        }
        
        public static function getAll($start,$row_page)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM dream_book ORDER BY id ASC LIMIT $start,$row_page";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function countSearch($search)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM dream_book WHERE title LIKE '$search%'";
            $command = Yii::app()->db->createCommand($sql);
            $sql1 = "SELECT COUNT(id) FROM dream_book";
            $data = $command->execute();
            return $data;
        }
        
        public static function getSearch($start,$row_page,$search)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM dream_book WHERE title LIKE '$search%' ORDER BY id ASC LIMIT $start,$row_page";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
