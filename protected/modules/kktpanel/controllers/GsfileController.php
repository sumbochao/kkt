<?php

    class GsfileController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Game File','link'=>$url->createUrl("gsfile/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS game file','link'=>'#','class'=>'active');
            $game_id = isset($_GET['id'])? intval($_GET['id']): "";
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
            list($max_page,$count,$data) = GFile::getAllFile($game_id,$page,$type,$row_per_page);
            $game = GGame::getDataById($game_id);
           
            $this->render("index",array('game_id'=>$game_id,'type'=>$type,'page'=>$page,'max_page'=>$max_page,'count'=>$count,'data'=>$data,'game'=>$game));
        }

        public function actionCreateApk()
        {
            $game_id = isset($_GET['game_id'])? intval($_GET['game_id']): "";
           
            $this->render("createapk",array('game_id'=>$game_id));
        }

        public function actionCreateIos()
        {
            $game_id = isset($_GET['game_id'])? intval($_GET['game_id']): "";
            $this->render("createios",array('game_id'=>$game_id));
        }

        public function actionCreateLink()
        {
            $game_id = isset($_GET['game_id'])? intval($_GET['game_id']): "";
            
            $this->render("createlink",array('game_id'=>$game_id));
        }

        public function actionAjaxSaveApk()
        {
            $time_now = date('Y-m-d H:i:s');
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $size = isset($_POST['size'])? trim(strip_tags($_POST['size'])): "";
            $version = isset($_POST['version'])? trim(strip_tags($_POST['version'])): "";
            $version_os = isset($_POST['version_os'])? trim(strip_tags($_POST['version_os'])): "";
            $game_id = isset($_POST['game_id'])? intval($_POST['game_id']): "";
            $is_play = 0;

            if($name == "")
            {
                echo "Chưa upload file"; exit;
            }
            if($version == "")
            {
                echo "Phiên bản không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version))
            {
                echo "Phiên bản chỉ chứa số và dấu chấm";exit;
            }
            if($version_os == "")
            {
                echo "Hệ điều hành không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version_os))
            {
                echo "Hệ điều hành chỉ chứa số và dấu chấm";exit;
            }

            $file_path = Yii::app()->params['urlImages']."gamestore/game/".date("Y/md",time())."/".$name;
            $os_type = 2;
            $new_version =$version;
            $data = GGame::getDataById($game_id);
            $old_version =$data['version_android'];
           
            if(empty($old_version))
            {
                $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size);  
            }
            else
            {
                if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                {
                    echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                }else{
                    $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size);     
                }
            }

            $result = GFile::insertGameApk($game_id,$file_path,$os_type,$is_play,$version,$version_os,$time_now,$size);

            if($result >0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxSaveIos()
        {
            $time_now = date('Y-m-d H:i:s');
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $file_plist = isset($_POST['file_plist'])? trim(strip_tags($_POST['file_plist'])): "";
            $size = isset($_POST['size'])? trim(strip_tags($_POST['size'])): "";
            $version = isset($_POST['version'])? trim(strip_tags($_POST['version'])): "";
            $version_os = isset($_POST['version_os'])? trim(strip_tags($_POST['version_os'])): "";
            $game_id = isset($_POST['game_id'])? intval($_POST['game_id']): "";
            $is_play = 0;
           
            if($name == "")
            {
                echo "Chưa upload file"; exit;
            }
            if($file_plist == "")
            {
                echo "Chưa upload file plist"; exit;
            }
            if($version == "")
            {
                echo "Phiên bản không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version))
            {
                echo "Phiên bản chỉ chứa số và dấu chấm";exit;
            }
            if($version_os == "")
            {
                echo "Hệ điều hành không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version_os))
            {
                echo "Hệ điều hành chỉ chứa số và dấu chấm";exit;
            }
            $file_plist = Yii::app()->params['urlImagesHttps']."gamestore/game/".date("Y/md",time())."/".$file_plist;
            $file_path = Yii::app()->params['urlImages']."gamestore/game/".date("Y/md",time())."/".$name;
            $os_type = 3;
            $new_version = $version;
            $data = GGame::getDataById($game_id);
            $old_version = $data['version_ios'];
           

            if(empty($old_version))
            {
                $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);  
            }
            else
            {
                if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                {
                    echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                }
                else{
                     $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);    
                }
            }

            $result = GFile::insertGameIos($game_id,$file_path,$os_type,$is_play,$version,$version_os,$time_now,$size,$file_plist);

            if($result >0)
            {
                echo $result;exit;
            }

        }
        
        public function  checkVersionFile($new_version,$older_version){
   
            $new_version = explode(".",$new_version);
            $older_version = explode(".",$older_version);
            
            $i = 0;$kq = 1;
            $size = count($new_version)<count($older_version)?count($older_version):count($new_version);
            while($i<$size){
                $ver0 = empty($older_version[$i]) ?0:$older_version[$i];
                $ver1 = empty($new_version[$i]) ?0:$new_version[$i];
                
                if($ver1>$ver0){
                    $kq = 1;
                    break;
                }
                
                if($ver1<$ver0){
                    $kq = 0;
                    break;
                }
                
                $i++;
            }
            
            return $kq;
    }
    
        public function actionAjaxSaveLink()
        {
            $time_now = date('Y-m-d H:i:s');
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $size = isset($_POST['size'])? trim(strip_tags($_POST['size'])): "";
            $version = isset($_POST['version'])? trim(strip_tags($_POST['version'])): "";
            $version_os = isset($_POST['version_os'])? trim(strip_tags($_POST['version_os'])): "";
            $link = isset($_POST['link'])? trim(strip_tags($_POST['link'])): "";
            $game_id = isset($_POST['game_id'])? intval($_POST['game_id']): "";
            $is_play = 1;
            if($link == "")
            {
                echo "Chưa nhập link"; exit;
            }
            if($version == "")
            {
                echo "Phiên bản không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version))
            {
                echo "Phiên bản chỉ chứa số và dấu chấm";exit;
            }
            if($version_os == "")
            {
                echo "Hệ điều hành không được để trống";exit;
            }
            if(!preg_match('/^[0-9.]*$/',$version_os))
            {
                echo "Hệ điều hành chỉ chứa số và dấu chấm";exit;
            }
            
            if(strpos($link,"apk"))
            {
                $os_type = 2;
                $new_version =$version;
                $data = GGame::getDataById($game_id);
                $old_version =$data['version_android'];
                

                if($old_version[0] == "")
                {
                    $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size);  
                }
                else
                {
                    if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                    {
                        echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                    }else{
                         $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size); 
                    }
                }

            }
            
            
            if(strpos($link,"play.google.com"))
            {
                $os_type = 2;
                $new_version = $version;
                $data = GGame::getDataById($game_id);
                $old_version =$data['version_android'];
              

                if($old_version[0] == "")
                {
                    $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size);   
                }
                else
                {
                    if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                    {
                        echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                    }
                    else{
                         $result = GGame::updateVersionAndroid($game_id,$version,$version_os,$size);    
                        
                    }
                }


            }
            
       
            if(strpos($link,"ipa"))
            {
                $os_type = 3;
                $new_version = $version;
                $data = GGame::getDataById($game_id);
                $old_version =$data['version_ios'];
              

                if($old_version[0] == "")
                {
                    $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);  
                }
                else
                {
                    if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                    {
                        echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                    }
                    else{
                        $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);    
                    }
                }

            }
          
            if(strpos($link,"itunes.apple.com"))
            {
                $os_type = 3;
                $new_version =$version;
                $data = GGame::getDataById($game_id);
                $old_version =$data['version_ios'];
                
                if($old_version[0] == "")
                {
                    $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);   
                }
                else
                {
                    if(GsfileController::checkVersionFile($new_version,$old_version)==0)
                    {
                        echo "Phiên bản đã cũ. Bạn cần cập nhật phiên bản mới nhất";exit;
                    }
                    else
                    {
                         $result = GGame::updateVersionIos($game_id,$version,$version_os,$size);    
                       
                    }
                }

            }
             
            if(strpos($link,"plist"))
            {
                $os_type = 3;
            }
            if(empty($os_type))
            {
                echo "Link chưa đúng định dạng";exit;
            }

            $result = GFile::insertGameLink($game_id,$link,$os_type,$is_play,$version,$version_os,$time_now,$size);
            if($result >0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxDeleteFile()
        {
            $link = isset($_POST['link'])? $_POST['link']: "";
            $location = getcwd();
            $location .= "/".$link;
            $result = @unlink($location);
            echo 1;exit;
        }

        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? $_POST['id']: "";
            $game = GFile::getFileById($id);
            
            $game["file_path"] = $_SERVER['DOCUMENT_ROOT'].preg_replace('/^h(.*).com/i',"", $game["file_path"]);
            $game["file_plist"] =$_SERVER['DOCUMENT_ROOT'].preg_replace('/^h(.*).com/i',"", $game["file_plist"]);
            
           
            if($game["is_play"]==0){
                @unlink($game["file_path"]);
                @unlink($game["file_plist"]);
            }
           
            $result = GFile::deleteData($id);
            if($result >0)
            {
                echo $result;exit;
            }
        }

    }

?>
