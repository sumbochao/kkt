<?php
    $url = new Url(); 
    $arr_status = LoadConfig::$status;
    $data_partner = APartner::getAllPartner();
    $business_name = LoadConfig::$business_name;
    $forder_upload = "game";  
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
?>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".search_handset").colorbox({width:"650px", height:"100%"});
        $("#isOnline").change(function(){
            if(this.value==0){
                $("#area_sms_offline").show();
            }else{
                $("#area_sms_offline").hide();
            }
        });
    });
    var data_handset = <?php echo json_encode($data_handset);?>;
    window.onload = function() {
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.jar;*.apk;*.ipa;*.jad;*.cod;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUpload(configUploadData); 
        configUploadOther(configUploadDataOther);   
    }; 
    function uploadResponse(serverData){  
        try {
            $("#txtFileName").val(""); 
            var response = $.parseJSON(serverData); // eval( "(" + serverData + ")" );      
            if(response.code==404){
                alert(response.message);return false;
            }  
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" class="img-100" alt="pic">')
        } catch (e) {

        };
    }
    function uploadResponseOther(serverData){  
        try {
            $("#txtFileName_other").val(""); 

            var response = $.parseJSON(serverData);      
            if(response.code==404){
                alert(response.message);return false;
            }  
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;  
            var msg = '<li class="clearfix filegame"><label><strong>&nbsp;</strong></label>';
            msg += '<div class="filltext"><div class="box">';
            msg += '<p> Tên File: '+ filename +'</p>';
            msg += '<input type="hidden" name="filename" id="filename" value="'+filename+'"/>';
            msg += '<input type="hidden" name="extension" id="extension" value="'+extension+'"/>';
            msg += '<input type="hidden" name="filesize" id="filesize" value="'+filesize+'"/>';
            msg += '<ul class="form4"><li class="clearfix">';
            msg += '<label><strong style="margin-right:25px">Mô tả :</strong> &nbsp;</label>';
            msg += '<div class="filltext"><textarea name="introtext" id="introtext_file" style="width:400px; height:120px"></textarea>';
            msg += '</div></li>';
            msg += '<li class="clearfix"><label>&nbsp;</label>';
            msg += '<div class="filltext">';
            msg += '<a class="search_handset" href="<?php echo $url->createUrl("game/searchHandset")?>"><strong>[Tìm thiết bị]</strong></a> &nbsp;&nbsp;';
            msg += '<a href="javascript:void(0)" onclick="removeAllDevice();"><strong>[Xóa thiết bị]</strong></a>';
            msg += '</div></li>';
            msg += '<li class="clearfix"><label><strong>Dòng máy :</strong> &nbsp;</label>';
            msg += '<div class="filltext">';
            msg += '<div class="devices" id="list_devices_0"></div>';
            msg += '</div></li>';            
            msg += '</ul></div></div></li>';
            $("#list_file_game").html(msg);
            $(".search_handset").colorbox({width:"650px", height:"100%"});   
        } catch (e) {

        };
    }
    function ajaxSaveGame(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
            appId = parseInt(this.value) + appId;
        });
        var type_game = $("#type_game").val();
        var device = "";    
        $("input[name=device_"+type_game+"]").each(function(){
            device += this.value + ";";
        });

        var strUrl = "<?=$url->createUrl("game/ajaxSaveGame") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                title_game:$("#title_game").val(),
                price:$("#price").val(),
                title_sms:$("#title_sms").val(),
                isOnline:$("#isOnline").val(),
                isSms:$("#isSms").val(),
                categoryId:$("#categoryId").val(),
                picture:$("#picture").val(),
                introtext:$("#introtext").val(),
                type_game:type_game,
                filename:$("#filename").val(),
                extension:$("#extension").val(),
                filesize:$("#filesize").val(),
                introtext_file:$("#introtext_file").val(),
                linkId: $("#linkId").val(),
                supplier: $("#supplier").val(),
                position: $("#position").val(),
                device:device,
                status:$("#status").val(),
                partnerId:$("#partnerId").val(),
                percent_partner:$("#percent_partner").val(),
                percent_telco:$("#percent_telco").val(),
                percent_wapmaster:$("#percent_wapmaster").val(),
                appId:appId,
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
    function activeGameType(type){
        if(type==1){
            $("#game_link").show();
            $("#game_file").hide();
            $("#type_file").removeClass('active');
            $("#type_link").addClass('active');    
        }else{
            $("#game_file").show();
            $("#game_link").hide();
            $("#type_link").removeClass('active');
            $("#type_file").addClass('active');
        }
        $("#type_game").val(type);
    }
</script>  
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <div class="col-570">
            <ul class="form" id="form_create">
                <li class="clearfix"><label><strong>Tên game </strong></label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="title_game"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tiêu đề tin nhắn </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="title_sms" maxlength="40"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Danh mục </strong></label>
                    <div class="filltext">
                        <select id="categoryId">
                            <?php foreach($data_cat as $key=>$value){?>
                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>App su dung</strong>:</label>
                    <div class="filltext">
                        <?php foreach(User::getAllApp() as $key=>$value){?>
                            <input type="checkbox" name="appId" value="<?php echo $key?>"/><?php echo $value;?>
                            <?php }?>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Giá</strong>:</label>
                    <div class="filltext">
                        <select id="price">
                            <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                                <option value="<?php echo $value;?>"><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Ảnh minh họa </strong>:</label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName" readonly="readonly"/>
                            <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder"></span>
                        </p>
                        <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress">
                            <span class="legend">File upload</span>
                        </div>

                        <input type="hidden" id="picture" value=""/>
                        <p id="show_pic"></p>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:400px; height:120px" id="introtext"></textarea>
                    </div>
                </li>  
                <li class="clearfix"><label><strong>Vị trí</strong>:</label>
                    <div class="filltext">
                        <input type="text" id="position" style="width: 360px;" value=""/>
                    </div>
                </li> 
                <li class="clearfix"><label><strong>Nhà cung cấp</strong>:</label>
                    <div class="filltext">
                        <select id="partnerId" style="width:150px;">
                            <?php foreach ($data_partner as $key=>$value){?>
                                <option value="<?php echo $value["id"]?>"><?php echo $value["name"];?></option>
                                <?php }?>
                        </select>
                        &nbsp;Chiết khấu :  <input type="text" id="percent_partner" style="width: 100px;" value=""/>%
                        &nbsp;
                        <select id="percent_telco">
                            <option value="1">Sau Đầu Số</option>
                            <option value="0.85">Sau Telco</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Chiết khấu cho wap</strong>:</label>
                    <div class="filltext">
                        <input type="text" id="percent_wapmaster" style="width: 150px;" value=""/>%
                    </div>
                </li>
                <li class="clearfix"><label><strong>Game online: </strong></label>
                    <div class="filltext">
                        <select id="isOnline">                           
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix" id="area_sms_offline"><label><strong>Có SMS: </strong></label>
                    <div class="filltext">
                        <select id="isSms">                           
                            <option value="0">Không</option>
                            <option value="1">Có</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" id="status">
                            <?php foreach($arr_status as $key=>$value){?>
                                <option value="<?php echo $key;?>"><?php echo $value?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="button" id="button_save" value=" Thêm mới " class="btn-bigblue" onclick="ajaxSaveGame();"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext" style="color: red;" id="show_error"></div>
                </li>
            </ul>
        </div>
        <div class="col5">&nbsp;</div>
        <div class="col-570">
            <div class="box">
                <div class="Tabs clearfix">
                    <ul class="clearfix">
                        <li><a id="type_file" class="active" href="javascript:void(0)" onclick="activeGameType(0)"><span>&nbsp; File &nbsp;</span></a></li>
                        <li><a id="type_link" href="javascript:void(0)" onclick="activeGameType(1)"><span>&nbsp; URL &nbsp;</span></a></li>
                    </ul>
                </div>
                <input type="hidden" id="type_game" value="0"/>
                <ul class="form" id="game_file">
                    <li class="clearfix"><label><strong>UploadFile</strong>:</label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p> 
                            <p><i>Định dạng file: *.jar;*.apk;*.ipa;*.jad;(Dung lượng ko được quá 2 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>      
                        </div>
                    </li>
                    <div id="list_file_game">                   
                    </div>                    
                </ul>
                <ul class="form" id="game_link" style="display: none;">
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
                </ul>
            </div>
        </div>
    </div>

</div>