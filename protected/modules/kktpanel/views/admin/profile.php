<?php $url = new Url();?>
<div class="main clearfix">
    <h5>User login: <span class="clred"><?=$data_admin["username"] ?></span></h5>
    <div class="box">
        <p><strong>Thay password:</strong></p>
        <ul class="form">
            <li class="clearfix">
                <label>Old password: </label>
                <div class="filltext">
                    <input type="password" name="old_pass" id="old_pass" style="width:20%" value="">
                </div>
            </li>
            <li class="clearfix">
                <label>New password:</label>
                <div class="filltext">
                    <input type="password" name="new_pass" id="new_pass" style="width:20%" value="">
                </div>
            </li>
            <li class="clearfix">
                <label>Confirm New password: </label>
                <div class="filltext">
                    <input type="password" name="re_pass" id="re_pass" style="width:20%" value="">
                </div>
            </li>
            <li class="clearfix">
                <label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" onclick="ajaxChangePass();" type="button" value="   Save  " class="btn-gray">
                </div>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function check_editemail(mail) {
        emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
        if (emailRegExp.test(mail)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    function ajaxChangePass(){
        var old_pass = $("#old_pass").val();
        var new_pass = $("#new_pass").val();
        var re_pass = $("#re_pass").val();
        var strUrl = '<?=$url->createUrl("admin/ajaxChangePass")?>';
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {old_pass:old_pass,new_pass:new_pass,re_pass:re_pass},
            success: function(msg){
                if(msg == 1){
                    alert('Thay đổi thành công');
                    window.location = '<?php echo $url->createUrl("home/index")?>';
                }else{
                    alert(msg);
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