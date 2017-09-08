<?php
    $url = new Url(); 
    $forder_upload = "bongda/footballer";  
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
    
   
    function ajaxSave()
    {
        var strUrl = "<?=$url->createUrl("footBaller/ajaxSave") ?>";
        var name = $('#name').val();
        var avatar = $('#picture').val();
        var country = $('#country').val();
        var birthday = $('#birthday').val();
        var height = $('#height').val();
        var weight = $('#weight').val();
        var club_id = $('#club_id').val();
        var position = $('#position').val();
        var join_date = $('#join_date').val();
        var transfer_free = $('#transfer_free').val();
        var former_club = $('#former_club').val();
        var one_club = $('#one_club').val();
        var conveniently_foot = $('#conveniently_foot').val();
        var achievement = $('#achievement').val();
        var clubshirtno = $('#clubshirtno').val();
        var id_7m = $('#id_7m').val();
        var avatar_link = $('#avatar_link').val();     
        
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                name: name,
                avatar: avatar,
                avatar_link: avatar_link,  
                country: country,
                birthday: birthday,
                height: height,
                weight: weight,
                club_id:club_id,
                position:position, 
                join_date:join_date, 
                transfer_free:transfer_free, 
                former_club:former_club, 
                one_club:one_club, 
                conveniently_foot:conveniently_foot, 
                achievement:achievement, 
                id_7m:id_7m, 
                clubshirtno:clubshirtno, 
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("footBaller/index")?>';
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
                <li class="clearfix"><label><strong>Tên giải </strong>:</label>
                    <div class="filltext">
                        <input type="hidden" style="width:360px" value="0" id="id">   
                        <input type="text" style="width:360px" value="<?php echo $footballer["name"]?>" id="name"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Quốc gia </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $footballer["country"]?>" id="country"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sinh nhật</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["birthday"]?>" id="birthday"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Chiều cao</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["height"]?>" id="height"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Cân nặng</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["weight"]?>" id="weight"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Club_ID</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["club_id"]?>" id="club_id"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Ngày gia nhập CLB</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["join_date"]?>" id="join_date"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Phí chuyển nhượng</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["transfer_free"]?>" id="transfer_free"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Club trước</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["former_club"]?>" id="former_club"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Club khác</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["one_club"]?>" id="one_club"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Chân thuận</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["conveniently_foot"]?>" id="conveniently_foot"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Thành tích</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["achievement"]?>" id="achievement"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Số áo</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["clubshirtno"]?>" id="clubshirtno"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>ID 7M</strong>:</label>
                    <div class="filltext">
                       <input type="text" style="width:360px" value="<?php echo $footballer["id_7m"]?>" id="id_7m"> 
                    </div>
                </li>
                 <li class="clearfix"><label><strong>Vị trí</strong>:</label>
                    <div class="filltext">
                       <select name="position" id="position">
                        <option value="1" <?php echo $selected = 0==$footballer["position"]?"selected":"";?>>Tiền đạo</option>    
                        <option value="1" <?php echo $selected = 1==$footballer["position"]?"selected":"";?>>Tiền vệ</option>
                        <option value="2" <?php echo $selected = 2==$footballer["position"]?"selected":"";?>>Hậu vệ</option>
                        <option value="3" <?php echo $selected = 3==$footballer["position"]?"selected":"";?>>Thủ môn</option>
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
                         <p id="show_pic">
                              <?php 
                            if($footballer['avatar']!=""){
                                ?>
                                  <img  src="<?php echo $footballer['avatar']?>" />
                                <?php
                            }
                        ?>
                        </p>

                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSave();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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