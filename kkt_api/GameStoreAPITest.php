<?php
header ( 'Content-type: text/html; charset=utf-8' );
date_default_timezone_set ( 'Asia/Saigon' );

require_once ("GameStoreDAOTest.php");
//require_once ("GameStoreDOC.php");
//require_once ("function/utils.php");


$output = array ();
$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : "";
$limitItem = 10;
echo 1;

?>
