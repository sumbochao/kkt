<?php
    class Ketqua_miennam extends CActiveRecord
    {
        
        public static function getDataToDay($province_id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_miennam WHERE province_id=$province_id ORDER BY id DESC";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataOtherDay($date,$province_id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_miennam WHERE ngay_quay='$date' AND province_id=$province_id ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataByDay($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_miennam WHERE ngay_quay='$date' ";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getDataByProvince($province,$ngay_quay,$quay,$truoc)
        {
            if($truoc == 0)
            {
                $date = "AND ngay_quay<='$ngay_quay'";
                $order = "DESC";
            }
            else
            {
                $date = "AND ngay_quay>='$ngay_quay'";
                $order = "ASC";
            }
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_miennam WHERE province_id=$province ".$date." ORDER BY ngay_quay ".$order." LIMIT $quay";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>