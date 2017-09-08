<?php
class Data extends CActiveRecord
{
    public function getDataManyDownload($limit){
        $data = array();
        $cacheService = new CacheService("Data","getDataManyDownload",$limit);
        $key = $cacheService->createKey();
        $cache = Yii::app()->cache->get($key);
        $cache=false;
        if ($cache == false) 
        {
            $connect =Yii::app()->db;
            $sql = "SELECT categoryId,type,dataId,hit,download FROM c_data WHERE status = 1 ORDER by download DESC LIMIT ".$limit."";
            $command = $connect->createCommand($sql);
            $rows = $command->queryAll();

            for($i=0;$i<count($rows);$i++){
                if($rows[$i]["type"]==1){
                    $arr_game[] = $rows[$i]["dataId"];
                }elseif($rows[$i]["type"]==2){
                    $arr_video[] = $rows[$i]["dataId"];
                }elseif($rows[$i]["type"]==3){
                    $arr_image[] = $rows[$i]["dataId"];
                }
            }
            if(isset($arr_game)){
                $games = implode(",",$arr_game);
                $sql = "SELECT id,categoryId,title,alias,picture,download,hit,create_date FROM c_game WHERE id IN (".$games.")";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                for($i=0;$i<count($rows);$i++){ 
                    $rows[$i]["type"] = 1;
                    $data[] = $rows[$i];
                }
            }
            if(isset($arr_video)){
                $videos = implode(",",$arr_video);
                $sql = "SELECT id,categoryId,title,alias,picture,download,hit,create_date FROM c_video WHERE id IN (".$videos.")";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                for($i=0;$i<count($rows);$i++){ 
                    $rows[$i]["type"] = 2;
                    $data[] = $rows[$i];
                }
            }
            if(isset($arr_image)){
                $images = implode(",",$arr_image);
                $sql = "SELECT id,categoryId,title,alias,picture,download,hit,create_date FROM c_album WHERE id IN (".$images.")";
                $command = $connect->createCommand($sql);
                $rows = $command->queryAll();
                for($i=0;$i<count($rows);$i++){ 
                    $rows[$i]["type"] = 3;
                    $data[] = $rows[$i];
                }
            }
            Yii::app()->cache->set($key, $data, ConstantsUtil::TIME_CACHE_900);
        }
        else
        {
            $data=$cache;
        }
        return isset($data) ? $data:array();
    }
    public function getDataByDataId($dataId){
        $sql = "SELECT * FROM c_data WHERE dataId = ".intval($dataId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }
}
