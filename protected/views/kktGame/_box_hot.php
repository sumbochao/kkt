<?php
if($game_hot)
foreach($game_hot as $row)
{
	if($row['isOnline']==1)
		$link_detail=Url::createUrl('kktGame/download',array('game_id'=>$row['id'],'alias'=>$row['alias']));
	else	
		$link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
	?>
	<div class="news pad10 bg_orage2">
		<span class="s14">Hot: <a class="clorage" href="<?php echo $link_detail;?>"><strong><?php echo $row['title'];?></strong></a> <img alt="icon new" src="<?php echo Yii::app()->params['static_url'];?>/images/icon_new2.png"></span> <br>
	</div>
	<?php
}
?>