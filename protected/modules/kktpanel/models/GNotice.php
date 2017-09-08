<?php
	class GNotice extends CActiveRecord
	{
		
		public function getDbConnection()
		{
			return self::getGameStoreDbConnection();
		}
		
		public static function getNotice($object_id,$type)
		{
		    $connect = Yii::app()->db_gamestore;
		    $sql = "SELECT * FROM vtc_game_store.g_notice WHERE object_id=$object_id AND type=$type";
		    //var_dump($sql);die;
		    $command = $connect->createCommand($sql);
		    $data = $command->queryAll();
		    return $data;
		}
		
		public static function deleteNotice($id)
		{
		    $connect = Yii::app()->db_gamestore;
		    $sql = "DELETE FROM vtc_game_store.g_notice WHERE id=$id ";
		    //var_dump($sql);die;
		    $command = $connect->createCommand($sql);
		    $data = $command->execute();
		    return $data;
		}
		
		public static function insertNoticeGame($object_id,$content,$type,$status,$time,$create_date,$create_user,$icon)
		{
			$connect = Yii::app()->db_gamestore;
			$sql = "INSERT INTO vtc_game_store.g_notice(object_id,content,type,status,time_sent,create_date,create_user,icon) VALUES($object_id,'$content',$type,$status,'$time','$create_date','$create_user','$icon')";
			//var_dump($sql);die;
			$command = $connect->createCommand($sql);
			$data = $command->execute();
			return $data;
		}
		
	}
?>