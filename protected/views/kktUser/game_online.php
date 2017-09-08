<div class="container">
    <div class="main clearfix">
        <?php if(!empty($game_new)) { ?>
        <div class="news pad10 bg_orage2 mag_top5">
            <?php 
                $url_file = Url::createUrl("kktDownload/hotHome",array("type"=>1, "alias"=>Common::generate_slug($game_new["title"])));
            ?>
            <span class="s14">
                Game mới: 
                <a href="<?php echo $url_file;?>" class="clorage">
                    <strong><?php echo $game_new["title"];?></strong>
                </a> 
                <img src="<?php echo Yii::app()->params["static_url"];?>images/icon_new2.png" alt="icon new" />
            </span> <br />
        </div>
        <?php }?>
        <div class="can_like">
            <h2 class="bg_green"><strong>Ứng dụng phân phối</strong></h2>
            <div class="table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <?php 
                        foreach($game as $row): 
                            $url = Url::createUrl("kktUser/sellNowGame", array("id"=>$row["id"]));
                        ?>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo $url;?>">
                                    <img class="img52" src="<?php echo Common::getImage($row["picture"], "game", $row["create_date"], "");?>" />
                                </a>
                            </td>
                            <td class="item_data" valign="top">
                                <a href="<?php echo $url;?>">
                                    <strong><?php echo $row["title"];?></strong>
                                </a><br />
                                <span class="cl999"><?php echo Common::format_price($row["download"]);?> lượt tải</span> - 
                                <span class="cl999"><?php echo $row["percent_partner"].'% chia sẻ'?></span><br />
                                <a href="<?php echo $url;?>" class="sal_now clorage">Bán ngay</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>                        
                    </tbody>
                </table>
            </div>            
        </div> 
                       
        <div class="info_text">
            <h2 class="bg_green"><strong>Tiện ích</strong></h2>
            <div class="list_item pad10">
                <ul class="list_style">
                    
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/boxAdv");?>"><strong>Nhúng Box quảng cáo</strong></a>
                    </li>
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/myAdv");?>"><strong>Tạo Box quảng cáo riêng</strong></a>
                    </li>
                    <li class="pad_btt5">
                        <a target="_blank" href="http://clix.so/"><strong>Rút gọn link</strong></a>
                    </li>                                        
                </ul>
            </div>
        </div>
    </div>
</div>