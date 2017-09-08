<?php
    class FCampaignLog extends CActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getLog($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "SELECT * FROM vtc_adv_facebook.campaign_invited_log WHERE campaign_id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public function deleteLog($id)
        {
            $connect = Yii::app()->db_facebook;
            $sql = "DELETE FROM vtc_adv_facebook.campaign_invited_log WHERE campaign_id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
