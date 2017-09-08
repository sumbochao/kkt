<?php
    $url = new Url();
?>

<script type="text/javascript">

    $(document).ready(function(){

        setInterval(function(){
            loadComment();
        },5000);

    });

    loadComment();

    function loadComment()
    {
        var url = "<?=$url->createUrl('user/comment');?>";
        var id_thread = "<?php echo $id;?>";
        var page = "<?php echo $page;?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                id_thread: id_thread,
                page: page,
            },
            success: function(msg){
                $('#box_comment').html(msg);
            }
        });
    }

    function comment(){
        var url = "<?=$url->createUrl('user/comment');?>";
        var comment = $('#comment').val();
        var id_thread = "<?php echo $id;?>";
        var page = "<?php echo $page;?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                comment: comment,
                id_thread: id_thread,
                page: page,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Bạn phải đăng nhập để bình luận');
                }else{
                    $('#box_comment').html(msg);
                    $('#comment').val("");
                }
            }
        });
    }

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
        Chủ Đề Hot
    </div>

    <div class="SM">
        <div class="HOT">  
            <div class="img_HOT">
                <img width="90%" src="<?php echo $data['image_100']?>"/>
            </div>
            <div class="title_HOT">
                <?php echo $data['title'];?>
            </div>
            <div class="descrip_HOT">
                <?php echo $data['description'];?>
            </div>
            <div class="like_HOT">
                <a class="button_KQ_2">Like</a>
                <a class="button_KQ_2">Share</a>
                <!--<a class="button_KQ_2">Comment(100)</a>-->
            </div>
            <div class="both"></div>
        </div>
        <div class="box_comment" id="box_comment">

        </div>

        <div class="searchSM">
            </br>
            </br>
            <input id="comment" class="boxsearchSM" type="text" maxlength="100" size="5" placeholder="Nhập nội dung thảo luận" name="a">
            </br>
            </br>
            <a class="buttonsearchSMS" onclick="comment();" href="javascript:void(0);" style="text-align: center;">Send</a>
        </div>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
    </div>

</div>