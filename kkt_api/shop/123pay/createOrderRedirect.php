<html lang="en">
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> 
    <title>Trao Đổi Đi</title>
</head>
<body>
<?php
  include 'common.class.php';
  require_once("../../function/utils.php");
  require_once("../ShopDAO.php");
  require_once('config.php');
  //merchant?transactionID={transactionID}&time={time}&status={status}&ticket=MD5(status + time + transactionID + secretKey)
  $aConfig = array(
    'merchantCode'=>'MICODE',
    'url'=>'https://sandbox.123pay.vn/miservice/queryOrder',
    'key'=>'MIKEY',
    'passcode'=>'MIPASSCODE',
    'key'=>'MIKEY',
    'prefix'=>'traodoidi',);
  // Get parameters
  $transactionID = $_GET["transactionID"];
  $time = $_GET["time"];
  $status = $_GET["status"];
  $ticket = $_GET["ticket"];
  $ticket_check = MD5($status . $time . $transactionID . $aConfig["key"]);
  
  if(strcasecmp($ticket_check,$ticket)==0){
      try
        {
            $clientIP = getRealIpAddr ();
            $checksum = sha1($transactionID.$aConfig['merchantCode'].$clientIP.$aConfig['passcode']. $aConfig["key"]);
            $aData = array(
                'mTransactionID' => $transactionID,
                'merchantCode' =>$aConfig['merchantCode'],
                'clientIP' =>$clientIP,
                'passcode' =>$aConfig['passcode'],
                'checksum' =>$checksum,);
            // Get Info Order
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
                if($result[0]=='1') // Truy vấn đơn hành thành công
                {    
                    echo '<H2>Thông tin thanh toán:<hr></H2>';
                    echo '<p>Mã Giao dịch:'.$transactionID.'</p><br>';
                    echo '<p>Mã Giao dich 123Pay: '.$result[1].'</p><br>';
                    if($result[2]=='1')// payment success
                    {
                        //Do success call service
                        $transactionID =explode("_",$transactionID);
                        $transactionID = intval($transactionID["1"]);
                        updatePaymentStatus($transactionID,1);
                        $messageStatus = 'Thanh toán thành công.';
                        echo '<p>Trạng thái: '.$messageStatus.'</p><br>';    
                        echo '<p>Số Tiền: '.$result[3].'</p><br>';
                        echo '<hr>'; 
                    }else{                    
                        $reson = $transactionStatus[$result[2]];
                        $transactionID =explode("_",$transactionID);
                        $transactionID = intval($transactionID["1"]);
                        updatePaymentStatus($transactionID,0);
                        $messageStatus = 'Thanh toán không thành công. Lý do: ('.$reson.').';
                        echo '<p>Trạng thái: '.$messageStatus.'</p><br>';    
                        echo '<p>Số Tiền: '.$result[3].'</p><br>';
                        echo '<hr>'; 
                    }
                }else{
                    echo '<p>Truy vấn thông tin thanh toán không thành công. Bạn hãy chờ hệ thống báo thông tin qua notify sau giây lát. Hỗ trợ 0974838181</p>';
                }
            }else{
                $reson = $result[1];
                //do error call service.
                  echo '<p>Truy vấn thông tin thanh toán không thành công. Lý do: ('.$reson.'). Bạn hãy chờ hệ thống báo thông tin qua notify sau giây lát. Hỗ trợ 0974838181</p>';
            }
        }catch(Exception $e)
        {
            //write log here to monitor your exception
            echo '<p>Hệ thống đang xử lý. Hỗ trợ 0974838181</p>';
        }

  }
?>
</body>
</html>