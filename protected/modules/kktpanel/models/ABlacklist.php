<?php
class ABlacklist extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_blacklist';
    }
    public function getAllData(){
        $sql = "SELECT * FROM c_blacklist ORDER BY id DESC";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    public function getDataById($id){
        $sql = "SELECT * FROM c_blacklist WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
}
