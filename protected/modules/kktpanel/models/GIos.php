<?php
    class GIos extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertIos($title,$url,$description,$type,$status,$time_sent,$time,$user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_notice_ios(title,url,description,type,status,time_sent,create_date,create_user) VALUES('$title','$url','$description',$type,$status,'$time_sent','$time','$user')";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getDataIos($keyword,$status,$type,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($keyword != "")
            {
                $str_sql .= " AND content LIKE '%".$keyword."%' "; 
            }
            if($status != 2)
            {
                $str_sql .= " AND status=$status";
            }
            if($type != 0)
            {
                $str_sql .= " AND type=$type";
            }
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_notice WHERE 1 ".$str_sql."";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            $sql = "SELECT * FROM vtc_game_store.g_notice WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($sql);
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function getDataById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_notice_ios WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function updateIos($id,$title,$url,$description,$type,$status,$time_sent)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_notice_ios SET title='$title',url='$url',description='$description',type=$type,status=$status,time_sent='$time_sent' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteIos($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_notice WHERE id=$id";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdate($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_notice_ios SET status=$status WHERE id=$id";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
