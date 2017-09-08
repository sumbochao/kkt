<?php
    class AWap2u extends CActiveRecord{
        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }
        // goi den bang can ket noi   
        public function tableName() {                  
            return 'c_album';
        }
        public function getCountId(){
            $sql = "SELECT count(id) as value FROM c_app_wap2u";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        public function getDataSearch($keyword,$page,$row_per_page){
            $str_sql = "";
            $str_order = " ORDER BY id DESC";
            if($keyword !=""){
                $str_sql .= " AND title LIKE ('%".$keyword."%')";
            }
            $connect = Yii::app()->db;
            $sql = "SELECT count(id) as count FROM c_app_wap2u WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            $sql = "SELECT * FROM c_app_wap2u WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            //echo $sql;die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        public function getDataById($id){
            $sql = "SELECT * FROM c_app_wap2u WHERE id = ".intval($id);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        public function updateOrderOtherApp($order_app){
            $sql = "UPDATE c_app_wap2u SET order_app = order_app+1  WHERE order_app >=".$order_app;
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        public function updateOrderApp($id,$order_app){
            $sql = "UPDATE c_app_wap2u SET order_app = ".$order_app."  WHERE id =".$id;
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
    }  
?>
