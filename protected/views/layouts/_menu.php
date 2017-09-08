<script>
$(function(){
	var controler='<?php echo Yii::app()->controller->id;?>';
	var action='<?php echo Yii::app()->controller->action->id;?>';
	var compare=controler+'.'+action;
	$('#list_menu').find('a').each(function(){
		var rel=$(this).attr('rel');
		if(compare==rel)
		{
			$(this).removeClass().addClass('active');
		}
		else
		{
			$(this).removeClass('active');
		}
	});
});
</script>
<?php
$action=Yii::app()->controller->action->id;
?>
<ul class="list_style clearfix" id="list_menu">
    <li><a rel="kktMember.index" href="<?php echo Url::createUrl('kktMember/index');?>">Trang chủ</a>&nbsp;|&nbsp;</li>
    <!--<li>
    	<a rel="game.<?php if($action=='hotGameOnline' || $action=='latestGameOnline' || $action=='gameOnline' || $action=='catGameOnline') echo $action;?>" href="<?php echo Url::createUrl('kktGame/gameOnline');?>">Game online</a>&nbsp;|&nbsp;
    </li> -->
    <!--<li><a rel="kktMember.kenh18" href="<?php echo Url::createUrl('kktMember/kenh18');?>">Kênh 18</a>&nbsp;|&nbsp;</li>-->
    <li><a rel="kktGame.<?php if($action=='hotGameKD' || $action=='latestGameKD' || $action=='gameKD' || $action=='gameKDDetail' || $action=='catGameKD') echo $action;?>" href="<?php echo Url::createUrl('kktGame/gameKD');?>">Game kinh điển</a>&nbsp;|&nbsp;</li>
    <li><a rel="kktVideo.<?php if($action=='hot' || $action=='latest' || $action=='detail' || $action=='index' || $action=='cat' || $action=='vi') echo $action;?>" accesskey="video" href="<?php echo Url::createUrl('kktVideo/index');?>">Video</a>&nbsp;|&nbsp;</li>
    <li><a rel="kktAlbum.<?php if($action=='cat' || $action=='detail' || $action=='index' || $action=='cat'  || $action=='vi') echo $action;?>" accesskey="album" href="<?php echo Url::createUrl('kktAlbum/index');?>">Ảnh nóng</a>&nbsp;|&nbsp;</li>
    <li><a rel="kktNews.<?php if($action=='cat' || $action=='detail' || $action=='index' || $action=='cat'  || $action=='vi') echo $action;?>" accesskey="news" href="<?php echo Url::createUrl('kktNews/index');?>">Tin hot</a></li>
</ul>