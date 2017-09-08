<?php
class CommonDB{
    static public $arr_type = array(
    1 => PDO::PARAM_INT,   //kieu int
    2 => PDO::PARAM_STR,   //kieu string
    ); 

    //get cache query
    static public function getCache($key){
        $cache = false;
        if (($cache = Yii::app ()->cache) !== null) { 
            $cache = Yii::app ()->cache->get ( $key );
        }
        return $cache;
    } 
    //set cache query  
    static public function setCache($key,$rows,$time,$dependency){
        $cache_flag = true;
        if ($cache_flag==true) {
            Yii::app ()->cache->set ( $key, $rows,$time, new CGlobalStateCacheDependency($dependency));
        }
    }

    /*static public function setCacheQuery($func,$params,$key,$time,$dependency){
    $rows = array();
    $cache_flag = false;
    if (($cache = Yii::app ()->cache) !== null) { 
    $cache = Yii::app ()->cache->get ( $key );
    $cache_flag = true;
    }
    if($cache == false){   
    $rows = call_user_func_array($func,$params);  
    if ($cache_flag==true) {
    Yii::app ()->cache->set ( $key, $rows,$time, new CGlobalStateCacheDependency($dependency));
    }  
    }else{
    $rows = $cache;
    }
    return $rows;
    }*/

    static public function insertRow($table,$arr_params){
        $arr_type = CommonDB::$arr_type;
        $field = "";
        $field_value = "";
        foreach($arr_params as $key=>$value){
            $field .= $key.",";
            $field_value .= ":".$key.",";
        }
        $field = rtrim($field,",");
        $field_value = rtrim($field_value,",");
        $sql = "INSERT INTO ".$table."(".$field.") VALUES (".$field_value.")";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        foreach($arr_params as $key=>$value){
            $command->bindValue(":".$key,$value["value"],$arr_type[$value["type"]]);
        } 
        $result = $command->execute();
        $last_id = Yii::app()->db->getLastInsertId();
        return $last_id;
    }
    static public function insertManyRows($table,$arr_key,$arr_values){   
        $arr_val = array();
        $field = "";
        $values = "";
        for($i=0;$i<count($arr_key);$i++){
            $field .= $arr_key[$i].",";
        }    
        $field = rtrim($field,",");
        for($i=0;$i<count($arr_values);$i++){
            $arr_val[$i] = "";
            foreach($arr_values[$i] as $value){
                $arr_val[$i] .= "'".(mysql_escape_string($value))."',";
            }
            $arr_val[$i] = rtrim($arr_val[$i],",");
            $arr_val[$i] = "(".$arr_val[$i].")";
        }
        $values = implode(",",$arr_val);
        if($values !=""){
            $sql = "INSERT INTO ".$table."(".$field.") VALUES ".$values;
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }else{
            return -1;
        }

    }
    static public function updateRow($table,$arr_params,$arr_key_field){
        $arr_type = CommonDB::$arr_type;
        $field = "";
        $field_where = "";
        foreach($arr_params as $key=>$value){
            if(!in_array($key,$arr_key_field)){
                $field .= $key . "= :" . $key . ",";
            }else{
                $field_where .= " AND ". $key . "= :" . $key;
            }
        }
        $field = rtrim($field,",");
        $field_where = rtrim($field_where,"AND");
        $sql = "UPDATE ".$table." SET ".$field." WHERE 1 ".$field_where;
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        foreach($arr_params as $key=>$value){
            $command->bindValue(":".$key,$value["value"],$arr_type[$value["type"]]);
        } 
        $result = $command->execute();
        return $result;
    }

    static public function deleteRow($table,$arr_params){
        $params = "";
        foreach($arr_params as $key=>$value){
            $params .= " AND ".$key." = '".$value."' ";
        }
        if($params !=""){
            $sql ="DELETE FROM ".$table." WHERE 1 ".$params;
            //echo $sql;die;
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }else{
            return 0;
        }
    }

    static public function deleteManyRows($table,$key,$arr_value){
        $values = implode(",",$arr_value);
        if($values !=""){
            $sql = "DELETE FROM ".$table." WHERE ".$key." IN (".$values.")";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }else{
            return -1;
        }
    }
}
