<?php
  class FootBallCoach extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertCoach($name,$name_en,$birthday,$height,$weight,$joindate,$avatar,$country,
        $formerclub,$onceclub,$id_7m)
        {
            
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $sql = "INSERT INTO vtc_bongda.fb_coach (NAME,name_en,birthday, 
    height,weight,joindate,avatar,country,formerclub,onceclub,create_date,create_user,id_7m)
    VALUES   ('$name','$name_en','$birthday','$height','$weight','$joindate','$avatar','$country','$formerclub', 
    '$onceclub',NOW(),'$create_user','$id_7m');)";   
            $command= $connect->createCommand($sql);
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getCoachById($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_coach WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteCoach($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_coach WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$name,$country,$page,$row_per_page)
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
            if($name!="")
            {
               $str_sql .= " AND (name LIKE '%".$name."%' OR name_en like '%".$name."%') "; 
            }
            if($country!="")
            {
               $str_sql .= " AND country LIKE '%".$country."%'"; 
            }
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_coach WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_coach WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateCoach($id,$name,$name_en,$birthday,$height,$weight,$joindate,$avatar,$country,
        $formerclub,$onceclub,$id_7m)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $command= $connect->createCommand("UPDATE vtc_bongda.fb_coach SET  NAME = '$name' ,
            name_en = '$name_en' ,
            birthday = '$birthday' , 
            height = '$height' , 
            weight = '$weight' , 
            joindate = '$joindate' , 
            avatar = '$avatar' , 
            country = '$country' , 
            formerclub = '$formerclub' , 
            onceclub = '$onceclub' , 
            id_7m = '$id_7m',
            update_date = NOW(),
            update_user = '$create_user'
            WHERE
            id = '$id' ;");
           
            $data = $command->execute();
            return $data;
        }
        
        
        
    }
?>
