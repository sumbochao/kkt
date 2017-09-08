<?php
class AAlbum extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_album';
    }
    public function getDataByCat($categoryId){
        $sql = "SELECT * FROM c_album WHERE categoryId = ".intval($categoryId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    
    public function getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$isHot,$page,$row_per_page){
        $str_sql = "";
        $str_order = " ORDER BY id DESC";
        if (intval(strtotime($from_date)) >0) {
            $arr_date = explode("-",$from_date);
            $from_date = mktime(0,0,0,$arr_date[1],$arr_date[0],$arr_date[2]);
            $str_sql .= ' AND create_date >= ' . $from_date;
        }
        if (intval(strtotime($to_date)) >0) {
            $arr_date = explode("-",$to_date);
            $to_date = mktime(23,59,59,$arr_date[1],$arr_date[0],$arr_date[2]);
            $str_sql .= ' AND create_date <= ' . $to_date;
        }
        if(intval($categoryId) > 0){
            $str_sql .= " AND categoryId = ".intval($categoryId);
        }
        if($keyword !="" && intval($type) >0){
            if($type == 1){
                $str_sql .= " AND id = ".intval($keyword);
            }
            if($type == 2){
                $str_sql .= " AND title LIKE '%".$keyword."%' "; 
            }
        }
        if(intval($status) != 2){
            $str_sql .= " AND status = ".intval($status);
        }
        if(intval($isHot) != 2){
            $str_sql .= " AND is_hot = ".intval($isHot);
        }
        $connect = Yii::app()->db;
        $sql = "SELECT count(id) as count FROM c_album WHERE 1 ".$str_sql."";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        $first = ($page - 1)*$row_per_page;
        $sql = "SELECT * FROM c_album WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }
    
    public function getDataById($id){
        $sql = "SELECT * FROM c_album WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }
}
