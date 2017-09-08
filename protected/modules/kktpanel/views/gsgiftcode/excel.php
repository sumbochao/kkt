<?php
    $url = new Url(); 
    $forder_upload = "gamestore/giftcode";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
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
            create_date: '<?php echo strtotime($create_date);?>',
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.xls;*.xlsx;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUploadOther(configUploadDataOther);
    }

    function uploadResponseOther(serverData){  
        try {
            $("#txtFileName_other").val(""); 
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
            $("#excel").val(filename);
            $("#show_excel").html('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteIpa('+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        };
    }

    function ajaxExcel(){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxExcel')?>";
        var excel = $('#excel').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data:{
                excel: excel,
                id: '<?php echo $id?>',
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsgiftcode/code",array('id'=>$id))?>';
                }else{
                    alert('Có lỗi');
                    $("#show_error").html(msg);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if(thrownError == "CDbException")
                {
                    $("#show_error").html('Dữ liệu đã tồn tại');
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

        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Gift Code </strong>:</label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                            <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder_other"></span>
                        </p>

                        <p><i>Định dạng file: *.xls; *.xlsx;(Dung lượng ko được quá 200 MB)</i></p>
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress_other">
                            <span class="legend">File upload</span>
                        </div>

                        <input type="hidden" id="excel" value=""/>
                        <p id="show_excel"></p>

                    </div>
                </li>
                <li>
                    <label><strong>&nbsp; </strong></label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxExcel();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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
</div>
