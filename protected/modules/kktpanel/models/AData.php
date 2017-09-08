<?php
class AData extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_data';
    }


    public function updateStatusByDataId($dataId,$status){
        $sql = "UPDATE c_data SET status = ".intval($status)." WHERE dataId = ".intval($dataId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $result = $command->execute();
        return $result;
    }
    public function updateCategoryByDataId($dataId,$categoryId){
        $data_cat = ACategory::getDataById($categoryId);
        if($data_cat){
            $sql = "UPDATE c_data SET categoryId = ".intval($data_cat["id"]).",
            type = ".intval($data_cat["type"]).",update_date = ".time()." 
            WHERE id = ".intval($dataId);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }else{
            return 0;
        }
    }
}
