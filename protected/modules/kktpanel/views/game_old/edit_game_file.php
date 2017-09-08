<script src="<?php  echo Yii::app()->params['static_url_cp']; ?>/js/jquery.quicksearch.js" type="text/javascript"></script>
<?php $url = new Url();?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".search_handset").colorbox({width:"650px", height:"100%"});
        $('input#quicksearch_device').quicksearch('div#list_devices_<?php echo $data_game["type"] ?> div');
    });
    function removeDevice(id){
        $("#area_device_<?php echo $data_game["type"] ?>"+id).remove();
    }
    function removeAllDevice(){
        if(confirm('Bạn có muốn xóa toàn bộ thiết bị không ?')){
            $("input[name=device_<?php echo $data_game["type"] ?>]").each(function(){
                removeDevice(this.value);
            });
        }
    }
    function ajaxUpdateGameFile(){
        var id = '<?php echo $data_game_file["id"]?>';
        var introtext = $("#introtext").val();
        var device = "";    
        $("input[name=device_<?php echo $data_game["type"] ?>]").each(function(){
            device += this.value + ";";
        });
        var strUrl = "<?=$url->createUrl("game/ajaxUpdateGameFile") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                device:device,
                introtext:introtext
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    history.go(-1);
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
        <ul class="form4">
            <li class="clearfix filegame">
                <label><strong>&nbsp;</strong></label>
                <div class="filltext">
                    <div class="box">
                        <input type="hidden" id="type_game" value="<?php echo $data_game["type"];?>"/>
                        <p> 
                        <?php if($data_game["type"]==0){?>
                        Tên File: <strong><?php echo $data_game_file["filename"]?></strong>
                        <?php }else{?>
                       Mã game link: <strong><?php echo $data_game_file["linkId"]?></strong> &nbsp;-&nbsp;Đối tác: <strong><?php echo LoadConfig::$supplier[$data_game_file["supplier"]]?></strong>
                        <?php }?>
                        </p>
                        <ul class="form4">
                            <li class="clearfix">
                                <label><strong style="margin-right:25px">Mô tả :</strong> &nbsp;</label>
                                <div class="filltext">
                                    <textarea name="introtext" id="introtext" style="width:700px; height:120px"><?php echo $data_game_file["introtext"]?></textarea>
                                </div>
                            </li>
                            <li class="clearfix"><label>&nbsp;</label>
                                <div class="filltext">
                                    <a class="search_handset" href="<?php echo $url->createUrl("game/searchHandset")?>"><strong>[Tìm thiết bị]</strong></a> &nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="removeAllDevice();"><strong>[Xóa thiết bị]</strong></a>
                                </div></li>
                            <li class="clearfix">
                                <label><strong>Dòng máy :</strong> &nbsp;<input id="quicksearch_device" type="text" style="width: 200px;"/></label>
                                
                                <div class="filltext">
                                    <div class="devices" id="list_devices_<?php echo $data_game["type"] ?>">
                                        <?php foreach($data_game_hs as $key=>$value){ ?> 
                                            <div class="fl area_device" style="margin-right:20px" id="area_device_<?php echo $data_game["type"].$value["mobileHandsetId"];?>">
                                                <input type="hidden" name="device_<?php echo $data_game["type"] ?>" id="device_<?php echo $data_game["type"].$value["mobileHandsetId"];?>'" value="<?php echo $value["mobileHandsetId"];?>"/>
                                                <a href="javascript:void(0)" onclick="removeDevice('<?php echo $value["mobileHandsetId"];?>')" class="icon-delete"></a><span><?php echo $data_handset[$value["mobileHandsetId"]];?></span></div>                    
                                            <?php }?> 
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input type="button" id="button_save" value=" Sửa " class="btn-bigblue" onclick="ajaxUpdateGameFile();"> 
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