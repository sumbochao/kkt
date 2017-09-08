<?php

$data = array(
  "authorizedKey" => "abbad35c5c01-xxxx-xxx",
  "senderEmail" => "myemail@yahoo.com",
  "recipientEmail" => "jaketalledo86@yahoo.com",
  "comment" => "Invitation",
  "forceDebitCard" => "false"
);

$serviceURL = "https://testapipds.ghn.vn:9999/external/marketplace/";
    $clientID = 43423;
    $password = 'ucygbXAkWtJqR5Lp6';
    $apiKey = 'wcsNLLjyLyKX6EsB';
    $apiSecretKey = '9869C9338C530081E31BB9135355A2BF';
    
    
$aData = array("ApiKey" => $apiKey, "ApiSecretKey" => $apiSecretKey,"ClientID" => $clientID, "Password" => $password);
    
$url_send ="https://testapipds.ghn.vn:9999/external/marketplace/SignIn";
$str_data = json_encode($aData);
echo $str_data;
function sendPostData($url, $post){
  $ch = curl_init($url);
  

$headers= array('Accept: application/json','Content-Type: application/json'); 
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $result = curl_exec($ch);
  curl_close($ch);  // Seems like good practice
  return $result;
}

echo " " . sendPostData($url_send, $str_data);

?>