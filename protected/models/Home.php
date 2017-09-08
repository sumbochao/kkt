<?php
class Home extends CActiveRecord
{
    public function getTips()
    {
        $sql = "SELECT title, url FROM c_tips ORDER BY create_date DESC LIMIT 5";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;      
    }
    
    public function getChat()
    {
        $sql = "SELECT * FROM c_chat ORDER BY create_date DESC LIMIT 16";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();        
        return $rows;
    }
    
    public function InsertChat($data)
    {
        $sql = "INSERT INTO c_chat SET 
            userId=:userId
            , username=:username
            , content=:content
            , create_date=:create_date
        ";
        $command = Yii::app()->db->createCommand($sql);
        $command->bindValues($data);
        $result = $command->execute();
        return $result;
    }
    
    public function getPattern()
    {
        $sql = "SELECT keyword FROM c_blacklist";
        $command = Yii::app()->db->createCommand($sql);
        $rows = $command->queryAll();
        $blacklist = array();            
        foreach($rows as $i=>$row){
            $blacklist["pattern"][$i] = "/" . $row["keyword"] . "/si";
            $blacklist["replace"][$i] = "******";
        }
        return $blacklist;
    }
    public function updateTimeDownload($id,$type){
        switch($type){
            case 1:
                $table = "c_game";
                break; 
            case 2:
                $table = "c_video";
                break;
            case 3:
                $table = "c_album";
                break;
            default:
                $table = "";
                break;
        }
        if($table !=""){
            $sql = "UPDATE ".$table." SET time_download = ".time()." WHERE id =".intval($id);
            $command = Yii::app()->db->createCommand($sql);
            $result = $command->execute();
            return $result;
        }else{
            return 0;
        }
    }
}  
?>
