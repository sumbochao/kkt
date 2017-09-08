<?php
class AMobileHandset extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_mobile_handset';
    }

    public function getAllData($type = 0){
        $cache = false;
        $cache = Yii::app()->cache;
        if($cache != null){
            $cacheService = new CacheService("AMobileHandset","getAllData",$type);
            $key = $cacheService->createKey();
            $dependency = $cacheService->createDependency();
            $cache = Yii::app ()->cache->get ( $key ); 
        }
        if($cache == false){
            $sql = "SELECT * FROM c_mobile_handset";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $rows = $command->queryAll();
            if($type ==0){
                for($i=0;$i<count($rows);$i++){
                    $data[$rows[$i]["id"]] =  $rows[$i];
                }
            }elseif($type == 1){
                for($i=0;$i<count($rows);$i++){
                    $data[$rows[$i]["manufacturer"].' '.$rows[$i]["handset"]] = $rows[$i]["id"];
                }
            }elseif($type == 2){
                for($i=0;$i<count($rows);$i++){
                    $data[$rows[$i]["id"]] = $rows[$i]["manufacturer"].' '.$rows[$i]["handset"];
                }
            }
            Yii::app ()->cache->set ( $key,$data); 
        }else{
            $data = $cache;
        }
        return isset($data) ? $data : array();
    }
    public function getDataGroupManufacturer(){
        $cache = false;
        $cache = Yii::app()->cache;
        if($cache != null){
            $cacheService = new CacheService("AMobileHandset","getDataGroupManufacturer");
            $key = $cacheService->createKey();
            $dependency = $cacheService->createDependency();
            $cache = Yii::app ()->cache->get ( $key ); 
        }
        if($cache == false){
            $sql = "SELECT * FROM c_mobile_handset GROUP BY manufacturer";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            Yii::app ()->cache->set ( $key,$data);
        }else{
            $data = $cache;
        }
        return $data;
    }

    public function getDataByManufacturerAndKeyword($manufacturer,$keyword){
        $sql = "SELECT * FROM c_mobile_handset WHERE manufacturer = '".trim($manufacturer)."' AND handset LIKE '%".trim($keyword)."%'";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;
    }
}
