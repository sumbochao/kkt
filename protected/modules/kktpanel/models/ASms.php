<?php
    class ASms extends CActiveRecord
    {

        public static function insertSms($category,$status,$ishot,$description,$create_user,$time_now)
        {
            $connect = Yii::app()->db;
            $sql = "INSERT INTO c_smskute(cate_id,status,isHot,description,create_user,create_date) VALUES('$category','$status','$ishot','$description','$create_user','$time_now') ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->execute();
            return $row;
        }

        public static function getSms()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM c_smskute ORDER BY id DESC";
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->queryAll();
            return $row;
        }

        public static function getSmsId($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM c_smskute WHERE id='$id' ";
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->queryAll();
            return $row;
        }

        public static function updateSms($category,$status,$hot,$description,$id)
        {
            $connect = Yii::app()->db;
            $sql = "UPDATE c_smskute SET cate_id=$category,status=$status,isHot=$hot, description='$description' WHERE id=$id ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->execute();
            return $row;
        }

        public static function deleteSms($id)
        {
            $connect = Yii::app()->db;
            $sql = "DELETE FROM c_smskute WHERE id=$id ";
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->execute();
            return $row;
        }

        public static function quickSms($status,$hot,$id)
        {
            $connect = Yii::app()->db;
            $sql = "UPDATE c_smskute SET status=$status, isHot=$hot WHERE id=$id ";
            //var_dump($sql);die;
            $command = Yii::app()->db->createCommand($sql);
            $row = $command->execute();
            return $row;
        } 

        public static function searchSms($category,$page,$row_per_page)
        {
            $first = ($page - 1)*$row_per_page;
            $str_sql = "";
            
            if(intval($category) > 0)
            {
                $str_sql .= " AND cate_id = ".intval($category);
            }
            
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM c_smskute WHERE 1 ".$str_sql."";
            $command = Yii::app()->db->createCommand($sql);
            $sql1 = "SELECT COUNT(id) FROM c_smskute WHERE 1 ".$str_sql."";
            
            $data_count = $command->execute();
            //var_dump($sql1);
            
            $max_page = ceil(intval($data_count)/$row_per_page);
            
            $sql = "SELECT * FROM c_smskute WHERE 1 ".$str_sql." ORDER BY id DESC LIMIT ".$first.",".$row_per_page." ";
            
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            //var_dump($sql);
            return array($max_page,$data_count,$data);
            

        }


    }
?>
