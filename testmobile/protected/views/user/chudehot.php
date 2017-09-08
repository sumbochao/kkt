
<?php
    $url = new Url();
?>

<script type="text/javascript">
    loadBoxNote();
    
    function loadBoxNote()
    {
        var url = "<?=$url->createUrl('home/boxnote'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{},
            success: function(msg){
                $("#boxnote").html(msg);
            }
        });
    }
</script>

<div class="bg_white shadow m-t-10">
    <div class="Note" id="boxnote"></div>
</div>

<div class="bg_white shadow m-t-10">
    <div class="titleLMT">
        Chủ đề hot
    </div>

    <div class="SM">

        <?php for($i=0;$i<count($data);$i++){?>
            <div class="HOT">  
                <div class="img_HOT">
                    <img width="90%" src="<?php echo $data[$i]['image_100']?>"/>
                </div>
                <div class="title_HOT">
                    <a class="color_HOT" href="<?php echo Yii::app()->createUrl('user/detail',array('id'=>$data[$i]['id']))?>">
                        <?php echo $data[$i]['title'];?> 
                    </a>
                </div>
                <div class="descrip_HOT">
                    <?php echo $data[$i]['description'];?> 
                </div>
                <div class="like_HOT">
                    <a href="javascript:void(0);" class="button_KQ_2" style="display: inline-block;">Like</a>
                    <a href="javascript:void(0);" class="button_KQ_2" style="display: inline-block;">Share</a>
                    <!--<a href="<?php echo Yii::app()->createUrl('user/detail',array('id'=>$data[$i]['id']))?>" class="button_KQ_2" style="display: inline-block;">Comment(100)</a>-->
                </div>

                <?php for($j=0;$j<count($comment[$i]);$j++){?>
                    <?php $avatar = User_veso::getAvatarUser($comment[$i][$j]['id_user']);?>
                    <div class="comment_HOT">
                        <div class="img_USER">
                            <img src="<?php echo Yii::app()->params['urlImages'];?>user/<?php echo date('Y/md',strtotime($avatar['create_date']));?>/<?php echo $avatar['avatar_url'];?>" width="50" height="50" />
                        </div>
                        <div class="comment_USER">
                            <div class="name_USER"><?php echo $comment[$i][$j]['create_user'];?></div>
                            <div class="content_USER"><?php echo $comment[$i][$j]['comment'];?></div>
                            <div class="time_textCHAT"><?php echo $comment[$i][$j]['create_date'];?></div>
                        </div>
                    </div>
                    <?php }?>

                <div class="both"></div>
            </div>

            <div class="lineTK"></div> 
            <?php }?> 

        <!--<div class="trangSM">
            <form action="<?php //echo Yii::app()->createUrl('user/chudehot');?>" method="post">
                Trang 
                <input type="text" value="<?php //echo $page;?>" id="paging" name="page" style="width:20px; text-align: right;">
                trong
                <?php //echo $total_page;?>
                <input type="submit" class="button_KQ" value="Đến">
            </form>
        </div>-->
        
        <div class="trangSM">
            Trang
            <?php
                $link = 'user/chudehot';
                $pageing = "";
                $pageing = Common::pageHot($total_page,$page,$link);
                echo $pageing;
            ?>
        </div> 

    </div>

</div>
