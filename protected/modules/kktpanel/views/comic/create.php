<?php
    $url = new Url(); 
    $forder_upload = "comic";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar_comic.php?forder_upload=".$forder_upload;
    //$link_url = "http://".$_SERVER["HTTP_HOST"].":8000/upload/upload_base.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
    $arr_status = LoadConfig::$status;
    $arr_status_comic = LoadConfig::$status_comic;
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
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:120px;height:120px" alt="pic">');

        } catch (e) {

        };
    }
    function ajaxSaveComic(){
        var appId =0;
        $("input[name=appId]:checked").each(function(){
            appId = parseInt(this.value) + appId;
        });
        var arr = $.map($('input[name=opt]:checkbox:checked'), function(e,i) {
            return +e.value;
        });

        var title_comic = $("#title_comic").val();
        var author = $("#author").val();
        var chapter = $("#chapter").val();
        var content = $("#content").val();
        var tags = $("#tags").val();
        var status = $("#status").val();
        var status_comic = $("#status_comic").val();
        var isHot = $("#isHot").val();
        var getLink = $("#getLink").val();
        var strUrl = "<?=$url->createUrl("comic/ajaxSaveComic") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                arr:arr,
                title_comic:title_comic,
                picture:$("#picture").val(),
                content:content,
                author:author,
                chapter:chapter,
                tags:tags,
                status:status,
                status_comic:status_comic,
                isHot:isHot,
                getLink:getLink,
                price:$("#price").val(),
                appId:appId,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("comic/index")?>';
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

    function ajaxDeleteFile(path,filesize,filename){
        var strUrl = "<?=$url->createUrl("game/ajaxDeleteFile") ?>";
        var file_game = $("#file_game").val();
        if(confirm('Bạn có chắc muốn xóa audio này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
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
                    <li class="clearfix"><label><strong>Tên Truyện </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="title_comic"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Tác giả </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="author"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Số chương </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="chapter"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Danh mục </strong>:</label>
                        <div class="filltext">

                            <?php foreach($data_cat as $key=>$value){?>
                                <input name="opt" type="checkbox" value="<?php echo $key;?>"><?php echo $value;?>
                                <?php }?>

                        </div>
                    </li>
                    <li class="clearfix"><label><strong>App su dung</strong>:</label>
                        <div class="filltext">
                            <?php foreach($arr_app as $key=>$value){?>
                                <input type="checkbox" name="appId" value="<?php echo $key?>"/><?php echo $value;?>
                                <?php }?>
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

                    <li class="clearfix"><label><strong>Trạng thái hiển thị</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="status">
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>"><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Trạng thái hoàn thành</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="status_comic">
                                <?php foreach($arr_status_comic as $key=>$value){?>
                                    <option value="<?php echo $key;?>"><?php echo $value?></option>
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
                    <li class="clearfix"><label><strong>Lấy Link</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" id="getLink">
                                <option value="1">Server TTV</option>
                                <option value="2">Tại nguồn</option>
                            </select>
                        </div>
                    </li> 
                   
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxSaveComic();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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

                <ul class="form">
                    <!--<div id="data_edit_upload">-->
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
                    <li class="clearfix"><label><strong>Tags</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="tags"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Nội dung</strong>:</label>
                        <div class="filltext">
                            <textarea cols="5" rows="5" style="width:420px; height:120px" id="content"></textarea>
                        </div>
                    </li>
                    <!--</div>-->
                </ul>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url_cp']; ?>/js/mediaplayer/jwplayer.js"></script>
