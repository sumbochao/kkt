<?php
    class Login extends CActiveRecord
    {
        public static function model($className = __CLASS__) {
            return parent::model ( $className );
        }

        public function tableName() {                  
            return 'c_user';
        }

        public function getUser($data)
        {
            $sql = "SELECT id, username, email, active, isBan FROM c_user WHERE `username`='" . mysql_escape_string($data["username"]) . "' AND `password`='" . mysql_escape_string($data["password"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }

        public function checkUsername($username)
        {
            $sql = "SELECT count(id) FROM c_user WHERE username='" . mysql_escape_string($username) . "'";    
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows["count(id)"];
        }

        public function getBlacklist()
        {
            $sql = "SELECT keyword_register FROM c_blacklist";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryAll();            
            $pattern = "";
            if(!empty($rows)){
                $pattern .= "/";            
                foreach($rows as $row){
                    $pattern .= $row["keyword_register"] . "|"; 
                }
                $pattern = rtrim($pattern, "|");
                $pattern .= "/si";    
            }

            return $pattern;
        }

        public function checkEmail($email)
        {
            $sql = "SELECT count(id) FROM c_user WHERE email='" . mysql_escape_string($email) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows["count(id)"];
        }

        public function checkMobile($mobile)
        {
            $sql = "SELECT count(id) FROM c_user WHERE mobile='" . mysql_escape_string($mobile) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows["count(id)"];
        }

        public function InsertUsername($data, $password_forum)
        {
            $sql = "INSERT INTO c_user SET 
            username=:username
            , refUID=:refUID
            , password=:password
            , email=:email
            , mobile=:mobile
            , active=:active
            , create_date=:create_date
            , key_active=:key_active
            ";

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValues($data);
            $result = $command->execute();

            if($result >=0 ){
                $userId = Yii::app()->db->getLastInsertID();
                $refCode = Common::genRefCode($userId);

                $sql = "UPDATE c_user SET refCode=:refCode WHERE id=:id";
                $command = Yii::app()->db->createCommand($sql);
                $command->bindValue(":refCode", $refCode, PDO::PARAM_STR);
                $command->bindValue(":id", $userId, PDO::PARAM_INT);
                $result = $command->execute();

                /* insert build game */
                $sql = "SELECT id FROM c_game WHERE isOnline=1";
                $command = Yii::app()->db->createCommand($sql);
                $rows = $command->queryAll();

                $sql = "INSERT INTO c_build_game SET userId=:userId, gameId=:gameId";
                $command = Yii::app()->db->createCommand($sql);
                foreach($rows as $row){
                    $command->bindValue(":userId", $userId, PDO::PARAM_INT);       
                    $command->bindValue(":gameId", $row["id"], PDO::PARAM_INT);       
                    $command->execute();
                }

                /* Insert db dien dan */
                $sql = "INSERT INTO users SET 
                id=:id
                , name=:name
                , name_lat=:name_lat
                , password=:password
                , mail=:mail
                , preg=:preg
                ";
                $command = Yii::app()->db_forum->createCommand($sql);
                $command->bindValue(":id", $userId, PDO::PARAM_STR);
                $command->bindValue(":name", $data["username"], PDO::PARAM_STR);
                $command->bindValue(":name_lat", $data["username"], PDO::PARAM_STR);
                $command->bindValue(":password", $password_forum, PDO::PARAM_STR);
                $command->bindValue(":mail", $data["email"], PDO::PARAM_STR);
                $command->bindValue(":preg", 0, PDO::PARAM_STR);
                $result = $command->execute();            
            }
            return $result;
        }

        public function getUserByKey($email, $key_active)
        {
            $sql = "SELECT id, username FROM c_user WHERE `email`='" . mysql_escape_string($email) . "' AND `key_active`='" . mysql_escape_string($key_active) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            return $rows;        
        }

        public function activeUser($userId){
            $sql = "UPDATE c_user SET 
            active=:active
            , key_active=:key_active
            WHERE id=:id
            ";

            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(":active", 1, PDO::PARAM_INT);
            $command->bindValue(":key_active", null, PDO::PARAM_STR);
            $command->bindValue(":id", $userId, PDO::PARAM_INT);
            $result = $command->execute();

            if($result >= 0){
                /* active db dien dan */
                $sql = "UPDATE users SET preg=:preg WHERE id=:id";
                $command = Yii::app()->db_forum->createCommand($sql);
                $command->bindValue(":preg", 1, PDO::PARAM_STR);            
                $command->bindValue(":id", $userId, PDO::PARAM_STR);
                $result = $command->execute(); 
            }
            return $result;
        }

        public function checkPass($userId, $password)
        {        
            $sql = "SELECT id, email FROM c_user WHERE id=" . $userId . " AND password='" . $password . "'";        
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }

        public function changePassword($userId, $password, $password_forum)
        {
            $sql = "UPDATE c_user SET password=:password, key_active_password=:key_active_password WHERE id=:id";
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValue(":password", $password, PDO::PARAM_STR);
            $command->bindValue(":key_active_password", null, PDO::PARAM_STR);
            $command->bindValue(":id", $userId, PDO::PARAM_STR);
            $result = $command->execute();
            if($result >= 0){
                /* change pass db dien dan */
                $sql = "UPDATE users SET password=:password WHERE id=:id";
                $command = Yii::app()->db_forum->createCommand($sql);
                $command->bindValue(":password", $password_forum, PDO::PARAM_STR);            
                $command->bindValue(":id", $userId, PDO::PARAM_STR);
                $result = $command->execute(); 
            }
            return $result;
            return $result;    
        }

        public function getUserInfo($userId)
        {
            $sql = "SELECT 
            id
            , full_name
            , mobile
            , gender
            , birthday            
            , address
            , permanent_address
            , identity_number
            , date_of_identity
            , which_of_identity
            , account_owner
            , account_number
            , account_bank
            , account_branch
            , personal_tax_code
            FROM c_user
            WHERE id=" . $userId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();
            return $rows;
        }

        public function updateInfo($data)
        {
            $sql = "UPDATE c_user SET 
            full_name=:full_name
            , mobile=:mobile
            , gender=:gender
            , birthday=:birthday
            , day_birthday=:day_birthday
            , address=:address
            , permanent_address=:permanent_address
            , identity_number=:identity_number
            , date_of_identity=:date_of_identity
            , which_of_identity=:which_of_identity
            , account_owner=:account_owner
            , account_number=:account_number
            , account_bank=:account_bank
            , account_branch=:account_branch
            , personal_tax_code=:personal_tax_code
            WHERE id=:id
            ";
            $command = Yii::app()->db->createCommand($sql);
            $command->bindValues($data);
            $result = $command->execute();

            if($result >= 0){
                /* update db dien dan */
                $sql = "UPDATE users SET 
                imname=:imname
                , sex=:sex
                , mibile=:mibile
                , dayb=:dayb
                , monthb=:monthb
                , yearofbirth=:yearofbirth
                WHERE id=:id
                ";

                $dayb = !empty($data["birthday"]) ? date("d", $data["birthday"]) : "";
                $monthb = !empty($data["birthday"]) ? date("m", $data["birthday"]) : "";
                $yearofbirth = !empty($data["birthday"]) ? date("Y", $data["birthday"]) : "";

                $command = Yii::app()->db_forum->createCommand($sql);
                $command->bindValue(":id", $data["id"], PDO::PARAM_STR);
                $command->bindValue(":imname", $data["full_name"], PDO::PARAM_STR);
                $command->bindValue(":sex", $data["gender"], PDO::PARAM_STR);
                $command->bindValue(":mibile", $data["mobile"], PDO::PARAM_STR);
                $command->bindValue(":dayb", $dayb, PDO::PARAM_STR);
                $command->bindValue(":monthb", $monthb, PDO::PARAM_STR);
                $command->bindValue(":yearofbirth", $yearofbirth, PDO::PARAM_STR);
                $result = $command->execute();    
            }

            return $result;
        }

        public function UpdateKeyActivePassword($email, $key_active_password)
        {
            $sql = "UPDATE c_user SET `key_active_password`='" . $key_active_password . "' WHERE `email`='" . $email . "'";
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();        
            return $result;
        }

        public function getUserByKeyPassword($email, $key_active)
        {
            $sql = "SELECT id, username FROM c_user WHERE `email`='" . mysql_escape_string($email) . "' AND `key_active_password`='" . mysql_escape_string($key_active) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            return $rows;        
        }

        public function setSessionForum($username,$pass_no_md5){
            $sql = "SELECT * FROM users WHERE name_lat = '".trim($username)."'";
            $command = Yii::app()->db_forum->createCommand($sql);
            $rows = $command->queryRow();
            if($rows){
                $_SESSION['uid'] = intval($rows["id"]);
                $_SESSION['ups'] = md5(md5($pass_no_md5));
            }
            /*$pass_no_md5 = "minh123";
            $_SESSION['uid'] = $row["id"];
            $_SESSION['ups'] = md5(md5($pass_no_md5));*/
        }
    }
?>
