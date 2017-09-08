<?php
    class FInvittable extends CActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function deleteFriend($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.facebook_user_invittable WHERE account_id=$id";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function insertFriend($id,$friend,$fid,$name,$url)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "INSERT INTO vtc_adv_facebook.facebook_user_invittable(facebook_user_id,account_id,fid,NAME,url) VALUES('$friend',$id,'$fid','$name','$url') ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function countFriend($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(account_id) as count FROM vtc_adv_facebook.facebook_user_invittable WHERE account_id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
		
		 public function getAllFriend($id,$username,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC ";
            if($id != "")
            {
                $str_sql .= " AND account_id=$id "; 
            }
            $username = mysql_escape_string($username);
            if(!empty($username))
            {
                $str_sql .= " AND name like '%".$username."%'  ";
            }
            

            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(id) as count FROM vtc_adv_facebook.facebook_user_invittable WHERE 1 ".$str_sql;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_adv_facebook.facebook_user_invittable WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
           
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }

    }
?>
