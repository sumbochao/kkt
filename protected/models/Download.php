<?php
    class Download extends CActiveRecord
    {
        public function getDataDownload($dataId)
        {
            $sql = "SELECT dataId, appRegisterId, transactionId, count FROM c_data_download WHERE id=" . $dataId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;
        }

        public function getImageDownload($imageId, $transactionId)
        {
            $sql = "SELECT count FROM c_data_download_image WHERE imageId=" . $imageId . " AND transactionId=" . $transactionId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;    
        }

        public function getImage($imageId)
        {
            $sql = "SELECT albumId, file, create_date FROM c_image WHERE id=" . $imageId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;    
        }

        public function updateDownloadImage($albumId, $imageId, $transactionId)
        {
            /* Cập nhật download cho album */
            $sql = "UPDATE c_album SET download=(download + 1) WHERE id=" . $albumId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho image */
            $sql = "UPDATE c_image SET download=(download + 1) WHERE id=" . $imageId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho bang data */
            $sql = "UPDATE c_data SET download=(download + 1) WHERE dataId=" . $albumId . " AND type=3";
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho data download */
            $sql = "UPDATE c_data_download SET count=(count + 1) WHERE dataId=" . $albumId . " AND transactionId=" . $transactionId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho data download image */
            $sql = "UPDATE c_data_download_image SET count=(count + 1) WHERE imageId=" . $imageId . " AND transactionId=" . $transactionId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            return $result;
        }
        public function updateDownloadGame($gameId, $gameFileId, $transactionId)
        {
            /* Cập nhật download cho game */
            $sql = "UPDATE c_game SET download=(download + 1) WHERE id=" . $gameId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho game file */
            $sql = "UPDATE c_game_file SET download=(download + 1) WHERE id=" . $gameFileId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho bang data */
            $sql = "UPDATE c_data SET download=(download + 1) WHERE dataId=" . $gameId . " AND type=1";
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho data download */
            $sql = "UPDATE c_data_download SET count=(count + 1) WHERE dataId=" . $gameId . " AND transactionId=" . $transactionId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();        

            return $result;
        }

        public function updateDownloadVideo($videoId, $transactionId)
        {
            /* Cập nhật download cho video */
            $sql = "UPDATE c_video SET download=(download + 1) WHERE id=" . $videoId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();               

            /* Cập nhật download cho bang data */
            $sql = "UPDATE c_data SET download=(download + 1) WHERE dataId=" . $videoId . " AND type=2";
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho data download */
            $sql = "UPDATE c_data_download SET count=(count + 1) WHERE dataId=" . $videoId . " AND transactionId=" . $transactionId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();        

            return $result;    
        }

        public function getGame($gameId)
        {
            $sql = "SELECT id, title, isOnline, isSms FROM c_game WHERE id=" . $gameId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;
        }

        public function getGameFile($gameId)
        {
            $sql = "SELECT id, filename, create_date FROM c_game_file WHERE gameId=" . $gameId . " AND extension='jar'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;
        }

        public function getVideo($videoId)
        {
            $sql = "SELECT id, title, file,file_mp4, create_date FROM c_video WHERE id=" . $videoId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;   
        }

        public function getUserInfo($userId)
        {
            $sql = "SELECT id, username FROM c_user WHERE id=" . $userId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;       
        }

        public function getUserInfoByRefCode($refCode)
        {
            $sql = "SELECT id, username FROM c_user WHERE refCode='" . mysql_escape_string($refCode) . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;       
        }

        public function getListFileGame($mobileHandsetId)
        {
            $sql = "SELECT gameFileId FROM c_game_file_mobile_handset WHERE mobileHandsetId=" . $mobileHandsetId;
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryAll();
            $list_id = "";
            foreach($rows as $row) {
                $list_id .= "," . $row["gameFileId"];
            }
            $list_id = ltrim($list_id, ",");
            $list_id = Common::remove_duplicate($list_id);
            return $list_id;       
        }
        public function updateDownloadGameNew($gameId, $gameFileId)
        {
            /* Cập nhật download cho game */
            $sql = "UPDATE c_game SET download=(download + 1) WHERE id=" . $gameId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho game file */
            $sql = "UPDATE c_game_file SET download=(download + 1) WHERE id=" . $gameFileId;
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            /* Cập nhật download cho bang data */
            $sql = "UPDATE c_data SET download=(download + 1) WHERE dataId=" . $gameId . " AND type=1";
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();

            return $result;
        }
        public function getGameFileOffile($gameId, $extension)
        {
            $sql = "SELECT id, filename, create_date FROM c_game_file WHERE gameId=" . $gameId . " AND extension='" . $extension . "'";
            $command = Yii::app()->db->createCommand($sql);
            $rows = $command->queryRow();        
            return $rows;
        }
    }  
?>