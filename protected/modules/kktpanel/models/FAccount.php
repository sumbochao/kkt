<?php
    class FAccount extends CActiveRecord 
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllData($page,$row_per_page,$keyword,$status)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC ";
            if($keyword != "")
            {
                $str_sql .= " AND username LIKE '%".$keyword."%' "; 
            }
            //echo $str_sql;die;
           
             if($status <> -1){
                 $str_sql .= " AND status =   ".$status;
            }
            
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(id) as count FROM vtc_adv_facebook.facebook_account WHERE 1 ".$str_sql;
           
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_adv_facebook.facebook_account WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
           
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
            
        }
        
        public function insertAccount($username,$password,$link,$note,$status)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "INSERT INTO vtc_adv_facebook.facebook_account(username,password,link,note,birthday,mobile,status) VALUES ('$username','$password','$link','$note','$birthday','$mobile','$status')";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getAccountById($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT * FROM vtc_adv_facebook.facebook_account WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function updateAccount($id,$username,$password,$link,$note,$birthday,$mobile,$status)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "UPDATE vtc_adv_facebook.facebook_account SET username='$username',password='$password',link='$link',note='$note',status=$status,birthday='$birthday',mobile='$mobile' WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
         public function updateCountFriend($id,$count_friend)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "UPDATE vtc_adv_facebook.facebook_account SET count_friend='$count_friend' WHERE id=$id ";
            
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
         public function updateBirthday($id,$birthday)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "UPDATE vtc_adv_facebook.facebook_account SET birthday='$birthday' WHERE id=$id ";
            
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteAccount($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.facebook_account WHERE id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getIdByEmail($email)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT id FROM vtc_adv_facebook.facebook_account WHERE username='$email' ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getDataByEmail($email)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT * FROM vtc_adv_facebook.facebook_account WHERE username='$email' ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        
        
    }
?>
