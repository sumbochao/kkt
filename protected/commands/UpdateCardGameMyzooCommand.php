<?php
class UpdateCardGameMyzooCommand extends CConsoleCommand
{
    public function run($args)
    {
        $jsonurl = "http://192.168.1.125:7985/getCardServlet?username=59&game_name=4&token=4c78dbf6d439ef0f042e74ba2037d1f3";
        $json = file_get_contents($jsonurl, 0, null, null);
        $json = json_decode($json);        

        $list_response_id = "";
        $list_refCode = "";
        $response = array();
        if(!empty($json)){
            foreach($json as $object){
                
                $response[$object->id]["responseId"] = $object->id;
                $response[$object->id]["gameId"] = $object->game_id;
                $response[$object->id]["providerId"] = $object->provider_id;
                $response[$object->id]["transactionId"] = $object->trans_id;
                $response[$object->id]["sessionId"] = isset($object->session_id) ? $object->session_id : null;
                $response[$object->id]["game_user"] = $object->username;
                $response[$object->id]["request"] = $object->request;
                $response[$object->id]["requested_date"] = strtotime($object->requested_at);
                $response[$object->id]["responsed_date"] = strtotime($object->responsed_at);
                $response[$object->id]["status"] = $object->status;
                $response[$object->id]["response"] = isset($object->response) ? $object->response : null;
                $response[$object->id]["response_status"] = $object->response_status;
                $response[$object->id]["provider_code"] = $object->provider_code;
                $response[$object->id]["card_code"] = $object->card_code;
                $response[$object->id]["card_seri"] = $object->card_seri;
                $response[$object->id]["price"] = $object->price;
                $response[$object->id]["refCode"] = $object->refecode;
                
           
                $date = $object->created_at;            
                $response[$object->id]["create_date"] = strtotime($date);
                $date = explode(" ", $date);
                $date = $date[0];
                $date = explode("-", $date);
                $response[$object->id]["year"] = $date[0];
                $response[$object->id]["month"] = $date[1];
                $response[$object->id]["day"] = $date[2];           
                
                $list_response_id .= ", " . $object->id;        
                $list_refCode .= ",'" . $response[$object->id]["refCode"] . "'";        
                
            }
            
            $list_response_id = ltrim($list_response_id, ", ");        
            $list_refCode = ltrim($list_refCode, ",");
            $list_refCode = Common::remove_duplicate($list_refCode);

            /* Lấy các sms chưa insert */
            $response_id = Log::getLogCard($list_response_id);
            if(!empty($response_id)){
                $result = Log::InsertLogCard($response, $response_id, $list_refCode);       
            }   
        }
        
        echo "Update Date Card Game Myzoo Cron Job At ".date("H:i:s - d/m/Y")." \n";
    }
}
?>