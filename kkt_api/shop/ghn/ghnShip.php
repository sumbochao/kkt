<?php
  require_once("RestApiClient.php");
  header('Content-Type: text/html; charset=utf-8'); 
    
    $serviceURL = "https://testapipds.ghn.vn:9999/external/marketplace/";
    $clientID = 43423;
    $password = 'ucygbXAkWtJqR5Lp6';
    $apiKey = 'wcsNLLjyLyKX6EsB';
    $apiSecretKey = '9869C9338C530081E31BB9135355A2BF';
    
    $serviceClient = new RestApiClient($serviceURL,$clientID,$password,$apiKey,$apiSecretKey);
    
    //SignIn And Get SessionToken
    $sessionToken = $serviceClient->SignIn();

    if (empty($result['ErrorMessage']))
    {
        //Get District Province Data
        $districtProvinceDataRequest = array("SessionToken" => $sessionToken);
        $responseDistrictProvinceData = $serviceClient->GetDistrictProvinceData($districtProvinceDataRequest);
        if (!empty($responseDistrictProvinceData['ErrorMessage'])) 
        {
            print_r($responseDistrictProvinceData);
        }
        
        //Caculate Service Fee
        $c = array("FromDistrictCode"=>'0201',
            "ServiceID"=>1,
            "ToDistrictCode"=>'0211',
            "Weight"=>123,
            "Length" => 100,
            "Width" => 100,
            "Height" => 100);     
        $d = array();
        $items[] = $c;
        $calculateServiceFeeRequest = array("SessionToken" => $sessionToken, "Items" => $items);
        $responseCalculateServiceFee = $serviceClient->CalculateServiceFee($calculateServiceFeeRequest);
        if (!empty($responseCalculateServiceFee['ErrorMessage'])) 
        {
            print_r($responseCalculateServiceFee);
        }
        
        //Create SO
        $shippingOrderRequest = array(
            "SessionToken" => $sessionToken,
            "MerchantCode" => "Nguyễn Văn A",
            "MerchantHubCode" => "2 Lê Duẩn, Quận 1",
            "SenderName" => "0907382922",
            "SenderPhone" => "LZD-WH-2014-18-10-00",
            "PickAddress" => "Nguyễn Văn A",
            "PickDistrictCode" => "0201",
            "GHNOrderCode" => "",
            "ClientOrderCode" => "LZD-WH-2014-18-10-02",
            "SealCode" => "LZD-WH-2014-16-10-00",
            "RecipientName" => "Nguyễn Văn A",
            "RecipientPhone" => "0907382922",
            "DeliveryAddress" => "2 Lê Duẩn, Quận 1",
            "DeliveryDistrictCode" => '0201',
            "CODAmount" => 450000,
            "ContentNote" => "Áo thun note",
            "ServiceID" => 1,
            "Weight" => 123,
            "Length" => 100,
            "Width" => 100,
            "Height" => 100);
        
        $responseCreateShippingOrder = $serviceClient->CreateShippingOrder($shippingOrderRequest);
        if (!empty($responseCreateShippingOrder['ErrorMessage'])) 
        {
            print_r($responseCreateShippingOrder['ErrorMessage']); 
        }
        else
        {
            print_r(' Order Code: ' . $responseCreateShippingOrder['OrderCode'] . ' - Total Fee: ' . $responseCreateShippingOrder['TotalFee'] . ' VNĐ'); 
        }
        
        //Cancel Order
        $cancelOrderRequest = array("SessionToken" => $sessionToken, "OrderCode" => "7179899404");
        $responseCancelShippingOrder = $serviceClient->CancelOrder($cancelOrderRequest);
       
        if (!empty($responseCancelShippingOrder)) 
        {
            print_r($responseCancelShippingOrder); 
        }else
        {
            print_r('Cancel order successful'); 
        }
        
    }
    else
    {
        print_r('Client and Password are incorrect'); 
    }
?>
