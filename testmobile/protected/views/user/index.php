
<?php
    $url = new Url();
?>

<script type="text/javascript">

    function login(){
        var url = "<?=$url->createUrl('user/index');?>";
        var username = $('#username').val();
        var password = $('#password').val();
        var remember = $('#remember').prop('checked');
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                username: username,
                password: password,
                remember: remember,
            },
            success: function(msg){
                if(msg==1){
                    alert('Đăng nhập thành công');
                    window.location = "<?php echo Yii::app()->createUrl('home/index');?>";
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
        Đăng nhập
    </div>
    <div class="SM">
        <div class="searchSM">
            <input id="username" name="a" value="<?php if($username!=""){echo $username;}?>" type="text" placeholder="Tên Đăng Nhập" size="5" maxlength="100" class="boxsearchSM"/>
        </div>
        </br>
        <div class="searchSM">
            <input id="password" name="a" value="<?php if($username!=""){echo $password;}?>" type="password" placeholder="Mật Khẩu" size="5" maxlength="100" class="boxsearchSM"/>

        </div>
        </br>
        <div class="searchSM">
            <input id="remember" <?php if($username!=""){echo "checked='checked'";}?> type="checkbox"><span style="font-size: 12px;">Ghi nhớ mật khẩu</span>
            </br>
            <span class="error" id="error"></span>
        </div>
        <center>
            <div style="margin:20px 0 20px 0;">
                <a href="javascript:void(0);" onclick="login();" class="button_KQ_1">Đăng Nhập</a>
                &nbsp;&nbsp;
                <a href="javascript:void(0);" onclick="" class="button_KQ_2">Đăng Ký</a>
            </div>
        </center>
    </div>
</div>