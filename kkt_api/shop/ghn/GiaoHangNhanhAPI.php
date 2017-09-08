<?php
  require_once("RestApiClient.php");
  require_once("../ShopDAO.php");
  require_once("../../function/utils.php");
  header('Content-Type: text/html; charset=utf-8'); 
  // Config
  $serviceURL = "https://apipds.ghn.vn/External/MarketPlace/";
  $clientID = 46977;
  $password = '3wTrkE4bk23KeXJEG';
  $apiKey = 'Eb1CEnhk2Uy2jPfH';
  $apiSecretKey = '8C64E9869FCEA476AF6FFF5CE1655737';
      
  $serviceClient = new RestApiClient($serviceURL,$clientID,$password,$apiKey,$apiSecretKey);
  $sessionToken = $serviceClient->SignIn();
 
   if (empty($result['ErrorMessage']))
   {
        $action = isset ( $_GET ['action'] ) ? $_GET ['action'] : "";    
        switch($action){
            case "GetDistrictProvinceData":{
                 $districtProvinceDataRequest = array("SessionToken" => $sessionToken);
                 $responseDistrictProvinceData = $serviceClient->GetDistrictProvinceData($districtProvinceDataRequest);
                 if (empty($error)) 
                 {
                    //echo json_encode($responseDistrictProvinceData);
                    $data = $responseDistrictProvinceData["Data"];
                    $provices = array();
                    $i = 0;
                    foreach($data as $item){
                        $provices[$item["ProvinceCode"]] = $item["ProvinceName"];
                        $stritem = "$"."districts"."[".$i."]=array(\"DistrictCode\"=>\"".$item["DistrictCode"]."\",";
                        $stritem .= "\"DistrictName\"=>\"".$item["DistrictName"]."\",";
                        $stritem .= "\"ProvinceCode\"=>\"".$item["ProvinceCode"]."\",";
                        $stritem .= "\"ProvinceName\"=>\"".$item["ProvinceName"]."\",";
                        $stritem .= "\"SupportType\"=>\"".$item["SupportType"]."\",";
                        $stritem .= "\"Type\"=>\"".$item["Type"]."\").<br/>";
                        $i++;
                        echo $stritem;
                    }
                   // Get Provinces
                   /* foreach($provices as $key => $value){
                        echo "'".$key."'"."=>"."'".$value."',"."<br/>";
                    }*/
                 }else{
                     print_r($responseDistrictProvinceData['ErrorMessage']);
                 }
                 break;
            }
             case "GetServiceList":{
                 $fromDistrictCode = $_GET["fromDistrictCode"];
                 $toDistrictCode = $_GET["toDistrictCode"];   
                // $fromDistrictCode  = "0201";
                // $toDistrictCode = "0202";
                 if(empty($fromDistrictCode)||empty($toDistrictCode)) {
                     echo json_decode(array());  
                     return; 
                 }
                 
                 $districtProvinceDataRequest = array("SessionToken" => $sessionToken,"FromDistrictCode"=>$fromDistrictCode
                 ,"ToDistrictCode"=>$toDistrictCode);
                 $responseDistrictProvinceData = $serviceClient->GetServiceList($districtProvinceDataRequest);
                 $error = $responseDistrictProvinceData['ErrorMessage'];
                 $services = $responseDistrictProvinceData["Services"];
                 echo json_encode($services);
                 break;
            }
             case "CalculateServiceFee":{
                 $fromDistrictCode = $_POST["fromDistrictCode"];
                 $toDistrictCode = $_POST["toDistrictCode"];
                 $serviceID = $_POST["serviceID"];
                 $weight = empty($_POST["weight"])?10:$_POST["weight"];
                 $length = empty($_POST["length"])?10:$_POST["length"]; 
                 $width = empty($_POST["width"])?10:$_POST["width"];  
                 $height =empty($_POST["height"])?10:$_POST["height"]; 
                 
                 if(empty($weight)==0) $weight = 10;
                 if(empty($length)==0) $length = 10;
                 if(empty($width)==0) $width = 10;
                 if(empty($height)==0) $height = 10;
                 
                 $c = array("FromDistrictCode"=>$fromDistrictCode,
                    "ServiceID"=>$serviceID,
                    "ToDistrictCode"=>$toDistrictCode,
                    "Weight"=>$weight,
                    "Length" => $length,
                    "Width" => $width,
                    "Height" => $height);     

                $items[] = $c;
                $calculateServiceFeeRequest = array("SessionToken" => $sessionToken, "Items" => $items);
                $responseCalculateServiceFee = $serviceClient->CalculateServiceFee($calculateServiceFeeRequest);
                $error = $responseCalculateServiceFee['ErrorMessage'];
                $items = $responseCalculateServiceFee["Items"];
                echo json_encode($items); 
                 break;
             }
             case "CalculateServiceFees":{
                 $fromDistrictCode = $_POST["fromDistrictCode"];
                 $toDistrictCode = $_POST["toDistrictCode"];
                 $serviceID = $_POST["serviceID"];
                 $productIDs = $_POST["product_ids"];
                 
                 if(empty($fromDistrictCode)||empty($toDistrictCode)||empty($serviceID)||
                 empty($productIDs)) {echo 1;exit();};

                 /*$fromDistrictCode ="0201";
                 $toDistrictCode ="0202";
                 $serviceID ="53325";
                 $productIDs ="1,2,";*/

                 $items = array();
                 $arrProduct = getProductByIDs($productIDs);
                 
                 foreach($arrProduct as $pro){
                     $c = array("FromDistrictCode"=>$fromDistrictCode,
                    "ServiceID"=>$serviceID,
                    "ToDistrictCode"=>$toDistrictCode,
                    "Weight"=>$pro["weight"],
                    "Length" => $pro["length"],
                    "Width" => $pro["width"],
                    "Height" => $pro["height"],
                    );     
                     $items[] = $c;
                 }
                 
              
                $calculateServiceFeeRequest = array("SessionToken" => $sessionToken, "Items" => $items);
                $responseCalculateServiceFee = $serviceClient->CalculateServiceFee($calculateServiceFeeRequest);
                $error = $responseCalculateServiceFee['ErrorMessage'];
                $items = $responseCalculateServiceFee["Items"];
                 echo json_encode($items); 
                 break;
             }
              case "CreateShippingOrder":{
                    $shippingOrderRequest = array(
                        "SessionToken" => $sessionToken,
                        "MerchantCode" => "Nguyễn Văn A",
                        "MerchantHubCode" => "2 Lê Duẩn, Quận 1",
                        "SenderName" => "0907382922",
                        "SenderPhone" => "LZD-WH-2014-18-10-00",
                        "PickAddress" => "Nguyễn Văn A",
                        "PickDistrictCode" => "0201",
                        "GHNOrderCode" => "",
                        "ClientOrderCode" => "LZD-WH-2014-18-10-02-01",
                        "SealCode" => "LZD-WH-2014-16-10-00",
                        "RecipientName" => "Nguyễn Văn A",
                        "RecipientPhone" => "0907382922",
                        "DeliveryAddress" => "2 Lê Duẩn, Quận 1",
                        "DeliveryDistrictCode" => '0201',
                        "CODAmount" => 450000,
                        "ContentNote" => "Áo thun note",
                        "ServiceID" => 53325,
                        "Weight" => 123,
                        "Length" => 100,
                        "Width" => 100,
                        "Height" => 100);
                    
                    $responseCreateShippingOrder = $serviceClient->CreateShippingOrder($shippingOrderRequest);
                    $error = $responseCreateShippingOrder['ErrorMessage'];
                    print_r($error); 
                    if (empty($error)) 
                    {
                         echo json_encode($responseCreateShippingOrder);
                    }
                    else
                    {
                       print_r($responseCreateShippingOrder['ErrorMessage']); 
                    }
                    
                    break;
             }
              case "CancelOrder":{
                    $cancelOrderRequest = array("SessionToken" => $sessionToken, "OrderCode" => "7179899404");
                    $responseCancelShippingOrder = $serviceClient->CancelOrder($cancelOrderRequest);
                   
                    if (!empty($responseCancelShippingOrder)) 
                    {
                        print_r($responseCancelShippingOrder); 
                    }else
                    {
                        print_r('Cancel order successful'); 
                    }
                 break;
            }
            
            }
        
   } 
?>
