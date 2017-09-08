<?php
    error_reporting(E_ALL); 
    require_once('config.php');     
    require_once('functions.php');
    require_once('logger.php');     
   // require_once('libs/nusoap.php');
   echo 1;

    function process8x41($content, $sender, $serviceCode){
        $logging = new Logging();
        $mess = "registerMobile: " .$content . " | ".$sender." | ".$serviceCode;
        $logging->lwrite($mess);
        
        $time_now = time();
        $data["mobile"] = checkMobile($sender); 
		$content = strtoupper($content) ;
         echo 2;
        $so_ngay = 2;
        if($serviceCode=='8741')$so_ngay = 7;
        if($serviceCode=='8641')$so_ngay = 5;
        
        $data["status"] = 1;
        $data["end_date"] = $time_now + 86400*$so_ngay;
        $data["create_date"] = $time_now;
        $data["create_user"] = $data["mobile"];
        $rows = getUserByMobile($data["mobile"]);
        
        if(!$rows){
                    $result = insertUser($data);
                    if($result >0){
                        $response["status"] = 1;
                        $response["msg"] = "Ban vua dang ki tai khoan (".displayMobile($data["mobile"]).") tren clipvl.net. Ban duoc xem va tai clip trong ".$so_ngay." ngay tai ".genLinkClip($data["mobile"]);
                    }else{
                        $response["status"] = 3;
                        $response["msg"] = "He thong qua tai! Vui long thu lai";
                    }
          }else{
                    // Neu da dang ky truoc do roi -> Gia han
					$result = updateUser($data);
                    if($result >0){
                        $response["status"] = 1;
                        $response["msg"] = "Ban vua gia han tai khoan ".displayMobile($data["mobile"])." tren clipvl.net. Ban duoc xem va tai clip them ".$so_ngay." ngay tai ".genLinkClip($data["mobile"]);
                    }else{
                        $response["status"] = 3;
                        $response["msg"] = "He thong qua tai! Vui long thu lai";
                    }
          }
            
        
        $logging->lwrite(json_encode($response));
        var_dump($response);
        return json_encode($response);
    }  
    
    
		$content ="abc 1212 ";
	$content =	preg_replace("/(\s+)/si", " ", $content);
			if(preg_match("/ABC [a-zA-Z0-9_]{1,}$/si", 	 trim($content)))
        	 {
        	 	 echo $content;
        	 	 	process8x41("ABC 7976", "0974838181", "ABC");
        	}

	    echo substr('8765',1,1);

?>
