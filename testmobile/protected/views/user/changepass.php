
<?php
    $url = new Url();
?>

<script type="text/javascript">
    function changePass(){
        var url = "<?=$url->createUrl('user/changepass');?>";
        var password = $('#password').val();
        var new_password = $('#new_password').val();
        var confirm = $('#confirm').val();
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                password: password,
                new_password: new_password,
                confirm: confirm,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Bạn đổi mật khẩu thành công');
                    window.location = "<?php echo Yii::app()->createUrl('user/index')?>";
                }
                else{
                    $('#error').html(msg);
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
        Thay đổi mật khẩu
    </div>
    <div class="SM">
        <a href="<?php echo Yii::app()->createUrl('user/changeinfo');?>" class="button_KQ_2">Cập nhật thông tin</a>
        &nbsp;&nbsp;
        <a href="<?php echo Yii::app()->createUrl('user/changepass');?>" class="button_KQ_2">Thay đổi mật khẩu</a>
        </br>
        </br>
        <div class="SM">
            <div>
                Username:<?php echo $_SESSION['username'];?>
            </div>
            </br>
            <div class="searchSM">
                <input id="password" type="text" placeholder="Mật Khẩu Cũ" size="5" maxlength="100" class="boxsearchSM"/>
            </div>
            </br>
            <div class="searchSM">
                <input id="new_password" type="text" placeholder="Mật Khẩu Mới" size="5" maxlength="100" class="boxsearchSM"/>
            </div>
            </br>
            <div class="searchSM">
                <input id="confirm" type="text" placeholder="Xác Nhận Mật Khẩu" size="5" maxlength="100" class="boxsearchSM"/>
            </div>
            </br>
            <span class="error" id="error"></span>
            </br>
            <center>
                <div style="margin:20px 0 20px 0;">
                    <a href="javascript:void(0);" onclick="changePass();" class="button_KQ_1">Đổi mật khẩu</a>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0);" onclick="" class="button_KQ_2">Quay lại</a>
                </div>
            </center>
        </div>
    </div>
</div>