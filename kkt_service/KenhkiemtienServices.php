<?php
    error_reporting(E_ALL); 
    require_once("config.php");     
    require_once("functions.php");     
    require_once('libs/nusoap.php');

    $server = new soap_server();

    $ns = "urn:KenhkiemtienServices";
    $server->configureWSDL("KenhkiemtienServices", $ns);
    $server->wsdl->schemaTargetNamespace = $ns;    

    $server->wsdl->addComplexType(
    'response'
    , 'complexType'
    , 'struct'
    , 'all'
    , ''
    , array(
    'status'=>array(
    'name'=>'status'
    , 'type'=>'xsd:int'
    ), 
    'msg'=>array(
    'name'=>'msg'
    , 'type'=>'xsd:string'
    ), 
    'length'=>array(
    'name'=>'length'
    , 'type'=>'xsd:int'
    )
    )
    );           

    $server->register(
    "getContent"
    , array("content"=>"xsd:string", "sender"=>"xsd:string", "serviceCode"=>"xsd:string", "transactionId"=>"xsd:string")
    , array("return"=> "tns:response")
    //        , array("return"=> "xsd:string")
    , $ns
    , $ns . "#getContent"
    , "rpc"            
    , "encoded"
    , "Examination Results"  
    );    

    function getContent($content, $sender, $serviceCode, $transactionId)
    {   
        $data = array();
        $data["content"] = preg_replace("/(\s+)/si", " ", $content);
        $data["content_original"] = $data["content"];
        $data["content"] = trim(strtoupper($data["content"]));
        $data["sender"] = $sender;
        $data["serviceCode"] = $serviceCode;
        $data["transactionId"] = $transactionId;

      /*  if(in_array($serviceCode, listServiceCode())){
            $response["status"] = 3;
            $response["msg"] = "Tin nhan sai cu phap";    
            $response["title"] = "";

            $data["userId"] = 0;    
            $data["partnerId"] = 0;    
            $data["type"] = 0;    
            $data["id"] = 0;    
            $data["output"] = "Tin nhan khong dung dau so quy dinh";    
            $data["telco"] = checkTelco($data["sender"]);    
            $data["price"] = priceServiceCode($data["serviceCode"]);    
            $data["status"] = 0;    
            $result = InsertSmsLog($data);    
        } else {   */
            if(preg_match("/ABC [a-zA-Z0-9_]{1,}$/si", $data["content"]))
             {
                  $data["type"] = 2;
                  $response = process8x41($data["content"], $data["sender"],$data["serviceCode"]);
            }else if(preg_match("/KBK 1(\s+)(\d+)(\s+)(\d+)(\s+)[a-zA-Z0-9_]{1,}$/si", $data["content"]))
            {
                $data["type"] = 1;
                $response = gameApp($data);
            } 
            else if(preg_match("/KBK 2(\s+)(\d+)(\s+)(\d+)(\s+)[a-zA-Z0-9_]{1,}$/si", $data["content"]))
                {
                    $data["type"] = 2;                
                    $response = videoApp($data);
                } 
            else if(preg_match("/KBK 3(\s+)(\d+)(\s+)(\d+)(\s+)[a-zA-Z0-9_]{1,}$/si", $data["content"]))
                    {
                        $data["type"] = 3;
                        $response = imageApp($data);
                    } 
            else 
                    {
                  $data["type"] = 2;
                  $response = process8x41($data["content"], $data["sender"],$data["serviceCode"]);
                       /* $response["status"] = 2;
                        $response["msg"] = "Tin nhan sai cu phap";
                        $response["title"] = "";

                        $data["userId"] = 0;    
                        $data["partnerId"] = 0;    
                        $data["type"] = 0;    
                        $data["id"] = 0;    
                        $data["output"] = "Tin nhan sai cu phap";    
                        $data["telco"] = checkTelco($data["sender"]);    
                        $data["price"] = priceServiceCode($data["serviceCode"]);    
                        $data["status"] = 0;    
                        $result = InsertSmsLog($data);     */
             }      
        //}                                    

        $response["length"] = strlen($response["msg"]);
        $response["title"] = $response["title"]; 
        return $response;
    }

    /* xử lý khi tin nhắn được build từ app để lấy game */
    function gameApp($data)
    {
        $cp = buildSyntaxApp($data["content"]);
        $data["cp"] = $cp["cp"];
        $data["id"] = $cp["id"];        
        $data["appType"] = $cp["appType"];        
        $data["refCode"] = $cp["refCode"];        

        /* Lấy userId */
        $user = getUser($data["refCode"]);
        if(empty($user)){
            $data["status"] = 0;
            $data["userId"] = 0;
            $data["output"] = "refCode không đúng";
            $data["title"] = "";
            $data["partnerId"] = 0;    
        } else {
            $data["userId"] = $user["id"];

            /* Lấy file game để trả về */
            $gameInfo = getGameInfo($data["id"]);

            if(empty($gameInfo)){
                /* Không tìm thấy game */            
                $data["status"] = 0;
                $data["output"] = "Không tìm thấy game được yêu cầu";
                $data["title"] = "";
                $data["partnerId"] = 0;
            } else {
                /* Insert vào bảng c_data_download */
                $dataDownloadId = InsertDataDownload($data);
                $data["status"] = 1; 
                if(intval($data["appType"])==3){
                    $data["output"] = trim($gameInfo["title"]).': '.trim(linkDownloadGame($data["id"], $dataDownloadId));
                }else{
                    $data["output"] = trim($gameInfo["title"]).':'.trim(linkDownloadGame($data["id"], $dataDownloadId));
                }
                $data["title"] = $gameInfo["title_sms"];
                $data["partnerId"] = $gameInfo["partnerId"];
            }
        }

        $data["price"] = priceServiceCode($data["serviceCode"]);
        $data["telco"] = checkTelco($data["sender"]);

        /* Insert vào bảng c_sms_log_hdc */
        $result = InsertSmsLog($data);     
        $result1 = UpdateTimeDownload($data["id"],1);
        $response = array(); //mảng trả về
        $response["status"] = $data["status"];
        $response["msg"] = removeSign($data["output"]);
        $response["title"] = removeSign($data["title"]);

        $title_len = strlen($response["msg"]);
        if(strlen($response["title"]) > titleLen() - $title_len){
            $response["title"] = substr($response["title"], 0, titleLen() - $title_len);
        }
        return $response;    
    }

    /* xử lý khi tin nhắn được build từ app để lấy video */
    function videoApp($data)
    {
        $cp = buildSyntaxApp($data["content"]);    
        $data["cp"] = $cp["cp"];
        $data["id"] = $cp["id"];        
        $data["appType"] = $cp["appType"];        
        $data["refCode"] = $cp["refCode"];        

        /* Lấy userId */
        $user = getUser($data["refCode"]);
        if(empty($user)){
            $data["status"] = 0;
            $data["userId"] = 0;
            $data["output"] = "refCode không đúng";
            $data["title"] = "";
            $data["partnerId"] = 0;    
        } else {
            $data["userId"] = $user["id"];        
            $data["partnerId"] = 1;
            /* Lấy file video để trả về */
            $videoInfo = getVideoInfo($data["id"]);

            if(empty($videoInfo)){
                /* Không tìm thấy video */            
                $data["status"] = 0;
                $data["output"] = "Không tìm thấy video được yêu cầu";
                $data["title"] = "";
            } else {
                /* Insert vào bảng c_data_download */
                $dataDownloadId = InsertDataDownload($data);

                $data["status"] = 1; 
                if(intval($data["appType"])==3){
                    $data["output"] = trim($videoInfo["title"]).': '.trim(linkDownloadVideo($data["id"], $dataDownloadId)); 
                }else{
                    $data["output"] = trim($videoInfo["title"]).':'.trim(linkDownloadVideo($data["id"], $dataDownloadId));   
                }
                $data["title"] = $videoInfo["title_sms"];
            }
        }
        $data["price"] = priceServiceCode($data["serviceCode"]);
        $data["telco"] = checkTelco($data["sender"]);
        /* Insert vào bảng c_sms_log_hdc */
        $result = InsertSmsLog($data);
        $result1 = UpdateTimeDownload($data["id"],2);
        $response = array(); //mảng trả về
        $response["status"] = $data["status"];
        $response["msg"] = removeSign($data["output"]);
        $response["title"] = removeSign($data["title"]);

        $title_len = strlen($response["msg"]);
        if(strlen($response["title"]) > titleLen() - $title_len){
            $response["title"] = substr($response["title"], 0, titleLen() - $title_len);
        }        
        return $response;
    }

    /* xử lý khi tin nhắn được build từ app để lấy image */
    function imageApp($data)
    {
        $cp = buildSyntaxApp($data["content"]);
        $data["cp"] = $cp["cp"];
        $data["id"] = $cp["id"];        
        $data["appType"] = $cp["appType"];        
        $data["refCode"] = $cp["refCode"];        

        /* Lấy userId */
        $user = getUser($data["refCode"]);
        if(empty($user)){
            $data["status"] = 0;
            $data["userId"] = 0;
            $data["output"] = "refCode không đúng";
            $data["title"] = "";
            $data["partnerId"] = 0;    
        } else {
            $data["userId"] = $user["id"];        
            $data["partnerId"] = 1;
            /* Lấy file game để trả về */
            $albumInfo = getAlbumInfo($data["id"]);

            if(empty($albumInfo)){
                /* Không tìm thấy game */            
                $data["status"] = 0;
                $data["output"] = "Không tìm thấy Album được yêu cầu";
                $data["title"] = "";
            } else {
                /* Lấy tổng ảnh trong album */
                $totalImage = getTotalImageInAlbum($data["id"]);
                if($totalImage==0){
                    $data["status"] = 0;
                    $data["output"] = "Album này hiện chưa có ảnh nào";    
                    $data["title"] = "";    
                } else {
                    /* Insert vào bảng c_data_download */
                    $dataDownloadId = InsertDataDownload($data);
                    /* Insert vào bảng c_data_download_image */
                    $result = InsertDataDownloadImage($data);
                    $data["status"] = 1;  
                    if(intval($data["appType"])==3){
                        $data["output"] = trim($albumInfo["title"]).': '.trim(linkDownloadImage($data["id"], $dataDownloadId)); 
                    }else{
                        $data["output"] = trim($albumInfo["title"]).':'.trim(linkDownloadImage($data["id"], $dataDownloadId));   
                    }  
                    $data["title"] = $albumInfo["title_sms"]; 
                }
            }
        }
        $data["price"] = priceServiceCode($data["serviceCode"]);
        $data["telco"] = checkTelco($data["sender"]);
        /* Insert vào bảng c_sms_log */
        $result = InsertSmsLog($data);
        $result1 = UpdateTimeDownload($data["id"],3);
        $response["status"] = $data["status"];
        $response["msg"] = removeSign($data["output"]);
        $response["title"] = removeSign($data["title"]);

        $title_len = strlen($response["msg"]);
        if(strlen($response["title"]) > titleLen() - $title_len){
            $response["title"] = substr($response["title"], 0, titleLen() - $title_len);
        }
        return $response;   
    }    

    function buildSyntax($content)
    {
        $content = explode(" ", $content);
        $cp = array();
        $cp["cp"] = $content[0].' '.$content[1];
        $cp["id"] = $content[2];
        return $cp;          
    }

    function buildSyntaxApp($content)
    {
        $content = explode(" ", $content);
        $cp = array();
        $cp["cp"] = $content[0].' '.$content[1];
        $cp["id"] = $content[2];
        $cp["appType"] = $content[3];
        $cp["refCode"] = $content[4];
        return $cp;          
    }       
    
  
    
    function process8x41($content, $sender, $serviceCode){
       // $logging = new Logging();
        $mess = "registerMobile: " .$content . " | ".$sender." | ".$serviceCode;
       // $logging->lwrite($mess);
        
        $time_now = time();
        $data["mobile"] = checkMobile($sender); 
        $content = strtoupper($content) ;
    
        $so_ngay = 2;
        $dauso = substr($serviceCode,1,1);   
        if($dauso=='7')$so_ngay = 7;
        if($dauso=='6')$so_ngay = 5;
        
        $data["status"] = 1;
        $data["end_date"] = $time_now + 86400*$so_ngay;
        $data["create_date"] = $time_now;
        $data["create_user"] = $data["mobile"];
        $rows = getUserByMobile($data["mobile"]);
        
        $response = array(); //mảng trả về   
        $response["title"] =" ";   
        
        if(!$rows){
                    $result = insertUser($data);
                    if($result >0){
                        $response["status"] = 1;
                       // $response["msg"] = "Tai khoan cua ban tren clipvl.net (".displayMobile($data["mobile"]).") . Xem va tai clip trong ".$so_ngay." ngay tai ".genLinkClip($data["mobile"]);
                        $response["msg"] = "Ban co ".$so_ngay." ngay su dung cho tai khoan (".displayMobile($data["mobile"]).") tren clipvl.net. Xem va tai clip ngay tai ".genLinkClip($data["mobile"]);
                       
                    }else{
                        $response["status"] = 3;
                        $response["msg"] = "He thong qua tai! Vui long thu lai";
                    }
          }else{
                    // Neu da dang ky truoc do roi -> Gia han
                    $result = updateUser($data);
                    if($result >0){
                        $response["status"] = 1;
                        $response["msg"] = "Ban duoc cong them ".$so_ngay." ngay su dung cho tai khoan (".displayMobile($data["mobile"]).") tren clipvl.net. Xem va tai clip ngay tai ".genLinkClip($data["mobile"]);
                    }else{
                        $response["status"] = 3;
                        $response["msg"] = "He thong qua tai! Vui long thu lai";
                    }
          }
            
        
        //$logging->lwrite(json_encode($response));
       // var_dump($response);
        return $response;
    }  
    
     

    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : ""; 
    $server->service($HTTP_RAW_POST_DATA);
    exit();
?>
