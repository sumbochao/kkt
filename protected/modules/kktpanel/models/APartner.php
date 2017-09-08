<?php
class APartner extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_partner';
    }
    
    public function getDataById($id){
        $sql = "SELECT * FROM c_partner WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }

    public function getAllPartner(){
        $sql = "SELECT * FROM c_partner ORDER BY id DESC";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();   
        return $data;
    }
    public function getArrNamePartner(){
        $sql = "SELECT * FROM c_partner ORDER BY id DESC";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll(); 
        for($i=0;$i<count($data);$i++){
            $rows[$data[$i]["id"]] = $data[$i]["name"];
        }  
        return isset($rows) ? $rows:array();
    }
    
    
}
