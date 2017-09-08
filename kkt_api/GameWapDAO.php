<?php
   date_default_timezone_set('Asia/Saigon');

   function getConnectKKT()
   {
        $connectWapGame = @mysql_connect('127.0.0.1', 'uvtc_kkt2012', 'pvtc_@)!@kkt');
        if (!$connectWapGame) die('Could not connect: ' . mysql_error());    
        @mysql_select_db('vtc_kenhkiemtien', $connect);
        @mysql_query("SET NAMES 'utf8'"); 
        return $connectWapGame;
   } 
    
   // Get Game 
   function getGameIPA($page,$limit)
    {   
        $limit  = intval($limit)>100?100:intval($limit); 
        $startRecord = ($page - 1) * $limit;
        $connectWapGame  = getConnectKKT();
        $sql = "SELECT id,title,app_type,image,price,description_short,file_apk,file_ipa,file_plist,create_date FROM vtc_kenhkiemtien.c_game_wap Where status  = 1 And (file_ipa != NULL || file_ipa != '') Order by id desc LIMIT $startRecord, $limit;";
        
        $result = @mysql_query($sql,$connectWapGame);
        $arrayGame =array();     
        $i=0;
        while($arr = @mysql_fetch_assoc($result)){
            $arrayGame[$i]=$arr;  
            $image = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["image"]);
        
            $file_plist = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_plist"]);
            $file_ipa = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_ipa"]);
            
             if(!empty($arr["file_apk"])){
                $file_apk = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_apk"]);   
                 $arrayGame[$i]["file_apk"]=$file_apk;  
            }
            
            $arrayGame[$i]["image"]=$image;
            $arrayGame[$i]["file_plist"]=$file_plist;
            $arrayGame[$i]["file_ipa"]=$file_ipa;
            $i++;
        }
      
        @mysql_free_result($result);
        @mysql_close($connectWapGame);
        return $arrayGame;
    }
     
    // Get Game 
   function getGameAPK($page,$limit)
    {
        $limit  = intval($limit)>100?100:intval($limit); 
        $startRecord = ($page - 1) * $limit;
        $connectWapGame  = getConnectKKT();     
         
        $sql = "SELECT id,title,app_type,image,price,description_short,file_apk,file_ipa,file_plist,create_date FROM vtc_kenhkiemtien.c_game_wap Where status  = 1 And (file_apk != NULL || file_apk != '') Order by id desc LIMIT $startRecord, $limit;";
        $result = @mysql_query($sql,$connectWapGame);
        $arrayGame =array();     
        
        $i=0;
        while($arr = @mysql_fetch_array($result)){
            $arrayGame[$i]=$arr; 
            $image = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["image"]);
            $file_apk = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_apk"]);
            if(!empty($arr["file_plist"]))
            {
                $file_plist = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_plist"]);    
                $arrayGame[$i]["file_plist"]=$file_plist;
            }
            
            if(!empty($arr["file_ipa"])){
                $file_ipa = convertTimeToPath($arr["create_date"],"upload/wapgame",$arr["file_ipa"]);   
                $arrayGame[$i]["file_ipa"]=$file_ipa;  
            }

            $arrayGame[$i]["image"]=$image;
            $arrayGame[$i]["file_apk"]=$file_apk;
            $i++;
        }
       
        @mysql_free_result($result);
        @mysql_close($connectWapGame);  
        return $arrayGame;
    }
    
    // count total game
     function countGameIPA()
    {
        $sql = "SELECT  count(*) as sl FROM vtc_kenhkiemtien.c_game_wap Where status  = 1 And (file_ipa != NULL || file_ipa != '')";
        $connectWapGame  = getConnectKKT();
        
        $result = @mysql_query($sql,$connectWapGame);
        
        $total = @mysql_fetch_assoc($result);
       
      
        @mysql_free_result($result);
        @mysql_close($connectWapGame);
        
        return $total["sl"];
    }
    
    // count total game apk
     function countGameAPK()
    {
        $sql = "SELECT  count(*)as sl FROM vtc_kenhkiemtien.c_game_wap Where status  = 1 And (file_apk != NULL || file_apk != '')";
        $connectWapGame  = getConnectKKT();
        
        $result = @mysql_query($sql,$connectWapGame);
      
        $total = @mysql_fetch_assoc($result,0);
       
        @mysql_free_result($result);
        @mysql_close($connectWapGame);
        
        return $total["sl"];
    }
    
    
?>
