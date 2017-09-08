<div class="container">
    <div class="main clearfix">
        <?php if(!empty($topUser)) { ?>
            <div class="star_month pad10 bor_top">
                <h2 class="clorage"><strong>Ngôi sao bán hàng trong tháng</strong></h2>
                <div class="list_item">
                    <div class="table">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <?php 
                                        foreach($topUser as $i=>$row) { 
                                            if($i<=4 && !empty($row["username"])){                                                                            
                                                $url_user = "http://" . $row["username"] . ".".Yii::app()->params["domain_member"];
                                                if($row["avatar_url"] ==""){
                                                     $avatar_url = Yii::app()->params["static_url"].'images/avata_default.gif';
                                                }else{
                                                     $avatar_url = Yii::app()->params["urlImages"].'/avatar/'.$row["avatar_url"];
                                                }
                                            ?>
                                            <td width="20%" align="center">
                                                <a href="<?php echo $url_user;?>" title="<?php echo $row["username"];?>">
                                                    <img width="60" height="60" src="<?php echo $avatar_url;?>" class="img52" />
                                                </a>
                                            </td>
                                            <?php 
                                            } 
                                        }
                                    ?>                                
                                </tr>                                  

                            </tbody>
                        </table>
                    </div>                
                </div>
            </div>
            <?php } ?>

        <!--<div class="money_syst pad10 bg_green">
            <h2 class="bottom3"><strong>Doanh thu hệ thống</strong></h2>

            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="50%" class="no_bor_top"><strong>Tổng doanh thu (đ):</strong></td>
                    <td width="50%" align="right" class="no_bor_top"><strong><?php //echo Common::format_price($total_money);?></strong></td>
                </tr>
                <tr>
                    <td width="50%"><strong>Tổng số SMS:</strong></td>
                    <td width="50%" align="right"><strong><?php //echo Common::format_price($total_sms);?></strong></td>
                </tr>
                <tr>
                    <td width="50%" class="no_bor_btt"><strong>Tổng số Card:</strong></td>
                    <td width="50%" align="right" class="no_bor_btt"><strong><?php //echo Common::format_price($total_card);?></strong></td>
                </tr>
            </table>

        </div>-->
        <?php if($many_download){?>
            <div class="seller">
                <h2 class="clorage"><strong>Hàng bán chạy</strong>&nbsp;<img src="<?php echo Yii::app()->params["static_url"];?>images/icon_hot.gif" alt="icon hot" /></h2>
                <div class="list_item">
                    <div class="table pad_btt0">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <?php 
                            $i=0;
                            foreach($many_download as $key=>$value){
                                    if($value["type"]==1){
                                        $picture = Common::getImage($value["picture"],"game",$value["create_date"],"m");
                                    }elseif($value["type"]==2){
                                        $picture = Common::getImage($value["picture"],"video",$value["create_date"],"m");
                                    }elseif($value["type"]==3){
                                        $picture = Common::getImage($value["picture"],"image",$value["create_date"],"m");
                                    }
                                    $url_file = Url::createUrl("kktDownload/hotHome",array("type"=>$value["type"],"alias"=>$value["alias"]));
                                    $url_file = "#"
                                ?>
                             <?php if(($i+1)%2==1){?><tr><?php }?>
                                <td class="bg_gray pad10 bor_top" width="30%">
                                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                        <tr>
                                            <td width="52">
                                                <img class="img52" src="<?php echo $picture;?>" alt="<?php echo $value["title"];?>" title="<?php echo $value["title"];?>" />
                                            </td>
                                            <td class="item_data" valign="top">
                                                <strong><?php echo $value["title"];?></strong><br />
                                                <span class="cl999">Tải:<?php echo $value["download"];?> </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                              <?php if(($i+1)%2==0){?></tr><?php }?>  
                                <?php 
                                $i++;
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <?php }?>
        <div class="login pad10 bg_orage2">
            <h2 class="clorage"><strong>Đăng nhập</strong></h2>
            <?php if(!empty($error)) { ?>
                <p class="err_log clred mag_btt_t5"><strong>Lỗi:</strong> <?php echo $error;?></p>
                <?php }?>

            <form action="" method="POST">
                <div class="table">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <td width="70">Tài khoản:</td>
                            <td><input type="text" name="username"></td>
                        </tr>
                        <tr>
                            <td>Mật khẩu:</td>
                            <td><input type="password" name="password"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="checkbox" id="chck_dangnhap" name="rememberPassword" value="">Ghi nhớ mật khẩu | 
                                <a href="<?php echo Url::createUrl("kktUser/forgotPassword");?>" class="clblue under">Quên mật khẩu ?</a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="pad0">
                                <input type="submit" value="Đăng nhập" border="0" class="bt_blue1" />
                                <a href="<?php echo Url::createUrl("kktUser/register");?>">
                                    <input type="button" border="0" value="Gia nhập KKT" class="bt_orage1" />
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>

        <?php if(count($topUser) > 5) { ?>
            <div class="mem_selest pad10 bor_top">
                <h2 class="clorage"><strong>Thành viên bán nhiều nhất</strong></h2>
                <div class="list_item">
                    <div class="table">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <?php 
                                        foreach($topUser as $i=>$row) { 
                                            if($i>4 && !empty($row["username"])){                                                                            
                                                $url_user = "http://" . $row["username"] . ".".Yii::app()->params["domain_member"];
                                            ?>
                                            <td width="20%" align="center">
                                                <a href="<?php echo $url_user;?>" title="pic">
                                                    <img src="<?php echo Yii::app()->params["static_url"];?>images/avata_default.gif" class="img52" />
                                                </a>
                                            </td>
                                            <?php 
                                            } 
                                        }
                                    ?>
                                </tr>                                  
                            </tbody>
                        </table>
                    </div>            
                </div>
            </div>
            <?php } ?>
    </div>
</div>