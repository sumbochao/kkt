<?php
  class FootBallMatch extends MyActiveRecord
    {
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
      
        
        public function getMatchByID($id)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT * FROM fb_match WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        
        public function getAllData($from_date,$to_date,$cup_id,$name,$code,$status,$order_by,$page,$row_per_page)
        {
            $str_sql = "";
            $keyword  = mysql_escape_string($keyword);
            $str_order  = " Order By m.id  ";   
                 
            if($from_date != "")
            {
                $str_sql .=" AND m.match_time>='".$from_date."'";
            }
            
            if($to_date != "")
            {
                $str_sql .=" AND m.match_time<='". $to_date." 23:59:59'";
            }
            if($name!="")
            {
               $str_sql .= " AND (m.club_name_1 LIKE '%".$name."%' OR m.club_name_2 LIKE '%".$name."%')  "; 
            }
            if($code!="")
            {
               $str_sql .= " AND (m.club_code_1 LIKE '%".$code."%' OR m.club_code_2 LIKE '%".$code."%')  ";       
            }
            
             if($cup_id != "")
            {
                $str_sql .=" AND m.cup_id=". $cup_id;
            }
            
             if($status != "")
            {
                $str_sql .=" AND m.status='". $status."'";
            }
            
            $str_order = " order by ".$order_by; 
            $connect = Yii::app()->db_bongda;
            $sql = "SELECT COUNT(id) as count FROM  fb_match m WHERE 1 ".$str_sql."";
              
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT m.*,c.name as cup_name FROM fb_match m Left Join fb_cup c On m.cup_id = c.id WHERE 1".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
               
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function updateMatch($id,$round,$match_time,$match_minute,$season,$result,$result_1,$status,$stadium,$referee,$linkSpotcat)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE  fb_match SET round = '$round'".  
            ", match_time = '$match_time' ".
            ", match_minute = '$match_minute' ".
            ", season = '$season' ".
            ", result = '$result' ".
            ", result_1 = '$result_1' ".
            ", status = '$status' ".    
            ", stadium = '$stadium' ".    
            ", referee = '$referee' ".    
            ", sopcast_link = '$linkSpotcat' ".    
            " Where id=$id "   ;
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
        
        
        public function updateMatchVideo($id,$hadVideo)
        {
            $connect = Yii::app()->db_bongda;
            $sql = "UPDATE  fb_match SET had_video = '$hadVideo'".
            " Where id=$id "   ;
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
        
         public function updateMatchLogoClub1($club_id_1,$logo)
        {
            $connect = Yii::app()->db_bongda;
            $club_id_1  = intval($club_id_1);
            $logo  = mysql_escape_string($logo);

            $sql = "UPDATE  fb_match SET club_logo_1 = '$logo'".
            " Where club_id_1=$club_id_1 "   ;
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
        
        public function updateMatchLogoClub2($club_id_2,$logo)
        {
            $connect = Yii::app()->db_bongda;
            $club_id_2  = intval($club_id_2);
            $logo  = mysql_escape_string($logo);

            $sql = "UPDATE  fb_match SET club_logo_2 = '$logo'".
            " Where club_id_2=$club_id_2 "   ;
            $command= $connect->createCommand($sql);
           
            $data = $command->execute();
            return $data;
        }
        
      
        
      
       
    }
?>
