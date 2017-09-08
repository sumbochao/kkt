<?php
    class GFile extends CActiveRecord
    {
        
        public function getDbConnection()
        {
            return self::getGameStoreDbConnection();
        }
        
        public function getAllFile($game_id,$page,$type,$row_per_page)
        {
            $str_sql = "";
            $str_order = " ORDER BY id DESC ";
            if($type > 0)
            {
                $str_sql .=" AND os_type=".$type;
            }
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT COUNT(id) as count FROM vtc_game_store.g_game_file WHERE 1 ".$str_sql." AND game_id=$game_id";
         
            $command = $connect->createCommand($sql);
            $data_count = $command->queryRow();
            $max_page = ceil(intval($data_count["count"])/$row_per_page);
            $first = ($page - 1)*$row_per_page;
            
            $sql = "SELECT * FROM vtc_game_store.g_game_file WHERE 1 ".$str_sql."  AND game_id=$game_id ".$str_order." LIMIT ".$first.",".$row_per_page."";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            
            return array($max_page,intval($data_count["count"]),$data);
        }
        
        public function insertGameApk($game_id,$file_path,$os_type,$is_play,$version,$version_os,$create_date,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_file(game_id,file_path,os_type,is_play,version,version_os,create_date,size) VALUES($game_id,'$file_path','$os_type',$is_play,'$version','$version_os','$create_date','$size')";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function insertGameIos($game_id,$file_path,$os_type,$is_play,$version,$version_os,$create_date,$size,$file_plist)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_file(game_id,file_path,os_type,is_play,version,version_os,create_date,size,file_plist) VALUES($game_id,'$file_path','$os_type',$is_play,'$version','$version_os','$create_date','$size','$file_plist')";
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function insertGameLink($game_id,$file_path,$os_type,$is_play,$version,$version_os,$create_date,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "INSERT INTO vtc_game_store.g_game_file(game_id,file_path,os_type,is_play,version,version_os,create_date,size) VALUES($game_id,'$file_path','$os_type',$is_play,'$version','$version_os','$create_date','$size')";
          //  echo $sql;exit;
           
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function getFileById($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game_file WHERE id='$id' ";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryRow();
            return $data;
        }
        
        public function getLinkById($id,$game_id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "SELECT * FROM vtc_game_store.g_game_file WHERE id='$id' AND game_id='$game_id'";
            
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }
        
        public function updateGameFile($id,$game_id,$file_path,$os_type,$is_play,$version,$version_os,$create_date,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game_file SET file_path='$file_path',os_type='$os_type',is_play='$is_play',version='$version',version_os='$version_os',update_date='$create_date',size='$size' WHERE id=$id AND game_id='$game_id' ";
        
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function updateGameLink($id,$game_id,$file_path,$os_type,$is_play,$version,$version_os,$create_date,$size)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "UPDATE vtc_game_store.g_game_file SET file_path='$file_path',os_type='$os_type',is_play='$is_play',version='$version',version_os='$version_os',update_date='$create_date',size='$size' WHERE id=$id AND game_id='$game_id' ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
        public function deleteData($id)
        {
            $connect = Yii::app()->db_gamestore;
            $sql = "DELETE FROM vtc_game_store.g_game_file WHERE id=$id ";
            $command = $connect->createCommand($sql);
            $data = $command->execute();
            return $data;
        }
        
    }
?>
