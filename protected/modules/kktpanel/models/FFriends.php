<?php
    class FFriends extends CActiveRecord
    {

        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }

        public function getAllData($id,$page,$row_per_page,$keyword,$status)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC ";
            if($id != 0)
            {
                $str_sql .= " AND account_id=$id "; 
            }
            if($keyword != "")
            {
                $str_sql .= " AND name LIKE '%".$keyword."%' "; 
            }
            if($status != 2)
            {
                $str_sql .= " AND is_request=$status "; 
            }

            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(id) as count FROM vtc_adv_facebook.facebook_friends WHERE 1 ".$str_sql;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_adv_facebook.facebook_friends WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }

        public function insertFriend($id,$data)
        {
            $data = (string)$data;
            $data = trim($data);
            //$data = '100001362879008';
            //var_dump($data);die;
            $facebook = file_get_contents("http://graph.facebook.com/".$data);
            //$facebook = @file_get_contents('http://graph.facebook.com/100004403618667');
            //var_dump($facebook);die;
            $facebook = @json_decode($facebook);
            $facebook = @get_object_vars($facebook);
            if(!isset($facebook))
            {
                $sql = "";
                return 0;
            }
            else
            {
                $name = $facebook['name'];
                $name = str_replace("'","",$name);
                $str_sql = "($id,'$name','$data')";
                $connect = Yii::app()->db_facebook;
                $sql = "INSERT INTO vtc_adv_facebook.facebook_friends(account_id,name,friend_id) VALUES ".$str_sql;
                //var_dump($sql);
                $command = $connect->createCommand($sql);
                $result = $command->execute();
                return $name;
            }
        }

        public function getAllFriend($id,$page,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC ";
            if($id != "")
            {
                $str_sql .= " AND account_id=$id "; 
            }

            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(id) as count FROM vtc_adv_facebook.facebook_friends WHERE 1 ".$str_sql;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;

            $sql = "SELECT * FROM vtc_adv_facebook.facebook_friends WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }

        public function deleleFriend($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.facebook_friends WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }

        public function updateRequestFriend($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "UPDATE vtc_adv_facebook.facebook_friends SET is_request=1 WHERE id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }
        
        public function deleleAll($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.facebook_friends WHERE account_id=$id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $result = $command->execute();
            return $result;
        }

    } 
?>
