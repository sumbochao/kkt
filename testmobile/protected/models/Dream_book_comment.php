<?php
    class Dream_book_comment extends CActiveRecord
    {
        
        public static function getDataChat()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM dream_book_comment ORDER BY id DESC LIMIT 5";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function insertDataChat($messenger,$date)
        {
            $connect = Yii::app()->db;
            $sql = "INSERT INTO dream_book_comment(comment,create_date) VALUE ('$messenger',$date)";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
