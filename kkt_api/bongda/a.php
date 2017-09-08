
<html>
    <head>
        <?php            

//            $client = new SoapClient("http://localhost/hdc/taoviecv6/service/PaymentServices.php?wsdl");
            $client = new SoapClient("http://115.146.123.108/CPK_Content/Sms.asmx?wsdl", array("debug"=>true));
            
            $curtime = time();
            //$data = array();            
//            $data["content"] = "TVA CHANNEL 14 1 imeidayroi 32";
//            $data["sender"] = "84979411411";                              
//            $data["serviceCode"] = "8012"; 
//            $data["transactionId"] = $curtime . "84979411411";
            
            $data = array();            
            $data["sms_no"] = "7039";
            $data["phone_no"] = "84974838181";                              
            $data["sms_Content"] = "BD"; 
            $data["sms_date"] = date("Y/m/d H:i:s");            
            var_dump($client->__call("CPK_Content", array($data)));            
        ?>
    </head>
</html>
