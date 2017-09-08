<div class="container">
    <div class="main clearfix">
        <!-- box top user -->
        <?php $this->widget("BoxTopUser");?>
        <!-- end box top user -->
        
        <div class="ifo_acount">
            <h2 class="bg_green"><strong>Cập nhật hồ sơ</strong></h2>
            <div class="box">
                <form action="" method="POST">
                    <ul class="list_style">
                        <li>
                            <span><strong>Họ tên</strong></span><br />
                            <input type="text" style="width:93%" name="full_name" value="<?php echo $info["full_name"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Điện thoại</strong></span><br />
                            <input type="text" style="width:93%" name="mobile" value="<?php echo $info["mobile"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Giới tính </strong></span><br />
                            <input type="radio" <?php if($info["gender"]==1) echo "checked";?> value="1" name="gender"> Nam<br />
                            <input type="radio" <?php if($info["gender"]==0) echo "checked";?> value="0" name="gender"> Nữ
                        </li>
                        <li class="bg_gray">
                            <span><strong>Chỗ ở hiện nay  </strong></span><br />
                            <input type="text" style="width:93%" name="address" value="<?php echo $info["address"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Địa chỉ thường trú </strong></span><br />
                            <input type="text" style="width:93%" name="permanent_address" value="<?php echo $info["permanent_address"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Số CMT</strong></span><br />
                            <input type="text" style="width:93%" name="identity_number" value="<?php echo $info["identity_number"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Ngày cấp CMT  </strong></span><br />
                            <input type="text" style="width:93%" name="date_of_identity" value="<?php if(!empty($info["date_of_identity"])) echo date("d-m-Y", $info["date_of_identity"]);?>"> (dd-mm-yyyy)
                        </li>
                        <li class="bg_gray">
                            <span><strong>Nơi cấp CMT  </strong></span><br />
                            <input type="text" style="width:93%" name="which_of_identity" value="<?php echo $info["which_of_identity"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Tên chủ tài khoản </strong></span><br />
                            <input type="text" style="width:93%" name="account_owner" value="<?php echo $info["account_owner"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Số tài khoản ngân hàng  </strong></span><br />
                            <input type="text" style="width:93%" name="account_number" value="<?php echo $info["account_number"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Tên ngân hàng</strong></span><br />
                            <span class="cl999">(Ví dụ: Ngân hàng Ngoại Thương Việt Nam)</span><br />
                            <input type="text" style="width:93%" name="account_bank" value="<?php echo $info["account_bank"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Tên chi nhánh/Phòng giao dịch (chi tiết)</strong></span><br />
                            <span class="cl999">Ví dụ:  Ngoại Thương Thăng Long - Cầu Giấy - Hà Nội</span><br />
                            <input type="text" style="width:93%" name="account_branch" value="<?php echo $info["account_branch"];?>">
                        </li>
                        <li class="bg_gray">
                            <span><strong>Mã số thuế TNCN</strong></span><br />
                            <input type="text" style="width:93%" name="personal_tax_code" value="<?php echo $info["personal_tax_code"];?>">
                        </li>
                        <li>
                            <input type="submit" value="Cập nhật" class="bt_orage mag0">                        
                        </li>
                    </ul>
                </form>
            </div>            
        </div>        
    </div>
</div>
