<?php
class Category extends CActiveRecord
{
	/*Thong tin danh muc*/
	public function getCatInfo($cat_id)
	{
		$cacheService = new CacheService("Category","getCatInfo",$cat_id);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_category WHERE id=".$cat_id;
			$command=$connect->createCommand($sql);
			$row= $command->queryRow();
			Yii::app()->cache->set($key, $row, ConstantsUtil::TIME_CACHE_3600);
		}
		else
		{
			$row=$cache;
		}
		return $row;
	}
    public function getAllCategory($not_type =0){
            $cacheService = new CacheService("Category","getAllCategory");
            $key = $cacheService->createKey();
            $cache = Yii::app()->cache->get($key);
            $cache=false;
            $data = array();
            if ($cache == false) 
            {
                $connect =Yii::app()->db;
                if($not_type==0){
                    $sql="SELECT * FROM c_category ORDER BY order_cat ASC";
                }else{
                    $sql = "SELECT * FROM c_category WHERE type != ".intval($not_type)." ORDER BY order_cat ASC";
                }   
                $command=$connect->createCommand($sql);
                $rows= $command->queryAll();
                for($i=0;$i<count($rows);$i++){
                    $data[$rows[$i]["id"]] = $rows[$i];
                }
                Yii::app()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_3600);
            }
            else
            {
                $data=$cache;
            }
            return $data;
        }
	/*Thong tin danh muc*/
	public function getCatByType($type)
	{
		$cacheService = new CacheService("Category","getCatByType",$type);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_category WHERE type=".$type;
			$command=$connect->createCommand($sql);
			$rows= $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_3600);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
	public function getCatKenh18()
	{
		$cacheService = new CacheService("Category","getCatKenh18");
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
		$cache=false;
        if ($cache == false) 
		{
			$connect =Yii::app()->db;
			$sql="SELECT * FROM c_category WHERE isSex=1 GROUP BY type";
			$command=$connect->createCommand($sql);
			$rows= $command->queryAll();
			Yii::app()->cache->set($key, $rows, ConstantsUtil::TIME_CACHE_3600);
		}
		else
		{
			$rows=$cache;
		}
		return $rows;
	}
}
?>