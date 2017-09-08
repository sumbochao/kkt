<?php
header('Content-type: text/html; charset=utf-8');     
include 'rest.client.class.php';
include 'common.class.php';
require_once 'config.php';
require_once("../../function/utils.php");
require_once("../ShopDAO.php");

function createUniqueOrderId($orderIdPrefix)
{
	return $orderIdPrefix.time();
}

$mTransactionID = '';
$orderIdPrefix = 'micode';
$result = null;
$resultMessage = '';
           
if($_POST)
{
    $mTransactionID = $_POST["transactionID"];
	$resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
    $totalAmount = $_POST["totalAmount"];
    $clientIP = getRealIpAddr ();
    $custName = $_POST["custName"]; // Fullname customer
    $custAddress = isset($_POST["custAddress"])?$_POST["custAddress"]:"";
    $custGender =isset($_POST["custGender"])?$_POST["custGender"]:"U"; // Gioi Tinh M: Nam F: Nữ U: Không có thông tin khách hàng
    $custDOB = isset($_POST["custDOB"])?$_POST["custDOB"]:""; // Birthday dd/mm/yyyy
    $custPhone = isset($_POST["custPhone"])?$_POST["custPhone"]:""; // Mobile
    $custMail =isset($_POST["custMail"])?$_POST["custMail"]:""; // Email
    $description =isset($_POST["description"])?$_POST["description"]:"";
    $bankCode =  $_POST["bankCode"];
    $cancelURL= 'http://traodoidi.vn/swap_api/shop/123pay/createOrderRedirect.php';
    $redirectURL= 'http://traodoidi.vn/swap_api/shop/123pay/createOrderRedirect.php';
    $errorURL= 'http://traodoidi.vn/swap_api/shop/123pay/createOrderRedirect.php';
    $checksum =sha1($mTransactionID.$aConfig["merchantCode"].$bankCode.$totalAmount.$clientIP.$custName.$custAddress.$custGender.$custDOB.$custPhone.$custMail.$cancelURL.$redirectURL.$errorURL.$aConfig["passcode"].$aConfig["key"]);
    
    
   // $mTransactionID ="1";
   // $resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
  //  $totalAmount ="90000";
   // $clientIP = getRealIpAddr ();
  //  $custName = "Tran The Thang"; // Fullname customer
    //$custAddress = "196 Cau Giay - Ha Noi";;
   // $custGender ="U"; // Gioi Tinh M: Nam F: Nữ U: Không có thông tin khách hàng
    //$custDOB = "24/01/1983"; // Birthday dd/mm/yyyy
    //$custPhone = "0974838181"; // Mobile
    //$custMail =""; // Email
   // $description ="Thanh Toan Don Hang 1 ";
    //$bankCode =  "123PVCB";

    if(empty($mTransactionID)||empty($totalAmount)||empty($custGender)||empty($custName)||empty($bankCode)){
        $arrRS["kq"]= 1;
        $arrRS["description"]= "Tham số thanh toán lỗi.";
        $arrRS["link"]= "";
        echo json_encode($arrRS);
        exit();    
    }
    // Check had payment transaction
    $transactionDetail = getTransaction($mTransactionID) ;
    if($transactionDetail["status_payment"]==1) {
        $arrRS["kq"]= 1;
        $arrRS["description"]= "Giao dịch đã được thanh toán.";
        $arrRS["link"]= "";
        echo json_encode($arrRS);
        exit();     
    }       
    
    $aData = array
	(
		'mTransactionID' =>$aConfig["prefix"]."_".$mTransactionID."_".time(),
		'merchantCode' =>$aConfig["merchantCode"],
		'bankCode' =>$bankCode,
		'totalAmount' =>$totalAmount,
		'clientIP' =>$clientIP,
		'custName' =>$custName,
		'custAddress' =>$custAddress,
		'custGender' =>$custGender,
		'custDOB' =>"",
		'custPhone' =>"",
		'custMail' =>"",
		'description' =>$description,
		'cancelURL' => $cancelURL,
        'redirectURL' => $redirectURL,
        'errorURL' =>$errorURL,
		'passcode' =>$aConfig["passcode"],
		'checksum' =>$checksum,
		'addInfo' =>''
	);
    
    $arrRS = array();
    
    try
	{
        $data = Common::callRest($aConfig, $aData);//call 123Pay service
		$result = $data->return;
      if($result['httpcode'] ==  200)
		{
			//Call service success do success flow
			if($result[0]=='1')//Service return success
			{
				//Re-create checksum
				$rawReturnValue = '1'.$result[1].$result[2];
				$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
				if($reCalChecksumValue == $result[3])//check checksum
				{
                    writeToLog123Notify($aData["mTransactionID"]."_0:".$result[0]."_1:".$result[1]."_2:".$result[2]);
					$resultMessage .=  'Call service result:<hr>';
					$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
					$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
					$resultMessage .=  'URL='.$result[2].'<br>';
					//call php header to redirect to input card page
					$resultMessage .= '<a style="color:red;font-weight:bold;" href="'.$result[2].'" target="_parent">Click here to go to payment process</a><br>';
					//echo'<script>window.location.href="'.$result[2].'"</script>';
                    $arrRS["kq"]= 0;
                    $arrRS["description"]= "Success";
                    $arrRS["link"]= $result[2];
                    echo json_encode($arrRS);
                    exit();
				}else{
					//Call 123Pay service create order fail, return checksum is invalid
					$resultMessage .=  'Return data is invalid<br>';
                    $arrRS["kq"]= 1;
                    $arrRS["description"]= "Tham số thanh toán lỗi.";
                    $arrRS["link"]= "";
                    echo json_encode($arrRS);
				}
			}else{
				//Call 123Pay service create order fail, please refer to API document to understand error code list
				//$result[0]=error code, $result[1] = error description
				$resultMessage .=  $result[0].': '.$result[1];
                $arrRS["kq"]= 2;
                $arrRS["description"]= $result[1];
                $arrRS["link"]= "";
                echo json_encode($arrRS);
			}
		}else{
			//call service fail, do error flow
			 $resultMessage .=  'Không kết nối được tới 123Pay. Bạn hãy kiểm tra lại kết nối internet.<br>';
             $arrRS["kq"]= 3;
             $arrRS["description"]= $resultMessage;
             $arrRS["link"]= "";
             echo json_encode($arrRS);
		}
	}catch(Exception $e)
	{
		$resultMessage .=  '<pre>';
		$resultMessage .= $e->getMessage();
        $arrRS["kq"]= 4;
        $arrRS["description"]=  $e->getMessage;
        $arrRS["link"]= "";
        echo json_encode($arrRS);
	}
	//create new orderid
}

function writeToLog123Notify($message)
{
    $path = "/home/traodoidi/domains/traodoidi.vn/public_html/swap_api/shop/123pay/123PayCreateOrder.txt";
    if ($fp = fopen($path, 'at'))
    {
        fwrite($fp, date('c') . ' ' . $message . PHP_EOL);
        fclose($fp);
    }
}
?>
