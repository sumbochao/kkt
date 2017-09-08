<?php
	
	require_once('VDCO_SOAPClient.class.php');
	$Client = new VMS_Soap_Client('http://123.30.179.27:8081/webservice/VDCTelcoAPI?wsdl', 'tritueviet_tp', '81azM7U0', 262, 'tritueviet_tp.mpin');
	
							//ma the		
	
	$return = $Client->doCardCharge('tenkhachhang', '566616406946:VMS:021671000216736', 'trankhhiep@gmail.com', '01672904456');
	var_dump($return);
    echo "<br/>";
    echo $return["status"]."<br/>";
    echo $return["transid"]."<br/>";;
    echo $return["message"]."<br/>";;

?>