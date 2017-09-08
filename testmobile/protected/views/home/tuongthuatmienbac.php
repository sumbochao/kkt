

<?php
    $url = new Url();
?>

<script type="text/javascript">

    var url = "/test/home/loadmienbac";
    loadKetquaMienBac(url);

    $(document).ready(function(){

        $('#mienbac').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

        setInterval(function(){
            var t = new Date().getTime();
            var url = "/test/home/loadmienbac";
            loadKetquaMienBac(url);
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

    function loadKetquaMienBac(url){
        $.ajax({
            type: "GET",
            url: url,
            data:{},
            success:function(msg){
                $("#KQMB").html(msg);
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

<div class="bg_white m-t-10 shadow">
    <div class="menuXS m-t-10">
        <ul>
            <li id="mienbac"><a href="<?php echo Yii::app()->createUrl('home/index')?>">MIỀN BẮC</a></li>
            <li id="mientrung"><a href="<?php echo Yii::app()->createUrl('home/mientrung')?>">MIỀN TRUNG</a></li>
            <li id="miennam"><a href="<?php echo Yii::app()->createUrl('home/miennam')?>">MIỀN NAM</a></li>
            <li id="dientoan"><a href="<?php echo Yii::app()->createUrl('home/dientoan')?>">ĐIỆN TOÁN</a></li>
        </ul>
    </div>

    <div id="KQMB">
        <div class="titleXSMB">
            Tường thuật trực tiếp kết quả xổ số miền Bắc ngày <span class="red"><?php echo date('d/m/Y'); ?></span>
        </div>

        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#eaeaea">
            <tr class="XSMB_ngang">
                <td class="XSMB_1"><a class="red"><strong>Đặc Biệt</strong></a></td>
                <td class="XSMB_2" colspan="8">
                    <p><a>
                            <span class="giai_27"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                        </a></p>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Nhất</td>
                <td class="XSMB_2 XSMB_ngang_xam" colspan="8">
                    <span class="giai_26"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Nhì</td>
                <td class="XSMB_2" colspan="4">
                    <span class="giai_25"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="4">
                    <span class="giai_24"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1" rowspan="2">Giải Ba</td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_23"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <span class="giai_22"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_21"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_20"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <span class="giai_19"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_18"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Tư</td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_17"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_15"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_14"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1" rowspan="2">Giải Năm</td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_13"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <span class="giai_12"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_11"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_10"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <span class="giai_9"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <span class="giai_8"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Sáu</td>
                <td class="XSMB_4" colspan="3">
                    <span class="giai_7"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4" colspan="2">
                    <span class="giai_6"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_4" colspan="3">
                    <span class="giai_5"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải bảy</td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_4"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_3"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_2"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
                <td class="XSMB_2" colspan="2">
                    <span class="giai_1"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
                </td>
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
                    Lô tô
                </td>
                <td class="LOTO_1">
                    Đầu
                </td>
                <td class="LOTO_2">
                    Lô tô
                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    0
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_1">
                    5
                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    1
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_1">
                    6
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    2</td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_1">
                    7
                </td>
                <td class="LOTO_2">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    3
                </td>
                <td class="LOTO_2">

                </td>
                <td class="LOTO_1">
                    8
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
            </tr>
            <tr class="LOTO_ngang_1">
                <td class="LOTO_1">
                    4
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">

                </td>
                <td class="LOTO_1">
                    9
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