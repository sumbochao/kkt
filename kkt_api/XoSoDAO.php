<?php
    require_once("configXS.php");   
    date_default_timezone_set('Asia/Saigon'); 
    // Get Tuong Thuat Ket Qua Xo So Mien Bac
     function getTTKQXSMienBac()
    {
        $today = date("Y-m-d");
        $sql = "SELECT   province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat ,giai_nhi_1, giai_nhi_2, 
                giai_ba_1, giai_ba_2,giai_ba_3,giai_ba_4,giai_ba_5,giai_ba_6,giai_tu_1,giai_tu_2,giai_tu_3, 
                giai_tu_4,giai_nam_1,giai_nam_2,giai_nam_3, giai_nam_4,giai_nam_5,giai_nam_6,giai_sau_1, 
                giai_sau_2,giai_sau_3,giai_bay_1,giai_bay_2,giai_bay_3,giai_bay_4 FROM  ketqua_mienbac Where ngay_quay = '$today' ";
       // echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
        $arrayKQParse [1]= array();
        
        if(!empty($arrayKQ)) {
         foreach($arrayKQ as $item=>$value)
            {
                if($value==null||$value=="")
                {
                     $arrayKQ[$item] =" ";
                }
            }   
                 
            $arrayKQParse[1]["ngay_quay"] =$arrayKQ["ngay_quay"]   ;   
            $arrayKQParse[1]["province_id"] =$arrayKQ["province_id"]   ;   
            $arrayKQParse[1]["giai_dacbiet"] =$arrayKQ["giai_dacbiet"]   ;  
            $arrayKQParse[1]["giai_nhat"] =$arrayKQ["giai_dacbiet"]   ;
            $arrayKQParse[1]["giai_nhi"] =$arrayKQ["giai_nhi_1"]."-".$arrayKQ["giai_nhi_2"]; 
            $arrayKQParse[1]["giai_ba"] =$arrayKQ["giai_ba_1"]."-".$arrayKQ["giai_ba_2"]."-".$arrayKQ["giai_ba_3"]."-".$arrayKQ["giai_ba_4"]."-".$arrayKQ["giai_ba_5"]."-".$arrayKQ["giai_ba_6"];  
            $arrayKQParse[1]["giai_tu"] =$arrayKQ["giai_tu_1"]."-".$arrayKQ["giai_tu_2"]."-".$arrayKQ["giai_tu_3"]."-".$arrayKQ["giai_tu_4"];  
            $arrayKQParse[1]["giai_nam"] =$arrayKQ["giai_nam_1"]."-".$arrayKQ["giai_nam_2"]."-".$arrayKQ["giai_nam_3"]."-".$arrayKQ["giai_nam_4"]."-".$arrayKQ["giai_nam_5"]."-".$arrayKQ["giai_nam_6"];  
            $arrayKQParse[1]["giai_sau"] =$arrayKQ["giai_sau_1"]."-".$arrayKQ["giai_sau_2"]."-".$arrayKQ["giai_sau_3"];  
            $arrayKQParse[1]["giai_bay"] =$arrayKQ["giai_bay_1"]."-".$arrayKQ["giai_bay_2"]."-".$arrayKQ["giai_bay_3"]."-".$arrayKQ["giai_bay_4"];  
        }else{
            $arrayKQParse[1]["ngay_quay"] =$today   ; 
            $arrayKQParse[1]["province_id"] ="1";       
            $arrayKQParse[1]["giai_dacbiet"] =" ";  
            $arrayKQParse[1]["giai_nhat"] =" ";
            $arrayKQParse[1]["giai_nhi"] =" "."-"." "; 
            $arrayKQParse[1]["giai_ba"] =" "."-"." "."-"." "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_tu"] =" "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_nam"] =" "."-"." "."-"." "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_sau"] =" "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_bay"] =" "."-"." "."-"." "."-"." ";  
        }
        
        
        $arrKQCuoi = array();
        foreach($arrayKQParse as $key => $row){
              $arrKQCuoi[] = $row;
        }
        
        @mysql_free_result($result);
        return $arrKQCuoi;
    } 
    
    
    function getTTKQXSMienBac2()
    {
        $today = date("Y-m-d");
        $sql = "SELECT   province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat ,giai_nhi_1, giai_nhi_2, 
                giai_ba_1, giai_ba_2,giai_ba_3,giai_ba_4,giai_ba_5,giai_ba_6,giai_tu_1,giai_tu_2,giai_tu_3, 
                giai_tu_4,giai_nam_1,giai_nam_2,giai_nam_3, giai_nam_4,giai_nam_5,giai_nam_6,giai_sau_1, 
                giai_sau_2,giai_sau_3,giai_bay_1,giai_bay_2,giai_bay_3,giai_bay_4 FROM  ketqua_mienbac Where ngay_quay = '$today' ";
        
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
        $arrayKQParse [1]= array();
        
        if(!empty($arrayKQ)) {  
            
            foreach($arrayKQ as $item=>$value)
            {
                if($value==null||$value=="")
                {
                     $arrayKQ[$item] =" ";
                }
            }   
            
            $arrayKQParse[1]["ngay_quay"] =$arrayKQ["ngay_quay"]   ;   
            $arrayKQParse[1]["province_id"] =$arrayKQ["province_id"]   ;   
            $arrayKQParse[1]["giai_dacbiet"] =$arrayKQ["giai_dacbiet"]   ;  
            $arrayKQParse[1]["giai_nhat"] =$arrayKQ["giai_nhat"]   ;
            $arrayKQParse[1]["giai_nhi"] =$arrayKQ["giai_nhi_1"]."-".$arrayKQ["giai_nhi_2"]; 
            $arrayKQParse[1]["giai_ba"] =$arrayKQ["giai_ba_1"]."-".$arrayKQ["giai_ba_2"]."-".$arrayKQ["giai_ba_3"]."-".$arrayKQ["giai_ba_4"]."-".$arrayKQ["giai_ba_5"]."-".$arrayKQ["giai_ba_6"];  
            $arrayKQParse[1]["giai_tu"] =$arrayKQ["giai_tu_1"]."-".$arrayKQ["giai_tu_2"]."-".$arrayKQ["giai_tu_3"]."-".$arrayKQ["giai_tu_4"];  
            $arrayKQParse[1]["giai_nam"] =$arrayKQ["giai_nam_1"]."-".$arrayKQ["giai_nam_2"]."-".$arrayKQ["giai_nam_3"]."-".$arrayKQ["giai_nam_4"]."-".$arrayKQ["giai_nam_5"]."-".$arrayKQ["giai_nam_6"];  
            $arrayKQParse[1]["giai_sau"] =$arrayKQ["giai_sau_1"]."-".$arrayKQ["giai_sau_2"]."-".$arrayKQ["giai_sau_3"];  
            $arrayKQParse[1]["giai_bay"] =$arrayKQ["giai_bay_1"]."-".$arrayKQ["giai_bay_2"]."-".$arrayKQ["giai_bay_3"]."-".$arrayKQ["giai_bay_4"];  
        }else{
            $arrayKQParse[1]["ngay_quay"] =$today   ; 
            $arrayKQParse[1]["province_id"] ="1";       
            $arrayKQParse[1]["giai_dacbiet"] =" ";  
            $arrayKQParse[1]["giai_nhat"] =" ";
            $arrayKQParse[1]["giai_nhi"] =" "."-"." "; 
            $arrayKQParse[1]["giai_ba"] =" "."-"." "."-"." "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_tu"] =" "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_nam"] =" "."-"." "."-"." "."-"." "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_sau"] =" "."-"." "."-"." ";  
            $arrayKQParse[1]["giai_bay"] =" "."-"." "."-"." "."-"." ";  
        }
        
        
        $arrKQCuoi = array();
        foreach($arrayKQParse as $key => $row){
                   //var_dump($row);
                   $arrKQCuoi[] = $row;
        }
        
        @mysql_free_result($result);
        return $arrKQCuoi;
    } 
    
    function getProvinceOpenByRegio($region)
    {
        $arrProvince = array();
        $today = date("w");    
        switch($today)   {
            case 0:
                 if($region==2){
                 $arrProvince[0]   = 28;
                 $arrProvince[1]   = 29; 
                 }else{
                     $arrProvince[0]   = 10;
                     $arrProvince[1]   = 15; 
                     $arrProvince[2]   = 19; 
                 }
                 break;
            
            case 1: // thu 2
                if($region==2){
                 $arrProvince[0]   = 31;
                 $arrProvince[1]   = 36; 
                 }else{
                     $arrProvince[0]   = 14;
                     $arrProvince[1]   = 12; 
                     $arrProvince[2]   = 8; 
                 }
                 break;
            
            case 2:// thu 3
                if($region==2){
                 $arrProvince[0]   = 25;
                 $arrProvince[1]   = 34; 
                 }else{
                     $arrProvince[0]   = 3;
                     $arrProvince[1]   = 4; 
                     $arrProvince[2]   = 22; 
                 }
                 break;
            case 3: // thu 4
                if($region==2){
                 $arrProvince[0]   = 24;
                 $arrProvince[1]   = 28; 
                 }else{
                     $arrProvince[0]   = 9;
                     $arrProvince[1]   = 11; 
                     $arrProvince[2]   = 17; 
                 }
                 break;
            case 4:   // thu 5
                if($region==2){
                 $arrProvince[0]   = 23;
                 $arrProvince[1]   = 32; 
                 $arrProvince[2]   = 35; 
                 }else{
                     $arrProvince[0]   = 2;
                     $arrProvince[1]   = 7; 
                     $arrProvince[2]   = 18; 
                 }
                 break;
            case 5:   // thu 6
                if($region==2){
                 $arrProvince[0]   = 27;
                 $arrProvince[1]   = 30; 
                 }else{
                     $arrProvince[0]   = 5;
                     $arrProvince[1]   = 20; 
                     $arrProvince[2]   = 21; 
                 }
                 break;
             case 6: // thu 7
                if($region==2){
                 $arrProvince[0]   = 24;
                 $arrProvince[1]   = 26; 
                 $arrProvince[2]   = 33;    
                 }else{
                     $arrProvince[0]   = 6;
                     $arrProvince[1]   = 13; 
                     $arrProvince[2]   = 14; 
                     $arrProvince[2]   = 16;  
                 }
                 break;
        }
    
         
        
        return  $arrProvince;
    }
      
    function getTTKQXSMienTrung()
    {                                                                                 
        $today = date("Y-m-d");
       
        $sql = "SELECT  province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2,giai_tu_1, 
        giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7,giai_nam,giai_sau_1,giai_sau_2, 
        giai_sau_3,giai_bay,giai_tam FROM  ketqua_mientrung WHERE ngay_quay = '$today'  ";
       // echo $sql;
        $result = @mysql_query($sql);
        $arrayKQParse = array();
        $i = 0;
        
        $arrProvince  = getProvinceOpenByRegio(2);
       
        while($i<count($arrProvince)) {
                $provinceId = $arrProvince[$i]  ;
                $arrayKQParse[$provinceId] =  array(); 
               $i++;
        }
   
        $i  = 0;
        while($row = @mysql_fetch_array($result)){ 
          
            foreach($row as $item=>$value)
            {
                if($value==null||$value=="")
                {
                     $row[$item] =" ";
                }
            }   
            
            $province_id  = $row["province_id"]   ;
            $arrayKQParse[$province_id]["province_id"] =$row["province_id"]   ;
            $arrayKQParse[$province_id]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$province_id]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$province_id]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$province_id]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$province_id]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$province_id]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$province_id]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$province_id]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$province_id]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$province_id]["giai_tam"] =$row["giai_tam"]   ; 
           
        }
        
        $i = 0;
         while($i<count($arrProvince)) {
             $provinceId  = $arrProvince[$i] ;
                if(empty($arrayKQParse[$provinceId]))   {
                   $arrayKQParse[$provinceId] = initKQTTMienTrung($provinceId,$today) ;
                }
                $i++;
         }
        
        $arrKQCuoi = array();
        foreach($arrayKQParse as $key => $row){
                   //var_dump($row);
                   $arrKQCuoi[] = $row;
        }
        
        @mysql_free_result($result);
        return $arrKQCuoi;
    } 
    
    function getTTKQXSMienNam()
    {                                                                                 
        $today = date("Y-m-d");
        
        $sql = "SELECT province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2, 
            giai_tu_1,giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7, 
            giai_nam,giai_sau_1,giai_sau_2,giai_sau_3,giai_bay,giai_tam FROM  ketqua_miennam Where ngay_quay = '$today' ";
        //echo $sql;
        $result = @mysql_query($sql);
        $arrayKQParse = array();
        $i = 0;
        
        $arrProvince  = getProvinceOpenByRegio(3);
       
        while($i<count($arrProvince)) {
                $provinceId = $arrProvince[$i]  ;
                $arrayKQParse[$provinceId] =  array(); 
               $i++;
        }
   
        $i  = 0;
        while($row = @mysql_fetch_array($result)){ 
        
            foreach($row as $item=>$value)
            {
                if($value==null||$value=="")
                {
                     $row[$item] =" ";
                }
            }
              
            $province_id  = $row["province_id"]   ;
            $arrayKQParse[$province_id]["province_id"] =$row["province_id"]   ;
            $arrayKQParse[$province_id]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$province_id]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$province_id]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$province_id]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$province_id]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$province_id]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$province_id]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$province_id]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$province_id]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$province_id]["giai_tam"] =$row["giai_tam"]   ; 
           
        }
        
        $i = 0;
         while($i<count($arrProvince)) {
             $provinceId  = $arrProvince[$i] ;
                if(empty($arrayKQParse[$provinceId]))   {
                   $arrayKQParse[$provinceId] = initKQTTMienTrung($provinceId,$today) ;
                }
                $i++;
         }
        
        $arrKQCuoi = array();
        foreach($arrayKQParse as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        
        @mysql_free_result($result);
        return $arrKQCuoi;
    } 
    
    function initKQTTMienTrung($provinceId,$date) {
            $arrayKQParse["province_id"] =$provinceId   ;
            $arrayKQParse["ngay_quay"] =$date;   
            $arrayKQParse["giai_dacbiet"] =" ";  
            $arrayKQParse["giai_nhat"] =" ";
            $arrayKQParse["giai_nhi"] =" ";  
            $arrayKQParse["giai_ba"] =" "."-"." ";  
            $arrayKQParse["giai_tu"] =" "."-"." "."-"." "."-"." "."-"." "."-"." "."-"." ";    
            $arrayKQParse["giai_nam"] =" "; 
            $arrayKQParse["giai_sau"] =" "."-"." "."-"." ";   
            $arrayKQParse["giai_bay"] =" "; 
            $arrayKQParse["giai_tam"] =" ";  
            return $arrayKQParse;
    }
    
     function getKQXSMienBac($date)
    {
        $date = date("Y-m-d");
        $sql = "SELECT   province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat ,giai_nhi_1, giai_nhi_2, 
                giai_ba_1, giai_ba_2,giai_ba_3,giai_ba_4,giai_ba_5,giai_ba_6,giai_tu_1,giai_tu_2,giai_tu_3, 
                giai_tu_4,giai_nam_1,giai_nam_2,giai_nam_3, giai_nam_4,giai_nam_5,giai_nam_6,giai_sau_1, 
                giai_sau_2,giai_sau_3,giai_bay_1,giai_bay_2,giai_bay_3,giai_bay_4 FROM  ketqua_mienbac Where ngay_quay = '$date' ";
       
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
        $arrayKQParse= array();
        
        if(!empty($arrayKQ)) {
            $arrayKQParse[0]["province_id"] =$arrayKQ["province_id"]   ;    
            $arrayKQParse[0]["ngay_quay"] =$arrayKQ["ngay_quay"]   ;   
            $arrayKQParse[0]["giai_dacbiet"] =$arrayKQ["giai_dacbiet"]   ;  
            $arrayKQParse[0]["giai_nhat"] =$arrayKQ["giai_nhat"]   ;
            $arrayKQParse[0]["giai_nhi"] =$arrayKQ["giai_nhi_1"]."-".$arrayKQ["giai_nhi_2"]; 
            $arrayKQParse[0]["giai_ba"] =$arrayKQ["giai_ba_1"]."-".$arrayKQ["giai_ba_2"]."-".$arrayKQ["giai_ba_3"]."-".$arrayKQ["giai_ba_4"]."-".$arrayKQ["giai_ba_5"]."-".$arrayKQ["giai_ba_6"];  
            $arrayKQParse[0]["giai_tu"] =$arrayKQ["giai_tu_1"]."-".$arrayKQ["giai_tu_2"]."-".$arrayKQ["giai_tu_3"]."-".$arrayKQ["giai_tu_4"];  
            $arrayKQParse[0]["giai_nam"] =$arrayKQ["giai_nam_1"]."-".$arrayKQ["giai_nam_2"]."-".$arrayKQ["giai_nam_3"]."-".$arrayKQ["giai_nam_4"]."-".$arrayKQ["giai_nam_5"]."-".$arrayKQ["giai_nam_6"];  
            $arrayKQParse[0]["giai_sau"] =$arrayKQ["giai_sau_1"]."-".$arrayKQ["giai_sau_2"]."-".$arrayKQ["giai_sau_3"];  
            $arrayKQParse[0]["giai_bay"] =$arrayKQ["giai_bay_1"]."-".$arrayKQ["giai_bay_2"]."-".$arrayKQ["giai_bay_3"]."-".$arrayKQ["giai_bay_4"];  
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    }
    
    function getKQXSMienBacByTime($Fromdate,$ToDate)
    {
        $sql = "SELECT   province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat ,giai_nhi_1, giai_nhi_2, 
                giai_ba_1, giai_ba_2,giai_ba_3,giai_ba_4,giai_ba_5,giai_ba_6,giai_tu_1,giai_tu_2,giai_tu_3, 
                giai_tu_4,giai_nam_1,giai_nam_2,giai_nam_3, giai_nam_4,giai_nam_5,giai_nam_6,giai_sau_1, 
                giai_sau_2,giai_sau_3,giai_bay_1,giai_bay_2,giai_bay_3,giai_bay_4 FROM  ketqua_mienbac Where ngay_quay BETWEEN '$Fromdate' AND '$ToDate' ";
               
        $intTime1day =86400;
        $intFTime = strtotime($Fromdate);
        $intTTime = strtotime($ToDate);
        $arrayKQParseByTime = array();
        while($intFTime<=$intTTime)
        {
            $strDate = date("d/m/Y", $intFTime);;
            $arrayKQParseByTime[$strDate]=array();
            $intFTime+=$intTime1day;
        }
        
        $result = @mysql_query($sql);
        $arrayKQParse= array();
         $i=0;
        while( $row = @mysql_fetch_assoc($result))  {
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;   
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi_1"]."-".$row["giai_nhi_2"]; 
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]."-".$row["giai_ba_3"]."-".$row["giai_ba_4"]."-".$row["giai_ba_5"]."-".$row["giai_ba_6"];  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"];  
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam_1"]."-".$row["giai_nam_2"]."-".$row["giai_nam_3"]."-".$row["giai_nam_4"]."-".$row["giai_nam_5"]."-".$row["giai_nam_6"];  
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"];  
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay_1"]."-".$row["giai_bay_2"]."-".$row["giai_bay_3"]."-".$row["giai_bay_4"]; 
            
            foreach($arrayKQParseByTime as $key=>$value){
                //echo $key."-cc".$row["ngay_quay"]."<br>";
                if(strcasecmp($row["ngay_quay"],$key)==0){
                    $arrayKQParseByTime[$key][]=$arrayKQParse[$i];
                }
            }
            $i++; 
        }
       
        $arrayKQParse = null;
        $arrayKQParse = array();
        
        foreach($arrayKQParseByTime as $key=>$value){
               // echo $key."-cc".$row["ngay_quay"]."<br>";
               $arrayKQParse[]=$value;
            }
            
        @mysql_free_result($result);
        return $arrayKQParse;
    }
    
    
    function getKQXSMienBacNewest()
    {
        $sql = "SELECT   province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat ,giai_nhi_1, giai_nhi_2, 
                giai_ba_1, giai_ba_2,giai_ba_3,giai_ba_4,giai_ba_5,giai_ba_6,giai_tu_1,giai_tu_2,giai_tu_3, 
                giai_tu_4,giai_nam_1,giai_nam_2,giai_nam_3, giai_nam_4,giai_nam_5,giai_nam_6,giai_sau_1, 
                giai_sau_2,giai_sau_3,giai_bay_1,giai_bay_2,giai_bay_3,giai_bay_4 FROM  ketqua_mienbac Where giai_dacbiet is NOT NULL AND giai_dacbiet!='' Order by id DESC Limit 1";
        
        $result = @mysql_query($sql);
        $arrayKQParse= array();
         $i=0;
        while( $row = @mysql_fetch_assoc($result))  {
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;   
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi_1"]."-".$row["giai_nhi_2"]; 
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]."-".$row["giai_ba_3"]."-".$row["giai_ba_4"]."-".$row["giai_ba_5"]."-".$row["giai_ba_6"];  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"];  
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam_1"]."-".$row["giai_nam_2"]."-".$row["giai_nam_3"]."-".$row["giai_nam_4"]."-".$row["giai_nam_5"]."-".$row["giai_nam_6"];  
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"];  
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay_1"]."-".$row["giai_bay_2"]."-".$row["giai_bay_3"]."-".$row["giai_bay_4"]; 
            $i++; 
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    }
    
    function getKQXSMienTrung($date,$provinceId)
    {
        $date = date("Y-m-d");
        $sql = "SELECT  province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2,giai_tu_1, 
        giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7,giai_nam,giai_sau_1,giai_sau_2, 
        giai_sau_3,giai_bay,giai_tam FROM  ketqua_mientrung WHERE ngay_quay = '$date' And province_id = $provinceId ";
        
        $result = @mysql_query($sql);
        $row = @mysql_fetch_assoc($result);
        $arrayKQParse= array();
        
        if(!empty($row)) {
            $arrayKQParse[0]["province_id"] =$row["province_id"]   ;
            $arrayKQParse[0]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[0]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[0]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[0]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[0]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[0]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[0]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[0]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[0]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[0]["giai_tam"] =$row["giai_tam"]   ; 
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    } 
    
    
    function getKQXSMienTrungByTime($fDate,$tDate)
    {
        
        $sql = "SELECT  province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2,giai_tu_1, 
        giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7,giai_nam,giai_sau_1,giai_sau_2, 
        giai_sau_3,giai_bay,giai_tam FROM  ketqua_mientrung Where ngay_quay BETWEEN '$fDate' AND '$tDate' ";
        
        $intTime1day =86400;
        $intFTime = strtotime($fDate);
        $intTTime = strtotime($tDate);
        $arrayKQParseByTime = array();
        while($intFTime<=$intTTime)
        {
            $strDate = date("d/m/Y", $intFTime);;
            $arrayKQParseByTime[$strDate]=array();
            $intFTime+=$intTime1day;
        }
        
        $result = @mysql_query($sql);
        $arrayKQParse= array();
        $i=0;
        while( $row = @mysql_fetch_assoc($result)) {  
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$i]["giai_tam"] =$row["giai_tam"]   ; 
            
            foreach($arrayKQParseByTime as $key=>$value){
                if(strcasecmp($row["ngay_quay"],$key)==0){
                    $arrayKQParseByTime[$key][]=$arrayKQParse[$i];
                }
            }
            $i++;
        }
       
        $arrayKQParse = null;
        $arrayKQParse = array();
        
        foreach($arrayKQParseByTime as $key=>$value){
               $arrayKQParse[]=$value;
            }
            
        @mysql_free_result($result);
        return $arrayKQParse;
    } 
    
     function getKQXSMienTrungNewest()
    {
        $sql = "SELECT  province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2,giai_tu_1, 
        giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7,giai_nam,giai_sau_1,giai_sau_2, 
        giai_sau_3,giai_bay,giai_tam FROM  ketqua_mientrung Where ngay_quay = (SELECT MAX(ngay_quay) AS ngay_quay FROM  ketqua_mientrung WHERE (giai_dacbiet IS NOT NULL AND giai_dacbiet!='')) AND  (giai_dacbiet IS NOT NULL AND giai_dacbiet!='')";
        
        $result = @mysql_query($sql);
        $arrayKQParse= array();
        $i=0;
        while( $row = @mysql_fetch_assoc($result)) {  
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$i]["giai_tam"] =$row["giai_tam"]   ; 
            $i++;
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    } 
    
    function getKQXSMienNam($date,$provinceId)
    {
        $date = date("Y-m-d");
        $sql = "SELECT province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2, 
            giai_tu_1,giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7, 
            giai_nam,giai_sau_1,giai_sau_2,giai_sau_3,giai_bay,giai_tam FROM  ketqua_miennam Where ngay_quay = '$date' And province_id = $provinceId";
        
        $result = @mysql_query($sql);
        $row = @mysql_fetch_assoc($result);
        $arrayKQParse= array();
        
        if(!empty($row)) {
            $arrayKQParse[0]["province_id"] =$row["province_id"]   ;    
            $arrayKQParse[0]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[0]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[0]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[0]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[0]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[0]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[0]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[0]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[0]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[0]["giai_tam"] =$row["giai_tam"]   ; 
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    } 
    
    
    function getKQXSMienNamByTime($fDate,$tDate)
    {
        
        $sql = "SELECT province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2, 
            giai_tu_1,giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7, 
            giai_nam,giai_sau_1,giai_sau_2,giai_sau_3,giai_bay,giai_tam FROM  ketqua_miennam Where ngay_quay BETWEEN '$fDate' AND '$tDate'";
       
        $intTime1day =86400;
        $intFTime = strtotime($fDate);
        $intTTime = strtotime($tDate);
        $arrayKQParseByTime = array();
        while($intFTime<=$intTTime)
        {
            $strDate = date("d/m/Y", $intFTime);;
            $arrayKQParseByTime[$strDate]=array();
            $intFTime+=$intTime1day;
        }
        
        $result = @mysql_query($sql);
        $arrayKQParse= array();

        $i=0; 
        while( $row = @mysql_fetch_assoc($result)) {
         
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;    
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$i]["giai_tam"] =$row["giai_tam"]   ; 
            
             foreach($arrayKQParseByTime as $key=>$value){
                if(strcasecmp($row["ngay_quay"],$key)==0){
                    $arrayKQParseByTime[$key][]=$arrayKQParse[$i];
                }
            }
            
            $i++;
        }
        
        $arrayKQParse = null;
        $arrayKQParse = array();
        
        foreach($arrayKQParseByTime as $key=>$value){
               $arrayKQParse[]=$value;
            }
            
        @mysql_free_result($result);
        return $arrayKQParse;
    }   
    
    
    function getKQXSMienNamNewest()
    {
        $sql = "SELECT province_id,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,giai_dacbiet,giai_nhat,giai_nhi,giai_ba_1,giai_ba_2, 
            giai_tu_1,giai_tu_2,giai_tu_3,giai_tu_4,giai_tu_5,giai_tu_6,giai_tu_7, 
            giai_nam,giai_sau_1,giai_sau_2,giai_sau_3,giai_bay,giai_tam FROM  ketqua_miennam Where ngay_quay = (SELECT MAX(ngay_quay) AS ngay_quay FROM  ketqua_mientrung WHERE (giai_dacbiet IS NOT NULL AND giai_dacbiet!='')) AND  (giai_dacbiet IS NOT NULL AND giai_dacbiet!='')";
       
        $result = @mysql_query($sql);
        $arrayKQParse= array();

        $i=0; 
        while( $row = @mysql_fetch_assoc($result)) {
         
            $arrayKQParse[$i]["province_id"] =$row["province_id"]   ;    
            $arrayKQParse[$i]["ngay_quay"] =$row["ngay_quay"]   ;   
            $arrayKQParse[$i]["giai_dacbiet"] =$row["giai_dacbiet"]   ;  
            $arrayKQParse[$i]["giai_nhat"] =$row["giai_nhat"]   ;
            $arrayKQParse[$i]["giai_nhi"] =$row["giai_nhi"]   ;  
            $arrayKQParse[$i]["giai_ba"] =$row["giai_ba_1"]."-".$row["giai_ba_2"]   ;  
            $arrayKQParse[$i]["giai_tu"] =$row["giai_tu_1"]."-".$row["giai_tu_2"]."-".$row["giai_tu_3"]."-".$row["giai_tu_4"]."-".$row["giai_tu_5"]."-".$row["giai_tu_6"]."-".$row["giai_tu_7"]   ;    
            $arrayKQParse[$i]["giai_nam"] =$row["giai_nam"]   ; 
            $arrayKQParse[$i]["giai_sau"] =$row["giai_sau_1"]."-".$row["giai_sau_2"]."-".$row["giai_sau_3"]   ;   
            $arrayKQParse[$i]["giai_bay"] =$row["giai_bay"]   ; 
            $arrayKQParse[$i]["giai_tam"] =$row["giai_tam"]   ; 
            $i++;
        }
        
        @mysql_free_result($result);
        return $arrayKQParse;
    }   
     
    
    function getDream($title)
    {
        $sql = "SELECT id,title_long,alias, title, result  FROM  dream_book LIMIT 0, 50;";
        if(!empty($title))   $sql = "SELECT id,title_long,alias, title, result  FROM  dream_book Where title like '%$title%' LIMIT 0, 50;";
          
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ[]  =    $row;
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }  
    
    function getRegionByProvince($provinceId){
        $region = 0;
        switch ($provinceId){
            case 1:
                $region =  1;
                break;
             case 23:
             case 24:
             case 25:
             case 26:
             case 27:
             case 28:
             case 29:
             case 30:
             case 31:
             case 32:
             case 33:
             case 34:
             case 35:
             case 36:
                $region =  2;
                break;
             default :
                $region =  3;
                break;
        }
        return   $region;
    }
    
    function getTKDauSo($provinceId,$fromDate,$toDate)
    {
       
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate'  GROUP BY ngay_quay,dau_so
 order by id desc";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId  GROUP BY ngay_quay,dau_so
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId GROUP BY ngay_quay,dau_so
 order by id desc";    
        }
        
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ[]  =    $row;
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }  
    
     function iniDuoiSo(){
          $arrDD = array(); 
          $i= 0;
          while($i<10){
             $arrDD[$i]["dit_so"]  =   $i;
             $arrDD[$i]["solan"]  =   0; 
             $i++; 
          }
   
        return $arrDD;
     }
     
     function initDauSo(){
          $arrDD = array(); 
          $i= 0;
          while($i<10){
             $arrDD[$i]["dau_so"]  =   $i;
             $arrDD[$i]["solan"]  =   0; 
             $i++; 
          }
   
        return $arrDD;
     }
     
     function getTKDauSoDangBang($provinceId,$fromDate,$toDate)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate'  GROUP BY ngay_quay,dau_so
 ORDER BY ngay_quay DESC,dau_so ASC";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId  GROUP BY ngay_quay,dau_so
  ORDER BY ngay_quay DESC,dau_so ASC";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dau_so,COUNT(dau_so) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId GROUP BY ngay_quay,dau_so
 ORDER BY ngay_quay DESC,dau_so ASC";    
        }
        
    
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        $dateTmp = strtotime($fromDate);
        $arrDateTK = array();
        while($dateTmp<=strtotime($toDate)) {
             $strddmmYY = date( "d/m/Y", $dateTmp);
             $arrDateTK[$strddmmYY] = initDauSo();
             $dateTmp   =  $dateTmp + 24*60*60;
          
        }    
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ["dau_so"]  =    $row["dau_so"];
           $arrayKQ["solan"]  =    $row["solan"]; 
           
           foreach ($arrDateTK as $key => $value) {
                  
                    if(strcmp($key,$row["ngay_quay"])==0)  { $arrDateTK[$key][ $arrayKQ["dau_so"]]= $arrayKQ;}
             }
           
        }

        @mysql_free_result($result);
        return $arrDateTK;
    }  
    
    
     function getTKDuoiSoDangBang($provinceId,$fromDate,$toDate)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate'  GROUP BY ngay_quay,dau_so
 ORDER BY ngay_quay DESC,dau_so ASC";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId  GROUP BY ngay_quay,dau_so
  ORDER BY ngay_quay DESC,dau_so ASC";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId GROUP BY ngay_quay,dau_so
 ORDER BY ngay_quay DESC,dau_so ASC";    
        }
        
    
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        $dateTmp = strtotime($fromDate);
        $arrDateTK = array();
        while($dateTmp<=strtotime($toDate)) {
             $strddmmYY = date( "d/m/Y", $dateTmp);
             $arrDateTK[$strddmmYY] = iniDuoiSo();
             $dateTmp   =  $dateTmp + 24*60*60;
          
        }
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ["dit_so"]  =    $row["dit_so"];
           $arrayKQ["solan"]  =    $row["solan"]; 
           
           foreach ($arrDateTK as $key => $value) {
                  
                    if(strcmp($key,$row["ngay_quay"])==0)  { $arrDateTK[$key][ $arrayKQ["dit_so"]]= $arrayKQ;}
             }
           
        }

        @mysql_free_result($result);
        return $arrDateTK;
    }  
    
    function getTKDuoiSo($provinceId,$fromDate,$toDate)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate'  GROUP BY ngay_quay,dit_so
 order by id desc";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId  GROUP BY ngay_quay,dit_so
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay,dit_so,COUNT(dit_so) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId GROUP BY ngay_quay,dit_so
 order by id desc";    
        }
        
        
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ[]  =    $row;
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function initBoKep()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("00","11","22","33","44","55","66","77","88","99");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoSatKep()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("01","10","12","21","23","32","34","43","45","54","56","65","67","76","78","87","89","98");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];   
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoTongChan()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("00","02","04","06","08","11","13","15","17","19","20","22","24","26","28","31","33","35","37","39","40","42","44","46","48","51","53","55","57","59","60","62","64","66","68","71","73","75","77","79","80","82","84","86","88","91","93","95","97","99");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoTongLe()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("01","03","05","07","09","10","12","14","16","18","21","23","25","27","29","30","32","34","36","38","41","43","45","47","49","50","52","54","56","58","61","63","65","67","69","70","72","74","76","78","81","83","85","87","89","90","92","94","96","98");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoChanLe()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("01","03","05","07","09","21","23","25","27","29","41","43","45","47","49","61","63","65","67","69","81","83","85","87","89");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoLeChan()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("10","12","14","16","18","30","32","34","36","38","50","52","54","56","58","70","72","74","76","78","90","92","94","96","98");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function initBoLeLe()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("11","13","15","17","19","31","33","35","37","39","51","53","55","57","59","71","73","75","77","79","91","93","95","97","99");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     
     function initBoChanChan()
     {
         $arrayBoKep = array();
         $arrayBoChanChan= array("00","02","04","06","08","20","22","24","26","28","40","42","44","46","48","60","62","64","66","68","80","82","84","86","88");  
         $i = 0;
         while($i<count($arrayBoChanChan)){
                 $arrayBoKep[$arrayBoChanChan[$i]] = array();
                 $arrayBoKep[$arrayBoChanChan[$i]]["boso"] = $arrayBoChanChan[$i];    
                 $arrayBoKep[$arrayBoChanChan[$i]]["ngay_quay"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["solan"] = "";
                 $arrayBoKep[$arrayBoChanChan[$i]]["songaychuave"] = "";     
                 $i++;
         } 
            
            return     $arrayBoKep;
     }
     
     function getBoTongChan()
     {
          $i   = 0;
          while($i<100){
              if($i<10) $tong = $i;
              else 
              {
                $tong  = intval(substr(strval($i),0,1)) +  intval(substr(strval($i),1,1));
               
              }
              if($tong%2==0) echo  '"'.$i.'",' ;
              $i++;
          }
     }
     
     function getBoTongLe()
     {
          $i   = 0;
          while($i<100){
              if($i<10) $tong = $i;
              else 
              {
                $tong  = intval(substr(strval($i),0,1)) +  intval(substr(strval($i),1,1));
               
              }
              if($tong%2!=0) echo  '"'.$i.'",' ;
              $i++;
          }
     }
     
     
     function getBoChanLe()
     {
          $i   = 0; $boso ="";
          while($i<100){
              if($i<10)  {$boso =  "0".strval($i);}  else $boso  = strval($i);
              
              $dau  =intval(substr(strval($boso),0,1));
              $duoi =  intval(substr(strval($boso),1,1));
            
              if($dau%2==0&&$duoi%2!=0) echo  '"'.$boso.'",' ;
              $i++;
          }
     }
     
     
     function getBoLeChan()
     {
          $i   = 0; $boso ="";
          while($i<100){
              if($i<10)  {$boso =  "0".strval($i);}  else $boso  = strval($i);
              
              $dau  =intval(substr(strval($boso),0,1));
              $duoi =  intval(substr(strval($boso),1,1));
            
              if($dau%2!=0&&$duoi%2==0) echo  '"'.$boso.'",' ;
              $i++;
          }
     }
     
     function getBoLeLe()
     {
          $i   = 0; $boso ="";
          while($i<100){
              if($i<10)  {$boso =  "0".strval($i);}  else $boso  = strval($i);
              
              $dau  =intval(substr(strval($boso),0,1));
              $duoi =  intval(substr(strval($boso),1,1));
            
              if($dau%2!=0&&$duoi%2!=0) echo  '"'.$boso.'",' ;
              $i++;
          }
     }
     
     
     function getBoChanChan()
     {
          $i   = 0; $boso ="";
          while($i<100){
              if($i<10)  {$boso =  "0".strval($i);}  else $boso  = strval($i);
              
              $dau  =intval(substr(strval($boso),0,1));
              $duoi =  intval(substr(strval($boso),1,1));
            
              if($dau%2==0&&$duoi%2==0) echo  '"'.$boso.'",' ;
              $i++;
          }
     }
     
     function getTKBoKep($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bokep = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bokep = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bokep = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

       /// echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoKep();
        
        while($row = @mysql_fetch_assoc($result)) {
            
              foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
        }
        
        @mysql_free_result($result);
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        
        return $arrKQCuoi;
    }                    
    
    function getTKBoSatKep($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi,ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bosatkep = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi,ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bosatkep = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi,ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bosatkep = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoSatKep();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        
        return $arrKQCuoi;
    }  
    
    function getTKTongChan($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_tongchan = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_tongchan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_tongchan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoTongChan();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }                                      
    
    
     function getTKTongLe($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as  ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_tongle = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_tongle = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_tongle = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoTongLe();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }
    
    
     function getTKBoChanLe($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bochanle = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bochanle = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bochanle = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoChanLe();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }
    
    
    function getTKBoLeChan($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bolechan = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bolechan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bolechan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoLeChan();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }
    
     function getTKBoChanChan($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bochanchan = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bochanchan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bochanchan = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoChanChan();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }
    
     function getTKBoLeLe($provinceId,$fromDate,$toDate,$isDacBiet)
    {
        $region = getRegionByProvince($provinceId);
        
        if($region==1){
            $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mienbac WHERE  ngay_quay BETWEEN '$fromDate' AND '$toDate' AND is_bolele = 1 And is_dacbiet =  $isDacBiet  GROUP BY ngay_quay,boso
 order by id desc ";    
        }else if($region==2){
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_mientrung WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And province_id = $provinceId AND is_bolele = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        } else {
              $sql = "SELECT DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay_vi, ngay_quay,boso,COUNT(boso) as solan FROM thongke_loto_miennam WHERE  (ngay_quay BETWEEN '$fromDate' AND '$toDate') And  province_id = $provinceId AND is_bolele = 1 And is_dacbiet =  $isDacBiet GROUP BY ngay_quay,boso
 order by id desc";    
        }

        ///echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ= initBoLeLe();
        
        while($row = @mysql_fetch_assoc($result)) {
            
            foreach($arrayKQ as $key => $item){
                      if($key == $row["boso"] )
                      {
                        $arrayKQ[$key]["solan"] = $arrayKQ[$key]["solan"]+ $row["solan"]   ;
                        if(empty($item["ngay_quay"])||date($item["ngay_quay"])<date($row["ngay_quay"]))
                        {
                            $arrayKQ[$key]["ngay_quay"] = $row["ngay_quay_vi"]; 
                            
                            $datetime1 = date_create($row["ngay_quay"]);
                            $datetime2 = date_create($toDate);
                            $interval = date_diff($datetime1, $datetime2);   
                            
                            $arrayKQ[$key]["songaychuave"] = $interval->days;  
                        }
                      }
               }
               
           
        }
        
        @mysql_free_result($result);
        
        $arrKQCuoi = array();
        foreach($arrayKQ as $key => $row){
                   $arrKQCuoi[] = $row;
        }
        
        return $arrKQCuoi;
    }
    
    function getProvince()
    {
        $sql = "SELECT id,CODE,NAME,alias,region FROM   vtc_10h_xs.province  ";
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQParse= array();
        
        $file = '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/province.txt';
        // Open the file to get existing content
        $current = "";
      

        while($row = @mysql_fetch_assoc($result)) {
                echo $row["NAME"]."-".$row["id"]."<br/>";
                $province = $row["NAME"]."-".$row["id"]."-".$row["CODE"]."-".$row["region"]." \n";
                // Append a new person to the file
                $current .= $province;
                // Write the contents back to the file
                file_put_contents($file, $current);
        }
        
        @mysql_free_result($result);
    }
    
    function getDreamFile()
    {
        $sql = "SELECT id,title_long,alias, title, result  FROM  dream_book";
    
        $result = @mysql_query($sql);
        $arrayKQ= array();
        
        $file = '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/dream.txt';
        // Open the file to get existing content
        $current = "";
        
        while($row = @mysql_fetch_assoc($result)) {
           $arrayKQ[]  =    $row;
           echo $row["title"]."-".$row["result"]."<br/>";
           $dream = $row["title"]."-".$row["result"]." \n";
           
           // Append a new person to the file
           $current .= $dream;
           // Write the contents back to the fil
           file_put_contents($file, $current);
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }  
    
    function getThreadHot()
    {
        $sql = "SELECT  id,title,description,image,count_comment,count_view FROM vtc_10h_xs.thread_hot Order By id  limit 10 ";
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
               
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function getThreadHotComment($id_thread,$page,$limit)
    {
        $id_thread  = intval($id_thread);
        $page  = intval($page); 
        $limit  = intval($limit)>100?100:intval($limit); 
        $fromItem = ($page-1)*$limit; 
        
        $sql = "SELECT  c.id,c.id_thread,c.id_user,c.comment,u.username,u.avatar_url FROM vtc_10h_xs.threat_hot_comment c Left JOIN vtc_10h_xs.user_veso u ON c.id_user  = u.id Where c.id_thread =  $id_thread Order By c.id DESC LIMIT $fromItem, $limit";
      //  echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
               
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function getThreadHotCommentFromId($id_thread,$id,$limit)
    {
        $id_thread  = intval($id_thread);
        $id  = intval($id); 
        $limit  = intval($limit)>100?100:intval($limit); 
        
        $sql = "SELECT  c.id,c.id_thread,c.id_user,c.comment,u.username,u.avatar_url FROM vtc_10h_xs.threat_hot_comment c Left JOIN vtc_10h_xs.user_veso u ON c.id_user  = u.id Where c.id < $id And c.id_thread =  $id_thread Order By c.id DESC LIMIT $limit";
       
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
               
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function saveComment($id_thread, $id_user, $comment,$username)
    {   
        $create_date = time();
        $id_thread = intval($id_thread) ;
        $id_user = intval($id_user)  ;
        $create_date =  date("Y-m-d H:m:s");
        $sql ="INSERT INTO vtc_10h_xs.threat_hot_comment ( id_thread, id_user, COMMENT,create_date,create_user,update_date,update_user ) VALUES ($id_thread, 
    $id_user,'$comment','$create_date','$username','$create_date','$username');
" ;
       // echo $sql;
       $result =  @mysql_query($sql); 
       return  $result;  
    }  
    
    function updateThreadCountComment($id_thread)
    {   
       $id_thread = intval($id_thread)  ;
       $create_date =  date("Y-m-d H:m:s");
       $sql ="UPDATE vtc_10h_xs.thread_hot SET count_comment = count_comment+1 Where id =  $id_thread" ;
      
       $result =  @mysql_query($sql); 
       return  $result;  
    } 
    
    function updateThreadCountView($id_thread)
    {   
       $id_thread = intval($id_thread)  ;
       $create_date =  date("Y-m-d H:m:s");
       $sql ="UPDATE vtc_10h_xs.thread_hot SET count_view = count_view+1 Where id =  $id_thread" ;
      
       $result =  @mysql_query($sql); 
       return  $result;  
    } 
    
    // count total comment by thread_id
     function countCommentThread($id_thread)
    {
        $id_thread = intval($id_thread);
        $sql = "SELECT COUNT(*) as sl FROM threat_hot_comment WHERE id_thread = $id_thread";
           
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result,0);
        @mysql_free_result($result);
          
        return $total["sl"];
    }
    
    function getTKLotoGanCucDai()
    {
        
        $preTime = time() - (24 * 60 * 60);
        $preDay = date('Y-m-d', $preTime);
        
        $sql = "SELECT id,boso,lanquay_cucdai,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date,lanquay_chuave,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay FROM vtc_10h_xs.thongke_loto_gan_cucdai  Where  DATE_FORMAT(create_date,'%Y-%m-%d')= '$preDay'";
        //echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
               
        }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function getTKLotoDenKySoVoiKyGanNhat()
    {
       
        $preTime = time() - (24 * 60 * 60);
        $preDay = date('Y-m-d', $preTime);
        $sql = "SELECT id,boso,dodai_chuky,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date FROM vtc_10h_xs.thongke_loto_denky WHERE TYPE = 0 And  DATE_FORMAT(create_date,'%Y-%m-%d')= '$preDay'";
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function getTKLotoDenKySoVoiKyCucDai()
    {
        $preTime = time() - (24 * 60 * 60);
        $preDay = date('Y-m-d', $preTime);
       
        $sql = "SELECT id,boso,dodai_chuky,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date FROM vtc_10h_xs.thongke_loto_denky WHERE TYPE = 1 And   DATE_FORMAT(create_date,'%Y-%m-%d')= '$preDay'"; 
        
      //  echo $sql;
       
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function getTKChuKyLoTo($boso,$is_special)
    {
        $today = date("Y-m-d");
        $sql = "SELECT boso,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date,LENGTH as dodai_chuky,is_special FROM vtc_10h_xs.thongke_chuky_boso WHERE is_special = $is_special AND DATEDIFF(CURRENT_DATE,end_date)<=60 AND end_date IS NOT NULL AND boso = $boso And province_id = 1 
 order by id desc  "; 
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    
    function getTK12BoSoRaNhieu($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT boso,COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay GROUP BY boso Order by sl desc limit 12"; 
       
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function getTK12BoSoRaIt($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT boso,COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay GROUP BY boso Order by sl asc limit 12"; 
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function countTongBoSoMoThuong($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT COUNT(boso) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay"; 
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result,0);
        @mysql_free_result($result);
        return $total["sl"];
    }
    
     function getTKBoSoRaLienTiep()
    {
        //$today = date("Y-m-d");
        $preTime = time() - (24 * 60 * 60);
        $preDay = date('Y-m-d', $preTime);
        $sql = "SELECT boso,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date ,length as dodai_chuky FROM thongke_boso_ve_lientiep WHERE province_id = 1   AND LENGTH > 1 AND end_date = '$preDay'"; 
       // echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function getTKDauSoMoThuong($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT dau_so,COUNT(dau_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay GROUP BY dau_so ORDER BY dau_so"; 
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function countTongDauSoMoThuong($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT COUNT(dau_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay"; 
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result,0);
        @mysql_free_result($result);
        return $total["sl"];
    }
    
    function getTKDuoiSoMoThuong($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT dit_so,COUNT(dit_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay GROUP BY dit_so ORDER BY dit_so"; 
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
         
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
    function countTongDuoiSoMoThuong($songay)
    {
        $songay   = intval($songay);
        $sql = "SELECT COUNT(dit_so) AS sl FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay"; 
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result,0);
        @mysql_free_result($result);
        return $total["sl"];
    }  
    
    function getTKBoSoMBXuatHienTheoSoNgay($songay)
    {
        $songay   = intval($songay);
       
        $sql = "SELECT DISTINCT boso FROM thongke_loto_mienbac WHERE DATEDIFF(CURRENT_DATE,ngay_quay)<$songay"; 
        //echo $sql;
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
    
        while($row = @mysql_fetch_assoc($result)) {
              $arrayKQ[] =   $row["boso"];
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    } 
    
      function getTKBoSoMBGanTren10Ngay($songay)
    {
              $arrBoSOXh = getTKBoSoMBXuatHienTheoSoNgay(10);
              $arrLotoGan = array();
              $listBoso ="";
              $j= 0;   $sl   = 0;
              while($j<=99)
              {
                  $i = 0;  $kt=0;$boso =$j;
                  
                  while($i<count($arrBoSOXh)){
                      if($j==intval($arrBoSOXh[$i]))
                      {
                         
                        $kt=1;break;  
                      }
                      $i++;
                  }
                  
                  if($kt==0)
                  {
                      $arrLotoGan[$j] =   intval($boso)<10?"0".$boso:$boso; 
                      $boso = intval($boso)<10?"0".$boso:$boso; 
                      $listBoso .=  ",".$boso ;
                      $sl = $sl+1;
                      
                  }
               
                  $j++;
              }
           
              $listBoso = substr($listBoso,1);
              
              $sql = "SELECT DISTINCT boso,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay_quay ,DATEDIFF(CURRENT_DATE,ngay_quay) as so_ngay FROM thongke_loto_mienbac WHERE boso in ($listBoso) And DATEDIFF(CURRENT_DATE,ngay_quay)<=60 Order by id DESC "; 
            // echo $sql;
              $result = @mysql_query($sql);
              $arrayKQ = array(); 
            
                while($row = @mysql_fetch_assoc($result)) {
                    $check=0;
                    foreach($arrayKQ as $itemkq){
                        if($itemkq["boso"]==$row["boso"])$check = 1;
                    }
                    if($check==0)
                      $arrayKQ[] =   $row;
                 }
        
              @mysql_free_result($result);
              return $arrayKQ;
               
    }
    
     function getTKGiaiDacBietTheoNgay($ngay)
    {
        $sql = "SELECT giai_dacbiet,DATE_FORMAT(ngay_quay,'%w') as thu,DATE_FORMAT(ngay_quay,'%d/%m/%Y') as ngay,DATE_FORMAT(ngay_quay,'%Y') as nam FROM ketqua_mienbac WHERE DATE_FORMAT(ngay_quay,'%d-%m') = '$ngay' Order by ID DESC
";      $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $i=0;
        while($row = @mysql_fetch_assoc($result)) {
              $thu = intval($row["thu"])+1;
              if($thu==1) $thu=" CN " ; else    $thu ="T ".$thu." "  ;
              
              $arrayKQ[$i]["giai_dacbiet"]=   $row["giai_dacbiet"] ;
              $arrayKQ[$i]["ngay_quay"]= $thu.", ". $row["ngay"]; 
              $arrayKQ[$i]["nam"]=  $row["nam"] ;
              $i++;
         }
        
        @mysql_free_result($result);
        return $arrayKQ;
    }
    
     function getUserXoSo($app_client_id)
    {
        $app_client_id   = intval($app_client_id);
        $sql = "SELECT app_client_id,username,fullname,avatar_url,email,mobile,address,tk_chinh FROM vtc_10h_xs.user_veso  WHERE app_client_id= '$app_client_id'
";     
        $result = @mysql_query($sql);
        $arrayKQ = array(); 
        $arrayKQ = @mysql_fetch_assoc($result);
        
        @mysql_free_result($result);
        return $arrayKQ;
    } 
    
     function getTaiKhoanChinh($app_client_id)
    {
        $songay   = intval($songay);
        $sql = "SELECT tk_chinh FROM vtc_10h_xs.user_veso  WHERE app_client_id= '$app_client_id'
";     
        $result = @mysql_query($sql);
        $tk_chinh=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        if(!empty($arrayKQ)) $tk_chinh=  intval($arrayKQ["tk_chinh"]) ;
        
        @mysql_free_result($result);
        return $tk_chinh;
    } 
    
    function getProvinceOpen()
    {
       // $songay   = intval($songay);
        $sql = "SELECT id,code,name,region FROM province WHERE thu";    
        $i   = 2;
        $arrayProvinceOpen = array();
        while($i<=8) {
            $sql ="SELECT id,code,name,region FROM province WHERE thu".$i."=1";
            $result = @mysql_query($sql);
            while($arrayKQ = @mysql_fetch_assoc($result)){
                  $arrayProvinceOpen["thu".$i][]= $arrayKQ;
            } 
           
            $i++;
        }
                
        @mysql_free_result($result);
        return $arrayProvinceOpen;
    }
    
    function updateUser($app_client_id,$username,$fullname,$email,$mobile,$address){
       $modify_date = date("Y-m-d H:i:s");
      
       $app_client_id = cleanQuery($app_client_id);
       $username = cleanQuery($username);
       $fullname = cleanQuery($fullname);
       $email = cleanQuery($email);
       $mobile = cleanQuery($mobile);
       $address = cleanQuery($address);
        $sql = "UPDATE user_veso SET username = '$username',fullname='$fullname',mobile='$mobile',email='$email',address='$address', modify_user='servicexs', modify_date='$modify_date' WHERE app_client_id = '$app_client_id' ;";
       if(empty($mobile))
       $sql = "UPDATE user_veso SET username = '$username',fullname='$fullname',email='$email',address='$address', modify_user='servicexs', modify_date='$modify_date' WHERE app_client_id = '$app_client_id' ;";
       $result = @mysql_query($sql);  
      // writeLogSQL($sql); 
       return $result;
   }
    
    
    function updateUserName($app_client_id,$username){
       $create_date = date("Y-m-d H:i:s");
       $sql = "UPDATE user_veso SET username = '$username', modify_user='servicexs', modify_date='$create_date' WHERE app_client_id = '$app_client_id' ;";
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function createPasswordWeb($app_client_id,$password){
       $create_date = date("Y-m-d H:i:s");
       $password = md5(md5($password));
       $sql = "UPDATE user_veso SET password = '$password', modify_user='servicexs', modify_date='$create_date' WHERE app_client_id = '$app_client_id' ;";
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function addKenByAppClient($app_client_id,$ken){
       $create_date = date("Y-m-d H:i:s");
       $ken = intval($ken);
       $app_client_id = intval($app_client_id);
       $sql = "UPDATE user_veso SET tk_chinh = tk_chinh + '$ken', modify_user='servicexs', modify_date='$create_date' WHERE app_client_id = '$app_client_id' ;";
       $result = @mysql_query($sql);   
       return $result;
   }
   
   
   function addKenByUsername($username,$ken){
       $create_date = date("Y-m-d H:i:s");
       $ken = intval($ken);
       $username = cleanQuery($username);
       $sql = "UPDATE user_veso SET tk_chinh = tk_chinh + '$ken', modify_user='servicexs', modify_date='$create_date' WHERE username = '$username' ;";
       $result = @mysql_query($sql);   
       return $result;
   }
    
     function updateAvatarUserName($app_client_id,$avatar_url){
       $create_date = date("Y-m-d H:i:s");
       $sql = "UPDATE user_veso SET avatar_url = '$avatar_url', modify_user='servicexs', modify_date='$create_date' WHERE app_client_id = '$app_client_id' ;";
       //echo $sql;
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function checkUserName($username)
    {
        $username= cleanQuery($username);
        $sql = "SELECT * FROM user_veso  WHERE username= '$username'";     
        $result = @mysql_query($sql);

        $kq=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        
        if(!empty($arrayKQ)) $kq=  1;
        
        @mysql_free_result($result);
        return $kq;
    } 
    
     function checkUserNameUpdateInfo($username,$app_client_id)
    {
        $username= cleanQuery($username);
        $app_client_id = cleanQuery($app_client_id);
        
        $sql = "SELECT * FROM user_veso  WHERE username= '$username' And  id NOT IN (SELECT id FROM user_veso  WHERE app_client_id= '$app_client_id')";
        $result = @mysql_query($sql);

        $kq=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        
        if(!empty($arrayKQ)) $kq=  1;
        
        @mysql_free_result($result);
        return $kq;
    } 
    
    
    function checkMobileUpdateInfo($mobile,$app_client_id)
    {
        $username= cleanQuery($username);
        $app_client_id = cleanQuery($app_client_id);
        
        $sql = "SELECT * FROM user_veso  WHERE mobile= '$mobile' And  id NOT IN (SELECT id FROM user_veso  WHERE app_client_id= '$app_client_id')";
        $result = @mysql_query($sql);

        $kq=0;
        $arrayKQ = @mysql_fetch_assoc($result);
        
        if(!empty($arrayKQ)) $kq=  1;
        
        @mysql_free_result($result);
        return $kq;
    }
    
    
     function getUserByAppClientId($app_client_id)
    {
        $app_client_id= cleanQuery($app_client_id);
        
        $sql = "SELECT * FROM user_veso  WHERE app_client_id= '$app_client_id'";     
        $result = @mysql_query($sql);

        $arrayKQ = @mysql_fetch_assoc($result);

        @mysql_free_result($result);
        
        return $arrayKQ;
    } 
    
    function uploadAvatar1(){
        $uploaddir = '../upload/avatarxs/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;
        
        var_dump($_FILES);
        var_dump($uploadfile);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo "OK";
        } else {
            echo "ERROR";
        }
     //   move_uploaded_file ($_FILES['uploadFile'] ['tmp_name'], 
     // "../uploads/{$_FILES['uploadFile'] ['name']}")
    }
    
    function uploadAvatar($app_client_id){
         $uploaddir = '/upload/avatarxs/';
        try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error'])
            ) {
                //throw new RuntimeException('Invalid parameters.');
               // throw new RuntimeException('1.');
               echo 1;return;
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //throw new RuntimeException('No file sent.');
                    throw new RuntimeException('2');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    //throw new RuntimeException('Exceeded filesize limit.');
                    throw new RuntimeException('3');
                default:
                    //throw new RuntimeException('Unknown errors.');
                    throw new RuntimeException('100');
            }

            // You should also check filesize here. 
            if ($_FILES['upfile']['size'] > 10000000) {
                throw new RuntimeException('3');
            }

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['upfile']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                //throw new RuntimeException('Invalid file format.');
                throw new RuntimeException('5');
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
             $pathdate = date("Y/md/");
             $file = basename($_FILES['upfile']['name']);
             $file = basename($file, ".".$ext)."-".$app_client_id.".".$ext;
             $file = sanitize($file,true);
             $pathUrl= $uploaddir.$pathdate;
             $uploaddir = "..".$uploaddir.$pathdate;
             makeFolder($uploaddir);
             ///echo $uploaddir."<br>"; 
             $uploadfile =$uploaddir . $file;
        
            if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile)) {
                //throw new RuntimeException('Failed to move uploaded file.');
                throw new RuntimeException('4');
            }else{
                $avatar_url="http://kenhkiemtien.com".$pathUrl . $file;
                updateAvatarUserName($app_client_id,$avatar_url);
            }
            
           // echo  basename($file, ".".$ext);
          
            
            echo '0';

        } catch (RuntimeException $e) {

            echo $e->getMessage();

        }
    }
    
    
    function insertChat($id_user,$username,$avatar_url,$content,$deviceName,$region){
       $id_user = intval($id_user);
       $username = cleanQuery($username);
       $content = cleanQuery($content);
       $deviceName = cleanQuery($deviceName);
       $region = cleanQuery($region);
       
       $sql = "INSERT INTO xs_chat (id_user, username, avatar_url, content,  deviceName, region)
        VALUES ('$id_user', '$username', '$avatar_url', '$content',  '$deviceName', '$region');";
       $result = @mysql_query($sql);   
       return $result;
   }
   
     function getChatBox($region,$page,$limit)
    {   
        $limit  = intval($limit)>100?100:intval($limit); 
        $page = intval($page);
        $region = cleanQuery($region);
        $startRecord = ($page - 1) * $limit;
        $sql = "SELECT  c.id,u.username, u.avatar_url, c.content, DATE_FORMAT(c.createtime,'%H:%i') as createtime, c.deviceName, c.region FROM vtc_10h_xs.xs_chat c Left Join user_veso u On c.id_user = u.id WHERE c.region = $region  ORDER BY c.id DESC LIMIT $startRecord, $limit;";
      
        // echo $sql;
        $result = @mysql_query($sql);
        $arrayChat =array();
        $arrayChatSort =array();     
        $i=0;
        while($arr = @mysql_fetch_assoc($result)){
            $arrayChat[$i]=$arr;  
            $i++;
        }
        $i=count($arrayChat)-1;$j=0;
        while($i>=0){
            $arrayChatSort[$j]=$arrayChat[$i];
            $j++;$i--;
        }
        @mysql_free_result($result);
        $arrayChat=null;
        return $arrayChatSort;
    }
    
    
     function getChatBoxFromID($id,$region,$limit)
    {   
       $limit  = intval($limit)>100?100:intval($limit); 
        $id = intval($id);
        $region = intval($region);
        
        $sql = "SELECT  c.id,u.username, u.avatar_url, c.content, DATE_FORMAT(c.createtime,'%H:%i') as createtime, c.deviceName, c.region FROM vtc_10h_xs.xs_chat c Left Join user_veso u On c.id_user = u.id WHERE c.id > $id And c.region = $region  ORDER BY c.id DESC LIMIT  $limit;";
      
        $result = @mysql_query($sql);
        $arrayChat =array();
        $arrayChatSort =array();     
        $i=0;
        while($arr = @mysql_fetch_assoc($result)){
            $arrayChat[$i]=$arr;  
            $i++;
        }
        $i=count($arrayChat)-1;$j=0;
        while($i>=0){
            $arrayChatSort[$j]=$arrayChat[$i];
            $j++;$i--;
        }
        @mysql_free_result($result);
        $arrayChat=null;
        return $arrayChatSort;
    }
    
    function countChat($region)
    {
        $region = cleanQuery($region);
        $sql = "SELECT  count(*) as sl FROM vtc_10h_xs.xs_chat Where region = $region  ";
       
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result);
       
        @mysql_free_result($result);
       
        return $total["sl"];
    }
    
     function getIdUserFromClientId($app_client_id)
    {
        $app_client_id = cleanQuery($app_client_id);
        $sql = "SELECT  id FROM vtc_10h_xs.user_veso Where app_client_id = $app_client_id  ";
        
        $result = @mysql_query($sql);
        $user = @mysql_fetch_assoc($result);
        
        if(empty($user)) return 0;

        @mysql_free_result($result);
        return $user["id"];
    }
    
     function insertNoticeIOSUser($app_client_id,$device_token,$username,$ip_address,$app_header){
       $app_client_id = intval($app_client_id);
       $device_token = cleanQuery($device_token);
       $username = cleanQuery($username);
       $ip_address = cleanQuery($ip_address);
       $app_header = cleanQuery($app_header);
       
       $sql = "INSERT INTO vtc_10h_xs.xs_notice_ios_user (app_client_id,device_token,username,ip_address,create_date,app_header) VALUES ('$app_client_id','$device_token','$username','$ip_address',NOW(),'$app_header');";
       
     //  writeLogSQL($sql);
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function insertNoticeAndroidUser($app_client_id,$device_token,$username,$ip_address){
       $app_client_id = intval($app_client_id);
       $device_token = cleanQuery($device_token);
       $username = cleanQuery($username);
       $ip_address = cleanQuery($ip_address);
       
       $sql = "INSERT INTO vtc_10h_xs.xs_notice_android_user (app_client_id,device_token,username,ip_address,create_date) VALUES ('$app_client_id','$device_token','$username','$ip_address',NOW());";
       
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function updateTokenIOSNotice($app_client_id,$device_token){
       $app_client_id = intval($app_client_id);
       $device_token = cleanQuery($device_token);
   
       $sql = "UPDATE vtc_10h_xs.xs_notice_ios_user SET  device_token = '$device_token'  WHERE app_client_id = '$app_client_id' ";
       
       $result = @mysql_query($sql);   
       return $result;
   }
   
   function checkTokenIOSExist($app_client_id)
    {
        $region = cleanQuery($region);
        $sql = "SELECT  count(*) as sl FROM vtc_10h_xs.xs_notice_ios_user Where app_client_id = '$app_client_id'";
       
        $result = @mysql_query($sql);
        $total = @mysql_fetch_assoc($result);
       
        @mysql_free_result($result);
        return $total["sl"];
    }
    
    function getNoticeAdroid($app_client_id)
    {
        $app_client_id = intval($app_client_id);
        $sql = "SELECT id,notice_id, payload FROM vtc_10h_xs.xs_notice_android_queue WHERE app_client_id  = $app_client_id And NOW()> time_sent ORDER BY id ASC LIMIT 1";
        
        $notice = array();
        $result = @mysql_query($sql);
        $notice = @mysql_fetch_assoc($result);
       
        @mysql_free_result($result);
        return $notice;
    }
    
    function deleteNoticeAndroid($queue_id){
       $queue_id = intval($queue_id);
       
       $sql = "DELETE FROM vtc_10h_xs.xs_notice_android_queue  WHERE id = '$queue_id' ;";
       
       $result = @mysql_query($sql);   
       return $result;
   }
   
   
 function writeLogSQL($mo){
    $date = date('Y-m-d H:i:s');
    $file = dirname(__FILE__).'/logXoSoSQL.txt';
    
    // Open the file to get existing content
    //$current = file_get_contents($file);
    // Append a new person to the file
    $current =$date."  :  ". $mo."\n";
    
    // Write the contents back to the file
    file_put_contents($file, $current,FILE_APPEND | LOCK_EX);
 }


?>