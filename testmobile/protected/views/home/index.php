
<?php
    $url = new Url();
?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#mienbac').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        var d = new Date();
        var time = d.getHours();
        if(time == 18){
            $('#mienbac').html('<a href="<?php echo Yii::app()->createUrl('home/tuongthuatmienbac')?>">MIỀN BẮC</a>');
        }
        if(time == 16){
            $('#miennam').html('<a href="<?php echo Yii::app()->createUrl('home/tuongthuatmiennam')?>">MIỀN NAM</a>');
        }
        if(time == 17){
            $('#mientrung').html('<a href="<?php echo Yii::app()->createUrl('home/tuongthuatmientrung')?>">MIỀN TRUNG</a>');
        }

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);


        var currentdate = new Date(); 
        var datetime = currentdate.getFullYear() + "/" + (currentdate.getMonth()+1)  + "/" + (currentdate.getDate()) + " 18:15:00";
        $('.count').countdown(datetime, function(event){
            $(this).html(event.strftime('%H:%M:%S'));
        });

    });
    
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
    <div class="titleXSMB">
        Kết quả sổ xố trực tiếp miền Bắc ngày <span class="red"><?php echo date('d/m/Y',strtotime($ketqua['ngay_quay'])); ?></span>
        <p>Đang chờ<span class="red"> KQXS Miền Bắc</span> lúc 16h15 - <?php echo date('d/m/Y'); ?>. Còn <span class="count"></span></p>
    </div>
    <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#eaeaea">
        <tr class="XSMB_ngang">
            <td class="XSMB_1"><a class="red"><strong>Đặc Biệt</strong></a></td>
            <td class="XSMB_2" colspan="8">
                <p><a><?php echo $ketqua['giai_dacbiet']; ?>&nbsp;</a></p>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Nhất</td>
            <td class="XSMB_2 XSMB_ngang_xam" colspan="8">
                <?php echo $ketqua['giai_nhat']; ?>&nbsp;
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Nhì</td>
            <td class="XSMB_2" colspan="4">
                <?php echo $ketqua['giai_nhi_1']; ?>
            </td>
            <td class="XSMB_2" colspan="4">
                <?php echo $ketqua['giai_nhi_2']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1" rowspan="2">Giải Ba</td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_ba_1']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                <?php echo $ketqua['giai_ba_2']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_ba_3']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_ba_4']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                <?php echo $ketqua['giai_ba_5']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_ba_6']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Tư</td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_tu_1']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_tu_2']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_tu_3']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_tu_4']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1" rowspan="2">Giải Năm</td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_nam_1']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                <?php echo $ketqua['giai_nam_2']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_nam_3']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_nam_4']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                <?php echo $ketqua['giai_nam_5']; ?>
            </td>
            <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                <?php echo $ketqua['giai_nam_6']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Sáu</td>
            <td class="XSMB_4" colspan="3">
                <?php echo $ketqua['giai_sau_1']; ?>
            </td>
            <td class="XSMB_4" colspan="2">
                <?php echo $ketqua['giai_sau_2']; ?>
            </td>
            <td class="XSMB_4" colspan="3">
                <?php echo $ketqua['giai_sau_3']; ?>
            </td>
        </tr>
        <tr class="XSMB_ngang">
            <td class="XSMB_1">Giải Bảy</td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_bay_1']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_bay_2']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_bay_3']; ?>
            </td>
            <td class="XSMB_2" colspan="2">
                <?php echo $ketqua['giai_bay_4']; ?>
            </td>
        </tr>
    </table>
    <div class="LOTOTT">
        <span class="red"><strong>Loto trực tiếp:</strong></span><br />
        <?php for($i=0;$i<count($loto);$i++){?>
            <span class="boxLOTOTT">
                <?php echo $loto[$i]['boso'];?>
            </span>
            <?php }?>
        <div class="sms_LOTOTT">
            <?php echo Yii::app()->params['static_sms'];?>
        </div>
    </div>

    <?php
        $daucuoi[1] = $ketqua['giai_dacbiet'];
        $daucuoi[2] = $ketqua['giai_nhi_1'];
        $daucuoi[3] = $ketqua['giai_nhi_2'];
        $daucuoi[4] = $ketqua['giai_ba_1'];
        $daucuoi[5] = $ketqua['giai_ba_2'];
        $daucuoi[6] = $ketqua['giai_ba_3'];
        $daucuoi[7] = $ketqua['giai_ba_4'];
        $daucuoi[8] = $ketqua['giai_ba_5'];
        $daucuoi[9] = $ketqua['giai_ba_6'];
        $daucuoi[10] = $ketqua['giai_tu_1'];
        $daucuoi[11] = $ketqua['giai_tu_2'];
        $daucuoi[12] = $ketqua['giai_tu_3'];
        $daucuoi[13] = $ketqua['giai_tu_4'];
        $daucuoi[14] = $ketqua['giai_nam_1'];
        $daucuoi[15] = $ketqua['giai_nam_2'];
        $daucuoi[16] = $ketqua['giai_nam_3'];
        $daucuoi[17] = $ketqua['giai_nam_4'];
        $daucuoi[18] = $ketqua['giai_nam_5'];
        $daucuoi[19] = $ketqua['giai_nam_6'];
        $daucuoi[20] = $ketqua['giai_sau_1'];
        $daucuoi[21] = $ketqua['giai_sau_2'];
        $daucuoi[22] = $ketqua['giai_sau_3'];
        $daucuoi[23] = $ketqua['giai_bay_1'];
        $daucuoi[24] = $ketqua['giai_bay_2'];
        $daucuoi[25] = $ketqua['giai_bay_3'];
        $daucuoi[26] = $ketqua['giai_bay_4'];
        $daucuoi[27] = $ketqua['giai_nhat'];
        //var_dump($daucuoi);
    ?>

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
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==0)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
            <td class="LOTO_1">
                5
            </td>
            <td class="LOTO_2">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==5)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
        </tr>
        <tr class="LOTO_ngang_1">
            <td class="LOTO_1">
                1
            </td>
            <td class="LOTO_2">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==1)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
            <td class="LOTO_1">
                6
            </td>
            <td class="LOTO_2 XSMB_ngang_xam">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==6)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
        </tr>
        <tr class="LOTO_ngang_1">
            <td class="LOTO_1">
                2</td>
            <td class="LOTO_2 XSMB_ngang_xam">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==2)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
            <td class="LOTO_1">
                7
            </td>
            <td class="LOTO_2">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==7)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
        </tr>
        <tr class="LOTO_ngang_1">
            <td class="LOTO_1">
                3
            </td>
            <td class="LOTO_2">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==3)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
            <td class="LOTO_1">
                8
            </td>
            <td class="LOTO_2 XSMB_ngang_xam">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==8)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
        </tr>
        <tr class="LOTO_ngang_1">
            <td class="LOTO_1">
                4
            </td>
            <td class="LOTO_2 XSMB_ngang_xam">
                <?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==4)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
            </td>
            <td class="LOTO_1">
                9
            </td>
            <td class="LOTO_2"><?php
                    for($i=1;$i<=count($daucuoi);$i++)
                    {
                        if(substr($daucuoi[$i],-2,1)==9)
                        {
                            echo substr($daucuoi[$i],-1,1)." ";
                        }
                    }
                ?>
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