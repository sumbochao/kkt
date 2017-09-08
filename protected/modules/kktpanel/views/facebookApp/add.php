<?php
    $url = new Url(); 
?>
<script type="text/javascript">
    function ajaxSaveAccount(){
        var strUrl = "<?=$url->createUrl("facebookApp/ajaxsaveapp") ?>";
        var app_id = $("#app_id").val();
        var app_secret = $("#app_secret").val();
        var title = $("#title").val();
        var status = $("#status").val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
            	app_id: app_id,
            	app_secret: app_secret,
            	title: title,
                status: status ,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("facebookApp/index")?>';
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
            <div class="box">
                <ul class="form">
                    <li class="clearfix"><label><strong>App Id </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="app_id"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>App secret</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="app_secret"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Title </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="" id="title"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Status </strong>:</label>
                        <div class="filltext">
                            <select name="status"  id="status"> 
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxSaveAccount();" type="button" value=" Thêm mới " class="btn-bigblue"> 
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
