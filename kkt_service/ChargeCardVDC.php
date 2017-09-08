<?php
    date_default_timezone_set("Asia/Saigon");
   
    
    require_once("config.php");     
    require_once("functions.php");     
    require_once('VDCO_SOAPClient.class.php');
 
    $Client = new VMS_Soap_Client('http://123.30.179.27:8081/webservice/VDCTelcoAPI?wsdl', 'tritueviet_tp', '81azM7U0', 262, 'tritueviet_tp.mpin');
    
    //$target ten member nap card cua doi tac
    $target = "nobita122234         ";
    //$email cua member cua doi tac
    $email = "abc@gmail.com";
    //phone 
    $phone = '0904799611';
    // serial:mathe:nhamang
    $dataCard = "53633717141:1566711007539::VTT";
   
    $rowCards = getCardLogToCharg();
    
    $arryEmail = array("thangttnd1@gmail.com","thangttnd2@gmail.com","thangttnd3@gmail.com","thangttnd4@gmail.com","thangttnd5@gmail.com","thangttnd6@gmail.com","thangttnd7@gmail.com","thangttnd8@gmail.com","thangttnd9@gmail.com"
    ,"thangttnd10@gmail.com");
     $arryMobile = array("0974838182","0974838183","0974838184","0974838185","0974838186","0974838187","0974838188","0974838189","0974838190","0974838191");
     $arrErrorChargAgain = array(11,-88,7,8,-99,0);
    //echo rand(0,9);
     
    $i = 0;
    while($i<count($rowCards)){
        $row  = $rowCards[$i];
        
       // var_dump($row);
        $requested_date =  time();
        
        $dataCard = $row["card_code"].":".$row["provider_code"].":".$row["card_seri"];
        $stt =rand(0,9);
        $result = $Client->doCardCharge($target, $dataCard, $arryEmail[$stt], $arryMobile[$stt]);
        
       // var_dump($result);
       
        $request = $dataCard;
        $charg_status = 2;
        
        $response = $result['message'];
        $response_status = intval($result['status']);
        $responsed_date  =  time();
        $transactionId = $result['transid'];
        $status = $response_status == 1?1:0;
       
        foreach($arrErrorChargAgain as $value){
            if(intval($response_status)==$value)
            $charg_status = 0;
        }
        
        $data["id"] = $row["id"];
        $data["requested_date"] = $requested_date;
        $data["request"] = $dataCard;
        $data["charg_status"] = $charg_status;
        $data["responsed_date"] =$responsed_date;
        $data["transactionId"] = $transactionId;
        $data["id"] = $row["id"];
        $data["status"] = $status;
        $data["response"] = $response;
        $data["response_status"] =intval($response_status) ;
        
        UpdateCardLog($data);
        $i++;
        
    }
?>
