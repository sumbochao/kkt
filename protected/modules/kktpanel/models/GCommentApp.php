<?php
   class GCommentApp extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllComment($type,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if(intval($type) >0)
            {
                $str_sql .= " AND type = $type";
            }
           
           
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_comment_app WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
             
            $sql = "SELECT  c.id,c.user_id,c.type, c.comment,c.email, c.create_date,u.fullname  FROM vtc_game_store.g_comment_app c LEFT JOIN g_user u ON c.user_id = u.id  WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
          
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function deleteComment($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_comment_app WHERE id=$id ";
            
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
      
    }
?>
