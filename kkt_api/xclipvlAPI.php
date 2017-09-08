<?php
    date_default_timezone_set('Asia/Saigon'); 
    require_once("xclipvlFunction.php");
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;

    switch($action){
        case "getHtmlApp" :{
            $output = getHtmlApp();
            echo $output;
            break;
        }
        case "getHtmlVideo" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $output = getHtmlBoxKenh18($osType);
            echo $output;die;
            break;
        }
        case "getHtmlAlbum" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $output = getHtmlBoxAlbum($osType);
            echo $output;die;
            break;
        }
        case "getHtmlNews" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $output = getHtmlBoxNews($osType);
            echo $output;die;
            break;
        }
        case "getHtmlHotVideoPaging" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $page = isset($_GET['page']) ? intval($_GET['page']) :1 ;
            $num_per_page = isset($_GET['limit']) ? intval($_GET['limit']) :10 ;
            list($data,$num_page) = getHotVideo($page,$num_per_page,$osType);
            $output['data'] = $data;
            $output['num_page'] = $num_page;
            echo json_encode($output);
            break;
        }
        case "getHtmlAlbumPaging" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $page = isset($_GET['page']) ? intval($_GET['page']) :1 ;
            $num_per_page = isset($_GET['limit']) ? intval($_GET['limit']) :10 ;
            list($data,$num_page)= getLatestAlbum($page,$num_per_page,$osType);
            $output['data'] = $data;
            $output['num_page'] = $num_page;
            echo json_encode($output);
            break;
        } 
        case "getHtmlNewsPaging" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $page = isset($_GET['page']) ? intval($_GET['page']) :1 ;
            $num_per_page = isset($_GET['limit']) ? intval($_GET['limit']) :10 ;
            list($data,$num_page) = getLatestNews($page,$num_per_page,$osType);
            $output['data'] = $data;
            $output['num_page'] = $num_page;
            echo json_encode($output);
            break;
        }
        case "getNewsById" :{
            $new_id = isset($_GET['new_id']) ? intval($_GET['new_id']) :1 ;
            $output = getNewsById($new_id);
            echo json_encode($output);die;
            break;
        }
        case "getAudio18" :{
            $osType = isset($_GET['osType']) ?$_GET['osType'] :"web" ;
            $page = isset($_GET['page']) ? intval($_GET['page']) :1 ;
            $num_per_page = isset($_GET['limit']) ? intval($_GET['limit']) :10 ;
            list($data,$num_page) = getAudio18($page,$num_per_page,$osType);
            $output['data'] = $data;
            $output['num_page'] = $num_page;
            echo json_encode($output);
            break;
        }
    }

?>
