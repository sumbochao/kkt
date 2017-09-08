<?php
    $url = new Url(); 
    $forder_upload = "bongda/match";  
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
            create_date: "<?php echo strtotime($cup['create_date']); ?>",        
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
    
    
    function ajaxUpdate()
    {
        var strUrl = "<?=$url->createUrl("footBallMatch/ajaxUpdate") ?>";
        var round = $('#round').val();
        var match_time = $('#match_time').val();    
        var season = $('#season').val();     
        var match_minute = $('#match_minute').val();
        var result = $('#result').val();
        var result_1 = $('#result_1').val();
        var status = $('#status').val();
        var stadium = $('#stadium').val();
        var referee = $('#referee').val();
        var id = $('#id').val();        
        
        var spotcast1 = $('#spotcast1').val();
        var spotcast2 = $('#spotcast2').val();
        var spotcast3 = $('#spotcast3').val();
        var spotcast4 = $('#spotcast4').val();
        var spotcast5 = $('#spotcast5').val();
        
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                round: round,
                match_time: match_time,     
                match_minute: match_minute,
                season: season,  
                result: result,
                result_1: result_1,
                status: status,
                stadium: stadium,
                referee:referee, 
                spotcast1:spotcast1, 
                spotcast2:spotcast2, 
                spotcast3:spotcast3, 
                spotcast4:spotcast4, 
                spotcast5:spotcast5, 
                id: id,
              },
            success: function(msg){
                if(msg == 1){
                    alert('Cập nhật thành công');
                    window.location = '<?php echo $url->createUrl("footBallMatch/index",array("page"=>$page))?>';
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
        <div clas = "box">
            <ul class="form">
                 <li class="clearfix"><label><strong>Đội bóng</strong>:</label>
                    <div class="filltext">
                        <?php echo $match["club_name_1"]."-".$match["club_name_2"]?>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Vòng Đấu </strong>:</label>
                    <div class="filltext">
                        <input type="hidden" style="width:360px" value="<?php echo $match["id"]?>" id="id">   
                        <input type="text" style="width:360px" value="<?php echo $match["round"]?>" id="round"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Mùa giải </strong>:</label>
                    <div class="filltext">
                     
                        <input type="text" style="width:360px" value="<?php echo $match["season"]?>" id="season"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Thời gian (yyyy-mm-dd hh:mm:ss)</strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $match["match_time"]?>" id="match_time"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Kết quả chung cuộc </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $match["result"]?>" id="result"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Kết quả hiệp 1</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $match["result_1"]?>" id="result_1"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sân</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $match["stadium"]?>" id="stadium"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Trọng tài</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $match["referee"]?>" id="referee"> 
                    </div>
                </li>
               
                 <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                    <div class="filltext">
                       <select name="status" id="status">
                            <option value=""></option>
                            <option value="Live" <?php echo $selected = strcasecmp("Live",$match["status"])==0?"selected":"";?>>Live</option> 
                            <option value="HT" <?php echo $selected = strcasecmp("HT",$match["status"])==0?"selected":"";?>>HT</option> 
                            <option value="FT" <?php echo $selected = strcasecmp("FT",$match["status"])==0?"selected":"";?>>FT</option> 
                            <option value="FT" <?php echo $selected = strcasecmp("Hoãn",$match["status"])==0?"selected":"";?>>Hoãn</option> 
                       </select> 
                    </div>
                </li>
                
            
                <li class="clearfix"><label><strong>Link Spotcast 1:</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $spotcast[0]?>" id="spotcast1"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Link Spotcast 2:</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $spotcast[1]?>" id="spotcast2"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Link Spotcast 3:</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $spotcast[2]?>" id="spotcast3"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Link Spotcast 4:</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $spotcast[3]?>" id="spotcast4"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Link Spotcast 5:</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $spotcast[4]?>" id="spotcast5"> 
                    </div>
                </li>
                
                    <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxUpdate();" type="button" value=" Update " class="btn-bigblue"> 
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
