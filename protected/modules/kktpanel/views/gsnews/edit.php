<?php
    $url = new Url(); 
    $forder_upload = "gamestore/news";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['static_url']; ?>css/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url']; ?>js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var configUploadData = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:"<?php echo strtotime($data['create_date']); ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUpload(configUploadData); 
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
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:50%;height:50%" alt="pic">');

        } catch (e) {

        };
    }

    function ajaxUpdateNews(){
        var strUrl = "<?=$url->createUrl("gsnews/ajaxUpdateNews") ?>";
        var title_news = $('#title_news').val();
        var event = $('#event').val();
        var game = $('#game').val();
        var picture = $('#picture').val();
        var description = $('#description').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id: "<?php echo $id;?>",
                title_news: title_news,
                event: event,
                game: game,
                picture: picture,
                description: description,
                content: CKEDITOR.instances.content.getData(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Cập nhật thành công');
                    window.location = '<?php echo $url->createUrl("gsnews/index")?>';
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
    
    $(function() {
        var availableTags = [
            <?php
                for($i=0;$i<count($game);$i++)
                {
                    echo '"'.$game[$i]['name'].'",';
                }
            ?>
        ];
        $( "#game" ).autocomplete({
            source: availableTags
        });
    });

</script>
<div class="main clearfix">

        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['title'];?>" id="title_news"> 
                    </div>
                </li>
<!--
                <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                    <div class="filltext">
                        <select id="category" style="width: 203px;">
                            <?php for($i=0;$i<count($category);$i++){?>
                                <option value="<?php echo $category[$i]['id'];?>" <?php echo ($data['category_id'] == $category[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $category[$i]['name'];?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Nhà phát hành</strong>:</label>
                    <div class="filltext">
                        <select id="category" style="width: 203px;">
                            <?php for($i=0;$i<count($publisher);$i++){?>
                                <option value="<?php echo $publisher[$i]['id'];?>" <?php echo ($data['publisher_id'] == $publisher[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $publisher[$i]['name'];?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                -->
                <li class="clearfix"><label><strong>Hiển Thị </strong>:</label>
                    <select id="status" style="width: 203px;">
                        <option value="1" <?php if($data['status'] == 1){echo "selected='selected'";}?>>Có</option>
                        <option value="0" <?php if($data['status'] == 0){echo "selected='selected'";}?>>Không</option>
                        
                    </select>
                </li>
                
                <li class="clearfix"><label><strong>Event </strong>:</label>
                    <select id="event" style="width: 203px;">
                        <option value="0" <?php if($data['is_event'] == 0){echo "selected='selected'";}?>>Không</option>
                        <option value="1" <?php if($data['is_event'] == 1){echo "selected='selected'";}?>>Có</option>
                    </select>
                </li>

                <li class="clearfix"><label><strong>Game </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:203px" value="<?php echo $data['game_id']?>" id="game"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Ảnh </strong>:</label>
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
                        <p id="show_pic">
                            <img src="<?php echo Yii::app()->params['urlImages']?>gamestore/news/<?php echo date('Y/md',strtotime($data['create_date']))?>/<?php echo $data['image'];?>" style="width:50%;height:50%">
                        </p>

                    </div>
                </li>

                <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"><?php echo $data['description'];?></textarea>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Nội dung </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="content"><?php echo $data['content'];?></textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxUpdateNews();" type="button" value=" Cập Nhật " class="btn-bigblue"> 
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