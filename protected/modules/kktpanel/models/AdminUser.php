<?php

/**
* This is the model class for table "tbl_user".
*/
class AdminUser extends CActiveRecord
{

    /**
    * Returns the static model of the specified AR class.
    * @return User the static model class
    */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
    * @return string the associated database table name
    */
    public function tableName()
    {
        return 'c_admin';
    }

    public function getDataSearch($username,$status){
        $str_sql = "";
        if($username !=""){
            $str_sql .= " AND username LIKE '%".trim($username)."%'";
        }
        if($status !=""){
            $str_sql .= " AND status = '".trim($status)."'";
        }
        $sql = "SELECT * FROM c_admin WHERE 1 ".$str_sql." ORDER BY id DESC";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    
    public function getDataById($id){
        $sql = "SELECT * FROM c_admin WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
    
    public function getDataByUsername($username){
        $sql = "SELECT * FROM c_admin WHERE username = '".trim($username)."'";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
    
    public function getDataPermitByAdmin($adminId){
        $sql = "SELECT module,permisId FROM c_authassignment WHERE adminId = ".intval($adminId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        for($i=0;$i<count($rows);$i++){
            $data[$rows[$i]["module"]] = $rows[$i]["permisId"];
        }
        return isset($data) ? $data:array();
    }
    
    public function getDataByAdminModulePermit($adminId,$module,$permisId){
        $sql = "SELECT * FROM c_authassignment 
        WHERE 
        adminId = ".intval($adminId)." AND module = ".intval($module)." 
        AND permisId & ".intval($permisId)." = ".intval($permisId)."";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data; 
    }
}
