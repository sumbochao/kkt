<?php
   date_default_timezone_set('Asia/Saigon');
   function getConnect()
   {
        $connectWapGame = @mysql_connect('127.0.0.1', 'uvtc_kkt2012', 'pvtc_@)!@kkt');
        if (!$connectWapGame) die('Could not connect: ' . mysql_error());    
        @mysql_select_db('vtc_kenhkiemtien', $connect);
        @mysql_query("SET NAMES 'utf8'"); 
        return $connectWapGame;
   } 
   
   function getConnect10h()
   {
        $connect = @mysql_connect('127.0.0.1', 'uxoso10h', 'pxoso10h!@#456');
        if (!$connect) die('Could not connect: ' . mysql_error());    
        @mysql_select_db('vtc_10h_xs', $connect);
        @mysql_query("SET NAMES 'utf8'");  
        return $connect;
   } 
   
   // Get AppHeader And Create Client App Id
   
   function getAppHeaderXoSo($app_header,$app_client_id,$os_version,$ip_address,$imei){
       $connectWapGame=getConnect();
       $app_header = mysql_escape_string($app_header);
       $app_client_id = mysql_escape_string($app_client_id);
       $os_version = mysql_escape_string($os_version);
       $ip_address = mysql_escape_string($ip_address);
       $imei = mysql_escape_string(trim($imei));
       
       $arrKq = array();
       //get app header config 
       $sql = "SELECT id,app_header,type_payment,os,isFree,sms_confirm,sms_mcv,VERSION,link_update,sms,admob_id FROM vtc_kenhkiemtien.c_app_header   WHERE app_header = '$app_header'" ;
       //echo $sql;
       $result = @mysql_query($sql,$connectWapGame);
       $arrAppHeader = @mysql_fetch_assoc($result)   ;
       
       if(empty($arrAppHeader)) return "";
       
       $arrKq["app_header"] = $arrAppHeader;  
       $app_header_id =  $arrAppHeader["id"];
       $os =    $arrAppHeader["os"];     
       
       if(empty($app_client_id)||intval($app_client_id)==0){
           if(checkImeiExist($imei)==0||empty($imei)){
               // Tao client id moi và Tao xo so user 
               $app_client_id ="0";
               $app_client_id = createAppClientId($app_header_id,$arrAppHeader["os"],$os_version,$imei,$connectWapGame);
               insertUser10h($app_client_id);
               if(intval($os)==2) insertNoticeAndroidUser($app_client_id,"","",$ip_address);
           }else{
               $app_client_id = getAppClientIdByImei($imei);
           }
       }else{
           if(!checkAppClientIdExist($app_client_id)){
                // Tao client id moi và Tao xo so user 
               $app_client_id ="0";
               $app_client_id = createAppClientId($app_header_id,$arrAppHeader["os"],$os_version,$imei,$connectWapGame);
               insertUser10h($app_client_id);
               if(intval($os)==2) insertNoticeAndroidUser($app_client_id,"","",$ip_address);
           }
       }
       
       $arrKq["app_client_id"] = $app_client_id;
       // check app client id exist
        $arrUserXoso   = getUserXoSoHeader($app_client_id);
        $arrKq["user"] = $arrUserXoso;   
        
        $sql = "SELECT id,app_header_id,title,description,picture,link,create_date  FROM vtc_kenhkiemtien.c_box_adv  WHERE STATUS = 1 AND app_header_id =  $app_header_id Order by id DESC limit 1";
        $result = @mysql_query($sql,$connectWapGame);
        $arrADV = @mysql_fetch_assoc($result)   ;
        if(!empty($arrADV)){
           $arrADV["picture"]    =convertTimeToPath($arrADV["create_date"],"upload/banner",$arrADV["picture"]);    
           $arrKq["adv"] = $arrADV;   
        }
        
        insertAppTracking($app_header_id,$app_client_id,$connectWapGame);
        
        @mysql_free_result($result);
        @mysql_close($connectWapGame);
        
        return    $arrKq;
   }
   
   
   function getAppHeaderSMSKute($app_header){
       $connectWapGame=getConnect();
       $app_header = mysql_escape_string($app_header);
       //get app header config 
       $sql = "SELECT type_payment,os,isFree,sms_confirm,sms_mcv,VERSION,link_update,sms,admob_id FROM vtc_kenhkiemtien.c_app_header   WHERE app_header = '$app_header'" ;
       //echo $sql;
       $result = @mysql_query($sql,$connectWapGame);
       $arrAppHeader = @mysql_fetch_assoc($result)   ;
       
       if(empty($arrAppHeader)) return "";
        
        @mysql_free_result($result);
        @mysql_close($connectWapGame);
        
        return    $arrAppHeader;
   }
   
   
   function createAppClientId($app_header_id,$os,$os_version,$imei,$connection){
       $sql = "INSERT INTO vtc_kenhkiemtien.c_app_client (os,os_version,app_header_id,imei) VALUES ($os,'$os_version',$app_header_id,'$imei');";
       $result = @mysql_query($sql,$connection);   
       $id =  @mysql_insert_id();
       return $id;
   }
   
   function insertAppTracking($app_header_id,$app_client_id,$connection){
       $create_date = time();
       $sql = "INSERT INTO vtc_kenhkiemtien.c_app_tracking  (app_header_id,app_client_id,create_date) VALUES ($app_header_id,$app_client_id,$create_date)";
       $result = @mysql_query($sql,$connection);   
       $id =  @mysql_insert_id();
       return $id;
   }
   
   function insertUser10h($app_client_id){
       $create_date  = date('Y-m-d H:i:s');
       $username = base64_encode($app_client_id."xs10u");
       $connection = getConnect10h()  ;
       $avatar_url = "http://kenhkiemtien.com/upload/avatarxs/avatarxs.png";
       $sql = "INSERT INTO vtc_10h_xs.user_veso (app_client_id,username,PASSWORD,fullname,avatar_url,email,tk_phu,tk_chinh,STATUS,create_user,create_date,modify_user,modify_date)
    VALUES ($app_client_id,'$username','','','$avatar_url','',0,0,1,'appxs','$create_date','appxs', '$create_date')";
   
      // writeLogSQLHeader($create_date.$sql);
       
       $result = @mysql_query($sql,$connection);   
       $id =  @mysql_insert_id();
       return $id;
   }
   
   function getUserXoSoHeader($app_client_id)
    {
        $connection = getConnect10h()  ;    
        $sql = "SELECT app_client_id,username,fullname,avatar_url,email,mobile,address,tk_chinh FROM vtc_10h_xs.user_veso  WHERE app_client_id= '$app_client_id'
";     
        $result = @mysql_query($sql,$connection);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
      
        @mysql_free_result($result);
        @mysql_close($connection);
        return $arrayKQ;
    } 
    
    function checkImeiExist($imei)
    {
        $imei= cleanQuery($imei);
        
        $sql = "SELECT * FROM vtc_kenhkiemtien.c_app_client  WHERE imei= '$imei'";
       
        $result = @mysql_query($sql);

        $kq=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        
        if(!empty($arrayKQ)) $kq=  1;
        
        @mysql_free_result($result);
        return $kq;
    } 
    
    function checkAppClientIdExist($app_client_id)
    {
        $app_client_id= cleanQuery($app_client_id);
        
        $sql = "SELECT * FROM vtc_kenhkiemtien.c_app_client  WHERE id= '$app_client_id'";
        
        $result = @mysql_query($sql);

        $kq=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        
        if(!empty($arrayKQ)) $kq=  1;
        
        @mysql_free_result($result);
        return $kq;
    } 
    
    function getAppClientIdByImei($imei)
    {
        $imei= cleanQuery($imei);
        $sql = "SELECT id From vtc_kenhkiemtien.c_app_client  WHERE imei = '$imei' limit 1";  
        
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
        
        $app_client_id = 0;
        if(!empty($arrayKQ)) $app_client_id = $arrayKQ["id"];
        
        @mysql_free_result($result);
        return $app_client_id;
    } 
    
    function writeLogSQLHeader($mo){
    $date = date('Y-m-d H:i:s');
    $file = dirname(__FILE__).'/logXoSoSQLH.txt';
    
    // Open the file to get existing content
    //$current = file_get_contents($file);
    // Append a new person to the file
    $current =$date."  :  ". $mo."\n";
    
    // Write the contents back to the file
    file_put_contents($file, $current,FILE_APPEND | LOCK_EX);
 }
?>
