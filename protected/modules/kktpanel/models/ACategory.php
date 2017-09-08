<?php
class ACategory extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_category';
    }

    public function getDataSearch($type_cat,$keyword,$type,$status,$page,$row_per_page){
        $str_sql = "";
        $str_order = " ORDER BY id DESC";
        if(intval($type_cat) != 0){
            $str_sql .= " AND type = ".intval($type_cat);
        }
        if($keyword !="" && intval($type) >0){
            if($type == 1){
                $str_sql .= " AND id = ".intval($keyword);
            }
            if($type == 2){
                $str_sql .= " AND name LIKE '%".$keyword."%' "; 
            }
        }
        if(intval($status) != 2){
            $str_sql .= " AND status = ".intval($status);
        }
        $connect = Yii::app()->db;
        $sql = "SELECT count(id) as count FROM c_category WHERE 1 ".$str_sql."";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        $first = ($page - 1)*$row_per_page;

        $sql = "SELECT * FROM c_category WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }
    public function getAllData($type=0){
        $str_sql = "";
        if(intval($type) >0){
            $str_sql .= " AND type = ".intval($type);
        }
        $sql = "SELECT id,name FROM c_category WHERE 1 ".$str_sql."";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryAll();
        for($i=0;$i<count($rows);$i++){
           $data[$rows[$i]["id"]] = $rows[$i]["name"]; 
        }
        return isset($data) ? $data : array();
    }
    public function getDataById($id){
        $sql = "SELECT * FROM c_category WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
    public function getDataByNameAndType($name,$type){
        $sql = "SELECT * FROM c_category WHERE name = '".mysql_escape_string(trim($name))."' AND type = ".intval($type);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
}
