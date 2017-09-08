<?php
	$id_action = Yii::app()->controller->action->id;
	require_once("header_member.php");
	if($id_action=='vi')//Kiem tra neu la tieng viet khong dau
	{
		echo Common::change($content);
	}
	else
	{
		echo $content;
	}
	require_once("footer_member.php"); 
?>