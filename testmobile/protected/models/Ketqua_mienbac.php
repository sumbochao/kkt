<?php
    class Ketqua_mienbac extends CActiveRecord
    {
        
        public static function getDataToDay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_mienbac ORDER BY id DESC";
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataOtherDay($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_mienbac WHERE ngay_quay='$date' ";
            //var_dump($sql);
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getDataByProvince($province,$ngay_quay,$quay,$truoc)
        {
            
            if($truoc == 0)
            {
                $date = "ngay_quay<='$ngay_quay'";
                $order = "DESC";
            }
            else
            {
                $date = "ngay_quay>='$ngay_quay'";
                $order = "ASC";
            }
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM ketqua_mienbac WHERE ".$date." ORDER BY ngay_quay ".$order." LIMIT $quay";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKGiaiDacBietTheoNgay($ngay)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT giai_dacbiet,DATE_FORMAT(ngay_quay,'%w') as thu,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay,DATE_FORMAT(ngay_quay,'%Y') as nam FROM ketqua_mienbac WHERE DATE_FORMAT(ngay_quay,'%d-%m') = '$ngay' Order by ID DESC";
            //var_dump($sql);die;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
