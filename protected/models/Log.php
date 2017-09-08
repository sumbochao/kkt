<?php
class Log extends CActiveRecord
{
    public function getLogSms($list_response_id)
    {
        $sql = "SELECT responseId FROM c_sms_game_log WHERE responseId IN (" . $list_response_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $replace = array();
        foreach($rows as $row){
            $replace[] = $row["responseId"];    
        }
        
        $res_id = explode(", ", $list_response_id);
        $list_new_response_id = array();
        foreach($res_id as $value){
            if(!in_array($value, $replace)){
                $list_new_response_id[] = $value;    
            }
        }
        
        return $list_new_response_id;
    }
    
    public function getLogCard($list_response_id)
    {
        $sql = "SELECT responseId FROM c_card_game_log WHERE responseId IN (" . $list_response_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $replace = array();
        foreach($rows as $row){
            $replace[] = $row["responseId"];    
        }
        
        $res_id = explode(", ", $list_response_id);
        $list_new_response_id = array();
        foreach($res_id as $value){
            if(!in_array($value, $replace)){
                $list_new_response_id[] = $value;    
            }
        }
        
        return $list_new_response_id;
    }
    
    public function InsertLogSms($response, $response_id, $list_refCode)
    {
        /* Lấy id của user */
        $sql = "SELECT id, refCode FROM c_user WHERE refCode IN (" . $list_refCode . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $replace = array();
        foreach($rows as $row){
            $replace[$row["refCode"]] = $row["id"];
        }
        
                
        foreach($response as $res_id=>$data){            
            if(isset($replace[$data["refCode"]]) && in_array($res_id, $response_id))
            {
                $data["userId"] = $replace[$data["refCode"]];
                unset($data["refCode"]);
                $sql = "INSERT INTO c_sms_game_log SET
                    providerId=:providerId
                    , userId=:userId
                    , responseId=:responseId
                    , content=:content                        
                    , output=:output
                    , sender=:sender
                    , serviceCode=:serviceCode
                    , status=:status
                    , transactionId=:transactionId
                    , day=:day
                    , month=:month
                    , year=:year
                    , create_date=:create_date
                ";
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValues($data);
                $result = $command->execute();
            }
        }
//        return $result;
    }
    
    public function InsertLogCard($response, $response_id, $list_refCode)
    {
        /* Lấy id của user */
        $sql = "SELECT id, refCode FROM c_user WHERE refCode IN (" . $list_refCode . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $replace = array();
        foreach($rows as $row){
            $replace[$row["refCode"]] = $row["id"];
        }
        
                
        foreach($response as $res_id=>$data){            
            if(isset($replace[$data["refCode"]]) && in_array($res_id, $response_id))
            {
                $data["userId"] = $replace[$data["refCode"]];
                unset($data["refCode"]);

                $sql = "INSERT INTO c_card_game_log SET
                    responseId=:responseId
                    , userId=:userId
                    , gameId=:gameId
                    , providerId=:providerId
                    , transactionId=:transactionId
                    , sessionId=:sessionId
                    , game_user=:game_user
                    , provider_code=:provider_code
                    , card_code=:card_code
                    , card_seri=:card_seri
                    , price=:price
                    , request=:request
                    , status=:status
                    , requested_date=:requested_date
                    , response=:response
                    , response_status=:response_status
                    , responsed_date=:responsed_date
                    , month=:month
                    , day=:day
                    , year=:year
                    , create_date=:create_date
                ";
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValues($data);
                $result = $command->execute();
            }
        }
//        return $result;
    }
}  
?>
