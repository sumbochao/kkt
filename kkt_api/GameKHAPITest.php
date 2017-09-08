<?php
    $output = array();
    $header = isset($_GET['header']) ?$_GET['header'] :"" ;

    switch($header){

        case "SamJack" :{
            
            $sms1 =array();
            $sms1['content']= "GTV1";
            $sms1['serviceNumber']= "7090";
            $sms1['cmdCode']= "GTV1";
            
            $sms2 =array();
            $sms2['content']= "GTV2";
            $sms2['serviceNumber']= "7090";
            $sms2['cmdCode']= "GTV2";
            
            $sms3 =array();
            $sms3['content']= "VIP";
            $sms3['serviceNumber']= "7090";
            $sms3['cmdCode']= "VIP";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "SamFruit" :{
            
            $sms1 =array();
            $sms1['content']= "GTV1";
            $sms1['serviceNumber']= "7090";
            $sms1['cmdCode']= "GTV1";
            
            $sms2 =array();
            $sms2['content']= "GTV2";
            $sms2['serviceNumber']= "7090";
            $sms2['cmdCode']= "GTV2";
            
            $sms3 =array();
            $sms3['content']= "VIP";
            $sms3['serviceNumber']= "7090";
            $sms3['cmdCode']= "VIP";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "true";
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "BaPlay" :{
            
            $sms1 =array();
            $sms1['content']= "BU10 G ";
            $sms1['serviceNumber']= "8085";
            $sms1['cmdCode']= "BU10";
            
            $sms2 =array();
            $sms2['content']= "GM6 G ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM6";
            
            $sms3 =array();
            $sms3['content']= "IAD G ";
            $sms3['serviceNumber']= "8777";
            $sms3['cmdCode']= "IAD";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 730;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 5;
            
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
                echo $array[$gameId];
            }else{
                echo "";
            }
            
            break;
        }
    }

?>
