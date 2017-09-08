<?php 
    $url = new Url();
    $path = Common::getCurrentUrl();
    $arr_status = LoadConfig::$status;
?>
<script type="text/javascript">
    function check_editemail(mail) {
        emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
        if (emailRegExp.test(mail)) {
            return 1;
        }
        else {
            return 0;
        }
    }
    function ajaxSaveAdmin(){
        if(check_editemail($("#email").val()) !=1){
            alert('Không đúng định dạng email');
            return false;  
        }
        var strUrl = "<?=$url->createUrl("admin/ajaxSaveAdmin") ?>"; 
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                username:$("#username").val(),
                password:$("#password").val(),
                re_pass:$("#re_pass").val(),
                email:$("#email").val(),
                full_name:$("#full_name").val(),
                status:$("#status").val()
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm mới thành công');
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
    function ajaxQuickUpdate(id){
        var status = $("#status_admin_"+id).val();
        var strUrl = "<?=$url->createUrl("admin/ajaxQuickUpdate") ?>"; 
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    window.location = '<?php echo $url->createUrl("admin/index")?>';
                }else{
                    alert(msg);
                }
            }   
        });
    }              
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("admin/ajaxDelete") ?>"; 
        if(confirm('Bạn có chắc chắn muốn xóa admin này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {id:id},
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        window.location = '<?php echo $url->createUrl("admin/index")?>';
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
    function ajaxResetPass(id){
        var strUrl = "<?=$url->createUrl("admin/ajaxResetPass") ?>"; 
        if(confirm('Bạn có chắc chắn muốn reset pass của admin này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {id:id},
                success: function(msg){
                    if(msg == 1){
                        alert('Reset thành công! Pass moi la ten username + 123 ');
                        window.location = '<?php echo $url->createUrl("admin/index")?>';
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
    function ajaxDeletePermit(userId){
        var strUrl = "<?=$url->createUrl("admin/ajaxDeletePermit") ?>"; 
        if(confirm('Bạn có chắc chắn muốn xóa quyền của admin này không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {userId:userId},
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa phân quyền thành công');
                        window.location = '<?php echo $url->createUrl("admin/index")?>';
                    }else{
                        alert(msg);
                    }
                }
            });
        }
    }
</script>
<div class="main clearfix">
    <div class="Tabs clearfix">
        <ul class="clearfix">
            <li><a href="<?=$url->createUrl("admin/index") ?>" class="active"><span>Danh sách admin</span></a></li>
        </ul>                
    </div>
    <div class="title-blue">
        <h3><strong>Danh sách admin</strong></h3>
    </div>
    <div class="box clearfix">
        <form name="Search_Admin" method="GET">
            <ul class="form">
                <li class="clearfix">
                    <label><strong>Từ khóa:</strong></label>
                    <div class="filltext">
                        <input type="text" name="username" style="width:32%" value="<?php echo $username ?>">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Trạng thái:</strong></label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="" >- Tất cả -</option> 
                            <option value="active" <?php echo ($status == "active" ? 'selected="selected"':'' )?>>Active</option>
                            <option value="reject" <?php echo ($status == "reject" ? 'selected="selected"':'' )?>>Bị khóa</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix">
                    <label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value="   Tìm  " class="btn-gray">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class="table clearfix">
        <div class="fillter clearfix">
            <div class="fl">
                <label><strong>Có </strong><span class="clred">&nbsp;<?=count($data) >0 ? count($data):0 ?>&nbsp;</span> <strong>user</strong></label>
            </div>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr class="bg-grey">
                    <td width="3%"><strong>STT</strong></td>
                    <td width="15%"><strong>Username</strong></td>
                    <td width="15%"><strong>Email</strong></td>
                    <td width="15%"><strong>Họ Tên</strong></td>
                    <td width="10%"><strong>Trạng thái</strong></td>
                    <td width="20%"><strong>Quản trị</strong></td>
                </tr>
                <?php for($i=0;$i<count($data);$i++){?>
                    <tr>
                        <td><?=($i+1) ?></td>
                        <td class="text-left">
                            <?=$data[$i]["username"] ?>
                            <br/>
                            <?=date("d-m-Y",$data[$i]["create_date"]) ?>
                        </td>
                        <td><?=$data[$i]["email"] ?></td>
                        <td><?=$data[$i]["full_name"] ?></td>
                        <td>
                            <select id="status_admin_<?php echo $data[$i]["id"]?>">
                                <option value="active" <?php echo ($data[$i]["status"] == "active" ? 'selected="selected"':'' )?>>Active</option>
                                <option value="reject" <?php echo ($data[$i]["status"] == "reject" ? 'selected="selected"':'' )?>>Bị khóa</option>
                            </select>
                        </td>
                        <td>
                            <p align="center">
                                [<a class="popup_set_role" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $data[$i]["id"];?>')">Lưu </a>]
                                [<a href="javascript:void(0)" onclick="ajaxDelete('<?=$data[$i]["id"] ?>')">Xóa</a>]
                                [<a href="javascript:void(0)" onclick="ajaxResetPass('<?=$data[$i]["id"] ?>')">Reset Pass</a>]
                                [<a href="javascript:void(0)" onclick="ajaxDeletePermit('<?=$data[$i]["id"] ?>')">Xóa quyền</a>]
                                [<a href="<?php echo $url->createUrl("admin/permit",array("userId"=>$data[$i]["id"]))?>" >Phân quyền</a>]
                            </p>
                        </td>
                    </tr>
                    <?php }?>
            </tbody>
        </table>
    </div>
    <div class="box">
        <h5>Thêm User</h5>
        <div class="box-bor1">
            <ul class="form">
                <li class="clearfix">
                    <label><strong>User name:</strong></label>
                    <div class="filltext">
                        <input type="text" style="width:26%" value="" id="username" name="username">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Password:</strong></label>
                    <div class="filltext">
                        <input type="password" style="width:26%" value="" id="password" name="password">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Nhập lại password:</strong></label>
                    <div class="filltext">
                        <input type="password" style="width:26%" value="" id="re_pass" name="re_pass">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Họ Tên:</strong></label>
                    <div class="filltext">
                        <input type="text" style="width:26%" value="" id="full_name" name="full_name">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Email:</strong></label>
                    <div class="filltext">
                        <input type="text" style="width:26%" value="" id="email" name="email">
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Trạng thái:</strong></label>
                    <div class="filltext">
                        <select style="width:203px;" id="status">
                            <option value="active">Active</option>
                            <option value="reject">Bị khóa</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix">
                    <label>&nbsp;</label>
                    <div class="filltext">
                        <input id="button_save" type="button" onclick="ajaxSaveAdmin()" value="   Thêm user  " class="btn-gray">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
 
