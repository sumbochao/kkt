<?php
    class Report extends CActiveRecord
    {
        /* Thống kê doanh số cho thành viên */
        public function getReportByUser($type, $userId)
        {
            /* Lấy tỷ lệ ăn chia */
            $sql = "SELECT * FROM c_rate";        
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryAll();        
            $rate = array();
            foreach($rows as $row){
                $rate[$row["month"] . "_" . $row["year"]] = $row;
            }        

            $condition_date = "";        
            if($type==1)
            {
                /* Lấy doanh thu ngày hôm nay */
                $d = date("d");
                $m = date("m");
                $y = date("Y");

                $condition_date .= " AND day=" . $d;
                $condition_date .= " AND month=" . $m;
                $condition_date .= " AND year=" . $y;            
            } 
            else if($type==2)
                {
                    /* Lấy doanh thu ngày hôm qua */
                    $d = date("d", time() - 86400);
                    $m = date("m", time() - 86400);
                    $y = date("Y", time() - 86400);

                    $condition_date .= " AND day=" . $d;
                    $condition_date .= " AND month=" . $m;
                    $condition_date .= " AND year=" . $y;
                } 
                else if($type==3)
                    {
                        /* Lấy doanh thu 7 ngày gần đây */
                        $time = time() - 7 * 86400;
                        $condition_date .= " AND create_date>=" . $time;
                    }
                    else if($type==4)
                        {
                            /* Lấy doanh thu từ đầu tháng */            
                            $m = date("m");
                            $y = date("Y");
                            $time = strtotime("01-" . $m . "-" . $y . " 00:00:00");
                            $condition_date .= " AND create_date>=" . $time;
                        }
                        else if($type==5)
                            {
                                /* Lấy doanh thu tháng trước */            
                                $m = date("m");
                                $y = date("Y");
                                $end_time = strtotime("01-" . $m . "-" . $y . " 00:00:00");

                                if($m == 1){
                                    $m = 12;
                                    $y = $y - 1;   
                                } else {
                                    $m = $m - 1;
                                }
                                $start_time = strtotime("01-" . $m . "-" . $y . " 00:00:00");

                                $condition_date .= " AND create_date>=" . $start_time;
                                $condition_date .= " AND create_date<" . $end_time;
                            }
                            else if($type==6)
                                {
                                    /* Lấy tổng doanh thu */

                                }

                                $report = array();        
            $report["total_sms"] = 0;
            $report["total_card"] = 0;
            $report["total_money_sms"] = 0; // Doanh thu sau đầu số        
            $report["total_money_sms_user"] = 0; // Doanh thu sau đầu số        
            $report["total_money_card"] = 0; // Doanh thu sau telco        
            $report["total_money_card_user"] = 0; // Doanh thu sau telco
            $report["total_kkt"] = 0;
            /* Lấy số sms của video và ảnh trong bảng sms log */        
            $sql = "SELECT count(id), price, month, year FROM c_sms_log WHERE status=1 AND type!=1 AND userId=" . $userId . $condition_date . " GROUP BY month, year, price";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryAll();

            foreach($rows as $row){
                $index = $row["month"] . "_" . $row["year"];

                if(!isset($report[$row["price"]])) $report[$row["price"]] = 0;
                $report[$row["price"]] += $row["count(id)"];
                $report["total_sms"] += $row["count(id)"];                                                            

                $value = $row["count(id)"] * $row["price"] * 0.45 * 0.8;
                $report["total_money_sms"] += $value;
                $report["total_money_sms_user"] += $value * ($rate[$index]["rate_of_user"] / 100);
                $report["total_kkt"] +=  $value * ($rate[$index]["rate_of_taoviec"] / 100);                                            
            }                                                                         

            /* Lấy số sms của game trong bảng sms log */
            $sql = "SELECT count(id), price, dataId FROM c_sms_log WHERE status=1 AND type=1 AND userId=" . $userId . $condition_date . " GROUP BY dataId, price";
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
            foreach($rows as $row){
                if(!isset($report[$row["price"]])) $report[$row["price"]] = 0;        
                $report[$row["price"]] += $row["count(id)"];
                $report["total_sms"] += $row["count(id)"];                                    

                $value = $row["count(id)"] * $row["price"] * 0.45 * 0.8;
                $report["total_money_sms"] += $value;
                $report["total_money_sms_user"] += $value * ($row["percent_wapmaster"] / 100);
                $report["total_kkt"] +=  $value * ((100 - $row["percent_wapmaster"]) / 100);
            }

            /* Tính số thẻ và doanh thu card */
            $sql = "SELECT count(id), sum(price), dataId FROM c_card_log WHERE status=1 AND userId=" . $userId . $condition_date . " GROUP BY dataId";
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

            foreach($rows as $row){
                $report["total_card"] += $row["count(id)"];
                $report["total_money_card"] += $row["sum(price)"] * 0.8;
                $report["total_money_card_user"] += $row["sum(price)"] * ($row["percent_wapmaster"] / 100) * 0.8;                       
            }

            $report["total_money_sms"] = round($report["total_money_sms"]);        
            $report["total_money_sms_user"] = round($report["total_money_sms_user"]);        
            $report["total_money_card"] = round($report["total_money_card"]);        
            $report["total_money_card_user"] = round($report["total_money_card_user"]);
            $report["total_kkt"] = round($report["total_kkt"]);

            return $report;
        }   
    }
?>