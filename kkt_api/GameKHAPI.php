<?php
    $output = array();
    $header = isset($_GET['header']) ?$_GET['header'] :"" ;

    switch($header){

        
        case "BaPlay" :{
            
            $sms1 =array();
            $sms1['content']= "BU10 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU10";
            
            $sms2 =array();
            $sms2['content']= "GM6 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM6";
            
            $sms3 =array();
            $sms3['content']= "BU16 G ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU16";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 5;
            
            echo json_encode($output);
            break;
        }
        case "BaPlay218" :{
            
            $sms1 =array();
            $sms1['content']= "BU14 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU14";
            
            $sms2 =array();
            $sms2['content']= "GM10 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM10";
            
            $sms3 =array();
            $sms3['content']= "BU14 G ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU14";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 5;
            
            echo json_encode($output);
            break;
        }
        case "BaPlay109" :{
            
            $sms1 =array();
            $sms1['content']= "BU17 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU17";
            
            $sms2 =array();
            $sms2['content']= "GM14 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM14";
            
            $sms3 =array();
            $sms3['content']= "XXE G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "XXE";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 5;
            
            echo json_encode($output);
            break;
        }
        case "BaPlay179" :{
            
            $sms1 =array();
            $sms1['content']= "EK3 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "EK3";
            
            $sms2 =array();
            $sms2['content']= "HL3 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "HL3";
            
            $sms3 =array();
            $sms3['content']= "EK3 G ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "EK3";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "BaWeb" :{
            
            $sms1 =array();
            $sms1['content']= "BU16 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU16";
            
            $sms2 =array();
            $sms2['content']= "GM12 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM12";
            
            $sms3 =array();
            $sms3['content']= "XXD G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "XXD";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "wap2u" :{
            
            $sms1 =array();
            $sms1['content']= "XXF G ";
            $sms1['serviceNumber']= "8777";
            $sms1['cmdCode']= "XXF";
            
            $sms2 =array();
            $sms2['content']= "XXF G ";
            $sms2['serviceNumber']= "8777";
            $sms2['cmdCode']= "XXF";
            
            $sms3 =array();
            $sms3['content']= "XXF G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "XXF";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 30;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivas" :{
            
            $sms1 =array();
            $sms1['content']= "MAP ";
            $sms1['serviceNumber']= "8755";
            $sms1['cmdCode']= "MAP";
            
            $sms2 =array();
            $sms2['content']= "KHL ";
            $sms2['serviceNumber']= "8788";
            $sms2['cmdCode']= "KHL";
            
            $sms3 =array();
            $sms3['content']= "KHC ";
            $sms3['serviceNumber']= "8788";
            $sms3['cmdCode']= "KHC";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 1;
            $output['hour_number'] = 24;
            $output['sms_number'] = 3;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivasRefCode" :{
            
            $sms1 =array();
            $sms1['content']= "MAP ref01 ";
            $sms1['serviceNumber']= "8755";
            $sms1['cmdCode']= "MAP";
            
            $sms2 =array();
            $sms2['content']= "GAME6 ref01 ";
            $sms2['serviceNumber']= "8738";
            $sms2['cmdCode']= "GAME6";
            
            $sms3 =array();
            $sms3['content']= "KHL ref01 ";
            $sms3['serviceNumber']= "8788";
            $sms3['cmdCode']= "KHL";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 1;
            $output['hour_number'] = 24;
            $output['sms_number'] = 3;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivaskhga" :{
            
            $sms1 =array();
            $sms1['content']= "KHGA ";
            $sms1['serviceNumber']= "6765";
            $sms1['cmdCode']= "KHGA";
            
            $sms2 =array();
            $sms2['content']= "KHGA ";
            $sms2['serviceNumber']= "6765";
            $sms2['cmdCode']= "KHGA";
            
            $sms3 =array();
            $sms3['content']= "KHGA ";
            $sms3['serviceNumber']= "6765";
            $sms3['cmdCode']= "KHGA";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 1;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivaskhbp" :{
            
            $sms1 =array();
            $sms1['content']= "KHBP ";
            $sms1['serviceNumber']= "8788";
            $sms1['cmdCode']= "KHBP";
            
            $sms2 =array();
            $sms2['content']= "KHBP ";
            $sms2['serviceNumber']= "8788";
            $sms2['cmdCode']= "KHBP";
            
            $sms3 =array();
            $sms3['content']= "KHBP ";
            $sms3['serviceNumber']= "8788";
            $sms3['cmdCode']= "KHBP";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 1;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "wapthugian" :{
            
            $sms1 =array();
            $sms1['content']= "BU15  G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU15 ";
            
            $sms2 =array();
            $sms2['content']= "BU15  G ";
            $sms2['serviceNumber']= "8785";
            $sms2['cmdCode']= "BU15 ";
            
            $sms3 =array();
            $sms3['content']= "BU15  G ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU15 ";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "TTV" :{
            
            $sms1 =array();
            $sms1['content']= "BU12 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU12";
            
            $sms2 =array();
            $sms2['content']= "GM7 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM7";
            
            $sms3 =array();
            $sms3['content']= "IAE G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "IAE";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 1;
            
            echo json_encode($output);
            break;
        }
        case "TTVKKT" :{
            
            $sms1 =array();
            $sms1['content']= "BU2 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU2";
            
            $sms2 =array();
            $sms2['content']= "GM2 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM2";
            
            $sms3 =array();
            $sms3['content']= "IAB G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "IAB";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 1;
            
            echo json_encode($output);
            break;
        }
        case "Thanh" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8785";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 30;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "AppLink" :{
            
            $sms1 =array();
            $sms1['content']= "HL2 ";
            $sms1['serviceNumber']= "8741";
            $sms1['cmdCode']= "HL2";
            
            $sms2 =array();
            $sms2['content']= "HL2 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "HL2";
            
            $sms3 =array();
            $sms3['content']= "HL2 ";
            $sms3['serviceNumber']= "8741";
            $sms3['cmdCode']= "HL2";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 30;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
         case "AppLink1" :{
            
            $sms1 =array();
            $sms1['content']= "HL1 ";
            $sms1['serviceNumber']= "8741";
            $sms1['cmdCode']= "HL1";
            
            $sms2 =array();
            $sms2['content']= "HL1 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "HL1";
            
            $sms3 =array();
            $sms3['content']= "HL1 ";
            $sms3['serviceNumber']= "8741";
            $sms3['cmdCode']= "HL1";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 30;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "Thong" :{
            
            $sms1 =array();
            $sms1['content']= "XS ";
            $sms1['serviceNumber']= "8799";
            $sms1['cmdCode']= "XS";
            
            $sms2 =array();
            $sms2['content']= "XS ";
            $sms2['serviceNumber']= "8799";
            $sms2['cmdCode']= "XS";
            
            $sms3 =array();
            $sms3['content']= "XS ";
            $sms3['serviceNumber']= "8799";
            $sms3['cmdCode']= "XS";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "Thong153" :{
            
            $sms1 =array();
            $sms1['content']= "XS ";
            $sms1['serviceNumber']= "8799";
            $sms1['cmdCode']= "XS";
            
            $sms2 =array();
            $sms2['content']= "XS ";
            $sms2['serviceNumber']= "8799";
            $sms2['cmdCode']= "XS";
            
            $sms3 =array();
            $sms3['content']= "XS ";
            $sms3['serviceNumber']= "8799";
            $sms3['cmdCode']= "XS";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "Son" :{
            
            $sms1 =array();
            $sms1['content']= "BU17 G ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU17 G";
            
            $sms2 =array();
            $sms2['content']= "BU17 G ";
            $sms2['serviceNumber']= "8785";
            $sms2['cmdCode']= "BU17 G";
            
            $sms3 =array();
            $sms3['content']= "BU17 G ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU17 G";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "Son83" :{
            
            $sms1 =array();
            $sms1['content']= "HL4 2 ";
            $sms1['serviceNumber']= "8741";
            $sms1['cmdCode']= "HL4 2";
            
            $sms2 =array();
            $sms2['content']= "EK5 2 ";
            $sms2['serviceNumber']= "8785";
            $sms2['cmdCode']= "EK5 2";
            
            $sms3 =array();
            $sms3['content']= "HL4 2 ";
            $sms3['serviceNumber']= "8741";
            $sms3['cmdCode']= "HL4 2";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivasrebuild" :{
            
            $sms1 =array();
            $sms1['content']= "GM5 ";
            $sms1['serviceNumber']= "8738 ";
            $sms1['cmdCode']= "GM5";
            
            $sms2 =array();
            $sms2['content']= "UD13 ";
            $sms2['serviceNumber']= "6786 ";
            $sms2['cmdCode']= "UD13";
            
            $sms3 =array();
            $sms3['content']= "GM5 ";
            $sms3['serviceNumber']= "8738";
            $sms3['cmdCode']= "GM5";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "mobivasrebuild133" :{
            
            $sms1 =array();
            $sms1['content']= "GAEM1 1 ";
            $sms1['serviceNumber']= "8738 ";
            $sms1['cmdCode']= "GAEM1";
            
            $sms2 =array();
            $sms2['content']= "GAEM1 2 ";
            $sms2['serviceNumber']= "6786 ";
            $sms2['cmdCode']= "GAEM1";
            
            $sms3 =array();
            $sms3['content']= "GAEM1 2 ";
            $sms3['serviceNumber']= "8738";
            $sms3['cmdCode']= "GAEM1";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "TTVGO" :{
            
            $sms1 =array();
            $sms1['content']= "GM7 G ";
            $sms1['serviceNumber']= "8741";
            $sms1['cmdCode']= "GM7";
            
            $sms2 =array();
            $sms2['content']= "BU12 G ";
            $sms2['serviceNumber']= "8785";
            $sms2['cmdCode']= "BU12";
            
            $sms3 =array();
            $sms3['content']= "IAE G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "IAE";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 1;
            
            echo json_encode($output);
            break;
        }
        case "getGameName" :{
            $gameId = isset($_GET['gameId']) ?$_GET['gameId'] :"0" ; 
            
            $array = array(
                "1" => "Avatar",
                "2" => "Avatar",
                "3" => "Contra",
                "4" => "Tank",
                "5" => "Pikachu",
                "6" => "KhuVuonDiaDang",
                "7" => "CoTuong",
                "8" => "AiLaTrieuPhu",
                "9" => "CuocChienThayMa",
                "10" => "DaoVang",
                "11" => "MarioJoy",
                "12" => "Operamini",
                "13" => "Ucbrowser",
                "14" => "ChienBinhJack",
                "PVZ" => "ChienBinhJack",
                "15" => "ChienBinhRong",
                "16" => "DaoVang",
                "17" => "GiaiCuuCongChua",
                "18" => "HoaQua",
                "19" => "KimCuong",
                "20" => "NinjaThatQuy",
                "21" => "Rambo",
                "22" => "Tank",
                "23" => "Angry-Bird",
                "24" => "CuocChienThayMa",
                "25" => "Rong-Den", 
                "26" => "Apache", 
                "27" => "ZOMBIEFOOTBAL", 
                "28" => "FruitNinja", 
                "29" => "Ola", 
                "30" => "Contra", 
                "31" => "Pokemon", 
                "32" => "Pikachu", 
                "33" => "JewelStar", 
                "34" => "", 
                "35" => "", 
                "36" => "", 
                "37" => "",
                "38" => "",  
                "39" => "",  
                "40" => "",   
            );
            
            if($array[$gameId]!=Null){
                echo RemoveSign($array[$gameId]);
            }else{
                echo "";
            }
            
            break;
        }
    }
     function RemoveSign($str) {
        $coDau = array ("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă", "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề", "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ", "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă", "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ", "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", "ê", "ù", "à" );

        $khongDau = array ("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "e", "u", "a" );
        return str_replace ( $coDau, $khongDau, $str );
    }

?>
