<?php

class Mail {

    private $wsUsername = 'local';     //username dc cung cap de truy cap webservice
    private $wsPassword = 'local';     //password
    private $wsProviderId = 'local';    //Doi tac(khach hang,user local,...
    private $wsServiceId = 'email';     //Dich vu goi webservice: webservice cho thao tac voi email
    private $wsActionId = 'email proccess';   //Hanh dong goi webservice: tao,lay thong tin email,...
    private $wsContent = 'anything';

    
    public function sendMail($wsData){       
        $client = new soapclient('http://az24.vn/wsHDC/wsQueueMail.php?wsdl');

        try 
        {    
            $rs = $client->__call('createMail', $wsData);      
        }
        catch (SoapFault $fault) 
        {
            print("alert('Sorry, blah returned the following ERROR: ".$fault->faultcode."-".$fault->faultstring);
        }      
    }
    public function setWsData ( $actionId, $content, $data=array()) {
        //$requestTime = date("Y-m-d H:i:s");       //Thoi gian goi webservice
        //$requestId = "HDC" . str_replace('.', '', microtime(true));  //request id
                
        return $data;
        
    }

    public function setEmailData($from, $to, $cc='', $bcc='', $subject='', $content='', $file_name='', $file_type='', $file_data='') {
        return array(
            'from_adrress' => 'no-reply@taoviec.com', //nguoi gui
            'to_adrress' => $to, //nguoi nhan
            'cc' => $cc, //cc
            'bcc' => $bcc, //bcc
            'subject' => utf8_encode($subject), //tieu de
            'content' => utf8_encode($content), //noi dung
            'file_name' => $file_name, //ten file dinh kem
            'file_type' => $file_type, //kieu file dinh kem
            'file_data' => $file_data, //du lieu file dinh kem
            //'status' => $status,
            //'create_date' => $create_date,
        );
    }

    public function objectToArray($object) {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map('objectToArray', $object);
    }
 

}
