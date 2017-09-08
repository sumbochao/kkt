<p>Xin chào bạn <?php echo $data["username"];?>!</p>
<p>Cảm ơn bạn đã gửi yêu cầu đăng ký tham gia CungKiemTien.net</p>
<p>Mã kích hoạt của bạn là: <?php echo $data["key_active"];?></p>
<p>Hoặc bạn có thể <a href="<?php echo "http://cungkiemtien.net" . Url::createUrl("/kktUser/active", array("email"=>$data["email"], "invite"=>$data["key_active"]));?>">click vào đây</a> để hoàn thiện quá trình đăng ký.</p>
<p>Trân trọng,</p>
<p>BQT CungKiemTien.net</p>
<p>Hàng ngàn người đang làm việc trên CungKiemTien hàng ngày và kiếm tiền trực tuyến rất đơn giản và nhanh chóng.</p>