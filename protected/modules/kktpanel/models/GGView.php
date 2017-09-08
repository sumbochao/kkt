<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GGView extends CActiveRecord{
    public function updatePosition($key, $value)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game_view  SET order_view =$key  WHERE id=$value ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
    public function CountTypeId($type)
    {
        $connect = Yii::app()->db_gamestore;
        $sql ="SELECT MAX(order_view) as vt FROM vtc_game_store.g_game_view WHERE type_view =1";
        $command = $connect->createCommand($sql);
        $count = $command->queryRow();
        return $count["vt"];
    }

    public function InsertGameHot($game_id,$order_view)
    {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_view (game_id,order_view, type_view) VALUES (?,?,1)";
            $command = $connect->createCommand($sql);
            $data = $command->execute(array($game_id,$order_view));
            return $data;
    }
    
    public function InsertGameNew($game_id,$order_view)
    {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_view (game_id,order_view, type_view) VALUES (?,?,2)";
            $command = $connect->createCommand($sql);
            $data = $command->execute(array($game_id,$order_view));
            return $data;
    }
    
    public function InsertGameMini($game_id,$order_view)
    {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_view (game_id,order_view, type_view) VALUES (?,?,3)";
            $command = $connect->createCommand($sql);
            $data = $command->execute(array($game_id,$order_view));
            return $data;
    }
    public function GetStatusId($id)
    {
         $connect = Yii::app()->db_gamestore;
         $sql = "SELECT * FROM vtc_game_store.g_game_view WHERE id ='$id'";
         $command = $connect->createCommand($sql);
         $data = $command->queryRow();
         return $data;
    }
    
    public function getStatus($game_id,$type_view)
    {
        $connect = Yii::app()->db_gamestore;
        $sql = "SELECT * FROM vtc_game_store.g_game_view WHERE game_id = '$game_id' AND type_view = '$type_view'";
        $command =$connect->createCommand($sql);
        $result = $command->queryRow();
        return $result; exit;
    }
            
    public function deleteView($id)
    {
        $connect = Yii::app()->db_gamestore;
        $sql = "DELETE FROM vtc_game_store.g_game_view WHERE game_id = '$id'";
        $command =$connect->createCommand($sql);
        $result = $command->execute();
        echo $result;exit;
    }
    public function deleteId($id)
    {
        
        $connect = Yii::app()->db_gamestore;
        $sql = "DELETE FROM vtc_game_store.g_game_view WHERE id = '$id'";
        $command =$connect->createCommand($sql);
        $result = $command->execute();
        echo $result;exit;
    }

    public function getName($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game WHERE id ='$id'";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
    public function getviewnew($row_per_page,$page)
    {   
        
        $connect = Yii::app()->db_gamestore;
        $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game_view WHERE type_view = 2 ORDER BY order_view ";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        
        $first = ($page - 1)*$row_per_page;
        
        $connect = Yii::app()->db_gamestore;
        $sql = "SELECT 	* FROM  vtc_game_store.g_game_view WHERE type_view = 2 ORDER BY order_view ";
        $commad = $connect->createCommand($sql);
        $data = $commad->queryAll();
        
         return array($max_page,intval($data_count["count"]),$data);
    }
    
    public function getViewHot($row_per_page,$page)
    {
         $connect = Yii::app()->db_gamestore;
        $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game_view WHERE type_view = 1 ORDER BY order_view ";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        $first = ($page - 1)*$row_per_page;
        $connect = Yii::app()->db_gamestore;
        $sql = "SELECT * FROM  vtc_game_store.g_game_view WHERE type_view = 1 ORDER BY order_view ";
        $commad = $connect->createCommand($sql);
        $data = $commad->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }
    public function getGameMini($row_per_page,$page)
    {
         $connect = Yii::app()->db_gamestore;
        $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game_view WHERE type_view = 3 ORDER BY order_view ";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        
        $first = ($page - 1)*$row_per_page;
        $connect = Yii::app()->db_gamestore;
        $sql = "SELECT 	* FROM  vtc_game_store.g_game_view WHERE type_view = 3 ORDER BY order_view ";
        $commad = $connect->createCommand($sql);
        $data = $commad->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }
}