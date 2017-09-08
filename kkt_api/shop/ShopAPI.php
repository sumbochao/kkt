<?php
    date_default_timezone_set('Asia/Saigon');   
    header('Content-type: text/html; charset=utf-8');   
    require_once("ShopDAO.php");
    require_once("ShopDOC.php");
    require_once("ShopBANK.php");
    require_once("ShopProvince.php");
    require_once("ShopNotify.php");
    require_once("../function/utils.php");
    
        
    $action = isset ( $_GET ['action'] ) ? $_GET ['action'] : "";    
    $token = isset ( $_GET ['token'] ) ? $_GET ['token'] : "";    
    $url_api = "http://kenhkiemtien.com/kkt_api/shop/ShopAPI.php";      
    $limit = 30;
    $app_client_id = 0;
         
    if((strcmp("getAppHeaderShop",$action)!=0)&&!empty($action)){
            $app_client_id = isset ($_GET ['app_client_id'] ) ? $_GET ['app_client_id'] : "";
            
            $ck_token = base64_encode(base64_encode("0230178183078b38f425311c3735c595".$app_client_id));
            
            if(!(strcasecmp($ck_token,$token)==0)) {
                echo "403";return;
            }
                   
}

  switch ($action) {
       case "getShipPartner" : 
            {
                echo json_encode ( $arrayShipPartner );
                break;
            }
       case "get123Bank" : 
            {
                echo json_encode ( $arrayBank123 );
                break;
            }
        case "getFeeShip" : 
            {
                $spCode = isset ( $_POST ['spCode'] ) ? $_POST ['spCode'] : "";
                $spCode = mysql_escape_string($spCode);
                 $kq = 0;
                if(empty($spCode)){
                    $kq = 1;
                }
                
                $arrayKQ = array();
                $arrayKQ["result"] = $kq;
                $arrayKQ["fee"] = 0;
                echo json_encode($arrayKQ);
                break;
            }
        case "getCategory" : 
            {
                $cate_parent_id = isset ( $_GET ['cate_parent_id'] ) ? $_GET ['cate_parent_id'] : "0";
                $cate_parent_id = intval ( $cate_parent_id );
                $output = getCategoryShop($cate_parent_id);
                echo json_encode ( $output );
                
                $arrPara = array ("cate_parent_id"=>$cate_parent_id);
                $dataLog = createDataLog ( "getCategory", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
         case "getCategoryAll" : 
            {
                $output = getCategoryAll();
                echo json_encode ( $output );
                
                $arrPara = array ();
                $dataLog = createDataLog ( "getCategoryAll", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
          case "getProductHome" : 
            {
                $output = getProductHome();
                echo json_encode ( $output );
                
                $arrPara = array ();
                $dataLog = createDataLog ( "getProductHome", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductCate" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $cat_id = isset ( $_GET ['cate_id'] ) ? $_GET ['cate_id'] : "0";
                $cat_id = intval ( $cat_id );
            
                $output = getProductCate($cat_id,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("cate_id"=>$cat_id,"page"=>$page,"limit"=>$limit);
                $dataLog = createDataLog ( "getProductCate", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductFollowing" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $output = getProductFormUserFollowing($user_id,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page,"limit"=>$limit);
                $dataLog = createDataLog ( "getProductFollowing", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getProductFavorite" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $output = getProductFavorite($user_id,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page,"limit"=>$limit);
                $dataLog = createDataLog ("getProductFavorite", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductByIDs" : 
            {
                $product_ids = isset ( $_GET ['product_ids'] ) ? $_GET ['product_ids'] : "";
                $output = getProductByIDs($product_ids);
                echo json_encode ( $output );
                
                $arrPara = array ("product_ids"=>$product_ids);
                $dataLog = createDataLog ("getProductByIDs", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductByDistance" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_GET ['lon'] ) ? $_GET ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_GET ['lat'] ) ? $_GET ['lat'] : "0";
                $lat = doubleval( $lat );
                $distance = isset ( $_GET ['distance'] ) ? $_GET ['distance'] : "50";
                $distance = doubleval( $distance );
                
                $output = getProductByDistance($lon,$lat,$distance,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("lon"=>$lon,"lat"=>$lat,"distance"=>$distance,"limit"=>$limit);
                $dataLog = createDataLog ("getProductByDistance", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getProductFilter" : 
            {
                $cat_id = isset ( $_POST ['cat_id'] ) ? $_POST ['cat_id'] : "0";
               // $cat_id = intval( $cat_id );
                $order_by =isset($_POST ['order_by'] ) ? $_POST ['order_by'] : "0";
                $order_by = intval ( $order_by );
                
                $page = isset ( $_POST ['page'] ) ? $_POST ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_POST ['lon'] ) ? $_POST ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
                $lat = doubleval( $lat );
                $distance = isset ( $_POST ['distance'] ) ? $_POST ['distance'] : "50";
                $distance = doubleval( $distance );
                
                $price_from = isset ( $_POST ['price_from'] ) ? $_POST ['price_from'] : "0";
                $price_from = doubleval( $price_from );
                $price_to = isset ( $_POST ['price_to'] ) ? $_POST ['price_to'] : "0";
                $price_to = doubleval( $price_to );
                
                $output = getProductFilter($cat_id,$price_from,$price_to,$lon,$lat,$distance,$order_by,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("cat_id"=>$cat_id,"price_from"=>$price_from,"price_to"=>$price_to,"order_by"=>$order_by,"lon"=>$lon,"lat"=>$lat,"distance"=>$distance,"limit"=>$limit);
                $dataLog = createDataLog ("getProductFilter", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductByDistanceFT" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_GET ['lon'] ) ? $_GET ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_GET ['lat'] ) ? $_GET ['lat'] : "0";
                $lat = doubleval( $lat );
                $distanceF = isset ( $_GET ['distanceF'] ) ? $_GET ['distanceF'] : "50";
                $distanceF = doubleval( $distanceF );
                $distanceT = isset ( $_GET ['distanceT'] ) ? $_GET ['distanceT'] : "50";
                $distanceT = doubleval( $distanceT );
                
                $output = getProductByDistanceFT($lon,$lat,$distanceF,$distanceT,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("lon"=>$lon,"lat"=>$lat,"distanceF"=>$distanceF,"distanceT"=>$distanceT
                ,"limit"=>$limit);
                $dataLog = createDataLog ("getProductByDistance", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductByDistanceFTNew" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_GET ['lon'] ) ? $_GET ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_GET ['lat'] ) ? $_GET ['lat'] : "0";
                $lat = doubleval( $lat );
                $distanceF = isset ( $_GET ['distanceF'] ) ? $_GET ['distanceF'] : "50";
                $distanceF = doubleval( $distanceF );
                $distanceT = isset ( $_GET ['distanceT'] ) ? $_GET ['distanceT'] : "50";
                $distanceT = doubleval( $distanceT );
                
                $output = getProductByDistanceFTNew($lon,$lat,$distanceF,$distanceT,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("lon"=>$lon,"lat"=>$lat,"distanceF"=>$distanceF,"distanceT"=>$distanceT
                ,"limit"=>$limit);
                $dataLog = createDataLog ("getProductByDistance", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductDetail" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ($product_id);
                $buyer_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $buyer_id = intval ($buyer_id);
                
              
                $product = getProductDetail($product_id);
                $user_id = $product["user_id"];
                $user = getUserShopById($user_id);
                $user["isFollowing"] = checkHasFollowing($buyer_id,$user_id);
                $comments = getProductComment($product_id,1,$limit);
                //$transaction =  getTransactionByProductOnProductDetail($buyer_id,$product_id);
                $like = checkProductFavorite($product_id,$buyer_id);
                
                $output = array();
                $output["product"]=$product;
                $output["user"]=$user;
                $output["comments"]=$comments;
                //$output["transaction"]=$transaction;
                $output["like"]=$like;
                
                echo json_encode ($output);
                
                $arrPara = array ("product_id"=>$product_id);
                $dataLog = createDataLog ( "getProductDetail", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductInfo" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ($product_id);
              
                $product = getProductDetail($product_id);
                echo json_encode ($product);
                
                $arrPara = array ("product_id"=>$product_id);
                $dataLog = createDataLog ( "getProductInfo", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getTransactionByProduct" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ($product_id);
                $buyer_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $buyer_id = intval ($buyer_id);

                //$product = getProductDetail($product_id);
                //$user_id = $product["user_id"];
                $transaction =  getTransactionByProductOnProductDetail($buyer_id,$product_id);
                
                echo json_encode ($transaction);
                
                $arrPara = array ("product_id"=>$product_id);
                $dataLog = createDataLog ( "getTransactionByProduct", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductComment" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ($product_id);
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
              
                $comments = getProductComment($product_id,$page,$limit);
                $sl = countCommentProduct($product_id);
                
                $output = array();
                $output["comments"]=$comments;
                $output["page"]= ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
                echo json_encode ($output);
              
                $arrPara = array ("product_id"=>$product_id,"page"=>$page);
                $dataLog = createDataLog ( "getProductComment", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         case "getProductSameCate" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ($product_id);
                $cate_id = isset ( $_GET ['cate_id'] ) ? $_GET ['cate_id'] : "0";
                $cate_id = intval ($cate_id);
                 
                $output = getProductSameCate($product_id,$cate_id);
                echo json_encode ( $output );
                
                $arrPara = array ("product_id"=>$product_id,"cate_id"=>$cate_id);
                $dataLog = createDataLog ( "getProductSameCate", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
        case "postProduct" :
        {
            $title = isset ( $_POST ['title'] ) ? $_POST ['title'] : "";
            $title = mysql_escape_string($title);
            $description = isset ( $_POST ['description'] ) ? $_POST ['description'] : "";
            //$description = mysql_escape_string($description);
            $description = str_replace("\r","",$description); 
            
            $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
            $address = mysql_escape_string($address);
            
            $province_code = isset ( $_POST ['province_code'] ) ? $_POST ['province_code'] : "";
            $province_code = mysql_escape_string($province_code);
            
            $city_code = isset ( $_POST ['city_code'] ) ? $_POST ['city_code'] : "";
            $city_code = mysql_escape_string($city_code);
            
            $cate_id = isset ( $_POST ['cate_id'] ) ? $_POST ['cate_id'] : "0";
            $cate_id =  intval($cate_id);
            $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
            $user_id =  intval($user_id);
            
            $price_sell = isset ($_POST ['price'] ) ? $_POST ['price'] : "";
            
            $use_status = isset ( $_POST ['use_status'] ) ? $_POST ['use_status'] : "0";
            $use_status =  intval($use_status);
            $use_time = 0;
            $quantity = isset ( $_POST ['quantity'] ) ? $_POST ['quantity'] : "1";
            $quantity =  intval($quantity);
            $quantity = 1;
           
            $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
            $lat =  doubleval($lat);
            $lng = isset ( $_POST ['lng'] ) ? $_POST ['lng'] : "0";
            $lng =  doubleval($lng);
            $image = isset ( $_POST ['image'] ) ? $_POST ['image'] : "";
            
            $weight = isset ( $_POST ['weight'] ) ? $_POST ['weight'] : "200";
            $weight =  doubleval($weight);
            $length = isset ( $_POST ['length'] ) ? $_POST ['length'] : "10";
            $length =  doubleval($length);
            $height = isset ( $_POST ['height'] ) ? $_POST ['height'] : "10";
            $height =  doubleval($height);
            $width = isset ( $_POST ['width'] ) ? $_POST ['width'] : "10";
            $width =  doubleval($width);
            
            $type_sell = isset ( $_POST ['type_sell'] ) ? $_POST ['type_sell'] : "3";
            $type_sell =  intval($type_sell);
            $type_sell =  3;
            
            $wish_swap = "";$status=1;
            $wish_swap = isset ( $_POST ['wish_swap'] ) ? $_POST ['wish_swap'] : "";
            $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
            $kq = 0;
            
            // check parameter
            if (empty ( $title ) ||  $cate_id ==0 || $user_id == 0 || empty ( $create_user )||empty($image)
            ||empty($description)||strcmp("",$price_sell)==0||$quantity ==0||$use_status ==0||$weight ==0||$length ==0||$height ==0||$width ==0) {
               $kq = 1;
            }else{
                if($kq==0){
                        $price_sell =  doubleval($price_sell);      
                        $arrImage = explode(",",$image);
                        $jsonImage = json_encode($arrImage);
                        $category = getCateDetail($cate_id);
                        $cate_parent_id  = $category["parent_id"];
                        
                        $arrSizeImg = array();$i=0; 
                        $pathdate = date("Y/md/");    
                        foreach($arrImage as $itemImg){
                           list($widthp, $heightp) = getimagesize(baseUrlUpload().'shop/product/'.$pathdate.$itemImg); 
                           $arrSizeImg[$i]= $widthp."_".$heightp; 
                           $i++;
                        }
                        $jsonImageSize = json_encode($arrSizeImg);
                        
                        $output = postProduct (ucfirst($title),$cate_id,$cate_parent_id,$user_id,$description,$price_sell,$use_status,$use_time,$quantity,$jsonImage,$wish_swap,$lat,$lng,$status,$create_user,$weight,$length,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize);
                        if (intval ( $output ) >= 1) {
                            $kq = 0; // success
                            updateStaticProduct($user_id);
                        } else {
                            $kq = 2; // fail
                        }
                }
            }
            
            echo $kq;
            $arrPara = array ("title"=>$title,"cate_id"=>$cate_id,"user_id"=>$user_id,"description"=>$description,"price"=>$price_sell,"use_status"=>$use_status,"use_time"=>$use_time,"quantity"=>$quantity,"image"=>$image,"wish_swap"=>$wish_swap,"lat"=>$lat,"lng"=>$lng,"status"=>$status,"create_user"=>$create_user,"type_sell"=>$type_sell);
            $ip = getRealIpAddr ();
            $dataLog = createDataLog ( "postProduct", $arrPara, $kq );
            insertAppTrackingShop ( 0, $app_client_id, $dataLog, $ip );
            
            break;
        }
        case "postProductAndroid" :
        {
            $title = isset ( $_POST ['title'] ) ? $_POST ['title'] : "";
            $title = mysql_escape_string($title);
            $description = isset ( $_POST ['description'] ) ? $_POST ['description'] : "";
            //$description = mysql_escape_string($description);
            $description = str_replace("\r","",$description); 
            
            $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
            $address = mysql_escape_string($address);
            
            $province_code = isset ( $_POST ['province_code'] ) ? $_POST ['province_code'] : "";
            $province_code = mysql_escape_string($province_code);
            
            $city_code = isset ( $_POST ['city_code'] ) ? $_POST ['city_code'] : "";
            $city_code = mysql_escape_string($city_code);
            
            $cate_id = isset ( $_POST ['cate_id'] ) ? $_POST ['cate_id'] : "0";
            $cate_id =  intval($cate_id);
            $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
            $user_id =  intval($user_id);
            
            $price_sell = isset ($_POST ['price'] ) ? $_POST ['price'] : "";
            
            $use_status = isset ( $_POST ['use_status'] ) ? $_POST ['use_status'] : "0";
            $use_status =  intval($use_status);
            $use_time = 0;
            $quantity = isset ( $_POST ['quantity'] ) ? $_POST ['quantity'] : "1";
            $quantity =  intval($quantity);
            $quantity = 1;
           
            $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
            $lat =  doubleval($lat);
            $lng = isset ( $_POST ['lng'] ) ? $_POST ['lng'] : "0";
            $lng =  doubleval($lng);
            $image = isset ( $_POST ['image'] ) ? $_POST ['image'] : "";
            
            $weight = isset ( $_POST ['weight'] ) ? $_POST ['weight'] : "200";
            $weight =  doubleval($weight);
            $length = isset ( $_POST ['length'] ) ? $_POST ['length'] : "10";
            $length =  doubleval($length);
            $height = isset ( $_POST ['height'] ) ? $_POST ['height'] : "10";
            $height =  doubleval($height);
            $width = isset ( $_POST ['width'] ) ? $_POST ['width'] : "10";
            $width =  doubleval($width);
            
            $type_sell = isset ( $_POST ['type_sell'] ) ? $_POST ['type_sell'] : "3";
            $type_sell =  intval($type_sell);
            $type_sell =  3;
            
            $wish_swap = "";$status=1;
            $wish_swap = isset ( $_POST ['wish_swap'] ) ? $_POST ['wish_swap'] : "";
            $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
            $kq = 0;
            
            // check parameter
            if (empty ( $title ) ||  $cate_id ==0 || $user_id == 0 || empty ( $create_user )||empty($image)
            ||empty($description)||strcmp("",$price_sell)==0||$quantity ==0||$use_status ==0||$weight ==0||$length ==0||$height ==0||$width ==0) {
               $kq = 1;
               $arrKetQua["error"] = $kq;
               $arrKetQua["message"] = "Thông tin đăng sản phẩm chưa đây đủ.";
               $arrKetQua["id"] = 0;
            }else{
                if($kq==0){
                        $price_sell =  doubleval($price_sell);      
                        $arrImage = explode(",",$image);
                        $jsonImage = json_encode($arrImage);
                        $category = getCateDetail($cate_id);
                        $cate_parent_id  = $category["parent_id"];
                        
                        $arrSizeImg = array();$i=0; 
                        $pathdate = date("Y/md/");    
                        foreach($arrImage as $itemImg){
                           list($widthp, $heightp) = getimagesize(baseUrlUpload().'shop/product/'.$pathdate.$itemImg); 
                           $arrSizeImg[$i]= $widthp."_".$heightp; 
                           $i++;
                        }
                        $jsonImageSize = json_encode($arrSizeImg);
                        
                        $output = postProduct (ucfirst($title),$cate_id,$cate_parent_id,$user_id,$description,$price_sell,$use_status,$use_time,$quantity,$jsonImage,$wish_swap,$lat,$lng,$status,$create_user,$weight,$length,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize);
                        if (intval ( $output ) >= 1) {
                            $kq = 0; // success
                            updateStaticProduct($user_id);
                            $arrKetQua["error"] = $kq;
                            $arrKetQua["message"] = "Chúc mừng bạn đăng sản phẩm thành công.";
                            $arrKetQua["id"] = $output;
                        } else {
                            $kq = 2; // fail
                            $arrKetQua["error"] = $kq;
                            $arrKetQua["message"] = "Đăng sản phẩm không thành công";
                            $arrKetQua["id"] = 0 ;
                        }
                }
            }
            
            echo json_encode($arrKetQua);    
            $arrPara = array ("title"=>$title,"cate_id"=>$cate_id,"user_id"=>$user_id,"description"=>$description,"price"=>$price_sell,"use_status"=>$use_status,"use_time"=>$use_time,"quantity"=>$quantity,"image"=>$image,"wish_swap"=>$wish_swap,"lat"=>$lat,"lng"=>$lng,"status"=>$status,"create_user"=>$create_user,"type_sell"=>$type_sell);
            $ip = getRealIpAddr ();
            $dataLog = createDataLog ( "postProduct", $arrPara, $kq );
            insertAppTrackingShop ( 0, $app_client_id, $dataLog, $ip );
            
            break;
        }
         case "postProduct2" :
        {
            $title = isset ( $_POST ['title'] ) ? $_POST ['title'] : "";
            $title = mysql_escape_string($title);
            $description = isset ( $_POST ['description'] ) ? $_POST ['description'] : "";
            //$description = mysql_escape_string($description);
            
            $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
            $address = mysql_escape_string($address);
            
            $province_code = isset ( $_POST ['province_code'] ) ? $_POST ['province_code'] : "";
            $province_code = mysql_escape_string($province_code);
            
            $city_code = isset ( $_POST ['city_code'] ) ? $_POST ['city_code'] : "";
            $city_code = mysql_escape_string($city_code);
            
            $cate_id = isset ( $_POST ['cate_id'] ) ? $_POST ['cate_id'] : "0";
            $cate_id =  intval($cate_id);
            $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
            $user_id =  intval($user_id);
            
            $price_sell = isset ( $_POST ['price'] ) ? $_POST ['price'] : "";
            
             
            $use_status = isset ( $_POST ['use_status'] ) ? $_POST ['use_status'] : "0";
            $use_status =  intval($use_status);
            $use_time = 0;
            $quantity = isset ( $_POST ['quantity'] ) ? $_POST ['quantity'] : "1";
            $quantity =  intval($quantity);
           
            $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
            $lat =  doubleval($lat);
            $lng = isset ( $_POST ['lng'] ) ? $_POST ['lng'] : "0";
            $lng =  doubleval($lng);
            $image = isset ( $_POST ['image'] ) ? $_POST ['image'] : "";
            
            $weight = isset ( $_POST ['weight'] ) ? $_POST ['weight'] : "200";
            $weight =  doubleval($weight);
            $length = isset ( $_POST ['length'] ) ? $_POST ['length'] : "10";
            $length =  doubleval($length);
            $height = isset ( $_POST ['height'] ) ? $_POST ['height'] : "10";
            $height =  doubleval($height);
            $width = isset ( $_POST ['width'] ) ? $_POST ['width'] : "10";
            $width =  doubleval($width);
            
            $type_sell = isset ( $_POST ['type_sell'] ) ? $_POST ['type_sell'] : "3";
            $type_sell =  intval($type_sell);
            
            $wish_swap = "";$status=1;
            $wish_swap = isset ( $_POST ['wish_swap'] ) ? $_POST ['wish_swap'] : "";
            $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
            $kq = 0;
            
            $arrKetQua = array();
            // check parameter
            if (empty ( $title ) ||  $cate_id ==0 || $user_id == 0 || empty ( $create_user )||empty($image) ||
            strcmp("",$price_sell)==0||empty($description)||$quantity ==0||$use_status ==0||$weight ==0||$length ==0||$height ==0||$width ==0) {
               $kq = 1;
               $arrKetQua["error"] = $kq;
               $arrKetQua["message"] = "Thiếu tham số";
               $arrKetQua["id"] = 0;
            }else{
                if($kq==0){
                        $price_sell =  doubleval($price_sell);     
                        $arrImage = explode(",",$image);
                        $jsonImage = json_encode($arrImage);
                        $category = getCateDetail($cate_id);
                        $cate_parent_id  = $category["parent_id"];
                        $output = postProduct (ucfirst($title),$cate_id,$cate_parent_id,$user_id,$description,$price_sell,$use_status,$use_time,$quantity,$jsonImage,$wish_swap,$lat,$lng,$status,$create_user,$weight,$length,$width,$height,$address,$province_code,$city_code,$type_sell);
                        if (intval ( $output ) >= 1) {
                            $kq = 0; // success
                            updateStaticProduct($user_id);
                            $arrKetQua["error"] = $kq;
                            $arrKetQua["message"] = "Thành công";
                            $arrKetQua["id"] = $output;
                        } else {
                            $kq = 2; // fail
                            $arrKetQua["error"] = $kq;
                            $arrKetQua["message"] = "Đăng sản phẩm không thành công";
                            $arrKetQua["id"] = 0 ;
                        }
                }
            }
            
            echo json_encode($arrKetQua);
            $arrPara = array ("title"=>$title,"cate_id"=>$cate_id,"user_id"=>$user_id,"description"=>$description,"price"=>$price_sell,"use_status"=>$use_status,"use_time"=>$use_time,"quantity"=>$quantity,"image"=>$image,"wish_swap"=>$wish_swap,"lat"=>$lat,"lng"=>$lng,"status"=>$status,"create_user"=>$create_user,"type_sell"=>$type_sell);
            $ip = getRealIpAddr ();
            $dataLog = createDataLog ( "postProduct", $arrPara, $kq );
            insertAppTrackingShop ( 0, $app_client_id, $dataLog, $ip );
            
            break;
        }
        case "updateProduct" :
        {
            $product_id = isset ( $_POST ['id'] ) ? $_POST ['id'] : "0";
            $product_id =  intval($product_id);
            
            $title = isset ( $_POST ['title'] ) ? $_POST ['title'] : "";
            $title = mysql_escape_string($title);
            $description = isset ( $_POST ['description'] ) ? $_POST ['description'] : "";
            //$description = mysql_escape_string($description);
            $description = str_replace("\r","",$description); 
            
            $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
            $address = mysql_escape_string($address);
            
            
            $province_code = isset ( $_POST ['province_code'] ) ? $_POST ['province_code'] : "";
            $province_code = mysql_escape_string($province_code);
            
            $city_code = isset ( $_POST ['city_code'] ) ? $_POST ['city_code'] : "";
            $city_code = mysql_escape_string($city_code);
            
            $cate_id = isset ( $_POST ['cate_id'] ) ? $_POST ['cate_id'] : "0";
            $cate_id =  intval($cate_id);
            
            $price_sell = isset ( $_POST ['price'] ) ? $_POST ['price'] : "";
            
            $use_status = isset ( $_POST ['use_status'] ) ? $_POST ['use_status'] : "0";
            $use_status =  intval($use_status);
            $use_time = 0;
            $quantity = isset ( $_POST ['quantity'] ) ? $_POST ['quantity'] : "1";
            $quantity =  intval($quantity);
           
            $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
            $lat =  doubleval($lat);
            $lng = isset ( $_POST ['lng'] ) ? $_POST ['lng'] : "0";
            $lng =  doubleval($lng);
            $image = isset ( $_POST ['image'] ) ? $_POST ['image'] : "";
            
            $weight = isset ( $_POST ['weight'] ) ? $_POST ['weight'] : "200";
            $weight =  doubleval($weight);
            $length = isset ( $_POST ['length'] ) ? $_POST ['length'] : "10";
            $length =  doubleval($length);
            $height = isset ( $_POST ['height'] ) ? $_POST ['height'] : "10";
            $height =  doubleval($height);
            $width = isset ( $_POST ['width'] ) ? $_POST ['width'] : "10";
            $width =  doubleval($width);
            
            $type_sell = isset ( $_POST ['type_sell'] ) ? $_POST ['type_sell'] : "3";
            $type_sell =  intval($type_sell);
            $type_sell =  3; 
            
            $wish_swap = "";$status=1;
            $wish_swap = isset ( $_POST ['wish_swap'] ) ? $_POST ['wish_swap'] : "";
            $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
            $kq = 0;
            
            // check parameter
            if (empty ( $title ) ||  $cate_id ==0 || $product_id == 0 || empty ( $create_user )||strcmp("",$price_sell)==0||empty($image)||empty($description)||$use_status ==0||$weight ==0||$length ==0||$height ==0||$width ==0) {
               $kq = 1;
            }else{
                if($kq==0){
                        $price_sell =  doubleval($price_sell); 
                        $arrImage = explode(",",$image);
                        $jsonImage = json_encode($arrImage);
                        
                        $arrSizeImg = array();$i=0; 
                        $product = getProductDetail($product_id);
                        $pathdate =    date("Y/md/",strtotime($product['create_date']));
                        foreach($arrImage as $itemImg){
                           list($widthp, $heightp) = getimagesize(baseUrlUpload().'shop/product/'.$pathdate.$itemImg); 
                           $arrSizeImg[$i]= $widthp."_".$heightp; 
                           $i++;
                        }
                        $jsonImageSize = json_encode($arrSizeImg);
                        
                        $output = updateProduct($product_id,ucfirst($title),$cate_id,$description,$price_sell,$use_status,$use_time,$quantity,$jsonImage,$wish_swap,$lat,$lng,$status,$create_user,$weight,$length,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize);
                        if (intval ( $output ) == 1) {
                            $kq = 0; // success
                        } else {
                            $kq = 2; // fail
                        }
                }
            }
            
            echo $kq;
            $arrPara = array ("title"=>$title,"cate_id"=>$cate_id,"product_id"=>$product_id,"description"=>$description,"price"=>$price_sell,"use_status"=>$use_status,"use_time"=>$use_time,"quantity"=>$quantity,"image"=>$image,"wish_swap"=>$wish_swap,"lat"=>$lat,"lng"=>$lng,"status"=>$status,"create_user"=>$create_user,
            "type_sell"=>$type_sell);
            $ip = getRealIpAddr ();
            $dataLog = createDataLog ( "updateProduct", $arrPara, $kq );
            insertAppTrackingShop ( 0, $app_client_id, $dataLog, $ip );
            
            break;
        }
        case "reSellProduct": {
            $product_id =   isset($_POST['product_id'])?$_POST['product_id'] :"0";
            $product_id = intval($product_id);
            $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"0";
            $user_id = intval($user_id);
            $kq = 0;
            if($product_id==0) $kq = 1; else
            $kq = updateQuantityProduct($product_id,1);
            
            $kq = $kq>0?$kq = 0:2;    
            
            echo $kq;
            
            $arrPara = array ("product_id"=>$product_id);
            $dataLog = createDataLog ("reSellProduct",$arrPara,$kq);
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
         case "uploadImageProduct": {
            $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"0";
            $product_id =   isset($_POST['product_id'])?$_POST['product_id'] :"0";
            $arrKQ = uploadImageProduct($user_id,$product_id); 
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id);
            $dataLog = createDataLog ("uploadImageProduct",$arrPara,$arrKQ["result"]);
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
         case "getAppHeaderShop":{
              $app_header = isset($_GET['app_header'])?$_GET['app_header'] :"";
              $app_client_id = isset($_GET['app_client_id'])?$_GET['app_client_id'] :"0";
              $os_version = isset($_GET['os_version'])?$_GET['os_version'] :"";
              $imei = isset($_GET['imei'])?$_GET['imei'] :""; 

              if(empty($app_header)) echo ""; 
              else {
                  $arrOut = getAppHeaderShop($app_header,$app_client_id,$os_version,$imei); 
                  $arrOut["ship"]  = $arrayShipPartner;
                  echo json_encode($arrOut);   
              }
              
              
            $arrPara = array ("app_client_id"=>$app_client_id,"app_header"=>$app_header
            ,"os_version"=>$os_version,"imei"=>$imei,"token"=>$token);
            $dataLog = createDataLog ("getAppHeaderShop",$arrPara, "" );
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
         case "registerMember" :{
            // Get Paramerters
            $app_client_id = isset ( $_GET ['app_client_id'] ) ? $_GET ['app_client_id'] : "0";
            $app_client_id = intval ( $app_client_id );
            $fullname = isset ( $_POST ['fullname'] ) ? $_POST ['fullname'] : "";
            $email = isset ( $_POST ['email'] ) ? $_POST ['email'] : "";
            $sex = isset ( $_POST ['sex'] ) ? $_POST ['sex'] : "0";
            $sex = intval($sex);
            
            $birthday = isset ($_POST ['birthday'] ) ? $_POST ['birthday'] : "";
            $sso_id = isset ( $_POST ['sso_id'] ) ? $_POST ['sso_id'] : "";   
            $mobile = isset ( $_POST ['mobile'] ) ? $_POST ['mobile'] : "";   
            $mobile =  formatMobile($mobile);
            $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";   
            $lng = isset ( $_POST ['lng'] ) ? $_POST ['lng'] : "0";   
             // Validate Paramater
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthday))
            {
                $birthday = convertStrdmyyToyymd($birthday,"/");
            }
            
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthday))
            {
                $birthday = "";
            }
    
            $kq = 0;
            $arrayKq = array();
            $userDetail = array();
            
            if(empty($email)||strcasecmp( $email ,"(null)")==0||
            strcasecmp( $email ,"null")==0) $email =  $sso_id."@shop.mobi";
            
            if(empty($app_client_id)){$kq=1;} // thieu tham so
            if(!isValidEmail($email)&&!empty($email)){$kq = 3;}// email khong dung dinh dang
            $user_id  =  0;
            $isNewUser =  0;
            $userDetail =  null;
            // get user info
            if($kq == 0){
                $userDetail =  getUserShopByEmail($email);
                if(empty($userDetail)) $userDetail = getUserShopBySSOID($sso_id);
                if(empty($userDetail)){
                     $user_id = registerMemberShop($app_client_id,ucfirst($fullname),$sex,$birthday,$email,$mobile,$sso_id,$lat,$lng);
                     if($user_id > 0)
                        {
                            $userDetail = getUserShopById($user_id);
                            $kq = 0;
                            $isNewUser = 1;
                            if(!strpos($email,"@shop.mobi")){
                                $template_name = "Welcome";
                                $to_name = ucfirst($fullname);
                                $email_subject ="Chào mừng bạn đến với TraoDoiDi - Ứng dụng Trao đổi & Mua bán Đồ Cũ gần bạn." ;
                                $global_merge_vars="";
                                pushEmailQueue($email,$to_name,$email_subject,$template_name,$global_merge_vars);
                            }
                        }else{
                             $kq = 2;
                        } 
                }
            }
            $arrayKq["result"] = $kq;
            $arrayKq["isNewUser"] = $isNewUser;
            $arrayKq["user"] = $userDetail;
            echo json_encode ($arrayKq);
            
            $arrPara = array ("app_client_id"=>$app_client_id,"fullname"=>$fullname
            ,"email"=>$email,"sex"=>$sex,"birthday"=>$birthday,"sso_id"=>$sso_id,"mobile"=>$mobile,"lat"=>$lat,"lng"=>$lng);
            $dataLog = createDataLog ("registerMember", $arrPara, $kq );
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
                
            break;
        }
         case "getUserInfo": {
            $user_id =   isset($_GET['user_id'])?$_GET['user_id'] :"0";
            $user_id = intval($user_id);
            $arrKQ = getUserShopById($user_id); 
            
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id);
            $dataLog = createDataLog ("getUserInfo",$arrPara,"");
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
        case "getUserInfoOther": {
            $user_id =   isset($_GET['user_id'])?$_GET['user_id'] :"0";
            $user_id = intval($user_id);
            $user_f_id =   isset($_GET['user_f_id'])?$_GET['user_f_id'] :"0";
            $user_f_id = intval($user_f_id);
            
            $arrKQ = getUserShopByIdOther($user_id,$user_f_id); 
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id,"user_f_id"=>$user_f_id);
            $dataLog = createDataLog ("getUserInfoOther",$arrPara,"");
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
         case "getSeller": {
            $user_id =   isset($_GET['user_id'])?$_GET['user_id'] :"0";
            $user_id = intval($user_id);
            $seller_id =   isset($_GET['seller_id'])?$_GET['seller_id'] :"0";
            $seller_id = intval($seller_id);
            
            $arrKQ = getUserShopById($seller_id); 
            if(!empty($arrKQ))
            $arrKQ["isFollowing"] = checkHasFollowing($user_id,$seller_id);
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id);
            $dataLog = createDataLog ("getUserInfo",$arrPara,"");
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
        case "updateUserInfo": {
            $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"0";
            $user_id = intval($user_id);
            $fullname =   isset($_POST['fullname'])?$_POST['fullname'] :"";
            $fullname = mysql_escape_string($fullname);
            $birthday =   isset($_POST['birthday'])?$_POST['birthday'] :"";
            $birthday = mysql_escape_string($birthday);
            $city =   isset($_POST['city'])?$_POST['city'] :"";
            $city = mysql_escape_string($city);
            $country =   isset($_POST['country'])?$_POST['country'] :"";
            $country = mysql_escape_string($country);
            $address =   isset($_POST['address'])?$_POST['address'] :"";
            $address = mysql_escape_string($address);
            $kq=0;
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$birthday))
            {
                $birthday = convertStrdmyyToyymd($birthday,"/");
            }
            if(empty($fullname)||empty($user_id)||empty($birthday)||empty($city)||empty($country)||empty($address)){$kq=1;} // thieu tham so
            else {
               $kq= uploadUserShopInfo($user_id,ucfirst($fullname),$birthday,$city,$country,$address);
               $kq=$kq>0?0:2;
            }
            
            echo $kq;
            
            $arrPara = array ("user_id"=>$user_id,"fullname"=>$fullname,"birthday"=>$birthday,"city"=>$city,"country"=>$country,"address"=>$address);
            $dataLog = createDataLog ("updateUserInfo",$arrPara,$kq);
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
        case "uploadAvatarUser": {
            $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"0";
            $user_id = intval($user_id);
            $arrKQ = uploadLoadAvatarUserShop($user_id); 
            
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id);
            $dataLog = createDataLog ("uploadAvatarUser",$arrPara,0);
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
        case "updateMobileUser": {
            $user_id =   isset($_POST['user_id'])?$_POST['user_id'] :"14";
            $user_id = intval($user_id);
            $mobile =   isset($_POST['mobile'])?$_POST['mobile'] :"";
            $mobile = formatMobile($mobile);
            $mobile_view =   isset($_POST['mobile_view'])?$_POST['mobile_view'] :"1";
            $mobile_view = intval($mobile_view);
            $kq = 0;
            $arrKQ =  array();
            //if(1<0){
            if(empty($mobile)||$user_id==0){
                $arrKQ["kq"] = 1;
                $arrKQ["message"] = "Thiếu tham số";
            } 
            else {
                $userShop = getUserShopById($user_id);
                
                if(strcasecmp($mobile,$userShop["mobile"])==0)
                    $kq = updateMobileUser($user_id,$mobile,$mobile_view);
                else{
                  $kq = updateMobileUserNotValidateMobile($user_id,$mobile,$mobile_view);  
                  if($kq>0){
                    deleteMobileValidate($user_id);
                    insertMobileValidate($user_id,$mobile);  
                  } 
                } 
                
                $kq = $kq>0?0:2; 
                 if($kq==0)$arrKQ["message"] = "Cập nhật thành công"; else $arrKQ["message"] = "Cập nhật lỗi, có thể số điện thoại đã tồn tại";
                 $arrKQ["kq"] = $kq;
            }
            
            echo json_encode($arrKQ);
            
            $arrPara = array ("user_id"=>$user_id,"mobile"=>$mobile,"mobile_view"=>$mobile_view);
            $dataLog = createDataLog ("updateMobileUser",$arrPara,$kq);
            $ip = getRealIpAddr ();
            insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
            
            break;        
        }
         case "getUserByIDs" : 
            {
                $user_ids = isset ( $_GET ['user_ids'] ) ? $_GET ['user_ids'] : "";
                $output = getUserByIDs($user_ids);
                echo json_encode ( $output );
                
                $arrPara = array ("user_ids"=>$user_ids);
                $dataLog = createDataLog ("getUserByIDs", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
          case "getUserByFacebookIDs" : 
            {
                $fb_ids = isset ( $_GET ['fb_ids'] ) ? $_GET ['fb_ids'] : "";
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "";
                $user_id = intval($user_id);
                $output = array();
                if(!empty($fb_ids)&&!empty($user_id)){
                    $output = getUserByFacebookIDs($user_id,$fb_ids);
                }
                echo json_encode ( $output );
                
                $arrPara = array ("fb_ids"=>$fb_ids);
                $dataLog = createDataLog ("getUserByFacebookIDs", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         case "getProductOfUser" : 
         {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $output = array();
                $product = getProductOfUser($user_id,$page,$limit);
                $slSell = countProductByUser($user_id);
                
                $output["product"] =$product;
                $output["count"] =$slSell;
                echo json_encode ( $output );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page);
                $dataLog = createDataLog ("getProductOfUser", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
                
                break;
         }
          case "getProductSwap" : 
         {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $product = getProductSwap($user_id);
                
                echo json_encode ( $product );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getProductSwap", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
                
                break;
         }
         case "postProductFavorite" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $kq=0;
                if($product_id==0||$user_id==0) $kq = 1;
                else {
                    $kq = insertProductFavorite($user_id,$product_id);
                    $kq = $kq >0?0:2;
                    if($kq==0){
                        updateStaticLikeProduct($product_id);
                        pushNotifyLikeProduct($product_id, $user_id);
                        deleteCacheProductFavorite($user_id); 
                        $querykey =md5("KEY.getProductDetail." .$product_id);    
                        deleteCacheByKey($querykey);
                    } 
                }
                
                echo $kq ;
                
                $arrPara = array ("user_id"=>$user_id,"product_id"=>$product_id);
                $dataLog = createDataLog ("postProductFavorite", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         case "deleteProductFavorite" : 
            { 
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $kq=0;
               
                if($product_id==0||$user_id==0) $kq = 1;
                else { 
                    $kq = deleteProductFavorite($user_id,$product_id);
                    $kq = $kq >0?0:2;
                    if($kq==0){
                        $querykey =md5("KEY.getProductDetail." .$product_id);    
                        deleteCacheByKey($querykey);
                        deleteCacheProductFavorite($user_id);
                    }
                }
                
                echo  $kq ;
                $arrPara = array ("user_id"=>$user_id,"product_id"=>$product_id);
                $dataLog = createDataLog ("deleteProductFavorite", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         case "postUserFollowing" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $user_following_id = isset ( $_POST ['user_following_id'] ) ? $_POST ['user_following_id'] : "0";
                $user_following_id = intval ( $user_following_id );
                $kq=0;
                if($user_following_id==0||$user_id==0) $kq = 1;
                else {
                    $kq = insertUserFollow($user_id,$user_following_id);
                    $kq = $kq >0?0:2;
                    if($kq==0){
                        updateStaticUserFollowing($user_id);
                        updateStaticUserFollower($user_following_id);
                        pushNotifyFollowing($user_id, $user_following_id, $user_id);
                    }
                }
                
                echo json_encode ( $kq );
                $arrPara = array ("user_id"=>$user_id,"user_following_id"=>$user_following_id);
                $dataLog = createDataLog ("postUserFollowing", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "unFollowing" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $user_following_id = isset ( $_POST ['user_following_id'] ) ? $_POST ['user_following_id'] : "0";
                $user_following_id = intval ( $user_following_id );
                $kq=0;
                if($user_following_id==0||$user_id==0) $kq = 1;
                else {
                    $kq = deleteUserFollow($user_id,$user_following_id);
                    $kq = $kq >0?0:2;
                     if($kq==0){
                        updateStaticUserFollowing($user_id);
                        updateStaticUserFollower($user_following_id);
                    }
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("user_id"=>$user_id,"user_following_id"=>$user_following_id);
                $dataLog = createDataLog ("unFollowing", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getUserFollowing" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $output = getUserFollowing($user_id,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page,"limit"=>$limit);
                $dataLog = createDataLog ("getUserFollowing", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getUserFollower" : 
            {
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "1";
                $page = intval ( $page );
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $output = getUserFollower($user_id,$page,$limit);
                echo json_encode ( $output );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page,"limit"=>$limit);
                $dataLog = createDataLog ("getUserFollower", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "postProductComment" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $comment = isset ( $_POST ['comment'] ) ? $_POST ['comment'] : "";
                $comment = mysql_escape_string( $comment );
                $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
                $create_user = mysql_escape_string ( $create_user );
                $kq=0;
                if($product_id==0||$user_id==0||empty($comment)||empty($create_user)) $kq = 1;
                else {
                    $kq = insertProductComment($user_id,$product_id,ucfirst($comment),$create_user);
                    $kq = $kq >0?0:2;
                    if($kq==0){
                        updateStaticCommentProduct($product_id);
                        pushNotifyCommentProduct($product_id, $user_id,$comment);
                    }
                }
                
                echo json_encode ( $kq );
                
                
                $arrPara = array ("user_id"=>$user_id,"product_id"=>$product_id,"comment"=>$comment,"create_user"=>$create_user);
                $dataLog = createDataLog ("postProductComment", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
              case "postAddress" : 
            {
                //$user_id,$address_user,$province,$city,$address,$create_user
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $address_user = isset ( $_POST ['address_user'] ) ? $_POST ['address_user'] : "";
                $address_user = mysql_escape_string( $address_user );
                $address_user = ucwords($address_user);
                $province = isset ( $_POST ['province'] ) ? $_POST ['province'] : "";
                $province = mysql_escape_string( $province );
                $city = isset ( $_POST ['city'] ) ? $_POST ['city'] : "";
                $city = mysql_escape_string( $city );
                $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
                $address = mysql_escape_string( $address );
                $address = ucwords($address);
                $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
                $create_user = mysql_escape_string ( $create_user );
                $tel = isset ( $_POST ['tel'] ) ? $_POST ['tel'] : "";
                $tel = mysql_escape_string ( $tel );
                
                $districtName = getDistrictByCode($districts,$city);
                $provinceName = getProvinceByCode($provinces,$province);
                $kq=0;
                if($user_id==0||empty($address_user)||empty($province)||empty($city)
                ||empty($address)||empty($create_user)||empty($tel)) $kq = 1;
                else {
                    $kq =insertAddress($user_id,$address_user,$province,$city,ucfirst($address),$create_user,$tel,$provinceName,$districtName);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("user_id"=>$user_id,"address_user"=>$address_user,"province"=>$province,"city"=>$city,"address"=>$address,"create_user"=>$create_user,"tel"=>$tel);
                $dataLog = createDataLog ("postAddress", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updateAddress" : 
            {
                //$user_id,$address_user,$province,$city,$address,$create_user
                $address_id = isset ( $_POST ['address_id'] ) ? $_POST ['address_id'] : "0";
                $address_id = intval ( $address_id );
                $address_user = isset ( $_POST ['address_user'] ) ? $_POST ['address_user'] : "";
                $address_user = mysql_escape_string( $address_user );
                $address_user = ucwords($address_user);
                $province_code = isset ( $_POST ['province'] ) ? $_POST ['province'] : "";
                $province_code = mysql_escape_string( $province_code );
                $city_code = isset ( $_POST ['city'] ) ? $_POST ['city'] : "";
                $city_code = mysql_escape_string( $city_code );
                $address = isset ( $_POST ['address'] ) ? $_POST ['address'] : "";
                $address = mysql_escape_string( $address );
                $address = ucwords($address);
                $create_user = isset ( $_POST ['create_user'] ) ? $_POST ['create_user'] : "";
                $create_user = mysql_escape_string ( $create_user );
                $tel = isset ( $_POST ['tel'] ) ? $_POST ['tel'] : "";
                $tel = mysql_escape_string ( $tel );
                
                $districtName = getDistrictByCode($districts,$city_code);
                $provinceName = getProvinceByCode($provinces,$province_code);
                $kq=0;
                if($address_id==0||empty($address_user)||empty($province_code)||empty($city_code)
                ||empty($address)||empty($create_user)||empty($tel)) $kq = 1;
                else {
                    $kq =updateAddress($address_id,$address_user,$tel,$provinceName,$province_code,$districtName,$city_code,$address,$create_user);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("address_id"=>$address_id,"address_user"=>$address_user,"province"=>$province_code,"city"=>$city_code,"address"=>$address,"create_user"=>$create_user,"tel"=>$tel);
                $dataLog = createDataLog ("updateAddress", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "deleteAddress" : 
            {
                $address_id = isset ( $_POST ['address_id'] ) ? $_POST ['address_id'] : "0";
                $address_id = intval ( $address_id );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                if($address_id==0||$user_id==0) $kq = 1;
                else {
                    $kq =deleteAddress($address_id,$user_id);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("address_id"=>$address_id,"user_id"=>$user_id);
                $dataLog = createDataLog ("deleteAddress", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "postPaymentMethodBank" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $bank_name = isset ( $_POST ['bank_name'] ) ? $_POST ['bank_name'] : "";
                $bank_name = mysql_escape_string( $bank_name );
                $bank_branch = isset ( $_POST ['bank_branch'] ) ? $_POST ['bank_branch'] : "";
                $bank_branch = mysql_escape_string( $bank_branch );
                $account_name = isset ( $_POST ['account_name'] ) ? $_POST ['account_name'] : "";
                $account_name = mysql_escape_string( $account_name );
                $account_name = ucwords($account_name);
                $account_id = isset ( $_POST ['account_id'] ) ? $_POST ['account_id'] : "";
                $account_id = mysql_escape_string( $account_id );
                
                $kq=0;
                if($user_id==0||empty($bank_name)||empty($bank_branch)||empty($account_name)
                ||empty($account_id)) $kq = 1;
                else {
                    $kq =insertPaymentMethodByBank($user_id,$bank_name,$bank_branch,$account_name,$account_id);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("user_id"=>$user_id,"bank_name"=>$bank_name,"bank_branch"=>$bank_branch,"account_name"=>$account_name,"account_id"=>$account_id);
                $dataLog = createDataLog ("postPaymentMethodBank", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "postPaymentMethodCMT" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $bank_name = isset ( $_POST ['bank_name'] ) ? $_POST ['bank_name'] : "";
                $bank_name = mysql_escape_string( $bank_name );
                $bank_branch = isset ( $_POST ['bank_branch'] ) ? $_POST ['bank_branch'] : "";
                $bank_branch = mysql_escape_string( $bank_branch );
                $receiver = isset ( $_POST ['receiver'] ) ? $_POST ['receiver'] : "";
                $receiver = mysql_escape_string( $receiver );
                $receiver = ucwords($receiver);
                $id_number = isset ( $_POST ['id_number'] ) ? $_POST ['id_number'] : "";
                $id_number = mysql_escape_string( $id_number );
                $id_place = isset ( $_POST ['id_place'] ) ? $_POST ['id_place'] : "";
                $id_place = mysql_escape_string( $id_place );
                $id_date = isset ( $_POST ['id_date'] ) ? $_POST ['id_date'] : "";
                $id_date = mysql_escape_string( $id_date );
                
                $kq=0;
                if($user_id==0||empty($bank_name)||empty($bank_branch)||empty($receiver)
                ||empty($id_number) ||empty($id_place) ||empty($id_date)) $kq = 1;
                else {
                    $kq =insertPaymentMethodByIdentify($user_id,$bank_name,$bank_branch,$receiver,$id_number,$id_date,$id_place);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("user_id"=>$user_id,"bank_name"=>$bank_name,"bank_branch"=>$bank_branch,"receiver"=>$receiver,"id_number"=>$id_number,"id_date"=>$id_date,"id_place"=>$id_place);
                $dataLog = createDataLog ("postPaymentMethodCMT", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getAddress" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrAdress =getAddress($user_id);
                
                echo json_encode ( $arrAdress );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getAddress", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getPaymentMethod" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrPayment =getPaymentMethod($user_id);
                
                echo json_encode ( $arrPayment );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getPaymentMethod", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getBank" : 
            {
                echo json_encode ( $arrayBank );
                
                $arrPara = array ();
                $dataLog = createDataLog ("getBank", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
              case "getProvince" : 
            {
                echo json_encode ( $provinces );
                
                $arrPara = array ();
                $dataLog = createDataLog ("getProvince", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getDistrict" : 
            {
                $provinceID = isset ( $_GET ['province_id'] ) ? $_GET ['province_id'] : "0";
                if($provinceID==0){
                    echo json_encode($districts);
                }else{
                    $arrDistricts = array();
                    foreach($districts as $item){
                        if($item["ProvinceCode"]==$provinceID){
                            $arrDistricts[]  =   $item;
                        }
                        
                    }
                    echo json_encode($arrDistricts);
                }
                $arrPara = array ("provinceID"=>$provinceID);
                $dataLog = createDataLog ("getDistrict", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         /*   $seller_id, $buyer_id,$quantity, $address_seller, $address_buyer, 
    $transaction_type, $pay_type, $status, $fee_product, $fee_transport, $transport_by, $discount, 
    $fee_total, $promotion_code*/
               case "postTransaction" : 
            {
                $seller_id = isset ( $_POST ['seller_id'] ) ? $_POST ['seller_id'] : "0";
                $seller_id = intval ( $seller_id );
                $buyer_id = isset ( $_POST ['buyer_id'] ) ? $_POST ['buyer_id'] : "0";
                $buyer_id = intval ( $buyer_id );
                // object json address (fullname,Adress,Mobile);
                $address_seller = isset ( $_POST ['address_seller'] ) ? $_POST ['address_seller'] : "";
                $address_seller = base64_decode( $address_seller );
                // object json address (fullname,Adress,Mobile);
                $address_buyer = isset ( $_POST ['address_buyer'] ) ? $_POST ['address_buyer'] : "";
                $address_buyer = base64_decode( $address_buyer );
                
                $transaction_type = isset ( $_POST ['transaction_type'] ) ? $_POST ['transaction_type'] : "0";
                $transaction_type = intval ( $transaction_type );
                $pay_type = isset ( $_POST ['pay_type'] ) ? $_POST ['pay_type'] : "0";
                $pay_type = intval ( $pay_type );
                
                $fee_product = isset ( $_POST ['fee_product'] ) ? $_POST ['fee_product'] : "0";
                $fee_product = doubleval ( $fee_product );
                
                $fee_transport_seller = isset ( $_POST ['fee_transport_seller'] ) ? $_POST ['fee_transport_seller'] : "0";
                $fee_transport_seller = doubleval ( $fee_transport_seller );
                
                $fee_transport_buyer = isset ( $_POST ['fee_transport_buyer'] ) ? $_POST ['fee_transport_buyer'] : "0";
                $fee_transport_buyer = doubleval ( $fee_transport_buyer );
                
                $promotion_code = isset ( $_POST ['promotion_code'] ) ? $_POST ['promotion_code'] : "";
                $promotion_code = mysql_escape_string ( $promotion_code );
                // array json product(id,quantity)
                $products = isset ( $_POST ['products'] ) ? $_POST ['products'] : "";
                $products =  base64_decode($products);
                $quantity  =  isset ( $_POST ['quantity'] ) ? $_POST ['quantity'] : "0";
                $quantity  =  intval($quantity );
                $transport_by = isset ( $_POST ['transport_buyer_by'] ) ? $_POST ['transport_buyer_by'] : "";
                $transport_by = mysql_escape_string( $transport_by );
                $product_offer_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_offer_id = intval ( $product_offer_id );
                
                $transport_buyer_service = isset ( $_POST ['transport_buyer_service'] ) ? $_POST ['transport_buyer_service'] : "";
                $transport_buyer_service = mysql_escape_string( $transport_buyer_service );

                $fee_total = 0;
                $discount = 0;
                $fee_transport = 0;
                $transaction_id = 0;
                $kq=2;
                $arrOut = array();
                $message = "Tạo giao dich không thành công.";
                if($product_offer_id==0||$quantity==0||$seller_id==0||$buyer_id==0||$transaction_type==0||$pay_type==0||empty($address_buyer)||empty($products)) 
                  {  $kq = 1;
                    $message = "Thiếu tham số giao dich.";
                  }
                else {
                       $product = getProductDetail($product_offer_id);
                       $slspCon = $product["quantity"];
                     if($slspCon<$quantity)
                    {
                        $kq = 2;
                        $message = "Số lượng sản phẩm không có đủ để giao dịch."; 
                    }else{
                        $codePro = getPromotionCode($promotion_code);
                        if(!empty($codePro)) $discount = $codePro["promotion_value"];
                        $fee_total = $fee_transport_seller+$fee_transport_buyer+$fee_product-$discount;
                        
                        $transaction_id = insertTransaction($seller_id, $buyer_id,$quantity, $address_seller, $address_buyer, 
        $transaction_type, $pay_type, 1, $fee_product, $fee_transport_seller,$fee_transport_buyer, $transport_by, $discount, 
        $fee_total, $promotion_code,$product_offer_id,$transport_buyer_service);
                        if($transaction_id > 0){
                            $message = "Tạo giao dịch thành công.";
                            $arr_product_item = json_decode($products);
                            foreach($arr_product_item as $item){
                                $product_detail=getProductDetail($item->product_id);
                                insertTransactionItem($transaction_id,$item->product_id,$product_detail["user_id"],
                                $item->quantity, 0);
                                updateQuantityTransaction($item->product_id,$item->quantity);
                            }
                            $kq = 0;
                            $processing_step = 1; // CReate transaction success
                            $note = "";
                            insertTransactionProcess($transaction_id,$processing_step,$seller_id,$note);
                            pushNotifySold($product_offer_id,$buyer_id);
                            }
                    }
                }
                
                $arrOut["kq"]=  $kq;
                $arrOut["message"]=  $message;
                $arrOut["id"]=  $transaction_id;
                echo json_encode ( $arrOut );
                
                $arrPara = array ("seller_id"=>$seller_id,"buyer_id"=>$buyer_id,"address_seller"=>$address_seller,"address_buyer"=>$address_buyer,"transaction_type"=>$transaction_type,"pay_type"=>$pay_type,"fee_product"=>$fee_product,"fee_transport_seller"=>$fee_transport_seller,"fee_transport_buyer"=>$fee_transport_buyer,"promotion_code"=>$promotion_code,"products"=>$products,"quantity"=>$quantity,"transport_buyer_by"=>$transport_by,"product_id"=>$product_offer_id);
                $dataLog = createDataLog ("postTransaction", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
              case "updateAddressBuyer" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $address_buyer = isset ( $_POST ['address_buyer'] ) ? $_POST ['address_buyer'] : "";
                $address_buyer = base64_decode( $address_buyer );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $kq=2;
                if($transaction_id==0||$user_id==0||empty($address_buyer)) $kq = 1;
                 else {
                 $transaction = getTransaction($transaction_id);
                 $process_step=getTransactionProcessStep($transaction_id);  
                 
                 if($process_step<4)
                    $kq = updateAddressBuyer($transaction_id,$address_buyer);
                    
                if($kq>0){
                    //log transaction change
                    insertTransactionLog($transaction_id,$user_id,$transaction["seller_id"],$transaction["buyer_id"],
                    $transaction["quantity"] ,$transaction["address_seller"],$transaction["address_buyer"] ,
                    $transaction["transaction_type"],$transaction["pay_type"],$transaction["status"],$transaction["fee_product"], $transaction["fee_transport_seller"] , $transaction["fee_transport_buyer"] ,$transaction["transport_seller_by"],$transaction["transport_buyer_by"] ,$transaction["discount"] ,$transaction["fee_total"] ,$transaction["promotion_code"],
                    $transaction["product_id"]);
                }
                $kq = $kq>0?0:2;
                 }
                echo $kq;
                
                $arrPara = array ("transaction_id"=>$transaction_id,"user_id"=>$user_id,"address_buyer"=>$address_buyer);
                $dataLog = createDataLog ("updateAddressBuyer", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updateAddressSeller" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $address_seller = isset ( $_POST ['address_seller'] ) ? $_POST ['address_seller'] : "";
                $address_seller = base64_decode( $address_seller );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $kq=2; 
                if($transaction_id==0||empty($address_seller)||$user_id==0) $kq = 1;
                 else {
                $transaction = getTransaction($transaction_id);
                $process_step=getTransactionProcessStep($transaction_id);  

                 if($process_step<4)
                    $kq = updateAddressSeller($transaction_id,$address_seller);

                 if($kq>0){
                    //log transaction change
                    insertTransactionLog($transaction_id,$user_id,$transaction["seller_id"],$transaction["buyer_id"],
                    $transaction["quantity"] ,$transaction["address_seller"],$transaction["address_buyer"] ,
                    $transaction["transaction_type"],$transaction["pay_type"],$transaction["status"],$transaction["fee_product"], $transaction["fee_transport_seller"] , $transaction["fee_transport_buyer"] ,$transaction["transport_seller_by"],$transaction["transport_buyer_by"] ,$transaction["discount"] ,$transaction["fee_total"] ,$transaction["promotion_code"],
                    $transaction["product_id"] );
                }
                
                $kq = $kq>0?0:2;
                 }
                echo $kq;
                
                $arrPara = array ("transaction_id"=>$transaction_id,"user_id"=>$user_id,"address_seller"=>$address_seller);
                $dataLog = createDataLog ("updateAddressSeller", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updatePaymentType" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $pay_type = isset ( $_POST ['pay_type'] ) ? $_POST ['pay_type'] : "0";
                $pay_type = intval( $pay_type );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $fee_transport = isset ( $_POST ['fee_transport'] ) ? $_POST ['fee_transport'] : "0";
                $fee_transport = doubleval($fee_transport );
                $transport_by = isset ( $_POST ['transport_by'] ) ? $_POST ['transport_by'] : "";
                $transport_by = mysql_escape_string($transport_by);
                $transport_service = isset ( $_POST ['transport_service'] ) ? $_POST ['transport_service'] : "";
                $transport_service = mysql_escape_string($transport_service);
                
                $kq=2;
                if($transaction_id==0||$user_id==0||$pay_type==0||empty($transport_by)) $kq = 1;
                 else {
                $transaction = getTransaction($transaction_id);
                // Update when dont payment
                if($transaction["status_payment"]==0){
                    if($transaction["buyer_id"]==$user_id)
                        $kq = updatePaymentTypeByBuyer($transaction_id,$pay_type,$fee_transport,$transport_by,$transport_service);
                    else 
                        $kq = updatePaymentTypeSeller($transaction_id,$pay_type,$fee_transport,$transport_by,$transport_service);
                }
                if($kq>0){
                    //log transaction change
                    insertTransactionLog($transaction_id,$user_id,$transaction["seller_id"],$transaction["buyer_id"],
                    $transaction["quantity"] ,$transaction["address_seller"],$transaction["address_buyer"] ,
                    $transaction["transaction_type"],$transaction["pay_type"],$transaction["status"],$transaction["fee_product"], $transaction["fee_transport_seller"] , $transaction["fee_transport_buyer"] ,$transaction["transport_seller_by"],$transaction["transport_buyer_by"] ,$transaction["discount"] ,$transaction["fee_total"] ,$transaction["promotion_code"],
                    $transaction["product_id"] );
                }
                
                
                $kq = $kq>0?0:2;
                 }
                echo $kq;
                
                $arrPara = array ("transaction_id"=>$transaction_id,"pay_type"=>$pay_type,"transport_by"=>$transport_by,"transport_service"=>$transport_service,"user_id"=>$user_id);
                $dataLog = createDataLog ("updatePaymentType", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
              case "cancelTransaction" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval( $user_id );
                $note = isset ( $_POST ['note'] ) ? $_POST ['note'] : "";
                $note = mysql_escape_string( $note );
                $arrKQ = array();
                $kq=2;$error="Lỗi hủy giao dịch";
                if($transaction_id==0||$user_id==0||empty($note)) {$kq = 1;$error="Thiếu tham số";}
                else {
                    $transactionDetail = getTransactionItem($transaction_id);
                    $process_step=getTransactionProcessStep($transaction_id);
                    if($process_step<4&&$transactionDetail["status_payment"]==0&&$transactionDetail["status"]==1){
                        $kq = cancelTransaction($transaction_id);
                        if($kq>0){
                            insertTransactionProcess($transaction_id,100,$user_id,$note);
                            $arrTranItem = getListTransactionItem($transaction_id);
                            foreach($arrTranItem as $item){
                                // up so luong sp
                                updateQuantityTransactionCancel($item["product_id"],$item["quantity"]);
                            }
                        } 
                        $kq = $kq>0?0:2;
                        if($kq == 0){
                            pushNotifyCancelTransaction($transaction_id, $user_id);
                            $error ="Hủy giao dịch thành công";
                        } 
                    }else {
                        $error="Giao dịch đã thực hiện. Bạn không thể hủy giao dịch này";
                    }
                }
                $arrKQ["result"]=$kq;
                $arrKQ["error"]=$error;
                echo json_encode($arrKQ);
                
                $arrPara = array ("transaction_id"=>$transaction_id,"user_id"=>$user_id,"note"=>$note);
                $dataLog = createDataLog ("cancelTransaction", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }  
            case "getListTransactionSell" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "0";
                $page = intval ( $page );
                
                $arrTran =getListTransactionSell($user_id,$page,$limit);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page);
                $dataLog = createDataLog ("getListTransactionSell", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getListTransactionBuy" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "0";
                $page = intval ( $page );
                
                $arrTran =getListTransactionBuy($user_id,$page,$limit);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page);
                $dataLog = createDataLog ("getListTransactionBuy", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getListTransactionSwap" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "0";
                $page = intval ( $page );
                
                $arrTran =getListTransactionSwap($user_id,$page,$limit);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id,"page"=>$page);
                $dataLog = createDataLog ("getListTransactionBuy", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getTransactionDetail" : 
            {
                $transaction_id = isset ( $_GET ['transaction_id'] ) ? $_GET ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
               
                $arrTran = getTransactionDetail($transaction_id);
                $arrTranStep = getTransactionProcess($transaction_id);
                $arrTran["process_step"]=getTransactionProcessStep($transaction_id);
                
                $arrOut = array();
                $arrOut["transaction"] =$arrTran;
                $arrOut["step"] =$arrTranStep;
                
                echo json_encode ($arrOut);
                
                $arrPara = array ("transaction_id"=>$transaction_id);
                $dataLog = createDataLog ("getTransactionDetail", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "postProductReport" : 
            {
                $reason = isset ( $_POST ['reason'] ) ? $_POST ['reason'] : "0";
                $reason = intval ( $reason );
                $note = isset ( $_POST ['note'] ) ? $_POST ['note'] : "";
                $note = mysql_escape_string( $note );
                $create_user_id = isset ( $_POST ['create_user_id'] ) ? $_POST ['create_user_id'] : "0";
                $create_user_id = intval( $create_user_id );
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval( $product_id );
                
                $kq=0;
                if($reason==0||$create_user_id==0||$product_id==0) $kq = 1;
                else {
                    $kq =insertProductReport($reason,ucfirst($note),$create_user_id,$product_id);
                    $kq = $kq >0?0:2;
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("reason"=>$reason,"create_user_id"=>$create_user_id,"note"=>$note
                ,"product_id"=>$product_id);
                $dataLog = createDataLog ("postProductReport", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "postRateUser" : 
            {
                $status = isset ( $_POST ['status'] ) ? $_POST ['status'] : "0";
                $status = intval ( $status );
                $comment = isset ( $_POST ['comment'] ) ? $_POST ['comment'] : "";
                $comment = mysql_escape_string( $comment );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval( $user_id );
                $valuer_id = isset ( $_POST ['valuer_id'] ) ? $_POST ['valuer_id'] : "0";
                $valuer_id = intval( $valuer_id );
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval( $transaction_id );
               // $transaction_id = 0;
                $kq=0;
                if($valuer_id==0||$user_id==0||$status==0) $kq = 1;
                else {
                    $kq =insertUserRate($user_id,$valuer_id,$transaction_id,$status,ucfirst($comment));
                    $kq = $kq >0?0:2;
                    if($kq==0){
                        updateStaticComment($user_id,$status);
                        pushNotifyFeedBack($transaction_id, $user_id, $valuer_id,$status);
                    } 
                    
                }
                
                echo json_encode ( $kq );
                
                $arrPara = array ("status"=>$status,"user_id"=>$user_id,"valuer_id"=>$valuer_id,"comment"=>$comment);
                $dataLog = createDataLog ("postRateUser", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updateTransportSeller" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $transport_seller_by = isset ( $_POST ['transport_seller_by'] ) ? $_POST ['transport_seller_by'] : "";
                $transport_seller_by = mysql_escape_string( $transport_seller_by );
                $fee_transport_seller = isset ( $_POST ['fee_transport_seller'] ) ? $_POST ['fee_transport_seller'] : "0";
                $fee_transport_seller = doubleval($fee_transport_seller );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $kq=2;
                if($user_id==0||$transaction_id==0||$fee_transport_seller==0||empty($transport_seller_by)) $kq = 1;
                 else {
                $transaction = getTransaction($transaction_id);
                $kq = updateTransportSeller($transaction_id,$transport_seller_by,$fee_transport_seller);
                if($kq>0){
                    //log transaction change
                    insertTransactionLog($transaction_id,$user_id,$transaction["seller_id"],$transaction["buyer_id"],
                    $transaction["quantity"] ,$transaction["address_seller"],$transaction["address_buyer"] ,
                    $transaction["transaction_type"],$transaction["pay_type"],$transaction["status"],$transaction["fee_product"], $transaction["fee_transport_seller"] , $transaction["fee_transport_buyer"] ,$transaction["transport_seller_by"],$transaction["transport_buyer_by"] ,$transaction["discount"] ,$transaction["fee_total"] ,$transaction["promotion_code"],
                    $transaction["product_id"] );
                }
                $kq = $kq>0?0:2;
                 }
                echo $kq;
                
                $arrPara = array ("transaction_id"=>$transaction_id,"user_id"=>$user_id,"transport_seller_by"=>$transport_seller_by
                ,"transport_seller_by"=>$transport_seller_by);
                $dataLog = createDataLog ("updateTransportSeller", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updateTransportBuyer" : 
            {
                $transaction_id = isset ( $_POST ['transaction_id'] ) ? $_POST ['transaction_id'] : "0";
                $transaction_id = intval ( $transaction_id );
                $transport_buyer_by = isset ( $_POST ['transport_buyer_by'] ) ? $_POST ['transport_buyer_by'] : "";
                $transport_buyer_by = mysql_escape_string( $transport_buyer_by );
                $fee_transport_buyer = isset ( $_POST ['fee_transport_buyer'] ) ? $_POST ['fee_transport_buyer'] : "0";
                $fee_transport_buyer = doubleval($fee_transport_buyer );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $kq=2;
                if($user_id==0||$transaction_id==0||$fee_transport_buyer==0||empty($transport_buyer_by)) $kq = 1;
                 else {
                $transaction = getTransaction($transaction_id);
                $kq = updateTransportBuyer($transaction_id,$transport_buyer_by,$fee_transport_buyer);
                if($kq>0){
                    //log transaction change
                    insertTransactionLog($transaction_id,$user_id,$transaction["seller_id"],$transaction["buyer_id"],
                    $transaction["quantity"] ,$transaction["address_seller"],$transaction["address_buyer"] ,
                    $transaction["transaction_type"],$transaction["pay_type"],$transaction["status"],$transaction["fee_product"], $transaction["fee_transport_seller"] , $transaction["fee_transport_buyer"] ,$transaction["transport_seller_by"],$transaction["transport_buyer_by"] ,$transaction["discount"] ,$transaction["fee_total"] ,$transaction["promotion_code"],
                    $transaction["product_id"] );
                }
                $kq = $kq>0?0:2;
                 }
                echo $kq;
                
                $arrPara = array ("transaction_id"=>$transaction_id,"user_id"=>$user_id,"transport_buyer_by"=>$transport_buyer_by
                ,"fee_transport_buyer"=>$fee_transport_buyer);
                $dataLog = createDataLog ("updateTransportBuyer", $arrPara, $kq);
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            //searchProduct($keyword,$priceF,$priceT,$lat, $lng
         //   , $distance ,$order_by ,$page) 
               case "searchProduct" : 
            {
                $keyword = isset ( $_POST ['keyword'] ) ? $_POST ['keyword'] : "";
                $cat_id = isset ( $_POST ['cat_id'] ) ? $_POST ['cat_id'] : "0";
                $cat_id = intval( $cat_id );
                $order_by =isset($_POST ['order_by'] ) ? $_POST ['order_by'] : "0";
                $order_by = intval ( $order_by );
                
                $page = isset ( $_POST ['page'] ) ? $_POST ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_POST ['lon'] ) ? $_POST ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
                $lat = doubleval( $lat );
                $distance = isset ( $_POST ['distance'] ) ? $_POST ['distance'] : "50";
                $distance = doubleval( $distance );
                
                $price_from = isset ( $_POST ['price_from'] ) ? $_POST ['price_from'] : "0";
                $price_from = doubleval( $price_from );
                $price_to = isset ( $_POST ['price_to'] ) ? $_POST ['price_to'] : "0";
                $price_to = doubleval( $price_to );
                if($price_to==0&&$price_from>0)$price_to = 2500000000.0;
                
                $output = searchProduct($keyword,$cat_id,$price_from,$price_to,$lat,$lon,$distance,$order_by,$page);
                echo json_encode ( $output );
                
                $arrPara = array ("keyword"=>$keyword,"cat_id"=>$cat_id,"price_from"=>$price_from,"price_to"=>$price_to,"order_by"=>$order_by,"lon"=>$lon,"lat"=>$lat,"distance"=>$distance,"limit"=>$limit);
                $dataLog = createDataLog ("searchProduct", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getProductRecomment" : 
            {
                $keyword = isset ( $_POST ['keyword'] ) ? $_POST ['keyword'] : "";
                $page = isset ( $_POST ['page'] ) ? $_POST ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_POST ['lon'] ) ? $_POST ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
                $lat = doubleval( $lat );
                $price = isset ( $_POST ['price'] ) ? $_POST ['price'] : "0";
                $price = doubleval( $price );
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = doubleval( $user_id );
                
                $output = queryProductRecommend($keyword,$user_id,$price,$lat,$lon,$page);
                echo json_encode ( $output );
                
                $arrPara = array ("keyword"=>$keyword,"lon"=>$lon,"lat"=>$lat,"limit"=>$limit);
                $dataLog = createDataLog ("getProductRecomment", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "searchProductNearest" : 
            {
                $keyword = isset ( $_POST ['keyword'] ) ? $_POST ['keyword'] : "";
                $cat_id = isset ( $_POST ['cat_id'] ) ? $_POST ['cat_id'] : "0";
                $cat_id = intval( $cat_id );
               
                $page = isset ( $_POST ['page'] ) ? $_POST ['page'] : "1";
                $page = intval ( $page );
                $lon = isset ( $_POST ['lon'] ) ? $_POST ['lon'] : "0";
                $lon = doubleval( $lon );
                $lat = isset ( $_POST ['lat'] ) ? $_POST ['lat'] : "0";
                $lat = doubleval( $lat );
                $distance = isset ( $_POST ['distance'] ) ? $_POST ['distance'] : "50";
                $distance = doubleval( $distance );
                
                $price_from = isset ( $_POST ['price_from'] ) ? $_POST ['price_from'] : "0";
                $price_from = doubleval( $price_from );
                $price_to = isset ( $_POST ['price_to'] ) ? $_POST ['price_to'] : "0";
                $price_to = doubleval( $price_to );
                
                $output = searchProductNearest($keyword,$cat_id,$price_from,$price_to,$lat,$lon,$distance,$page);
                echo json_encode ( $output );
                
                $arrPara = array ("keyword"=>$keyword,"cat_id"=>$cat_id,"price_from"=>$price_from,"price_to"=>$price_to,"lon"=>$lon,"lat"=>$lat,"distance"=>$distance,"limit"=>$limit);
                $dataLog = createDataLog ("searchProductNearest", $arrPara, "" );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "registryNotice": { 
              $device_token = isset($_POST['device_token'])?$_POST['device_token'] :""; 
              $os_type = isset($_POST['os_type'])?$_POST['os_type'] :"0"; 
              $os_type = intval($os_type);
              $user_id = isset($_POST['user_id'])?$_POST['user_id'] :"0"; 
              $user_id = intval($user_id);
              $app_client_id = isset($_GET['app_client_id'])?$_GET['app_client_id'] :"0"; 
            
              if($os_type==0||empty($device_token)||strcmp("(null)",$device_token)==0||$app_client_id==0) {echo 1;return;}
            
              if(checkKeyNotifyShopByAppClient($app_client_id,$user_id)==0){
                  $kq = insertNoticeUserShop($app_client_id,$user_id,$device_token,intval($os_type));
              }else{
                  updateNoticeUserShop($app_client_id,$user_id,$device_token);
              }
              
              $kq = 1;
              if($kq == 1) echo 0;
              else echo 2; // insert không thành công
              
              $arrPara = array ("app_client_id"=>$app_client_id,"user_id"=>$user_id
              ,"os_type"=>$os_type,"device_token"=>$device_token);
              $dataLog = createDataLog ("registryNotice", $arrPara, $kq );
              $ip = getRealIpAddr ();
              insertAppTrackingShop(0, $app_client_id, $dataLog, $ip );
              break;        
        }  
         case "getActivity" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrTran =getActivity($user_id);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getActity", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
         case "deleteProduct" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $kq = 0;
                if($user_id==0||$product_id==0) $kq = 1;
                else {
                    if(checkProductInTransaction($product_id)>0)$kq = 3; // had transaction
                    else {
                       $kq = deleteProductByUser($product_id,$user_id);
                       $kq  = 0?2:0; // Do not updated
                    }
                }
                echo $kq;
                
                $arrPara = array ("product_id"=>$product_id,"user_id"=>$user_id);
                $dataLog = createDataLog ("deleteProduct", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getMyOfferSell" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrTran =getMyOfferSell($user_id);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getMyOfferSell", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getMyOfferBuy" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrTran =getMyOfferBuy($user_id);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getMyOfferBuy", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "getMyOfferSwap" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrTran =getMyOfferSwap($user_id);
                
                echo json_encode ( $arrTran );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getMyOfferSwap", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
             case "validateMobile" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $code = isset ( $_POST ['code'] ) ? $_POST ['code'] : "";
                $code = $code ;
                
                $arrayKQ = array();
                if($user_id==0||empty($code)) {
                    $arrayKQ["kq"]=1;
                    $arrayKQ["message"]="Thiếu tham số.";
                }else{
                   $userMobile = getUserMobileValidate($user_id);
                   if($userMobile!=null&&strcasecmp($code,$userMobile["code_validate"])==0) 
                   {
                        $arrayKQ["kq"]=0;
                        $arrayKQ["message"]="Xác nhận số điện thoại thành công.";   
                        $kqupdate = updateHadValidateMobile($user_id);
                        // xoa user mobile validate
                        if($kqupdate>0){
                            deleteMobileValidate($user_id);
                            // delete cache user
                            $userInfo=getUserShopById($user_id);
                            $querykey = md5("KEY.getUserShopByEmail." .$userInfo["email"]); 
                            deleteCacheByKey($querykey);
                            $querykey = md5("KEY.getUserShopBySSOID." .$userInfo["sso_id"]); 
                            deleteCacheByKey($querykey);
                            $querykey = md5("KEY.getUserShopById." .$user_id); 
                            deleteCacheByKey($querykey); 
                        }
                   }else{
                       $arrayKQ["kq"]=2;
                       $arrayKQ["message"]="Xác nhận số điện thoại không thành công.";    
                   }
                } 
                
                echo json_encode ( $arrayKQ );
                
                $arrPara = array ("user_id"=>$user_id,"code"=>$code);
                $dataLog = createDataLog ("validateMobile", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
            case "revalidateValidateMobile" : 
            {
                $user_id = isset ( $_POST ['user_id'] ) ? $_POST ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $arrayKQ = array();
                if($user_id==0) {
                    $arrayKQ["kq"]=1;
                    $arrayKQ["message"]="Thiếu tham số.";
                }else{
                   $userShop = getUserShopById($user_id);
                   if($userShop!=null) 
                   {
                        deleteMobileValidate($user_id); 
                        insertMobileValidate($user_id,$userShop["mobile"]);
                        $arrayKQ["kq"]=0;
                        $arrayKQ["message"]="Đã yêu cầu gửi lại mã xác nhận điện thoại.";   
                   }else{
                       $arrayKQ["kq"]=2;
                       $arrayKQ["message"]="Yêu cầu gửi mã xác nhận điện thoại không thành công.";    
                   }
                } 
                
                echo json_encode ( $arrayKQ );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("revalidateValidateMobile", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
             case "getProductSwapMatching" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                
                $arrProduct =getProductSwapMatching($user_id);
                
                echo json_encode ( $arrProduct );
                
                $arrPara = array ("user_id"=>$user_id);
                $dataLog = createDataLog ("getProductSwapMatching", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getItemSwapMatching" : 
            {
                $user_id = isset ( $_GET ['user_id'] ) ? $_GET ['user_id'] : "0";
                $user_id = intval ( $user_id );
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ( $product_id );
                
                $arrProduct =getItemSwapMatching($user_id,$product_id);
                
                echo json_encode ( $arrProduct );
                
                $arrPara = array ("user_id"=>$user_id,"product_id"=>$product_id);
                $dataLog = createDataLog ("getItemSwapMatching", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "updateTagSwapProduct" : 
            {
                $product_id = isset ( $_POST ['product_id'] ) ? $_POST ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $wish_swap = isset ( $_POST ['wish_swap'] ) ? $_POST ['wish_swap'] : "";   
               
                $kq = 1;
                 if($product_id>0){ 
                    $kq =updateTagSwapProduct($product_id,$wish_swap);
                    $kq = $kq >0 ?0:2;   
                } 
                
                echo $kq;
                
                $arrPara = array ("product_id"=>$product_id,"wish_swap"=>$wish_swap);
                $dataLog = createDataLog ("updateTagSwapProduct", $arrPara, $kq );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getProductSwapMatchingNext" : 
            {
                $product_id = isset ( $_GET ['product_id'] ) ? $_GET ['product_id'] : "0";
                $product_id = intval ( $product_id );
                $page = isset ( $_GET ['page'] ) ? $_GET ['page'] : "0";
                $page = intval ( $page );
                
                $arrProduct =getProductSwapMatchingNext($product_id,$page);      
                
                echo json_encode ( $arrProduct );
                
                $arrPara = array ("product_id"=>$product_id,"page"=>$page);
                $dataLog = createDataLog ("getProductSwapMatchingNext", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                
                break;
            }
            case "getEventTop" : 
            {
                $arrEvents =getEventTop();      
                echo json_encode ( $arrEvents );
                $arrPara = array ();
                $dataLog = createDataLog ("getEventTop", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
            case "getInformDetail" : 
            {
                $inform_id = isset ( $_GET ['inform_id'] ) ? $_GET ['inform_id'] : "0";
                $inform_id = intval ( $inform_id );
                $inform =getInformDetail($inform_id);      
                echo json_encode ( $inform );
                $arrPara = array ("inform_id"=>$inform_id);
                $dataLog = createDataLog ("getInformDetail", $arrPara, 0 );
                $ip = getRealIpAddr ();
                insertAppTrackingShop( 0, $app_client_id, $dataLog, $ip );
                break;
            }
             default :
        {
           /* header('Location: http://www.traodoidi.vn/');
            exit;
                    */
            $function = isset ( $_GET ['function'] ) ? $_GET ['function'] : "";
            if (! empty ( $function )) {
                $shopDoc = new ShopDOC( $function );
                $shopDoc->outLine ();
            } else {
                header('Location: http://kenhkiemtien.com/kkt_api/shop/api.php');
                exit;
    
                echo "<style> li{padding-top:10px;list-style-type:decimal;} table, td, th {border: 1px solid black;}";
                echo "a:link {text-decoration: none;} a:visited {text-decoration: none;} a:hover {text-decoration: underline;} a:active {text-decoration:underline}</style>";
                echo "<H1>Danh sách API SHOP:</H1>";
                echo "<table style='border: 1px solid black;border-collapse: collapse;'><tr><td valign=top>";
                echo "<UL>";
                echo "<li><a href='".$url_api."?function=getCategory' target='_blank'>getCategory</a></li>";
                echo "<li><a href='".$url_api."?function=getCategoryAll' target='_blank'>getCategoryAll</a></li>";
                echo "<li><a href='".$url_api."?function=getProductHome' target='_blank'>getProductHome</a></li>";
                echo "<li><a href='".$url_api."?function=getProductCate' target='_blank'>getProductCate</a></li>";
                echo "<li><a href='".$url_api."?function=getProductFollowing' target='_blank'>getProductFollowing</a></li>";
                echo "<li><a href='".$url_api."?function=getProductFavorite' target='_blank'>getProductFavorite</a></li>";
                echo "<li><a href='".$url_api."?function=getProductByDistance' target='_blank'>getProductByDistance</a></li>";
                echo "<li><a href='".$url_api."?function=getProductByDistanceFT' target='_blank'>getProductByDistanceFT</a></li>";
                
                echo "<li><a href='".$url_api."?function=getProductDetail' target='_blank'>getProductDetail</a></li>";
                echo "<li><a href='".$url_api."?function=getProductComment' target='_blank'>getProductComment</a></li>";
                echo "<li><a href='".$url_api."?function=getProductSameCate' target='_blank'>getProductSameCate</a></li>";
                
                echo "<li><a href='".$url_api."?function=postProduct' target='_blank'>postProduct</a></li>";
                echo "<li><a href='".$url_api."?function=updateProduct' target='_blank'>updateProduct</a></li>";
                echo "<li><a href='".$url_api."?function=deleteProduct' target='_blank'>deleteProduct</a></li>";
                
                echo "<li><a href='".$url_api."?function=postProductFavorite' target='_blank'>postProductFavorite</a></li>";
                echo "<li><a href='".$url_api."?function=deleteProductFavorite' target='_blank'>deleteProductFavorite</a></li>";
                echo "<li><a href='".$url_api."?function=uploadImageProduct' target='_blank'>uploadImageProduct</a></li>";
                
                echo "<li><a href='".$url_api."?function=getAppHeaderShop' target='_blank'>getAppHeaderShop</a></li>";
                echo "<li><a href='".$url_api."?function=registerMember' target='_blank'>registerMember</a></li>";
                echo "<li><a href='".$url_api."?function=getUserInfo' target='_blank'>getUserInfo</a></li>";
                
                
                echo "</UL></TD><TD valign=top><UL>";
                echo "<li  value=21><a href='".$url_api."?function=updateUserInfo' target='_blank'>updateUserInfo</a></li>";
                echo "<li><a href='".$url_api."?function=uploadAvatarUser' target='_blank'>uploadAvatarUser</a></li>";
                echo "<li><a href='".$url_api."?function=getProductOfUser' target='_blank'>getProductOfUser</a></li>";
                echo "<li><a href='".$url_api."?function=getProductByIDs' target='_blank'>getProductByIDs</a></li>";
                echo "<li><a href='".$url_api."?function=getUserByIDs' target='_blank'>getUserByIDs</a></li>";
                echo "<li><a href='".$url_api."?function=postUserFollowing' target='_blank'>postUserFollowing</a></li>";
                echo "<li><a href='".$url_api."?function=unFollowing' target='_blank'>unFollowing</a></li>";
                echo "<li><a href='".$url_api."?function=getUserFollowing' target='_blank'>getUserFollowing</a></li>";
                echo "<li><a href='".$url_api."?function=getUserFollower' target='_blank'>getUserFollower</a></li>";
                echo "<li><a href='".$url_api."?function=postProductComment' target='_blank'>postProductComment</a></li>";
                echo "<li><a href='".$url_api."?function=postAddress' target='_blank'>postAddress</a></li>";
                echo "<li><a href='".$url_api."?function=postPaymentMethodBank' target='_blank'>postPaymentMethodBank</a></li>";
                echo "<li><a href='".$url_api."?function=postPaymentMethodCMT' target='_blank'>postPaymentMethodCMT</a></li>";
                echo "<li><a href='".$url_api."?function=getAddress' target='_blank'>getAddress</a></li>";
                echo "<li><a href='".$url_api."?function=getPaymentMethod' target='_blank'>getPaymentMethod</a></li>";
                echo "<li><a href='".$url_api."?function=getBank' target='_blank'>getBank</a></li>";
                echo "<li><a href='".$url_api."?function=getProvince' target='_blank'>getProvince</a></li>";
                echo "<li><a href='".$url_api."?function=getDistrict' target='_blank'>getDistrict</a></li>";
                echo "<li><a href='".$url_api."?function=getListTransactionSell' target='_blank'>getListTransactionSell</a></li>";
                echo "<li><a href='".$url_api."?function=getListTransactionBuy' target='_blank'>getListTransactionBuy</a></li>";
                
                echo "</UL></TD><TD valign=top><UL>"; 
                
                echo "<li value=41><a href='".$url_api."?function=postTransaction' target='_blank'>postTransaction</a></li>";
                echo "<li><a href='".$url_api."?function=getListTransactionSwap' target='_blank'>getListTransactionSwap</a></li>";
                echo "<li><a href='".$url_api."?function=updateAddressBuyer' target='_blank'>updateAddressBuyer</a></li>";
                echo "<li><a href='".$url_api."?function=updateAddressSeller' target='_blank'>updateAddressSeller</a></li>";
                echo "<li><a href='".$url_api."?function=updatePaymentType' target='_blank'>updatePaymentType</a></li>";
                echo "<li><a href='".$url_api."?function=cancelTransaction' target='_blank'>cancelTransaction</a></li>";
                echo "<li><a href='".$url_api."?function=postProductReport' target='_blank'>postProductReport</a></li>";
                echo "<li><a href='".$url_api."?function=postRateUser' target='_blank'>postRateUser</a></li>";
                echo "<li><a href='".$url_api."?function=updateTransportSeller' target='_blank'>updateTransportSeller</a></li>";
                echo "<li><a href='".$url_api."?function=updateTransportBuyer' target='_blank'>updateTransportBuyer</a></li>";
                echo "<li><a href='".$url_api."?function=getShipPartner' target='_blank'>getShipPartner</a></li>";
                echo "<li><a href='".$url_api."?function=getFeeShip' target='_blank'>getFeeShip</a></li>";
                echo "<li><a href='".$url_api."?function=getProductFilter' target='_blank'>getProductFilter</a></li>";
                echo "<li><a href='".$url_api."?function=searchProduct' target='_blank'>searchProduct</a></li>";
                echo "<li><a href='".$url_api."?function=searchProductNearest' target='_blank'>searchProductNearest</a></li>";
                echo "<li><a href='".$url_api."?function=registryNotice' target='_blank'>registryNotice</a></li>";
                echo "<li><a href='".$url_api."?function=getActivity' target='_blank'>getActivity</a></li>";
                echo "<li><a href='".$url_api."?function=GetServiceList' target='_blank'>GetServiceList</a></li>";
                echo "<li><a href='".$url_api."?function=CalculateServiceFees' target='_blank'>CalculateServiceFees</a></li>";
                echo "<li><a href='".$url_api."?function=getUserByFacebookIDs' target='_blank'>getUserByFacebookIDs</a></li>";
                echo "</UL></TD><TD valign=top><UL>"; 
                echo "<li value=61><a href='".$url_api."?function=createOrder123Pay' target='_blank'>createOrder123Pay</a></li>";
                echo "<li><a href='".$url_api."?function=get123Bank' target='_blank'>get123Bank</a></li>";
                echo "<li><a href='".$url_api."?function=getProductSwap' target='_blank'>getProductSwap</a></li>";
                echo "<li><a href='".$url_api."?function=updateMobileUser' target='_blank'>updateMobileUser</a></li>";
                echo "<li><a href='".$url_api."?function=getTransactionDetail' target='_blank'>getTransactionDetail</a></li>";
                echo "<li><a href='".$url_api."?function=getTransactionByProduct' target='_blank'>getTransactionByProduct</a></li>";
                echo "<li><a href='".$url_api."?function=validateMobile' target='_blank'>validateMobile</a></li>";
                echo "<li><a href='".$url_api."?function=revalidateValidateMobile' target='_blank'>revalidateValidateMobile</a></li>";
                echo "<li><a href='".$url_api."?function=getProductRecomment' target='_blank'>getProductRecomment</a></li>";
                echo "<li><a href='".$url_api."?function=updateAddress' target='_blank'>updateAddress</a></li>";       
                echo "<li><a href='".$url_api."?function=deleteAddress' target='_blank'>deleteAddress</a></li>";       
                echo "<li><a href='".$url_api."?function=getSeller' target='_blank'>getSeller</a></li>"; 
                echo "<li><a href='".$url_api."?function=getProductInfo' target='_blank'>getProductInfo</a></li>";  
                echo "<li><a href='".$url_api."?function=getProductSwapMatching' target='_blank'>getProductSwapMatching</a></li>";    
                echo "<li><a href='".$url_api."?function=getProductSwapMatchingNext' target='_blank'>getProductSwapMatchingNext</a></li>"; 
                echo "<li><a href='".$url_api."?function=getItemSwapMatching' target='_blank'>getItemSwapMatching</a></li>";  
                
                echo "<li><a href='".$url_api."?function=getMyOfferSell' target='_blank'>getMyOfferSell</a></li>";
                echo "<li><a href='".$url_api."?function=getMyOfferBuy' target='_blank'>getMyOfferBuy</a></li>";
                echo "<li><a href='".$url_api."?function=getMyOfferSwap' target='_blank'>getMyOfferSwap</a></li>"; 
                echo "<li><a href='".$url_api."?function=updateTagSwapProduct' target='_blank'>updateTagSwapProduct</a></li>";
                echo "<li><a href='".$url_api."?function=getEventTop' target='_blank'>getEventTop</a></li>"; 
                echo "<li><a href='".$url_api."?function=getInformDetail' target='_blank'>getInformDetail</a></li>"; 
                
                echo "</UL></td></tr><table>";
                echo "";                                                                                                        
            }
        }                         
               
  }                                                                                                                 
            
?>
