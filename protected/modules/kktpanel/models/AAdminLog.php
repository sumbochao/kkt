<?php
class AAdminLog extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }

    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_admin_log';
    }
    public function getDataSearch($from_date,$to_date,$username,$keyword,$action,$object,$page,$row_per_page){
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
        if(trim($username) !=""){
            $str_sql .= " AND username LIKE '%".$username."%' ";
        }
        if($keyword !=""){
            $str_sql .= " AND content LIKE '%".$keyword."%' "; 
        }
        if(intval($action) >0){
            $str_sql .= " AND action = ".intval($action);
        }
        if(intval($object) >0){
            $str_sql .= " AND object = ".intval($object);
        }
        $connect = Yii::app()->db;
        $sql = "SELECT count(id) as count FROM c_admin_log WHERE 1 ".$str_sql."";
        $command = $connect->createCommand($sql);
        $data_count = $command->queryRow();
        $max_page = ceil(intval($data_count["count"])/$row_per_page);
        $first = ($page - 1)*$row_per_page;

        $sql = "SELECT * FROM c_admin_log WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return array($max_page,intval($data_count["count"]),$data);
    }
    public function insertAdminLog($action,$object,$content){  
        return 1;
        $user_id = isset(Yii::app()->user->id) ? intval(Yii::app()->user->id):0;
        $username = isset(Yii::app()->user->name) ? trim(Yii::app()->user->name):"";
        $content = $username . ' ' . $content;
        $data = array(
        "user_id"=>array("value"=>$user_id,"type"=>1),
        "username"=>array("value"=>$username,"type"=>2),
        "action"=>array("value"=>$action,"type"=>1),
        "object"=>array("value"=>$object,"type"=>1),
        "content"=>array("value"=>$content,"type"=>2),
        "create_date"=>array("value"=>time(),"type"=>1),
        );
        $table = "c_admin_log";
        $last_id = CommonDB::insertRow($table,$data);
        return $last_id;
    }
}
