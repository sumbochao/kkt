<?php

    $url = new Url(); 
    $forder_upload = "gamestore/game";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<style type="text/css">
    #counter span {/*font-family: Georgia,Tahoma,sans-serif ;*//*font-style: italic; font-size: 14px; line-height: 1.55em; color: #a99bb1;*/ }
</style>

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
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 20, 
            debug : false
        }
        var configUploadDataOther2 = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        /*var configUploadDataOther3 = {
            flash_url:"<?php //echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php //echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php //echo $link_avatar;?>", 
            file_types: "*.ipa;*.plish", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }*/
        configUpload(configUploadData); 
        configUploadOther(configUploadDataOther);
        configUploadOther2(configUploadDataOther2);
        /*configUploadOther3(configUploadDataOther3);*/
    }
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
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:40%" alt="pic">');

        } catch (e) {

        };
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
            $("#images").val($('#images').val() + '"' + filename + '",');
            $("#show_img").append('<div style="width:40%;float:left;margin:0px 30px 30px 0px"><img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:50%;margin:0px 0px 0px 0px" alt="pic"> <input id="button_save" onclick="deleteImage('+"'" + filename +"'"+'); $(this).parent().fadeOut();" type="button" value=" Xóa " class="btn-bigblue"></div>');

        } catch (e) {

        };
    }

    function uploadResponseOther2(serverData){  
        try {
            $("#txtFileName_other2").val(""); 

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
            $("#banner").val(filename);
            $("#show_banner").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:40%" alt="pic">');

        } catch (e) {

        };
    }

    /*function uploadResponseOther3(serverData){  
        try {
            $("#txtFileName_other3").val(""); 

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
            $("#file_ipa").val(filename);
            $("#name_ipa").val(filename);
            $("#size_ipa").val(filesize);
            $("#show_ipa").html('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteIpa('+'\''+'<?php echo $forder_upload.'/' ;?>'+path +'/'+ filename+'\','+ '\''+filesize+'\','+ '\''+filename+'\''+');$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        };
    }*/

    function deleteImage(image)
    {
        strUrl = "<?=$url->createUrl("gsgame/ajaxDeleteImage") ?>";
        var total_image = $('#images').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                image: image,
                total_image: total_image,
            },
            success: function(msg){
                $('#images').val(msg);
            },
        });
    }

    function ajaxDeleteApk(link,size,name){
        //alert(size);
        strUrl = "<?=$url->createUrl("gsgame/ajaxDeleteApk") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                link: link,
                name: name,
            },
            success: function(msg){
                if(msg != 0){
                    alert('Xóa thành công');
                    $("#file_apk").val("");
                    $("#name_apk").val("");
                    $("#size_apk").val("");
                    $("."+size).hide();
                }
            },
        });
    }

    function ajaxDeleteIpa(link,size,name){
        strUrl = "<?=$url->createUrl("gsgame/ajaxDeleteIpa") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                link: link,
                name: name,
            },
            success: function(msg){
                if(msg != 0){
                    alert('Xóa thành công');
                    $("#file_ipa").val("");
                    $("#name_ipa").val("");
                    $("#size_ipa").val("");
                    $("."+size).hide();
                }
            },
        });
    }

    function ajaxSaveGame(){
        var strUrl = "<?=$url->createUrl("gsgame/ajaxSaveGame") ?>";
        var url_scheme =$('#url_scheme').val();
        var title_game = $('#title_game').val();
        var category = $('#category').val();
        var publisher = $('#publisher').val();
        var bundle_id = $('#bundle_id').val();
        var packet_id = $('#packet_id').val();
        var is_hot = $('#is_hot').val();
        var status = $('#status').val();
        var picture = $('#picture').val();
        var banner = $('#banner').val();
        var video_game = $('#video_game').val();
        var description = $('#description').val();
        var tags = $('#tags').val();
        var images = $('#images').val();
        var file_apk = $('#file_apk').val();
        var size_apk = $('#size_apk').val();
        var version_apk = $('#version_apk').val();
        var version_os_apk = $('#version_os_apk').val();
        var file_ipa = $('#file_ipa').val();
        var size_ipa = $('#size_ipa').val();
        var version_ipa = $('#version_apk').val();
        var version_os_ipa = $('#version_os_ipa').val();
        var email = $('#email').val();
        var website = $('#website').val();
        var phone = $('#phone').val();
        var fanpage = $('#fanpage').val();
        var itune_id = $('#itune_id').val();
        var rate_view=$('#rate_view').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                url_scheme: url_scheme,
                title_game: title_game,
                category: category,
                publisher: publisher,
                bundle_id: bundle_id,
                packet_id: packet_id,
                is_hot: is_hot,
                status: status,
                picture: picture,
                banner:banner,
                video_game: video_game,
                description: description,
                content: CKEDITOR.instances.content.getData(),
                tags: tags,
                images: images,
                file_apk: file_apk,
                size_apk: size_apk,
                version_apk: version_apk,
                version_os_apk: version_os_apk,
                file_ipa: file_ipa,
                size_ipa: size_ipa,
                version_ipa: version_ipa,
                version_os_ipa: version_os_ipa,
                email: email,
                website: website,
                phone: phone,
                fanpage:fanpage,
                itune_id:itune_id,
                rate_view:rate_view
            },
            success: function(msg){
                
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsgame/index")?>';
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
    
    /*count length character*/
    
    function countLength(txt,obj,limit){
        var len = $("#"+txt).val().length; 
        if(len > limit){
            $("#"+txt).val($("#"+txt).val().substr(0,limit));
            $("#"+obj).html(limit-len+1);
        } 
        else { 
            $("#"+obj).html(limit-len);
        }
    }
    
</script>

<div class="main clearfix">
    <div class="box clearfix bottom30">  

        <div class="col-570"> 
            <div clas = "box">
                <ul class="form">

                    <li class="clearfix">
                        <strong>Thông Tin Cơ Bản</strong>
                        <hr>
                    </li>

                    <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                        <div class="filltext">
                            <input type="text" onkeyup="countLength('title_game','counter_title',125)" style="width:360px" value="" id="title_game"> 
                            <p >Max length: <span id="counter_title">125</span> </p>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Rate View </strong>:</label>
                        
                        <div class="filltext">
                            <select style="width:360px" id="rate_view"> 
                                <option value="1" >Cao</option>
                                <option value="2" >Trung Bình</option>
                                <option value="3" >Thấp </option>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                        <div class="filltext">
                            <select id="category" style="width: 203px;">
                                <?php for($i=0;$i<count($category);$i++){?>
                                    <option value="<?php echo $category[$i]['id'];?>"><?php echo $category[$i]['name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Nhà phát hành</strong>:</label>
                        <div class="filltext">
                            <select id="publisher" style="width: 203px;">
                                <?php for($i=0;$i<count($publisher);$i++){?>
                                    <option value="<?php echo $publisher[$i]['id'];?>"><?php echo $publisher[$i]['name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                       
                    <li class="clearfix"><label><strong>Bundle Id Ios </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="bundle_id"> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Packet Id Android </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="packet_id"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>iTune Id  </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="itune_id"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Url Scheme </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="url_scheme"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Game Hot</strong>:</label>
                        <div class="filltext">
                            <select id="is_hot" style="width: 203px;">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                            <select id="status" style="width: 203px;">
                                <option value="1">Hiển thị</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                        <div class="filltext">
                            <textarea onkeyup="countLength('description','counter_description',550)" cols="5" rows="5" style="width:420px; height:120px" id="description"></textarea>
                            <p >Max length: <span id="counter_description">550</span> </p>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Tags </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="tags"> 
                        </div>
                    </li>

                    <li class="clearfix">
                        <strong>Hình ảnh - Video</strong>
                        <hr>
                    </li>

                    <li class="clearfix"><label><strong>Icon </strong>:</label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName" readonly="readonly"/>
                                <input type="text" id="urlFile" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder"></span>
                            </p>

                            <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                              <p><i>Kích thước : Chiều dài : 300 Chiều rộng : 300 </i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress">
                                <span class="legend">File upload</span>
                            </div>

                            <input type="hidden" id="picture" value=""/>
                            <p id="show_pic"></p>

                        </div>
                    </li>
                    
                     <li class="clearfix"><label><strong>Banner </strong>:</label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other2" readonly="readonly"/>
                                <input type="text" id="urlFile_other2" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other2"></span>
                            </p>

                            <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                            
                            <p><i>Kích thước : Chiều dài : 640 Chiều rộng : 316 </i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress2">
                                <span class="legend">File upload</span>
                            </div>

                            <input type="hidden" id="banner" value=""/>
                            <p id="show_banner"></p>

                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Video </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="video_game"> 
                        </div>
                    </li>

                    <li id = "li1" class="clearfix"><label><strong>ScreenShot :</strong></label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p> 
                            <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                            <p><i>Kích thước : Chiều dài : 640  Chiều rộng : 332 </i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>
                            <input type="hidden" id="images" value=""/>
                        </div>
                    </li>
                   
                    
                </ul>
            </div>
        </div>

        <div class="col5">&nbsp;</div>

        <div class ="col-570">

            <div class="box">

                <ul class="form">

                    <li class="clearfix">
                        <strong>Thông Tin Liên Hệ</strong>
                        <hr>
                    </li>

                    <li class="clearfix"><label><strong>Email </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="email"> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Website </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="website"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>FanPage</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="fanpage"> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Phone </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="phone"> 
                        </div>
                    </li>

                </ul>

                <!--<div class="Tabs clearfix">
                <ul class="clearfix">
                <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(0);" ><span>&nbsp; Image: &nbsp;</span></a></li>
                <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(1);" ><span>&nbsp; Upload File APK: &nbsp;</span></a></li>
                <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(2);" ><span>&nbsp; Upload File IPA: &nbsp;</span></a></li>
                </ul>
                </div>-->

                <!--<ul class="form" id="form1">
                <div id="data_edit">

                <div class="form01">
                <li id = "li1" class="clearfix"><label><strong>Upload :</strong></label>
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
                <input type="hidden" id="images" value=""/>
                <div id="show_img"></div> 
                </div>
                </li>
                </div>

                <div class="form02" style="display: none;">
                <li id = "li1" class="clearfix"><label><strong>Upload :</strong></label>
                <div class="filltext">
                <p>
                <input type="hidden" id="txtFileName_other2" readonly="readonly"/>
                <input type="text" id="urlFile_other2" style="border:1px solid #DFDFDF; width: 200px;">                            
                <span id="spanButtonPlaceHolder_other2"></span>
                </p> 
                <p><i>Định dạng file: *.apk</i></p>
                </div>
                <li>
                <p>
                <label><strong>File Name:</strong></label>
                <input type="text" name="name_apk" id="name_apk" style="width: 200px;" readonly="">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Size:</strong></label>
                <input type="text" name="size_apk" id="size_apk" style="width: 200px;" readonly="">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Apk Version:</strong></label>
                <input type="text" name="version_apk" id="version_apk" style="width: 200px;">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Os Apk Version:</strong></label>
                <input type="text" name="version_os_apk" id="version_os_apk" style="width: 200px;">
                </p>
                </li>
                <li>
                <br/>
                <div class="fieldset flash" id="fsUploadProgress_other2">
                <span class="legend">File upload</span>
                </div>
                <input type="hidden" id="file_apk" value=""/>
                <div id="show_apk"> Tên File Game:</div> 

                </li>
                </div>
                <div class="form03" style="display: none;">
                <li id = "li1" class="clearfix"><label><strong>Upload :</strong></label>
                <div class="filltext">
                <p>
                <input type="hidden" id="txtFileName_other3" readonly="readonly"/>
                <input type="text" id="urlFile_other3" style="border:1px solid #DFDFDF; width: 200px;">                            
                <span id="spanButtonPlaceHolder_other3"></span>
                </p> 
                <p><i>Định dạng file: *.ipa,*.plish</i></p>
                </div>
                <li>
                <p>
                <label><strong>File Name:</strong></label>
                <input type="text" name="name_ipa" id="name_ipa" style="width: 200px;" readonly="">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Size:</strong></label>
                <input type="text" name="size_ipa" id="size_ipa" style="width: 200px;" readonly="">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Ipa Version:</strong></label>
                <input type="text" name="version_ipa" id="version_ipa" style="width: 200px;">
                </p>
                </li>
                <li>
                <p>
                <label><strong>Os Ipa Version:</strong></label>
                <input type="text" name="version_os_ipa" id="version_os_ipa" style="width: 200px;">
                </p>
                </li>
                <li>
                <br/>
                <div class="fieldset flash" id="fsUploadProgress_other3">
                <span class="legend">File upload</span>
                </div>
                <input type="hidden" id="file_ipa" value=""/>
                <div id="show_ipa"> Tên File Game:</div> 

                </li>
                </div>
                <br/>
                </div>
                </ul>-->

            </div>



        </div>
    </div>

    <div class="box clearfix bottom30">  

        <div clas = "box">

            <ul class="form">
                <li style="margin-left: 100px;">
                    <div id="show_img"></div> 
                </li>

                <li>
                    <strong>Nội dung</strong>:
                    <hr>
                </li>

                <li style="margin-left: 100px;">
                    <!--<label><strong>Nội dung </strong>:</label>-->
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:620px; height:120px;" id="content"></textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                </li>
                <li style="margin-left: 100px;">
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSaveGame();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>

                <li class="clearfix" style="margin-left: 100px;">
                    <div class="filltext" style="color: red;" id="show_error"></div>
                </li>

            </ul>
        </div>

    </div>

</div>
<!--<script type="text/javascript">
    function activeUploadType(type){
        if(type==0){
            $('.form01').show('slow');
            $('.form02').hide('slow');
            $('.form03').hide('slow');
        }
        if(type==1){
            $('.form01').hide('slow');
            $('.form02').show('slow');
            $('.form03').hide('slow');
        }
        if(type==2){
            $('.form01').hide('slow');
            $('.form02').hide('slow');
            $('.form03').show('slow');
        }
    }
</script>-->