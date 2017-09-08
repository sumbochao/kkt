<?php
    $url = new Url();
?>

<script type="text/javascript">

    var url = "/test/home/loadmiennam";
    loadKetquaMienNam(url);

    $(document).ready(function(){

        $('#miennam').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

        setInterval(function(){
            var t = new Date().getTime();
            var url = "/test/home/loadmiennam";
            loadKetquaMienNam(url);
            },3000);

    });

    function messenger(){
        var messenger = $('.From').val();
        var url = "<?=$url->createUrl('home/chat'); ?>";
        $.ajax({
            type: "GET",
            url: url,
            global: false,
            data: {
                messenger: messenger,
            },
            success: function(msg){
                if(msg==1){
                    alert('Bạn phải đăng nhập để tán gẫu');
                }
                if(msg==0){
                    alert('Bạn phải chưa nhập nội dung');
                }
                else
                {
                    $("#CHAT").html(msg);
                    $('.From').val('');
                }
            }
        });
    };

    function loadChat(url){
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{},
            success: function(msg){
                $("#CHAT").html(msg);
            }
        });
    }

    function loadKetquaMienNam(url){
        $.ajax({
            type: "GET",
            url: url,
            data:{},
            success:function(msg){
                $("#KQMN").html(msg);
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
    <div class="menuXS m-t-10">
        <ul>
            <li id="mienbac"><a href="<?php echo Yii::app()->createUrl('home/mienbac')?>">MIỀN BẮC</a></li>
            <li id="mientrung"><a href="<?php echo Yii::app()->createUrl('home/mientrung')?>">MIỀN TRUNG</a></li>
            <li id="miennam"><a href="<?php echo Yii::app()->createUrl('home/miennam')?>">MIỀN NAM</a></li>
            <li id="dientoan"><a href="<?php echo Yii::app()->createUrl('home/dientoan')?>">ĐIỆN TOÁN</a></li>
        </ul>
    </div>

    <div id="KQMN">
        <div class="titleXSMB">
            Tường thuật trực tiếp kết quả xổ số miền Nam ngày <span class="red"><?php echo date('d/m/Y'); ?></span>
        </div>

        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#c9c9c9">
            <tr class="XSMB_ngang_1 XSMB_ngang_xam">
                <td class="XSMN_1"><span class="red">Ngày</span></td>
                <td class="XSMN_2"><span class="red">Tỉnh</span></td>
                <td class="XSMN_2"><span class="red">Tỉnh</span></td>
                <td class="XSMN_2"><span class="red">Tỉnh</span></td>
            </tr>
            <tr class="XSMN_ngang">
                <td class="XSMN_1 bg_white">Giải tám</td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMN_1">Giải bảy</td>
                <td class="XSMN_2 fon16"> <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"> <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"> <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
            </tr>
            <tr class="XSMN_ngang">
                <td class="XSMN_1 bg_white">Giải sáu</td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMN_1">Giải năm</td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
            </tr>
            <tr class="XSMN_ngang">
                <td class="XSMN_1 bg_white">Giải tư</td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 bg_xam">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMN_1">Giải ba</td>
                <td class="XSMN_2 fon16">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 fon16">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
                <td class="XSMN_2 fon16">
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"><br />
                    <img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif">
                </td>
            </tr>
            <tr class="XSMN_ngang">
                <td class="XSMN_1 bg_white">Giải nhì</td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 bg_xam"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMN_1">Giải nhất</td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
                <td class="XSMN_2 fon16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></td>
            </tr>
            <tr class="XSMN_ngang">
                <td class="XSMN_1 bg_white"><strong class="red">Đặc biệt</strong></td>
                <td class="XSMN_2 bg_xam"><strong class="red"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></strong></td>
                <td class="XSMN_2 bg_xam"><strong class="red"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></strong></td>
                <td class="XSMN_2 bg_xam"><strong class="red"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></strong></td>
            </tr>
        </table>

        <div class="LOTOTT">

            <div class="sms_LOTOTT">
                <?php echo Yii::app()->params['static_sms'];?>
            </div>
        </div>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#eaeaea">
            <tr class="LOTO_ngang">
                <td class="LOTO_1">
                    Đầu
                </td>
                <td class="LOTO_2">
                    <p>Tỉnh</p>
                </td>
                <td class="LOTO_2">
                    <p>Tỉnh</p>
                </td>
                <td class="LOTO_2">
                    <p>Tỉnh</p>
                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    0
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    1
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    2</td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    3
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    4
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    5
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    6
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    7
                </td>
                <td class="LOTO_2 ">

                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    8
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    9
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_2">

                </td>
            </tr>
        </table>


    </div>

</div>

<div class="CHAT shadow">
    <div class="titleCHAT">
        Tán Gẫu
    </div>

    <div class="boxCHAT" id="CHAT"> </div>

    <div class="userCHAT">
        <textarea name="CHAT" placeholder="Nhập nội dung chat" cols="50" rows="2" class="From"></textarea>
        <!--<div name="CHAT" class="From" contenteditable="true"></div>-->
    </div>
    <div style="padding:15px 20px 20px 0; text-align:right;">
        <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-yahoo.png" width="22" height="22" style="padding-right:10px;" /><a href="javascript:void(0);" onclick="messenger();" class="button_KQ">Gửi bình luận</a>
    </div>
</div>