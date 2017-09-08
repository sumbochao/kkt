<?php
class ReportSms extends CActiveRecord
{
    public function getRateInMonth($total_money, $month, $year)
    {        
        $sql = "SELECT * FROM c_config WHERE month=" . $month . " AND year=" . $year;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        if(!empty($rows)){
            if($total_money < $rows["issue_price"]){
                $rows["issue_rate_of_user"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_user_min"];
                $rows["issue_rate_of_hdc"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_hdc_min"];
                $rows["issue_rate_of_producer"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_producer_min"];    
            } else {
                $rows["issue_rate_of_user"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_user_max"];
                $rows["issue_rate_of_hdc"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_hdc_max"];
                $rows["issue_rate_of_producer"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["issue_rate_of_producer_max"];
            }
            
            if($total_money < $rows["price"]){
                $rows["rate_of_user"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["rate_of_user_min"];
                $rows["rate_of_hdc"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["rate_of_hdc_min"];
            } else {
                $rows["rate_of_user"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["rate_of_user_max"];
                $rows["rate_of_hdc"] = ( (100 - $rows["rate_of_telco"] - $rows["rate_of_service_code"]) / 100 ) * $rows["rate_of_hdc_max"];
            }
        }
        
        return $rows;  
    } 
    
    public function getRate($total, $year)
    {
        $sql = "SELECT * FROM c_config WHERE year=" . $year;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $rate = array();
        foreach($rows as $row){
            if(isset($total[$row["month"]])){
                $rate[$row["month"]]["rate_of_telco"] = $row["rate_of_telco"];
                $rate[$row["month"]]["rate_of_service_code"] = $row["rate_of_service_code"];
                
                if($total[$row["month"]] < $row["issue_price"]){
                    $rate[$row["month"]]["issue_rate_of_user"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_user_min"];
                    $rate[$row["month"]]["issue_rate_of_hdc"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_hdc_min"];
                    $rate[$row["month"]]["issue_rate_of_producer"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_producer_min"];    
                } else {
                    $rate[$row["month"]]["issue_rate_of_user"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_user_max"];
                    $rate[$row["month"]]["issue_rate_of_hdc"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_hdc_max"];
                    $rate[$row["month"]]["issue_rate_of_producer"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["issue_rate_of_producer_max"];
                }
                
                if($total[$row["month"]] < $row["price"]){
                    $rate[$row["month"]]["rate_of_user"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["rate_of_user_min"];
                    $rate[$row["month"]]["rate_of_hdc"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["rate_of_hdc_min"];
                } else {
                    $rate[$row["month"]]["rate_of_user"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["rate_of_user_max"];
                    $rate[$row["month"]]["rate_of_hdc"] = ( (100 - $row["rate_of_telco"] - $row["rate_of_service_code"]) / 100 ) * $row["rate_of_hdc_max"];
                }
            }           
        }
        
        return $rate;   
    }
    
    public function getTotalMoneyInMonth($userId, $month, $year)
    {
        $sql = "SELECT count(id), serviceCode FROM c_sms_log WHERE userId=" . $userId . " AND month=" . $month . " AND year=" . $year . " AND status=1 GROUP BY serviceCode";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $total_money = 0;
        foreach($rows as $row){
            $total_money += $row["count(id)"] * Common::priceServiceCode($row["serviceCode"]);
        }
        
        $sql = "SELECT count(id), serviceCode FROM c_sms_game_log WHERE userId=" . $userId . " AND month=" . $month . " AND year=" . $year . " AND status=1 GROUP BY serviceCode";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        foreach($rows as $row){
             $total_money += $row["count(id)"] * Common::priceServiceCode($row["serviceCode"]);
        }
        
        $sql = "SELECT sum(price) FROM c_card_game_log WHERE userId=" . $userId . " AND month=" . $month . " AND year=" . $year . " AND response_status=1";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        if(!empty($rows)){
            $total_money += $rows["sum(price)"];
        }
        return $total_money;
    }
    
    public function getTotalMoney($userId, $year)
    {
        $total = array();
        $sql = "SELECT count(id), serviceCode, month FROM c_sms_log WHERE userId=" . $userId . " AND year=" . $year . " AND status=1 GROUP BY serviceCode, month";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        foreach($rows as $row){
            if(!isset($total[$row["month"]])) $total[$row["month"]] = 0;
            $total[$row["month"]] += $row["count(id)"] * Common::priceServiceCode($row["serviceCode"]);
        }
        
        $sql = "SELECT count(id), serviceCode, month FROM c_sms_game_log WHERE userId=" . $userId . " AND year=" . $year . " AND status=1 GROUP BY serviceCode, month";                
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();                
        foreach($rows as $row){
            if(!isset($total[$row["month"]])) $total[$row["month"]] = 0;
            $total[$row["month"]] += $row["count(id)"] * Common::priceServiceCode($row["serviceCode"]);
        }
        
        $sql = "SELECT sum(price), month FROM c_card_game_log WHERE userId=" . $userId . " AND year=" . $year . " AND response_status=1 GROUP BY month";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $row){
            if(!isset($total[$row["month"]])) $total[$row["month"]] = 0;
            $total[$row["month"]] += $row["sum(price)"];
        }
       
        return $total;    
    }
    
    public function getReportUserToday($userId, $day, $month, $year) 
    {        
        $sql = "SELECT count(id), serviceCode FROM c_sms_log WHERE userId=" . $userId . " AND day=" . $day . " AND month=" . $month . " AND year=" . $year . " AND status=1 GROUP BY serviceCode";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $report = array();
        foreach($rows as $row){
            $report[$row["serviceCode"]] = $row["count(id)"];
        }        
        
        return $report;        
    }
    
    public function getReportSmsGameToday($userId, $day, $month, $year) 
    {       
        $sql = "SELECT count(id), serviceCode FROM c_sms_game_log WHERE userId=" . $userId . " AND day=" . $day . " AND month=" . $month . " AND year=" . $year . " AND status=1 GROUP BY serviceCode";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        $report = array();
        foreach($rows as $row){        
            $report[$row["serviceCode"]] = $row["count(id)"];            
        }
        
        return $report;        
    }
    
    public function getReportCardGameToday($userId, $day, $month, $year)
    {        
        $report = array();
        $report["total_card"] = 0;
        $report["total_price"] = 0;
        $sql = "SELECT count(id), sum(price) FROM c_card_game_log WHERE userId=" . $userId . " AND day=" . $day . " AND month=" . $month . " AND year=" . $year . " AND response_status=1";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();        
        if(!empty($rows)){
            $report["total_card"] = $rows["count(id)"];
            $report["total_price"] = $rows["sum(price)"];
        }   
        
        return $report;
    }
    
    public function getReportUserAll($rate, $userId, $year) 
    {
        $report = array();
        
        /* doanh thu từ bảng sms_log */
        $sql = "SELECT count(id), serviceCode, month FROM c_sms_log WHERE userId=" . $userId . " AND year=" . $year . " GROUP BY serviceCode, month";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $row){
            if(!isset($report[$row["month"]]["total_sms"])) $report[$row["month"]]["total_sms"] = 0;
            $report[$row["month"]]["total_sms"] += $row["count(id)"];   
            
            if(!isset($report[$row["month"]]["total_card"])) $report[$row["month"]]["total_card"] = 0;
            
            $money = Common::priceServiceCode($row["serviceCode"]) / 1.1;            
            $sms = $row["count(id)"];
            
            $money_of_telco = ($money * $rate[$row["month"]]["rate_of_telco"] / 100) * $sms;
            $money_of_service_code = ($money * $rate[$row["month"]]["rate_of_service_code"] / 100) * $sms;
            $money_of_user = ($money * $rate[$row["month"]]["rate_of_user"] / 100) * $sms;
            $money_of_hdc = ($money * $rate[$row["month"]]["rate_of_hdc"] / 100) * $sms;                           
         
            $money_back_telco = ($money * $sms) - $money_of_telco;
            $money_back_service_code = $money_back_telco - $money_of_service_code;
            
            if(!isset($report[$row["month"]]["money_back_telco"])) $report[$row["month"]]["money_back_telco"] = 0;
            $report[$row["month"]]["money_back_telco"] += round($money_back_telco);   
            
            if(!isset($report[$row["month"]]["money_back_service_code"])) $report[$row["month"]]["money_back_service_code"] = 0;
            $report[$row["month"]]["money_back_service_code"] += round($money_back_service_code);   
            
            if(!isset($report[$row["month"]]["money_of_user"])) $report[$row["month"]]["money_of_user"] = 0;
            $report[$row["month"]]["money_of_user"] += round($money_of_user);   
            
            if(!isset($report[$row["month"]]["money_of_hdc"])) $report[$row["month"]]["money_of_hdc"] = 0;
            $report[$row["month"]]["money_of_hdc"] += round($money_of_hdc);   
            
            if(!isset($report[$row["month"]]["money_of_producer"])) $report[$row["month"]]["money_of_producer"] = 0;            
        }
        
        /* doanh thu từ bảng sms_game_log */
        $sql = "SELECT count(id), serviceCode, month FROM c_sms_game_log WHERE userId=" . $userId . " AND year=" . $year . " GROUP BY serviceCode, month";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $row){
            if(!isset($report[$row["month"]]["total_sms"])) $report[$row["month"]]["total_sms"] = 0;
            $report[$row["month"]]["total_sms"] += $row["count(id)"];   
                        
            if(!isset($report[$row["month"]]["total_card"])) $report[$row["month"]]["total_card"] = 0;
                                    
            $money = Common::priceServiceCode($row["serviceCode"]) / 1.1;            
            $sms = $row["count(id)"];
            
            $money_of_telco = ($money * $rate[$row["month"]]["rate_of_telco"] / 100) * $sms;
            $money_of_service_code = ($money * $rate[$row["month"]]["rate_of_service_code"] / 100) * $sms;
            $money_of_user = ($money * $rate[$row["month"]]["issue_rate_of_user"] / 100) * $sms;
            $money_of_hdc = ($money * $rate[$row["month"]]["issue_rate_of_hdc"] / 100) * $sms;                           
            $money_of_producer = ($money * $rate[$row["month"]]["issue_rate_of_producer"] / 100) * $sms;                           
         
            $money_back_telco = ($money * $sms) - $money_of_telco;
            $money_back_service_code = $money_back_telco - $money_of_service_code;
            
            if(!isset($report[$row["month"]]["money_back_telco"])) $report[$row["month"]]["money_back_telco"] = 0;
            $report[$row["month"]]["money_back_telco"] += round($money_back_telco);   
            
            if(!isset($report[$row["month"]]["money_back_service_code"])) $report[$row["month"]]["money_back_service_code"] = 0;
            $report[$row["month"]]["money_back_service_code"] += round($money_back_service_code);   
            
            if(!isset($report[$row["month"]]["money_of_user"])) $report[$row["month"]]["money_of_user"] = 0;
            $report[$row["month"]]["money_of_user"] += round($money_of_user);   
            
            if(!isset($report[$row["month"]]["money_of_hdc"])) $report[$row["month"]]["money_of_hdc"] = 0;
            $report[$row["month"]]["money_of_hdc"] += round($money_of_hdc);   
            
            if(!isset($report[$row["month"]]["money_of_producer"])) $report[$row["month"]]["money_of_producer"] = 0;            
            $report[$row["month"]]["money_of_producer"] += round($money_of_producer);
        }
        
        /* doanh thu từ bảng card_game_log */
        $sql = "SELECT count(id), sum(price), month FROM c_card_game_log WHERE userId=" . $userId . " AND year=" . $year . " GROUP BY month";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        foreach($rows as $row){
            if(!isset($report[$row["month"]]["total_sms"])) $report[$row["month"]]["total_sms"] = 0;
            
            if(!isset($report[$row["month"]]["total_card"])) $report[$row["month"]]["total_card"] = 0;
            $report[$row["month"]]["total_card"] += $row["count(id)"];
            
            $money = $row["sum(price)"];                        
            
            $money_of_telco = ($money * $rate[$row["month"]]["rate_of_telco"] / 100);
            $money_of_service_code = ($money * $rate[$row["month"]]["rate_of_service_code"] / 100);
            $money_of_user = ($money * $rate[$row["month"]]["issue_rate_of_user"] / 100);
            $money_of_hdc = ($money * $rate[$row["month"]]["issue_rate_of_hdc"] / 100);                           
            $money_of_producer = ($money * $rate[$row["month"]]["issue_rate_of_producer"] / 100);                           
         
            $money_back_telco = $money - $money_of_telco;
            $money_back_service_code = $money_back_telco - $money_of_service_code;
            
            if(!isset($report[$row["month"]]["money_back_telco"])) $report[$row["month"]]["money_back_telco"] = 0;
            $report[$row["month"]]["money_back_telco"] += round($money_back_telco);   
            
            if(!isset($report[$row["month"]]["money_back_service_code"])) $report[$row["month"]]["money_back_service_code"] = 0;
            $report[$row["month"]]["money_back_service_code"] += round($money_back_service_code);   
            
            if(!isset($report[$row["month"]]["money_of_user"])) $report[$row["month"]]["money_of_user"] = 0;
            $report[$row["month"]]["money_of_user"] += round($money_of_user);   
            
            if(!isset($report[$row["month"]]["money_of_hdc"])) $report[$row["month"]]["money_of_hdc"] = 0;
            $report[$row["month"]]["money_of_hdc"] += round($money_of_hdc);   
            
            if(!isset($report[$row["month"]]["money_of_producer"])) $report[$row["month"]]["money_of_producer"] = 0;            
            $report[$row["month"]]["money_of_producer"] += round($money_of_producer);
        }
        return $report;        
    }     
    
    public function getReportMonth()
    {
        $month = date("m");
        $year = date("Y");
        
        $sql = "SELECT count(id), serviceCode FROM c_sms_log WHERE month=" . $month . " AND year=" . $year . " GROUP BY serviceCode";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $report = array();
        foreach($rows as $row){
            if(isset($report[$row["serviceCode"]])) $report[$row["serviceCode"]] = 0;
            $report[$row["serviceCode"]] += $row["count(id)"];
        }
        
        $sql = "SELECT count(id), serviceCode FROM c_sms_game_log WHERE month=" . $month . " AND year=" . $year . " GROUP BY serviceCode";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        foreach($rows as $row){
            if(isset($report[$row["serviceCode"]])) $report[$row["serviceCode"]] = 0;
            $report[$row["serviceCode"]] += $row["count(id)"];
        }

        return $report;
    }
    
    public function getTotalSms()
    {
        $total_sms = 0;
        $sql = "SELECT count(id) FROM c_sms_log WHERE status=1";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        if(!empty($rows)){
            $total_sms += $rows["count(id)"];
        }
        
        $sql = "SELECT count(id) FROM c_sms_game_log WHERE status=1";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        if(!empty($rows)){
            $total_sms += $rows["count(id)"];
        }
        return $total_sms;
    }
    
    public function getTotalCard()
    {        
        $sql = "SELECT count(id) FROM c_card_game_log WHERE response_status=1";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        
        return $rows["count(id)"];
    }
    
    public function getAllMoney()
    {
        $total_money = 0;
        $sql = "SELECT count(id), serviceCode FROM c_sms_log WHERE status=1 GROUP BY serviceCode";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        foreach($rows as $row){
            $total_money += Common::priceServiceCode($row["serviceCode"]) * $row["count(id)"];            
        }
        
        $sql = "SELECT count(id), serviceCode FROM c_sms_game_log WHERE status=1 GROUP BY serviceCode";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        foreach($rows as $row){
            $total_money += Common::priceServiceCode($row["serviceCode"]) * $row["count(id)"];            
        }
        
        $sql = "SELECT sum(price) FROM c_card_game_log WHERE response_status=1";        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        
        $total_money += $rows["sum(price)"];
        return $total_money;
    }
}    
?>