<?php
/**
 * 123Pay Merchant Service
 * @package		miservice
 * @subpackage 	notify.php
 * @copyright	Copyright (c) 2012 VNG
 * @version 	1.0
 * @author 		quannd3@vng.com.vn (live support; zingchat:kibac2001, yahoo:kibac2001, Tel:0904904402)
 * @created 	01/10/2012
 * @modified 	05/10/2012
 */
include 'config.php';  
require_once("../../function/utils.php");
require_once("../ShopDAO.php");
require_once("../ShopNotify.php");

  
//this sample code use both GET and POST method
//You can modify to use one that you like
$mTransactionID = $_REQUEST['mTransactionID'];
$bankCode = $_REQUEST['bankCode'];
$transactionStatus = $_REQUEST['transactionStatus'];
$description = $_REQUEST['description'];
$ts = $_REQUEST['ts'];
$checksum = $_REQUEST['checksum'];
$sMySecretkey = $aConfig["key"];//key use to hash checksum that will be provided by 123Pay
$sRawMyCheckSum = $mTransactionID.$bankCode.$transactionStatus.$ts.$sMySecretkey;
$sMyCheckSum = sha1($sRawMyCheckSum);

 $message = "mTransactionID=".$mTransactionID;
 $message .= "bankCode=".$bankCode;
 $message .= "transactionStatus=".$transactionStatus;
 $message .= "description=".$description;
 $message .= "ts=".$ts;
 $message .= "checksum=".$checksum;
 writeToLog123Notify($message) ; 
  
  /*$mTransactionID="traodoidi_213_1456308817"  ;
  $bankCode ="123PVCB";
  $transactionStatus=1;
  $description="";
  $ts=1456308501 ;
  $checksum="b7c10699aa38708b4ad1b332b7eaa115d806f9a8";*/  

  
  if($sMyCheckSum != $checksum)
{
	 response($mTransactionID, '-1', $sMySecretkey);
}   

 $processResult = process($mTransactionID, $bankCode, $transactionStatus,$ts,$checksum);
 response($mTransactionID, $processResult, $sMySecretkey);


/*===============================Function region=======================================*/
function process($mTransactionID, $bankCode, $transactionStatus,$ts,$checksum)
{
	try
	{
		if(empty($mTransactionID) || empty($bankCode) || empty($transactionStatus))
		{
			return -1;
		}
		
        if(checkTransaction123PayNotify($mTransactionID)==1){
            // Had log transaction
            return 2;
        }else{    
             $kqLog = insertTransaction123PayNotify($mTransactionID, $bankCode, $transactionStatus, $description, 
             $ts,$checksum);
             // Had exception
             if($kqLog==0) return -4; 
             
             $transactionID =explode("_",$mTransactionID);
             $transactionID = $transactionID["1"];
             $transaction=getTransaction($transactionID);
             $to_user = $transaction["buyer_id"];
             
             if($transaction["fee_product"]<0) $to_user = $transaction["seller_id"];
             // update payment     
             if(intval($transactionStatus)==1){
                        updatePaymentStatus($transactionID,1);
                         // Add Notify Bao Ket qua thah toán 
                        $kq= pushNotify123PaySuccess($transactionID, $to_user);
                        writeToLog123Notify($message."_KQ".$kq)    ;
                  }else{
                        updatePaymentStatus($transactionID,0);
                         // Add Notify Bao Ket qua thah toán 
                        $kq= pushNotify123PayFail($transactionID, $to_user);
                        writeToLog123Notify($message."_KQ".$kq)    ;
             }
                  return 1;
                  }   
	}
	catch(Exception $_e)
	{
        echo 'Message: ' .$_e->getMessage();
		return -3;
	}
}

function response($mTransactionID, $returnCode, $key)
{
	$ts = time();
	$sRawMyCheckSum = $mTransactionID.$returnCode.$ts.$key;
	$checksum = sha1($sRawMyCheckSum);
	$aData = array(
		'mTransactionID' => $mTransactionID,
		'returnCode' => $returnCode,
		'ts' => time(),
		'checksum' => $checksum
	);
	echo json_encode($aData);
	exit;
}


function writeToLog123Notify($message)
{
    $path = "/home/traodoidi/domains/traodoidi.vn/public_html/swap_api/shop/123pay/123PayNotify.txt";
    if ($fp = fopen($path, 'at'))
    {
        fwrite($fp, date('c') . ' ' . $message . PHP_EOL);
        fclose($fp);
    }
}

/*===============================End Function region=======================================*/
?>
