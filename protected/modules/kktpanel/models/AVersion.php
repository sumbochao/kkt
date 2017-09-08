<?php
class AVersion extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_version';
    }
    public function getAllData(){
        $sql = "SELECT * FROM c_version ORDER BY id DESC";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    public function getDataById($id){
        $sql = "SELECT * FROM c_tips WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
}
