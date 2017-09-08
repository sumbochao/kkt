<?php
    $url = new Url(); 
    $forder_upload = "image";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
    $link_image = Yii::app()->params["urlImages"]."upload_image.php?forder_upload=".$forder_upload; 
    $arr_status = LoadConfig::$status;     
?>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    var i = parseInt('<?php echo count($data_image);?>');
    window.onload = function() {
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:'<?php echo $data["create_date"]?>',
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:'<?php echo $data["create_date"]?>',
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_image;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 20, 
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
            var type_size = $("input[name=type_size]:checked").val();
            if(type_size==0){
                $("#picture").val(filename);
                $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" class="img-100" alt="pic">');
            }else if(type_size==1){
                $("#picture_320_240").val(filename);
                $("#show_pic_320_240").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:320px;height:240px" alt="pic">');
            }else if(type_size==2){
                $("#picture_240_320").val(filename);
                $("#show_pic_240_320").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:240px;height:320px" alt="pic">');
            }
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
            var msg = '<li class="clearfix"><div class="clearfix">';
            msg += '<div class="tool-image clearfix"><span class="fl">'
            msg += '<input type="checkbox" value="'+i+'" name="check_id" checked></span></div>';
            msg += '<input type="hidden" id="filename_'+i+'" value="'+filename+'"/>';
            msg += '<a href="#" title=""><img border="0" class="img-113-120" src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" /></a>'
            msg += '</div></li>';
            i++;
            $("#list_image").append(msg);
        } catch (e) {

        };
    }
    function ajaxUpdateAlbum(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
            appId = parseInt(this.value) + appId;
        });
        var id = '<?php echo $data["id"]?>';
        var title_album = $("#title_album").val();
        var title_sms = $("#title_sms").val();
        var categoryId = $("#categoryId").val();
        var picture = $("#picture").val();
        var introtext = $("#introtext").val();
        var status = $("#status").val();
        var item = $("input[name=check_id]:checked");
        if(item.length==0){
            $("#show_error").html('Bạn chưa chọn file ảnh nào cho album');
            return false;
        }
        var filename = "";
        item.each(function(){
            filename += $("#filename_"+this.value).val() + ":|:";
        });
        var strUrl = "<?=$url->createUrl("album/ajaxUpdateAlbum") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                title_album:title_album,
                price:$("#price").val(),
                title_sms:title_sms,
                categoryId:categoryId,
                picture:picture,
                 picture_320_240:$("#picture_320_240").val(),
                picture_240_320:$("#picture_240_320").val(),
                introtext:introtext,
                status:status,
                filename:filename,
                appId:appId,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("album/index")?>';
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
            <li class="clearfix"><label><strong>Tên album </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data["title"];?>" id="title_album"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Tiêu đề tin nhắn </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data["title_sms"];?>" id="title_sms" maxlength="40"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Danh mục Album</strong>:</label>
                <div class="filltext">
                    <select id="categoryId">
                        <?php foreach($data_cat as $key=>$value){?>
                            <option value="<?php echo $key;?>" <?php echo $key == $data["categoryId"] ? 'selected="selected"':''?>><?php echo $value;?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label><strong>App su dung</strong>:</label>
                <div class="filltext">
                    <?php foreach(User::getAllApp() as $key=>$value){?>
                        <input type="checkbox" name="appId" value="<?php echo $key?>" <?php echo ($data["app_ids"] & $key=$key) ? 'checked':''; ?>/><?php echo $value;?>
                        <?php }?>
                </div>
            </li>
            <li class="clearfix"><label><strong>Giá</strong>:</label>
                <div class="filltext">
                    <select id="price">
                        <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                            <option value="<?php echo $value;?>" <?php echo $value == $data["price"] ? 'selected="selected"':''?>><?php echo $value;?></option>
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
                    <p>
                        <input type="radio" name="type_size" value="0" checked="checked"/> Ảnh vuông
                        <input type="radio" name="type_size" value="1"/> Ảnh 320x240
                        <input type="radio" name="type_size" value="2"/> Ảnh 240x320
                    </p>
                    <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress">
                        <span class="legend">File upload</span>
                    </div>

                    <input type="hidden" id="picture" value="<?php echo $data["picture"];?>"/>
                    Ảnh vuông: <p id="show_pic"><img class="img-100" src="<?php echo Common::getImage($data["picture"],"image",$data["create_date"])?>"/></p>
                    <input type="hidden" id="picture_320_240" value="<?php echo $data["picture_320_240"];?>"/>
                    Ảnh 320x240: <p id="show_pic_320_240"><img style="width:320px;height:240px" src="<?php echo Common::getImage($data["picture_320_240"],"image",$data["create_date"])?>"/></p>
                    <input type="hidden" id="picture_240_320" value="<?php echo $data["picture_240_320"];?>"/>
                    Ảnh 240x320: <p id="show_pic_240_320"><img style="width:240px;height:320px" src="<?php echo Common::getImage($data["picture_240_320"],"image",$data["create_date"])?>"/></p>
                </div>
            </li>
            <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                <div class="filltext">
                    <textarea cols="5" rows="5" style="width:570px; height:120px" id="introtext"><?php echo $data["introtext"];?></textarea>
                </div>
            </li>
            <li class="clearfix"><label><strong>UploadFile</strong>:</label>
                <div class="filltext">
                    <p>
                        <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                        <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                        <span id="spanButtonPlaceHolder_other"></span>
                    </p> 
                    <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress_other">
                        <span class="legend">File upload</span>
                    </div>
                    <ul class="list-itemst clearfix" id="list_image">
                        <?php for($i=0;$i<count($data_image);$i++){?>
                            <li class="clearfix">
                                <div class="clearfix">
                                    <div class="tool-image clearfix">
                                        <span class="fl">
                                            <input type="checkbox" name="check_id" checked="checked" value="<?php echo $i;?>" />
                                        </span>  
                                    </div>
                                    <input type="hidden" id="filename_<?php echo $i;?>" value="<?php echo $data_image[$i]["file"]?>"/>
                                    <a href="#" title=""><img border="0" class="img-113-120" src="<?php echo Common::getImage($data_image[$i]["file"],"image",$data_image[$i]["create_date"])?>" /></a>
                                </div> 
                            </li>
                            <?php }?>
                    </ul>
                </div>
            </li>
            <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="status">
                        <?php foreach($arr_status as $key=>$value){?>
                            <option value="<?php echo $key;?>" <?php echo $key == $data["status"] ? 'selected="selected"':''?>><?php echo $value?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" onclick="ajaxUpdateAlbum();" type="button" value=" Sửa " class="btn-bigblue"> 
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