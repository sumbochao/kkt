<?php
    $arr_status = LoadConfig::$status;
    $url = new Url(); 
    $arr_page =LoadConfig::$arr_page;
    $forder_upload = "news";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
?>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script> 
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
    function ajaxSaveNews(){
         var page_id =0;
        $("input[name=page_id]:checked").each(function(){
            page_id = parseInt(this.value) + page_id;
        });
        var tags = $("#tags").val();
        var strUrl = "<?=$url->createUrl("news/ajaxSaveNews") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                page_id:page_id,
                tags:tags,
                title_news:$("#title_news").val(),
                categoryId:$("#categoryId").val(),
                picture:$("#picture").val(),
                introtext:$("#introtext").val(),
                description:CKEDITOR.instances.description.getData(),
                status:$("#status").val(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm mới thành công');
                    window.location = '<?php echo $url->createUrl("news/index")?>';
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
            <li class="clearfix"><label><strong>Tiêu đề tin </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:360px" value="" id="title_news"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Page sử dụng</strong>:</label>
                        <div class="filltext">
                            <?php foreach($arr_page as $key=>$value){?>
                                <input type="checkbox" name="page_id" value="<?php echo $key?>"/><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>
            <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                <div class="filltext">
                    <select id="categoryId">
                        <?php foreach($data_cat as $key=>$value){?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>
                            <?php }?>
                    </select>
                </div>
            </li>
            <li class="clearfix"><label><strong>Ảnh đại diện </strong>:</label>
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
                    <textarea cols="5" rows="5" style="width:570px; height:120px" id="introtext"></textarea>
                </div>
            </li>
            <li class="clearfix"><label><strong>Nội dung</strong>:</label>
                <div class="filltext">
                    <textarea id="description" name="description"></textarea>
                     <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description' );
                    </script>
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
            <li class="clearfix"><label><strong>Tags</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:120px" id="tags"></textarea>
                        </div>
                    </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" type="button" value=" Thêm mới " class="btn-bigblue" onclick="ajaxSaveNews()"> 
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