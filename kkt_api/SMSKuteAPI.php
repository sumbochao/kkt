<?php
  require_once("SMSKUTEDAO.php");
  require_once("AppHeaderDAO.php");
 
    $output = array();
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    
    switch($action){
        case "getSMSKuteByID" :{
            $id = isset($_GET['id'])?$_GET['id'] :"0";
            $output = getSMSKuteByID($id);
            echo json_encode($output);
            break;
        }
        case "getAppHeader" :{
               $app_header = isset($_GET['appHeader'])?$_GET['appHeader'] :"";  
            
               $arrAppHeader =  getAppHeaderSMSKute($app_header);
               echo json_encode($arrAppHeader);  
               break;
            }       
       }
    
?>
