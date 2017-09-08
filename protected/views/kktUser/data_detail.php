<?php
    $user_domain = "http://" . $_SESSION["username"] . ".".Yii::app()->params["domain_member"];
    $domains = ShopDomain::getDomainByUser($_SESSION["userId"]) ;
    if($domains){
        $domain = $domains[0]["domain"];
    }else{
        $domain = $_SESSION["username"].'.'.Yii::app()->params["domain_member"];
    }
    switch($typeCat){
        case 1: //game
            $forder = "game";
            $link_download = "http://". $_SERVER["HTTP_HOST"] . Url::createUrl("/kktDownload/downloadGame",array( "alias"=>$data_detail["alias"],"id"=>$data_detail["id"],"userId"=>$_SESSION["userId"]));
            $link_short = "http://". $_SERVER["HTTP_HOST"] . Url::createUrl("/kktDownload/downloadGame",array( "alias"=>"app","id"=>$data_detail["id"],"userId"=>$_SESSION["userId"]));
            break;
        case 2: //video
            $forder = "video";  
            $link_download = "http://" . $domain . Url::createUrl("/kktDownload/app", array("alias"=>$data_detail["alias"], "id"=>3));
            $link_short = "http://" . $domain . Url::createUrl("/kktDownload/app", array("alias"=>"app", "id"=>3));

            break;
        case 3: //image
            $link_download = "http://" . $domain . Url::createUrl("/kktDownload/app", array("alias"=>$data_detail["alias"], "id"=>2));
            $link_short = "http://" . $domain . Url::createUrl("/kktDownload/app", array("alias"=>"app", "id"=>2));
            $forder = "image";
            break;
        default:
            $forder = "";
            break;
    }
    $link_img=Common::getImage($data_detail['picture'],$forder,$data_detail['create_date'],'m');
    $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
?>
<div class="container">
    <div class="main clearfix">
        <div class="box pad10">
            <div class="table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo Common::getCurrentUrl();?>">
                                    <img class="img52" src="<?php echo $link_img;?>" onerror="this.src='<?php echo $img_error;?>'"/>
                                </a>
                            </td>
                            <td class="item_data" valign="top">
                                <a href="<?php echo Common::getCurrentUrl();?>"><strong><?php echo $data_detail['title'];?></strong></a><br />
                                <span class="cl999">
                                <?php echo Common::format_price($data_detail['download']);?> lượt tải
                                <span class="clred"><?php echo isset($data_detail["percent_wapmaster"]) ? $data_detail["percent_wapmaster"] : $data_rate["rate_of_user"]?>%</span> chia sẻ
                                </span>
                                <br />                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="link_adv">
                <span>
                    Link quảng cáo của bạn: 
                    <a class="clorage" href="<?php echo $link_download;?>">
                        <strong><?php echo $link_download;?></strong>
                    </a>
                </span>
            </div>
            <div class="link_adv">
                <span>
                    Link quảng cáo rút gọn: 
                    <a class="clorage" href="<?php echo $link_short;?>">
                        <strong><?php echo $link_short;?></strong>
                    </a>
                </span>
            </div>
            <div class="mag_btt_t5">
                <span> <strong>Mã nhúng trên wapsite:</strong></span><br />
                <textarea onclick="javascript:select();" style="width: 80%; min-height:50px" readonly><div style="text-align: center;"><a href="<?php echo $link_download;?>"> <?php echo $data_detail["title"];?> </a></div></textarea>                        
            </div>
            <div class="mag_btt_t5">
                <span>
                    Box di động của bạn: 
                    <a class="clorage" href="<?php echo 'http://'.$domain;?>"><strong><?php echo 'http://'.$domain;?></strong></a>
                </span><br />
                <?php 
                    
                ?>
                <span> <strong>Mã nhúng Box vào wapsite:</strong></span><br />
                <textarea onclick="javascript:select();" style="width: 80%; min-height:50px"><div style="text-align: center;"><a href="<?php echo $link_download;?>"><img border=0 src="<?php echo Yii::app()->params["static_url"];?>images/banner.gif" title="<?php echo htmlspecialchars($data_detail["title"])?>"></a><br /><a href="<?php echo $link_download;?>"><?php echo $data_detail["title"];?></a></div></textarea>                        
            </div>
            <div class="mag_btt_t5">
                <span class="clred">- <?php echo Yii::app()->params["domain"];?> đã tự động gắn mã refcode của bạn trong ứng dụng, trên cơ sở đó tính tiền tin nhắn cho bạn.</span><br />
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
