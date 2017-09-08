<?php
    class Thongke_loto_mienbac extends CActiveRecord
    {
        
        public static function getDataToday($date)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT boso FROM thongke_loto_mienbac WHERE ngay_quay='$date' ";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        
        
        public static function countTongBoSoMoThuong()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getTK12BoSoRaNhieu()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT boso,COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10 GROUP BY boso Order by sl desc limit 12";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTK12BoSoRaIt()
        {
            $date = date("Y-m-d");
            $connect = Yii::app()->db;
            $sql = "SELECT boso,COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10 GROUP BY boso ORDER BY sl ASC LIMIT 12";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKBoSoRaLienTiep()
        {
            $now = date("Y-m-d");
            $connect = Yii::app()->db;
            $sql = "SELECT boso,start_date,end_date,LENGTH AS dodai_chuky FROM thongke_boso_ve_lientiep WHERE province_id = 1   AND LENGTH > 1 AND end_date >='$now' ORDER BY dodai_chuky DESC LIMIT 6";
            
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKBoSoMBGanTren10Ngay()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT DISTINCT boso,ngay_quay,DATEDIFF(CURRENT_DATE,ngay_quay) AS sn FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10 ORDER BY ngay_quay DESC LIMIT 6";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function countTongDauSoMoThuong()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT COUNT(dau_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public static function getTKDauSoMoThuong()
        {
            $now = "2014-03-20";
            $date = date("Y-m-d",strtotime("-10 days",strtotime($now)));
            $connect = Yii::app()->db;
            $sql = "SELECT dau_so,COUNT(dau_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10 GROUP BY dau_so ORDER BY dau_so";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public static function getTKDuoiSoMoThuong()
        {
            $now = "2014-03-20";
            $date = date("Y-m-d",strtotime("-10 days",strtotime($now)));
            $connect = Yii::app()->db;
            $sql = "SELECT dit_so,COUNT(dit_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<10 GROUP BY dit_so ORDER BY dit_so";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
    }
?>
