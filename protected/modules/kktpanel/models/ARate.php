<?php
class ARate extends CActiveRecord
{
    public function getRateInMonth($search)
    {
        $sql = "SELECT * FROM c_rate WHERE month=" . $search["month"] . " AND year=" . $search["year"];        
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    
    public function getRateTelcoInMonth($search)
    {
        $sql = "SELECT serviceCode, telco, telco_name, rate_of_telco FROM c_rate_sms WHERE month=" . $search["month"] . " AND year=" . $search["year"];
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $rate = array();
        foreach($rows as $row){
            $rate[$row["telco"] . "_" . $row["serviceCode"]] = $row["rate_of_telco"];
        }
        
        return $rate;
    }
    
    public function getRateTelcoCardInMonth($search)
    {
        $sql = "SELECT * FROM c_rate_card WHERE month=" . $search["month"] . " AND year=" . $search["year"];
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $rate = array();
        foreach($rows as $row){
            $rate[$row["telco_name"]][$row["money"]] = $row["rate_of_telco"];
        }
        
        return $rate;    
    }
    
    public function getRateServiceCodeInMonth($search)
    {
        $sql = "SELECT * FROM c_rate_service_code WHERE month=" . $search["month"] . " AND year=" . $search["year"];
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $rate = array();
        foreach($rows as $row){
            $rate[$row["money"]] = $row["rate_of_service_code"];
        }
        
        return $rate;   
    }
    
    /* Quản lý rate */
    public function getRate($m, $y)
    {
        $sql = "SELECT * FROM c_rate WHERE month=" . $m . " AND year=" . $y;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
    
    public function UpdateRate($data)
    {
        $sql = "UPDATE c_rate SET 
            issue_rate_of_user_min=:issue_rate_of_user_min
            , issue_rate_of_hdc_min=:issue_rate_of_hdc_min
            , issue_rate_of_producer_min=:issue_rate_of_producer_min
            , issue_price=:issue_price
            , issue_rate_of_user_max=:issue_rate_of_user_max
            , issue_rate_of_hdc_max=:issue_rate_of_hdc_max
            , issue_rate_of_producer_max=:issue_rate_of_producer_max
            , rate_of_user_min=:rate_of_user_min
            , rate_of_hdc_min=:rate_of_hdc_min
            , price=:price
            , rate_of_user_max=:rate_of_user_max
            , rate_of_hdc_max=:rate_of_hdc_max
            WHERE id=:id
        ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValues($data);
        $result = $command->execute();
        return $result;
    }
    
    /* Quản lý rate sms */
    public function getRateSms($m, $y)
    {
        $sql = "SELECT * FROM c_rate_sms WHERE month=" . $m . " AND year=" . $y;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;   
    }
    
    public function updateRateSms($data)
    {
        $sql = "UPDATE c_rate_sms SET rate_of_telco=:rate_of_telco WHERE id=:id";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach($data as $id=>$rate){
            $command->bindValue(":rate_of_telco", $rate, PDO::PARAM_STR);
            $command->bindValue(":id", $id, PDO::PARAM_STR);
            $result = $command->execute();    
        }
        
        return $result;            
    }
    
    /* Quản lý rate card */
    public function getRateCard($m, $y)
    {
        $sql = "SELECT * FROM c_rate_card WHERE month=" . $m . " AND year=" . $y;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;   
    }
    
    public function updateRateCard($data)
    {
        $sql = "UPDATE c_rate_card SET rate_of_telco=:rate_of_telco WHERE id=:id";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach($data as $id=>$rate){
            $command->bindValue(":rate_of_telco", $rate, PDO::PARAM_STR);
            $command->bindValue(":id", $id, PDO::PARAM_STR);
            $result = $command->execute();    
        }
        
        return $result;            
    }
    
    /* Quản lý rate service */
    public function getRateService($m, $y)
    {
        $sql = "SELECT * FROM c_rate_service_code WHERE month=" . $m . " AND year=" . $y;
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;   
    }
    
    public function updateRateService($data)
    {
        $sql = "UPDATE c_rate_service_code SET rate_of_service_code=:rate_of_service_code WHERE id=:id";
        $command = Yii::app()->db->createCommand($sql);
        
        foreach($data as $id=>$rate){
            $command->bindValue(":rate_of_service_code", $rate, PDO::PARAM_STR);
            $command->bindValue(":id", $id, PDO::PARAM_STR);
            $result = $command->execute();    
        }
        
        return $result;            
    }
}
?>