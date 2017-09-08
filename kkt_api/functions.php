<?php
    date_default_timezone_set('Asia/Saigon'); 
    function ApplicationRegister($data)
    {
        $sql = "INSERT INTO c_application_register SET 
        `userId`='" . strtoupper($data["userId"]) . "'
        , `refCode`='" . $data["refCode"] . "'
        , `manufacturer`='" . strtoupper($data["brand"]) . "'
        , `handset`='" . strtoupper($data["model"]) . "'
        , `midp`='" . $data["midp"] . "'
        , `width`='" . $data["w"] . "'
        , `height`='" . $data["h"] . "'
        , `create_date`=" . $data["create_date"] . "
        ";
        $result = mysql_query($sql);
        $appRegisterId = mysql_insert_id();
        return $appRegisterId;
    }

    function GetGameHotApp()
    {
        $sql = "SELECT id, title, alias FROM c_game WHERE isHotApp=1 ORDER BY date_of_hot_app DESC LIMIT 1";        
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;
    }

    function getAdvApp()
    {
        $sql = "SELECT id, title, picture, link,create_date FROM c_adv WHERE status=1 ORDER BY create_date DESC LIMIT 1";        
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;    
    }  

    function GetAllAlbum($categoryId, $currentPage, $numberRecordPerPage)
    {
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT id, title, introtext, download, picture, create_date FROM c_album WHERE 1 " . $condition . " ORDER BY time_download DESC,download DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        $result = @mysql_query($sql);
        $rows = array();

        $list_album_id = "0";
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
            $list_album_id .= "," . $row["id"];
        }                

        $sql = "SELECT count(id), albumId FROM c_image WHERE albumId IN (" . $list_album_id . ") GROUP BY albumId";
        $result = @mysql_query($sql);
        $replaceImage = array();                
        while($row = @mysql_fetch_assoc($result)){
            $replaceImage[$row["albumId"]] = $row["count(id)"];            
        }        

        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["total_image"] = isset($replaceImage[$rows[$i]["id"]]) ? $replaceImage[$rows[$i]["id"]] : 0;
            $i++;
        }
        return $rows;   
    }

    function GetTotalAlbum($categoryId)
    {
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT count(id) FROM c_album WHERE 1 " . $condition;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows["count(id)"];
    }

    function GetAllGame($categoryId, $currentPage, $numberRecordPerPage)
    {
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT id, title, introtext, download, picture, create_date FROM c_game WHERE 1 " . $condition . " ORDER BY time_download DESC,download DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;   
    }
    function getGameById($gameId){
        $sql = "SELECT id,title,introtext,create_date FROM c_game WHERE id = ".intval($gameId);
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);
        return $rows;
    }
    function getFileGameByGameId($gameId){
        $sql = "SELECT id,filename,extension,create_date FROM c_game_file WHERE gameId = ".intval($gameId);
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;   
    }

    function GetTotalGame($categoryId)
    {
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT count(id) FROM c_game WHERE 1 " . $condition;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows["count(id)"];
    }

    function GetAllVideo($categoryId, $currentPage, $numberRecordPerPage)
    {
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT id, title, introtext, download, picture, create_date FROM c_video WHERE 1 " . $condition . " ORDER BY time_download DESC,download DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;   
    }
    
     function GetAllVideoSync($maxID)
    {
       
        $sql = "SELECT * FROM c_video Where id > $maxID ";
        $result = @mysql_query($sql);
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;   
    }
    

    function GetTotalVideo($categoryId)
    {
        $condition = "";
        $condition .= !empty($categoryId) ? " AND categoryId=" . $categoryId : "";
        $sql = "SELECT count(id) FROM c_video WHERE 1 " . $condition;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows["count(id)"];
    }

    function checkVersion($type, $version)
    {
        $sql = "SELECT isNew FROM c_version WHERE `version` != '" . $version . "' AND `type`='" . $type . "'";        
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;    
    }

    function getUser($refCode)
    {
        $sql = "SELECT id,username FROM c_user WHERE refCode='" . mysql_escape_string($refCode) . "'";  
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;   
    }

    function cleanQuery($string)
    {        
        if(empty($string)) return $string;
        $string = mysql_escape_string(trim($string));

        $badWords = array(
        "/Select(.*)From/i"
        , "/Union(.*)Select/i"
        , "/Update(.*)Set/i"
        , "/Delete(.*)From/i"
        , "/Drop(.*)Table/i"
        , "/Insert(.*)Into/i"                
        , "/http/i"
        , "/--/i"
        );

        $string = preg_replace($badWords, "", $string);

        return $string;
    }

    function getImage($nameImage, $folder, $date='', $type='')
    {        
        if($type!='')
            $nameImage=$type.'_'.$nameImage;
        if($date!='')
            return baseUrl() . "upload/" . $folder . "/" . date("Y", $date) . "/" . date("md", $date) . "/" . $nameImage;
        else
            return baseUrl() . "upload/" . $folder . "/" . $nameImage;
    }

    function getApp($user,$app_name)
    {
        return baseUrl().'user/'.$user.'/'.$app_name;
    }

    function genRefCode($id){
        return md5(md5($id) . "CunKIEmTieN$#$@$%");
    }

    function service_code(){
        return "8777";
    }
?>