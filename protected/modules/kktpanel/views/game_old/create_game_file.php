<?php
    $url = new Url(); 
    $forder_upload = "game";  
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;

?>        
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>  
<script type="text/javascript">               
    var data_handset = <?php echo json_encode($data_handset);?>;
    window.onload = function() {
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:'<?php echo $data_game["create_date"]?>',
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.jar;*.apk;*.ipa;*.jad;*.cod", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUploadOther(configUploadDataOther);   
    };
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
    function ajaxSaveGameFile(){
        var gameId = '<?php echo $data_game["id"]?>';       
        var filename = $("#filename").val();
        var extension = $("#extension").val();
        var filesize = $("#filesize").val();
        var introtext_file = $("#introtext_file").val();
        var device = "";    
        $("input[name=device_0]").each(function(){
            device += this.value + ";";
        });
        var strUrl = "<?=$url->createUrl("game/ajaxSaveGameFile") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                type_game:0,
                gameId:gameId,
                filename:filename,
                extension:extension,
                filesize:filesize,
                introtext_file:introtext_file, 
                device:device
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("game/gameFile",array("gameId"=>$data_game["id"]))?>';
                }else if(msg==2){
                    alert('Game bạn upload chưa đủ cặp file đuôi (jar,jad)!Game này sẽ bị ẩn');
                    window.location = '<?php echo $url->createUrl("game/gameFile",array("gameId"=>$data_game["id"]))?>';
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
        <input type="hidden" id="type_game" value="0"/>  
        <ul class="form4">
            <li class="clearfix"><label></label>
                <div class="filltext">
                    <p>Thêm mới file game cho game: <strong><?php echo $data_game["title"];?></strong></p> 
                </div>
            </li>
            <li class="clearfix"><label><strong>UploadFile</strong>:</label>
                <div class="filltext">
                    <p>
                        <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                        <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                        <span id="spanButtonPlaceHolder_other"></span>
                    </p> 
                    <p><i>Định dạng file: *.jar;*.apk;*.ipa;*.jad;*.cod(Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress_other">
                        <span class="legend">File upload</span>
                    </div>   
                </div>
            </li>
            <div id="list_file_game"></div> 
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