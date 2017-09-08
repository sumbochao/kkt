<div class="container">
    <div class="main clearfix">        
        <div class="money_day pad_btt5">
            <h2 class="clorage"><strong>Hệ thống của chúng tôi</strong></h2>
            <div class="box bor_top">               
                <div class="reven_live cl333">
                    <span>- Tổng số thành viên: <em class="clorage"><?php echo Common::format_price($totalUser);?></em></span><br />
                    <!--<span>- Số SMS trong ngày: <em class="clorage"><?php //echo Common::format_price($total_sms);?> - <?php //echo Common::format_price(round($total_sms_of_user));?> đ</em> </span><br />
                    <span>- Số Card trong ngày: <em class="clorage"><?php //echo Common::format_price($total_card);?> - <?php //echo Common::format_price(round($total_card_of_user));?> VNĐ</em> </span><br />                    
                    <a href="<?php echo Url::createUrl("kktUser/reportAll");?>" class="bt_blue">» Chi tiết</a> -->
                </div>
            </div>
        </div>
        <div class="news pad10 bg_orage2">
            <?php 
                foreach($tips as $row): 
                ?>
                <a href="<?php echo $row["url"];?>"><span><?php echo $row["title"];?></span></a><br />
                <?php endforeach; ?>            
        </div>

        <div class="box_chat pad10">
            <h2 class="bg_green"><strong>Ai đang nói gì?</strong></h2>
            <div class="box">
                <ul class="list_style">
                    <?php foreach($chat as $i=>$row): ?>
                        <li <?php if($i%2==1){?>class="bg_gray"<?php }?>>
                            <a href="<?php echo "http://" .  $row["username"] . ".".Yii::app()->params["domain"];?>" class="clgreen"><strong><?php echo $row["username"];?></strong></a> 
                            <?php echo CHtml::encode($row["content"]);?> <br />
                            <span class="ifo_other cl999"><?php echo Common::genDate($row["create_date"]);?></span>
                        </li>
                        <?php endforeach;?>                
                </ul>

                <div class="status_box pad10 bg_gray">
                    <form action="" method="POST">
                        <textarea class="txt_area" name="content" maxlength="255" style="width: 99%; min-height:50px;margin-bottom:3px"></textarea><br />
                        <input type="submit" value="Gửi" class="bt_blue">                    
                    </form>
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
    </div>    
</div>