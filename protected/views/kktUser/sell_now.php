<?php
    $domains = ShopDomain::getDomainByUser($_SESSION["userId"]) ;
    if($domains){
        $domain = $domains[0]["domain"];
    }else{
        $domain = $_SESSION["username"].'.'.Yii::app()->params["domain_member"];
    }
    /*$array_input=array('username'=>$domain,'active'=>1,'isBan'=>0);
    $check=Member::getMember($array_input);
    if(!$check)
    {
        header("Location:".Yii::app()->params['base_url']);
        exit();
    }*/
?>
<div class="container">
    <div class="main clearfix">
        <div class="box pad10">
            <div class="table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo Url::createUrl("kktUser/sellNow", array("id"=>$app["id"]));?>">
                                    <img class="img52" src="<?php echo Common::getImage($app["picture"], "app", "", "");?>" /> 
                                </a>
                            </td>
                            <td class="item_data" valign="top">
                                <a href="<?php echo Url::createUrl("kktUser/sellNow", array("id"=>$app["id"]));?>"><strong><?php echo $app["title"];?></strong></a><br />
                                <span class="cl999"><?php echo Common::format_price($app["download"]);?> lượt tải</span><br />                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="link_adv">
                <span>
                    <?php
                        $link_download = "http://" . $domain . Url::createUrl("kktDownload/app", array("alias"=>$app["alias"], "id"=>$app["id"]));
                        $user_domain = "http://" . $domain;
                    ?>
                    Link quảng cáo của bạn: 
                    <a class="clorage" href="<?php echo $link_download;?>">
                        <strong><?php echo $link_download;?></strong>
                    </a>
                </span>
            </div>
            <div class="mag_btt_t5">
                <span> <strong>Mã nhúng trên wapsite:</strong></span><br />
                <textarea onclick="javascript:select();" style="width: 80%; min-height:50px" readonly><div style="text-align: center;"><a href="<?php echo $link_download;?>"> <?php echo $app["title"];?> </a></div></textarea>                        
            </div>
            <div class="mag_btt_t5">
                <span>
                    Box di động của bạn: 
                    <a class="clorage" href="<?php echo $user_domain;?>"><strong><?php echo $user_domain;?></strong></a>
                </span><br />
                <?php 

                ?>
                <span> <strong>Mã nhúng Box vào wapsite:</strong></span><br />
                <textarea onclick="javascript:select();" style="width: 80%; min-height:50px"><div style="text-align: center;"><a href="<?php echo $user_domain;?>"><img border=0 src="<?php echo Yii::app()->params["static_url"];?>images/banner.gif" title="Games cực đỉnh trên di động. TẢI NGAY MIỄN PHÍ!!!"></a><br /><a href="<?php echo $user_domain;?>">Games cực đỉnh trên di động. TẢI NGAY MIỄN PHÍ!!!</a></div></textarea>                        
            </div>
            <div class="mag_btt_t5">
                <span class="clred">- <?php echo Yii::app()->params["domain"]; ?> đã tự động gắn mã refcode của bạn trong ứng dụng, trên cơ sở đó tính tiền tin nhắn cho bạn.</span><br />
                <span class="clred">- Chúng tôi sẽ phạt toàn bộ doanh thu nếu bạn quảng bá bằng cách SPAM.</span>
            </div>                               
        </div>
        <div class="box_chat pad10">
            <h2 class="bg_green"><strong>Chia sẻ link</strong></h2>
            <div class="box">
                <ul class="list_style">
                    <?php foreach($share as $i=>$row): ?>
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
                        <input type="submit" value="Gửi chia sẻ" class="bt_blue">                    
                    </form>
                </div>
            </div>
        </div>        
    </div>
</div>