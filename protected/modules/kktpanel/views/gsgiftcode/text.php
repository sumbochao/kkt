<?php
    $url = new Url(); 
    $forder_upload = "gamestore/giftcode";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    function ajaxText(){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxText')?>";
        var text = $('#text').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data:{
                text: text,
                id: '<?php echo $id?>',
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsgiftcode/code",array('id'=>$id))?>';
                }else{
                    alert('Có lỗi');
                    $("#show_error").html(msg);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(thrownError == "CDbException")
                {
                    $("#show_error").html('Dữ liệu đã tồn tại');
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled"); 
            } 
        });
    }
</script>

<div class="main clearfix">
    <div class="box clearfix bottom30"> 

        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Code </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="text"></textarea>
                    </div>
                </li>

                <li>
                    <label><strong>&nbsp; </strong></label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxText();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext" style="color: red;" id="show_error"></div>
                </li>
            </ul>
        </div>

    </div>
</div>
