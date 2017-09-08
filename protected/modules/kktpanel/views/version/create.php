<?php
    $url = new Url();
    $forder_upload = "app";
    $type_cat = LoadConfig::$type_cat;
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>
<script type="text/javascript">

    function ajaxSaveVersion(){
        var strUrl = "<?=$url->createUrl("version/ajaxSaveVersion") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                type:$("#type").val(),
                version:$("#version").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm mới thành công');
                    window.location = '<?php echo $url->createUrl("version/index")?>';
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
        <form method="post" action="<?php echo $url->createUrl("version/ajaxSaveVersion")?>" enctype="multipart/form-data">
            <ul class="form4">
                <li class="clearfix"><label><strong>Nội dung</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="type">
                            <?php foreach($type_cat as $key=>$value){
                                    if($key !=4){
                                    ?>
                                    <option value="<?php echo $key;?>"><?php echo $value?></option>
                                    <?php }
                                }
                            ?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Upload File Jar:</strong>:</label>
                    <div class="filltext">
                        <input type="file" name="jar" value=""/>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Upload File Jad:</strong>:</label>
                    <div class="filltext">
                        <input type="file" name="jad" value=""/>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Upload File Apk:</strong>:</label>
                    <div class="filltext">
                        <input type="file" name="apk" value=""/>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Version:</strong>:</label>
                    <div class="filltext">
                        <input type="text" name="version" value=""/>
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" type="submit" value=" Thêm mới " class="btn-bigblue"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext" style="color: red;" id="show_error">
                    <?php if(isset($error)){
                        foreach($error as $value){
                        ?>
                        <p><?php echo $value;?></p>
                    <?php }
                    }
                    ?>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>