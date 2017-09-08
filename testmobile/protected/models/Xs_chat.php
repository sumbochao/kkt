<?php
    class Xs_chat extends CActiveRecord
    {
        
        public static function getDataChat()
        {
            $connect = Yii::app()->db;
             $sql = "SELECT  c.id,u.username, u.avatar_url, c.content, DATE_FORMAT(c.createtime,'%H:%i') as createtime, c.deviceName, c.region FROM vtc_10h_xs.xs_chat c Left Join user_veso u On c.id_user = u.id WHERE c.region = 0  ORDER BY c.id DESC LIMIT 15";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function insertDataChat($messenger,$date,$username,$avatar_url,$id_user,$device)
        {
            $connect = Yii::app()->db;
            $sql = "INSERT INTO xs_chat(content,createtime,username,avatar_url,id_user,deviceName) VALUE ('$messenger','$date','$username','$avatar_url','$id_user','$device')";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
