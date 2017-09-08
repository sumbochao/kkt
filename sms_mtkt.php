<?php
//moid, phonenumber,servicenumber,message,route

$moid = $_GET["moid"];
$phonenumber = $_GET["phonenumber"];
$servicenumber = $_GET["servicenumber"];
$message = $_GET["message"];

	
$con = mysql_connect("localhost","uvtc_kkt2012","pvtc_@)!@kkt");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("vtc_kenhkiemtien", $con);

mysql_query("INSERT INTO c_sk_log (request_id,mobile, mo, sc) VALUES 	('".$moid ."', '".$phonenumber."', '".$message."', '".$servicenumber."') ");


mysql_close($con);

echo "Ban co 5 tin nhan yeu thuong gui toi nguoi thuong. Xin cam on.";

?> 