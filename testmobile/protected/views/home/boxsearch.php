<?php

    $url = new Url();
    $arr_region = LoadConfig::$region;

?>

<script type="">

    vung('<?php echo $vung;?>','<?php echo $tinh['id'];;?>');

    $(document).ready(function(){

        $( "#ngay" ).datepicker({ 
            dateFormat: 'yy-mm-dd'
        });

        $('#vung').change(function(){
            var id = $(this).val();
            var url = "<?=$url->createUrl('ketqua/select'); ?>"
            $.ajax({
                type: "GET",
                url: url,
                global: false,
                data:{
                    id: id,
                },
                success: function(msg){
                    $('#tinh').html(msg);
                }
            });
        });

    });

    function vung(vung,tinh){
        var url = "<?=$url->createUrl('ketqua/select'); ?>"
        $.ajax({
            type: "GET",
            url: url,
            global: false,
            data:{
                id: vung,
                tinh: tinh,
            },
            success: function(msg){
                $('#tinh').html(msg);
            }
        });
    }

</script>

<div class="Title">
        Tìm kiếm kết quả theo tỉnh    
    </div>
    <div class="lineTK">
        <div class="lineTK2"></div>
    </div>
    <div style="padding-bottom:10px; text-align:left;">
    <form action="<?php echo Yii::app()->createUrl('ketqua/search');?>" method="post">
        <select name="vung" class="boxSearch" id="vung">
            <?php foreach($arr_region as $key=>$region){?>
                <option value="<?php echo $key ?>" <?php if($vung==$key){echo 'selected="selected"';}?>><?php echo $region?></option>
                <?php } ?>
        </select>
        <select name="tinh" class="boxSearch" id="tinh">
            <option value="1">Miền Bắc</option>
        </select>
        <input name="ngay" id='ngay' value="<?php if($ngay!=''){echo $ngay;}else{ echo date('Y-m-d');}?>" class="boxSearch">
        <select name="quay" class="boxSearch" id="quay">
            <?php for($i=1;$i<=10;$i++){?>
                <option value="<?php echo $i;?>" <?php if($i==$quay){echo 'selected="selected"';}elseif($i==3){echo 'selected="selected"';}?> ><?php echo $i;?></option>
                <?php }?>
        </select>
        <select name="truoc" class="boxSearch" id="truoc">
            <option value="0" <?php if($truoc==0){echo 'selected="selected"';}?>>Trước</option>
            <option value="1" <?php if($truoc==1){echo 'selected="selected"';}?>>Sau</option>
        </select>
        <div style="padding:15px 0 5px 0">
            <input class="button_KQ" type="submit" value="Xem Kết quả">
        </div>
     </form>
    </div>