<?php
include 'common.class.php';
require_once("../../function/utils.php");
require_once("../ShopDAO.php");

$aConfig = array
(
	'merchantCode'=>'MICODE',
	'url'=>'https://sandbox.123pay.vn/miservice/queryOrder',
	'key'=>'MIKEY',
	'passcode'=>'MIPASSCODE',
    'key'=>'MIKEY',
    'prefix'=>'traodoidi',
);
    $transactionID = "traodoidi12";//$_GET['transactionID'];
    $clientIP = getRealIpAddr ();
    $checksum = sha1($transactionID.$aConfig['merchantCode'].$clientIP.$aConfig['passcode']. $aConfig['key']);
		try
		{
			$aData = array
			(
				'mTransactionID' => $transactionID,
				'merchantCode' =>$aConfig['merchantCode'],
				'clientIP' =>$clientIP,
				'passcode' =>$aConfig['passcode'],
				'checksum' =>$checksum,
			);
			$data = Common::callRest($aConfig, $aData);
			
			$result = $data->return;
			if($result['httpcode'] ==  200)
			{
				/* Retun data format
				Array
				(
					[0] => 1
					[1] => 123P1210020000507
					[2] => 1
					[3] => 100000
					[4] => 100000
					[5] => BANKNET
					[6] => 
					[7] => bc44083e998b5e24a922ffad04ea779a84bb2ee3
					[httpcode] => 200
				)
				*/
				if($result[0]=='1')
				{	
					echo 'Order info:<hr>';
					echo 'mTransactionId:'.$transactionID.'<br>';
					echo '123PayTransactionId: '.$result[1].'<br>';
					echo 'Status: '.$result[2].'<br>';
					echo 'Amount: '.$result[3].'<br>';
					echo '<hr>';
					if($result[2]=='1')//success
					{
						//Do success call service
                        $transactionID =str_replace($aConfig["prefix"],"",$transactionID);
                        updatePaymentStatus($transactionID,1);
						echo 'Checkout process successfully';
					}else{					
                      echo 'Show message base on order status ('.$result[2].')';
					}
				}else{
					echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
				}
			}else{
				//do error call service.
				echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
			}
		}catch(Exception $e)
		{
			//write log here to monitor your exception
			echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
		}

?>
