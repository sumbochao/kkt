<?php
    switch($typeCat){
        case 1:
            $title = "Game Offline";
            $alias = "game-offline";
            $forder = "game";
            break;
        case 2:
            $title = "Video hot";
            $alias = "video";
            $forder = "video";
            break;
        case 3:
            $title = "Ảnh hot";
            $alias = "hinh-anh";
            $forder = "image";
            break;
        default:
            $title = "";
            $alias = "";
            $forder = "";
            break;
    }
    $url=Url::createUrl('kktUser/listData',array('typeCat'=>$typeCat,"alias"=>$alias));
    $url1=$url;
    $url.='/';
    $paging=Paging::show_paging_wap($max_page,$page,$url,$url1);
?>
<div class="container">
    <div class="main clearfix">
        <div class="top_sell">
            <h2 class="bg_green">
                <strong>
                    <?php
                        echo $title;
                    ?>
                </strong>
            </h2>
            <div class="table list_table">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php 

                            foreach($data as $key=>$value){
                                $link_detail = Url::createUrl("kktUser/dataDetail",array("alias"=>$value["alias"],"typeCat"=>$typeCat,"id"=>$value["id"]));
                                $link_img=Common::getImage($value['picture'],$forder,$value['create_date'],'m');
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
            </div>
        </div>
        <div class="pages pad10 pad_top0">
            <?php
                echo $paging;
            ?>
        </div>
    </div>    
</div>
