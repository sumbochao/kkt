<?php
    class Threat_hot_comment extends CActiveRecord
    {
        
        public static function countComment($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM threat_hot_comment WHERE id_thread=$id";
            $command = Yii::app()->db->createCommand($sql);
            $sql1 = "SELECT COUNT(id) FROM thread_hot";
            $data = $command->execute();
            return $data;
        }
        
        public static function getComment($start,$row_page,$id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM threat_hot_comment WHERE id_thread=$id ORDER BY id DESC LIMIT $start,$row_page";
            $command = Yii::app()->db->createCommand($sql);  
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getCommentHot($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM threat_hot_comment WHERE id_thread=$id ORDER BY id DESC LIMIT 2";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function insertComment($id_thread,$id_user,$comment,$create_date,$create_user)
        {
            $connect = Yii::app()->db;
            $sql = "INSERT INTO threat_hot_comment(id_thread,id_user,comment,create_date,create_user) VALUES('$id_thread','$id_user','$comment','$create_date','$create_user')";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
