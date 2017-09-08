<?php
	date_default_timezone_set('Asia/Saigon'); 
    require_once("GameAppFunction.php");
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;

    switch($action){

        case "getCategoryzz" :{
            $appId = isset($_GET['appId'])?intval($_GET['appId']) :128;
            $type = isset($_GET['type'])?intval($_GET['type']) :1;
            $output = getCategory($appId,$type);
            echo json_encode($output);
            break;
        }
        case "getGameAppIndex" :{
            $appId = isset($_GET['appId'])?$_GET['appId'] :"128";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";   
            $limit = isset($_GET['limit'])?$_GET['limit'] :"2";
            $output = getGameAppIndex($appId,$orderBy,$limit);
            echo json_encode($output);
            break;
        }
        case "getGameAppByCategoryzz" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"128";
            $catId = isset($_GET['catId'])?$_GET['catId'] :"0";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";
            $page = isset($_GET['page'])?$_GET['page'] :1;
            $limit = isset($_GET['limit'])?$_GET['limit'] :30;
            list($data,$max_page) = getGameAppByCategory($appId,$catId,$orderBy,$limit,$page);

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
        case "getGameAppIndexDemozz" :{
            
            
            $appId = isset($_GET['appId'])? intval($_GET['appId']) : 128;
            $partnerId = isset($_GET['partnerId'])? intval($_GET['partnerId']) :1;  
            $orderBy = isset($_GET['orderBy'])? mysql_escape_string($_GET['orderBy']) :"id";   
            $limit = isset($_GET['limit'])? intval($_GET['limit']) :2;
            
            if($limit >5){
                $limit=5;
            }
            
            $output = getGameAppIndexDemo($partnerId,$appId,$orderBy,$limit);
            echo json_encode($output);
            break;
        }
        case "getGameAppByCategoryDemozz" : {   
            $appId = isset($_GET['appId'])? intval($_GET['appId']) : 128;   
            $catId = isset($_GET['catId'])?intval($_GET['catId'] ):0;
            $partnerId = isset($_GET['partnerId'])?intval($_GET['partnerId']) :1;
            $orderBy = isset($_GET['orderBy'])? mysql_escape_string($_GET['orderBy']) :"id";
            $page = isset($_GET['page'])?intval($_GET['page']) :1;
            $limit = isset($_GET['limit'])? intval($_GET['limit']) :30;
            list($data,$max_page) = getGameAppByCategoryDemo($partnerId,$appId,$catId,$orderBy,$limit,$page);

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
        case "getGameAppOfflinezz" : {
            $appId = isset($_GET['appId'])?$_GET['appId'] :"128";
            $orderBy = isset($_GET['orderBy'])?$_GET['orderBy'] :"id";
            $data = getGameAppOfline($appId,$orderBy);

            $output = array(); 
            $output['data'] =$data;

            echo json_encode($output);  
            break;
        }
        case "setGameAppHitzz" :{
            $id = isset($_GET['id'])?$_GET['id'] :"0";
            $countType = isset($_GET['countType'])?$_GET['countType'] :"";
            $output = setGameAppcHit($id,$countType);
            break;
        }
    }

?>
