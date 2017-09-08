<?php
  class FootBallCup extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertCup($code,$name,$name_en,$country,$country_en,$continent,$refe,$logo,$rate)
        {
            $sql_result = 0;
            try {
                $connect = Yii::app()->db_bongda;
                $create_user = Yii::app()->user->name;
                
                $command= $connect->createCommand("INSERT INTO fb_cup (CODE,NAME,name_en,country,country_en,continent,refe,logo,rate,create_date,create_user) 
                VALUES ('$code','$name','$name_en','$country','$country_en','$continent','$refe','$logo','$rate',NOW(),'$create_user')");
                
                $sql_result = $command->execute();
            }
            catch(Exception $e) {
              echo 'Message: ' .$e->getMessage();
            }
           
            return $sql_result;
        }
        
        public function getCupByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_cup WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$name,$code,$country,$page,$row_per_page)
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
               $str_sql .= " AND name LIKE '%".$name."%' "; 
            }
            if($code!="")
            {
               $str_sql .= " AND code LIKE '%".$code."%' "; 
            }
            if($country!="")
            {
               $str_sql .= " AND (country LIKE '%".$country."%' OR country_en LIKE '%".$country."%' )"; 
            }
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_cup WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_cup WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateCup($id,$name,$name_en,$country,$country_en,$continent,$refe,$logo,$rate)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            $sql = "UPDATE  fb_cup SET name = '$name'".  
            ", name_en = '$name_en' ".
            ", country = '$country' ".   
            ", country_en = '$country_en' ".   
            ", continent = '$continent' ".
            ", refe = '$refe' ".
            ", logo = '$logo' ".
            ", rate = '$rate' ".
            ", update_date = NOW() ".
            ", update_user = '$create_user' ".
            " Where id=$id "   ;
          
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
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
        
    }
?>
