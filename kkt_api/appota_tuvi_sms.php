<?php 
    //Khai báo các tham số được cấp phát
    $client_secret = "f0bbbd1c5dbda1bca5a8b1b21c52e0e1052ce1cfa";
    
    //Nhận các biến gửi qua giao thức POST
    $status = @$_POST['status'];
    $sandbox = @$_POST['sandbox'];
    $transaction_id = @$_POST['transaction_id'];
    $transaction_type = @$_POST['transaction_type'];
    $phone = @$_POST['phone'];
    $message = @$_POST['message'];
    $code = @$_POST['code'];
    $amount = @$_POST['amount'];
    $currency = @$_POST['currency'];
    $country_code = @$_POST['country_code'];
    $hash = @$_POST['hash'];
    $data = "transaction_id=".$transaction_id."; phone=".$phone." message=".$message." code=".$code." hash=".$hash;
    writeLog($data);
    //Kiểm tra hash để xác nhận giao dịch từ Appota
    if($hash == md5($amount.$code.$country_code.$currency.$message.$phone.$sandbox.$status.$transaction_id.$transaction_type.$client_secret)){
        //Xử lý ở đây
        //In ra chuỗi thông tin gửi về cho user
        echo "Camm on cac ban da xu dung dich vu TuVi. Chuc cac ban may man va An Khang.";
    }else{
         echo "Camm on cac ban da xu dung dich vu TuVi. Chuc cac ban may man va An Khang nhe.";
    }
?>

<?php
 function writeLog($mo){
    $date = date('Y-m-d H:i:s');
    $file = dirname(__FILE__).'/logAppotaTuvi.txt';
    
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current .=$date."  :  ". $mo."\n";
    
    // Write the contents back to the file
    file_put_contents($file, $current,FILE_APPEND | LOCK_EX);
 }

?>