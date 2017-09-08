<?php
class BuildVankiemCommand extends CConsoleCommand
{
    public $file_user;
    public $file_orginal;
    public $http_file_orginal;
    public $http_file_user;
    public $userId;
    public $username;
    public $code;
    public $gameId = 145;
        
    public $file_build = "/upload/van_kiem_remote/";
    public $file_build_apk = "/upload/game_van_kiem_apk/";
    
    public $location = "/data/website/taoviec/taoviec.com";
    public $location_game = "/data/website/taoviec/taoviec.com/upload/game/";    
    public $location_user = "/data/website/taoviec/taoviec.com/upload/user/";
    
    //public $location = "D:/wamp/www/hdc/wapcontent";
//    public $location_game = "D:/wamp/www/hdc/wapcontent/upload/game/";    
//    public $location_user = "D:/wamp/www/hdc/wapcontent/upload/user/";
    
    public $build = true;
    
    public function run($args)
    {
        $user = Vankiem::getUserNotMap();

        if(!empty($user)){
            /* lây file game can build */
            $filegame = BuildGame::getFileGame($this->gameId);        

            $list_user_id = "0";
            foreach($user as $row){
                $this->userId = $row["id"];
                $this->username = $row["username"];
                
                /* Lay id cua van kiem van con trong */
                $vankiem = Vankiem::getCodeNotMap();            
                $this->code = $vankiem["code"];           
                
                foreach($filegame as $file){
                    
                    $this->file_user = $this->location_user . $row["username"] . "/game/" . $file["filename"];
                    $this->file_orginal = $this->location_game . date("Y/md", $file["create_date"]) . "/" . $file["filename"]; 
                    $this->http_file_orginal = Yii::app()->params["http_url"] . "/upload/game/" . date("Y/md", $file["create_date"]) . "/" . $file["filename"];                
                    $this->http_file_user = Yii::app()->params["http_url"] . "/upload/user/" . $row["username"] . "/game/" . $file["filename"];                
                    
                    if($file["extension"]=="jad"){
                        $result = $this->fileJad($file);
                    } else if($file["extension"]=="jar"){
                        $result = $this->fileJar($file);
                    } else if($file["extension"]=="apk"){
                        $result = $this->fileApk($file);     
                    }
                    echo $result;          
                }
                
                if($this->build){
                    /* map userId va id cua van kiem */
                    $result = Vankiem::MapUserByCode($this->userId, $this->username, $vankiem["id"]); 
                    if($result>=0){
                        echo "Build game thanh cong cho user: " . $this->username . ". Cron Job At ".date("H:i:s - d/m/Y") . " \n";
                    } else {
                        echo "Phat sinh loi trong qua trinh build game cho user " . $this->username . ". Cron Job At ".date("H:i:s - d/m/Y") . " \n";
                    }
                } else {
                    echo "Phat sinh loi trong qua trinh build game cho user " . $this->username . ". Cron Job At ".date("H:i:s - d/m/Y") . " \n";
                }        
            }
        } else {
            echo "Khong phat sinh user. Cron Job At ".date("H:i:s - d/m/Y") . " \n";   
        }
            
    }
    
    public function fileJad($file)
    {
        /* nếu chưa tạo folder create folder */
        $location_user = $this->location_user . $this->username . "/game/";
        if(@chdir($location_user) == false) @mkdir($location_user, 0777, true);
        
        /* build file jar để lấy size gắn vào file jad */
        $filename_jar = basename($this->file_orginal, "." . $file["extension"]) . ".jar";
        $file_jar = BuildGame::getFile($this->gameId, $filename_jar);                    
        
        $http_jar_orginal = Yii::app()->params["http_url"] . "/upload/game/" . date("Y/md", $file_jar["create_date"]) . "/" . $file_jar["filename"];
        $file_jar_orginal = $this->location_game . date("Y/md", $file_jar["create_date"]) . "/" . $file_jar["filename"];                 
        
        $http_jar_user = Yii::app()->params["http_url"] . "/upload/user/" . $this->username . "/game/" . $file_jar["filename"];
        $file_jar_user = $this->location_user . $this->username . "/game/" . $file_jar["filename"];                 
           
        /* đường dẫn file gốc MANIFEST */
        $location_file_remote = $this->location . $this->file_build . $this->code . "/remote.bin";
                      
        /* đẩy file MANIFEST vào file jar */
        $zip = new ZipArchive;
        $res = $zip->open($file_jar_orginal, ZipArchive::CREATE);
        if ($res === TRUE) {
            $zip->addFile($location_file_remote, "remote.bin");
            @chmod($file_jar_orginal, 0644);
            @chown($file_jar_orginal, "apache:apache");
            $zip->close();   
        }
        
        /* Lấy kích thước file jar */
        $filesize_jar = filesize($file_jar_orginal);
        
        $file_jad = "";
        $f = fopen($this->file_orginal, "r");
        $isRefcode = false;
        while ($line = fgets($f)) {
            $line = str_replace(array("\r\n", "\r", "\n"), "", $line);
            
            if(preg_match("/MIDlet-Jar-URL/si", $line)){
                
                $line = "MIDlet-Jar-URL: " . $filename_jar;
                
            } else if(preg_match("/MIDlet-Jar-Size/si", $line)){
                
                $line = "MIDlet-Jar-Size: " . $filesize_jar;
                
            } 
            $file_jad .= $line . "\r\n";                   
        }
        
        $fp = fopen($this->file_user, "w");
        
        /* Nếu ko có quyên thì xóa file tạo lại */
        if(!$fp) @unlink($this->file_user);
        $fp = fopen($this->file_user, "w");
        
        if(@fwrite($fp, $file_jad)){                                                                        
            $result = "Build game file " . $file["filename"] . " thanh cong cho user " . $this->username . "\n";                        
        } else {
            $this->build = false;
            $result = "Khong build duoc game file " . $file["filename"] . " cho user " . $this->username . "\n";
        }                    
        @fclose($fp);
        
        return $result;
    }
    
    public function fileJar($file)
    {
        /* nếu chưa tạo folder create folder */
        $location_user = $this->location_user . $this->username . "/game/";
        if(@chdir($location_user) == false) @mkdir($location_user, 0777, true);
                
        /* đường dẫn file gốc remote.bin */
        $location_file_remote = $this->location . $this->file_build . $this->code . "/remote.bin";
                      
        /* đẩy file remote.bin vào file jar */
        $zip = new ZipArchive;
        $res = $zip->open($this->file_orginal, ZipArchive::CREATE);
        if ($res === TRUE) {
            $zip->addFile($location_file_remote, "remote.bin");
            @chmod($this->file_orginal, 0644);
            @chown($this->file_orginal, "apache:apache");
            $zip->close();   
        }
       
        @unlink($this->file_user);
        if(@copy($this->http_file_orginal, $this->file_user)){
            $result = "Build game file " . $file["filename"] . " thanh cong cho user " . $this->username . "\n";
        } else {
            $this->build = false;
            $result = "Khong build duoc game file " . $file["filename"] . " cho user " . $this->username . "\n";
        }
        
        return $result;
    }
    
    public function fileApk($file)
    {
        /* nếu chưa tạo folder create folder */
        $location_user = $this->location_user . $this->username . "/game/";
        if(@chdir($location_user) == false) @mkdir($location_user, 0777, true);
        
        /* điền lại mã vào file agent */        
        $file_apk = Yii::app()->params["http_url"] . $this->file_build_apk . $this->code . "/" . $file["filename"];

        @unlink($this->file_user);
        $resultCopy = copy($file_apk, $this->file_user);
        if($resultCopy){
            $result = "Build game file " . $file["filename"] . " thanh cong cho user " . $this->username . "\n";
        } else {
            $this->build = false;
            $result = "Khong build duoc game file " . $file["filename"] . " cho user " . $this->username . "\n";
        }
        
        return $result;   
    }
}
?>