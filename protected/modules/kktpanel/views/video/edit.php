<?php
    $url = new Url(); 
    $forder_upload = "video";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;
    //$link_url = "http://".$_SERVER["HTTP_HOST"].":8000/upload/upload_base.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
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
            file_types: "*.3gp;*.mp4;*.flv;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        var configUploadDataOther2 = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo $data['create_date']; ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_url;?>", 
            file_types: "*.mp4;", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUpload(configUploadData); 
        configUploadOther(configUploadDataOther);   
        configUploadOther2(configUploadDataOther2);   
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

            $("#file_video").val(filename);
            var link_video = '<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'';
            $("#show_file").html('Tên file 3GP: <strong>' + link_video + '</strong>&gt;&gt;<a target="_blank" href="<?php echo $url->createUrl("video/show")?>?link='+link_video+'">Xem thử</a>');
            /*var html_video = setHtmlVideo(link_video,400,300);
            $("#mediaplayer").html(html_video);*/
        } catch (e) {

        };
    }
    function uploadResponseOther2(serverData){  
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

            $("#file_mp4").val(filename);
            var link_video = '<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'';
            $("#show_file_mp4").html('Tên file 3GP: <strong>' + link_video + '</strong>&gt;&gt;<a target="_blank" href="<?php echo $url->createUrl("video/show")?>?link='+link_video+'">Xem thử</a>');
            /*var html_video = setHtmlVideo(link_video,400,300);
            $("#mediaplayer").html(html_video);*/
        } catch (e) {

        };
    }
    function ajaxUpdateVideo(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
            appId = parseInt(this.value) + appId;
        });
        var arr = $.map($('input[name=opt]:checkbox:checked'), function(e,i) {
            return +e.value;
        });
        var id = "<?php echo $data['id']; ?>";
        var title_video = $("#title_video").val();
        var duration = $("#duration").val();
        var categoryId = $("#categoryId").val();
        var picture = $("#picture").val();
        var introtext = $("#introtext").val();
        var file_video = $("#file_video").val();
        var file_video_other = $("#file_mp4").val();
        var filename_video = $("#filename_video").val();
        var filename_mp4 = $("#filename_mp4").val();
        var status = $("#status").val();
        var isHot = $("#isHot").val();
        var upload = $("#upload").val();
        var strUrl = "<?=$url->createUrl("video/ajaxUpdateVideo") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:id,
                title_video:title_video,
                duration:duration,
                categoryId:categoryId,
                picture:picture,
                picture_320_240:$("#picture_320_240").val(),
                picture_240_320:$("#picture_240_320").val(),
                introtext:introtext,
                file_video:file_video,
                file_video_other:file_video_other,
                filename_video:filename_video,
                filename_mp4:filename_mp4,
                link:$("#link").val(),
                link_mp4:$("#link_mp4").val(),
                status:status,
                isHot:isHot,
                upload:upload,
                price:$("#price").val(),
                appId:appId,
                arr:arr,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("video/index")?>';
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

        <div class="col-570">  
            <div clas = "box">
                <ul class="form">
                    <li class="clearfix"><label><strong>Tên video </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data['title'] ?>" id="title_video"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                        <div class="filltext">
                            <select id="categoryId">
                                <?php foreach($data_cat as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo $data['categoryId']==$key ? "selected = selected": "" ?>><?php echo $value;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>App su dung</strong>:</label>
                        <div class="filltext">
                            <?php foreach($app as $key=>$value){?>
                                <input type="checkbox" name="appId" value="<?php echo $key?>" <?php echo ($data["app_ids"] & $key=$key) ? 'checked':''; ?>/><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Danh mục khác </strong>:</label>
                        <div class="filltext">
                            <?php foreach($data_cat as $key=>$value){?>
                                <input name="opt" type="checkbox" value="<?php echo $key;?>" <?php if(isset($check[$key])){echo $check[$key]== $key ? "checked='checked'" :"" ;} ?>><?php echo $value;?>
                                <?php }?>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Giá</strong>:</label>
                        <div class="filltext">
                            <select id="price">
                                <?php foreach(LoadConfig::$price_content as $key=>$value){?>
                                    <option value="<?php echo $value;?>" <?php echo $data['price']==$value ? "selected = selected": "" ?> ><?php echo $value;?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Thời gian</strong>:</label>
                        <div class="filltext">
                            <input type="text" value="<?php echo $data['duration'];?>" id="duration" name="duration" style="border:1px solid #DFDFDF; width: 80px;"/> (hh:mm:ss)
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="status">
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo $data['status']==$key ? "selected = selected": "" ?>><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Nổi bật</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="isHot">
                                    <option value="1" <?php echo $data['isHot']==1 ? "selected = selected": "" ?>>Có</option>
                                    <option value="0" <?php echo $data['isHot']==0 ? "selected = selected": "" ?>>Không</option>
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
                                <input type="radio" name="type_size" value="0" checked="checked"/> Ảnh vuông (155x155)
                                <input type="radio" name="type_size" value="1"/> Ảnh 320x240
                                <input type="radio" name="type_size" value="2"/> Ảnh 240x320
                            </p>
                            <p><i>Định dạng file: *.jpg;*.jpeg;*.png;*.gif(Dung lượng ko được quá 2 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress">
                                <span class="legend">File upload</span>
                            </div>

                            <input type="hidden" id="picture" value="<?php echo $data['picture']; ?>"/>
                            Ảnh vuông: <p id="show_pic"><img class="img-100" src="<?php echo Common::getImage($data["picture"],"video",$data["create_date"])?>"/></p>
                            <input type="hidden" id="picture_320_240" value="<?php echo $data["picture_320_240"];?>"/>
                            Ảnh 320x240: <p id="show_pic_320_240"><img style="width:320px;height:240px" src="<?php echo Common::getImage($data["picture_320_240"],"video",$data["create_date"])?>"/></p>
                            <input type="hidden" id="picture_240_320" value="<?php echo $data["picture_240_320"];?>"/>
                            Ảnh 240x320: <p id="show_pic_240_320"><img style="width:240px;height:320px" src="<?php echo Common::getImage($data["picture_240_320"],"video",$data["create_date"])?>"/></p>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Tóm tắt</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:120px" id="introtext"><?php echo $data['introtext']; ?></textarea>
                        </div>
                    </li>

                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxUpdateVideo();" type="button" value=" Cập nhật " class="btn-bigblue"> 
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
                       <li id ="upload" value="0"><a onclick="activeUploadType(1)" href="javascript:void(0)" class="active"  id="type_ftp" class=""><span>&nbsp; Upload FTP &nbsp;</span></a></li>
                       
                        <li id="upload" value="1"><a onclick="activeUploadType(0)" href="javascript:void(0)" id="type_upload"><span>&nbsp; Upload File &nbsp;</span></a></li>
                        
                        <li id ="upload" value="2"><a onclick="activeUploadType(2)" href="javascript:void(0)" id="type_link" class=""><span>&nbsp; Upload Link &nbsp;</span></a></li>
                    </ul>
                    <input type="hidden" id="type_game" value="0"/>
                </div>
                <ul class="form" id="form1">
                    <li id = "li1" style="display: none;" class="clearfix"><label><strong>UploadFile 3Gp</strong></label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p> 
                            <!--<p><i>Định dạng file: *.mp4;*.wmv;*.avi;*.flv(Dung lượng ko được quá 20 MB)</i></p>-->
                            <p><i>Định dạng file: *.3gp;*.mp4;*.flv;(Dung lượng ko được quá 20 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>
                            <input type="hidden" value="<?php echo $data['file']; ?>" id="file_video"/>
                            <p id="show_file">Tên file 3GP: <strong><?php echo Common::getImage($data['file'],$forder_upload,$data['create_date'],0) ;?></strong>&gt;&gt;<a target="_blank" href="<?php echo $url->createUrl("video/show").'?link='.Common::getImage($data['file'],$forder_upload,$data['create_date'],0) ;?>">Xem thử</a></p>               
                        </div>
                    </li>
                    <li id = "li2" style="display: none;" class="clearfix"><label><strong>UploadFile Mp4</strong></label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other2" readonly="readonly"/>
                                <input type="text" id="urlFile_other2" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other2"></span>
                            </p> 
                            <!--<p><i>Định dạng file: *.mp4;*.wmv;*.avi;*.flv(Dung lượng ko được quá 20 MB)</i></p>-->
                            <p><i>Định dạng file: *.mp4(Dung lượng ko được quá 20 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other2">
                                <span class="legend">File upload</span>
                            </div>
                            <input type="hidden" value="<?php echo $data['file_mp4']; ?>" id="file_mp4"/>
                            <p id="show_file_mp4">Tên file MP4: <strong><?php echo Common::getImage($data['file'],$forder_upload,$data['create_date'],0) ;?></strong>&gt;&gt;<a target="_blank" href="<?php echo $url->createUrl("video/show").'?link='.Common::getImage($data['file'],$forder_upload,$data['create_date'],0) ;?>">Xem thử</a></p>               
                        </div>
                    </li>
                    <fieldset id="field_name" style="width: 535px;"><legend><strong>Nhập tên</strong></legend>
                        <li class="clearfix"><label><strong>Tên video 3Gp</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="<?php echo $data['file']; ?>" id="filename_video"/>
                            </div>
                        </li>
                        <li class="clearfix"><label><strong>Tên video Mp4</strong>:</label>
                            <div class="filltext">
                                <input style="width:360px" type="text" value="<?php echo $data['file_mp4']; ?>" id="filename_mp4"/>
                            </div>
                        </li>
                    </fieldset> 
                    <br/>
                    <fieldset id="field_link" style="width: 535px; display: none;"><legend><strong>Nhập link</strong></legend> 
                        <li class="clearfix"><label><strong>Link video 3Gp</strong>:</label>
                            <div class="filltext">
                                <input type="text" style="width:360px" value="<?php echo $data['link']; ?>" id="link"> 
                            </div>
                        </li>
                        <li class="clearfix"><label><strong>Link video Mp4</strong>:</label>
                            <div class="filltext">
                                <input type="text"  style="width:360px" value="<?php echo $data['link_mp4']; ?>" id="link_mp4"> 
                            </div>
                        </li>
                    </fieldset>
                    <br/> 

                </ul>
            </div>
        </div>
        <!--<div class="col-570">
        <div class="box">
        <ul class="form">
        <li class="clearfix"><label>&nbsp;</label>
        <div class="filltext">
        <p id="mediaplayer"> </p>  
        </div>
        </li>
        </ul>
        </div>
        </div>-->
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url_cp']; ?>/js/mediaplayer/jwplayer.js"></script>
<script type="">
function activeUploadType(type){
        if(type==1){
            $("#li1").hide("slow");
            $("#li2").hide("slow");
            $("#field_name").show("slow");
            $("#field_link").hide("slow");
            document.getElementById('upload').value = '0';
            $("#type_upload").removeClass('active');
            $("#type_link").removeClass('active');
            $("#type_ftp").addClass('active');
        }else if(type==0){
            $("#li1").show("slow");
            $("#li2").show("slow");
            $("#field_name").hide("slow");
            $("#field_link").hide("slow");
            document.getElementById('upload').value = '1';
            $("#type_ftp").removeClass('active');
            $("#type_link").removeClass('active');
            $("#type_upload").addClass('active');
        } else if(type==2){
            
            $("#li1").hide("slow");
            $("#li2").hide("slow");
            $("#field_name").hide("slow");
            $("#field_link").show("slow");
            document.getElementById('upload').value = '2';
            $("#type_upload").removeClass('active');
            $("#type_ftp").removeClass('active');
            $("#type_link").addClass('active');
        }
    }
</script>