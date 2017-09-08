<?php
    $url = new Url(); 
    $forder_upload = "bongda/club";  
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
    
   
    function ajaxSaveClub()
    {
         //CODE,NAME,name_en,city,country,info, 
    //logo,stadium,stadium_capacity,address,website,fan_page,email,established_date,coach_id,map,avgage,create_date,create_user,refe,id_7m
        var strUrl = "<?=$url->createUrl("footBallClub/ajaxSaveClub") ?>";
        var name = $('#name').val();
        var name_en = $('#name_en').val();    
        var code = $('#code').val();
        var city = $('#city').val();
        var country = $('#country').val();
        var info = $('#info').val();
        var picture = $('#picture').val();
        var stadium = $('#stadium').val();    
        var stadium_capacity = $('#stadium_capacity').val();      
        var address = $('#address').val();      
        var website = $('#website').val();      
        var fan_page = $('#fan_page').val();      
        var email = $('#email').val();        
        var established_date = $('#established_date').val();        
        var coach_id = $('#coach_id').val();        
        var map = $('#map').val();        
        var avgage = $('#avgage').val(); 
        var refe = $('#refe').val();        
        var id_7m = $('#id_7m').val();        
        var logo_link = $('#logo_link').val();                      
        var country_en = $('#country_en').val();           
       
        $.ajax({
           
            type: "POST",
            url: strUrl,
            data: {
                name: name,
                name_en: name_en,
                code: code,
                city: city,
                country: country,
                country_en: country_en,
                info: info,
                logo:picture,
                stadium:stadium,  
                stadium_capacity:stadium_capacity,  
                address:address,  
                website:website,  
                fan_page:fan_page,  
                email:email,  
                established_date:established_date,  
                coach_id:coach_id,  
                map:map,  
                avgage:avgage,  
                refe:refe,  
                id_7m:id_7m,    
                
              },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("footBallClub/index")?>';
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
                <li class="clearfix"><label><strong>Tên đội </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="name"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Tên tiếng Anh </strong>:</label>
                    <input type="text" style="width:360px" value="" id="name_en"> 
                </li> 
                 <li class="clearfix"><label><strong>Mã đội </strong>:</label>
                    <input type="text" style="width:360px" value="" id="code"> 
                </li>
                 <li class="clearfix"><label><strong>Quốc gia </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="country"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Quốc gia En </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="country_en"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Thành phố </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="city"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Ngày thành lập</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="established_date"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sân vận động</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="stadium"> 
                    </div>
                </li>
                  <li class="clearfix"><label><strong>Sức chứa</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="stadium_capacity"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Địa chỉ</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="address"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Website</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="website"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Fanpage</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="fan_page"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Email</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="email"> 
                    </div>
                </li>
                
                 <li class="clearfix"><label><strong>Bản đồ</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="map"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Độ tuổi trung bình</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="avgage"> 
                    </div>
                </li>
                  <li class="clearfix"><label><strong>Coach ID</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="0" id="coach_id"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>ID 7m</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="id_7m"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>SMS Refe</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="" id="refe"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="info"></textarea>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Logo Up </strong>:</label>
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
                        <p id="show_pic">
                         
                        </p>

                    </div>
                </li>
               
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSaveClub();" type="button" value=" Save " class="btn-bigblue"> 
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