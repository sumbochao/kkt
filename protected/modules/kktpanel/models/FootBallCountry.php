<?php
  class FootBallCountry extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function insertCountry($name,$name_en,$flag)
        {
            $connect = Yii::app()->db_bongda;
            $create_user = Yii::app()->user->name;
            
            $command= $connect->createCommand("INSERT INTO fb_country (NAME,name_en,flag,create_date) 
            VALUES ('$name','$name_en','$flag',NOW())");
            
            $sql_result = $command->execute();
           
            return $sql_result;
        }
        
        public function getCountryById($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_country WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$name,$page,$row_per_page)
        {
            $str_sql = "";
            $name  = mysql_escape_string($name);
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
               $str_sql .= " AND (name LIKE '%".$name."%' OR name_en like '%".$name."%')"; 
            }
            
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_country WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_country WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateCountry($id,$name,$name_en,$flag)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE  fb_country SET name = '$name'".  
            ", name_en = '$name_en' ".
            ", flag = '$flag' ".   
            " Where id=$id "   ;
          
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
        
        
        public function deleteCountry($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "DELETE FROM  fb_country  Where id=$id "   ;
          
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
      
       
        
    }
?>
