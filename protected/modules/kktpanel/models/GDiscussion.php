<?php
    class GDiscussion extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllDiscussion($id,$game_id,$keyword,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($id != "")
            {
                $str_sql .= " AND game_id=$id";
            }
            elseif($game_id != "")
            {
                $str_sql .= " AND game_id=$game_id";
            }
            if($keyword != "")
            {
                $str_sql .= " AND content LIKE '%".$keyword."%' "; 
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_discussion WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            //var_dump($sql);die;
            $data_count = $command->queryRow();
            //var_dump($data_count);die;
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_discussion WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($data_count);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function deleteDiscussion($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_discussion WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateDiscussion($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_discussion SET status=$status WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
