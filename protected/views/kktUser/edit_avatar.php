<div class="container">
    <div class="main clearfix">
       
        <div class="creat_clip">
            <h2 class="bg_green"><strong>Sửa avatar</strong></h2>
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
                            <span>
                            <?php if($info["avatar_url"] !=""){?>
                            <img src="<?php echo Yii::app()->params["urlImages"].'/avatar/'.$info["avatar_url"]?>" alt="" style="width: 50px; height: 50px;"/>
                            <?php }?>
                            </span>
                        </li>

                        <li class="clearfix"><label>Chọn avatar:</label>
                            <span>
                                <input type="file" name="avatar_url" class="file_1" style="height: 24px; width: 206px; display: inline; cursor: pointer">
                            </span>
                        </li>
                        <li>
                            <label></label>
                            <span><input type="submit" class="bt_orage" value="Up avatar"></span>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>        
</div> 