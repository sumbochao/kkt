<?php
class UpdateSmsGameCommand extends CConsoleCommand
{
    public function run($args)
    {
        $jsonurl = "http://192.168.1.125:7985/getSmsMessageServlet?username=59&token=5378a4f223a26cc232a693391d68cb64";
        $json = file_get_contents($jsonurl, 0, null, null);
        $json = json_decode($json);
        
        $list_response_id = "";
        $list_refCode = "";
        $response = array();
        if(!empty($json)){
             foreach($json as $object){
                $response[$object->id]["responseId"] = $object->id;
                $response[$object->id]["content"] = $object->content;            
                
                $date = $object->date;  
                $response[$object->id]["create_date"] = strtotime($date);
                $date = explode("/", $date);
                $response[$object->id]["year"] = $date[0];
                $response[$object->id]["month"] = $date[1];
                $response[$object->id]["day"] = $date[2];
                
                $response[$object->id]["output"] = $object->output;
                $response[$object->id]["sender"] = $object->sender;
                $response[$object->id]["serviceCode"] = $object->serviceCode;
                $response[$object->id]["status"] = $object->status;
                $response[$object->id]["transactionId"] = $object->transactionId;
                $response[$object->id]["providerId"] = $object->provider_id;
                $response[$object->id]["refCode"] = $object->refecode;
                
                $list_response_id .= ", " . $object->id;        
                $list_refCode .= ",'" . $response[$object->id]["refCode"] . "'";        
         
            }
            
            $list_response_id = ltrim($list_response_id, ", ");        
            $list_refCode = ltrim($list_refCode, ",");
            $list_refCode = Common::remove_duplicate($list_refCode);

            /* Lấy các sms chưa insert */
            $response_id = Log::getLogSms($list_response_id);
            if(!empty($response_id)){
                $result = Log::InsertLogSms($response, $response_id, $list_refCode);       
            }
        }
                    
        echo "Update Date Sms Game Cron Job At ".date("H:i:s - d/m/Y")." \n";
    }
}
?>