<?php
class AImage extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_image';
    }
    public function getDataByAlbum($albumId){
        $sql = "SELECT * FROM c_image WHERE albumId = ".intval($albumId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
}