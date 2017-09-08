<?php
    class Thongke_loto_gan_cucdai extends CActiveRecord
    {
        
        public static function getTKLotoGanCucDai()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,boso,lanquay_cucdai,start_date,end_date,lanquay_chuave,ngay_quay,create_date,create_user FROM vtc_10h.thongke_loto_gan_cucdai";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
