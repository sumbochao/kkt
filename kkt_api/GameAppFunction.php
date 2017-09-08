<?php
	require_once("config.php");   
    date_default_timezone_set('Asia/Saigon');  

    function getCategory($appId,$type)
    {
        $sql = "SELECT id,name,picture,create_date FROM c_category WHERE status = 1 AND type=".$type." AND ".$appId." & app_ids = ".$appId." ORDER BY id ASC"; 
        $result = @mysql_query($sql); 
        $arr = array();    
        while($row = @mysql_fetch_assoc($result)){
            $arr[] =  $row;
            if($row['picture']!="")
                $arr[]['picture'] = "http://kenhkiemtien.com/upload/category/".date("Y/md",$row['create_date'])."/".$row['picture'];
        }
        mysql_free_result($result);          
        return $arr;   
    }   
    function getGameAppIndex($appId,$orderBy,$limit)
    {   
        $sql ="SELECT  id,name FROM   c_category  WHERE STATUS = 1 AND $appId& app_ids = $appId Order by id " ;
        $result = @mysql_query($sql); 
        $arrs = array(); 
        $arr_cat = array();  
        while($row = @mysql_fetch_array($result)){  
            $arr_cat["id"] =    $row["id"];
            $arr_cat["name"] =    $row["name"];
            $arr_cat["gameapp"] = array(); 
            $cat_id = $row["id"];

            $sql_2 ="SELECT c.id,c.title,c.image,c.file_apk,c.price,c.description_short,c.create_date,c.status_link,c.link_store FROM
            c_game_app c LEFT JOIN c_category_game_app cat ON c.id = cat.game_app_id 
            WHERE cat.cat_id = $cat_id AND $appId& c.appIds = $appId ORDER BY $orderBy LIMIT 2 " ;            
            $result_2 = @mysql_query($sql_2);  
            while($row_gameapp = @mysql_fetch_assoc($result_2)){
                $row_gameapp['image'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row_gameapp['create_date'])."/".$row_gameapp['image'];    
                $row_gameapp['file_apk'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row_gameapp['create_date'])."/".$row_gameapp['file_apk'];    
                $arr_cat["gameapp"][] = $row_gameapp; 
            }          
            $arrs[] =    $arr_cat;
        }

        mysql_free_result($result);  
        mysql_free_result($result_2);          
        return $arrs;
    }  
    function getGameAppIndexDemo($partnerId,$appId,$orderBy,$limit)
    {   
        $sql ="SELECT  id,name FROM   c_category  WHERE STATUS = 1 AND $appId& app_ids = $appId Order by id " ;
        $result = @mysql_query($sql); 
        $arrs = array(); 
        $arr_cat = array();  
        while($row = @mysql_fetch_array($result)){  
            $arr_cat["id"] =    $row["id"];
            $arr_cat["name"] =    $row["name"];
            $arr_cat["gameapp"] = array(); 
            $cat_id = $row["id"];

            $sql_2 ="SELECT c.id,c.title,c.image,c.file_apk,c.price,c.description_short,c.create_date,c.status_link,c.link_store FROM
            c_game_app c LEFT JOIN c_category_game_app cat ON c.id = cat.game_app_id 
            WHERE cat.cat_id = $cat_id AND $partnerId & c.partnerId = $partnerId AND $appId& c.appIds = $appId ORDER BY $orderBy LIMIT  ".$limit ;            
            $result_2 = @mysql_query($sql_2);  
            while($row_gameapp = @mysql_fetch_assoc($result_2)){
                $row_gameapp['image'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row_gameapp['create_date'])."/".$row_gameapp['image'];    
                $row_gameapp['file_apk'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row_gameapp['create_date'])."/".$row_gameapp['file_apk'];    
                $arr_cat["gameapp"][] = $row_gameapp; 
            }          
            $arrs[] =    $arr_cat;
        }

        mysql_free_result($result);  
        mysql_free_result($result_2);          
        return $arrs;
    }
    function getGameAppIDs($catId)
    {
        $startRecord = ($page - 1) * $limit;
        $sql = "SELECT game_app_id FROM  c_category_game_app WHERE cat_id = ".$catId;
        $result = @mysql_query($sql);
        $arr_audio_id ="0";     

        while($arr = @mysql_fetch_array($result)){
            $arr_audio_id=$arr_audio_id.",".$arr["game_app_id"];  
            // echo   $arr["comic_id"];    
        }
        //echo      $arr_audio_id;
        mysql_free_result($result);
        return $arr_audio_id;
    } 
    function countGameApp($gameAppIDS,$appID){
        $condition="";
        if($comicIDS!=""){
            $condition.=" AND id IN(".$gameAppIDS.")";
        }
        $condition.=" AND ".$appID." & appIds = ".$appID;

        $sql = "SELECT count(id) as count FROM c_game_app WHERE 1 " . $condition ;
        //echo $sql;

        $result = @mysql_query($sql);
        $count =@mysql_fetch_array($result);

        mysql_free_result($result);
        return $count[0];
    }
    function getGameAppByCategory($appId ,$catId, $orderBy,$limit, $page)
    {
        $startRecord = ($page - 1) * $limit;
        $gameAppIDS =  getGameAppIDs($catId);
        $totalItem = countGameApp($gameAppIDS,$appId); 
        $max_page = ceil(intval($totalItem/$limit))+($totalItem%$limit==0?0:1);

        $condition="";
        if($gameAppIDS!=""){
            $condition.=" AND id IN(".$gameAppIDS.")";
        }
        $condition.=" AND ".$appId." & appIds = ".$appId;
        $sql = "SELECT id,title,image,price,file_apk,description_short,create_date,status_link,link_store FROM c_game_app
        WHERE 1 " . $condition . " Order by $orderBy LIMIT " . $startRecord . ", " . $limit;
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row['image'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row['create_date'])."/".$row['image'];    
            $row['file_apk'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row['create_date'])."/".$row['file_apk'];    
            $rows[] = $row;
        }

        mysql_free_result($result);
        return array($rows,$max_page);   
    }
    function getGameAppByCategoryDemo($partnerId,$appId ,$catId, $orderBy,$limit, $page)
    {
        
        $startRecord = ($page - 1) * $limit;
        $gameAppIDS =  getGameAppIDs($catId);
        $totalItem = countGameApp($gameAppIDS,$appId); 
        $max_page = ceil(intval($totalItem/$limit))+($totalItem%$limit==0?0:1);

        $condition="";
        if($gameAppIDS!=""){
            $condition.=" AND id IN(".$gameAppIDS.")";
        }
        $condition.=" AND ".$appId." & appIds = ".$appId;
        $condition.=" AND ".$partnerId." & partnerId = ".$partnerId;  
        $sql = "SELECT id,title,image,price,file_apk,description_short,create_date,status_link,link_store FROM c_game_app
        WHERE 1 " . $condition . " Order by $orderBy LIMIT " . $startRecord . ", " . $limit;
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row['image'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row['create_date'])."/".$row['image'];    
            $row['file_apk'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row['create_date'])."/".$row['file_apk'];    
            $rows[] = $row;
        }

        mysql_free_result($result);
        return array($rows,$max_page);   
    }
    function getGameAppOfline($appId, $orderBy)
    {
        $condition="";

        $condition.=" AND id IN(3,7,9,5,6,8)";

        $condition.=" AND ".$appId." & appIds = ".$appId;
        $sql = "SELECT id,title,image,file_apk,price,description_short,create_date,status_link,link_store FROM c_game_app
        WHERE 1 " . $condition . " Order by $orderBy";
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row['image'] = "http://kenhkiemtien.com/upload/gameapp/".date("Y/md",$row['create_date'])."/".$row['image'];    
            $row['file_apk'] = "http://kenhkiemtien.com/upload/gamekktdemo/".$row['file_apk'];    
            $rows[] = $row;
        }

        mysql_free_result($result);
        return $rows;
    }
    function setGameAppcHit($id,$countType)
    {   
        $sql ="Update c_game_app SET $countType = $countType + 1 Where id =  $id " ;
        $result = @mysql_query($sql);    
        return $result;
    }
    function downloadFile($path){
        if(file_exists($path) && is_readable($path) && file_exists($path)){
            header("Content-Disposition: attachment; filename=".basename(str_replace(' ', '_', $path)));
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Type: application/java-archive");
            header("Content-Type: application/vnd.android.package-archive");
            header("Content-Description: File Transfer");
            header("Content-Length: " . filesize($path));
            flush(); // this doesn't really matter.
            $fp = fopen($path, "r");
            while (!feof($fp))
            {
                echo fread($fp, 65536);
                flush(); // this is essential for large downloads
            }
            fclose($fp);
            exit;
        } 
    }    
?>
