<?php
    class AAudioNotice extends CActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public static function getNotice($object_id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM c_story_audio_notice WHERE audio_id=$object_id";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return $data;
        }
        
        public static function deleteNotice($id)
        {
            $connect = Yii::app()->db;
            $sql = "DELETE FROM c_story_audio_notice WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public static function insertNoticeGame($object_id,$content,$status,$time,$create_date,$create_user,$icon)
        {
            $connect = Yii::app()->db;
            $sql = "INSERT INTO c_story_audio_notice(audio_id,content,status,time_sent,create_date,create_user,icon) VALUES($object_id,'$content',$status,'$time','$create_date','$create_user','$icon')";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>