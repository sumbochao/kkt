<?php
    class AComic extends CActiveRecord{
        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        // goi den bang can ket noi   
        public function tableName() {                  
            return 'c_comic';
        }
        public function getDataSearch($from_date,$to_date,$categoryId,$keyword,$type,$status,$page,$row_per_page){
            $str_sql = "";
            $str_order=" ORDER BY id DESC ";
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
                $connect = Yii::app()->db;
                $sql="SELECT comic_id FROM c_category_comic WHERE cat_id = ".$categoryId ;
                $command = $connect->createCommand($sql);
                $data_id = $command->queryAll();
                $str_id="";
                foreach($data_id as $key =>$value){
                    $str_id.=",".$value['comic_id'];
                }
                $str_id=ltrim($str_id,",");
                $str_sql .= " AND id IN ( ".$str_id .") ";
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

            $connect = Yii::app()->db;
            $sql = "SELECT count(id) as count FROM c_comic WHERE 1 ".$str_sql."";
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM c_comic WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        public function getCheckCategory($id){
            $sql = "SELECT * FROM c_category_comic WHERE comic_id = ".intval($id);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $arr = $command->queryAll();
            foreach($arr as $key =>$value){
                $data[$value['cat_id']] = $value['cat_id'];
            }
            return $data;
        }
        public function getDataById($id){
            $sql = "SELECT * FROM c_comic WHERE id = ".intval($id);
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        public function insertCategory($id,$cat_id){
        $sql = "INSERT INTO c_category_comic(cat_id,comic_id) VALUES('".$cat_id."','".$id."')";
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }
    public function deleteCategory($id,$cat_id){
        $sql = "DELETE FROM c_category_comic WHERE cat_id = ".intval($cat_id)." AND comic_id =".$id;
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->execute();
        return $data;
    }
    }
?>
