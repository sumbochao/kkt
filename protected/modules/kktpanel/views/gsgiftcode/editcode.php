<?php
    $url = new Url(); 
    $forder_upload = "gamestore/giftcode";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<script type="text/javascript">
    function ajaxUpdateCode(){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxUpdateCode')?>";
        var code = $('#code').val();
        var user = $('#user').val();
        var status = $('#status').val();
        $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id: '<?php echo $id?>',
                    code: code,
                    user: user,
                    status: status,
                },
                success:function(msg){
                    if(msg == 1){
                        alert('Thay đổi thành công');
                        window.location = '<?php echo $url->createUrl("gsgiftcode/code",array('id'=>$giftcode_id))?>';
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">  

        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Tên Gift Code </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php $name=GGiftcode::getDataById($data['giftcode_id']);echo $name['title'];?>" id="title" readonly>  
                    </div>
                </li>

                <li class="clearfix"><label><strong>Code </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['code'] ?>" id="code"> 
                    </div>
                </li>
                
                <li class="clearfix"><label><strong>User </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php if(isset($data['user_id'])){ $user=GUser::getDataById($data['user_id']);echo $user['name'];}?>" id="user" readonly> 
                    </div>
                </li>
                
                <li class="clearfix"><label><strong>Trạng Thái </strong>:</label>
                    <div class="filltext">
                        <select id="status" style="width: 203px;">
                            <option value="1" <?php if($data['status']==1){echo 'selected="selected"';}?>>Active</option>
                            <option value="0" <?php if($data['status']==0){echo 'selected="selected"';}?>>Inactive</option>
                        </select>
                    </div>
                </li>

                <li>
                    <label><strong>&nbsp; </strong></label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxUpdateCode();" type="button" value=" Thay đổi " class="btn-bigblue"> 
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