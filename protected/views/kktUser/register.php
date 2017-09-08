<div class="container">
    <div class="main clearfix">        
        <div class="ifo_acount">
            <h2 class="bg_green"><strong>Đăng ký tài khoản</strong></h2>        
            <div class="box">              
                <form action="" method="POST">
                    <ul class="list_style">
                    
                        <?php if(!empty($error)){ ?>
                        <li style="color: red;">
                            <?php echo $error;?>
                        </li>
                        <?php }?>
                        
                        <li>
                            <span><strong>Tên đăng nhập</strong></span><br>
                            <input type="text" name="username" value="<?php if(isset($data["username"])) echo $data["username"];?>" style="width:93%">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Email</strong></span><br>
                            <input type="text" name="email" value="<?php if(isset($data["email"])) echo $data["email"];?>" style="width:93%">
                        </li> 
                        <li class="bg_gray">
                            <span><strong>Số di động</strong></span><br>
                            <input type="text" name="mobile" value="<?php if(isset($data["mobile"])) echo $data["mobile"];?>" style="width:93%">
                            <p><i>Lưu ý: số di động phải trùng với số điện thoại nhắn tin lấy mã kích hoạt</i></p>
                        </li>                       
                        <li class="bg_gray">
                            <span><strong>Mật khẩu</strong></span><br>
                            <input type="password" name="password" style="width:93%">
                        </li>
                        
                        <li class="bg_gray">
                            <span><strong>Nhập lại mật khẩu</strong></span><br>
                            <input type="password" name="password_retype" style="width:93%">
                        </li>        
                        <li class="bg_gray">
                            <span><strong>Mã kích hoạt</strong></span><br>
                            <input type="text" name="code" style="width:93%">
                            <p><i>Nhắn tin: <strong><font color='red'>KBK KH</font>  gửi <font color=red>8077</font></i></strong> để nhận mã kích hoạt. Phí tin nhắn là 500đ</p>
                            <p>Lưu ý:Số điện thoại nhắn tin phải trùng với số điện thoại đăng kí thành viên.</p>
                        </li>                
                        <li><input type="submit" value="Đăng ký" class="bt_orage mag0"></li>
                    </ul>
                </form>
            </div>            
        </div>    
    </div>         
</div>