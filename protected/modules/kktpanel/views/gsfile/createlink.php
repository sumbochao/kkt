<?php
     $url = new Url(); 
 ?>
<script type="text/javascript">
    function ajaxSaveLink(){
        var strUrl = "<?=$url->createUrl("gsfile/ajaxSaveLink") ?>";
        var game_id = "<?php echo $game_id;?>";
        var name = $('#name').val();
        var size = $('#size').val();
        var version = $("#version").val();
        var version_os = $("#version_os").val();
        var link = $('#link').val();
        $.ajax({
            type:"POST",
            url: strUrl,
            data: {
                game_id: game_id,
                name: name,
                size: size,
                version: version,
                version_os: version_os,
                link: link
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsfile/index",array('id'=>$game_id))?>';
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
            <div clas = "box">
            
                <ul class="form">
                    <li class="clearfix">
                        <strong>Thêm Link</strong>
                        <hr>
                    </li>
                    
                    <!--<li>
                        <p>
                            <label><strong>File Name:</strong></label>
                            <input type="text" name="name" id="name" style="width: 200px;">
                        </p>
                    </li>-->
                    
                    <li>
                        <p>
                            <label><strong>Size:</strong></label>
                            <input type="text" name="size" id="size" style="width: 200px;">
                        </p>
                    </li>
                    
                    <li>
                        <p>
                            <label><strong>Version:</strong></label>
                            <input type="text" name="version" id="version" style="width: 200px;">
                        </p>
                    </li>

                    <li>
                        <p>
                            <label><strong>Os Version:</strong></label>
                            <input type="text" name="version_os" id="version_os" style="width: 200px;">
                        </p>
                    </li>
                    
                    <li>
                        <p>
                            <label><strong>Link:</strong></label>
                            <input type="text" name="link" id="link" style="width: 400px;">
                        </p>
                    </li>
                    
                    <li style="margin-left: 100px;">
                        <div class="filltext">
                            <input id="button_save" onclick="ajaxSaveLink();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                            &nbsp;
                            <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                        </div>
                    </li>

                    <li class="clearfix" style="margin-left: 100px;">
                        <div class="filltext" style="color: red;" id="show_error"></div>
                    </li>
                </ul>
            
            </div>
        </div>
    
    </div>
</div>