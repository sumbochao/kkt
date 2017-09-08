<?php
    require_once("config.php");
    date_default_timezone_set('Asia/Saigon');  
    //    require_once("config_f8m.php");
    require_once("function/GetContentNewAudio.php");
    require_once("function/GetCategoryAudio.php");
    require_once("function/GetCategoryAudioJava.php");
    require_once("function/GetContentDetailAudio.php");
    require_once("function/GetContentDetailAudioJava.php");
    require_once("function/UpdateDownloadAudio.php");
    require_once("function/UpdateListenAudio.php");
    require_once("function/GetSearchAudioTest.php");
    require_once("function/GetContentAudioTest.php");
    require_once("function/CheckPayment.php");
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    switch($action){
        case "getContentNew" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $limit = isset($_GET['limit'])?$_GET['limit'] :"";
            $output = getContentNewAudio($appId,$limit);
            echo json_encode($output);
            break;
        }
        case "getCategory" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $type = isset($_GET['type'])?$_GET['type'] :"";
            $output = getCategory($appId,$type);
            echo json_encode($output);
            break;
        }
         case "getCategoryF8" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $type = isset($_GET['type'])?$_GET['type'] :"";
            $output = getCategoryF8($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getCategoryApple" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $type = isset($_GET['type'])?$_GET['type'] :"";
            //$output = getCategoryApple($appId,$type);
			 $output = getCategory($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getCategoryGooglePlay" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $type = isset($_GET['type'])?$_GET['type'] :"";
            //$output = getCategoryApple($appId,$type);
             $output = getCategoryGooglePlay($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getCategoryJava" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $type = isset($_GET['type'])?$_GET['type'] :"";
            $output = getCategoryJava($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getContentJava" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"";
            $page = isset($_GET['page'])?$_GET['page'] :0;
            $limit = isset($_GET['limit'])?$_GET['limit'] :0;
            list($data,$max_page) = getContentAudioTest($catId, $page, $limit,$orderBy,$appId);
            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            $output = array();
            $output['pages']=$arr;

            $arrs =array();
            foreach($data as $key=>$value){
                $value['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/m_".$value['image'];
                $arrs[$key] = $value;
            }
            $output['data'] =$arrs;
            echo json_encode($output);  
            break;
        }
        case "getSearchJava" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"";
            $keyword = isset($_GET['keyword'])?$_GET['keyword'] :"";
            $page = isset($_GET['page'])?$_GET['page'] :0;
            $limit = isset($_GET['limit'])?$_GET['limit'] :0;
            list($data,$max_page) = getSearchAudioTest($catId, $page, $limit,$keyword,$appId);
            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            $output = array();
            $output['pages']=$arr;

            $arrs =array();
            foreach($data as $key=>$value){
                $value['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/m_".$value['image'];
                $arrs[$key] = $value;
            }
            $output['data'] =$arrs;
            echo json_encode($output);  
            break;
        }
        case "getContentDetail" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $content_id = isset($_GET['content_id'])?$_GET['content_id'] :"";
            list($output,$detail) = getContentDetailAudio($content_id,$appId);
            $output['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$output['create_date'])."/".$output['image'];

            $arrs = array();
            foreach($detail as $key =>$value){
                $value['file'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/".$value['file'];
                $arrs[$key] = $value;
            }
            $output['detail']=$arrs;
            echo json_encode($output);  
            break;
        }
        case "getContentDetailJava" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $page = isset($_GET['page'])?$_GET['page'] :0;
            $limit = isset($_GET['limit'])?$_GET['limit'] :0;
            $content_id = isset($_GET['content_id'])?$_GET['content_id'] :"";
            list($output,$detail,$max_page) = getContentDetailAudioJava($content_id,$appId,$page,$limit);
            $output['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$output['create_date'])."/".$output['image'];

            $arrs = array();
            foreach($detail as $key =>$value){
                $value['file'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/".$value['file'];
                $arrs[$key] = $value;
            }
            $output['detail']=$arrs;
            $arr_page = array();
            $arr_page['page']=$page;
            $arr_page['max_page']=$max_page;
            $arr_page['row_per_page']=$limit;
            $output['pages']=$arr_page;
            echo json_encode($output);  
            break;
        }
        case "updateDownload" :{
            $content_id = isset($_GET['content_id'])?$_GET['content_id'] :"";
            $output = updateDownload($content_id);
            break;
        }
        case "updateListen" :{
            $content_id = isset($_GET['content_id'])?$_GET['content_id'] :"";
            $output = updateListen($content_id);
            break;
        }
        case "getSearch" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"";
            $keyword = isset($_GET['keyword'])?$_GET['keyword'] :"";
            $keyword= RemoveSign($keyword);
            $page = isset($_GET['page'])?$_GET['page'] :0;
            $limit = isset($_GET['limit'])?$_GET['limit'] :0;
            list($data,$max_page) = getSearchAudioTest($catId, $page, $limit,$keyword,$appId);
            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            $output = array();
            $output['pages']=$arr;

            $arrs =array();
            foreach($data as $key=>$value){
                $value['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/m_".$value['image'];
                $arrs[$key] = $value;
            }
            $output['data'] =$arrs;
            echo json_encode($output);  
            break;
        }
        case "getContent" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"";
            $page = isset($_GET['page'])?$_GET['page'] :0;
            $limit = isset($_GET['limit'])?$_GET['limit'] :0;
            list($data,$max_page,$code) = getContentAudioTest($catId, $page, $limit,$orderBy,$appId);
            $arr = array();
            $arr['page']=$page;
            $arr['max_page']=$max_page;
            $arr['row_per_page']=$limit;
            $arr['code']=$code;
            $output = array();
            $output['pages']=$arr;

            $arrs =array();
            foreach($data as $key=>$value){
                $value['image'] = "http://kenhkiemtien.com/upload/audio/".date("Y/md",$value['create_date'])."/m_".$value['image'];
                $arrs[$key] = $value;
            }
            $output['data'] =$arrs;
            echo json_encode($output);  
            break;
        }
        case "PaymentF8M" : {

            $userId = isset($_GET['userId'])?$_GET['userId'] :"";
//            $userId = 12345678;
            $catCode = isset($_GET['catCode'])?$_GET['catCode'] :"";
            $storyId = isset($_GET['storyId'])?$_GET['storyId'] :"";
            $status = 0;
            $arrCatActive="";
            $arrCat="";
            if($catCode==""){
                $catCode= getCategoryCode($storyId);
                foreach($catCode as $key=> $value){
                    $username= $value['code']."-".$userId;
                    $arrCat.=",".$value['code']."-".$value['name'];
                    $data= file_get_contents("http://kenhkiemtien.com/kkt_api/CheckPaymentF8MAPI.php?action=checkPayment&username=".$username);
                    $arrstt=json_decode($data,true);
                    if($arrstt['status'] >=1){
                        $status =1;
                    }
                    $arrCatActive = $arrstt['status_cat'];
                }
                $output['status']=$status;
                $output['category']=ltrim($arrCat,",");
                $output['activeCat']=ltrim($arrCatActive,",");
                echo json_encode($output);
            }else{
                $username = $catCode."-".$userId;
                $data = file_get_contents("http://kenhkiemtien.com/kkt_api/CheckPaymentF8MAPI.php?action=checkPayment&username=".$username);
                $arrstt=json_decode($data,true);
                if($arrstt['status'] >=1){
                        $status =1;
                    }
                $output['status']=$status;
                $output['activeCat']=$arrstt['status_cat'];
                echo json_encode($output);
            }
            break;
        }
    }
    function RemoveSign($str) {
        $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

        $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
        return str_replace ( $coDau, $khongDau, $str );
    }

?>
