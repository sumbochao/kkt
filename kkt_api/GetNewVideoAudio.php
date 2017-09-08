<?php
	date_default_timezone_set('Asia/Saigon'); 
    require_once("config.php");
    require_once("function/GetContentVideoAudio.php");
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    switch($action){
        case "audio" :{
            $limit = isset($_GET['limit']) ?$_GET['limit'] :5 ;
            $page = isset($_GET['page']) ?$_GET['page'] :1;
            list($data,$max_page) = getAudioNew($limit,$page);
            $output['currentPage'] = $page;
            $output['maxPage'] = $max_page;
            $output['data'] = $data;
            echo json_encode($output);
            break;
        }
        case "video" :{
            $limit = isset($_GET['limit']) ?$_GET['limit'] :5 ;
            $page = isset($_GET['page']) ?$_GET['page'] :1;
            $cat = isset($_GET['cat']) ?$_GET['cat'] :"";
            list($data,$max_page) = getVideoNew($limit,$page,$cat);
            $output['currentPage'] = $page;
            $output['maxPage'] = $max_page;
            $output['data'] = $data;
            echo json_encode($output);
            break;
        }
        case "category" :{
            $output = getCategory();
            echo json_encode($output);
            break;
        }
    }

?>
