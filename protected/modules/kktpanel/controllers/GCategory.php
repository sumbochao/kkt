<?php

    class GCategory extends MyActiveRecord
    {

        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllCate()
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT name,id FROM vtc_game_store.g_category";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        public function ajaxQuickSave($id,$order_view_new)
        {
            $connect = Yii::app()->db_gamestore;
            $sql= "UPDATE vtc_game_store.g_category SET order_view ='$order_view_new' WHERE id='$id'";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

        public function insertCate($name,$image,$create_date,$create_user,$order_view)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_category(name,image,create_date,create_user,order_view) VALUES('$name','$image','$create_date','$create_user','$order_view') ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

        public function getDataSearch($keyword,$row_per_page,$page)
        {
           
            $str_sql = "";
            $str_order = " ORDER BY order_view DESC";
            if($keyword != ""){
                $str_sql .= " AND name LIKE '%".$keyword."%' "; 
            }
            
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_category WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            var_dump($sql);die;
            $data_count = $command->queryRow();
            //var_dump($data_count);die;
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_game_store.g_category WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($data_count);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($data);die;
            return array($max_page,intval($data_count["count"]),$data);

        }

        public function deleteCate($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_category WHERE id=$id";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getCateById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_category WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function updateCate($id,$name,$image,$update_date,$update_user,$order_view)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_category SET name='$name',image='$image',order_view='$order_view',update_date='$update_date',update_user='$update_user' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function insertCountGame($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = " UPDATE vtc_game_store.g_category SET count_game =( SELECT COUNT(*) FROM vtc_game_store.g_game WHERE category_id = $id )  WHERE id =$id  ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

    }

?>
