<?php
    class GUser extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_user WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getAllData($comment,$keyword,$chat,$discussion,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($keyword != ""){
                $str_sql .= " AND fullname LIKE '%".$keyword."%' ";
                $str_sql .= " OR email LIKE '%".$keyword."%' " ;
            }
            if($chat != 2){
                $str_sql .= " AND is_ban_chat=$chat";
            }
            if($comment != 2){
                $str_sql .= " AND is_ban_comment_new=$comment";
            }
            if($discussion != 2){
                $str_sql .= " AND is_ban_comment_new=$discussion";
            }
          
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_user WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_game_store.g_user WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function quickUpdate($id,$chat,$discussion)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_user SET is_ban_chat=$chat,is_ban_comment_new=$discussion WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
