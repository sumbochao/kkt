<?php
    $url = new Url();
    $arr_tip = LoadConfig::$arr_tip;
    $current_url = Common::getCurrentUrl();
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("blacklist/ajaxDelete") ?>";
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
                <a href="<?php echo $url->createUrl("blacklist/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
            </div>
        </div>
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="4%"><strong>ID</strong></td>
                        <td width="30%"><strong>Keyword</strong></td>
                        <td width="30%"><strong>Keyword Đăng ký </strong></td>
                        <td width="16%"><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){?>
                        <tr>
                          <td><?php echo $value["id"];?></td>  
                          <td><?php echo $value["keyword"];?></td>  
                          <td><?php echo $value["keyword_register"];?></td>  
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