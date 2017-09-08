<?php
  
    require_once("config_f8m.php");
    require_once("function/CheckPayment.php");
    $action = isset($_GET['action']) ?$_GET['action'] :"" ;
    switch($action){
        case "checkPayment" : {
            $username = isset($_GET['username'])?$_GET['username'] :"";
            if($username!=""){
                $output['status']= checkPayment($username);
                $output['status_cat'] = checkCatCodeActive($username);
            }
            echo json_encode($output);  
            break;
        }
    }
    

?>
