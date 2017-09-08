<?php
  class FootBallNews extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertNews($title_news,$description,$content,$image,$lang_id,$cup_id,$club_id,$status)
        {
            
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
          
            $command= $connect->createCommand("INSERT INTO fb_news (title,image,description,content,lang_id
            ,cup_id,club_id,status,create_date,create_user,update_date,update_user)
                        VALUES ('$title_news','$image','$description','$content','$lang_id','$cup_id','$club_id','$status',NOW(),'$create_user',NOW(),'$create_user')");
          /*  $command->bindValue(':title', $title_news);
            $command->bindValue(':image', $image);
            $command->bindValue(':description', $description);
            $command->bindValue(':content', $content);
            $command->bindValue(':lang_id', $lang_id);
            $command->bindValue(':cup_id', $cup_id);
            $command->bindValue(':club_id', $club_id);
            $command->bindValue(':status', $status);
            */
            //var_dump($command);die;
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getNewsById($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_news WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteNews($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_news WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$cup_id,$club_id,$keyword,$page,$row_per_page)
        {
            $str_sql = "";
            $keyword  = mysql_escape_string($keyword);
            $str_order  = " Order By id DESC ";
            
             if($from_date != "")
            {
                $str_sql .=" AND m.create_date>='".$from_date."'";
            }
            
            if($to_date != "")
            {
                $str_sql .=" AND m.create_date<='". $to_date." 23:59:59'";  
            }
            if($category_id > 0)
            {
                $str_sql .=" AND cup_id=".$cup_id;
            }
            if($publisher_id>0)
            {
                $str_sql .= " AND $club_id=".$club_id;
            }
            if($keyword!="" && $type>0)
            {
               $str_sql .= " AND title LIKE '%".$keyword."%' "; 
            }
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_news WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_news WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateNews($id,$title_news,$description,$content,$image,$lang_id,$cup_id,$club_id,$status,$create_date)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $command= $connect->createCommand("UPDATE  fb_news SET title = '$title_news'".  
            ", description = '$description' ".
            ", content = '$content' ".
            ", image = '$image' ".
            ", lang_id = '$lang_id' ".
            ", cup_id = '$cup_id' ".
            ", club_id = '$club_id' ".
            ", status = '$status' ".  
            ", create_date = '$create_date' ".
            ", update_date = NOW() ".
            ", update_user = '$create_user' ".
            " Where id=$id ");
           
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdateNews($id,$status)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE fb_news SET status=$status WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
         public function getClubByCountry($country)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT id,NAME FROM fb_club WHERE country = '".$country."' Order by NAME";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return $data;
        }
        
         public function getCountryList()
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT DISTINCT country,SUBSTR(country,1,1) AS ccd FROM fb_club WHERE country !='' ORDER BY ccd";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return $data;
        }
        
        public function getCupByRate($rate)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT id,CODE,NAME FROM fb_cup WHERE rate = ".$rate;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return $data;
        }
        
         public function getClubByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_club WHERE id = ".$id;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            
            return $data;
        }
        
    }
?>
