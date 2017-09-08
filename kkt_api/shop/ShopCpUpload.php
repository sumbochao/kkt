<?php
    date_default_timezone_set('Asia/Saigon');   
    header('Content-type: text/html; charset=utf-8');   
    header('Access-Control-Allow-Origin: http://cp.traodoidi.vn'); 
    require_once("ShopDAO.php");
    require_once("ShopDOC.php");
    require_once("ShopBANK.php");
    require_once("ShopProvince.php");
    require_once("ShopNotify.php");
    require_once("../function/utils.php");
    
    
     $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"0";
     $product_id =   isset($_POST['product_id'])?$_POST['product_id'] :"0";
     $arrKQ = uploadImageProductCP($user_id,$product_id); 
     echo json_encode($arrKQ);
             
?>
