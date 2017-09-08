<script>
    function deleteMyAdv(id, userId){
        var answer = confirm("Bạn có chắc chắn muốn xóa quảng cáo này.");
        if(answer){
            window.location.href = "<?php echo Url::createUrl('kktUser/deleteMyAdv')?>?id=" + id + "&userId=" + userId;
        }
    }
</script>
<div class="container">
    <div class="main clearfix">
        <!-- box top user -->
        <?php $this->widget("BoxTopUser");?>
        <!-- end box top user -->

        <div class="bg_033 nobor pad10">
            <div class="nav_ctv">
                <ul class="list_style clearfix">
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>1));?>" class="<?php if($type==1) echo "active";?>">Hôm nay</a>&nbsp;::&nbsp;</li>
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>2));?>" class="<?php if($type==2) echo "active";?>">Hôm qua</a>&nbsp;::&nbsp;</li>
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>3));?>" class="<?php if($type==3) echo "active";?>">7 ngày gần đây</a>&nbsp;::&nbsp;</li>
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>4));?>" class="<?php if($type==4) echo "active";?>">Đầu tháng</a>&nbsp;::&nbsp;</li>
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>5));?>" class="<?php if($type==5) echo "active";?>">Tháng trước</a>&nbsp;::&nbsp;</li>
                    <li><a href="<?php echo Url::createUrl("/kktUser/index", array("type"=>6));?>" class="<?php if($type==6) echo "active";?>">Tổng</a></li>

                </ul>
            </div>

        </div>
        <div class="money_day pad_btt5">
            <div class="box bor_top">
                <h3 class="s12 bottom3 style1"><strong>. Doanh thu trực tiếp</strong></h3>
                <div class="reven_live cl333">
                    <span>- SMS 5.000đ: <em class="clorage"><?php if(isset($report["5000"])) echo Common::format_price($report["5000"]); else echo 0;?></em> </span><br>
                    <span>- SMS 10.000đ: <em class="clorage"><?php if(isset($report["10000"])) echo Common::format_price($report["10000"]); else echo 0;?></em>  </span><br>
                    <span>- SMS 15.000đ: <em class="clorage"><?php if(isset($report["15000"])) echo Common::format_price($report["15000"]); else echo 0;?></em>  </span><br>
                    <span>- Sản lượng SMS: <em class="clorage"><?php echo Common::format_price($report["total_sms"]);?></em></span><br>
                    <span>- Sản lượng Card: <em class="clorage"><?php echo Common::format_price($report["total_card"]);?></em></span><br>
                    <span>- Doanh thu SMS: <em class="clorage"><?php echo Common::format_price($report["total_money_sms_user"]);?> VNĐ</em> </span><br>
                    <span>- Doanh thu Card: <em class="clorage"><?php echo Common::format_price($report["total_money_card_user"]);?> VNĐ</em> </span><br>
                    <span>- Doanh thu Giới thiệu: <em class="clorage"><?php echo Common::format_price($total_user_ref);?> VNĐ</em> </span><br>
                    <span>- Tổng số người giới thiệu: <em class="clorage"><?php echo count($data_refUID);?></em> </span><br>
                    <span>- Doanh thu cá nhân (SMS + Card + Giới thiệu): <em class="clorage"><?php echo Common::format_price($report["total_money_sms_user"] + $report["total_money_card_user"] + $total_user_ref);?> VNĐ</em> </span><br>

                </div>
            </div>
        </div>
        <div class="top_sell">
            <h2 class="bg_green"><strong>Game Offline</strong></h2>
            <div class="table list_table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php 

                        foreach($data_game as $key=>$value){
                            $link_detail = Url::createUrl("kktUser/dataDetail",array("alias"=>$value["alias"],"typeCat"=>1,"id"=>$value["id"]));
                            $link_img=Common::getImage($value['picture'],"game",$value['create_date'],'m');
                            $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
                        ?>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo $link_detail;?>">
                                    <img class="img52" src="<?php echo $link_img;?>">
                                </a>
                            </td>
                            <td valign="top" class="item_data">
                                <a href="<?php echo $link_detail;?>"><strong><?php echo $value["title"]?></strong></a><br>

                                <span class="cl999">
                                <?php echo Common::format_price($value["download"])?> lượt tải. 
                                <?php echo isset($value["percent_wapmaster"]) ? $value["percent_wapmaster"] : $data_rate["rate_of_user"]?>% chia sẻ
                                </span>
                            </td>
                        </tr>   
                        <?php }?>                        
                    </tbody>
                </table>
                <div><span class="view_more"><a href="<?php echo Url::createUrl("kktUser/listData",array("typeCat"=>1,"alias"=>"game-offline"))?>" class="clwhite">+ Xem thêm</a></span></div>
            </div>
        </div>
        
        <div class="top_sell">
            <h2 class="bg_green"><strong>Video hot</strong></h2>
            <div class="table list_table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php 

                        foreach($data_video as $key=>$value){
                            $link_detail = Url::createUrl("kktUser/dataDetail",array("alias"=>$value["alias"],"typeCat"=>2,"id"=>$value["id"]));
                            $link_img=Common::getImage($value['picture'],"video",$value['create_date'],'m');
                            $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
                        ?>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo $link_detail;?>">
                                    <img class="img52" src="<?php echo $link_img;?>">
                                </a>
                            </td>
                            <td valign="top" class="item_data">
                                <a href="<?php echo $link_detail;?>"><strong><?php echo $value["title"]?></strong></a><br>

                                <span class="cl999">
                                <?php echo Common::format_price($value["download"])?> lượt tải. 
                                <?php echo isset($value["percent_wapmaster"]) ? $value["percent_wapmaster"] : $data_rate["rate_of_user"]?>% chia sẻ
                                </span>
                            </td>
                        </tr>   
                        <?php }?>                        
                    </tbody>
                </table>
                <div><span class="view_more"><a href="<?php echo Url::createUrl("kktUser/listData",array("typeCat"=>2,"alias"=>"video"))?>" class="clwhite">+ Xem thêm</a></span></div>
            </div>
        </div>
        
        <div class="top_sell">
            <h2 class="bg_green"><strong>Album hot</strong></h2>
            <div class="table list_table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php 

                        foreach($data_album as $key=>$value){
                            $link_detail = Url::createUrl("kktUser/dataDetail",array("alias"=>$value["alias"],"typeCat"=>3,"id"=>$value["id"]));
                            $link_img=Common::getImage($value['picture'],"image",$value['create_date'],'m');
                            $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
                        ?>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo $link_detail;?>">
                                    <img class="img52" src="<?php echo $link_img;?>">
                                </a>
                            </td>
                            <td valign="top" class="item_data">
                                <a href="<?php echo $link_detail;?>"><strong><?php echo $value["title"]?></strong></a><br>

                                <span class="cl999">
                                <?php echo Common::format_price($value["download"])?> lượt tải. 
                                <?php echo isset($value["percent_wapmaster"]) ? $value["percent_wapmaster"] : $data_rate["rate_of_user"]?>% chia sẻ
                                </span>
                            </td>
                        </tr>   
                        <?php }?>                        
                    </tbody>
                </table>
                <div><span class="view_more"><a href="<?php echo Url::createUrl("kktUser/listData",array("typeCat"=>3,"alias"=>"hinh-anh"))?>" class="clwhite">+ Xem thêm</a></span></div>
            </div>
        </div>
        <?php if(!empty($myAdv)) { ?>
            <div class="clip_vewing bottom10">
                <h2 class="bg_green"><strong>Quảng cáo của tôi</strong></h2>
                <div class="table list_table">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <?php foreach($myAdv as $row): ?>
                                <tr>
                                    <td width="52">
                                        <a title="pic" href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>">
                                            <img class="img52" src="<?php echo Common::getImage($row["picture"], "user/" . $row["username"] ."/picture", $row["create_date"], "");?>" />
                                        </a>
                                    </td>
                                    <td class="item_data" valign="top">
                                        <a href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>" class="ic_video">
                                            <strong><?php echo $row["title"];?></strong>
                                        </a>&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:" rel="nofollow" onclick="deleteMyAdv(<?php echo $row["id"];?>, <?php echo $row["userId"];?>);">Xóa</a>
                                        <br />
                                        <span class="cl999"><?php echo Common::format_price($row["download"]);?> lượt tải</span><br />
                                        <a class="sal_now clorage" href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>">Bán ngay</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>                        
                        </tbody>
                    </table>
                    <!--<div class="pages pad10">
                    <a href="#">« Trước</a>&nbsp;|&nbsp;<span>Trang 1 trong 769</span>&nbsp;|&nbsp;<a href="#">Sau »</a>
                    </div>-->
                </div>
            </div>
            <?php } ?>                    
    </div>
</div> 