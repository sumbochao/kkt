<div class="user pad10">
    <div class="table">
        <table cellpadding="0" cellspacing="0" border="0">
            <tbody>
                <tr>
                    <td width="32">
                        <a href="#">
                            <img src="<?php echo Yii::app()->params["static_url"];?>images/login.png" alt="loggin" />
                        </a>
                    </td>
                    <td class="item_data">
                        <a href="http://<?php echo $_SESSION["username"];?>.<?php echo Yii::app()->params["domain_member"];?>" class="S14 clgreen">
                            <strong><?php echo $_SESSION["username"];?></strong>
                        </a><br />
                        <span class="user_info">
                            <a href="<?php echo Url::createUrl("/kktUser/profile");?>">Hồ sơ</a>&nbsp;|&nbsp; 
                            <a href="<?php echo Url::createUrl("/kktUser/changePassword");?>">Đổi mật khẩu</a>&nbsp;|&nbsp;                            
                            <a href="<?php echo Url::createUrl("/kktUser/editProfile");?>">Cập nhật thông tin</a>&nbsp;|&nbsp;                            
                            <a href="<?php echo Url::createUrl("/kktUser/editAvatar");?>">Sửa avatar</a>                            
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
