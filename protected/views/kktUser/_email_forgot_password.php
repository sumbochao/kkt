<p>Xin chào bạn !</p>
<p>Mã kích hoạt lấy lại mật khẩu của bạn là: <?php echo $key_active_password;?></p>
<p>Hoặc bạn có thể <a href="<?php echo "http://cungkiemtien.net" . Url::createUrl("kktUser/activeForgotPassword", array("email"=>$email, "invite"=>$key_active_password));?>">click vào đây</a> để lấy lại mật khẩu.</p>
<p>Trân trọng,</p>
<p>BQT CungKiemTien.net</p>
<p>Hàng ngàn người đang làm việc trên CungKiemTien hàng ngày và kiếm tiền trực tuyến rất đơn giản và nhanh chóng.</p>