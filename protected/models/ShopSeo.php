<?php
    class ShopSeo extends CActiveRecord
    {
        public function getDataByUserAndType($userId,$type){
            $cacheService = new CacheService("ShopSeo","getDataByUserAndType",$userId,$type);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_shop_seo 
                WHERE userId=".$userId." AND type = ".$type."";
                $command=$connect->createCommand($sql);
                $rows = $command->queryRow();
                Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $rows=$cache;
            }
            return $rows;
        }
        public function getDataByUsernameAndType($username,$type){
            $cacheService = new CacheService("ShopSeo","getDataByUsernameAndType",$username,$type);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_shop_seo 
                WHERE username='".$username."' AND type = ".$type."";
                $command=$connect->createCommand($sql);
                $rows = $command->queryRow();
                Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $rows=$cache;
            }
            return $rows;
        }
    }
?>
