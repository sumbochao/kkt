<?php
class User extends CActiveRecord
{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }
    
    public function tableName() {                  
        return 'c_user';
    }
    
    public function checkUsername($username)
    {
        $sql = "SELECT count(id) FROM c_user WHERE username='" . mysql_escape_string($username) . "'";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows["count(id)"];
    }
    
    public function checkEmail($email)
    {
        $sql = "SELECT count(id) FROM c_user WHERE email='" . mysql_escape_string($email) . "'";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows["count(id)"];
    }
    
    public function InsertUsername($data)
    {
        $sql = "INSERT INTO c_user SET 
            username=:username
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
    
    public function getUserByKeyPassword($email, $key_active)
    {
        $sql = "SELECT id, username FROM c_user WHERE `email`='" . mysql_escape_string($email) . "' AND `key_active_password`='" . mysql_escape_string($key_active) . "'";
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
        return $result;
    }
    
    public function getUser($data)
    {
        $sql = "SELECT id, username, email, active, isBan FROM c_user WHERE `username`='" . mysql_escape_string($data["username"]) . "' AND `password`='" . mysql_escape_string($data["password"]) . "'";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    public function getUserByRefCode($refCode){
        $sql = "SELECT * FROM c_user WHERE refCode= '".mysql_escape_string($refCode)."'";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    
    public function getUserInfo($userId)
    {
        $sql = "SELECT 
            id,refCode
            , full_name
            , mobile
            , gender
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
            , avatar_url
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
        return $result;
    }
    
    public function checkPass($userId, $password)
    {        
        $sql = "SELECT id, email FROM c_user WHERE id=" . $userId . " AND password='" . $password . "'";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    
    public function changePassword($userId, $password)
    {
        $sql = "UPDATE c_user SET password=:password, key_active_password=:key_active_password WHERE id=:id";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValue(":password", $password, PDO::PARAM_STR);
        $command->bindValue(":key_active_password", null, PDO::PARAM_STR);
        $command->bindValue(":id", $userId, PDO::PARAM_STR);
        $result = $command->execute();
        return $result;    
    }
    
    public function getLastestGame()
    {
        $sql = "SELECT id, title, alias FROM c_game ORDER BY create_date DESC LIMIT 1";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        
        return $rows;
    }
    public function getDataGameOnline(){
        $sql = "SELECT id,title,alias,picture,percent_partner,create_date,download FROM c_game WHERE isOnline = 1 ORDER BY id DESC";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();       
        return $rows;
    }
    
    public function getListApp()
    {
        $sql = "SELECT * FROM c_app ORDER BY type";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;   
    }
    
    public function getAllApp(){
        $data = array();
        $sql = "SELECT * FROM c_app ORDER BY id DESC";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $key=>$value){
             $data[$value["app_value"]] = $value["title"];
        }        
        return $data;
    }
    
    public function getInfoApp($appId)
    {
        $sql = "SELECT * FROM c_app WHERE id=" . $appId;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows;   
    }
    
    public function getInfoAppByType($type)
    {
        $sql = "SELECT * FROM c_app WHERE type=" . $type;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows;   
    }
    
    public function getInfoMyAdv($advId)
    {
        $sql = "SELECT * FROM c_my_adv WHERE id=" . $advId;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows;   
    }
    
    public function UpdateDownloadApp($appId)
    {
        $sql = "UPDATE c_app SET download=(download+1) WHERE id=" . $appId;
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->execute();        
        return $result;   
    }
    
    public function InsertShare($data)
    {
        $sql = "INSERT INTO c_share SET 
            userId=:userId
            , username=:username
            , content=:content
            , create_date=:create_date
        ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValues($data);
        $result = $command->execute();
        return $result;
    }
    
    public function getShare()
    {
        $sql = "SELECT * FROM c_share ORDER BY create_date DESC LIMIT 16";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;
    }
    
    public function InsertChat($data)
    {
        $sql = "INSERT INTO c_chat SET 
            userId=:userId
            , username=:username
            , content=:content
            , create_date=:create_date
        ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValues($data);
        $result = $command->execute();
        return $result;
    }
    
    public function getChat()
    {
        $sql = "SELECT * FROM c_chat ORDER BY create_date DESC LIMIT 16";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;
    }
    
    public function InsertMyAdv($data)
    {
        $sql = "INSERT INTO c_my_adv SET 
            userId=:userId
            , username=:username
            , type=:type
            , title=:title
            , alias=:alias
            , picture=:picture            
            , create_date=:create_date
        ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValues($data);
        $result = $command->execute();
        $id = Yii::app()->db->getLastInsertID();
        
        return $id;
    }
    
    public function getListAdv($userId)
    {
        $sql = "SELECT * FROM c_my_adv WHERE userId=" . $userId;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;
    }
    
    public function getTotalUser()
    {
        $sql = "SELECT count(id) FROM c_user";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows["count(id)"];    
    }    
    
    public function getTips()
    {
        $sql = "SELECT title, url FROM c_tips ORDER BY create_date DESC LIMIT 5";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;      
    }
    
    public function getTopUser()
    {
        $sql = "SELECT count(id) as total_sms, userId FROM c_sms_log WHERE month=" . date("m") . " GROUP BY userId order by total_sms DESC";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        
        $list_user_id = "0";
        foreach($rows as $row){
            $list_user_id .= "," . $row["userId"];
        }
                
        $sql = "SELECT id, username,avatar_url FROM c_user WHERE id IN (" . $list_user_id . ") AND isBan=0";
        $command = Yii::app()->db->createCommand($sql);
        $rowsUser = $command->queryAll();
        $replaceUser = array();
        foreach($rowsUser as $row){
            $replaceUser[$row["id"]]["username"] = $row["username"];
            $replaceUser[$row["id"]]["avatar_url"] = $row["avatar_url"];
        }
        
        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["username"] = isset($replaceUser[$rows[$i]["userId"]]["username"]) ? $replaceUser[$rows[$i]["userId"]]["username"] : "";
            $rows[$i]["avatar_url"] = isset($replaceUser[$rows[$i]["userId"]]["avatar_url"]) ? $replaceUser[$rows[$i]["userId"]]["avatar_url"] : "";
            $i++;
        }
        
        return $rows;        
    }
    
    public function getMyAdv($id)
    {
        $sql = "SELECT * FROM c_my_adv WHERE id=" . $id;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        
        return $rows;
    }
    
    public function UpdateDownloadMyAdv($myAdvId)
    {
        $sql = "UPDATE c_my_adv SET download=(download+1) WHERE id=" . $myAdvId;
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->execute();        
        return $result;   
    }
    
    public function UpdateKeyActivePassword($email, $key_active_password)
    {
        $sql = "UPDATE c_user SET `key_active_password`='" . $key_active_password . "' WHERE `email`='" . $email . "'";
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->execute();        
        return $result;
    }
    
    public function deleteMyAdv($id)
    {
        $sql = "DELETE FROM c_my_adv WHERE id=" . $id;
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->execute();        
        return $result;
    }
    
    public function getBoxAdv()
    {
        $sql = "SELECT title, picture, link, create_date FROM c_box_adv WHERE status=1 ORDER BY create_date DESC";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;   
    }
    public function getDataByMobileAndCode($mobile,$code){
        $sql = "SELECT * FROM c_kickhoat WHERE mobile= '".$mobile."' AND code = '".$code."' AND is_active=0";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows;
    }
    
    public function updateStatusMobileAndCode($mobile,$code){
        $sql = "UPDATE c_kickhoat SET is_active = 1 WHERE mobile= '".$mobile."' AND code = '".$code."'";
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->execute();        
        return $result;
    }
    public function getTotalShare($dataId=0,$type=0)
    {
        $sql = "SELECT count(id) FROM c_share WHERE dataId = ".intval($dataId)." AND type=".intval($type)."";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        return $rows["count(id)"];
    }
}  
?>
