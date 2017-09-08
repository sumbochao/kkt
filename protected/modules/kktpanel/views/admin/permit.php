<?php
    $url = new Url();
    $modules = PermitConfig::$permission_module;
?>
<script type="text/javascript">
    $(document).ready(function() {                          
        $("input.check_all").click(function(){
            var checked_status = this.checked;
            $("input.check_id").each(function(){this.checked = checked_status;});
        });
        $("input.check_view_all").click(function(){
            var checked_status = this.checked;
            $("input.check_view").each(function(){this.checked = checked_status;});
        });
        $("input.check_create_all").click(function(){
            var checked_status = this.checked;
            $("input.check_create").each(function(){this.checked = checked_status;});
        });
        $("input.check_edit_all").click(function(){
            var checked_status = this.checked;
            $("input.check_edit").each(function(){this.checked = checked_status;});
        });
        $("input.check_del_all").click(function(){
            var checked_status = this.checked;
            $("input.check_del").each(function(){this.checked = checked_status;});
        });
    });
    function ajaxSavePermit(){
        var adminId = '<?php echo $data_admin["id"];?>';
        var module_permit = "";
        $("input[name=module]").each(function(){
            var module_id = this.value;
            var permisId = 0;
            $("input[name=action_"+module_id+"]").each(function(){
                if($(this).is(":checked")){
                    permisId = permisId + parseInt(this.value);
                }
            });
            if(permisId >15){permisId = 15};
            if(permisId >0){
                module_permit += module_id + ":" + permisId + ";";
            }
        });
        var strUrl = "<?=$url->createUrl("admin/ajaxSavePermit") ?>"; 
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                adminId:adminId,
                module_permit:module_permit
            },
            success: function(msg){
                if(msg == 1){
                    alert('Phân quyền thành công');
                    window.location = '<?php echo $url->createUrl("admin/index")?>';
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
</script>
<div class="main clearfix">
    <div class="title-blue">
        <h3><strong>Phân quyền admin cho user: <a href="#"><?php echo $data_admin["username"]?></a></strong></h3>
    </div>
    <div class="col55">
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="3%"><strong>ID</strong></td>
                        <td width="15%"><strong>Quyền tương ứng</strong></td>
                        <td width="35%"><strong>Phân quyền</strong><br />
                            <div class="box">
                                <div class="col20"><input type="checkbox" class="check_all" value="1">Tất cả</div>
                                <div class="col15"><input type="checkbox" class="check_view_all" value="1">Xem</div>
                                <div class="col15"><input type="checkbox" class="check_create_all" value="1">Thêm</div>
                                <div class="col25"><input type="checkbox" class="check_edit_all" value="1">Sửa</div>
                                <div class="col20"><input type="checkbox" class="check_del_all" value="">Xóa</div>
                            </div>
                        </td>
                    </tr>
                    <?php foreach($modules as $key=>$value){?>
                        <tr>
                            <td>
                                <?php echo $key;?>
                                <input type="hidden" name="module" value="<?php echo $key;?>"/>
                            </td>
                            <td class="text-left">
                                <strong><?php echo $value["label"]?></strong>
                            </td>
                            <td>     
                                <div class="box">
                                    <div class="col20"><input type="checkbox" class="check_id" name="action_<?php echo $key;?>" value="15" <?php echo isset($data_permit[$key]) && ((intval($data_permit[$key]) & 15) == 15) ? 'checked="checked"':'';?> >Tất cả</div>
                                    <div class="col15"><input type="checkbox" class="check_view" name="action_<?php echo $key;?>" value="1" <?php echo isset($data_permit[$key]) && $data_permit[$key] <15 && ((intval($data_permit[$key]) & 1) == 1) ? 'checked="checked"':'';?>> Xem</div>
                                    <div class="col15"><input type="checkbox" class="check_create" name="action_<?php echo $key;?>" value="2" <?php echo isset($data_permit[$key]) && $data_permit[$key] <15 && ((intval($data_permit[$key]) & 2) == 2) ? 'checked="checked"':'';?>>Thêm</div>
                                    <div class="col25"><input type="checkbox" class="check_edit" name="action_<?php echo $key;?>" value="4" <?php echo isset($data_permit[$key]) && $data_permit[$key] <15 && ((intval($data_permit[$key]) & 4) == 4) ? 'checked="checked"':'';?>>Sửa</div>
                                    <div class="col20"><input type="checkbox" class="check_del" name="action_<?php echo $key;?>" value="8" <?php echo isset($data_permit[$key]) && $data_permit[$key] <15 && ((intval($data_permit[$key]) & 8) == 8) ? 'checked="checked"':'';?>>Xóa</div>
                                </div>
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
            <div class="filltext">
                <input id="button_save" onclick="ajaxSavePermit()" type="button" class="btn-gray" value="   Save  ">
            </div>
        </div>
    </div>
</div>