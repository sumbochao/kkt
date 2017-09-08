<?php
   class GSUserBan extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        
        public function insertUserBan($user_id,$date_expire,$type,$reason)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_user_ban (user_id,date_expire,TYPE,reason )
            VALUES ('$user_id','$date_expire','$type','$reason');";
         
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getByUserId($user_id)
        {
            $connect = Yii::app()->db_gamestore; 
            $sql = "SELECT * FROM vtc_game_store.g_user_ban WHERE user_id='$user_id' order by id DESC limit 1";
           
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();  
            return $data;
        }
        
    }
?>
