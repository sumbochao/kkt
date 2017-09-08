<?php

class FAppAccount extends CActiveRecord
{

    public function deleteAccount($app_id)
    {
        $connect = Yii::app()->db_facebook;
        $sql = "DELETE FROM vtc_adv_facebook.facebook_app WHERE app_id=$app_id ";
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }

    public function changeAccount($id, $app_id, $app_secret, $title, $status)
    {
        $connect = Yii::app()->db_facebook;
        $sql= "UPDATE vtc_adv_facebook.facebook_app SET app_id = '$app_id' , app_secret = '$app_secret' , title = '$title' , STATUS = '$status' WHERE id = '$id' ;";
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }
    
    public function insert($app_id, $account_id)
    {
        $kq = 0;
        try {
            $connect = Yii::app()->db_facebook;
            $sql = "INSERT INTO vtc_adv_facebook.facebook_app_account (app_id,account_id) VALUES ('$app_id','$account_id');)";
            $command = $connect->createCommand($sql);
            $kq = $command->execute();
          
        } catch (Exception $e) {
            $kq = 0;
        }
        return $kq;
       
    }
}
?>
