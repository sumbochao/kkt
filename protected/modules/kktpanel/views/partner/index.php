<?php $url = new Url();?>
<script type="text/javascript">
    function ajaxSavePartner(){
        var strUrl = "<?=$url->createUrl("partner/ajaxSavePartner") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                name:$("#name_partner").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm mới thành công');
                    window.location = '<?php echo $url->createUrl("partner/index")?>';
                }else{
                    alert(msg);
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
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("partner/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                name:$("#name_"+id).val(),
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    location.reload();
                }else{
                    alert(msg);
                }
            }          
        });
    }
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("partner/ajaxDelete") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    id:id
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert(msg);
                    }
                }          
            });
        }
    }
</script>
<div class="main clearfix">
    <div class="box">
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="4%"><strong>ID</strong></td>
                        <td width="20%"><strong>Đối tác</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>
                        <td width="13%"><strong>Hành động</strong></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input type="text" id="name_partner" value=""/></td>
                      <td>&nbsp;</td>
                      <td><input class="btn-bigblue" type="button" value="Thêm Mới" id="button_save" onclick="ajaxSavePartner();"/></td>
                    </tr>
                    <?php foreach($data as $key=>$value){
                        ?>
                        <tr>
                            <td><?php echo $value["id"];?></td>  
                            <td><input type="text" value="<?php echo $value["name"];?>" id="name_<?php echo $value["id"];?>"></td>  
                            <td><?php echo date('d-m-Y H:i:s',$value["create_date"]);?></td> 
                            <td>
                                <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"];?>')">Xóa</a>
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>