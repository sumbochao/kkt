<?php
    class Province extends CActiveRecord
    {
        
        public static function getData()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,id FROM province";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataByName($name)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,region FROM province WHERE name='$name' ";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow($sql);
            return $data;
        }
        
        public static function getIdByMon($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu2=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdByTue($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu3=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdByWed($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu4=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdByThu($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu5=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdByFri($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu6=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdBySat($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu7=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getIdBySun($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM province WHERE thu8=1 AND region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getNameByRegion($region)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,name FROM province WHERE region=$region";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getNameByProvince($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,name,code FROM province WHERE id=$id";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow($sql);
            return $data;
        }
        
        public static function getDataByMon()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu2=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataByTue()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu3=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataByWed()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu4=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataByThu()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu5=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataByFri()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu6=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataBySat()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu7=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataBySun()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT name,code,region FROM province WHERE thu8=1";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll($sql);
            return $data;
        }
        
        public static function getDataById($id)
        {
            $connect = Yii::app()->db;
            $sql = "SELECT id,name,code,region FROM province WHERE id=$id";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryRow($sql);
            return $data;
        }
        
    }
?>
