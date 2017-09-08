<?php
    $url = new Url(); 
    $forder_upload = "bongda/news";  
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
            create_date:0,
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

    function ajaxSaveNews()
    {
        var strUrl = "<?=$url->createUrl("footBallNews/ajaxSaveNews") ?>";
        var title_news = $('#title_news').val();
        var lang_id = $('#lang_id').val();
        var cup_id = $('#cup_id').val();
        var club_id = $('#club_id').val();
        var description = $('#description').val();
        var status = $('#status').val();
        var picture = $('#picture').val();
       
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                title_news: title_news,
                lang_id: lang_id,
                cup_id: cup_id,
                club_id: club_id,
                picture: picture,
                description: description,
                content: CKEDITOR.instances.content.getData(),
                status:status,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("footBallNews/index")?>';
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

    
    $(function(){
  $("select#country").change(function(){
      
    $.getJSON("<?=$url->createUrl("footBallNews/getClubByCountry") ?>",{country: $(this).val(), ajax: 'true'},
     function(j){
          var options = '';
          for (var i = 0; i < j.length; i++) {
            options += '<option value="' + j[i].id + '">' + j[i].NAME + '</option>';
          }
          $("select#club_id").html(options);
        })
    
  })
})

</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">  
        <div clas = "box">
            <ul class="form">
                <li class="clearfix"><label><strong>Tiêu đề </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="title_news"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Hiển Thị </strong>:</label>
                    <select id="status" style="width: 203px;">
                        <option value="1">Có</option>
                        <option value="0">Không</option>
                        
                    </select>
                </li>
                <li class="clearfix"><label><strong>Ngôn ngữ </strong>:</label>
                    <div class="filltext">
                        <select name="lang_id" id="lang_id">
                            <option value="1">Tiếng Việt</option>
                            <option value="2">Tiếng Anh</option>
                        </select>
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Giải Đấu </strong>:</label>
                    <div class="filltext">
                         <select name="cup_id" id="cup_id" >
                         <option value="0">Giải đấu khác</option>
                          <?php 
                              $i=0;
                             // var_dump($cupList);
                               while($i<count($cupList)){
                                   $cup_id = $cupList[$i]["id"];
                                   $cup_name = $cupList[$i]["NAME"];
                                   echo "<option value=\"".$cup_id."\">".$cup_name."</option>";
                                   $i++;
                               }    
                          ?>
                        </select>
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Câu lạc bộ</strong>:</label>
                    <div class="filltext">
                        <select name="country" id="country" size="10" style="width: 150px;height:200px">
                        <?php 
                            $ccd = "";
                            $i=0;
                            while($i<count($countryList)){
                                $groupABC = $countryList[$i]["ccd"];
                                $countryName = $countryList[$i]["country"];
                                if(strcasecmp($ccd,$groupABC)!=0){
                                    $ccd = $groupABC;
                                    if($i>0){
                                         echo "</optgroup>"; 
                                    }
                                    echo "<optgroup label=\"".$groupABC."\">";
                                    echo "<option value=\"".$countryName."\">".$countryName."</option>";
                                }else{
                                    echo "<option value=\"".$countryName."\">".$countryName."</option>";
                                }
                                $i++;
                            }
                             echo "</optgroup>";
                        ?>
                        </select>
                        
                        <select name="club_id" id="club_id" size="10" style="width: 150px;height:200px">
                        </select>
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

                        <input type="hidden" id="picture" value=""/>
                        <p id="show_pic"></p>

                    </div>
                </li>

                <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"></textarea>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Nội dung </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="content"></textarea>
                        <script>
                            CKEDITOR.replace( 'content' );
                        </script>
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSaveNews();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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