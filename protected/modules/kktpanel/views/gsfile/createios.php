
<?php
    $url = new Url(); 
    $forder_upload = "gamestore/game";  
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
    //var_dump($game_id);
?>

<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.ipa;", 
            file_upload_limit : 20, 
            file_queue_limit : 4, 
            debug : false
        }
        var configUploadDataOther2 = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.plist;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUploadOther(configUploadDataOther);
        configUploadOther2(configUploadDataOther2);
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
            filesize = parseInt(filesize/1024/1024);
            $("#file").val(filename);
            $("#name").val(filename);
            $("#size").val(filesize);
            $("#show").html('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteFile('+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');$(this).parent().fadeOut();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        };
    }
    
    function uploadResponseOther2(serverData){  
        try {
            $("#txtFileName_other2").val(""); 

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
            $("#file_plist").val(filename);
            $("#show_plist").html('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDelete('+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');$(this).parent().fadeOut();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        };
    }

    function ajaxSaveIos(){
        var strUrl = "<?=$url->createUrl("gsfile/ajaxSaveIos") ?>";
        var game_id = "<?php echo $game_id;?>";
        var name = $('#name').val();
        var file_plist = $('#file_plist').val();
        var size = $('#size').val();
        var version = $("#version").val();
        var version_os = $("#version_os").val();
        $.ajax({
            type:"POST",
            url: strUrl,
            data: {
                game_id: game_id,
                name: name,
                size: size,
                file_plist: file_plist,
                version: version,
                version_os: version_os
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsfile/index",array('id'=>$game_id))?>';
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
    
    function ajaxDeleteFile(link,size,name){
        var strUrl = "<?=$url->createUrl("gsfile/ajaxDeleteFile") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                link: link,
                name: name,
            },
            success: function(msg){
                if(msg != 0){
                    alert('Xóa thành công');
                    $("#name").val("");
                    $("#size").val("");
                    $("."+size).hide();
                }
            },
        });
    }

</script>

<div class="main clearfix">
    <div class="box clearfix bottom30"> 

        <div class="col-570"> 
            <div clas = "box">

                <ul class="form">
                    <li class="clearfix">
                        <strong>Thêm File</strong>
                        <hr>
                    </li>

                    <li>
                        <p>
                            <label><strong>File Name:</strong></label>
                            <input type="text" name="name" id="name" style="width: 200px;" readonly="">
                        </p>
                    </li>

                    <li>
                        <p>
                            <label><strong>Size:</strong></label>
                            <input type="text" name="size" id="size" style="width: 200px;" readonly="">
                        </p>
                    </li>

                    <li>
                        <p>
                            <label><strong>Version:</strong></label>
                            <input type="text" name="version" id="version" style="width: 200px;">
                        </p>
                    </li>

                    <li>
                        <p>
                            <label><strong>Os Version:</strong></label>
                            <input type="text" name="version_os" id="version_os" style="width: 200px;">
                        </p>
                    </li>

                    <li id = "li1" class="clearfix">
                    <label><strong>Upload :</strong></label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                            <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder_other"></span>
                        </p> 
                        <p><i>Định dạng file: *.ipa;</i></p>
                    </div>
                    <li>

                    <li style="margin-left: 100px;">
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress_other">
                            <span class="legend">File upload</span>
                        </div>
                        <input type="hidden" id="file" value=""/>
                        <div id="show"> Tên File Game:</div> 
                    </li>
                    
                    <li id = "li1" class="clearfix">
                    <label><strong>Upload :</strong></label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName_other2" readonly="readonly"/>
                            <input type="text" id="urlFile_other2" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder_other2"></span>
                        </p> 
                        <p><i>Định dạng file: *.plist;</i></p>
                    </div>
                    <li>

                    <li style="margin-left: 100px;">
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress_other2">
                            <span class="legend">File upload</span>
                        </div>
                        <input type="hidden" id="file_plist" value=""/>
                        <div id="show_plist"> Tên File Game:</div> 
                    </li>

                    <li style="margin-left: 100px;">
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxSaveIos();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                            &nbsp;
                            <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                        </div>
                    </li>

                    <li class="clearfix" style="margin-left: 100px;">
                        <div class="filltext" style="color: red;" id="show_error"></div>
                    </li>

                </ul>

            </div>
        </div>

    </div>
</div>