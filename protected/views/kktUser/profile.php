<div class="container">
    <div class="main clearfix">
        <!-- box top user -->
        <?php $this->widget("BoxTopUser");?>
        <!-- end box top user -->
        
        <div class="ifo_acount">
            <h2 class="bg_green"><strong>Hồ sơ cá nhân</strong></h2>
            <div class="box">
                <ul class="list_style">
                    <li>
                        <span><strong>Họ tên</strong></span><br />
                        <span class="cl666"><?php echo $info["full_name"];?></span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Điện thoại</strong></span><br />
                        <span class="cl666"><?php echo $info["mobile"];?></span>
                    </li>
                    <li>
                        <span><strong>Giới tính </strong></span><br />
                        <span class="cl666">
                            <?php 
                                if($info["gender"] == 1) echo "Nam";
                                else echo "Nữ";
                            ?>
                        </span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Chỗ ở hiện nay  </strong></span><br />
                        <span class="cl666"><?php echo $info["address"];?></span>
                    </li>
                    <li>
                        <span><strong>Địa chỉ thường trú </strong></span><br />
                        <span class="cl666"><?php echo $info["permanent_address"];?></span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Số CMT</strong></span><br />
                        <span class="cl666"><?php echo $info["identity_number"];?></span>
                    </li>
                    <li>
                        <span><strong>Ngày cấp CMT</strong></span><br />
                        <span class="cl666"><?php if(!empty($info["date_of_identity"])) echo date("d/m/Y", $info["date_of_identity"]);?></span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Nơi cấp CMT</strong></span><br />
                        <span class="cl666"><?php echo $info["which_of_identity"];?></span>
                    </li>
                    <li>
                        <span><strong>Tên chủ tài khoản </strong></span><br />
                        <span class="cl666"><?php echo $info["account_owner"];?></span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Số tài khoản ngân hàng  </strong></span><br />
                        <span class="cl666"><?php echo $info["account_number"];?></span>
                    </li>
                    <li>
                        <span><strong>Tên ngân hàng</strong></span><br />
                        <span class="cl666"><?php echo $info["account_bank"];?></span>
                    </li>
                    <li class="bg_gray">
                        <span><strong>Tên chi nhánh/Phòng giao dịch (chi tiết)</strong></span><br />
                        <span class="cl666"><?php echo $info["account_branch"];?></span>
                    </li>
                    <li>
                        <span><strong>Mã số thuế TNCN  </strong></span><br />
                        <span class="cl666"><?php echo $info["personal_tax_code"];?></span>
                    </li>
                </ul>
            </div>
            <div class="box pad10">
                <a class="clorage" href="<?php echo Url::createUrl("kktUser/editProfile");?>"><strong>Cập nhật thông tin</strong></a>
            </div>
        </div>
    </div>
</div>