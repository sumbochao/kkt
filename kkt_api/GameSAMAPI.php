<?php
    require_once("MobileDetect.php");
    require_once("GameAppFunction.php");
    $output = array();
    $header = isset($_GET['header']) ?$_GET['header'] :"" ;

    switch($header){

        case "SamFruit" :{

            $detect = new MobileDetect();
            $mobile = $detect->isMobile();
            if($mobile == true)
            {
                $isMobile=1;
            }else{
                $isMobile=0;
            }
            $isIOS = $detect->isiOS();
            $isAndroid = $detect->isAndroidOS();
            if($isAndroid == true){
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/FruitNinjaFree.apk";    
                downloadFile($link);die;
            } else if($isIOS ==false && $isAndroid ==false && $isMobile==1  ){
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/fruit_ninja.jar";    
                downloadFile($link);die;
            } else {
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/FruitNinjaFree.apk";    
                downloadFile($link);die;
            }
            break;
        }
        case "SamJack" :{

            $detect = new MobileDetect();
            $mobile = $detect->isMobile();
            if($mobile == true)
            {
                $isMobile=1;
            }else{
                $isMobile=0;
            }
            $isIOS = $detect->isiOS();
            $isAndroid = $detect->isAndroidOS();
            if($isAndroid == true){
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/plants-vs-zoombie.apk";    
                downloadFile($link);die;
            } else if($isIOS ==false && $isAndroid ==false && $isMobile==1  ){
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/hoa-qua-noi-gian.jar";    
                downloadFile($link);die;
            } else{
                $link ="/home/webhome/kenhkiemtien.com/upload/game/sam/plants-vs-zoombie.apk";    
                downloadFile($link);die;
            }
            break;
        }
    }
?>
