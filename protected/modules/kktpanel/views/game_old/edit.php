<?php
    $url = new Url(); 
    $forder_upload = "game";  
    $arr_status = LoadConfig::$status;
    $data_partner = APartner::getAllPartner();
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload; 
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
            create_date:'<?php echo $data['create_date'];?>',
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
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" class="img-100" alt="pic">')
        } catch (e) {

        };
    }
    function ajaxUpdateGame(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
             appId = parseInt(this.value) + appId;
        });
        var id = '<?php echo $data["id"]?>';
        var title_game = $("#title_game").val();
        var title_sms = $("#title_sms").val();
        var categoryId = $("#categoryId").val();
        var picture = $("#picture").val();
        var introtext = $("#introtext").val();
        var position = $("#position").val();
        var strUrl = "<?=$url->createUrl("game/ajaxUpdateGame") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                title_game:title_game,
                title_sms:title_sms,
                categoryId:categoryId,
                picture:picture,
                position:position,
                status:$("#status").val(),
                price:$("#price").val(),
                partnerId:$("#partnerId").val(),
                percent_partner:$("#percent_partner").val(),
                percent_telco:$("#percent_telco").val(),
                percent_wapmaster:$("#percent_wapmaster").val(),
                introtext:introtext,
                price:$("#price").val(),
                appId:appId,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    history.go(-1);
                }else if(msg==2){
                    alert('Game bạn upload chưa đủ cặp file đuôi (jar,jad)!Game này sẽ bị ẩn');
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
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <ul class="form4">
            <li class="clearfix"><label><strong>Tên game </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data["title"]?>" id="title_game"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Tiêu đề tin nhắn </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="<?php echo $data["title_sms"]?>" id="title_sms" maxlength="40"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Danh mục </strong>:</label>
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
                    <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress">
                        <span class="legend">File upload</span>
                    </div>

                    <input type="hidden" id="picture" value="<?php echo $data["picture"];?>"/>
                    <p id="show_pic"><img class="img-100" src="<?php echo Common::getImage($data["picture"],"game",$data["create_date"])?>" /></p>
                </div>
            </li>
            <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                <div class="filltext">
                    <textarea cols="5" rows="5" style="width:500px; height:120px" id="introtext"><?php echo $data["introtext"];?></textarea>
                </div>
            </li>
            <li class="clearfix"><label><strong>Vị trí</strong>:</label>
                <div class="filltext">
                    <input type="text" id="position" style="width: 360px;" value="<?php echo $data["position"];?>"/>
                </div>
            </li>
            <li class="clearfix"><label><strong>Nhà cung cấp</strong>:</label>
                    <div class="filltext">
                        <select id="partnerId" style="width:150px;">
                            <?php foreach ($data_partner as $key=>$value){?>
                                <option value="<?php echo $value["id"]?>" <?php echo $value["id"] == $data["partnerId"] ? 'selected="selected"':''?>><?php echo $value["name"];?></option>
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
                    <input type="button" id="button_save" value=" Sửa " class="btn-bigblue" onclick="ajaxUpdateGame();"> 
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