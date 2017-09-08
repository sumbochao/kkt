<?php

class FacebookApp extends CActiveRecord
{

    public function getAll()
    {
        $connect = Yii::app()->db_facebook;
        $sql = "SELECT 	fb_app_id, app_secret, title, STATUS FROM vtc_adv_facebook.facebook_app ";
        $command = $connect->createCommand($sql);
        $all = $command->queryAll();
        return $all;
    }
    
    public function getById($id)
    {
        $connect = Yii::app()->db_facebook;
        $sql = "SELECT  id,fb_app_id, app_secret, title, STATUS FROM vtc_adv_facebook.facebook_app Where id = $id ";
        $command = $connect->createCommand($sql);
        $all = $command->queryRow();
        return $all;
    }
    
    
    public function getAllLive()
    {
        $connect = Yii::app()->db_facebook;
        $sql = "SELECT     id,fb_app_id, app_secret, title, STATUS FROM vtc_adv_facebook.facebook_app Where status = 1 ";
        $command = $connect->createCommand($sql);
        $all = $command->queryAll();
        return $all;
    }

    public function getAllData2($page, $row_per_page, $keyword)
    {
        $str_sql = "";
        if ($keyword != "") {
            $str_sql .= " AND fb_app_id LIKE '%" . $keyword . "%' ";
        }
        $str_order = " ORDER BY id DESC ";
    
        $connect = Yii::app()->db_facebook;
        $sql = "SELECT COUNT(fb_app_id) as count FROM vtc_adv_facebook.facebook_app WHERE 1 " . $str_sql;
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"]) / $row_per_page);
        $first = ($page - 1) * $row_per_page;
        
        $sql = "SELECT * FROM vtc_adv_facebook.facebook_app WHERE 1 " . $str_sql . " " . $str_order . " LIMIT " . $first . "," . $row_per_page . "";
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        
        return array($max_page,intval($data_count["count"]),$data);
    }

    public function deleteAccount($app_id)
    {
        $connect = Yii::app()->db_facebook;
        $sql = "DELETE FROM vtc_adv_facebook.facebook_app WHERE fb_app_id=$app_id ";
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }

    public function changeAccount($id, $app_id, $app_secret, $title, $status)
    {
        $connect = Yii::app()->db_facebook;
        $sql= "UPDATE vtc_adv_facebook.facebook_app SET fb_app_id = '$app_id' , app_secret = '$app_secret' , title = '$title' , STATUS = '$status' WHERE id = '$id' ;";
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }
    
    public function addInfor($app_id, $app_secret, $title, $status)
    {
        $kq = 0;
        try {
            $connect = Yii::app()->db_facebook;
            $sql = "INSERT INTO vtc_adv_facebook.facebook_app (fb_app_id, app_secret, title, STATUS)VALUES('$app_id', '$app_secret', '$title', '$status')";
            $command = $connect->createCommand($sql);
            $kq = $command->execute();
          
        } catch (Exception $e) {
            $kq = 0;
        }
        return $kq;
       
    }
}
?>
