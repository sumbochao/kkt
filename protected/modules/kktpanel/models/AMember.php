<?php
class AMember extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_user';
    }

    public function getAllData(){
        $sql = "SELECT id,username FROM c_user";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }
    public function getDataById($id){
        $sql = "SELECT id,username FROM c_user WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }

    public function getDataSearch($from_date,$to_date,$keyword,$type,$status,$isBan,$page,$row_per_page){
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
        if($keyword !="" && intval($type) >0){
            if($type == 1){
                $str_sql .= " AND id = ".intval($keyword);
            }
            if($type == 2){
                $str_sql .= " AND username LIKE '%".$keyword."%' "; 
            }
        }
        if(intval($status) != 2){
            $str_sql .= " AND status = ".intval($status);
        }
        if(intval($isBan) != 2){
            $str_sql .= " AND isBan = ".intval($isBan);
        }
        $connect = Yii::app()->db;
        $sql = "SELECT count(id) as count FROM c_user WHERE 1 ".$str_sql."";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        $first = ($page - 1)*$row_per_page;
        $sql = "SELECT * FROM c_user WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }

    public function deleteUserForumByUsername($username){
        $sql = "DELETE FROM users WHERE name_lat = '".trim($username)."'";
        $connect = Yii::app()->db_forum; 
        $command = $connect->createCommand($sql);
        $result = $command->execute();
        return $result;
    }
    public function getAllUserByrefUID($refUID){
        $sql = "SELECT id FROM c_user WHERE refUID = ".intval($refUID);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        $rows = array();
        foreach($data as $key=>$value){
            $rows[] = $value["id"];
        }
        return $rows;
    }
}