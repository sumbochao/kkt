<?php
    class Thongke_loto_denky extends CActiveRecord
    {
        
        public static function getTKLotoDenKySoVoiKyGanNhat()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,boso,dodai_chuky,start_date,end_date,create_date,create_user FROM vtc_10h.thongke_loto_denky WHERE TYPE = 0";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKLotoDenKySoVoiKyCucDai()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,boso,dodai_chuky,start_date,end_date,create_date,create_user FROM vtc_10h.thongke_loto_denky WHERE TYPE = 1 ";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        
    }
?>
