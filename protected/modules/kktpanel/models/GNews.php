<?php
    class GNews extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertNews($title_news,$description,$content,$image,$game,$category,$publisher,$time_now,$create_user,$event,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_news(title,description,content,image,game_id,category_id,publisher_id,create_date,create_user,is_event,STATUS) VALUES('$title_news','$description','$content','$image',$game,$category,$publisher,'$time_now','$create_user',$event,$status)";
            $command = Yii::app()->db_gamestore->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getNewsById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_news WHERE id=$id";
            $command = Yii::app()->db_gamestore->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteNews($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_news WHERE id=$id";
            $command = Yii::app()->db_gamestore->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getAllData($from_date,$to_date,$category_id,$publisher_id,$keyword,$type,$orderBy,$compare,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = "";
            switch($orderBy)
            {
                case 0: $str_order .= "ORDER BY count_comment";break;
                case 1: $str_order .= "ORDER BY count_like";break;
                case 2: $str_order .= "ORDER BY count_view";break;
                case 3: $str_order .= "ORDER BY id";break;
            }
            
            if(intval($compare) == 1)
            {
                $str_order .= " DESC ";
            }
            else
            {
                $str_order .= " ASC ";
            }
            
            if($from_date != "")
            {
                $str_sql .=" AND create_date>=".$from_date;
            }
            
            if($to_date != "")
            {
                $str_sql .=" AND create_date<=". $to_date;
            }
            if($category_id > 0)
            {
                $str_sql .=" AND category_id=".$category_id;
            }
            if($publisher_id>0)
            {
                $str_sql .= " AND publisher_id=".$publisher_id;
            }
            if($keyword!="" && $type>0)
            {
                if($type == 1)
                {
                    $str_sql .= " AND id=".intval($keyword);
                }
                if($type == 2)
                {
                    $str_sql .= " AND title LIKE '%".$keyword."%' "; 
                }
            }
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_news WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_news WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateNews($id,$title_news,$category,$game,$publisher,$image,$description,$content,$event,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_news SET 
            title='$title_news',
            category_id = '$category',
            game_id = '$game',
            publisher_id = '$publisher',
            image = '$image',
            description = '$description',
            content ='$content',
            is_event=$event,
            STATUS = $status
            WHERE id=$id
            ";
            $command = Yii::app()->db_gamestore->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdateNews($id,$status)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_news SET status=$status WHERE id=$id";
            $command = Yii::app()->db_gamestore->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
