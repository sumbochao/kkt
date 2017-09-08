<?php 
    $url = new Url();
?>
<div class="change_pas">
    <h2 class="bg_green"><strong>Đăng ký</strong></h2>
    <div class="box pad10">
        <span><strong>Bạn có chắc chắn muốn xóa domain này không ? </strong></span>
        &nbsp;&nbsp;
        <span><a href="<?php echo Url::createUrl("kktUser/deleteDomain",array('id'=>$d_id,'do'=>'delete'));?>"><strong>Có</strong></a></span> |
        <span><a href="<?php echo $url->createUrl('kktUser/domain');?>"><strong>Không</strong></a></span>
        <br /><br />
    </div>
</div>