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
        
        <div class="creat_clip">
            <h2 class="bg_green"><strong>Tạo Box quảng cáo của riêng Bạn</strong></h2>
            <div class="box pad10">
                <form action="" method="POST" enctype="multipart/form-data">
                    <ul class="list_style">
                        <?php if(!empty($error)) { ?>
                        <li class="clearfix">
                            <label>&nbsp;</label>
                            <div class="fl clearfix" style="color: red;">
                                <?php echo $error;?>
                            </div>
                        </li>
                        <?php } ?>
                        
                        <li class="clearfix">
                            <label>Tiêu đề: </label>
                            <span><input type="text" style="width:80%" name="title" value="<?php if(isset($data["title"])) echo $data["title"];?>"></span>
                        </li>
                        <li class="clearfix">
                            <label class="fl">Chọn ứng dụng:</label>
                            <div class="fl clearfix">
                                <span class="fl">
                                    <input type="radio" name="type" value="1" <?php if(isset($data["type"]) && $data["type"]=="1") echo "checked";?> />Game
                                </span>                                
                                <span class="fl">
                                    <input type="radio" name="type" value="2" <?php if(isset($data["type"]) && $data["type"]=="2") echo "checked";?> />Video
                                </span>
                                <span class="fl">
                                    <input type="radio" name="type" value="3" <?php if(isset($data["type"]) && $data["type"]=="3") echo "checked";?> />Image
                                </span>                                
                            </div>
                        </li>
                        <li class="clearfix"><label>Ảnh minh họa:</label>
                            <span>
                                <input type="file" name="picture" class="file_1" style="height: 24px; width: 206px; display: inline; cursor: pointer">
                            </span>
                        </li>
                        <li>
                            <label></label>
                            <span><input type="submit" class="bt_orage" value="Tạo clip box"></span>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>        
</div> 