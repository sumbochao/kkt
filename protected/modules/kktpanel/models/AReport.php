<?php
class AReport extends CActiveRecord
{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }

    public function tableName() {                  
        return array("c_sms_log", "c_sms_log_hdc");
    }
    
    public function GetUserExport($search, $currentPage, $numberRecordPerPage)
    {
        $condition_sms = "";        
        $condition_sms .= "userId!=0 AND userId!=''";
        $condition_sms .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition_sms .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition_sms .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition_sms .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        $condition_card = "";        
        $condition_card .= "userId!=0 AND userId!=''";
        $condition_card .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition_card .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition_card .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";        
        
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        if($search["start"]!="" && $search["end"]!=""){
            $startRecord = intval($search["start"]);            
            $numberRecordPerPage = intval($search["end"]) - intval($search["start"]) + 1;
        } 
        
        if(!empty($search["username"])){
            $sql = "SELECT id FROM c_user WHERE username='" . mysql_escape_string($search["username"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();    
            
            $condition .= empty($rows) ? " AND userId=0" : " AND userId=" . $rows["id"];
        }
        
        /* Tiêu chí sắp xếp mặc định */      
        $sql = "SELECT userId FROM (SELECT DISTINCT userId FROM c_sms_log WHERE " . $condition_sms . " UNION SELECT DISTINCT userId FROM c_sms_game_log WHERE " . $condition_sms . " UNION SELECT DISTINCT userId FROM c_card_game_log WHERE " . $condition_card . ") temp LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        
        if($search["order"]=="1") {
            /* Sắp xếp theo doanh thu từ thấp đến cao */
            $sql = "SELECT userId, sum(total) as total_price FROM (SELECT userId, sum(price) as total FROM c_sms_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, sum(price) as total FROM c_sms_game_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, sum(price) as total FROM c_card_game_log WHERE " . $condition_card . " GROUP BY userId) temp GROUP BY userId ORDER BY total_price ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;    
        } else if($search["order"]=="2") {
            /* Sắp xếp theo doanh thu từ cao đến thấp */
            $sql = "SELECT userId, sum(total) as total_price FROM (SELECT userId, sum(price) as total FROM c_sms_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, sum(price) as total FROM c_sms_game_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, sum(price) as total FROM c_card_game_log WHERE " . $condition_card . " GROUP BY userId) temp GROUP BY userId ORDER BY total_price DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;    
        } else if($search["order"]=="3") {
            /* Sắp xếp theo sản lượng từ thấp đến cao */
            $sql = "SELECT userId, sum(sms) as total_sms FROM (SELECT userId, count(id) as sms FROM c_sms_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, count(id) as sms FROM c_sms_game_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, count(id) as sms FROM c_card_game_log WHERE " . $condition_card . " GROUP BY userId) temp GROUP BY userId ORDER BY total_sms ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        } else if($search["order"]=="4") {
            /* Sắp xếp theo sản lượng từ cao đến thấp */
            $sql = "SELECT userId, sum(sms) as total_sms FROM (SELECT userId, count(id) as sms FROM c_sms_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, count(id) as sms FROM c_sms_game_log WHERE " . $condition_sms . " GROUP BY userId UNION SELECT userId, count(id) as sms FROM c_card_game_log WHERE " . $condition_card . " GROUP BY userId) temp GROUP BY userId ORDER BY total_sms DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        }
        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();    
        
        $list_user_id = "0";
        foreach($rows as $row){
            $list_user_id .= ", " . $row["userId"];
        }         
        
        $sql = "SELECT 
            id
            , username
            , full_name
            , mobile
            , refCode 
            , permanent_address
            , identity_number
            , date_of_identity
            , which_of_identity
            , account_number
            , account_bank
            , birthday
            FROM c_user WHERE id IN (" . $list_user_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsUser = $command->queryAll();
        $replaceUser = array();
        foreach($rowsUser as $row){
            $replaceUser[$row["id"]]["id"] = $row["id"];
            $replaceUser[$row["id"]]["username"] = $row["username"];
            $replaceUser[$row["id"]]["full_name"] = $row["full_name"];
            $replaceUser[$row["id"]]["mobile"] = $row["mobile"];
            $replaceUser[$row["id"]]["refCode"] = $row["refCode"];
            $replaceUser[$row["id"]]["permanent_address"] = $row["permanent_address"];
            $replaceUser[$row["id"]]["identity_number"] = $row["identity_number"];
            $replaceUser[$row["id"]]["date_of_identity"] = $row["date_of_identity"];
            $replaceUser[$row["id"]]["which_of_identity"] = $row["which_of_identity"];
            $replaceUser[$row["id"]]["account_number"] = $row["account_number"];
            $replaceUser[$row["id"]]["account_bank"] = $row["account_bank"];
            $replaceUser[$row["id"]]["birthday"] = $row["birthday"];
        }
        
        $i = 0;
        while(isset($rows[$i])){            
            $rows[$i]["id"] = $rows[$i]["userId"];
            $rows[$i]["username"] = isset($replaceUser[$rows[$i]["userId"]]["username"]) ? $replaceUser[$rows[$i]["userId"]]["username"] : "";
            $rows[$i]["full_name"] = isset($replaceUser[$rows[$i]["userId"]]["full_name"]) ? $replaceUser[$rows[$i]["userId"]]["full_name"] : "";
            $rows[$i]["mobile"] = isset($replaceUser[$rows[$i]["userId"]]["mobile"]) ? $replaceUser[$rows[$i]["userId"]]["mobile"] : "";
            $rows[$i]["refCode"] = isset($replaceUser[$rows[$i]["userId"]]["refCode"]) ? $replaceUser[$rows[$i]["userId"]]["refCode"] : "";
            $rows[$i]["permanent_address"] = isset($replaceUser[$rows[$i]["userId"]]["permanent_address"]) ? $replaceUser[$rows[$i]["userId"]]["permanent_address"] : "";
            $rows[$i]["identity_number"] = isset($replaceUser[$rows[$i]["userId"]]["identity_number"]) ? $replaceUser[$rows[$i]["userId"]]["identity_number"] : "";
            $rows[$i]["date_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["date_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["date_of_identity"] : "";
            $rows[$i]["which_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["which_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["which_of_identity"] : "";
            $rows[$i]["account_number"] = isset($replaceUser[$rows[$i]["userId"]]["account_number"]) ? $replaceUser[$rows[$i]["userId"]]["account_number"] : "";
            $rows[$i]["account_bank"] = isset($replaceUser[$rows[$i]["userId"]]["account_bank"]) ? $replaceUser[$rows[$i]["userId"]]["account_bank"] : "";
            $rows[$i]["birthday"] = isset($replaceUser[$rows[$i]["userId"]]["birthday"]) ? $replaceUser[$rows[$i]["userId"]]["birthday"] : "";                 
          
            $i++;                
        }
        
        return $rows;
    }
    
    public function GetUser($search, $currentPage, $numberRecordPerPage)
    {
        $condition = "";        
        $condition .= "userId!=0 AND userId!=''";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        if($search["start"]!="" && $search["end"]!=""){
            $startRecord = intval($search["start"]);            
            $numberRecordPerPage = intval($search["end"]) - intval($search["start"]) + 1;
        }
        
        if(!empty($search["username"])){
            $sql = "SELECT id FROM c_user WHERE username='" . mysql_escape_string($search["username"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();    
            
            $condition .= empty($rows) ? " AND userId=0" : " AND userId=" . $rows["id"];
        }
          
        /* Tiêu chí sắp xếp mặc định */      
        $sql = "SELECT userId, sum(price) as total_price FROM c_sms_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        
        if($search["order"]=="1") {
            /* Sắp xếp theo doanh thu từ thấp đến cao */
            $sql = "SELECT userId, sum(price) as total_price FROM c_sms_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        } else if($search["order"]=="2") {
            /* Sắp xếp theo doanh thu từ cao đến thấp */
            $sql = "SELECT userId, sum(price) as total_price FROM c_sms_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        } else if($search["order"]=="3") {
            /* Sắp xếp theo sản lượng từ thấp đến cao */
            $sql = "SELECT userId, sum(sms) as total_sms FROM c_sms_log WHERE " . $condition . " GROUP BY userId ORDER BY total_sms ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        } else if($search["order"]=="4") {
            /* Sắp xếp theo sản lượng từ cao đến thấp */
            $sql = "SELECT userId, sum(sms) as total_sms FROM c_sms_log WHERE " . $condition . " GROUP BY userId ORDER BY total_sms DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        }  
        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();    
        
        $list_user_id = "0";
        foreach($rows as $row){
            $list_user_id .= ", " . $row["userId"];
        }         
        
        $sql = "SELECT 
            id
            , username
            , full_name
            , mobile
            , refCode 
            , permanent_address
            , identity_number
            , date_of_identity
            , which_of_identity
            , account_number
            , account_bank
            , birthday
            FROM c_user WHERE id IN (" . $list_user_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsUser = $command->queryAll();
        $replaceUser = array();
        foreach($rowsUser as $row){
            $replaceUser[$row["id"]]["id"] = $row["id"];
            $replaceUser[$row["id"]]["username"] = $row["username"];
            $replaceUser[$row["id"]]["full_name"] = $row["full_name"];
            $replaceUser[$row["id"]]["mobile"] = $row["mobile"];
            $replaceUser[$row["id"]]["refCode"] = $row["refCode"];
            $replaceUser[$row["id"]]["permanent_address"] = $row["permanent_address"];
            $replaceUser[$row["id"]]["identity_number"] = $row["identity_number"];
            $replaceUser[$row["id"]]["date_of_identity"] = $row["date_of_identity"];
            $replaceUser[$row["id"]]["which_of_identity"] = $row["which_of_identity"];
            $replaceUser[$row["id"]]["account_number"] = $row["account_number"];
            $replaceUser[$row["id"]]["account_bank"] = $row["account_bank"];
            $replaceUser[$row["id"]]["birthday"] = $row["birthday"];
        }
        
        $i = 0;
        while(isset($rows[$i])){            
            $rows[$i]["id"] = $rows[$i]["userId"];
            $rows[$i]["username"] = isset($replaceUser[$rows[$i]["userId"]]["username"]) ? $replaceUser[$rows[$i]["userId"]]["username"] : "";
            $rows[$i]["full_name"] = isset($replaceUser[$rows[$i]["userId"]]["full_name"]) ? $replaceUser[$rows[$i]["userId"]]["full_name"] : "";
            $rows[$i]["mobile"] = isset($replaceUser[$rows[$i]["userId"]]["mobile"]) ? $replaceUser[$rows[$i]["userId"]]["mobile"] : "";
            $rows[$i]["refCode"] = isset($replaceUser[$rows[$i]["userId"]]["refCode"]) ? $replaceUser[$rows[$i]["userId"]]["refCode"] : "";
            $rows[$i]["permanent_address"] = isset($replaceUser[$rows[$i]["userId"]]["permanent_address"]) ? $replaceUser[$rows[$i]["userId"]]["permanent_address"] : "";
            $rows[$i]["identity_number"] = isset($replaceUser[$rows[$i]["userId"]]["identity_number"]) ? $replaceUser[$rows[$i]["userId"]]["identity_number"] : "";
            $rows[$i]["date_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["date_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["date_of_identity"] : "";
            $rows[$i]["which_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["which_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["which_of_identity"] : "";
            $rows[$i]["account_number"] = isset($replaceUser[$rows[$i]["userId"]]["account_number"]) ? $replaceUser[$rows[$i]["userId"]]["account_number"] : "";
            $rows[$i]["account_bank"] = isset($replaceUser[$rows[$i]["userId"]]["account_bank"]) ? $replaceUser[$rows[$i]["userId"]]["account_bank"] : "";
            $rows[$i]["birthday"] = isset($replaceUser[$rows[$i]["userId"]]["birthday"]) ? $replaceUser[$rows[$i]["userId"]]["birthday"] : "";                 
          
            $i++;                
        }
        
        return $rows;
    }
    
    public function GetTotalUser($search)
    {
        $condition = "";        
        $condition .= "userId!=0 AND userId!=''";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        if(!empty($search["username"])){
            $sql = "SELECT id FROM c_user WHERE username='" . mysql_escape_string($search["username"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();    
            
            $condition .= empty($rows) ? " AND userId=0" : " AND userId=" . $rows["id"];
        }
                
        $sql = "SELECT count(userId) FROM c_sms_log WHERE " . $condition;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();    
    
        return $rows["count(userId)"];    
    }
    
    public function GetUserCard($search, $currentPage, $numberRecordPerPage)
    {
        $condition = "";        
        $condition .= "userId!=0 AND userId!=''";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        if($search["start"]!="" && $search["end"]!=""){
            $startRecord = intval($search["start"]);            
            $numberRecordPerPage = intval($search["end"]) - intval($search["start"]) + 1;
        }
        
        if(!empty($search["username"])){
            $sql = "SELECT id FROM c_user WHERE username='" . mysql_escape_string($search["username"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();    
            
            $condition .= empty($rows) ? " AND userId=0" : " AND userId=" . $rows["id"];
        }
        
        /* Tiêu chí sắp xếp mặc định */      
        $sql = "SELECT userId, sum(price) as total_price FROM c_card_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        
        if($search["order"]=="1") {
            /* Sắp xếp theo doanh thu từ thấp đến cao */
            $sql = "SELECT userId, sum(price) as total_price FROM c_card_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        } else if($search["order"]=="2") {
            /* Sắp xếp theo doanh thu từ cao đến thấp */
            $sql = "SELECT userId, sum(price) as total_price FROM c_card_log WHERE " . $condition . " GROUP BY userId ORDER BY total_price DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        } else if($search["order"]=="3") {
            /* Sắp xếp theo sản lượng từ thấp đến cao */
            $sql = "SELECT userId, count(id) as total_card FROM c_card_log WHERE " . $condition . " GROUP BY userId ORDER BY total_card ASC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        } else if($search["order"]=="4") {
            /* Sắp xếp theo sản lượng từ cao đến thấp */
            $sql = "SELECT userId, count(id) as total_card FROM c_card_log WHERE " . $condition . " GROUP BY userId ORDER BY total_card DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;
        }            
        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();    
        
        $list_user_id = "0";
        foreach($rows as $row){
            $list_user_id .= ", " . $row["userId"];
        }
        
        $sql = "SELECT 
            id
            , username
            , full_name
            , mobile
            , refCode 
            , permanent_address
            , identity_number
            , date_of_identity
            , which_of_identity
            , account_number
            , account_bank
            , birthday
            FROM c_user WHERE id IN (" . $list_user_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsUser = $command->queryAll();
        $replaceUser = array();
        foreach($rowsUser as $row){
            $replaceUser[$row["id"]]["id"] = $row["id"];
            $replaceUser[$row["id"]]["username"] = $row["username"];
            $replaceUser[$row["id"]]["full_name"] = $row["full_name"];
            $replaceUser[$row["id"]]["mobile"] = $row["mobile"];
            $replaceUser[$row["id"]]["refCode"] = $row["refCode"];
            $replaceUser[$row["id"]]["permanent_address"] = $row["permanent_address"];
            $replaceUser[$row["id"]]["identity_number"] = $row["identity_number"];
            $replaceUser[$row["id"]]["date_of_identity"] = $row["date_of_identity"];
            $replaceUser[$row["id"]]["which_of_identity"] = $row["which_of_identity"];
            $replaceUser[$row["id"]]["account_number"] = $row["account_number"];
            $replaceUser[$row["id"]]["account_bank"] = $row["account_bank"];
            $replaceUser[$row["id"]]["birthday"] = $row["birthday"];
        }
        
        $i = 0;
        while(isset($rows[$i])){            
            $rows[$i]["id"] = $rows[$i]["userId"];
            $rows[$i]["username"] = isset($replaceUser[$rows[$i]["userId"]]["username"]) ? $replaceUser[$rows[$i]["userId"]]["username"] : "";
            $rows[$i]["full_name"] = isset($replaceUser[$rows[$i]["userId"]]["full_name"]) ? $replaceUser[$rows[$i]["userId"]]["full_name"] : "";
            $rows[$i]["mobile"] = isset($replaceUser[$rows[$i]["userId"]]["mobile"]) ? $replaceUser[$rows[$i]["userId"]]["mobile"] : "";
            $rows[$i]["refCode"] = isset($replaceUser[$rows[$i]["userId"]]["refCode"]) ? $replaceUser[$rows[$i]["userId"]]["refCode"] : "";
            $rows[$i]["permanent_address"] = isset($replaceUser[$rows[$i]["userId"]]["permanent_address"]) ? $replaceUser[$rows[$i]["userId"]]["permanent_address"] : "";
            $rows[$i]["identity_number"] = isset($replaceUser[$rows[$i]["userId"]]["identity_number"]) ? $replaceUser[$rows[$i]["userId"]]["identity_number"] : "";
            $rows[$i]["date_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["date_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["date_of_identity"] : "";
            $rows[$i]["which_of_identity"] = isset($replaceUser[$rows[$i]["userId"]]["which_of_identity"]) ? $replaceUser[$rows[$i]["userId"]]["which_of_identity"] : "";
            $rows[$i]["account_number"] = isset($replaceUser[$rows[$i]["userId"]]["account_number"]) ? $replaceUser[$rows[$i]["userId"]]["account_number"] : "";
            $rows[$i]["account_bank"] = isset($replaceUser[$rows[$i]["userId"]]["account_bank"]) ? $replaceUser[$rows[$i]["userId"]]["account_bank"] : "";
            $rows[$i]["birthday"] = isset($replaceUser[$rows[$i]["userId"]]["birthday"]) ? $replaceUser[$rows[$i]["userId"]]["birthday"] : "";                 
          
            $i++;                
        }
        
        return $rows;
    }
    
    public function GetTotalUserCard($search)
    {
        $condition = "";        
        $condition .= "userId!=0 AND userId!=''";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        
        if(!empty($search["username"])){
            $sql = "SELECT id FROM c_user WHERE username='" . mysql_escape_string($search["username"]) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();    
            
            $condition .= empty($rows) ? " AND userId=0" : " AND userId=" . $rows["id"];
        }
        
        $sql = "SELECT count(DISTINCT(userId)) FROM c_card_game_log WHERE " . $condition;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();    
    
        return $rows["count(DISTINCT(userId))"];    
    }
    
    public function getReportSmsListUser($search)
    {
        $condition = "";
        $condition .= $search["list_user_id"]!="" ? " AND userId IN (" . mysql_escape_string($search["list_user_id"]) . ")" : "";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        $sql = "SELECT count(id), userId, price, month, year FROM c_sms_log WHERE status=1 AND type!=1 " . $condition . " GROUP BY userId, month, year, price";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $report = array();
        foreach($rows as $row){
            $report[$row["userId"]][] = $row;   
        }
     
        return $report;
    }
    
    public function getReportSmsGameListUser($search)
    {
        $condition = "";
        $condition .= $search["list_user_id"]!="" ? " AND userId IN (" . mysql_escape_string($search["list_user_id"]) . ")" : "";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        $sql = "SELECT count(id), userId, price, dataId FROM c_sms_log WHERE status=1 AND type=1 " . $condition . " GROUP BY userId, dataId, price";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        
        $list_data_id = '0';
        foreach($rows as $row){
            $list_data_id .= "," . $row["dataId"];
        }
        $list_data_id = Common::remove_duplicate($list_data_id);
        
        /* lấy % ăn chia của game */
        $sql = "SELECT id, percent_wapmaster, percent_partner FROM c_game WHERE id IN (" . $list_data_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsPercent = $command->queryAll();
        $replacePercent = array();
        
        foreach($rowsPercent as $row){
            $replacePercent[$row["id"]]["percent_wapmaster"] = $row["percent_wapmaster"];
            $replacePercent[$row["id"]]["percent_partner"] = $row["percent_partner"];
        }
        
        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["percent_wapmaster"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"] : 0;
            $rows[$i]["percent_partner"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_partner"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_partner"] : 0;
            $i++;
        }
        
        $report = array();
        foreach($rows as $row){
            $report[$row["userId"]][] = $row;   
        }
     
        return $report;
    }

    public function getReportCardGameListUser($search)
    {
        $condition = "";
        $condition .= $search["list_user_id"]!="" ? " AND userId IN (" . mysql_escape_string($search["list_user_id"]) . ")" : "";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
                
        $sql = "SELECT count(id), sum(price), userId, dataId FROM c_card_log WHERE status=1 " . $condition . " GROUP BY userId, dataId";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        
        $list_data_id = '0';
        foreach($rows as $row){
            $list_data_id .= "," . $row["dataId"];
        }
        $list_data_id = Common::remove_duplicate($list_data_id);
        
        /* lấy % ăn chia của game */
        $sql = "SELECT id, percent_wapmaster, percent_partner FROM c_game WHERE id IN (" . $list_data_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsPercent = $command->queryAll();
        $replacePercent = array();
        
        foreach($rowsPercent as $row){
            $replacePercent[$row["id"]]["percent_wapmaster"] = $row["percent_wapmaster"];
            $replacePercent[$row["id"]]["percent_partner"] = $row["percent_partner"];
        }
        
        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["percent_wapmaster"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"] : 0;
            $rows[$i]["percent_partner"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_partner"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_partner"] : 0;
            $i++;
        }
        
        $report = array();
        foreach($rows as $row){
            $report[$row["userId"]][] = $row;   
        }
        
        return $report;
    }
    
    /* Trang chi tiết */
    public function getReportSmsByUser($search, $currentPage, $numberRecordPerPage)
    {
        $condition = "";
        $condition .= " AND userId='" . mysql_escape_string($search["userId"]) . "'";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
        
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        $sql = "SELECT id, type, dataId, telco, sender, serviceCode, price, content, create_date FROM c_sms_log WHERE status=1 " . $condition . " ORDER BY create_date DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        
        $list_data_id = '0';
        foreach($rows as $row){
            $list_data_id .= "," . $row["dataId"];
        }
        $list_data_id = Common::remove_duplicate($list_data_id);
        
        /* lấy % ăn chia của game */
        $sql = "SELECT id, percent_wapmaster, percent_partner FROM c_game WHERE id IN (" . $list_data_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsPercent = $command->queryAll();
        $replacePercent = array();
        
        foreach($rowsPercent as $row){
            $replacePercent[$row["id"]]["percent_wapmaster"] = $row["percent_wapmaster"];
            $replacePercent[$row["id"]]["percent_partner"] = $row["percent_partner"];
        }
        
        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["percent_wapmaster"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"] : 0;
            $rows[$i]["percent_partner"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_partner"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_partner"] : 0;
            $i++;
        }
        
        return $rows;
    }
    
    public function getTotalReportSmsByUser($search)
    {
        $condition = "";
        $condition .= " AND userId='" . mysql_escape_string($search["userId"]) . "'";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        $condition .= !empty($search["telco"]) ? " AND telco='" . mysql_escape_string($search["telco"]) . "'" : "";
                        
        $sql = "SELECT count(id) FROM c_sms_log WHERE status=1 " . $condition;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        
        return $rows["count(id)"];    
    }
    
    public function getReportCardByUser($search, $currentPage, $numberRecordPerPage)
    {
        $condition = "";
        $condition .= " AND userId='" . mysql_escape_string($search["userId"]) . "'";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
        
        $startRecord = ($currentPage - 1) * $numberRecordPerPage;
        $sql = "SELECT price, dataId, provider_code, card_seri, create_date FROM c_card_log WHERE status=1 " . $condition . " ORDER BY create_date DESC LIMIT " . $startRecord . ", " . $numberRecordPerPage;        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        
        $list_data_id = '0';
        foreach($rows as $row){
            $list_data_id .= "," . $row["dataId"];
        }
        $list_data_id = Common::remove_duplicate($list_data_id);
        
        /* lấy % ăn chia của game */
        $sql = "SELECT id, percent_wapmaster, percent_partner FROM c_game WHERE id IN (" . $list_data_id . ")";
        $command = Yii::app()->db->createCommand($sql);
        $rowsPercent = $command->queryAll();
        $replacePercent = array();
        
        foreach($rowsPercent as $row){
            $replacePercent[$row["id"]]["percent_wapmaster"] = $row["percent_wapmaster"];
            $replacePercent[$row["id"]]["percent_partner"] = $row["percent_partner"];
        }
        
        $i = 0;
        while(isset($rows[$i])){
            $rows[$i]["percent_wapmaster"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_wapmaster"] : 0;
            $rows[$i]["percent_partner"] = isset($replacePercent[$rows[$i]["dataId"]]["percent_partner"]) ? $replacePercent[$rows[$i]["dataId"]]["percent_partner"] : 0;
            $i++;
        }
        
        return $rows;   
    }
    
    public function getTotalReportCardByUser($search)
    {
        $condition = "";
        $condition .= " AND userId='" . mysql_escape_string($search["userId"]) . "'";
        $condition .= !empty($search["day"]) ? " AND day='" . mysql_escape_string($search["day"]) . "'" : "";
        $condition .= $search["month"]!="" ? " AND month='" . mysql_escape_string($search["month"]) . "'" : "";
        $condition .= $search["year"]!="" ? " AND year='" . mysql_escape_string($search["year"]) . "'" : "";
                
        $sql = "SELECT count(id) FROM c_card_log WHERE status=1 " . $condition;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows["count(id)"];   
    }
}
?>
