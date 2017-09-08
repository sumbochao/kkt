<?php
    $url = new Url();
    $arr_status = $arr_status = LoadConfig::$status;
?>
<script type="text/javascript">
        function ajaxSaveGame(){
        var category = $("#category").val();
        var status = $("#status").val();
        var ishot = $("#hot").val();
        var description = $("#description").val();
        var strUrl = "<?=$url->createUrl("sms/ajaxSave") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                category: category,
                status: status,
                ishot: ishot,
                description: description,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("sms/index")?>';
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

<div id="container">
    <div class="main clearfix">
        <div class="box clearfix bottom30">
            <div class="col-570">
                <ul id="form_create" class="form">

                    <li class="clearfix">
                        <label>
                            <strong>Loại danh mục</strong>
                        </label>
                        <div class="filltext">
                            <select id="category" name="category">
                                <?php foreach($data_cat as $key=>$value){?>
                                    <option value="<?php echo $key;?>"><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                
                    <li class="clearfix">
                        <label>
                            <strong>Trạng thái </strong>
                        </label>
                        <div class="filltext">
                            <select id="status" name="status">
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>"><?php echo $value?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix">
                        <label>
                            <strong>Nổi bật </strong>
                        </label>
                        <div class="filltext">
                            <select id="hot" name="hot">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix">
                        <label>
                            <strong>Nội dung  </strong>
                        </label>
                        <div class="filltext">
                            <textarea id="description" name="description" cols="45" rows="200" style="height: 120px;"></textarea>
                        </div>
                    </li>
                    <p id ="show_error"></p>

                    <li class="clearfix">
                        <label> </label>
                        <div class="filltext" style="margin-left: 97px;">
                            <input onclick="ajaxSaveGame();" id="button_save" class="btn-bigblue" type="button" value=" Thêm mới ">
                            <input class="btn-bigblue" type="button" onclick="history.go(-1)" value=" Quay lại ">
                        </div>
                    </li>


                </ul>
            </div>
        </div>
    </div>
</div>