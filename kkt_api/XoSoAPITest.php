<?php
    header('Content-type: text/html; charset=utf-8');       
    require_once("XoSoDAO1.php");
    require_once("AppHeaderDAO.php");
    require_once("function/utils.php");
    date_default_timezone_set('Asia/Saigon'); 
 
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    
    switch($action){
        case "getTTKQXS" :{
            $region = isset($_GET['region'])?$_GET['region'] :"1";
            if($region == 1)  {
                 $output = getTTKQXSMienBac();
               
            }else if($region==2)  {
                  $output = getTTKQXSMienTrung();
             } else{
                   $output = getTTKQXSMienNam();
            }      
            echo json_encode($output);
            break;
        }
        case "getKTXS" :{  
            $region = isset($_GET['region'])?$_GET['region'] :"1"; 
            $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
            $date = isset($_GET['date'])?$_GET['date'] :date("m/d/YY")  ; 
            $date = convertStrdmyyToyymd($date,"/");
            
            if($region == 1)  {
                  $output = getKQXSMienBac($date);
            }else if($region==2)  {
                  $output = getKQXSMienTrung($date,$provinceId);
             } else{
                   $output = getKQXSMienNam($date,$provinceId);
            }      
            echo json_encode($output);
            break;
          }
        case "getKTXSByRegion" :{  
            $region = isset($_GET['region'])?$_GET['region'] :"1"; 
            $fdate = isset($_GET['fDate'])?$_GET['fDate'] :date("d/m/YY")  ; 
            $tdate = isset($_GET['tDate'])?$_GET['tDate'] :date("d/m/YY")  ; 
            
            $fdate = convertStrdmyyToyymd($fdate,"/");
            $tdate = convertStrdmyyToyymd($tdate,"/");
            
            if($region == 1)  {
                  $output = getKQXSMienBacByTime($fdate,$tdate);
            }else if($region==2)  {
                  $output = getKQXSMienTrungByTime($fdate,$tdate);
             } else{
                   $output = getKQXSMienNamByTime($fdate,$tdate);
            }      
            echo json_encode($output);
            break;
          }
        case "getKTXSRegionNewest" :{  
            $region = isset($_GET['region'])?$_GET['region'] :"1"; 
            
            if($region == 1)  {
                  $output = getKQXSMienBacNewest();
            }else if($region==2)  {
                  $output = getKQXSMienTrungNewest();
             } else{
                   $output = getKQXSMienNamNewest();
            }      
            echo json_encode($output);
            break;
          }
        case "getDream": {
              $title = isset($_GET['title'])?$_GET['title'] :""; 
              $output = getDream($title); 
              echo json_encode($output);   
              break;      
        }
        case "getTKDauSoDangBang": {
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
            
              $output = getTKDauSoDangBang($provinceId,$fromDate,$toDate); 
              echo json_encode($output);  
             break;   
         }
         
         case "getTKDuoiSoDangBang": {
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
            
              $output = getTKDuoiSoDangBang($provinceId,$fromDate,$toDate); 
              echo json_encode($output);  
             break;   
         }
         
        case "getTKDauSo": {
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
            
              $output = getTKDauSo($provinceId,$fromDate,$toDate); 
              echo json_encode($output);    
              break;     
        }
        case "getTKDuoiSo": {
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $output = getTKDuoiSo($provinceId,$fromDate,$toDate); 
              echo json_encode($output); 
              break;        
        }
        case "getTKBoKep": {
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoKep($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output); 
              break;   
        }
        case "getTKBoSatKep": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoSatKep($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
         case "getTKTongChan": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
               
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKTongChan($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
        case "getTKTongLe": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKTongLe($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
        case "getTKBoChanLe": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoChanLe($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
        case "getTKBoLeChan": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoLeChan($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
          
        case "getProvince": {   
              getProvince(); 
              break;        
        }
        
        case "getDreamFile": {   
              getDreamFile(); 
              break;        
        }
        
        case "getTKBoChanChan": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoChanChan($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
        case "getTKBoLeLe": {   
              $provinceId = isset($_GET['provinceId'])?$_GET['provinceId'] :"1"; 
              $fromDate = isset($_GET['fromDate'])?$_GET['fromDate'] :date("m/d/YY")  ; 
              $fromDate = convertStrdmyyToyymd($fromDate,"/");
              $toDate = isset($_GET['toDate'])?$_GET['toDate'] :date("m/d/YY")  ; 
              $toDate = convertStrdmyyToyymd($toDate,"/");
              
              $isDacBiet = isset($_GET['isDacBiet'])?$_GET['isDacBiet'] :"0"; 
              $output = getTKBoLeLe($provinceId,$fromDate,$toDate,$isDacBiet); 
              echo json_encode($output);   
              break;        
        }
        
         case "getGameIPA": { 
              require_once("GameWapDAO.php");    
              $page = isset($_GET['page'])?$_GET['page'] :"1"; 
              $limit = isset($_GET['limit'])?$_GET['limit'] :"10"; 
             
              $outputGame = getGameIPA($page,$limit); 
              $outputGameCount  = countGameIPA() ;
              $arrOut = array();
              $arrOut["count"]  = $outputGameCount;
              $arrOut["games"]  = $outputGame;  
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getGameAPK": { 
              require_once("GameWapDAO.php");    
              $page = isset($_GET['page'])?$_GET['page'] :"1"; 
              $limit = isset($_GET['limit'])?$_GET['limit'] :"10"; 
             
              $outputGame = getGameAPK($page,$limit); 
              $outputGameCount  = countGameAPK() ;
              $arrOut = array();
              $arrOut["count"]  = $outputGameCount;
              $arrOut["games"]  = $outputGame;  
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getThreadHot": { 
              $arrOut = getThreadHot(); 
              echo json_encode($arrOut);   
              break;        
        }
        
         case "getThreadHotComment": {
              $page = isset($_GET['page'])?$_GET['page'] :"1"; 
              $id_thread = isset($_GET['id_thread'])?$_GET['id_thread'] :"1";  
              $limit = isset($_GET['limit'])?$_GET['limit'] :"10";  
              //$arrThread = getThreadHot();
              $arrComment = getThreadHotComment($id_thread,$page,$limit); 
              $count = countCommentThread($id_thread);
              $arrOut = array();
              $arrOut["count"]  = $count;
              $arrOut["comment"]  = $arrComment;
              
              echo json_encode($arrOut);   
              break;        
        }
        
        case "postComment": { 
            $id_thread = isset($_POST['id_thread'])?$_POST['id_thread'] :"";  
            $id_user = isset($_POST['id_user'])?$_POST['id_user'] :"";  
            $comment = isset($_POST['comment'])?$_POST['comment'] :"";  
            $username = isset($_POST['username'])?$_POST['username'] :"";
           
            if(empty($id_thread)||empty($id_user)||empty($comment)||empty($username)){
                 $arrOut = array();
                 $arrOut["result"]=1;
                 echo json_encode($arrOut);   
                 return;
            }
            
            $result = saveComment($id_thread,$id_user,$comment,$username); 
             
            if(!$result){
                  $arrOut = array();
                  $arrOut["result"]=2;
            }else{
                  $arrComment = getThreadHotComment($id_thread,1,10); 
                  $count = countCommentThread($id_thread);
                  $arrOut = array();
                  $arrOut["result"]=0;
                  $arrOut["count"]  = $count;
                  $arrOut["comment"]  = $arrComment;
            }
            
            echo json_encode($arrOut);   
            
            break;        
        }
        // Dich vu VIP
        case "getTKLotoGanCucDai": { 
              $arrOut = getTKLotoGanCucDai(); 
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getTKLotoDenKySoVoiKyGanNhat": { 
              $arrOut = getTKLotoDenKySoVoiKyGanNhat(); 
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getTKLotoDenKySoVoiKyCucDai": { 
              $arrOut = getTKLotoDenKySoVoiKyCucDai(); 
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getTKChuKyLoTo": {
              $boso = $_GET["boso"]; 
              $arrOut = getTKChuKyLoTo($boso,0); 
              echo json_encode($arrOut);   
              break;        
        }
        
        case "getTK12BoSoRaNhieu": {
              $songay = 60; 
              $arrOut = getTK12BoSoRaNhieu($songay); 
              $totalboso = countTongBoSoMoThuong($songay);
              $arrKQ = array();  
              foreach($arrOut as $row){
                    $row["percent"] = round( $row["sl"]/ $totalboso*100,2  );
                    $arrKQ[]   =  $row;
              }
              echo json_encode($arrKQ);   
              break;        
        }
        
         case "getTK12BoSoRaIt": {
              $songay = 60; 
              $arrOut = getTK12BoSoRaIt($songay); 
              $totalboso = countTongBoSoMoThuong($songay);
              $arrKQ = array();  
              foreach($arrOut as $row){
                    $row["percent"] = round( $row["sl"]/ $totalboso*100,2  );
                    $arrKQ[]   =  $row;
              }
              echo json_encode($arrKQ);   
              break;        
        }
        
         case "getTKBoSoRaLienTiep": {
              $arrOut = getTKBoSoRaLienTiep(); 
              echo json_encode($arrOut);   
              break;        
        }
        
        
       case "getTKDauSoMoThuong": {
              $songay = 60; 
              $arrOut = getTKDauSoMoThuong($songay); 
              $totalboso = countTongDauSoMoThuong($songay);
              $arrKQ = array();  
              foreach($arrOut as $row){
                    $row["percent"] = round( $row["sl"]/ $totalboso*100,2  );
                    $arrKQ[]   =  $row;
              }
              echo json_encode($arrKQ);   
              break;        
        }
        
        case "getTKDuoiSoMoThuong": {
              $songay = 60; 
              $arrOut = getTKDuoiSoMoThuong($songay); 
              $totalboso = countTongDuoiSoMoThuong($songay);
              $arrKQ = array();  
              foreach($arrOut as $row){
                    $row["percent"] = round( $row["sl"]/ $totalboso*100,2  );
                    $arrKQ[]   =  $row;
              }
              echo json_encode($arrKQ);   
              break;        
        } 
        
        case "getTKBoSoMBGanTren10Ngay": {
              $arrOut = getTKBoSoMBGanTren10Ngay(10); 
              echo json_encode($arrOut);   
              break;        
        }
        case "getTKGiaiDacBietTheoNgay": {
             $ngay_quay = date("d-m");
             $arrOut = getTKGiaiDacBietTheoNgay($ngay_quay); 
             echo json_encode($arrOut);   
             break;        
        }
         // App Header User
         case "getAppHeaderXoSo": {
              $app_header = isset($_GET['app_header'])?$_GET['app_header'] :"";
              $app_client_id = isset($_GET['app_client_id'])?$_GET['app_client_id'] :"0";
              
              if(empty($app_header)) echo ""; 
              else {
                  $arrOut = getAppHeaderXoSo($app_header,$app_client_id); 
                  echo json_encode($arrOut);   
              }
              
              break;        
        }
        case "getUserXoSo": {
            $app_client_id =   isset($_GET['app_client_id'])?$_GET['app_client_id'] :"";  
            if(empty($app_client_id)) {echo "";break; }
            $arrOut = getUserXoSo($app_client_id); 
            echo json_encode($arrOut);   
            break;        
        }
        
         case "getTaiKhoanChinh": {
            $app_client_id =   isset($_GET['app_client_id'])?$_GET['app_client_id'] :"";  
            if(empty($app_client_id)) {echo "";break; }
            $arrOut = getTaiKhoanChinh($app_client_id); 
            echo json_encode($arrOut);   
            break;        
        }
        
        case "getProvinceOpen": {
            $arrOut = getProvinceOpen($app_client_id); 
            echo json_encode($arrOut);   
            break;        
        }
        
        case "updateUserName": {
            $app_client_id =   isset($_GET['app_client_id'])?$_GET['app_client_id'] :"";
            $username =   isset($_GET['username'])?$_GET['username'] :"";
            if(empty($username)||empty($app_client_id)) {echo 1;return;}
            if(checkUserName($username)==1) {echo 2;return;}
            
            $arrOut = updateUserName($app_client_id,$username); 
            if(!$arrOut) {echo 3;return;} else echo 0;
            
            break;        
        }
        
        case "updateUser": {
            $app_client_id =   isset($_POST['app_client_id'])?$_POST['app_client_id'] :"";
          
            $username =   isset($_POST['username'])?$_POST['username'] :"";
            $fullname =   isset($_POST['fullname'])?$_POST['fullname'] :"";
            $email =   isset($_POST['email'])?$_POST['email'] :"";
            $address =   isset($_POST['address'])?$_POST['address'] :"";
            $mobile =   isset($_POST['mobile'])?$_POST['mobile'] :"";
            $mobile = formatMobile($mobile);
           
            if(empty($username)||empty($app_client_id)) {echo 1;return;}
            if(!isValidEmail($email)&&!empty($email)){echo 4;return;}// email khong dung dinh dang
            if(checkUserNameUpdateInfo($username)==1) {echo 2;return;}
            
            $arrOut = updateUser($app_client_id,$username,$fullname,$email,$mobile,$address); 
            
            if(!$arrOut) {echo 3;return;} else echo 0;
            
            break;        
        }
        
         case "uploadAvatar": {
            $app_client_id =   isset($_GET['app_client_id'])?$_GET['app_client_id'] :"";
            if(empty($app_client_id)) {echo 1;return;}
            uploadAvatar($app_client_id); 
            break;        
        }
        
        case "insertChat": {
            $app_client_id =   isset($_POST['app_client_id'])?$_POST['app_client_id'] :"";
            $content =   isset($_POST['content'])?$_POST['content'] :"";
            $deviceName =   isset($_POST['deviceName'])?$_POST['deviceName'] :"";
            $region =   isset($_POST['region'])?$_POST['region'] :"0";
            
            if(empty($app_client_id)||empty($content)||empty($deviceName)) {
                 $arrOut = array();
                 $arrOut["result"]  = 1;
                 echo json_encode($arrOut);
                 return;
            }
         
            $arrUser = getUserByAppClientId($app_client_id);
            if(empty($arrUser)){
                 $arrOut = array();
                 $arrOut["result"]  = 3;
                 echo json_encode($arrOut);
                 return;
            }
            
            $username=$arrUser["username"];
            $avatar_url =$arrUser["avatar_url "];
            
            $result = insertChat($app_client_id,$username,$avatar_url,$content,$deviceName,$region);
            
            if(!$result){
                  $arrOut = array();
                  $arrOut["result"]  = 2;
                  echo json_encode($arrOut);
            }else {
                  $outputCount = countChat($region); 
                  $outputChat  = getChatBox($region,1,50) ;
                  $arrOut = array();
                  $arrOut["result"]  = 0;
                  $arrOut["count"]  = $outputCount;
                  $arrOut["chat"]  = $outputChat;  
                  echo json_encode($arrOut);    
            }
            
            break;        
        }
        
         case "getChatBox": { 
              $page = isset($_GET['page'])?$_GET['page'] :"1"; 
              $limit = isset($_GET['limit'])?$_GET['limit'] :"10"; 
              $region = isset($_GET['region'])?$_GET['region'] :"0"; 
              //$outputCount = countChat($region); 
              $outputChat  = getChatBox($region,$page,$limit) ;
              $arrOut = array();
              $arrOut["count"]  = 0;
              $arrOut["chat"]  = $outputChat;  
              echo json_encode($arrOut);   
              break;        
        }
        
         case "getChatBoxFromID": { 
              $id = isset($_GET['id'])?$_GET['id'] :"10"; 
              $limit = isset($_GET['limit'])?$_GET['limit'] :"10"; 
              $region = isset($_GET['region'])?$_GET['region'] :"0"; 
              //$outputCount = countChat($region); 
              $outputChat  = getChatBoxFromID($id,$region,$limit) ;
              $arrOut = array();
              $arrOut["count"]  = 0;
              $arrOut["chat"]  = $outputChat;  
              echo json_encode($arrOut);   
              break;        
        }
        
        //http://stackoverflow.com/questions/1266176/upload-file-to-ftp-server-on-iphone
        //http://androidexample.com/Upload_File_To_Server_-_Android_Example/index.php?view=article_discription&aid=83&aaid=106
        
        default:  {
            echo '<header><meta content="text/html; charset=utf-8" http-equiv="Content-Type"></header>';
            echo "<h1>Danh sách Function:</h1>";
            echo "<h2 style='color:red'>getTTKQXS:</h2>";
            echo "<em>Tường thuật trực tiếp kết quả các giải miền bắc miền trung, miền nam.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTTKQXS</li>";  
            echo "<li>region: Mien 1: mien bac, 2 miền trung, 3 miền nam</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTTKQXS&region=1' target='_blank'>Tường thuật miền Bắc</a></span>" ;
            
            echo "<h1>API Kết Quả</h1>";  
            echo "<h2 style='color:red'>getKTXS:</h2>";
            echo "<em>Lấy kết quả xổ số các miền va tinh.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTTKQXS</li>";  
            echo "<li>region: Mien 1: mien bac, 2 miền trung, 3 miền nam</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>date: Ngày mở giải</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getKTXS&region=1&provinceId=1&date=02-01-2014' target='_blank'>Kết quả XS Miền Bắc</a></span>" ;
            
            
            echo "<h2 style='color:red'>getKTXSByRegion:</h2>";
            echo "<em>Lấy kết quả xổ số các miền.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getKTXSByRegion</li>";  
            echo "<li>region: Mien 1: mien bac, 2 miền trung, 3 miền nam</li>";  
            echo "<li>fDate: Ngày mở giải tu</li>";  
            echo "<li>tDate: Ngày mở giải den</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getKTXSByRegion&region=3&fDate=18/03/2014&tDate=20/03/2014' target='_blank'>Kết quả XS Miền Nam trong 3 ngay</a></span>" ;
            
            echo "<h2 style='color:red'>getKTXSRegionNewest:</h2>";
            echo "<em>Lấy kết quả xổ số mới nhất các miền.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getKTXSRegionNewest</li>";  
            echo "<li>region: Mien 1: mien bac, 2 miền trung, 3 miền nam</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getKTXSRegionNewest&region=3' target='_blank'>Lấy kết quả xổ số mới nhất các miền</a></span>" ;
          
            echo "<h1>API Mơ</h1>";  
            echo "<h2 style='color:red'>getDream:</h2>";
            echo "<em>Lấy danh sách xổ mơ.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getDream</li>";  
            echo "<li>title: Tiêu đề của giấy mơ</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getDream&title=' target='_blank'>Xổ mơ</a></span>" ;
            
            echo "<h1>API Thống kê</h1>";   
            echo "<h2 style='color:red'>getTKDauSo:</h2>";
            echo "<em>Thống kê kết quả theo đầu số.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKDauSo</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKDauSoDangBang&provinceId=1&fromDate=10-02-2014&toDate=20-02-2014' target='_blank'>Thống kê đầu số</a></span>" ;
            
            echo "<h2 style='color:red'>getTKDuoiSo:121</h2>";
            echo "<em>Thống kê kết quả theo đuôi số.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKDuoiSo</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKDuoiSo&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Đuôi số</a></span>" ;
            
            echo "<h2 style='color:red'>getTKBoKep:</h2>";
            echo "<em>Thống kê kết quả bộ kép.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoKep</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoKep&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ kép</a></span>" ;
            
            echo "<h2 style='color:red'>getTKBoSatKep:</h2>";
            echo "<em>Thống kê kết quả bộ sát kép.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoSatKep</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoSatKep&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Tổng Chẵn</a></span>" ;
            
            echo "<h2 style='color:red'>getTKTongChan:</h2>";
            echo "<em>Thống kê kết quả bộ Tổng Chẵn.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKTongChan</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKTongChan&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Sát Kép</a></span>" ;
           
            echo "<h2 style='color:red'>getTKTongLe:</h2>";
            echo "<em>Thống kê kết quả bộ Tổng Lẻ.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKTongLe</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKTongLe&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Tổng lẻ</a></span>" ;
           
            echo "<h2 style='color:red'>getTKBoChanLe:</h2>";
            echo "<em>Thống kê kết quả bộ Chẵn Lẻ.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoChanLe</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoChanLe&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Chẵn lẻ</a></span>" ;
           
            echo "<h2 style='color:red'>getTKBoLeChan:</h2>";
            echo "<em>Thống kê kết quả bộ Lẻ Chẵn.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoLeChan</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoLeChan&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Lẻ Chẵn</a></span>" ;
           
            echo "<h2 style='color:red'>getTKBoChanChan:</h2>";
            echo "<em>Thống kê kết quả bộ Chẵn Chẵn.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoChanChan</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoChanChan&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Chẵn Chẵn</a></span>" ;
           
            echo "<h2 style='color:red'>getTKBoLeLe:</h2>";
            echo "<em>Thống kê kết quả bộ Lẻ Lẻ.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoLeLe</li>";  
            echo "<li>provinceId: Id của Tỉnh</li>";  
            echo "<li>fromDate: Ngày bắt đầu thống kê</li>";  
            echo "<li>toDate: Ngày kết thúc thống kê</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoLeLe&provinceId=1&fromDate=10-02-2014&toDate=10-03-2014' target='_blank'>Thống kê Bộ Lẻ Lẻ</a></span>" ;
           
            echo "<h1>API Game Store</h1>";  
            echo "<h2 style='color:red'>getGameIPA:</h2>";
            echo "<em>Lay danh sach game IPA.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getGameIPA</li>";  
            echo "<li>page: page lay</li>";  
            echo "<li>limit: So item lay tren 1 page</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getGameIPA&page=1&limit=10' target='_blank'>Ds game IPA</a></span>" ;
           
            echo "<h2 style='color:red'>getGameAPK:</h2>";
            echo "<em>Lay danh sach game APK.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getGameAPK</li>";  
            echo "<li>page: page lay</li>";  
            echo "<li>limit: So item lay tren 1 page</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getGameAPK&page=1&limit=10' target='_blank'>Ds game APK</a></span>" ;
          
            echo "<h1>API Chủ Đề Hot</h1>";  
            echo "<h2 style='color:red'>getThreadHot:</h2>";
            echo "<em>Lấy danh sách chủ đề hot.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getThreadHot</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getThreadHot' target='_blank'>Ds Chủ đề Hot</a></span>" ;
            
            echo "<h2 style='color:red'>getThreadHotComment:</h2>";
            echo "<em>Lấy chủ đè hot và Ds comment.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getThreadHotComment</li>"; 
            echo "<li>id_thread: id chủ đề hot</li>";  
            echo "<li>page: trang </li>";  
            echo "<li>limit: số item lấy</li>";   
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getThreadHotComment&id_thread=1&page=1&limit=10' target='_blank'> Chủ đề Hot chi tiết</a></span>" ;
            
            
            echo "<h2 style='color:red'>postComment:</h2>";
            echo "<em>Post nội dung comment.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: postComment</li>"; 
            echo "<li>id_thread: id chủ đề hot</li>";  
            echo "<li>id_user: id user post </li>";  
            echo "<li>username: tên user post</li>"; 
            echo "<li>comment: Nội dung comment</li>"; 
            echo "<li>result: array['result']=0: Thành công, 1 Thiếu tham số, 2 post thất bại</li>";  
            echo "<li>result:0 Trả thêm count: số lượng bản tin, comment: Danh sách comment</li>";                    
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=postComment&id_thread=1&id_user=1&username=test&comment=alo alo' target='_blank'>Post Comment chủ đề </a></span>" ;
         
            echo "<h1>API VIP</h1>";
            echo "<h2 style='color:red'>getTKLotoGanCucDai:</h2>";
            echo "<em>TK Loto gan cuc dai.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKLotoGanCucDai</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKLotoGanCucDai' target='_blank'>TK Loto gan cuc dai</a></span>" ;
            
            echo "<h2 style='color:red'>getTKLotoDenKySoVoiKyGanNhat:</h2>";
            echo "<em>TK Loto đến kì so với kì gần nhất.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKLotoDenKySoVoiKyGanNhat</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKLotoDenKySoVoiKyGanNhat' target='_blank'>TK Loto đến kì so với kì gần nhất</a></span>" ;

            echo "<h2 style='color:red'>getTKLotoDenKySoVoiKyCucDai:</h2>";
            echo "<em>TK Loto đến kì so với kì cực đại.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKLotoDenKySoVoiKyCucDai</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKLotoDenKySoVoiKyCucDai' target='_blank'>TK Loto đến kì so với kì cực đại</a></span>" ;

            echo "<h2 style='color:red'>getTKChuKyLoTo:</h2>";
            echo "<em>TK Chu Kỳ Loto.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKChuKyLoTo</li>"; 
            echo "<li>boso: bộ số thống kê</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKChuKyLoTo&boso=00' target='_blank'>TK Chu kỳ loto</a></span>" ;

            echo "<h2 style='color:red'>getTK12BoSoRaNhieu:</h2>";
            echo "<em>TK 12 Boso miền bắc ra nhiều.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTK12BoSoRaNhieu</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTK12BoSoRaNhieu' target='_blank'>TK 12 bộ số miền bắc ra nhiều</a></span>" ;
        
            echo "<h2 style='color:red'>getTK12BoSoRaIt:</h2>";
            echo "<em>TK 12 Boso miền bắc ra ít.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTK12BoSoRaIt</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTK12BoSoRaIt' target='_blank'>TK 12 bộ số miền bắc ra it</a></span>" ;
            
            echo "<h2 style='color:red'>getTKBoSoRaLienTiep:</h2>";
            echo "<em>TK Bộ số miền bắc ra liên tiếp.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoSoRaLienTiep</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoSoRaLienTiep' target='_blank'>TK bộ số miền bắc ra liên tiếp</a></span>" ;
           
            echo "<h2 style='color:red'>getTKDauSoMoThuong:</h2>";
            echo "<em>TK đầu số mở thưởng miền bắc.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKDauSoMoThuong</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKDauSoMoThuong' target='_blank'>TK đầu số mở thưởng miền bắc</a></span>" ;
            
            echo "<h2 style='color:red'>getTKDuoiSoMoThuong:</h2>";
            echo "<em>TK đuôi số mở thưởng miền bắc.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKDuoiSoMoThuong</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKDuoiSoMoThuong' target='_blank'>TK đuôi số mở thưởng miền bắc</a></span>" ;
            
            echo "<h2 style='color:red'>getTKBoSoMBGanTren10Ngay:</h2>";
            echo "<em>TK bộ số gan trên 10 ngày.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKBoSoMBGanTren10Ngay</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKBoSoMBGanTren10Ngay' target='_blank'>TK bộ số gan trên 10 ngày.</a></span>" ;     
           
            echo "<h2 style='color:red'>getTKGiaiDacBietTheoNgay:</h2>";
            echo "<em>TK giải đặc biệt trong ngày.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTKGiaiDacBietTheoNgay</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTKGiaiDacBietTheoNgay' target='_blank'>TK giải đặc biệt trong ngày.</a></span>" ;     
            
            echo "<h1>API App Header & User</h1>";
            echo "<h2 style='color:red'>getAppHeaderXoSo:</h2>";
            echo "<em>Lấy thông số cầu hình của app.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getAppHeaderXoSo</li>";
            echo "<li>app_header: App Header đc cấp cho mỗi bản build</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getAppHeaderXoSo&app_header=TUVI-APPOTA-APK&app_client_id=123' target='_blank'>Lấy thông số cầu hình của app.</a></span>" ;     
            
            //getUserXoSo
            //getTaiKhoanChinh
            
            echo "<h2 style='color:red'>getUserXoSo:</h2>";
            echo "<em>Lấy thông tin user.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getUserXoSo</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getUserXoSo&app_client_id=123' target='_blank'>Lấy thông tin user.</a></span>" ;     
            
            echo "<h2 style='color:red'>getTaiKhoanChinh:</h2>";
            echo "<em>Lấy thông tài khoản.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getTaiKhoanChinh</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getTaiKhoanChinh&app_client_id=1' target='_blank'>Lấy thông tin tài khoản.</a></span>" ; 
            
            echo "<h2 style='color:red'>updateUser:</h2>";
            echo "<em>Cap nhat ten tai khoan.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: updateUserName</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>"; 
            echo "<li>username: Ten dat lai</li>"; 
            echo "<li>fullname: Ten day du</li>"; 
            echo "<li>mobile: So dien thoai</li>"; 
            echo "<li>email: Dia chi email</li>"; 
            echo "<li>address: Dia chi ca nhan</li>"; 
            echo "<li>ket qua tra ve: <br>0: Thanh cong<br>1: Thieu tham so<br>2: Ten bi trung<br>3: Cap nhat khong thanh cong<br>
            4: Email khong dung dinh dang<br></li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=updateUser&app_client_id=123&username=thangtt&fullname=Tran The Thang&mobile=84974838181&email=thangttnd@gmail.com&address=nd' target='_blank'>Cap nhat thong tin tai khoan.</a></span>" ; 
            
            echo "<h2 style='color:red'>updateUserName:</h2>";
            echo "<em>Cap nhat ten tai khoan.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: updateUserName</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>"; 
            echo "<li>username: Ten dat lai</li>"; 
            echo "<li>ket qua tra ve: <br>0: Thanh cong<br>1: Thieu tham so<br>2: Ten bi trung<br>3: Cap nhat khong thanh cong<br></li>"; 
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=updateUserName&app_client_id=123&username=thangtt' target='_blank'>Cap nhat ten tai khoan.</a></span>" ; 
            
            echo "<h2 style='color:red'>uploadAvatar:</h2>";
            echo "<em>Cap nhat Avatar tai khoan.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: uploadAvatar</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>";
            echo "<li>ket qua tra ve: <br>0: Thanh cong<br>1: Thieu tham so<br>2: File khong duoc gui<br>3: Dung luong file qua lon<br>4: Upload khong thanh cong<br>5: Loi dinh dang file<br>100: Loi khong ro nguyen nhan<br></li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=uploadAvatar&app_client_id=123' target='_blank'>Cap nhat ten tai khoan.</a></span>" ;  
            
            echo "<h2 style='color:red'>insertChat:</h2>";
            echo "<em>Post Chat.</em><br/>";
            echo "<em>Method:post.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: insertChat</li>";
            echo "<li>app_client_id: đặt là 0 khi lần đầu vào app, sau đó truyền app_client_id được cấp</li>";
            echo "<li>content:Noi dung</li>";
            echo "<li>deviceName:Thiet bi</li>";
            echo "<li>region:Vung mien</li>";
          
            echo "<li>result: array['result']=0: Thành công, 1 Thiếu tham số, 2 post thất bại, 3: app_client_id không tồn tại</li>";  
            echo "<li>result:0 Trả thêm count: số lượng bản tin, chat: Danh sách chat</li>";  
            
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=insertChat&app_client_id=123' target='_blank'>Post Chat.</a></span>" ;                                
            
            echo "<h1>API Chat box</h1>";  
            echo "<h2 style='color:red'>getChatBox:</h2>";
            echo "<em>Lay noi dung chat.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getChatBox</li>";  
            echo "<li>page: page lay</li>";  
            echo "<li>region: Vung mien 0: All 1: mien bac, 2: mien trung, 3 mien nam</li>";  
            echo "<li>limit: So item lay tren 1 page</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getChatBox&page=1&limit=10' target='_blank'>Noi dung chat</a></span>" ;
 
            echo "<h1>API Chat box getChatBoxFromID</h1>";  
            echo "<h2 style='color:red'>getChatBoxFromID:</h2>";
            echo "<em>Lay noi dung chat tu ID nguoc lai.</em><br/>";
            echo "<ul>Tham Số:";
            echo "<li>action: getChatBoxFromID</li>";  
            echo "<li>id: Lay tu id</li>";  
            echo "<li>region: Vung mien 0: All 1: mien bac, 2: mien trung, 3 mien nam</li>";  
            echo "<li>limit: So item lay tren 1 page max 100</li>";  
            echo "</ul>";
            echo "<span>Ví dụ: <a href='http://kenhkiemtien.com/kkt_api/XoSoAPI.php?action=getChatBoxFromID&id=1&limit=10&region=0' target='_blank'>Noi dung chat</a></span>" ;
            
            break;
        } 
    } 
    
?>
