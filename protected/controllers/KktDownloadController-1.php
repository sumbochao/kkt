<?php
    class KktDownloadController extends Controller
    {
        public $layout = false;
        public $output = array();
        public function actionUpdateVersionApp(){
            $type = isset($_GET["type"]) ? intval($_GET["type"]):0; 
            $refCode = isset($_GET["refCode"]) ? Common::cleanQuery($_GET["refCode"]):""; 
            if($type >0 && $refCode !=""){
                $data_user = User::getUserByRefCode($refCode);
                if($data_user){
                    $username = $data_user["username"];
                    $filename = Common::genFilenameApp($type);
                    $extension = Common::detectFileExtension();
                    if(empty($extension)){
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Hiện tại chúng tôi chưa hỗ trợ cho dòng máy này. Chúng tôi sẽ cập nhật trong thời gian tới";   
                    } else {                                                                                                  
                        if("ipa"!=$extension)
					       {
					       	    $filename .= "." . $extension;     
					        	$url_download=Common::getApp($username,"GirlXinh.apk");
					        	//$urlFile = Common::getImage($filename, "user/" . $username, "", "");    
					       }else
					       {
					        	$url_download="itms-services://?action=download-manifest&url=".Common::getApp($username,$filename.".plist");
					        	//echo $url_download; die;
					       }
					       $this->redirect($url_download);  
                    }
                }else{
                    $this->output["status"] = false;
                }
            }else{
                $this->output["status"] = false; 
            }
            echo json_encode($this->output);
        }
        public function actionApp()
        {
            if(isset($_GET["id"]) && isset($_GET["username"])) {            
                $appId = intval($_GET["id"]);
                $app = User::getInfoApp($appId);
                $username = $_GET["username"];

                if(!empty($app)){                                
                    //Cập nhật số lần download
                    User::UpdateDownloadApp($appId);

                    /* get filename without extension by type application */
                    $filename = Common::genFilenameApp($app["type"]);

                    /* get file extension for device remote */
                    $extension = Common::detectFileExtension();
                    if(empty($extension)){
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Hiện tại chúng tôi chưa hỗ trợ cho dòng máy này. Chúng tôi sẽ cập nhật trong thời gian tới";   
                    } else {

                        $filename .= "." . $extension;
                        $urlFile = Common::getImage($filename, "user/" . $username, "", "");                                
                        $this->redirect($urlFile);    
                        /*
                        header("Pragma: public");
                        header("Content-type: text/vnd.sun.j2me.app-descriptor; ");
                        header('Content-Disposition: attachment; filename="' . Common::generate_slug($app["title"]) . $file["ext"] . '"');
                        header('Content-Transfer-Encoding: binary');
                        ob_clean();
                        flush();
                        $content = file_get_contents($urlFile);
                        echo $content;
                        */

                    }
                } else {
                    $this->output["status"] = false;
                }                
            } else {
                $this->output["status"] = false;
            }            
            echo json_encode($this->output);
        }

        public function actionHotHome()
        {
            $type = isset($_GET["type"]) ? intval($_GET["type"]) : 0;
            $alias = isset($_GET["alias"]) ? trim($_GET["alias"]) :" ";
            $app = User::getInfoAppByType($type);
            if(!empty($app)){                                
                //Cập nhật số lần download
                User::UpdateDownloadApp($app["id"]);

                $file = Common::genFilenameApp($type);
                $urlFile = Common::getImage($file["filename"], "app", "", "");
                $this->redirect($urlFile);
                //header("Content-disposition: attachment; filename=" . $alias . $file["ext"]);
                //            header('Content-type: application/octet-stream');
                //            readfile($urlFile);                
            } else {
                $this->output["status"] = false;
            }
        }

        public function actionDownloadMyAdv()
        {
            if(isset($_GET["id"])) {
                $myAdvId = intval($_GET["id"]);
                $adv = User::getMyAdv($myAdvId);

                if(!empty($adv)){                                
                    /* Cập nhật số lần download quảng cáo của thành viên */
                    User::UpdateDownloadMyAdv($myAdvId);

                    /* get filename without extension by type application */
                    $filename = Common::genFilenameApp($adv["type"]);

                    /* get file extension for device remote */
                    $extension = Common::detectFileExtension();

                    if(empty($extension)){
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Hiện tại chúng tôi chưa hỗ trợ cho dòng máy này. Chúng tôi sẽ cập nhật trong thời gian tới";   
                    } else {

                        $filename .= "." . $extension;
                        $urlFile = Common::getImage($filename, "user/" . $adv["username"], "", "");
                        $this->redirect($urlFile);

                    }                                                    
                } else {
                    $this->output["status"] = false;
                }                
            } else {
                $this->output["status"] = false;
            }            
            echo json_encode($this->output);
        } 

        public function actionImage()
        {
            if(isset($_GET["id"]) && isset($_GET["dataId"])) {        
                $imageId = Common::decodeHex($_GET["id"]);
                $dataId = Common::decodeHex($_GET["dataId"]);

                /* Lấy thông tin về số lần download */
                $dataDownload = Download::getDataDownload($dataId);

                /* Lấy thông tin về ảnh */
                $image = Download::getImage($imageId);

                if(empty($dataDownload) || empty($image) || (!empty($dataDownload) & !empty($image) && $dataDownload["dataId"]!=$image["albumId"])){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                    echo "Link download không tồn tại hoặc file đã bị remove";   
                } else {
                    $imageDownload = Download::getImageDownload($imageId, $dataDownload["transactionId"]);
                    if($imageDownload["count"]>=3){
                        $this->output["status"] = false;    
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Mỗi ảnh chỉ được tải 3 lần. Bạn đã hết số lần tải ảnh này";
                    } else {
                        /* Cập nhật số lần download cho các bảng */
                        $result = Download::updateDownloadImage($image["albumId"], $imageId, $dataDownload["transactionId"]);

                        $urlFile = Common::getImage($image["file"], "image", $image["create_date"], "");

                        $upload_dir = getcwd() . "/upload/image/";                    
                        $upload_dir .= date("Y/md/", $image["create_date"]) . $image["file"];                    

                        $this->redirect($urlFile);
                        //header("Pragma: public");
                        //                    header('Content-Disposition: attachment; filename="' . $image["file"] . '"');
                        //                    header("Content-type: " . mime_content_type($upload_dir));
                        //                    header('Content-Transfer-Encoding: binary');
                        //                    ob_clean();
                        //                    flush();
                        //                    readfile($urlFile);
                    }
                }                                        
            } else {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                echo "Link download không tồn tại hoặc file đã bị remove";        
            }            
        }

        public function actionGame()
        {
            if(isset($_GET["id"]) && isset($_GET["dataId"])) {

                $gameId = Common::decodeHex($_GET["id"]);
                $dataId = Common::decodeHex($_GET["dataId"]);

                /* Lấy thông tin về số lần download */
                $dataDownload = Download::getDataDownload($dataId);

                /* Lấy thông tin về game và file_game */
                $game = Download::getGame($gameId);

                if(empty($dataDownload) || empty($game) || (!empty($dataDownload) & !empty($game) && $dataDownload["dataId"]!=$game["id"])){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                    echo "Link download không tồn tại hoặc file đã bị remove";   
                } else {                
                    if($dataDownload["count"]>=3){
                        $this->output["status"] = false;    
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Mỗi game chỉ được tải 3 lần. Bạn đã hết số lần tải game này.";
                    } else {
                        /* Lấy thông tin về file của game */
                        $gameFile = Download::getGameFile($gameId);

                        /* Cập nhật số lần download cho các bảng */
                        $result = Download::updateDownloadGame($gameId, $gameFile["id"], $dataDownload["transactionId"]);

                        $urlFile = Common::getImage($gameFile["filename"], "game", $gameFile["create_date"], "");
                        $this->redirect($urlFile);
                        //$ext = end(explode(".", $gameFile["filename"]));
                        //                    header("Content-disposition: attachment; filename=" . Common::generate_slug($game["title"]) . "." . $ext);
                        //                    header('Content-type: application/octet-stream');
                        //                    readfile($urlFile);                    
                    }
                }                                        
            } else {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                echo "Link download không tồn tại hoặc file đã bị remove";        
            }       
        }

        public function actionVideo()
        {        
            if(isset($_GET["id"]) && isset($_GET["dataId"])) {        
                $videoId = Common::decodeHex($_GET["id"]);
                $dataId = Common::decodeHex($_GET["dataId"]);

                /* Lấy thông tin về số lần download */
                $dataDownload = Download::getDataDownload($dataId);

                /* Lấy thông tin về game và file_game */
                $video = Download::getVideo($videoId);

                if(empty($dataDownload) || empty($video) || (!empty($dataDownload) & !empty($video) && $dataDownload["dataId"]!=$video["id"])){
                    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                    echo "Link download không tồn tại hoặc file đã bị remove";   
                } else {                
                    if($dataDownload["count"]>=3){
                        $this->output["status"] = false;    
                        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                        echo "Mỗi video chỉ được tải 3 lần. Bạn đã hết số lần tải video này.";
                    } else {

                        /* Cập nhật số lần download cho các bảng */
                        $result = Download::updateDownloadVideo($videoId, $dataDownload["transactionId"]);
                        if(preg_match('/\b(ios)\b/i', $_SERVER['HTTP_USER_AGENT'])){
                            $urlFile = Common::getImage($video["file_mp4"], "video", $video["create_date"], "");
                            $ext = end(explode(".", $video["file_mp4"]));
                        }else{
                            $urlFile = Common::getImage($video["file"], "video", $video["create_date"], "");
                            $ext = end(explode(".", $video["file"]));
                        }


                        $upload_dir = getcwd() . "/upload/video/";                    
                        $upload_dir .= date("Y/md/", $video["create_date"]) . $video["file"];                    

                        header("Pragma: public");
                        header('Content-Disposition: attachment; filename="' . Common::generate_slug($video["title"]) . "." . $ext . '"');
                        header("Content-type: " . mime_content_type($upload_dir));
                        header('Content-Transfer-Encoding: binary');
                        ob_clean();
                        flush();
                        readfile($urlFile);                     
                    }
                }                                        
            } else {
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
                echo "Link download không tồn tại hoặc file đã bị remove";        
            }    
        }   
    }
?>