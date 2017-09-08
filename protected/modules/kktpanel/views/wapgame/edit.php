<?php
    $url = new Url(); 
    $forder_upload = "wapgame";  
    $forder_upload1 = "gamekhwapthugian";  
    $arr_page =LoadConfig::$arr_page;
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
    //$link_url = "http://".$_SERVER["HTTP_HOST"].":8000/upload/upload_base.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
    $link_url1 = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload1;
    $arr_status = LoadConfig::$status;
    $path= "wapgame/".date("Y",$data['create_date'])."/".date("md",$data['create_date'])."/";
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
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.jar;*.jad;*.apk;*.ipa;*.plist", 
            file_upload_limit : 20, 
            file_queue_limit :4, 
            debug : false
        }
        /*var configUploadDataOther2 = {
        flash_url:"<?php //echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
        create_date:"<?php //echo $data['create_date']; ?>",
        button_image_url:"<?php //echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
        upload_url: "<?php //echo $link_url1;?>", 
        file_types: "*.jar;*.jad;*.apk;*.ipa;*.plist", 
        file_upload_limit : 20, 
        file_queue_limit :4, 
        debug : false
        }*/
        configUpload(configUploadData); 
        configUploadOther(configUploadDataOther);  
        /*configUploadOther2(configUploadDataOther2); */
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
            $("#show_file").append('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteFile('+'\''+'<?php echo $data['id'] ;?>'+'\','+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');" type="button" value=" Xóa " class="btn-bigblue"></p>');

        } catch (e) {

        };
    }
    /*function uploadResponseOther2(serverData){  
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
    var str_filename = $("#file_gamekh").val() + ';' + filename;
    $("#file_gamekh").val(str_filename);
    $("#show_filekh").append('</br><p class="'+filesize+'" ><a target="_blank" href="<?php //echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteFile('+'\''+'<?php //echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');" type="button" value=" Xóa " class="btn-bigblue"></p>');

    } catch (e) {

    };
    }*/

    function ajaxUpdateGame(){
        var page_id =0;
        $("input[name=page_id]:checked").each(function(){
            page_id = parseInt(this.value) + page_id;
        });
        var id = '<?php echo $data["id"]?>';
        var file_game = $("#file_game").val();
        var link_store = $("#link_store").val();
        var title_game = $("#title_game").val();
        var description = $("#description").val();

        var tags = $("#tags").val();
        var description_short = $("#description_short").val();
        var status = $("#status").val();
        var isHot = $("#isHot").val();
        var appType = $("#appType").val();
        var strUrl = "<?=$url->createUrl("wapgame/ajaxUpdateGame") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                page_id:page_id,
                tags:tags,
                file_game:file_game,
                title_game:title_game,
                link_store:link_store,
                picture:$("#picture").val(),
                description:CKEDITOR.instances.description.getData(),
                description_short:description_short,
                status:status,
                isHot:isHot,
                appType:appType,
                price:$("#price").val(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Cập nhật thành công');
                    window.location = '<?php echo $url->createUrl("wapgame/index")?>';
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

    function ajaxDeleteFile(id,path,filesize,filename){
        var strUrl = "<?=$url->createUrl("wapgame/ajaxDeleteFile") ?>";
        var file_game = $("#file_game").val();
        if(confirm('Bạn có chắc muốn xóa game này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    id:id, 
                    filename:filename,
                    file_game:file_game,
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
    <div class="box clearfix bottom30">  

        <div class="col-570">  
            <div clas = "box">
                <ul class="form">
                    <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['title']; ?>" id="title_game"> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Page sử dụng</strong>:</label>
                        <div class="filltext">
                            <?php foreach($arr_page as $key=>$value){ ?>
                                <input type="checkbox" name="page_id" value="<?php echo $key?>" <?php echo ($data["page_id"] & $key=$key) ? 'checked':''; ?>/><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Giá</strong>:</label>
                        <div class="filltext">
                            <select id="price">
                                <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                                    <option value="<?php echo $value;?>" <?php echo $value == $data["price"] ? 'selected="selected"':''?> ><?php echo $value;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="status">
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo $key == $data["status"] ? 'selected="selected"':''?> ><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Loại App</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="appType">
                                <option value="0" <?php echo $data["app_type"]==0 ? 'selected="selected"':''?>>Game</option>
                                <option value="1" <?php echo $data["app_type"]==1 ? 'selected="selected"':''?>>App</option>
                            </select>
                        </div>
                    </li>    
                    <li class="clearfix"><label><strong>Nổi bật</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="isHot">
                                <option value="0" <?php echo $data["isHot"]==0 ? 'selected="selected"':''?>>Không</option>
                                <option value="1" <?php echo $data["isHot"]==1 ? 'selected="selected"':''?>>Có</option>
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

                            <input type="hidden" id="picture" value="<?php echo $data['image'];?>"/>
                            <p id="show_pic"><img style="width:120px;height:120px" src="<?php echo Common::getImage($data["image"],"wapgame",$data["create_date"])?>"/></p>

                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:120px" id="description_short"><?php echo $data['description_short'] ?></textarea>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Giới thiệu</strong>:</label>
                        <div class="filltext">
                            <textarea name="description" cols="5" rows="5" style="width:420px; height:120px" id="description"><?php echo $data['description'] ?></textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'description' );
                            </script>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Tags </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['tags'] ?>" id="tags"> 
                        </div>
                    </li>

                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxUpdateGame();" type="button" value=" Cập Nhật " class="btn-bigblue"> 
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
        <div class ="col-570">
            <div class="box">
                <div class="Tabs clearfix">
                    <ul class="clearfix">
                        <li><a class ="active" href="javascript:void(0)" ><span>&nbsp; Upload File &nbsp;</span></a></li>
                    </ul>
                    <input type="hidden" id="type_game" value="0"/>
                </div>
                <ul class="form">
                    <!--<div id="data_edit_upload">-->

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
                            <input type="hidden" id="file_game" value="<?php echo $data['file_jar'].";".$data['file_jad'].";".$data['file_apk'].";".$data['file_ipa'] ?>"/>
                            <div id="show_file"> Tên File Game:
                                <?php if(isset($data['file_jar'])&& $data['file_jar']!="" ){ ?>
                                    <p class="10"><a alt="<?php echo $data['file_jar'] ?>" href="<?php echo Common::getImage($data['file_jar'],"wapgame",$data['create_date']) ?>" target="_blank"><?php echo $data['file_jar'] ?></a><input type="button" class="btn-bigblue" value=" Xóa " onclick="ajaxDeleteFile('<?php echo $data['id']; ?>','<?php echo $path.$data['file_jar'] ?>','10','<?php echo $data['file_jar'] ?>');"></p>                             
                                    <?php } ?>
                                <?php if(isset($data['file_jad'])&& $data['file_jad']!="" ){ ?>
                                    <p class="20"><a alt="<?php echo $data['file_jad'] ?>" href="<?php echo Common::getImage($data['file_jad'],"wapgame",$data['create_date']) ?>" target="_blank"><?php echo $data['file_jad'] ?></a><input type="button" class="btn-bigblue" value=" Xóa " onclick="ajaxDeleteFile('<?php echo $data['id']; ?>','<?php echo $path.$data['file_jad'] ?>','20','<?php echo $data['file_jad'] ?>');"></p>                             
                                    <?php } ?>
                                <?php if(isset($data['file_apk'])&& $data['file_apk']!="" ){ ?>
                                    <p class="30"><a alt="<?php echo $data['file_apk'] ?>" href="<?php echo Common::getImage($data['file_apk'],"wapgame",$data['create_date']) ?>" target="_blank"><?php echo $data['file_apk'] ?></a><input type="button" class="btn-bigblue" value=" Xóa " onclick="ajaxDeleteFile('<?php echo $data['id']; ?>','<?php echo $path.$data['file_apk'] ?>','30','<?php echo $data['file_apk'] ?>');"></p>                             
                                    <?php } ?>
                                <?php if(isset($data['file_ipa'])&& $data['file_ipa']!="" ){ ?>
                                    <p class="40"><a alt="<?php echo $data['file_ipa'] ?>" href="<?php echo Common::getImage($data['file_ipa'],"wapgame",$data['create_date']) ?>" target="_blank"><?php echo $data['file_ipa'] ?></a><input type="button" class="btn-bigblue" value=" Xóa " onclick="ajaxDeleteFile('<?php echo $data['id']; ?>','<?php echo $path.$data['file_ipa'] ?>','40','<?php echo $data['file_ipa'] ?>');"></p>                             
                                    <?php } ?>
                                <?php if(isset($data['file_plist'])&& $data['file_plist']!="" ){ ?>
                                    <p class="50"><a alt="<?php echo $data['file_plist'] ?>" href="<?php echo Common::getImage($data['file_plist'],"wapgame",$data['create_date']) ?>" target="_blank"><?php echo $data['file_plist'] ?></a><input type="button" class="btn-bigblue" value=" Xóa " onclick="ajaxDeleteFile('<?php echo $data['id']; ?>','<?php echo $path.$data['file_plist'] ?>','50','<?php echo $data['file_plist'] ?>');"></p>                             
                                    <?php } ?>
                            </div>

                        </div>
                    </li>
                    <!--<li class="clearfix" style=""><label><strong>Upload Game KH </strong></label>
                    <div class="filltext">
                    <p>
                    <input type="hidden" id="txtFileName_other2" readonly="readonly"/>
                    <input type="text" id="urlFile_other2" style="border:1px solid #DFDFDF; width: 200px;">                            
                    <span id="spanButtonPlaceHolder_other2"></span>
                    </p> 
                    <p><i>Định dạng file: *.jar,*.jad,*.apk,*.ipa;</i></p>
                    <br/>
                    <div class="fieldset flash" id="fsUploadProgress_other2">
                    <span class="legend">File upload</span>
                    </div>
                    <input type="hidden" id="file_gamekh" value=""/>
                    <div id="show_filekh"> Tên File Game:</div>

                    </div>
                    </li>-->
                    <li class="clearfix"><label><strong>Link Google Play</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['link_store']; ?>" id="link_store"> 
                        </div>
                    </li>
                    <!--</div>-->
                </ul>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url_cp']; ?>/js/mediaplayer/jwplayer.js"></script>
