<div class="container">
    <div class="main clearfix">

        <?php if(!empty($game)) { ?>
            <div class="news pad10 bg_orage2 mag_top5">
                <?php 
                    $url_file = Url::createUrl("kktDownload/hotHome",array("type"=>1, "alias"=>Common::generate_slug($game["title"])));
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

        <?php 
            $user_domain = "http://" . $username . ".".Yii::app()->params["domain_member"];
        ?>
        <div class="emb_bann pad10">
            <div class="mag_btt_t5">
                <span>
                    Box di động của bạn: 
                    <a class="clorage" href="<?php echo $user_domain;?>"><strong><?php echo $user_domain;?></strong></a>
                </span><br />
                <span> <strong>320x50</strong></span><br />                     
            </div>
            <ul class="list_style">
                <?php foreach($boxAdv as $i=>$row) { ?>
                    <li <?php if($i%2==0){?>class="bg_gray"<?php } ?> >
                        <div align="center">
                            <a href="<?php echo $user_domain;?>">
                                <img alt="game hot" src="<?php echo Common::getImage($row["picture"], "banner", $row["create_date"], "");?>">
                            </a><br>
                            <a class="clblue" href="<?php echo $user_domain;?>"><?php echo $row["title"];?></a>
                        </div>
                        <div class="mag_btt_t5">
                            <span> <strong>Mã nhúng quảng cáo vào wapsite:</strong></span><br>
                            <textarea onclick="javascript:select();" readonly style="width: 100%; min-height:50px"><div style="text-align: center;"><a href="<?php echo $user_domain;?>"><img border=0 src="<?php echo Common::getImage($row["picture"], "banner", $row["create_date"], "");?>" title="<?php echo htmlspecialchars($row["title"]);?>"></a><br /><a href="<?php echo $user_domain;?>"><?php echo $row["title"];?></a></div></textarea>                        
                        </div>
                    </li>
                    <?php } ?>                
            </ul>
        </div>        
    </div>
</div>