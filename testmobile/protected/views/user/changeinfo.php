
<?php
    $url = new Url();
?>

<script type="text/javascript">

    $(document).ready(function(){

        $('#avabongda').click(function(){
            $('#bongda').slideToggle('slow');
            $('#baby').slideUp('slow');
            $('#emotion').slideUp('slow');
            $('#hoangdao').slideUp('slow');
        });

        $('#avababy').click(function(){
            $('#bongda').slideUp('slow');
            $('#baby').slideToggle('slow');
            $('#emotion').slideUp('slow');
            $('#hoangdao').slideUp('slow');
        });

        $('#avaemotion').click(function(){
            $('#bongda').slideUp('slow');
            $('#baby').slideUp('slow');
            $('#emotion').slideToggle('slow');
            $('#hoangdao').slideUp('slow');
        });

        $('#avahoangdao').click(function(){
            $('#bongda').slideUp('slow');
            $('#baby').slideUp('slow');
            $('#emotion').slideUp('slow');
            $('#hoangdao').slideToggle('slow');
        });

    });
    
    function changeInfo(){
        var url = "<?=$url->createUrl('user/changeinfo');?>";
        var mobile = $('#mobile').val();
        var picture = $('#picture').val();
        if($('#default1').prop('checked')==true){
            var radio = 'logo_avatar_acmilan.png';
        }
        if($('#default2').prop('checked')==true){
            var radio = 'logo_avatar_ars.png';
        }
        if($('#default3').prop('checked')==true){
            var radio = 'logo_avatar_barce.png';
        }
        if($('#default4').prop('checked')==true){
            var radio = 'logo_avatar_bayern.png';
        }
        if($('#default5').prop('checked')==true){
            var radio = 'logo_avatar_chese.png';
        }
        if($('#default6').prop('checked')==true){
            var radio = 'logo_avatar_real.png';
        }
        if($('#default7').prop('checked')==true){
            var radio = 'logo_avatar_mu.png';
        }
        if($('#default8').prop('checked')==true){
            var radio = 'logo_baby1.png';
        }
        if($('#default9').prop('checked')==true){
            var radio = 'logo_baby2.png';
        }
        if($('#default10').prop('checked')==true){
            var radio = 'logo_baby3.png';
        }
        if($('#default11').prop('checked')==true){
            var radio = 'logo_baby4.png';
        }
        if($('#default12').prop('checked')==true){
            var radio = 'logo_baby5.png';
        }
        if($('#default13').prop('checked')==true){
            var radio = 'logo_baby6.png';
        }
        if($('#default14').prop('checked')==true){
            var radio = 'logo_baby7.png';
        }
        if($('#default15').prop('checked')==true){
            var radio = 'logo_baby8.png';
        }
        if($('#default16').prop('checked')==true){
            var radio = 'logo_baby9.png';
        }
        if($('#default17').prop('checked')==true){
            var radio = 'logo_baby10.png';
        }
        if($('#default18').prop('checked')==true){
            var radio = 'logo_avatar_emotion1.png';
        }
        if($('#default19').prop('checked')==true){
            var radio = 'logo_avatar_emotion2.png';
        }
        if($('#default20').prop('checked')==true){
            var radio = 'logo_avatar_emotion3.png';
        }
        if($('#default21').prop('checked')==true){
            var radio = 'logo_avatar_emotion4.png';
        }
        if($('#default22').prop('checked')==true){
            var radio = 'logo_avatar_emotion5.png';
        }
        if($('#default23').prop('checked')==true){
            var radio = 'logo_avatar_emotion6.png';
        }
        if($('#default24').prop('checked')==true){
            var radio = 'logo_avatar_emotion7.png';
        }
        if($('#default25').prop('checked')==true){
            var radio = 'logo_avatar_emotion8.png';
        }
        if($('#default26').prop('checked')==true){
            var radio = 'logo_cunghoangdao1.png';
        }
        if($('#default27').prop('checked')==true){
            var radio = 'logo_cunghoangdao2.png';
        }
        if($('#default28').prop('checked')==true){
            var radio = 'logo_cunghoangdao3.png';
        }
        if($('#default29').prop('checked')==true){
            var radio = 'logo_cunghoangdao4.png';
        }
        if($('#default30').prop('checked')==true){
            var radio = 'logo_cunghoangdao5.png';
        }
        if($('#default31').prop('checked')==true){
            var radio = 'logo_cunghoangdao6.png';
        }
        if($('#default32').prop('checked')==true){
            var radio = 'logo_cunghoangdao7.png';
        }
        if($('#default33').prop('checked')==true){
            var radio = 'logo_cunghoangdao8.png';
        }
        if($('#default34').prop('checked')==true){
            var radio = 'logo_cunghoangdao9.png';
        }
        if($('#default35').prop('checked')==true){
            var radio = 'logo_cunghoangdao10.png';
        }
        if($('#default36').prop('checked')==true){
            var radio = 'logo_cunghoangdao11.png';
        }
        if($('#default37').prop('checked')==true){
            var radio = 'logo_cunghoangdao12.png';
        }
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                mobile: mobile,
                picture: picture,
                radio: radio,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Bạn đã sửa thông tin thành công');
                    window.location = "<?php echo Yii::app()->createUrl('home/index')?>";
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
                <input id="mobile" type="text" placeholder="Số Điện Thoại" size="5" maxlength="100" class="boxsearchSM"/>
            </div>
            </br>

            <a href="javascript:void(0);" id="avabongda" class="button_KQ_2">Avatar Bóng đá</a>
            </br>
            </br>
            <div class="searchSM" id="bongda" style="display: none;">
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_acmilan.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default1" type="radio">Default 1
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_ars.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default2" type="radio">Default 2
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_barce.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default3" type="radio">Default 3
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_bayern.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default4" type="radio">Default 4
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_chese.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default5" type="radio">Default 5
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_real.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default6" type="radio">Default 6
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_mu.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default7" type="radio">Default 7
                </div>
            </div>
            <div class="both"></div>
            </br>


            <a href="javascript:void(0);" id="avababy" class="button_KQ_2">Avatar Baby</a>
            </br>
            </br>
            <div class="searchSM" id="baby" style="display: none;">
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby1.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default8" type="radio">Default 8
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby2.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default9" type="radio">Default 9
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby3.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default10" type="radio">Default 10
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby4.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default11" type="radio">Default 11
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby5.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default12" type="radio">Default 12
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby6.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default13" type="radio">Default 13
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby7.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default14" type="radio">Default 14
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby8.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default15" type="radio">Default 15
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby9.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default16" type="radio">Default 16
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_baby10.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default17" type="radio">Default 17
                </div>
            </div>
            <div class="both"></div>
            </br>



            <a href="javascript:void(0);" id="avaemotion" class="button_KQ_2">Avatar Emotion</a>
            </br>
            </br>
            <div class="searchSM" id="emotion" style="display: none;">
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion1.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default18" type="radio">Default 18
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion2.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default25" type="radio">Default 19
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion3.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default20" type="radio">Default 20
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion4.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default21" type="radio">Default 21
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion5.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default22" type="radio">Default 22
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion6.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default23" type="radio">Default 23
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion7.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default24" type="radio">Default 24
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_avatar_emotion8.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default25" type="radio">Default 25
                </div>
            </div>
            <div class="both"></div>
            </br>


            <a href="javascript:void(0);" id="avahoangdao" class="button_KQ_2">Avatar Cung Hoàng Đạo</a>
            </br>
            </br>
            <div class="searchSM" id="hoangdao" style="display: none;">
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao1.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default26" type="radio">Default 36
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao2.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default27" type="radio">Default 27
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao3.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default28" type="radio">Default 28
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao4.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default29" type="radio">Default 29
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao5.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default30" type="radio">Default 30
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao6.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default31" type="radio">Default 31
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao7.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default32" type="radio">Default 32
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao8.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default33" type="radio">Default 33
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao9.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default34" type="radio">Default 34
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao10.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default35" type="radio">Default 35
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao11.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default36" type="radio">Default 36
                </div>
                <div class="avaImage">
                    <img src="<?php echo Yii::app()->params['urlImages'];?>user/default/logo_cunghoangdao12.png" width="50" height="50" />
                    </br>
                    <input name="default" id="default37" type="radio">Default 37
                </div>
            </div>
            <div class="both"></div>
            </br>

            <span class="error" id="error"></span>
            </br>

            <center>
                <div style="margin:20px 0 20px 0;">
                    <a href="javascript:void(0);" onclick="changeInfo();" class="button_KQ_1">Đổi Thông Tin</a>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0);" onclick="" class="button_KQ_2">Quay lại</a>
                </div>
            </center>

        </div>
    </div>



</div>
