<?php
    class GGiftcode extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertGiftcode($title,$game_id,$category_id,$publisher_id,$total,$available,$description,$time,$user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_giftcode(title,game_id,category_id,publisher_id,total_giftcode,available_giftcode,description,create_date,create_user) VALUES('$title',$game_id,$category_id,$publisher_id,$total,$available,'$description','$time','$user')";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateGiftcode($id,$title,$game_id,$category_id,$publisher_id,$total,$available,$description)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_giftcode SET 
            title='$title',
            game_id=$game_id,
            category_id=$category_id,
            publisher_id=$publisher_id,
            total_giftcode=$total,
            available_giftcode=$available,
            description='$description'
            WHERE
            id=$id
             ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        public function getStatus($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT id FROM vtc_game_store.g_giftcode WHERE id=$id";
           
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function updateStatus($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_giftcode SET 
            status='$status' WHERE id=$id";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateGiftcodeAvailable($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE g_giftcode SET available_giftcode = "
                    . "(SELECT count(*) FROM g_giftcode_store WHERE giftcode_id = $id AND status = 1 ) WHERE id = $id ";
            
            $command = $connect->createCommand($sql);
            $data = $command->execute();
          
            return $data;
        }
        
        public function getGiftcode($keyword,$game,$category_id,$publisher_id,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($keyword != "")
            {
                 $str_sql .= " AND title LIKE '%".$keyword."%' "; 
            }
            if($game != 0)
            {
                $str_sql .= " AND game_id=$game";
            }
            if($category_id != 0)
            {
                $str_sql .= " AND category_id=$category_id";
            }
            if($publisher_id != 0)
            {
                $str_sql .= " AND publisher_id=$publisher_id";
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_giftcode WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            //var_dump($sql);die;
            $data_count = $command->queryRow();
            //var_dump($data_count);die;
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_giftcode WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($data_count);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);
            
        }
        
        public function getId()
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT id FROM vtc_game_store.g_giftcode ORDER BY id DESC LIMIT 1";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_giftcode WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteGiftcode($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_giftcode WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
