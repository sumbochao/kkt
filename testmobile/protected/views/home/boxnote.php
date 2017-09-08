

<script type="text/javascript" src="<?php echo Yii::app()->params['static_url']?>js/jquery.cycle.all.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $('#slideshow').cycle({
            timeout: 3000, 
            cleartype: 1, 
            speed: 400,
            after: function (){
                $(this).parent().css("width", $(this).width());
            },
        });
    });


    //$('.feed').find("span").animate({opacity:0})
    //        .queue(function(){$(this).text("<?php //echo $data['title']; ?>"); $(this).dequeue()})
    //        .animate({opacity:1});

</script>

<div id="slideshow" style="width: 500px;">

    <?php for($i=0;$i<count($data);$i++){?>
        <div class="feed">
            <a href="<?php echo $data[$i]['url'];?>" >
                <img src="<?php echo $data[$i]['image'];?>" class="img_Note" alt="Note">
                <span class="content_Note"><?php echo $data[$i]['title'];?></span>
            </a>
        </div>
        <?php }?>

</div>