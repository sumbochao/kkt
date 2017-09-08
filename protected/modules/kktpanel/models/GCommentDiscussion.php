<?php
    class GCommentDiscussion extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllComment($id,$discussion_id,$keyword,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($id != "")
            {
                $str_sql .= " AND discussion_id=$id";
            }
            elseif($discussion_id != "")
            {
                $str_sql .= " AND discussion_id=$discussion_id";
            }
            if($keyword != "")
            {
                $str_sql .= " AND comment LIKE '%".$keyword."%' "; 
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_discusstion_comment WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            //var_dump($sql);die;
            $data_count = $command->queryRow();
            //var_dump($data_count);die;
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_discusstion_comment WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($data_count);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function deleteComment($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_discusstion_comment WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateComment($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_discusstion_comment SET status=$status WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
