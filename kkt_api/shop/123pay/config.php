<?php
  $aConfig = array
    (
        'url'=>'https://sandbox.123pay.vn/miservice/createOrder1',
        'key'=>'MIKEY',
        'merchantCode'=>'MICODE',
        'passcode'=>'MIPASSCODE',
        'cancelURL' => 'merchantCancelURL', //fill cancelURL here
        'redirectURL' => 'merchantRedirectURL', //fill redirectURL here
        'errorURL' => 'merchantErrorURL', //fill errorURL here
        'prefix'=>'traodoidi',
    );
    
    $transactionStatus = array
    (
        '0'=>'Mới',
        '1'=>'Thành công',
        '-10'=>'Giao dịch không tồn tại. Vui lòng thực hiện giao dịch mới.',
        '-100'=>'Đơn hàng bị hủy',
        '10' => 'Đang kiểm tra thông tin tài khoản. Giao dịch chưa bị trừ tiền.', 
        '20' => 'Không xác định trạng thái thanh toán từ ngân hàng',
        '5000' => 'Hệ thống bận',
        '6200'=>'Vi phạm quy định nghiệp vụ giữa đối tác & 123Pay',
        '6212'=>'Ngoài giới hạn thanh toán / giao dịch',
        '7200'=>'Thông tin thanh toán không hợp lệ',
        '7201'=>'Không đủ tiền trong tài khoản thanh toán',
        '7202'=>'Không đảm bảo số dư tối thiểu trong tài khoản thanh toán',
        '7203'=>'Giới hạn tại ngân hàng: Tổng số tiền / ngày',
        '7204'=>'Giới hạn tại ngân hàng: Tổng số giao dịch / ngày',
        '7205'=>'Giới hạn tại ngân hàng: Giá trị / giao dịch',
        '7210'=>'Khách hàng không nhập thông tin thanh toán',
        '7211'=>'Chưa đăng ký dịch vụ thanh toán trực tuyến',
        '7212'=>'Dịch vụ thanh toán trực tuyến của tài khoản đang tạm khóa',
        '7220'=>'Khách hàng không nhập OTP',
        '7221'=>'Nhập sai thông tin thẻ/tài khoản quá 3 lần',
        '7222'=>'Sai thông tin OTP',
        '7223'=>'OTP hết hạn',
        '7224'=>'Nhập sai thông tin OTP quá 3 lần',
        '7231'=>'Sai tên chủ thẻ',
        '7231'=>'Card không hợp lệ, không tìm thấy khách hàng / tài khoản',
        '7233'=>'Expired Card',
        '7234'=>'Lost Card',
        '7235'=>'Stolen Card',
        '7236'=>'Card is marked deleted',
        '7241'=>'Credit Card - Card Security Code verification failed',
        '7242'=>'Credit Card - Address Verification Failed',
        '7243'=>'Credit Card - Address Verification and Card Security Code Failed',
        '7244'=>'Credit Card - Card did not pass all risk checks',
        '7245'=>'Credit Card - Bank Declined Transaction',
        '7246'=>'Credit Card - Account has stop/hold(hold money,...)',
        '7247'=>'Credit Card - Account closed',
        '7248'=>'Credit Card - Frozen Account',
        '7300'=>'Lỗi giao tiếp hệ thống ngân hàng',
    );
?>
