<?php
class AGameFileMobileHandset extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }
    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_game_file_mobile_handset';
    }
    public function getDataByArrGameFile($arr_game_file){
        $str_file = implode(",",$arr_game_file);                                              
        if($str_file !=""){
            $sql = "SELECT gm.gameFileId,gm.mobileHandsetId,mh.manufacturer,mh.handset FROM c_game_file_mobile_handset as gm 
            INNER JOIN c_mobile_handset as mh ON gm.mobileHandsetId = mh.id 
            WHERE gm.gameFileId IN (".$str_file.")";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }else{
            return array();
        }
    }
    public function getDataByGameFile($gameFileId){
        $sql = "SELECT gameFileId,mobileHandsetId FROM c_game_file_mobile_handset WHERE gameFileId = ".intval($gameFileId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    public function getDataByFileAndHandset($gameFileId,$mobileHandsetId){
        $sql = "SELECT * FROM c_game_file_mobile_handset 
        WHERE gameFileId = ".intval($gameFileId)." AND mobileHandsetId = ".intval($mobileHandsetId)."";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
    public function insertData($gameFileId,$mobileHandsetId){
        $sql = "INSERT INTO c_game_file_mobile_handset(`gameFileId`,`mobileHandsetId`) VALUES (".intval($gameFileId).",".intval($mobileHandsetId).")";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $result = $command->execute();
        $last_id = Yii::app()->db->getLastInsertId();
        return $last_id;
    }
}
