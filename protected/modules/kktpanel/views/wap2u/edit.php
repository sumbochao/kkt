<?php
    $url = new Url();
    $type_cats = LoadConfig::$type_cat; 
    $arr_status = LoadConfig::$status;
    $forder_upload = "wap2u";  
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
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
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
            var type_size = $("input[name=type_size]:checked").val();
            if(type_size==0){
                $("#picture").val(filename);
                $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" class="img-100" alt="pic">');
            }
        } catch (e) {

        };
    }

    function ajaxUpdateApp(){
        var strUrl = "<?php echo $url->createUrl("wap2u/ajaxUpdateApp") ?>";
        var id = '<?php echo $data["id"]?>';
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                title:$("#title").val(),
                type_cat:$("#type_cat").val(),
                version:$("#version").val(),
                picture:$("#picture").val(),
                description:$("#description").val(),
                link_ios:$("#link_ios").val(),
                link_android:$("#link_android").val(),
                link_java:$("#link_java").val(),
                link_window:$("#link_window").val(),
                status:$("#status").val(),
                order_app:$("#order_app").val(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Update thành công');
                    window.location = '<?php echo $url->createUrl("wap2u/index")?>';
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
            <li class="clearfix"><label><strong>Tiêu đề </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['title']; ?>" id="title"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Loại danh mục </strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="type_cat">
                        <?php foreach($type_cats as $key=>$value){?>
                            <option value="<?php echo $key;?>" <?php echo $data['type'] == $key ? "selected=selected" :"";  ?>><?php echo $value?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label><strong>Version</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['version'] ?>" id="version"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Link IOS</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['link_ios'] ?>" id="link_ios"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Link Android</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['link_android'] ?>" id="link_android"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Link Java</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['link_java'] ?>" id="link_java"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Link Window</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['link_window'] ?>" id="link_window"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="status">
                        <?php foreach($arr_status as $key=>$value){?>
                            <option value="<?php echo $key;?>" <?php echo $data["status"]==$key ? 'selected="selected"':''; ?>><?php echo $value?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label><strong>Vị trí</strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data['order_app'] ?>" id="order_app"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                <div class="filltext">
                    <textarea cols="5" rows="5" style="width:624px; height:120px" id="description"><?php echo $data['description'] ?></textarea>
                </div>
            </li>
            <li class="clearfix"><label><strong>Ảnh minh họa </strong>:</label>
                <div class="filltext">
                    <p>
                        <input type="hidden" id="txtFileName" readonly="readonly"/>
                        <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                        <span id="spanButtonPlaceHolder"></span>
                    </p>
                    <p>
                        <input type="radio" name="type_size" value="0" checked="checked"/> Ảnh vuông (155x155)
                    </p>
                    <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress">
                        <span class="legend">File upload</span>
                    </div>

                    <input type="hidden" id="picture" value="<?php echo $data["picture"] ?>"/>
                    Ảnh vuông: <p id="show_pic"><img class="img-100" src="<?php echo Common::getImage($data["picture"],"wap2u",$data["create_date"])?>"/></p>

                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" type="button" value=" Cập nhật " class="btn-bigblue" onclick="ajaxUpdateApp();"> 
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