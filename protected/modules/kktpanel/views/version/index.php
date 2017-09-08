<?php
    $url = new Url();
    $type_cat = LoadConfig::$type_cat;
    $current_url = Common::getCurrentUrl();
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("version/ajaxDelete") ?>";
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
        <div class="fillter clearfix">
            <div class="fl">
                <a href="<?php echo $url->createUrl("version/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
            </div>
        </div>
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="4%"><strong>ID</strong></td>
                        <td width="14%"><strong>Loại</strong></td>
                        <td width="14%"><strong>Version </strong></td>
                        <td width="10%"><strong>Ngày tạo</strong></td>
                        <td width="16%"><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                          <td><?php echo $value["id"];?></td>  
                          <td><?php echo $type_cat[$value["type"]];?></td>  
                          <td><?php echo $value["version"];?></td>  
                          <td><?php echo date('d-m-Y H:i:s',$value["create_date"]);?></td> 
                          <td>
                          <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"];?>')">Xóa</a>
                          </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>