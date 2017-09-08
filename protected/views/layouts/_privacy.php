<?php $domain = Common::getSubDomain();
if($domain=='' || $domain=='kenhkiemtien'){ 
?>
<div class="suport_ifo bg_green1 pad10">
    <ul class="list_style">
    	<li class="pad_btt5"><a href="<?php echo Url::createUrl("kktGeneral/paymentRule");?>"><strong>Quy định thanh toán</strong></a></li>
        <li class="pad_btt5"><a href="<?php echo Url::createUrl("kktGeneral/privacy");?>"><strong>Quy định sử dụng</strong></a></li>
        <li class="pad_btt5"><a href="<?php echo Url::createUrl("kktGeneral/help");?>"><strong>Trợ giúp</strong></a></li>
        <li class="pad_btt5"><a href="<?php echo Url::createUrl("kktGeneral/qa");?>"><strong>Các câu hỏi thường gặp</strong></a></li>
    </ul>
</div>
<?php }?>