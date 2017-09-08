<?php
    $url = new Url(); 
?>
<script type="text/javascript">
    function ajaxUpdateAccount(){
        var strUrl = "<?=$url->createUrl("fbaccount/ajaxUpdateAccount") ?>";
        var id = "<?php echo $id?>";
        var username = $("#username").val();
        var password = $("#password").val();
        var link = $("#link").val();
        var note = $("#note").val();
        var status = $("#status").val();
        var birthday = $("#birthday").val();
        var mobile = $("#mobile").val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id: id,
                username: username,
                password: password,
                link: link,
                note:note,
                birthday: birthday,
                mobile: mobile,
                status:status,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("fbaccount/index")?>';
                }else{
                    $("#show_error").html(msg);
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
    
        <div class="col-570">  
            <div class="box">
                <ul class="form">
                    <li class="clearfix"><label><strong>Tên User </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['username']?>" id="username"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Mật khẩu </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['password']?>" id="password"> 
                        </div>
                    </li>
                    
                     <li class="clearfix"><label><strong>Birthday </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['birthday']?>" name="birthday" id="birthday"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Mobile </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['mobile']?>" name="mobile" id="mobile"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Link </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['link']?>" id="link"> 
                        </div>
                    </li>
                    
                    <li ><label><strong>Note </strong>:</label>
                       
                            <textarea rows="15" cols="40" id="note"><?php echo $data['note']?></textarea> 
                       
                    </li>
                    
                     <li class="clearfix"><label><strong>Status </strong>:</label>
                        <div class="filltext">
                            <select name="status" id="status">
                                
                                <option value="0" <?php echo  $data["status"]==0?"selected":"" ?>>Live</option>
                                <option value="1" <?php echo  $data["status"]==1?"selected":"" ?>>Xác nhận bạn bè cấp 1</option>
                                <option value="2" <?php echo  $data["status"]==2?"selected":"" ?>>Xác nhận bạn bè câp 2</option>
                                <option value="3" <?php echo  $data["status"]==3?"selected":"" ?>>Xác nhận CMT</option>
                                <option value="4" <?php echo  $data["status"]==4?"selected":"" ?>>Khóa hoàn toàn</option>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxUpdateAccount();" type="button" value=" Thay đổi " class="btn-bigblue"> 
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
</div>
