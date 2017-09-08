<html>
    <head>
        <?php            
            $client = new SoapClient("http://localhost/hdc/wapsite/service/WebServices.php?wsdl");
           
            $data = array();
            $data["content"] = "GKT 1 1 5355ca283d0878d60da03ba4680ed277";
            $data["sender"] = "84907779469";            
            $data["serviceCode"] = "8712"; 
            $data["transactionId"] = time();                       
            
            var_dump($client->__call("getContent", $data));            
        ?>
    </head>
</html>