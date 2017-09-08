

<?php
    $url = new Url();
?>

<script type="text/javascript">

    loadBoxSearch('<?php echo $vung;?>','<?php echo $tinh;?>','<?php echo $ngay;?>','<?php echo $quay;?>','<?php echo $truoc;?>');

    $(document).ready(function(){

        $('#mienbac').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        $(".boxCalendar").datepicker({
            dateFormat: 'yy-mm-dd',
            showOn: 'both',
            buttonImage: ' <?php echo Yii::app()->params['static_url'];?>/images/xo-so-10h-icon-LMT.png',
            buttonImageOnly: true,
        });

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

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
    
    function loadBoxSearch(vung,tinh,ngay,quay,truoc){
        var url = "<?=$url->createUrl('home/boxsearch');?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{
                vung: vung,
                tinh: tinh, 
                ngay: ngay,
                quay: quay, 
                truoc: truoc,
            },
            success: function(msg){
                $("#boxsearch").html(msg);
            }
        });
    }

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

<div class="menuXS m-t-10">
    <ul>
        <li id="mienbac"><a href="<?php echo Yii::app()->createUrl('ketqua/mienbac')?>">MIỀN BẮC</a></li>
        <li id="mientrung"><a href="<?php echo Yii::app()->createUrl('ketqua/mientrung')?>">MIỀN TRUNG</a></li>
        <li id="miennam"><a href="<?php echo Yii::app()->createUrl('ketqua/miennam')?>">MIỀN NAM</a></li>
        <li id="dientoan"><a href="<?php echo Yii::app()->createUrl('ketqua/dientoan')?>">ĐIỆN TOÁN</a></li>
    </ul>
</div>

<?php for($i=0;$i<count($data);$i++){?>
    <div class="bg_white m-t-10 shadow">    
        <div class="titleXSMB">
            Kết quả sổ xố trực tiếp miền Bắc ngày <span class="red"><?php echo date('d/m/Y',strtotime($data[$i]['ngay_quay'])); ?></span>
        </div>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#eaeaea">
            <tr class="XSMB_ngang">
                <td class="XSMB_1"><a class="red"><strong>Đặc Biệt</strong></a></td>
                <td class="XSMB_2" colspan="8">
                    <p><a><?php echo $data[$i]['giai_dacbiet']; ?></a></p>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Nhất</td>
                <td class="XSMB_2 XSMB_ngang_xam" colspan="8">
                    <?php echo $data[$i]['giai_nhat']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Nhì</td>
                <td class="XSMB_2" colspan="4">
                    <?php echo $data[$i]['giai_nhi_1']; ?>
                </td>
                <td class="XSMB_2" colspan="4">
                    <?php echo $data[$i]['giai_nhi_2']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1" rowspan="2">Giải Ba</td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_ba_1']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <?php echo $data[$i]['giai_ba_2']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_ba_3']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_ba_4']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <?php echo $data[$i]['giai_ba_5']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_ba_6']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Tư</td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_tu_1']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_tu_2']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_tu_3']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_tu_4']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1" rowspan="2">Giải Năm</td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_nam_1']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <?php echo $data[$i]['giai_nam_2']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_nam_3']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_nam_4']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="2">
                    <?php echo $data[$i]['giai_nam_5']; ?>
                </td>
                <td class="XSMB_4 XSMB_ngang_xam" colspan="3">
                    <?php echo $data[$i]['giai_nam_6']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Sáu</td>
                <td class="XSMB_4" colspan="3">
                    <?php echo $data[$i]['giai_sau_1']; ?>
                </td>
                <td class="XSMB_4" colspan="2">
                    <?php echo $data[$i]['giai_sau_2']; ?>
                </td>
                <td class="XSMB_4" colspan="3">
                    <?php echo $data[$i]['giai_sau_3']; ?>
                </td>
            </tr>
            <tr class="XSMB_ngang">
                <td class="XSMB_1">Giải Bảy</td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_bay_1']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_bay_2']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_bay_3']; ?>
                </td>
                <td class="XSMB_2" colspan="2">
                    <?php echo $data[$i]['giai_bay_4']; ?>
                </td>
            </tr>
        </table>
        <div class="LOTOTT">
            <div class="sms_LOTOTT">
                <?php echo Yii::app()->params['static_sms'];?>
            </div>
        </div>

        <?php
            $daucuoi[1] = $data[$i]['giai_dacbiet'];
            $daucuoi[2] = $data[$i]['giai_nhi_1'];
            $daucuoi[3] = $data[$i]['giai_nhi_2'];
            $daucuoi[4] = $data[$i]['giai_ba_1'];
            $daucuoi[5] = $data[$i]['giai_ba_2'];
            $daucuoi[6] = $data[$i]['giai_ba_3'];
            $daucuoi[7] = $data[$i]['giai_ba_4'];
            $daucuoi[8] = $data[$i]['giai_ba_5'];
            $daucuoi[9] = $data[$i]['giai_ba_6'];
            $daucuoi[10] = $data[$i]['giai_tu_1'];
            $daucuoi[11] = $data[$i]['giai_tu_2'];
            $daucuoi[12] = $data[$i]['giai_tu_3'];
            $daucuoi[13] = $data[$i]['giai_tu_4'];
            $daucuoi[14] = $data[$i]['giai_nam_1'];
            $daucuoi[15] = $data[$i]['giai_nam_2'];
            $daucuoi[16] = $data[$i]['giai_nam_3'];
            $daucuoi[17] = $data[$i]['giai_nam_4'];
            $daucuoi[18] = $data[$i]['giai_nam_5'];
            $daucuoi[19] = $data[$i]['giai_nam_6'];
            $daucuoi[20] = $data[$i]['giai_sau_1'];
            $daucuoi[21] = $data[$i]['giai_sau_2'];
            $daucuoi[22] = $data[$i]['giai_sau_3'];
            $daucuoi[23] = $data[$i]['giai_bay_1'];
            $daucuoi[24] = $data[$i]['giai_bay_2'];
            $daucuoi[25] = $data[$i]['giai_bay_3'];
            $daucuoi[26] = $data[$i]['giai_bay_4'];
            $daucuoi[27] = $data[$i]['giai_nhat'];
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
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==0)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
                <td class="LOTO_1">
                    5
                </td>
                <td class="LOTO_2">
                    <?php
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==5)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
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
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==1)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
                <td class="LOTO_1">
                    6
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">
                    <?php
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==6)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
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
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==2)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
                <td class="LOTO_1">
                    7
                </td>
                <td class="LOTO_2">
                    <?php
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==7)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
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
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==3)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
                <td class="LOTO_1">
                    8
                </td>
                <td class="LOTO_2 XSMB_ngang_xam">
                    <?php
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==8)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
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
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==4)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
                <td class="LOTO_1">
                    9
                </td>
                <td class="LOTO_2">
                    <?php
                        for($j=1;$j<=count($daucuoi);$j++)
                        {
                            if(substr($daucuoi[$j],-2,1)==9)
                            {
                                echo substr($daucuoi[$j],-1,1)."&nbsp;";
                            }
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
    <?php }?>

<div class="CHAT shadow">
    <div class="titleCHAT">
        Tán Gẫu
    </div>
    <div class="boxCHAT" id="CHAT">  </div>
    <div class="userCHAT">
        <textarea name="CHAT" placeholder="Nhập nội dung chat" cols="50" rows="2" class="From"></textarea>
    </div>
    <div style="padding:15px 20px 20px 0; text-align:right;">
        <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-yahoo.png" width="22" height="22" style="padding-right:10px;" /><a href="javascript:void(0);" onclick="messenger();" class="button_KQ">Gửi bình luận</a>
    </div>
</div>
<div class="Box m-t-10" id="boxsearch"></div>    