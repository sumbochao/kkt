<?php
    $url = new Url(); 
    $forder_upload = "bongda/coach";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['static_url']; ?>css/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url']; ?>js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
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
        
          
        
        configUpload(configUploadData);
       
    }

    function uploadResponse(serverData){  
        try {
            $("#txtFileName").val(""); 
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
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:50%;height:50%" alt="pic">');

        } catch (e) {

        };
    }
    
   
    function ajaxSave()
    {
        var strUrl = "<?=$url->createUrl("footBallCoach/ajaxSaveCoach") ?>";
        var name = $('#name').val();
        var name_en = $('#name_en').val(); 
        var avatar = $('#picture').val();
        var country = $('#country').val();
        var birthday = $('#birthday').val();
        var height = $('#height').val();
        var weight = $('#weight').val();
        var formerclub = $('#formerclub').val();
        var joindate = $('#joindate').val();
        var oneclub = $('#oneclub').val();         
        var id_7m = $('#id_7m').val();
        var avatar_link = $('#avatar_link').val();     
        
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                name: name,
                name_en: name_en,
                avatar: avatar,
                avatar_link: avatar_link,  
                country: country,
                birthday: birthday,
                height: height,
                weight: weight,
                joindate:joindate, 
                formerclub:formerclub, 
                oneclub:oneclub, 
                id_7m:id_7m, 
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("footBallCoach/index")?>';
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
        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Tên huấn luyện viên </strong>:</label>
                    <div class="filltext">
                        <input type="hidden" style="width:360px" value="0" id="id">   
                        <input type="text" style="width:360px" value="" id="name"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tên tiếng anh </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="name_en"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Quốc gia </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="country"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sinh nhật</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="birthday"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Chiều cao</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="height"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Cân nặng</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="weight"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Ngày gia nhập CLB</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="joindate"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Club trước</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="formerclub"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Club khác</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="oneclub"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>ID 7M</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="id_7m"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Ảnh </strong>:</label>
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
                         <p id="show_pic">
                        </p>

                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSave();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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