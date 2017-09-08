<?php
    class FootBallNotice extends CActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public static function getNotice($object_id,$type)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_notice WHERE object_id=$object_id AND object_type=$type";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function deleteNotice($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_notice WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public static function insertNoticeGame($object_id,$content,$type,$status,$time,$create_date,$create_user,$icon)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "INSERT INTO fb_notice(object_id,content,object_type,status,time_sent,create_date,create_user,icon) VALUES($object_id,'$content',$type,$status,'$time','$create_date','$create_user','$icon')";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>