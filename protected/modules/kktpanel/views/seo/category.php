<?php $url = new Url();?>
<script type="text/javascript">
    function ajaxSaveSeoCategory(){
        var strUrl = "<?=$url->createUrl("seo/ajaxSaveSeoCategory") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                id:'<?php echo intval($data["id"])?>',
                meta_title:$("#meta_title").val(),
                meta_keyword:$("#meta_keyword").val(),
                meta_description:$("#meta_description").val(),
                top_content:$("#top_content").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('SEO danh mục thành công');
                    history.go(-1);
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
            <li class="clearfix"><label><strong>&nbsp;</strong></label>
                <div class="filltext">
                    <p>Seo cho danh mục: <strong><?php echo $data["name"]?></strong></p> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Title </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:500px" value="<?php echo $data["meta_title"]?>" id="meta_title"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Keyword </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:500px" value="<?php echo $data["meta_keyword"]?>" id="meta_keyword"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Description </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:500px" value="<?php echo $data["meta_description"]?>" id="meta_description"> 
                </div>
            </li>
            <li class="clearfix"><label><strong>Top Content </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width:500px" value="<?php echo $data["top_content"]?>" id="top_content"> 
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" onclick="ajaxSaveSeoCategory();" type="button" value=" Lưu " class="btn-bigblue"> 
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