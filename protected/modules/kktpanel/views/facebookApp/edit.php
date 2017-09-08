<?php 
$url = new  Url();
$id= $_GET['id'];
//var_dump($data);die;
?>
<script type="text/javascript">
    function ajaxEditApp(){
        var strUrl = "<?=$url->createUrl("facebookApp/ajaxupdate") ?>";
        var id = $("#id").val();
        var app_id = $("#app_id").val();
        var app_secret = $("#app_secret").val();
        var title = $("#title").val();
        var status = $("#status").val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id: id ,
            	app_id: app_id,
            	app_secret: app_secret,
            	title: title,
                status: status ,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Edit thành công');
                    window.location = '<?php echo $url->createUrl("facebookApp/index")?>';
                }else{
                    $("#show_error").html(msg);
                    alert('Edit that bai mia no roi');
                }
            },
            beforeSend:function(){
                $("#button_update").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_update").removeAttr("disabled"); 
            } 
        });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">  
    
        <div class="col-570">  
            <div class="box">
                <ul class="form">
          
                        <div class="filltext">
                            <input type="hidden" style="width:360px;display:none"  value="<?php echo $data["id"]?>" id="id"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>App id mới</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data["fb_app_id"]?>" id="app_id"> 
                        </div>
                    </li>
                   <li class="clearfix"><label><strong>App Secret </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data["app_secret"]?>" id="app_secret"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Title </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo $data["title"]?>" id="title"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Status </strong>:</label>
                        <div class="filltext">
                            <select name="status"  id="status"> 
                                <option value="1" <?php echo $data["STATUS"]==1?"selected=\"selected\"":""?> >Active</option>
                                <option value="0" <?php echo $data["STATUS"]==0?"selected=\"selected\"":""?>>InActive</option>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_update" onclick="ajaxEditApp();" type="button" value=" Sửa  " class="btn-bigblue"> 
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
