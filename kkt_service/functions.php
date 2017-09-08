<?php    
    function getVideoInfo($id)
    {
        $sql = "SELECT id, title,title_sms FROM c_video WHERE id=" . $id;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;
    }
    
    function getGameInfo($id)
    {
        $sql = "SELECT id,title,title_sms,partnerId FROM c_game WHERE id=" . $id;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;    
    }
    
    function getAlbumInfo($id)
    {
        $sql = "SELECT id,title,title_sms FROM c_album WHERE id=" . $id;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;    
    }
    
    function getTotalImageInAlbum($id)
    {
        $sql = "SELECT count(id) FROM c_image WHERE albumId=" . $id;
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows["count(id)"];    
    }
    
    function InsertDataDownloadHDC($data)
    {
        $sql = "INSERT INTO c_data_download SET 
            `dataId`=" . mysql_escape_string($data["id"]) . "
            , `type`=" . mysql_escape_string($data["type"]) . "                        
            , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "                        
        ";        
        $result = @mysql_query($sql);
        $dataDownloadId = mysql_insert_id();
        return $dataDownloadId;   
    }
    
    function InsertDataDownload($data)
    {
        $data["appRegisterId"] = 0;
        $sql = "INSERT INTO c_data_download SET 
            `dataId`=" . mysql_escape_string($data["id"]) . "
            , `type`=" . mysql_escape_string($data["type"]) . "                        
            , `appRegisterId`=" . mysql_escape_string($data["appRegisterId"]) . "                        
            , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "                        
        ";        
        $result = @mysql_query($sql);
        $dataDownloadId = mysql_insert_id();
        return $dataDownloadId;   
    }
    
    function InsertSmsLogHDC($data)
    {
        $sql = "INSERT INTO c_sms_log_hdc SET 
            `content`='" . mysql_escape_string($data["content"]) . "' 
            , `type`=" . mysql_escape_string($data["type"]) . "           
            , `output`='" . mysql_escape_string($data["output"]) . "'
            , `sender`=" . mysql_escape_string($data["sender"]) . "
            , `serviceCode`=" . mysql_escape_string($data["serviceCode"]) . " 
            , `status`=" . mysql_escape_string($data["status"]) . "
            , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "
            , `day`=" . date("d") . "
            , `month`=" . date("m") . "
            , `year`=" . date("Y") . "
            , `create_date`=" . time() . "
        ";        
        $result = @mysql_query($sql);
        return $result;    
    }
    
    function InsertSmsLog($data)
    {
        $sql = "INSERT INTO c_sms_log SET 
            `userId`='" . mysql_escape_string($data["userId"]) . "'
            , `partnerId`=" . mysql_escape_string($data["partnerId"]) . "
            , `type`=" . mysql_escape_string($data["type"]) . "
            , `dataId`=" . mysql_escape_string($data["id"]) . "
            , `content`='" . mysql_escape_string($data["content_original"]) . "'
            , `output`='" . mysql_escape_string($data["output"]) . "'
            , `sender`='" . mysql_escape_string($data["sender"]) . "'
            , `telco`='" . mysql_escape_string($data["telco"]) . "'
            , `serviceCode`=" . mysql_escape_string($data["serviceCode"]) . "
            , `price`=" . mysql_escape_string($data["price"]) . "
            , `status`=" . mysql_escape_string($data["status"]) . "
            , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "
            , `day`=" . date("d") . "
            , `month`=" . date("m") . "
            , `year`=" . date("Y") . "
            , `create_date`=" . time() . "
        ";        
        
        $result = @mysql_query($sql);
        return $result;    
    }
    function UpdateTimeDownload($id,$type){
        switch($type){
            case 1:
                $table = "c_game";
                break; 
            case 2:
                $table = "c_video";
                break;
            case 3:
                $table = "c_album";
                break;
            default:
                $table = "";
                break;
        }
        if($table !=""){
            $sql = "UPDATE ".$table." SET time_download = ".time()." WHERE id =".intval($id);
            $result = @mysql_query($sql);
            return $result;
        }else{
            return 0;
        }
    }
    
    function InsertDataDownloadImageHDC($data)
    {
        $sql = "SELECT id FROM c_image WHERE albumId=" . $data["id"];
        $result = @mysql_query($sql);            
        while($row = @mysql_fetch_assoc($result)){
            $sql = "INSERT INTO c_data_download_image SET 
                `imageId`=" . mysql_escape_string($row["id"]) . "            
                , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "                        
            ";        
            @mysql_query($sql);
        }
        
        return $result;
    }
    
    function InsertDataDownloadImage($data)
    {
        $sql = "SELECT id FROM c_image WHERE albumId=" . $data["id"];
        $result = @mysql_query($sql);            
        while($row = @mysql_fetch_assoc($result)){
            $sql = "INSERT INTO c_data_download_image SET 
                `imageId`=" . mysql_escape_string($row["id"]) . "            
                , `appRegisterId`=" . mysql_escape_string($data["appRegisterId"]) . "                        
                , `transactionId`=" . mysql_escape_string($data["transactionId"]) . "                        
            ";        
            @mysql_query($sql);
        }
        
        return $result;
    }
    
     function UpdateCardLog($data)
    {
        $sql = "UPDATE  c_card_log SET 
            `request`='" . mysql_escape_string($data["request"]) . "'
            , `charg_status`=" . mysql_escape_string($data["charg_status"]) . "
            , `status`=" . mysql_escape_string($data["status"]) . "
            , `requested_date`=" . mysql_escape_string($data["requested_date"]) . "
            , `response`='" . mysql_escape_string($data["response"]) . "'
            , `response_status`='" . mysql_escape_string($data["response_status"]) . "'
            , `responsed_date`='" . mysql_escape_string($data["responsed_date"]) . "'
            , `transactionId`='" . mysql_escape_string($data["transactionId"]) . "'".
             " Where id = '".$data["id"]."'";        
        
      //  echo $sql;
        $result = @mysql_query($sql);
        return $result;    
    }
    
    function getUser($refCode)
    {
        $sql = "SELECT id FROM c_user WHERE refCode='" . mysql_escape_string($refCode) . "'";
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;   
    }
    function getUserByUsername($username)
    {
        $sql = "SELECT id, active FROM c_user WHERE `username`='" . mysql_escape_string($username) . "'";
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;   
    }
    
     function getCardLogToCharg()
    {
        $sql = "SELECT * FROM c_card_log WHERE charg_status=0 LIMIT 10" ;
        $result = @mysql_query($sql);    
        $rows = array();
        
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        } 
        
      //  var_dump($rows) ;die;
        return $rows;    
    }
    
    
    function listServiceCode()
    {
        return array("8077","8177","8577", "8677", "8777");
    }
    
    function listTypeApp(){
        return array(1=>"j2me",2=>"android",3=>"ios");
    }
    
    function removeSign($str) {
        $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

        $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
        $str = str_replace ($coDau, $khongDau, $str);
        $str = trim($str);
        return $str;
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
        
    function linkDownloadGame($gameId, $dataDownloadId)
    {
        return baseUrl() . "tai-ngay-game-" . encodeHex($gameId) . "-" . encodeHex($dataDownloadId);
    }
    
    function linkDownloadVideo($videoId, $dataDownloadId)
    {
        return trim(baseUrl(). "tai-ngay-video-" . encodeHex($videoId) . "-" . encodeHex($dataDownloadId));
    }    
    
    function linkDownloadImage($albumId, $dataDownloadId)
    {
        return baseUrl() . "tai-ngay-bo-anh-hot-" . encodeHex($albumId) . "-" . encodeHex($dataDownloadId);    
    }
    
    function genRefCode($id){
        return md5(md5($id) . "CunKIEmTieN$#$@$%");
    }
    
    function encodeHex($id)
    {    
        $str = dechex($id + 27111986);        
        $subStr = substr(dechex($id + 26101984), -5); //last three characters        
        $str = $str . $subStr;
        
        return $str;
    }
    
    function titleLen()
    {
        return 160;
    } 
    function checkTelco($mobile)
    {        
        $first = substr($mobile, 0, 1);
        if($first=="0"){
            $mobile = substr($mobile, 1, strlen($mobile) - 1);
        } else if($first="8"){
            $mobile = substr($mobile, 2, strlen($mobile) - 2);
        }
        
        $mobile = "84" . $mobile;
        
        $patternViettel = "/^84(9[678]|16[2-9])[\d]{7}/";
        $patternMobi = "/^84(9[03]|12[01268])[\d]{7}/";
        $patternVina = "/^84(9[14]|12[34579])[\d]{7}/";
        $patternVnmobile = "/^84(9[2]|18[86])[\d]{7}/";
        $patternBeeline = "/^84(9[9]|19[9])[\d]{7}/";
        
        if(preg_match($patternViettel, $mobile)){
            $telco = "1";    
        } else if(preg_match($patternMobi, $mobile)){
            $telco = "2";
        } else if(preg_match($patternVina, $mobile)){
            $telco = "3";
        } else if(preg_match($patternVnmobile, $mobile)){
            $telco = "4";
        } else if(preg_match($patternBeeline, $mobile)){
            $telco = "5";
        } else {
            $telco = "0";
        }
        
        return $telco;    
    }     
    function priceServiceCode($serviceCode)
    {
        $pattern_0 = "/^(\d)0(\d)(\d)$/si";
        $pattern_1 = "/^(\d)1(\d)(\d)$/si";
        $pattern_2 = "/^(\d)2(\d)(\d)$/si";
        $pattern_3 = "/^(\d)3(\d)(\d)$/si";
        $pattern_4 = "/^(\d)4(\d)(\d)$/si";
        $pattern_5 = "/^(\d)5(\d)(\d)$/si";
        $pattern_6 = "/^(\d)6(\d)(\d)$/si";        
        $pattern_7 = "/^(\d)7(\d)(\d)$/si";        
        
        $price = 0;
        if(preg_match($pattern_0, $serviceCode)){
            $price = 500;    
        } else if(preg_match($pattern_1, $serviceCode)){
            $price = 1000;    
        } else if(preg_match($pattern_2, $serviceCode)){
            $price = 2000;    
        } else if(preg_match($pattern_3, $serviceCode)){
            $price = 3000;    
        } else if(preg_match($pattern_4, $serviceCode)){
            $price = 4000;    
        } else if(preg_match($pattern_5, $serviceCode)){
            $price = 5000;    
        } else if(preg_match($pattern_6, $serviceCode)){
            $price = 10000;    
        } else if(preg_match($pattern_7, $serviceCode)){
            $price = 15000;    
        } 
        return $price;
    }
    
    
    function getUserByMobile($mobile){
        $sql = "SELECT * FROM user_clip WHERE mobile = '".$mobile."' ";
        $result = @mysql_query($sql);    
        $rows = @mysql_fetch_assoc($result);        
        return $rows;
    }
    
      function insertUser($data){
        $mobile = mysql_escape_string($data["mobile"]);
        $status = intval($data["status"]);
        $end_date = intval($data["end_date"]);
        $create_date = mysql_escape_string($data["create_date"]);
        $create_user = mysql_escape_string($data["mobile"]);
        $sql = "INSERT INTO user_clip(mobile,status,end_date,create_date,create_user) 
        VALUES ('".$mobile."',".$status.",".$end_date.",".$create_date.",'".$create_user."')";
        $result = @mysql_query($sql);
        return $result;
    }
    
    function updateUser($data){
        $mobile = mysql_escape_string($data["mobile"]);
        $end_date = intval($data["end_date"]);
        $sql = "UPDATE user_clip SET end_date = ".$end_date." WHERE mobile = '".$mobile."'";
        $result = @mysql_query($sql);
        return $result;
    }
    
      function checkMobile($mobile)
    {        
        $first = substr($mobile, 0, 1);
        if($first=="0"){
            $mobile = substr($mobile, 1, strlen($mobile) - 1);
        } else if($first="8"){
                $mobile = substr($mobile, 2, strlen($mobile) - 2);
            }

            $mobile = "84" . $mobile;

        return $mobile;    
    }
    
     function displayMobile($mobile){
        $first = substr($mobile, 0, 2);
        if($first=="84"){
            $mobile = substr($mobile, 2, strlen($mobile) - 2);
            $mobile = "0" . $mobile;
        } 
        return $mobile;
    }
    
    function genLinkClip($mobile){
        $link = "http://clipvl.net/login?m=".$mobile;
        return $link;
    }
?>
