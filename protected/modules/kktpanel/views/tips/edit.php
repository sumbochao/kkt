<?php
    $url = new Url();
?>
<script type="text/javascript">
    function ajaxUpdateTips(){
        var id = '<?php echo $data["id"]?>'
        var strUrl = "<?=$url->createUrl("tips/ajaxUpdateTips") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                title_tip:$("#title_tip").val(),
                url:$("#url").val(),
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("tips/index")?>';
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
        <ul class="form4">
            <li class="clearfix"><label><strong>Tiêu đề </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width: 500px;" id="title_tip" value="<?php echo $data["title"];?>"/>
                </div>
            </li>
            <li class="clearfix"><label><strong>Link </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width: 500px;" id="url" value="<?php echo $data["url"];?>"/>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" type="button" value=" Sửa " class="btn-bigblue" onclick="ajaxUpdateTips();"> 
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