
<?php
    $url = new Url();
?>

<?php for($i=0;$i<count($data);$i++){?>
    <?php $avatar = User_veso::getAvatarUser($data[$i]['id_user']);?>
    <div class="comment_HOT_1">
        <div class="img_USER">
            <img src="<?php echo Yii::app()->params['urlImages'];?>user/<?php echo date('Y/md',strtotime($avatar['create_date']));?>/<?php echo $avatar['avatar_url'];?>" width="50" height="50" />
        </div>
        <div class="comment_USER">
            <div class="name_USER"><?php echo $data[$i]['create_user'];?></div>
            <div class="content_USER"><?php echo $data[$i]['comment'];?></div>
            <div class="time_textCHAT"><?php echo $data[$i]['create_date'];?></div>
        </div>
        <div class="both"></div>
    </div>
    <?php }?>

<div class="trangSM">
    Trang
    <?php
        $link = 'user/detail';
        $pageing = "";
        $pageing = Common::pageDetail($total_page,$page,$link,$id_thread);
        echo $pageing;
    ?>
</div>