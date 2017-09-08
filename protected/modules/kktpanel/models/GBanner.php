<?php
    class GBanner extends MyActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertBanner($name,$game_id,$category,$image,$position,$status,$os,$time,$user)
        {
          
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_banner(name,game_id,cate_id,image,POSITION,STATUS,os,create_date,create_user) VALUES('$name',$game_id,$category,'$image',$position,$status,$os,'$time','$user') ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getDataBanner($keyword,$game,$cate_id,$os,$position,$status,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            
            if($keyword != "")
            {
                $str_sql .= " AND name LIKE '%".$keyword."%' "; 
            }
            if($game != 0)
            {
                $str_sql .= " AND game_id=$game";
            }
            if($cate_id != 0)
            {
                $str_sql .= " AND cate_id=$cate_id";
            }
            if($os != 0)
            {
                $str_sql .= " AND os=$os";
            }
            if($position != 0)
            {
                $str_sql .= " AND position=$position";
            }
            if($status != 2)
            {
                $str_sql .= " AND status=$status";
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_banner WHERE 1 ".$str_sql."";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_banner WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($sql);
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function getBannerById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_banner WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data; 
        }
        
        public function updateBanner($id,$name,$game_id,$category,$image,$position,$status,$os,$time,$user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_banner SET name='$name',game_id=$game_id,cate_id=$category,image='$image',position=$position,status=$status,os=$os,update_date='$time', update_user='$user' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteBanner($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_banner WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdate($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_banner SET status=$status WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
