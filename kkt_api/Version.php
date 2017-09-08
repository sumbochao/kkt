<?php
    require_once("config.php");
    require_once("functions.php");
    
    $output = array();
    $status = array();
    if(!empty($_GET["type"]) && !empty($_GET["v"]) && !empty($_GET["refCode"])){
        $type = intval($_GET["type"]);
        $version = cleanQuery($_GET["v"]);
        $refCode = cleanQuery($_GET["refCode"]);
         
        if($type <=0){
            
            $status["message"] = "";
            $status["code"] = 0;
            $status["url_download"] = ""; 
               
        } else {
            
            $checkVersion = checkVersion($type, $version);     
            if($checkVersion["isNew"]==1 || empty($checkVersion)){
                /* Không tồn tại phiên bản mới */
                $status["message"] = "";
                $status["code"] = 0;
                $status["url_download"]= "";
            } else {       
                $status["message"] = "Hiện tại có phiên bản mới bạn có muốn tải ?";
                $status["code"] = 1;
                $status["url_download"] = 'http://'.$_SERVER["HTTP_HOST"].'/kktDownload/updateVersionApp?type='.$type.'&refCode='.$refCode;
            }

        } 
        
    } else {
        
        $status["message"] = "";
        $status["code"] = 0;
        $status["url_download"]= "";
    
    }
    
    echo json_encode($status);
?>
