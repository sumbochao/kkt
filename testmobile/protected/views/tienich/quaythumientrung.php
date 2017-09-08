

<?php
    $url = new Url();
?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#mienbac').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

        var giai = 0;
        var vonglap = setInterval(function(){
            giai = giai + 1;
            ketqua(giai);
            //$(".Main").html("<p>"+giai+"</p>");
            if(giai == 18){
                clearInterval(vonglap);
                $('.SM').fadeIn('slow');
            }
            },1000);

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

    function quaythu(){
        $('.SM').fadeOut('slow');
        var tinh = $('#tinh').val();
        var url = "<?=$url->createUrl('tienich/quaythu'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                tinh: tinh,
            },
            success: function(msg){
                $(".Main").html(msg);
            }
        });
    }

    function ketqua(giai){
        var url = "<?=$url->createUrl('tienich/quaythumientrung'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data: {
                giai: giai,
            },
            success: function(msg){
                $(".giai_"+giai).html(msg);
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
    <div class="titleCHAT">
        Quay thử
    </div>
    <div class="SM" style="display: none;">
        <select name="1" class="boxSearch" id="tinh">
            <?php for($i=0;$i<count($tinh);$i++){?>
                <option value="<?php echo $tinh[$i]['name']?>"><?php echo $tinh[$i]['name']?></option>
                <?php }?>
        </select>
        <div style="padding:15px 0 5px 0;text-align: center;">
            <a href="javascript:void(0);" onclick="quaythu();" class="button_KQ">Quay Thử</a>
        </div>
        <div class="both"></div>
    </div>
    <div class="titleXSMB">
        Kết quả quay thử sổ xố <?php echo $data['name'];?> ngày <span class="red"><?php echo date('d/m/Y');?></span>
    </div>
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#eaeaea">
        <tr class="XSMB_ngang">
            <td class="XSMB_1"><a class="red"><strong>Đặc Biệt</strong></a></td>
            <td class="XSMB_2" colspan="8">
                <span class="giai_18"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Nhất</td>
            <td class="XSMB_2 XSMB_ngang_xam" colspan="8">
                <span class="giai_17"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Nhì</td>
            <td class="XSMB_2" colspan="8">
                <span class="giai_16"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Ba</td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="4">
                <span class="giai_14"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="4">
                <span class="giai_15"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1" rowspan="2">Giải Tư</td>
            <td class="XSMB_2" colspan="2">
                <span class="giai_10"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_2" colspan="2">
               <span class="giai_11"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_2" colspan="2">
                <span class="giai_12"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_2" colspan="2">
                <span class="giai_13"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_2" colspan="3">
                <span class="giai_7"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_2" colspan="2">
                <span class="giai_8"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_2" colspan="3">
                <span class="giai_9"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Năm</td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="8">
                <span class="giai_6"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Sáu</td>
            <td class="XSMB_4" colspan="3">
                <span class="giai_3"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_4" colspan="2">
                <span class="giai_4"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
            <td class="XSMB_4" colspan="3">
                <span class="giai_5"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Bảy</td>
            <td class="XSMB_2 XSMB_ngang_xam" colspan="8">
                <span class="giai_2"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Tám</td>
            <td class="XSMB_2" colspan="8">
                <span class="giai_1"><img style="width: 20px" src="<?php echo Yii::app()->params['static_url'];?>images/loading.gif"></span>
            </td>
        </tr>
    </table>

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