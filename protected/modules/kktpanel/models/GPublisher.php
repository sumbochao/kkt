<?php
    class GPublisher extends MyActiveRecord
    {

        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }

        public function getAllPublisher()
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT name,id FROM vtc_game_store.g_publisher";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }

        public function getPublisherById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_publisher WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }

        public function insertPublisher($pub_name,$picture,$time_now,$create_user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_publisher(name,image,create_date,create_user) VALUES('$pub_name','$picture','$time_now','$create_user')";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

        public function getDataSearch($keyword,$row_per_page,$page)
        {
            $str_sql = "";
            $str_order = " ORDER BY order_view";
            if($keyword != ""){
                $str_sql .= " AND name LIKE '%".$keyword."%' "; 
            }

            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_publisher WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_game_store.g_publisher WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);

        }

        public function deletePublisher($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_publisher WHERE id=$id";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        // xu li ham quick save
        public function quickSave($id,$order_view)
        {
            $connect = Yii::app()->db_gamestore;
            $sql= "UPDATE vtc_game_store.g_publisher SET order_view = '$order_view' WHERE id ='$id'";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        public function updatePulisher($id,$name,$image,$update_date,$update_user)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_publisher SET name='$name',image='$image',update_date='$update_date',update_user='$update_user' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function insertCountGame($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = " UPDATE vtc_game_store.g_publisher SET count_game =( SELECT COUNT(*) FROM vtc_game_store.g_game WHERE publisher_id = $id )  WHERE id =$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }

    }
?>
