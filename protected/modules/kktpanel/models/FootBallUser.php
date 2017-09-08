<?php
  class FootBallUser extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getUserByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_user WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$name,$email,$page,$row_per_page)
        {
            $str_sql = "";
            $keyword  = mysql_escape_string($keyword);
            $str_order  = " Order By id DESC ";
            
            if($from_date != "")
            {
                $str_sql .=" AND create_date>='".$from_date."'";
            }
            
            if($to_date != "")
            {
                $str_sql .=" AND create_date<='". $to_date." 23:59:59'";  
            }
            if($name!="")
            {
               $str_sql .= " AND fullname LIKE '%".$name."%' "; 
            }
            if($email!="")
            {
               $str_sql .= " AND email LIKE '%".$email."%' "; 
            }
            
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_user WHERE 1 ".$str_sql."";
            
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM fb_user WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
             
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
            public function quickUpdateUser($id,$status)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE fb_user SET status=$status WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        
    }
?>
