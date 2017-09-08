<?php
class AGameFile extends CActiveRecord{
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }


    // goi den bang can ket noi   
    public function tableName() {                  
        return 'c_game_file';
    }
    public function getCountDataGroupByArrGame($arr_game){
        $str_game = implode(",",$arr_game);
        if($str_game !=""){
            $sql = "SELECT count(id) as count,gameId FROM c_game_file WHERE gameId IN (".$str_game.") GROUP BY gameId";
            $connect = Yii::app()->db;
            $command = $connect->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }else{
            return array();
        }
    }
    public function getDataByGame($gameId){
        $sql = "SELECT * FROM c_game_file WHERE gameId = ".intval($gameId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        return $data;
    }  
    public function getDataById($id){
        $sql = "SELECT * FROM c_game_file WHERE id = ".intval($id);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $data = $command->queryRow();
        return $data;
    }  

    public function updateStatusByGameId($gameId,$status){
        $sql = "UPDATE c_game_file SET status = ".intval($status)." WHERE gameId = ".intval($gameId);
        $connect = Yii::app()->db;
        $command = $connect->createCommand($sql);
        $result = $command->execute();
        return $result;
    }

    public function insertGameFile($gameId,$filename,$extension,$filesize,$introtext_file,$time_now,$device,$linkId=0,$supplier=0){
        /* them ds file game*/
        $result =0;
        $arr_handset = explode(";",$device);
        $data_handset = AMobileHandset::getAllData(1);
        $data_file_game = array(
        "gameId"=>array("value"=>$gameId,"type"=>1),
        "filename"=>array("value"=>$filename,"type"=>2),
        "extension"=>array("value"=>$extension,"type"=>2),
        "filesize"=>array("value"=>$filesize,"type"=>2),
        "introtext"=>array("value"=>$introtext_file,"type"=>2),
        "status"=>array("value"=>1,"type"=>1),
        "linkId"=>array("value"=>$linkId,"type"=>1),
        "supplier"=>array("value"=>$supplier,"type"=>1),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "update_date"=>array("value"=>$time_now,"type"=>1),
        );     
        $table = "c_game_file";
        $gameFileId = CommonDB::insertRow($table,$data_file_game);
        /* them game mobile handset*/
        for($i=0;$i<count($arr_handset);$i++){
            if(intval($arr_handset[$i]) > 0){
                $mobileHandsetId = intval($arr_handset[$i]);
                $data_game_handset = AGameFileMobileHandset::getDataByFileAndHandset($gameFileId,$mobileHandsetId);
                if(!$data_game_handset){
                    $last_id = AGameFileMobileHandset::insertData($gameFileId,$mobileHandsetId);
                    $result++;
                }
            }
        }
        return $result;
    }

    public function checkFileGame($gameId){
        $connect = Yii::app()->db;
        $sql = "SELECT filename,extension FROM c_game_file WHERE gameId = ".intval($gameId)." AND extension IN ('jad','jar') ";        
        $command = $connect->createCommand($sql);
        $data = $command->queryAll();
        if($data){
            foreach($data as $key=>$value){
                $base_name = explode(".",$value["filename"]);
                if($base_name[1]=="jar"){
                    $sql = "SELECT filename,extension FROM c_game_file WHERE filename = '".$base_name[0].".jad' AND gameId = ".intval($gameId); 
                    $command = $connect->createCommand($sql);
                    $data_sub = $command->queryRow();
                    if(!$data_sub){
                        $result = false;
                        break;
                    }
                }
                if($base_name[1]=="jad"){
                    $sql = "SELECT filename,extension FROM c_game_file WHERE filename = '".$base_name[0].".jar' AND gameId = ".intval($gameId); 
                    $command = $connect->createCommand($sql);
                    $data_sub = $command->queryRow();
                    if(!$data_sub){
                        $result = false;
                        break;
                    }
                }
                $result = true;
            }
        }else{
            $result = true;
        }
        if($result==false){
            $sql = "UPDATE c_game SET status = 0 WHERE id = ".intval($gameId);
            $command = $connect->createCommand($sql);
            $result1 = $command->execute();
        }
        return $result;
    }
}
