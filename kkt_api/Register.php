<?php
    require_once("config.php");
    require_once("functions.php");
    
    $output = array();    
    if(!empty($_GET["refCode"]) && !empty($_GET["model"]) && !empty($_GET["w"]) && !empty($_GET["h"]) && !empty($_GET["midp"])){
        $data = array();         
        $data["refCode"] = cleanQuery($data["refCode"]);
        
        /* Lấy userId */
        $user = getUser($data["refCode"]);
        $data["userId"] = $user["id"];
        
        $data["brand"] = cleanQuery($_GET["brand"]);    
        $data["model"] = cleanQuery($_GET["model"]);    
        $data["w"] = cleanQuery($_GET["w"]);    
        $data["h"] = cleanQuery($_GET["h"]);    
        $data["midp"] = cleanQuery($_GET["midp"]);    
        $data["create_date"] = time();
        
        $appRegisterId = ApplicationRegister($data);
        
        if($appRegisterId > 0){
            $output["status"] = true;   
            $output["res"] = "S#" . $appRegisterId . "#E";   
        } else {
            $output["status"] = false;
            $output["res"] = "";    
        }        
    } else {
        $output["status"] = false;
        $output["res"] = "";
    }
    echo json_encode($output["res"]);
?>
