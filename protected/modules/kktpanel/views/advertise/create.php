<?php
    $url = new Url(); 
    $forder_upload = "banner";  
    $link_url = Yii::app()->params["urlImages"]."upload.php?forder_upload=".$forder_upload;
    $arr_status = LoadConfig::$status;
    $box = LoadConfig::$box;
    $dynamic = LoadConfig::$dynamic;
    $type_content = LoadConfig::$type_content;
?>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#type_banner").change(function(){
            if(this.value==0){
                 $("#area_banner_image").show();
            }else{
                 $("#area_banner_image").hide();
            }
        });
        
        $("#dynamic").change(function(){
            if(this.value==0){
                 $("#area_link_0").show();
                 $("#area_link_1").hide();
            }else{
                 $("#area_link_1").show();
                 $("#area_link_0").hide();
            }
        });
    });
    window.onload = function() {
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUpload(configUploadData); 
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
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" alt="pic">')
        } catch (e) {

        };
    }

    function ajaxSaveBanner(){
        var strUrl = "<?=$url->createUrl("advertise/ajaxSaveBanner") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                title_adv:$("#title_adv").val(),
                box:$("#box").val(),
                picture:$("#picture").val(),
                dynamic:$("#dynamic").val(),
                link:$("#link").val(),
                type_content:$("#type_content").val(),
                status:$("#status").val(),
                type_banner:$("#type_banner").val(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("advertise/index")?>';
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
            <li class="clearfix"><label><strong>Loại banner </strong>:</label>
                <div class="filltext">
                    <select id="type_banner">
                        <option value="0">Banner ảnh</option>
                        <option value="1">Banner text</option>
                    </select> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Quảng cáo trên box </strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="box">
                        <?php foreach($box as $key=>$value){?>
                            <option value="<?php echo $key;?>"><?php echo $value?></option>
                            <?php }?>
                    </select> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Tiêu đề banner </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="" id="title_adv"> 
                </div>
            </li>

            <li class="clearfix" id="area_banner_image"><label><strong>Ảnh banner </strong>:</label>
                <div class="filltext">
                    <p>
                        <input type="hidden" id="txtFileName" readonly="readonly"/>
                        <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                        <span id="spanButtonPlaceHolder"></span>
                    </p>
                    <p><i>Định dạng file:*.jpg;*.jpeg;*.png;*.gif (Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress">
                        <span class="legend">File upload</span>
                    </div>
                    <input type="hidden" id="picture" value=""/>
                    <p id="show_pic"></p>
                </div>
            </li>                   
            <li class="clearfix"><label><strong>Loại link </strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="dynamic">
                        <?php foreach($dynamic as $key=>$value){?>
                            <option value="<?php echo $key;?>"><?php echo $value?></option>
                            <?php }?>
                    </select> 
                </div>
            </li>
            <li class="clearfix" id="area_link_0"><label><strong>Link đến</strong>:</label>
                <div class="filltext">
                    <input type="text" id="link" style="width: 230px;"/>
                </div>
            </li>
            <li class="clearfix" id="area_link_1" style="display: none;"><label><strong>Kiểu quảng cáo </strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="type_content">
                        <?php foreach($type_content as $key=>$value){?>
                            <option value="<?php echo $key;?>"><?php echo $value?></option>
                            <?php }?>
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
                    <input id="button_save" onclick="ajaxSaveBanner();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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