<?php
  header ( 'Content-type: text/html; charset=utf-8' );
  require_once ("BongDaDAO.php");
  require_once ("../function/utils.php");
  
  $action = "KQ";
  $cup_code = "";
  $club_code = "";
  $sttBXH=0;
  $ktXuongDong ="\n";
  $status =1;
        
// Get Paras
        $req_id = isset ( $_GET ['id'] ) ? $_GET ['id'] : "";
        $phone = isset ( $_GET ['phone'] ) ? $_GET ['phone'] : "";
        $shortcode = isset ( $_GET ['shortcode'] ) ? $_GET ['shortcode'] : "";
        $sms = isset ( $_GET ['sms'] ) ? $_GET ['sms'] : "";
        $checksum = isset ( $_GET ['checksum'] ) ? $_GET ['checksum'] : "";
        $sms = strtoupper(preg_replace ("/\s{2,}/", " ", $sms));
        $mahoa = isset ( $_GET ['mahoa'] ) ? $_GET ['mahoa'] : "1";
            
        
// Tach Action Tu SMS    
       /* if(intval($mahoa)==1) 
        $sms =strtoupper(hexToStr($sms));   */
        
      //  if(intval($mahoa)==0) $ktXuongDong ="<br/>";
        
        $sms = strtoupper(preg_replace ("/\s{2,}/", " ", $sms));
        $sms = unicode_str_filter($sms);
        $sms = trim($sms);
        
        // Lay content tu webservice khac
        $mobi = getRamdonMobile();  
        $outputContent  = getContentByWebservice($shortcode,$mobi,$sms);
         echo  $outputContent; 
       /*  if(checkSMSLog($req_id)>0)
            updateSmsLog($req_id,$phone,$shortcode,$sms,$outputContent,$status);
        else  */
           // saveSmsLog($req_id,$phone,$shortcode,$sms,$outputContent,$status);
        
        die;
       
       
    
?>

<?php
     function getContentByWebservice($sms_no,$phone_no,$sms_Content)
     {
            $mobi = "0975752838";
            $content = "Gui BD MAGIAI -> xem KQ LTD MAGIAI -> xem ltd BXH MAGIAI -> xem bxh TL MAGIAI -> xem ty le truc tiep DT ho tro ".$mobi;
            $atservices_wsdl = "http://115.146.123.108/CPK_Content/Sms.asmx?wsdl";   
            $sms_date = date("Y/m/d H:i:s");
            $data     =  array('sms_no' => $sms_no,
            'phone_no' => $phone_no,'sms_Content' => $sms_Content,'sms_date' => $sms_date);

            $trace = true;
            $exceptions = false;
            try
            {
                $client = new SoapClient($atservices_wsdl, array('trace' => $trace, 'exceptions' => $exceptions));
                $response = $client->CPK_Content($data);
            }

            catch (Exception $e)
            {
                echo "Error!";
                echo $e -> getMessage ();
                echo 'Last response: '. $client->__getLastResponse();
            }
            $content =  $response->CPK_ContentResult;
           // if(!empty($content))
           $content =  str_replace("0912091344",$mobi,$content);
           
            $pos = strpos($content, "sodep");
            if ($pos >0) {
                $content = "Cam on ban, De biet thong tin soan BD KQ magiai gui 7095 LH 0975752838";
            }
            
            return    "200|".$content;
     }
     
     
     function getRamdonMobile(){
         $mobile ="84982050482";     
        try {
            $file = dirname(__FILE__).'/mobile.txt';
            $myfile = fopen($file, "r") ;
            $sbk = rand(0,5975);  $i=0;
            while(!feof($myfile)) {
                if($i==$sbk){
                     $mobile = fgets($myfile);   
                     break; 
                }
                $i++;
            }
            fclose($myfile);
        } catch (Exception $e) {
        } 
        return   $mobile;
    }
?>