<?php
  class FootBallVideo extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertVideo($title,$description,$image,$video,$cup_id,$club_id,$status,$match_id)
        {
            
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
          
            $command= $connect->createCommand("INSERT INTO fb_video (title,image,description,video
            ,cup_id,club_id,status,create_date,create_user,update_date,update_user,match_id)
                        VALUES ('$title','$image','$description','$video','$cup_id','$club_id','$status',NOW(),'$create_user',NOW(),'$create_user','$match_id')");
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getVideoByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_video WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteVideo($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_video WHERE id=$id";
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
                $str_sql .=" AND m.create_date<='".$to_date." 23:59:59'";  
            }
            if($category_id > 0)
            {
                $str_sql .=" AND cup_id=".$cup_id;
            }
            if($publisher_id>0)
            {
                $str_sql .= " AND club_id=".$club_id;
            }
            if($keyword!="" && $type>0)
            {
               $str_sql .= " AND title LIKE '%".$keyword."%' "; 
            }
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_video WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_video WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateVideo($id,$title,$description,$image,$video,$cup_id,$club_id,$status,$match_id,$create_date)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $command= $connect->createCommand("UPDATE  fb_video SET title = '$title'".  
            ", description = '$description' ".
            ", image = '$image' ".
            ", video = '$video' ".
            ", cup_id = '$cup_id' ".
            ", club_id = '$club_id' ".
            ", match_id = '$match_id' ".
            ", status = '$status' ".
            ", create_date = '$create_date' ".
            ", update_date = NOW() ".
            ", update_user = '$create_user' ".
            " Where id=$id ");
           echo $sql;
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdateNews($id,$status)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE fb_video SET status=$status WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
         
        
    }
?>
