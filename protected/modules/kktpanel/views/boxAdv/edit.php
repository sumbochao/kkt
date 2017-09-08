<?php
    $url = new Url(); 
    $forder_upload = "banner";  
    $link_url = Yii::app()->params["urlImages"]."upload.php?forder_upload=".$forder_upload;
    $arr_status = LoadConfig::$status;
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
            create_date:'<?php echo $data["create_date"];?>',
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

    function ajaxUpdateBanner(){
        var id = '<?php echo $data["id"];?>';
        var title_adv = $("#title_adv").val();
        var picture = $("#picture").val();
        var status = $("#status").val();
        var link = $("#link").val();
        var strUrl = "<?=$url->createUrl("boxAdv/ajaxUpdateBanner") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                title_adv:title_adv,
                picture:picture,
                link:link,
                status:status,
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("boxAdv/index")?>';
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
            <li class="clearfix"><label><strong>Tiêu đề banner </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data["title"];?>" id="title_adv"> 
                </div>
            </li>

            <li class="clearfix"><label><strong>Ảnh banner </strong>:</label>
                <div class="filltext">
                    <p>
                        <input type="hidden" id="txtFileName" readonly="readonly"/>
                        <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                        <span id="spanButtonPlaceHolder"></span>
                    </p>
                    <p><i>Định dạng file:*.jpg;*.jpeg;*.png;*.gif (Dung lượng ko được quá 2 MB)</i></p>
                    <p><i>Kích thước đề nghị 320x50</i></p> 
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress">
                        <span class="legend">File upload</span>
                    </div>
                    <input type="hidden" id="picture" value="<?php echo $data["picture"];?>"/>
                    <p id="show_pic"><img src="<?php echo Common::getImage($data["picture"],"banner",$data["create_date"])?>"></p>
                </div>
            </li>
            <li class="clearfix"><label><strong>Link đến</strong>:</label>
                <div class="filltext">
                    <input type="text" id="link" style="width: 230px;" value="<?php echo $data["link"];?>"/>
                </div>
            </li>
            <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                <div class="filltext">
                    <select style="width:203px;" id="status">
                        <?php foreach($arr_status as $key=>$value){?>
                            <option value="<?php echo $key;?>" <?php echo $data["status"]==$key ? 'selected="selected"':''?>><?php echo $value?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" onclick="ajaxUpdateBanner();" type="button" value=" Sửa " class="btn-bigblue"> 
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