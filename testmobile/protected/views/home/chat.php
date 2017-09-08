


<?php for($i=0;$i<count($data);$i++){?>
<div class="userCHAT">
    <div class="avataCHAT">
        <img src="<?php echo $data[$i]['avatar_url'];?>" width="44" height="44" />
    </div>
    <div class="textCHAT">
        <div class="iconCHAT">
            <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-arrows3.png" width="7" height="14" /> 
        </div>
        <div class="box_textCHAT">
            <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-CHAT.png" width="22" height="22" class="img_textCHAT" /> 
            <span class="name_USER"><?php echo $data[$i]['username'];?>:</span>
            <p><?php echo $data[$i]['content'];?> </p>
            <!--<div class="reply_textCHAT">
                <strong>@Hoàng Nam:</strong> Hôm nay về con gì ý nhỉ?
            </div>-->
            <span class="time_textCHAT">
                <?php echo $data[$i]['createtime']?> 
            </span>
        </div>
    </div>
    <div class="both"></div>
</div>
<?php }?> 
