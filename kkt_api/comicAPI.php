<?php

    require_once("comicDAO.php");
	date_default_timezone_set('Asia/Saigon'); 
 
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    
   
    
    switch($action){
        case "getComicIndex" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";   
            $limit = isset($_GET['limit'])?$_GET['limit'] :"2";
            $output = getComicIndex($appId,$orderBy,$limit);
            echo json_encode($output);
            break;
        }
        case "getComicHotIndex" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";   
            $limit = isset($_GET['limit'])?$_GET['limit'] :"2";
            $output = getComicHotIndex($appId,$orderBy,$limit);
            echo json_encode($output);
            break;
        }
        case "getCategory" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $type = isset($_GET['type'])?$_GET['type'] :"6";
            $output = getCategory($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getComicDetail" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $content_id = isset($_GET['contentId'])?$_GET['contentId'] :"0";
            $arrs = getComicDetail($appId,$content_id);
            echo json_encode($arrs);  
            break;
        }
         case "getComicDetailAndChapter" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $content_id = isset($_GET['contentId'])?$_GET['contentId'] :"0";
            list($arr_comic,$arr_comic_chapter)  = getComicDetailAndChapter($appId,$content_id);
           
            $output = array();
            $output['comic']=$arr_comic;
            $output['chapters']=$arr_comic_chapter;
            echo json_encode($output);     
            break;
        }
        case "setComicHit" :{
            $content_id = isset($_GET['contentId'])?$_GET['contentId'] :"0";
            $output = setComicHit($content_id);
            break;
        }
        case "getSearch" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $keyword = isset($_GET['keyword'])?$_GET['keyword'] :"";
            $page = isset($_GET['page'])?$_GET['page'] :1;
            $limit = isset($_GET['limit'])?$_GET['limit'] :10;
            list($data,$max_page) = searchComic($appId,$keyword,$limit, $page );
           
            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            $output = array();
            $output['pages']=$arr;
            
            $output['data'] =$data;
            echo json_encode($output);  
            
            break;
        }
        case "getComicByCategory" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"0";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";
            $page = isset($_GET['page'])?$_GET['page'] :1;
            $limit = isset($_GET['limit'])?$_GET['limit'] :15;
            list($data,$max_page) = getComicByCategory($appId,$catId,$orderBy,$limit,$page);

            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            
            $output = array(); 
            $output['pages']=$arr;
            $output['data'] =$data;
            
            echo json_encode($output);  
            break;
        }
        
        case "getComicHotByCategory" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"64";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"0";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";
            $page = isset($_GET['page'])?$_GET['page'] :1;
            $limit = isset($_GET['limit'])?$_GET['limit'] :15;
            list($data,$max_page) = getComicHotByCategory($appId,$catId,$orderBy,$limit,$page);

            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            
            $output = array(); 
            $output['pages']=$arr;
            $output['data'] =$data;
            
            echo json_encode($output);  
            break;
        }
        
        case "getComicFile" :{
            $chapterId = isset($_GET['chapterId'])?$_GET['chapterId'] :"0";
            $get_by = isset($_GET['get_by'])?$_GET['get_by'] :"1";
            $output = getComicFile($chapterId,$get_by);
            echo json_encode($output);
            break;
        }
        //checkComicPayment
        case "checkPayment" :{
            $app_header = isset($_GET['appHeader'])?$_GET['appHeader'] :""; 
          //  echo "app_header:$app_header";  
            $comicId = isset($_GET['contentId'])?$_GET['contentId'] :"0";
            $userId = isset($_GET['userId'])?$_GET['userId'] :"0";
            $output = checkComicPayment($app_header,$comicId,$userId);
            echo $output;
            break;
        }
        //saveComicPayment
         case "savePayment" :{
            $mo = isset($_GET['mo'])?$_GET['mo'] :"";
            $serviceNumber = isset($_GET['serviceNumber'])?$_GET['serviceNumber'] :"0";
            $userId = isset($_GET['userId'])?$_GET['userId'] :"0";
            $arrMo = array(); 
            
            //var_dump($mo);die;
           
            //Mo format: IU1 3 COMIC-TTV UserID ComicID Refcode 
          //  writeLog($mo." | ".$serviceNumber);
            $dauso = substr($serviceNumber,1,1);
            if($mo!=""){
                    $arrMo = explode(" ", $mo);
                    $appHeader= $arrMo[2];
                    $userId= $arrMo[3];
                    $comicId= $arrMo[4];
                    $arrHeader = getAppHeader($appHeader) ;
                    $songay = 4;
                    switch (intval($dauso))
                    {
                        case 7:
                         $songay = 30;
                        break;
                        case 6:
                         $songay = 17;
                        break;
                        case 5:
                         $songay = 7;
                        break;
                     }
                   // var_dump($mo);die;
                    if($arrHeader!=Null && count ($arrHeader)>0) {
                           switch($arrHeader["type_payment"]){
                               case 1:// Time
                              
                                    $timeAdd = $songay*24*60*60;
                                    $arrPayment = getPaymentByTime($userId);
                                    // Had paymented
                                    if($arrPayment!=Null && count ($arrPayment)>0)
                                    {
                                            $expDate =   $arrPayment["exp_date"];
                                            $expDate = $expDate>time()?$expDate:time(); 
                                            $expDate +=    $timeAdd;
                                            updateExpDate($arrPayment["id"],$expDate) ;
                                    }else{ // Add new payment time
                                            $expDate = time()+$timeAdd;
                                            saveComicPayment(0,$userId,$expDate)  ;
                                    }
                                     break;
                                     
                               case 2:// Item
                                    saveComicPayment($comicId,$userId,0)  ;  
                                    break;
                           }
                    }
            }
            $mt = "Cam on ban da su dung dich vu doc truyen. Chuc ban co nhung phut giay thu gian vui ve.";
            echo $mt;
            // writeLog($mo." | ".$mt);
            break;
        }
        
        case "getAppHeader" :{
            $app_header = isset($_GET['appHeader'])?$_GET['appHeader'] :"";  
            $userId = isset($_GET['userId'])?$_GET['userId'] :"";
            if($userId==""){
               $arrAppHeader =  getAppHeader($app_header);
               $app_header_id =   $arrAppHeader["id"];
               $os =   $arrAppHeader["os"];
               $userId = saveCustomerId($os,$app_header_id) ;
               
               $output = array(); 
               $output['AppHeader']=$arrAppHeader;
               $output['UserId'] =$userId;
               echo json_encode($output);  
               
            }else{
               $arrAppHeader =  getAppHeader($app_header);
               $app_header_id =   $arrAppHeader["id"];
               $os =   $arrAppHeader["os"];
               
               $output = array(); 
               $output['AppHeader']=$arrAppHeader;
               $output['UserId'] =$userId;
               echo json_encode($output);  
            }
            break;
        }
        
        case "testGetSMS":{
            $arrSMS =array();
            $arrSMS[0]["PacketTitle"] ="Goi 7 ngay";
            $arrSMS[0]["Content"] ="IU1 3 COMIC-TTV UserID ComicID Refcode";
            $arrSMS[0]["ServiceNumber"] ="8041";
            $arrSMS[0]["CmdCode"] ="IU1";
            
            $arrSMS[1]["PacketTitle"] ="Goi 15 ngay";
            $arrSMS[1]["Content"] ="IU1 3 COMIC-TTV UserID ComicID Refcode";
            $arrSMS[1]["ServiceNumber"] ="8041";
            $arrSMS[1]["CmdCode"] ="IU1";
            
            $arrSMS[2]["PacketTitle"] ="Goi 30 ngay";
            $arrSMS[2]["Content"] ="IU1 3 COMIC-TTV UserID ComicID Refcode";
            $arrSMS[2]["ServiceNumber"] ="8041";
            $arrSMS[2]["CmdCode"] ="IU1";
            
              $output = array(); 
               $output['AppHeader']="TTV";
               $output['SMS'] =$arrSMS;
              echo json_encode($output)."<br>";  
            
            $arrSMS =array();
            $arrSMS["PacketTitle"] ="Goi 7 ngay";
            $arrSMS["Content"] ="IU1 3 COMIC-TTV UserID ComicID Refcode";
            $arrSMS["ServiceNumber"] ="8041";
            $arrSMS["CmdCode"] ="IU1";
                   $output = array(); 
               $output['AppHeader']="TTV";
               $output['SMS'] =$arrSMS;
              echo json_encode($output);
              
            break;
        }
    }

    
    
?>


<?php
 function writeLog($mo){
    $date = date('Y-m-d H:i:s');
    $file = dirname(__FILE__).'/log.txt';
    
    // Open the file to get existing content
    $current = file_get_contents($file);
    // Append a new person to the file
    $current .=$date."  :  ". $mo."\n";
    
    // Write the contents back to the file
    file_put_contents($file, $current,FILE_APPEND | LOCK_EX);
 }

?>
