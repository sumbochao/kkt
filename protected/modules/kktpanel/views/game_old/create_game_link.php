<?php $url = new Url();?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".search_handset").colorbox({width:"650px", height:"100%"});
    });
    function ajaxSaveGameFile(){
        var gameId = '<?php echo $data_game["id"]?>';       
        var linkId = $("#linkId").val();
        var supplier = $("#supplier").val();
        var device = "";    
        $("input[name=device_1]").each(function(){
            device += this.value + ";";
        });
        var strUrl = "<?=$url->createUrl("game/ajaxSaveGameFile") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                type_game:1,
                gameId:gameId,
                linkId:linkId,
                supplier:supplier,
                device:device
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("game/index")?>';
                }else{
                    $("#show_error").html(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled"); 
            }          
        });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <input type="hidden" id="type_game" value="1"/>  
        <ul class="form">
            <li class="clearfix"><label><strong>Mã Link</strong>:</label>
                <div class="filltext">
                    <p><input type="text" id="linkId" style="width: 200px;" /> </p>  
                </div>
            </li>
            <li class="clearfix"><label><strong>Nhà cung cấp</strong>:</label>
                <div class="filltext">
                    <p>
                        <select id="supplier">
                            <?php foreach(LoadConfig::$supplier as $key=>$value){?>
                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </p>  
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <a class="search_handset" href="<?php echo $url->createUrl("game/searchHandset")?>"><strong>[Tìm thiết bị]</strong></a> &nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="removeAllDevice();"><strong>[Xóa thiết bị]</strong></a>
                </div></li>
            <li class="clearfix"><label><strong>Dòng máy :</strong> &nbsp;</label>
                <div class="filltext">
                    <div class="devices" id="list_devices_1"></div>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input type="button" id="button_save" value=" Thêm mới " class="btn-bigblue" onclick="ajaxSaveGameFile();"> 
                    &nbsp;
                    <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext" style="color: red;" id="show_error"></div>
            </li>
        </ul>

    </div>
</div>