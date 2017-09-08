<?php
  class FootBallClub extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertClub($code,$name,$name_en,$city,$country,$country_en,$info, 
    $logo,$stadium,$stadium_capacity,$address,$website,$fan_page,$email,$established_date,$coach_id,$map,$avgage,$refe,$id_7m)
        {
            
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
                
            $command= $connect->createCommand("INSERT INTO vtc_bongda.fb_club (CODE,NAME,name_en,city,country,country_en,info, 
    logo,stadium,stadium_capacity,address,website,fan_page,email,established_date,coach_id,map,avgage,create_date,create_user,refe,id_7m)
    VALUES ('$code','$name','$name_en','$city','$country','$country_en','$info','$logo','$stadium','$stadium_capacity','$address','$website', 
    '$fan_page','$email','$established_date','$coach_id','$map','$avgage',NOW(),'$create_user','$refe', '$id_7m');");
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getClubByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_club WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function deleteNews($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM fb_club WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$code,$name,$country,$page,$row_per_page)
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
            
            if($code!="")
            {
               $str_sql .= " AND (code LIKE '%".$code."%')"; 
            }
            if($name!="")
            {
               $str_sql .= " AND (name LIKE '%".$name."%' OR name_en like '%".$name."%' )"; 
            }
            if($country!="")
            {
               $str_sql .= " AND (country LIKE '%".$country."%' OR country_en like '%".$country."%')"; 
            }
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_club WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_club WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateClub($id,$code,$name,$name_en,$city,$country,$country_en,$info, 
    $logo,$stadium,$stadium_capacity,$address,$website,$fan_page,$email,$established_date,$coach_id,$map,$avgage,$refe,$id_7m)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $sql_7m = "";$address =mysql_escape_string($address);
            if(id_7m>0)  $sql_7m = "  id_7m = '$id_7m',";
            $command= $connect->createCommand("UPDATE vtc_bongda.fb_club SET
                    CODE = '$code' , 
                    NAME = '$name' , 
                    name_en = '$name_en' , 
                    city = '$city' , 
                    country = '$country' , 
                    country_en = '$country_en' , 
                    info = '$info' , 
                    logo = '$logo' , 
                    stadium = '$stadium' , 
                    stadium_capacity = '$stadium_capacity' , 
                    address = '$address' , 
                    website = '$website' , 
                    fan_page = '$fan_page' , 
                    email = '$email' , 
                    established_date = '$established_date' , 
                    coach_id = '$coach_id' , 
                    map = '$map' , 
                    avgage = '$avgage' , 
                    refe = '$refe' ,".$sql_7m." update_date = NOW(),update_user = '$create_user' 
                    WHERE id = '$id' ; ");
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
        
                     
    }
?>
