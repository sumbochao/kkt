<?php
    class GGiftcodeStore extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getData($status,$id,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            
            if($id != 0)
            {
                $str_sql .= " AND giftcode_id=$id";
            }
            if($status != 2)
            {
                $str_sql .= " AND status=$status";
            }
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_giftcode_store WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            //var_dump($sql);die;
            $data_count = $command->queryRow();
            //var_dump($data_count);die;
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_giftcode_store WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function insertData($giftcode_id,$code,$status,$time,$user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_giftcode_store(giftcode_id,code,status,create_date,create_user) VALUES($giftcode_id,'$code',$status,'$time','$user')";
            var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteData($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_giftcode_store WHERE giftcode_id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_giftcode_store WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_giftcode_store WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function uploadData($id,$status,$code)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_giftcode_store SET status=$status,code='$code' WHERE id=$id";
            //var_dump($sql);
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
