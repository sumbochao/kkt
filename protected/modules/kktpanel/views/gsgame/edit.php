<?php
$url = new Url();
$forder_upload = "gamestore/game";
$link_avatar = Yii::app()->params["urlImages"] . "upload_avatar.php?forder_upload=" . $forder_upload;
$link_url = Yii::app()->params["urlImages"] . "upload_base.php?forder_upload=" . $forder_upload;
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    window.onload = function () {
        var configUploadData = {
            flash_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/js/swfupload.swf",
            create_date: "<?php echo strtotime($data['create_date']); ?>",
            button_image_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar; ?>",
            file_types: "*.jpg;*.jpeg;*.png;*.gif",
            file_upload_limit: 20,
            file_queue_limit: 1,
            debug: false
        }
        var configUploadDataOther = {
            flash_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/js/swfupload.swf",
            create_date: "<?php echo strtotime($data['create_date']); ?>",
            button_image_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar; ?>",
            file_types: "*.jpg;*.jpeg;*.png;*.gif",
            file_upload_limit: 20,
            file_queue_limit: 20,
            debug: false
        }
        var configUploadDataOther2 = {
            flash_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/js/swfupload.swf",
            create_date: "<?php echo strtotime($data['create_date']); ?>",
            button_image_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar; ?>",
            file_types: "*.jpg;*.jpeg;*.png;*.gif",
            file_upload_limit: 20,
            file_queue_limit: 1,
            debug: false
        }
        var configUploadDataOther3 = {
            flash_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/js/swfupload.swf",
            create_date: "<?php echo strtotime($data['create_date']); ?>",
            button_image_url: "<?php echo Yii::app()->params["urlImages"]; ?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar; ?>",
            file_types: "*.ipa;*.plish",
            file_upload_limit: 20,
            file_queue_limit: 1,
            debug: false
        }
        configUpload(configUploadData);
        configUploadOther(configUploadDataOther);
        configUploadOther2(configUploadDataOther2);
        configUploadOther3(configUploadDataOther3);
    }

    function uploadResponse(serverData) {
        try {
            $("#txtFileName").val("");
            var response = $.parseJSON(serverData); // eval( "(" + serverData + ")" );      
            if (response.code == 404) {
                alert(response.message);
                return false;
            }
            var filename = response.filename;
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"] . $forder_upload . '/'; ?>' + path + '/' + filename + '" style="width:50%" alt="pic">');

        } catch (e) {

        }
        ;
    }

    function uploadResponseOther(serverData) {
        try {
            $("#txtFileName_other").val("");
            var response = $.parseJSON(serverData); // eval( "(" + serverData + ")" );      
            if (response.code == 404) {
                alert(response.message);
                return false;
            }
            var filename = response.filename;
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;
            $("#images").val($('#images').val() + '"' + filename + '",');
            $("#show_img").append('<div style="width:50%;float:left;margin:0px 30px 30px 0px"><img src="<?php echo Yii::app()->params["urlImages"] . $forder_upload . '/'; ?>' + path + '/' + filename + '" style="width:100px;height:100px;margin:0px 20px 0px 0px" alt="pic"> <input id="button_save" onclick="deleteImage(' + "'" + filename + "'" + '); $(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue"></div>');

        } catch (e) {

        }
        ;
    }

    function uploadResponseOther2(serverData) {
        try {
            $("#txtFileName_other2").val("");

            var response = $.parseJSON(serverData);
            if (response.code == 404) {
                alert(response.message);
                return false;
            }
            var filename = response.filename;
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;

            $("#banner").val(filename);
            $("#show_banner").html('<img src="<?php echo Yii::app()->params["urlImages"] . $forder_upload . '/'; ?>' + path + '/' + filename + '" style="width:40%" alt="pic">');

        } catch (e) {

        }
        ;
    }

    function uploadResponseOther3(serverData) {
        try {
            $("#txtFileName_other3").val("");

            var response = $.parseJSON(serverData);
            if (response.code == 404) {
                alert(response.message);
                return false;
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
            $("#show_ipa").html('</br><p class="' + filesize + '" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"] . $forder_upload . '/'; ?>' + path + '/' + filename + '"alt="' + filename + '" >' + filename + '</a><input onclick="ajaxDeleteIpa(' + '\'' + '<?php echo $forder_upload . '/'; ?>' + path + '/' + filename + '\',' + '\'' + filesize + '\',' + '\'' + filename + '\'' + ');$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        }
        ;
    }

    function deleteImage(image)
    {
        var strUrl = "<?= $url->createUrl("gsgame/ajaxDeleteImage") ?>";
        var total_image = $('#images').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                image: image,
                date: "<?php echo $data['create_date']; ?>",
                total_image: total_image,
            },
            success: function (msg) {
                $('#images').val(msg);
            },
        });
    }

    function ajaxDeleteApk(link, size, name) {
        //alert(size);
        var strUrl = "<?= $url->createUrl("gsgame/ajaxDeleteApk") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                link: link,
                name: name,
            },
            success: function (msg) {
                if (msg != 0) {
                    alert('Xóa thành công');
                    $("#file_apk").val("");
                    $("#name_apk").val("");
                    $("#size_apk").val("");
                    $("." + size).hide();
                }
            },
        });
    }

    function ajaxDeleteIpa(link, size, name) {
        var strUrl = "<?= $url->createUrl("gsgame/ajaxDeleteIpa") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                link: link,
                name: name,
            },
            success: function (msg) {
                if (msg != 0) {
                    alert('Xóa thành công');
                    $("#file_ipa").val("");
                    $("#name_ipa").val("");
                    $("#size_ipa").val("");
                    $("." + size).hide();
                }
            },
        });
    }

    function ajaxUpdateGame()
    {

        var strUrl = "<?= $url->createUrl("gsgame/ajaxUpdateGame") ?>";
        var id = "<?php echo $id; ?>";
        var url_scheme = $('#url_scheme').val();

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
        var fanpage = $('#fanpage').val();
        var website = $('#website').val();
        var phone = $('#phone').val();
        var itune_id = $('#itune_id').val();
        var rate_view = $('#rate_view').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id: id,
                title_game: title_game,
                category: category,
                publisher: publisher,
                url_scheme: url_scheme,
                bundle_id: bundle_id,
                packet_id: packet_id,
                is_hot: is_hot,
                status: status,
                picture: picture,
                banner: banner,
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
                fanpage: fanpage,
                itune_id: itune_id,
                rate_view: rate_view,
            },
            success: function (msg) {

                if (msg == 1) {
                    alert('Cập nhật thành công');
                    window.location = '<?php echo $url->createUrl("gsgame/index") ?>';
                } else {
                    $("#show_error").html(msg);
                }
            },
            beforeSend: function () {
                $("#button_save").attr("disabled", "disabled");
            },
            complete: function () {
                $("#button_save").removeAttr("disabled");
            }
        });
    }

    function countLength(txt, obj, limit) {
        var len = $("#" + txt).val().length;
        if (len > limit) {
            $("#" + txt).val($("#" + txt).val().substr(0, limit));
            $("#" + obj).html(limit - len + 1);
        }
        else {
            $("#" + obj).html(limit - len);
        }
    }

</script>

<div class="main clearfix">

    <div class="col-570"> 
        <div clas = "box">
            <ul class="form">
                <li class="clearfix">
                    <strong>Thông Tin Cơ Bản</strong>
                    <hr>
                </li>

                <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                    <div class="filltext">
                        <input type="text" onkeyup="countLength('title_game', 'counter_title', 125)" style="width:360px" value="<?php echo $data['name']; ?>" id="title_game"> 
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
<?php for ($i = 0; $i < count($category); $i++) { ?>
                                <option value="<?php echo $category[$i]['id']; ?>" <?php echo ($data['category_id'] == $category[$i]['id'] ? 'selected="selected"' : '' ) ?>><?php echo $category[$i]['name']; ?></option>
<?php } ?>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Nhà phát hành</strong>:</label>
                    <div class="filltext">
                        <select id="publisher" style="width: 203px;">
<?php for ($i = 0; $i < count($publisher); $i++) { ?>
                                <option value="<?php echo $publisher[$i]['id']; ?>" <?php echo ($data['publisher_id'] == $publisher[$i]['id'] ? 'selected="selected"' : '' ) ?>><?php echo $publisher[$i]['name']; ?></option>
<?php } ?>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Bundle Id Ios </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['bundle_id'] ?>" id="bundle_id"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Packet Id Android </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['packet_id'] ?>" id="packet_id"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>iTune Id  </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['itune_id'] ?>" id="itune_id"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Url Scheme </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['url_scheme'] ?>" id="url_scheme"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Game Hot</strong>:</label>
                    <div class="filltext">
                        <select id="is_hot" style="width: 203px;">
                            <option value="1" <?php echo ($data['is_hot'] == 1 ? 'selected="selected"' : '' ) ?>>Có</option>
                            <option value="0" <?php echo ($data['is_hot'] == 0 ? 'selected="selected"' : '' ) ?>>Không</option>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                    <div class="filltext">
                        <select id="status" style="width: 203px;">
                            <option value="1" <?php echo ($data['status'] == 1 ? 'selected="selected"' : '' ) ?>>Hiển thị</option>
                            <option value="0" <?php echo ($data['status'] == 0 ? 'selected="selected"' : '' ) ?>>Không</option>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" onkeyup="countLength('description', 'counter_description', 550)" style="width:420px; height:120px" id="description"><?php echo $data['description'] ?></textarea>
                        <p >Max length: <span id="counter_description">550</span> </p>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Tags </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['tags'] ?>" id="tags"> 
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
                        <p><i>Kích thước : Chiều dài : 300 Chiều rộng : 300</i></p>
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress">
                            <span class="legend">File upload</span>
                        </div>

                        <input type="hidden" id="picture" value="<?php echo $data['icon']; ?>"/>
                        <p id="show_pic"><img src="<?php echo Yii::app()->params['urlImages'] ?>gamestore/game/<?php echo date('Y/md', strtotime($data['create_date'])) ?>/<?php echo $data['icon']; ?>" style="width:150px;height:150px"></p>

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

                        <input type="hidden" id="banner" value="<?php echo $data['banner']; ?>"/>
                       
                          
                        <?php 
                        $url_banner="";
                        if(!empty($data['banner'] ))
                        $url_banner = Yii::app()->params['urlImages']."gamestore/game/".date('Y/md', strtotime($data['create_date']))."/".$data['banner']?>
                       
                        <p id="show_banner">
                             <?php if(!$url_banner==""){ ?>
                                     <img src="<?php echo $url_banner?>"  width="50%"/>
                             <?php }?>
                             </div>
                </li>

                <li class="clearfix"><label><strong>Video </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['video'] ?>" id="video_game"> 
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
                        <?php
                        $images = "";
                        $arr_images = json_decode($data['images']);
                        foreach ($arr_images as $image) {
                            $images .= '"' . $image . '",';
                        }
                        ?>
                        <input type="hidden" id="images" value='<?php echo $images ?>'/>
                    </div>
                </li>



            </ul>
        </div>
    </div>

    <div class="col5">&nbsp;</div>

    <div class ="col-570">
        <div class="box">

            <ul class="form" id="form1">
                <li class="clearfix">
                    <strong>Thông Tin Liên Hệ</strong>
                    <hr>
                </li>

                <li class="clearfix"><label><strong>Email </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['email'] ?>" id="email"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Website </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['website'] ?>" id="website"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>FanPage</strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['fanpage'] ?>" id="fanpage"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Phone </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['phone'] ?>" id="phone"> 
                    </div>
                </li>

                <li class="clearfix">
                    <strong>Phiên Bản Hiện Tại</strong>
                    <hr>
                </li>

                <li class="clearfix"><label><strong>Android Version </strong>:</label>
                    <div class="filltext">
<?php echo $data['version_android'] ?>
                    </div>
                </li>

                <li class="clearfix"><label><strong>IOS Version </strong>:</label>
                    <div class="filltext">
<?php echo $data['version_ios'] ?>
                    </div>
                </li>

                <li class="clearfix"><label><strong>OS Android Version </strong>:</label>
                    <div class="filltext">
<?php echo $data['version_os_android'] ?> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>OS IOS Version </strong>:</label>
                    <div class="filltext">
<?php echo $data['version_os_ios'] ?>
                    </div>
                </li>
            </ul>

            <!--<div class="Tabs clearfix">
            <ul class="clearfix">
            <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(0);" ><span>&nbsp; Image: &nbsp;</span></a></li>
            <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(1);" ><span>&nbsp; Upload File APK: &nbsp;</span></a></li>
            <li><a class ="active" href="javascript:void(0)" onclick="activeUploadType(2);" ><span>&nbsp; Upload File IPA: &nbsp;</span></a></li>
            <input type="hidden" id="type_game" value="0"/>
            </ul>
            </div>

            <ul class="form" id="form1">
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
            <?php
            /* $images = "";
              $arr_images = json_decode($data['images']);
              //var_dump($arr_images);die;
              foreach($arr_images as $image)
              {
              $images .= '"'.$image.'",';
              } */
            ?>
            <input type="hidden" id="images" value='<?php //echo $images ?>'/>
            <div id="show_img">
            <?php //for($i=0;$i<count($arr_images);$i++){ ?>
            <div style="width:100px;float:left;margin:0px 30px 30px 0px">
            <img src="<?php //echo Yii::app()->params['urlImages'] ?>gamestore/game/<?php //echo date('Y/md',strtotime($data['create_date'])) ?>/<?php //echo $arr_images[$i]; ?>" style="width:100px;height:100px;margin:0px 20px 0px 0px;">
            <input id="button_save" onclick="deleteImage('<?php //echo $arr_images[$i] ?>'); $(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue">
            </div>
<?php //} ?>
            </div> 
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
            <input type="text" name="name_apk" id="name_apk" style="width: 200px;" value="<?php //echo $data['file_apk'] ?>" readonly="">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Size:</strong></label>
            <input type="text" name="size_apk" id="size_apk" style="width: 200px;" value="<?php //echo $data['size_android']  ?>" readonly="">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Apk Version:</strong></label>
            <input type="text" name="version_apk" id="version_apk" value="<?php //echo $data['version_android'] ?>" style="width: 200px;">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Os Apk Version:</strong></label>
            <input type="text" name="version_os_apk" id="version_os_apk" value="<?php //echo $data['version_os_android'] ?>" style="width: 200px;">
            </p>
            </li>
            <li>
            <br/>
            <div class="fieldset flash" id="fsUploadProgress_other2">
            <span class="legend">File upload</span>
            </div>
            <input type="hidden" id="file_apk" value="<?php //echo $data['file_apk']; ?>"/>
            <div id="show_apk"> Tên File Game:
            <?php //if($data['file_apk']!=""){?>
            </br>
            <a target="_blank" href="<?php //echo Yii::app()->params['urlImages'] ?>gamestore/game/<?php //echo date('Y/md',strtotime($data['create_date'])) ?>/<?php //echo $data['file_apk']; ?>" alt="<?php //echo $data['file_apk'] ?>"><?php //echo $data['file_apk'] ?></a>
            <input onclick="ajaxDeleteApk('gamestore/game/<?php //echo date('Y/md',strtotime($data['create_date'])) ?>/<?php //echo $data['file_apk']; ?>','<?php //echo $data['size_android']  ?>','<?php //echo $data['file_apk']; ?>');$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue">
<?php //} ?>
            </div> 

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
            <input type="text" name="name_ipa" id="name_ipa" style="width: 200px;" value="<?php //echo $data['file_ipa'] ?>" readonly="">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Size:</strong></label>
            <input type="text" name="size_ipa" id="size_ipa" style="width: 200px;" value="<?php //echo $data['size_ios'] ?>" readonly="">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Ipa Version:</strong></label>
            <input type="text" name="version_ipa" id="version_ipa" value="<?php //echo $data['version_ios'] ?>" style="width: 200px;">
            </p>
            </li>
            <li>
            <p>
            <label><strong>Os Ipa Version:</strong></label>
            <input type="text" name="version_os_ipa" id="version_os_ipa" value="<?php //echo $data['version_os_ios'] ?>" style="width: 200px;">
            </p>
            </li>
            <li>
            <br/>
            <div class="fieldset flash" id="fsUploadProgress_other3">
            <span class="legend">File upload</span>
            </div>
            <input type="hidden" id="file_ipa" value=""/>
            <div id="show_ipa"> Tên File Game:
            <?php //if($data['file_ipa']!=""){?>
            </br>
            <a target="_blank" href="<?php //echo Yii::app()->params['urlImages'] ?>gamestore/game/<?php //echo date('Y/md',strtotime($data['create_date'])) ?>/<?php //echo $data['file_ipa']; ?>" alt="<?php //echo $data['file_ipa'] ?>"><?php //echo $data['file_ipa'] ?></a>
            <input onclick="ajaxDeleteApk('gamestore/game/<?php //echo date('Y/md',strtotime($data['create_date'])) ?>/<?php //echo $data['file_ipa']; ?>','<?php echo $data['size_ios'] ?>','<?php //echo $data['file_ipa']; ?>');$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue">
<?php //} ?>
            </div> 
            </li>
            </div>

            </div>
            </ul>-->
        </div>

    </div>

    <div class="box clearfix bottom30">  

        <div clas = "box">
            <ul class="form">

                <li style="margin-left: 100px;"> 
                    <div id="show_img">
                        <?php for ($i = 0; $i < count($arr_images); $i++) { ?>
                            <div style="width:300px;float:left;margin:0px 30px 30px 0px">
                                <img src="<?php echo Yii::app()->params['urlImages'] ?>gamestore/game/<?php echo date('Y/md', strtotime($data['create_date'])) ?>/<?php echo $arr_images[$i]; ?>" style="width:50%;margin:0px 0px 0px 0px;">
                                <input id="button_save" onclick="deleteImage('<?php echo $arr_images[$i] ?>');
                                        $(this).parent().fadeOut();" type="button" value=" Xóa " class="btn-bigblue">
                            </div>
<?php } ?>
                    </div>
                </li> 

                <li>
                    <strong>Nội dung</strong>:
                    <hr>
                </li>

                <li style="margin-left: 100px;">
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="content"><?php echo $data['content'] ?></textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace('content');
                        </script>
                    </div>
                </li>

                <li style="margin-left: 100px;">
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxUpdateGame();" type="button" value=" Cập nhật " class="btn-bigblue"> 
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

</div>
</div>
<script type="text/javascript">
    function activeUploadType(type) {
        if (type == 0) {
            $('.form01').show('slow');
            $('.form02').hide('slow');
            $('.form03').hide('slow');
        }
        if (type == 1) {
            $('.form01').hide('slow');
            $('.form02').show('slow');
            $('.form03').hide('slow');
        }
        if (type == 2) {
            $('.form01').hide('slow');
            $('.form02').hide('slow');
            $('.form03').show('slow');
        }
    }
</script>