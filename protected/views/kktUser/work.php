<div class="container">
    <div class="main clearfix">
        <!-- box top user -->
        <?php //$this->widget("BoxTopUser");?>
        <!-- end box top user -->
        
        <?php if(!empty($game)) { ?>
        <div class="news pad10 bg_orage2 mag_top5">
            <?php 
                $url_file = Url::createUrl("/kktDownload/hotHome",array("type"=>1, "alias"=>Common::generate_slug($game["title"])));
            ?>
            <span class="s14">
                Game mới: 
                <a href="<?php echo $url_file;?>" class="clorage">
                    <strong><?php echo $game["title"];?></strong>
                </a> 
                <img src="<?php echo Yii::app()->params["static_url"];?>images/icon_new2.png" alt="icon new" />
            </span> <br />
        </div>
        <?php }?>
        
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
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/domain")?>"><strong>Trỏ domain</strong></a>
                    </li> 
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/gaPage")?>"><strong>Đặt GA</strong></a>
                    </li>
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/seoPage")?>"><strong>SEO cho WAP</strong></a>
                    </li> 
                    <li class="pad_btt5">
                        <a href="<?php echo Url::createUrl("kktUser/invite");?>"><strong>Link giới thiệu</strong></a>
                    </li>                                       
                </ul>
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
    </div>    
</div>