<?php
    $url = new Url();
?>

<script type="text/javascript">
    
    function timboso(){
        //alert('test1');
        var ngay = $("#input_boso").val();
        var url = "<?=$url->createUrl('vip/tkgiaidacbiet');?>"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                ngay: ngay,
            },
            success: function(msg){
                if(msg==1)
                    {
                    $("#boso").html("<p style='color:#F51046;text-align:center;'>Bạn nhập chưa chính xác</p>");
                }
                else
                    {
                    $('#boso').html(msg);
                }
            }
        });
    }

    function timchuky(){
        //alert('test2');
        var boso = $("#input_chuky").val();
        var url = "<?=$url->createUrl('vip/tkchuky');?>"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                boso: boso,
            },
            success: function(msg){
                if(msg==1)
                    {
                    $("#chuky").html("<p style='color:#F51046;text-align:center;'>Bạn nhập chưa chính xác</p>");
                }
                else
                    {
                    $('#chuky').html(msg);
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
    <div class="titleCHAT"> Thống kê Vip </div>
    <div class="SM">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1" id="gancucdai"><p style="color: #000;">Thống kê lô tô tới ngưỡng gan cực đại</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1"><p style="color: #000;">Bộ Số</p></td>
                <td class="SM_1"><p style="color: #000;">Cực đại(Lần quay)</p></td>
                <td class="SM_1"><p style="color: #000;">Khoảng thời gian</p></td>
                <td class="SM_1"><p style="color: #000;">Chưa về(Lần quay)</p></td>
                <td class="SM_1"><p style="color: #000;">Ngày về gần nhất</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">

            <?php for($i=0;$i<count($gancucdai);$i++){?>
                <tr class="bg_white">
                    <td class="SM_1">
                        <?php echo $gancucdai[$i]['boso'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo $gancucdai[$i]['lanquay_cucdai'];?>
                    </td>
                    <td class="SM_1">
                        <?php //echo $data[$i]['boso'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo $gancucdai[$i]['lanquay_chuave'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo date('d/m/Y',strtotime($gancucdai[$i]['end_date']));?>
                    </td>
                </tr>
                <?php }?>

        </table>
    </div>

    <div class="SM">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1" id="kycucdai"><p style="color: #000;">Thống kê lô tô tới chu kỳ so với kỳ gan nhất</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1"><p style="color: #000;">Bộ Số</p></td>
                <td class="SM_1"><p style="color: #000;">Độ dài chu kỳ</p></td>
                <td class="SM_1"><p style="color: #000;">Đầu chu kỳ</p></td>
                <td class="SM_1"><p style="color: #000;">Kết chu kỳ</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">

            <?php for($i=0;$i<count($kycucdai);$i++){?>
                <tr class="bg_white">
                    <td class="SM_1">
                        <?php echo $kycucdai[$i]['boso'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo $kycucdai[$i]['dodai_chuky'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo $kycucdai[$i]['start_date'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo date('d/m/Y',strtotime($kycucdai[$i]['end_date']));?>
                    </td>
                </tr>
                <?php }?>

        </table>
    </div>

    <div class="SM">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1" id="kygannhat"><p style="color: #000;">Thống kê loto tới chu kỳ so với kỳ gần nhất</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1"><p style="color: #000;">Bộ Số</p></td>
                <td class="SM_1"><p style="color: #000;">Độ dài chu kỳ</p></td>
                <td class="SM_1"><p style="color: #000;">Đầu chu kỳ</p></td>
                <td class="SM_1"><p style="color: #000;">Kết chu kỳ</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">

            <?php for($i=0;$i<count($kygannhat);$i++){?>
                <tr class="bg_white">
                    <td class="SM_1">
                        <?php echo $kygannhat[$i]['boso'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo $kygannhat[$i]['dodai_chuky'];?>
                    </td>
                    <td class="SM_1">
                        <?php echo date('d/m/Y',strtotime($kygannhat[$i]['start_date']));?>
                    </td>
                    <td class="SM_1">
                        <?php echo date('d/m/Y',strtotime($kygannhat[$i]['end_date']));?>
                    </td>
                </tr>
                <?php }?>
        </table>
    </div>

    <div class="SM">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1" id="dacbiet"><p style="color: #000;">Thống kê lịch sử giải đặc biệt</p></td>
            </tr>
        </table>
        <div class="searchSM">
            <input name="a" type="text" placeholder="Nhập ngày(dd-mm)" size="5" maxlength="100" class="boxsearchSM" id="input_boso" />
            <div style="margin: 20px 0px;text-align: center;">
                <a href="javascript:void(0);" onclick="timboso();" class="buttonsearchSMS">Thống kê</a>
            </div>
        </div>
        <div class="searchLetters" id="boso"></div>
    </div>

    <div class="SM">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1" id="loto"><p style="color: #000;">Thống kê chu kỳ Loto</p></td>
            </tr>
        </table>
        <div class="searchSM">
            <input name="a" type="text" placeholder="Nhập bộ số" size="5" maxlength="100" class="boxsearchSM" id="input_chuky" />
            <div style="margin: 20px 0px;text-align: center;">
                <a href="javascript:void(0);" onclick="timchuky();" class="buttonsearchSMS">Thống kê</a>
            </div>
        </div>
        <div class="searchLetters" id="chuky"></div>
    </div>

</div>