<?php
    $url = new Url(); 
    $forder_upload = "bongda/video";  
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
            create_date: "<?php echo strtotime($video['create_date']); ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.jpg;*.jpeg;*.png;*.gif", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        
          var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date: "<?php echo strtotime($video['create_date']); ?>",
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.mp4;", 
            file_upload_limit : 20, 
            file_queue_limit : 20, 
            debug : false
        }
        
        configUpload(configUploadData);
        configUploadOther(configUploadDataOther); 
    }

    function uploadResponse(serverData){  
        try {
            $("#txtFileName").val(""); 
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
            $("#picture").val(filename);
            $("#show_pic").html('<img src="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'" style="width:50%;height:50%" alt="pic">');

        } catch (e) {

        };
    }
    
    function uploadResponseOther(serverData){  
        try {
            $("#txtFileName_video").val(""); 
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
            $("#video").val(filename);
           

        } catch (e) {

        };
    }

    function ajaxUpdateVideo()
    {
        var strUrl = "<?=$url->createUrl("footBallVideo/ajaxUpdateVideo") ?>";
        var title = $('#title').val();
        var video_link = $('#video_link').val();
        var video = $('#video').val();
        var cup_id = $('#cup_id').val();
        var match_id = $('#match_id').val();
        var club_id = $('#club_id').val();
        var description = $('#description').val();
        var status = $('#status').val();
        var picture = $('#picture').val();
        var id = $('#id').val();
        var create_date = $('#create_date').val();
   
        $.ajax({
           
            type: "POST",
            url: strUrl,
            data: {
                id: id,
                create_date: create_date,
                title: title,
                cup_id: cup_id,
                club_id: club_id,
                match_id: match_id,
                picture: picture,
                video_link: video_link,
                video: video,
                description: description,
                status:status,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Cập nhật thành công');       
                    window.location = '<?php echo $url->createUrl("footBallVideo/index")?>';
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
                        <input type="hidden" style="width:360px" value="<?php echo $video["id"]?>" id="id"> 
                        
                        <input type="text" style="width:360px" value="<?php echo $video["title"]?>" id="title"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Hiển Thị </strong>:</label>
                    <select id="status" style="width: 203px;">
                        <option value="1" <?php echo $selected = 1==$video["status"]?"selected":"";?>>Có</option>
                        <option value="0" <?php echo $selected = 0==$video["status"]?"selected":"";?>>Không</option>
                        
                    </select>
                </li>
                 <li class="clearfix"><label><strong>Giải Đấu </strong>:</label>
                    <div class="filltext">
                         <select name="cup_id" id="cup_id" >
                         <option value="0">Giải đấu khác</option>
                         <?php 
                              $i=0;
                               while($i<count($cupList)){
                                   $cup_id = $cupList[$i]["id"];
                                   $cup_name = $cupList[$i]["NAME"];
                                   $selected = $cupList[$i]["id"]==$video["cup_id"]?"selected":"";
                                   echo "<option value=\"".$cup_id."\" ".$selected.">".$cup_name."</option>";
                                   $i++;
                               }    
                          ?>
                        </select>
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Câu lạc bộ</strong>:</label>
                    <div class="filltext">
                        <select name="country" id="country" size="10" style="width: 150px;height:200px">
                          <option value="1">Anh</option>
                        <option value="2">Tây Ban Nha</option>
                        <option value="3">Đức</option>
                        <option value="4">Ý</option>
                        <option value="5">Pháp</option>
                        <option value="6">C1</option>
                        <option value="7">C2</option>
                        <option value="8">Viet Nam</option> 
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
                        <?php 
                             $i = 0;
                             while($i<count($clubList)){
                                $club_id = $clubList[$i]["id"];
                                $club_name = $clubList[$i]["NAME"];
                                $selected = $clubList[$i]["id"]==$video["club_id"]?"selected":"";
                                 echo "<option value=\"".$club_id."\"".$selected.">".$club_name."</option>";
                                 $i++;
                             }
                         ?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Match ID </strong>:</label>
                    <div class="filltext">
                         <input type="text" style="width:360px" value="<?php echo $video['match_id'];?>" id="match_id">
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

                        <input type="hidden" id="picture"value="<?php echo $video['image'];?>"/>
                        <p id="show_pic">
                        <img src="<?php echo Yii::app()->params['urlImages']?>bongda/video/<?php echo  date('Y/md', strtotime($video['create_date']))?>/<?php echo $video['image']?>" style="width:50%;height:50%">
                        </p>

                    </div>
                </li>
                  <li class="clearfix"><label><strong>Ngày tạo </strong>:</label>
                    <div class="filltext">
                        <input type="txt" style="width:360px" value="<?php echo $video["create_date"]?>" id="create_date"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Video: (Upload video hoặc dùng link) </strong>:</label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName_video" readonly="readonly"/>
                            <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder_other"></span>
                        </p>

                        <p><i>Định dạng file: *.mp4;</i></p>
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress_other">
                            <span class="legend">File upload</span>
                        </div>

                        <input type="hidden" id="video" value=""/>
                        <p id="show_video"></p>

                    </div>
                </li>

                <li class="clearfix"><label><strong>Video Link </strong>:</label>
                    <div class="filltext">
                         <input type="text" style="width:360px" value="<?php echo $video["video"]?>" id="video_link">
                    </div>
                </li>
                
                 <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"><?php echo $video["description"]?></textarea>
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
</div>