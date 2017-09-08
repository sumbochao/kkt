<?php
    $output = array();
    $header = isset($_GET['header']) ?$_GET['header'] :"" ;

    switch($header){

        
        case "Jack" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "kvdd" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "zalo" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 7;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "altp" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "daovang" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "kimcuong" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "bantrung" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
            echo json_encode($output);
            break;
        }
        case "chemhoaqua" :{
            
            $sms1 =array();
            $sms1['content']= "BU4 ";
            $sms1['serviceNumber']= "8785";
            $sms1['cmdCode']= "BU4";
            
            $sms2 =array();
            $sms2['content']= "GM4 ";
            $sms2['serviceNumber']= "8741";
            $sms2['cmdCode']= "GM4";
            
            $sms3 =array();
            $sms3['content']= "BU4 ";
            $sms3['serviceNumber']= "8785";
            $sms3['cmdCode']= "BU4";
            
            $output['sms1'] = $sms1;
            $output['sms2'] = $sms2;
            $output['sms3'] = $sms3;
            $output['sms_confirm'] = "false";
            $output['date_play'] = 15;
            $output['hour_number'] = 24;
            $output['sms_number'] = 1;
            $output['date_number'] = 0;
            
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
