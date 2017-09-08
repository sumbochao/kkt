<?php
  require_once("config.php");
  require_once("videoFunction.php");
  $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;

    switch($action){
        case "getVideo" :{
            $output = getAllVideoMp4();
            echo json_encode($output);
            break;
        }
    }
?>
