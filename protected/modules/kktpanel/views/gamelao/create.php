<?php
    $arr_status = LoadConfig::$status;

    //upload data
    $url = new Url();
    $forder_upload = "gamelao";
    $link_avatar = Yii::app()->params['urlImages']."upload_avatar.php?forder_upload=".$forder_upload;
    $link_url = Yii::app()->params['urlImages']."upload_base.php?forder_upload=".$forder_upload;
    //end upload data
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">

    window.onload = function(){
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

        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.jar;*.jad;*.apk;*.ipa;*.plist", 
            file_upload_limit : 20, 
            file_queue_limit :4, 
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
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:120px;height:120px" alt="pic">');

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
            var str_filename = $("#file_game").val() + ';' + filename;
            $("#file_game").val(str_filename);
            $("#show_file").append('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteFile('+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');" type="button" value=" Xóa " class="btn-bigblue"></p>');

        } catch (e) {

        };
    }

    function ajaxSaveGame(){

        var file_game = $("#file_game").val();
        var link_store = $("#link_store").val();
        var title_game = $('#title_game').val();
        var price = $('#price').val();
        var status = $('#status').val();
        var isHot = $('#isHot').val();
        var picture = $('#picture').val();
        var description_short = $('#description_short').val();
        var description = $('#description').val();
        var app_type = $('#app_type').val();
        var categoryId = $('#categoryId').val();
        var strUrl = "<?=$url->createUrl('gamelao/ajaxSaveGame')?>";

        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                file_game: file_game,
                link_store: link_store,
                title_game: title_game,
                price: price,
                picture: picture,
                status: status,
                isHot: isHot,
                description_short: description_short,
                description:CKEDITOR.instances.description.getData(),
                app_type: app_type,
                categoryId: categoryId
                
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gamelao/index")?>';
                }else{
                    $("#show_error").html(msg);
                }
            },
            beforeSend: function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete: function(){
                $("#button_save").removeAttr("disabled");
            }
        });
    }

    function ajaxDeleteFile(path,filesize,filename)
    {
        var strUrl = "<?=$url->createUrl("gamelao/ajaxDeleteFile") ?>";
        var file_game = $("#file_game").val();
        if(confirm('Bạn có chắc muốn xóa audio này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    filename: filename,
                    filesize: filesize,
                    file_game: file_game,
                    path:path
                },
                success: function(msg){
                    if(msg != 0){
                        alert('Xóa thành công');
                        $("#file_game").val(msg);
                        $("."+filesize).hide();
                    }else{
                        $("#show_error").html(msg);
                    }
                }          
            });
        }
    }


</script>


<div class="main clearfix">
    <div class="box clearfix bottom">

        <div class="col-570">
            <div class="box">
                <ul class="form">

                    <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="title_game"> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Giá</strong>:</label>
                        <div class="filltext">
                            <select id="price">
                                <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                                    <option value="<?php echo $value;?>"><?php echo $value;?></option>
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

                    <li class="clearfix"><label><strong>Loại app</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="app_type">
                                <option value="0">Game</option>
                                <option value="1">Ứng dụng</option>
                            </select>
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

                    <li class="clearfix"><label><strong>Nổi bật</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="isHot">
                                <option value="0">Không</option>
                                <option value="1">Có</option>
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

                            <input type="hidden" id="picture" value=""/>
                            <p id="show_pic"></p>

                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Tóm tắt </strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:220px" id="description_short">
                            </textarea> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Giới thiệu</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:320px" id="description"></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'description' );
                            </script>
                        </div>
                    </li>

                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxSaveGame();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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


        <div class="col5">&nbsp;</div>

        <div class="col-570">
            <div class="box">

                <div class="Tabs clearfix">
                    <ul class="clearfix">
                        <li><a class ="active" href="javascript:void(0)" ><span>&nbsp; Upload File &nbsp;</span></a></li>
                    </ul>
                    <input type="hidden" id="type_game" value="0"/>
                </div>

                <ul class="form">

                    <li class="clearfix" style=""><label><strong>Upload Game </strong></label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p> 
                            <p><i>Định dạng file: *.jar,*.jad,*.apk,*.ipa,*.plist;</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>
                            <input type="hidden" id="file_game" value=""/>
                            <div id="show_file"> Tên File Game:

                            </div>

                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Link Google Play</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="link_store"> 
                        </div>
                    </li>


                </ul>

            </div>
        </div>


    </div>
</div>