<?php
    class FCampaign extends CActiveRecord
    {
        
        public function getAllData($page,$row_per_page,$keyword)
        {
            $str_sql = "";
            if($keyword != "")
            {
                $str_sql .= " AND title LIKE '%".$keyword."%' "; 
            }
            $str_order = " ORDER BY id DESC ";
            
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT COUNT(id) as count FROM vtc_adv_facebook.campaign_invited WHERE 1 ".$str_sql;
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_adv_facebook.campaign_invited WHERE 1 ".$str_sql." ".$str_order." LIMIT ".$first.",".$row_per_page."";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function deleteCampaign($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.campaign_invited WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
