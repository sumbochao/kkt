<?php
    class Rate extends CActiveRecord
    {
        public function buildRate($month, $year, $next_month, $next_year)
        {                
            /* Kiểm tra xem tháng tiếp theo đã có rate chưa */
            $next_condition = " month=" . $next_month . " AND year=" . $next_year;
            $sql = "SELECT count(id) FROM c_rate WHERE " . $next_condition;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            /* Nếu chưa có thì insert */
            if($rows["count(id)"] == 0){
                $condition = " month=" . $month . " AND year=" . $year;
                $sql = "SELECT
                issue_rate_of_user_min
                , issue_rate_of_hdc_min
                , issue_rate_of_producer_min
                , issue_price
                , issue_rate_of_user_max
                , issue_rate_of_hdc_max
                , issue_rate_of_producer_max
                , rate_of_user_min
                , rate_of_hdc_min
                , price
                , rate_of_user_max
                , rate_of_hdc_max
                FROM c_rate WHERE " . $condition;
                $command = Yii::app()->db->createCommand($sql);
                $rows = $command->queryAll();    

                $sql = "INSERT INTO c_rate SET 
                month=:month
                , year=:year
                , issue_rate_of_user_min=:issue_rate_of_user_min
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
                ";
                $command = Yii::app()->db->createCommand($sql);
                foreach($rows as $row){
                    $row["month"] = $next_month;
                    $row["year"] = $next_year;
                    $command->bindValues($row);                
                    $result = $command->execute();
                }
            } else {
                $result = -1;
            }

            return $result;
        }

        public function buildRateSms($month, $year, $next_month, $next_year)
        {
            /* Kiểm tra xem tháng tiếp theo đã có rate chưa */
            $next_condition = " month=" . $next_month . " AND year=" . $next_year;
            $sql = "SELECT count(id) FROM c_rate_sms WHERE " . $next_condition;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            /* Nếu chưa có thì insert */
            if($rows["count(id)"] == 0){
                $condition = " month=" . $month . " AND year=" . $year;
                $sql = "SELECT
                serviceCode
                , telco
                , telco_name
                , rate_of_telco
                FROM c_rate_sms WHERE " . $condition;
                $command = Yii::app()->db->createCommand($sql);
                $rows = $command->queryAll();    

                $sql = "INSERT INTO c_rate_sms SET 
                month=:month
                , year=:year
                , serviceCode=:serviceCode
                , telco=:telco
                , telco_name=:telco_name
                , rate_of_telco=:rate_of_telco
                ";
                $command = Yii::app()->db->createCommand($sql);
                foreach($rows as $row){
                    $row["month"] = $next_month;
                    $row["year"] = $next_year;
                    $command->bindValues($row);                
                    $result = $command->execute();
                }
            } else {
                $result = -1;
            }

            return $result;   
        }  

        public function buildRateCard($month, $year, $next_month, $next_year)
        {
            /* Kiểm tra xem tháng tiếp theo đã có rate chưa */
            $next_condition = " month=" . $next_month . " AND year=" . $next_year;
            $sql = "SELECT count(id) FROM c_rate_card WHERE " . $next_condition;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            /* Nếu chưa có thì insert */
            if($rows["count(id)"] == 0){
                $condition = " month=" . $month . " AND year=" . $year;
                $sql = "SELECT
                telco
                , telco_name
                , money
                , rate_of_telco
                FROM c_rate_card WHERE " . $condition;
                $command = Yii::app()->db->createCommand($sql);
                $rows = $command->queryAll();    

                $sql = "INSERT INTO c_rate_card SET 
                month=:month
                , year=:year
                , telco=:telco
                , telco_name=:telco_name
                , money=:money
                , rate_of_telco=:rate_of_telco
                ";
                $command = Yii::app()->db->createCommand($sql);
                foreach($rows as $row){
                    $row["month"] = $next_month;
                    $row["year"] = $next_year;
                    $command->bindValues($row);                
                    $result = $command->execute();
                }
            } else {
                $result = -1;
            }

            return $result;    
        }

        public function buildRateService($month, $year, $next_month, $next_year)
        {
            /* Kiểm tra xem tháng tiếp theo đã có rate chưa */
            $next_condition = " month=" . $next_month . " AND year=" . $next_year;
            $sql = "SELECT count(id) FROM c_rate_service_code WHERE " . $next_condition;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();

            /* Nếu chưa có thì insert */
            if($rows["count(id)"] == 0){
                $condition = " month=" . $month . " AND year=" . $year;
                $sql = "SELECT money, rate_of_service_code FROM c_rate_service_code WHERE " . $condition;
                $command = Yii::app()->db->createCommand($sql);
                $rows = $command->queryAll();    

                $sql = "INSERT INTO c_rate_service_code SET 
                month=:month
                , year=:year
                , money=:money
                , rate_of_service_code=:rate_of_service_code
                ";
                $command = Yii::app()->db->createCommand($sql);
                foreach($rows as $row){
                    $row["month"] = $next_month;
                    $row["year"] = $next_year;
                    $command->bindValues($row);                
                    $result = $command->execute();
                }
            } else {
                $result = -1;
            }

            return $result;   
        }

        public function getDataByMonthAndYear($month,$year){
            $sql = "SELECT * FROM c_rate WHERE month = ".intval($month)." AND year = ".intval($year)."";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
    }
?>