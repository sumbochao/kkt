<?php
  class FootBaller extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertFootballer($name,$avatar,$country,$birthday,$height,$weight,$club_id,$position,$join_date
        ,$transfer_free,$former_club,$one_club,$conveniently_foot,$achievement,$clubshirtno,$id_7m)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            if(intval($id_7m)>0)
            $sql =   "INSERT INTO vtc_bongda.fb_footballer 
            (NAME,avatar,country,birthday,height,weight,club_id,POSITION,join_date,transfer_free,former_club, 
            one_club,conveniently_foot,achievement,clubshirtno,create_date,create_user,id_7m) 
            VALUES  ('$name','$avatar','$country','$birthday','$height','$weight','$club_id','$position', 
    '$join_date','$transfer_free','$former_club','$one_club', '$conveniently_foot','$achievement','$clubshirtno',NOW(),'$create_user','$id_7m')";
            else
           $sql =   "INSERT INTO vtc_bongda.fb_footballer 
            (NAME,avatar,country,birthday,height,weight,club_id,POSITION,join_date,transfer_free,former_club, 
            one_club,conveniently_foot,achievement,clubshirtno,create_date,create_user) 
            VALUES  ('$name','$avatar','$country','$birthday','$height','$weight','$club_id','$position', 
    '$join_date','$transfer_free','$former_club','$one_club', '$conveniently_foot','$achievement','$clubshirtno',NOW(),'$create_user')"; 
            
            $command= $connect->createCommand($sql);
           
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getFootballerById($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_footballer WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteNews($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_footballer WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$name,$country,$page,$row_per_page)
        {
            $str_sql = "";
            $keyword  = mysql_escape_string($keyword);
            $str_order  = " Order By f.id DESC ";
            
            if($from_date != "")
            {
                $str_sql .=" AND m.create_date>='".$from_date."'";
            }
            
            if($to_date != "")
            {
                $str_sql .=" AND m.create_date<='". $to_date." 23:59:59'";  
            }
            if($name!="")
            {
               $str_sql .= " AND f.name LIKE '%".$name."%' "; 
            }
             if($country!="")
            {
               $str_sql .= " AND f.country LIKE '%".$country."%' "; 
            }
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_footballer f WHERE 1 ".$str_sql."";
            
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
                 
            $sql = "SELECT f.*,c.name as club_name FROM fb_footballer f Left Join fb_club c On f.club_id = c.id WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
               
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateFootballer($id,$name,$avatar,$country,$birthday,$height,$weight,$club_id,$position,$join_date
        ,$transfer_free,$former_club,$one_club,$conveniently_foot,$achievement,$clubshirtno,$id_7m)
        {
           
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $sql =    "UPDATE vtc_bongda.fb_footballer SET NAME = '$name' ,avatar = '$avatar' , 
                 country = '$country' , 
                 birthday = '$birthday' , 
                 height = '$height' , 
                 weight = '$weight' , 
                 club_id = '$club_id' , 
                 POSITION = '$position' , 
                 join_date = '$join_date' , 
                 transfer_free = '$transfer_free' , 
                 former_club = '$former_club' , 
                 one_club = '$one_club' , 
                 conveniently_foot = '$conveniently_foot' , 
                 achievement = '$achievement' , 
                 clubshirtno = '$clubshirtno' , 
                 update_date = NOW() ,
                 update_user = '$create_user' ,
                 id_7m = '$id_7m'  WHERE
                 id = '$id' ; ";
          //  echo $sql;die;  
            $command= $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function quickUpdateNews($id,$status)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE fb_footballer SET status=$status WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
