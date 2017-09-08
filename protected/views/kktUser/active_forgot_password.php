<div class="container">
    <div class="main clearfix">       
        <div class="change_pas">
            <form action="" method="POST">
                <h2 class="bg_green"><strong>Quên mật khẩu</strong></h2>
                <div class="box pad10">
                    <ul class="list_style">
                    
                        <?php if(!empty($error)) { ?>
                        <li class="mag_btt_t5" style="color: red;">
                            <?php echo $error;?>
                        </li>
                        <?php } ?>
                                                
                        <li class="mag_btt_t5">
                            <span><strong>Nhập mật khẩu</strong></span><br />
                            <input type="password" name="password" style="width:93%">
                        </li>
                        <li class="mag_btt_t5">
                            <span><strong>Nhập lại mật khẩu</strong></span><br />
                            <input type="password" name="password_retype" style="width:93%">
                        </li>
                    </ul>
                    <input type="submit" class="bt_orage" value="Đổi mật khẩu">                
                </div>
            </form>
        </div>        
    </div>
</div>