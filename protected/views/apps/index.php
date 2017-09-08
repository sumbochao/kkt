<?php 
    $action = Yii::app()->controller->action->id;
    $url = new Url();
?>

<div class="main">
    <div class="item mag0">
        <div class="bg_blue">
            <ul class="list_style clearfix">
                <li class="fl active"><a class="active block" title="" href="<?php echo $url->createUrl("apps/index") ?>">App</a></li>
                <!--<li class="fl active"><a class="active block" title="" href="<?php echo $url->createUrl("game/index") ?>">Game</a></li>-->
            </ul>
        </div>
        <div class="bg_user pad-bt0">

        </div>
    </div>
    <div class="item pro-of-tv">



        <div class="list-game">
            <ul class="list_style">
                <li>
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <?php foreach($data as $key=>$value){?>
                                <tr>
                                    <td width="85">
                                        <a title="" href="#"><img width="85" src="<?php echo Common::getImage($value['picture'],"app",$value['create_date'],0); ?>"></a>
                                    </td>
                                    <td valign="top" class="info-data">
                                        <a class="data_link" title="" href="#"><?php echo $value['title'] ?></a>
                                        <p><span class="cl999">Version: </span><?php echo $value['version'] ?> </p>
                                        <p><span class="cl999">Giới thiệu: </span><?php echo $value['description'] ?> </p>
                                        <p>
                                            <span class="cl999"><strong>Link Down: </strong></span>
                                            <?php if(!empty($value['link_ios'])){
                                            $arr = explode(".",$value['link_ios']);
                                            $count = count($arr);
                                            if($arr[$count-1] =="plist"){
                                                $value['link_ios'] = "itms-services://?action=download-manifest&url=".$value['link_ios'];
                                            }
                                             ?>
                                            <span><a target="_blank" href="<?php echo $value['link_ios'] ?>"> IOS </a></span>&nbsp;|&nbsp;
                                            <?php }?>
                                            <?php if(!empty($value['link_android'])){ ?>
                                            <span><a target="_blank" href="<?php echo $value['link_android'] ?>"> Android </a></span>&nbsp;|&nbsp;
                                            <?php }?>
                                            <?php if(!empty($value['link_java'])){ ?>
                                            <span><a target="_blank" href="<?php echo $value['link_java'] ?>"> Java </a></span>
                                            <?php }?>
                                            <!--<span><a href="<?php echo $value['link_window'] ?>"> Window </a></span>|-->
                                        </p>
                                    </td>
                                </tr>
                                <?php }?>
                        </tbody>
                    </table>
                </li>
            </ul>
        </div>
        <div class="pad10">
            <ul class="paging clearfix">
                <?php echo $paging; ?>
            </ul>
        </div>
    </div>

</div>