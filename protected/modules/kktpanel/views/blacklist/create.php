<?php
    $url = new Url();
?>
<script type="text/javascript">
    function ajaxSaveBlacklist(){
        var strUrl = "<?=$url->createUrl("blacklist/ajaxSaveBlacklist") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                keyword:$("#keyword").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm mới thành công');
                    window.location = '<?php echo $url->createUrl("blacklist/index")?>';
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

            <li class="clearfix"><label><strong>Keyword </strong>:</label>
                <div class="filltext">
                    <input type="text" style="width: 300px;" id="keyword"/>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <input id="button_save" type="button" value=" Thêm mới " class="btn-bigblue" onclick="ajaxSaveBlacklist();"> 
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