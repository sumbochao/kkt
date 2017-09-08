<?php
class ShopConfig extends CActiveRecord
{
      public function getDataByUsername($username){
            $cacheService = new CacheService("ShopConfig","getDataByUsername",$username);
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                $sql="SELECT * FROM c_shop_config 
                WHERE username='".$username."'";
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
