<?php
    class ShopDomain extends CActiveRecord
    {
        public function getDomainByUser($user_id){
            $cacheService = new CacheService("ShopDomain","getDomainByUser",$user_id);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_shop_domain 
                WHERE user_id=".$user_id." ORDER BY date_create DESC";
                $command=$connect->createCommand($sql);
                $rows = $command->queryAll();
                Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $rows=$cache;
            }
            return $rows;
        }
        public function getOneDomain($domain){
            $cacheService = new CacheService("ShopDomain","getOneDomain",$domain);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_shop_domain 
                WHERE domain ='".$domain."'";
                $command=$connect->createCommand($sql);
                $row = $command->queryRow();
                Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_86400);
            }
            else
            {
                $row=$cache;
            }
            return $row;
        }        

    }
?>