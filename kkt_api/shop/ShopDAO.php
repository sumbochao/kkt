<?php
   define("TIME_15", 900);
   define("TIME_30", 1800);
   define("TIME_60", 3600); 
   define("TIME_12h", 43200);  
   define("ROOT_UPLOAD","/home/traodoidi/domains/traodoidi.vn/public_html/upload");
   define("SERVER_CACHE_IP","localhost") ;    
    
   function baseUrl(){
        return "https://traodoidi.vn/";
    }
   
    function baseUrlUpload()
    {
        return "https://static.traodoidi.vn/upload/";
    } 
    
   function connectDBShop(){
        include('ShopConfig.php');    
        $mode="development";
        $config = $config[$mode];
        
        // Create a connection to the database.
        $connect = new PDO(
            'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], 
            $config['db']['username'], 
            $config['db']['password'],
            array());

        // If there is an error executing database queries, we want PDO to
        // throw an exception.
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // We want the database to handle all strings as UTF-8.
        $connect->query('SET NAMES utf8');
        return  $connect;
   }
   
   function insertAppTrackingShop($app_header,$app_client_id,$LOGS,$ip)
    {   
        $count =  0;
        try{
            $app_client = getAppClientIdShop($app_client_id);
            $app_header = getAppHeaderShopBuyID($app_client["app_header_id"]);
            $version ="";
            if(!empty($app_header))
            $version = $app_header["VERSION"];
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_app_tracking (app_header,app_client_id,os,LOGS,ip,version,create_date) VALUES (?,?,?,?,?,?,NOW())"; 
            $q = $connect->prepare($sql);
            $arrV = array($app_client["app_header_id"],$app_client_id,$app_client["os"],$LOGS,$ip,$version);
            $count = $q->execute($arrV);
           
            $connect = NULL;
        }catch(Exception $e) {
        }
        
        return $count;   
    }
    
    
   function getCategoryShop($parent_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $parent_id = intval($parent_id);
        $sql = "SELECT id,name,icon FROM ms_category WHERE  status = 1 And parent_id = ".$parent_id." ORDER BY order_cat ASC "; 
        
        $querykey = md5("KEY." . $sql);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $connect = $connect->query($sql);
            # setting the fetch mode
            $connect->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();   
            $i=0;  
            while($row = $connect->fetch()) {
                 $arr[$i] =  $row;
                 if($row['icon']!="")
                    $arr[$i]['icon'] = baseUrl()."/upload/shop/category/".$row['icon'];
                    $i++;
            }
            $connect = NULL;
            $meminstance->set($querykey, $arr, 0, TIME_60);
            return $arr;
            
        }else{
            return $result;
        }
           
    } 
    
    function getCategoryAll()
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $sql = "SELECT id,parent_id,name,icon FROM ms_category WHERE  status = 1  ORDER BY order_cat ASC "; 
        
        $querykey =  md5("KEY.".$sql);
        $result = $meminstance->get($querykey);
        
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $connect = $connect->query($sql);
            # setting the fetch mode
            $connect->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();   
            $i=0;  
            while($row = $connect->fetch()) {
                 $arr[$i] =  $row;
                 if($row['icon']!="")
                    $arr[$i]['icon'] = baseUrl()."/upload/shop/category/".$row['icon'];
                    $i++;
            }
            $connect = NULL;
            $meminstance->set($querykey, $arr, 0, TIME_60);
            return $arr;
            
        }else{
            return $result;
        }
           
    } 
    
    function getCategoryAndGroup()
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $sql = "SELECT id,parent_id,name,icon FROM ms_category WHERE  status = 1  ORDER BY parent_id,order_cat  ASC "; 
        
        $querykey =md5("KEY." . $sql);
        $result = $meminstance->get($querykey);
        
        //if(1>0){
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $connect = $connect->query($sql);
            # setting the fetch mode
            $connect->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();
            $arrCateRoot = array();   
            $i=0;  
            while($row = $connect->fetch()) {
                 $arr[$i] =  $row;
                 if($row['icon']!=""){
                    $arr[$i]['icon'] = baseUrl()."/upload/shop/category/".$row['icon'];
                 }
                 if($row["parent_id"]==0)   {
                    $arrCateRoot[]  =  $arr[$i];
                 }
                 $i++;
            }
            $connect = NULL;  
            
            $i = 0;
            foreach($arrCateRoot as $root){
                $arCatSub = array();
                    foreach($arr as $cate){
                        if($cate["parent_id"]==$root["id"]){
                             $arCatSub[] =   $cate;
                        }
                    }
                $arrCateRoot[$i]["sub"] =  $arCatSub;
                $i++;
            }
            
            $meminstance->set($querykey, $arrCateRoot, 0, TIME_12h);
            return $arrCateRoot;
            
        }else{
            return $result;
        }
           
    } 
    
    
    function getProductHome()
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell FROM ms_product Where status = 1  Order By id DESC limit 30 "; 
        $querykey =md5("KEY.getProductHome" );
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
     function getProductCate($cate_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
       
        $cate_id = intval($cate_id);
        $page = $page<=0?1:$page;
        $startRecord = ($page - 1) * $limit;
            
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer FROM ms_product Where status = 1  And (cate_id = ? OR cate_parent_id = ?) And deleted = 0 Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
        $querykey =md5("KEY.getProductCate.".$cate_id.".".$page);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($cate_id,$cate_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             $sl = countProductByCate($cate_id);
             
             $arrOut = array();
             $arrOut["product"] = $arrPro;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             return $arrOut;  
        }else{
            $sl = countProductByCate($cate_id);
            $arrOut = array();
            $arrOut["product"] = $result;
            $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
            return $arrOut;
        } 
           
    } 
    
    function getProductSameCate($product_id,$cate_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $cate_id = intval($cate_id);
        $product_id = intval($product_id);
        
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell FROM ms_product Where status = 1 And deleted = 0   And cate_id = ? And id <> ? Order By id DESC limit 30 "; 
        $querykey =md5("KEY.getProductSameCate.".$product_id.".".$cate_id);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($cate_id,$product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getProductByIDs($product_ids)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $last_char = substr($product_ids, -1);
        if(strcmp($last_char,",")==0)
        $product_ids = cleanQuery(substr($product_ids,0,strlen($product_ids)-1));
        $arrPro = array();
        if(empty($product_ids)) return $arrPro;
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,weight,length,width,height,type_sell FROM ms_product Where status = 1  And  id in (".$product_ids.")  "; 
 
        $querykey =md5("KEY.getProductByIDs.".$product_ids);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;  
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    }
    
      function getProductFavorite($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $page = $page<=0?1:$page;
        $startRecord = ($page - 1) * $limit;
        $arrPro = array();
        $product_ids = getIDProductFavorite($user_id);
        
        if(empty($product_ids)) {return $arrPro;}
        
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell FROM ms_product Where status = 1 And deleted = 0  And id IN (".$product_ids.") Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
      
        $querykey =md5("KEY.getProductFavorite.".$user_id.".".$page);
        $result = $meminstance->get($querykey);
        
         if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $arrPro[$i]['like'] = 1;
                 $user = getUserShopById($row["user_id"]);
                 $arrPro[$i]['create_user'] = $user["fullname"];
                 $arrPro[$i]['avatar_url'] = $user["avatar_url"];
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
     function getProductByDistance($lon,$lat,$distance,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $page = $page<=0?1:$page;
        $startRecord = ($page - 1) * $limit;
        //$distance=10;
        $max_lat = getMaxLatitude($lat,$lon,$distance);
        $min_lat = getMinLatitude($lat,$lon,$distance);
        if($max_lat<$min_lat){
            $tem = $max_lat;
            $max_lat = $min_lat;
            $min_lat = $tem;
        }
        $max_lon = getMaxLongitude($lat,$lon,$distance);
        $min_lon = getMinLongitude($lat,$lon,$distance);
        if($max_lon<$min_lon){
            $tem = $max_lon;
            $max_lon = $min_lon;
            $min_lon = $tem;
        }
             $limit = 100;   
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
     use_time,quantity,transport_fee,image,wish_swap,sta_comment,sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer  
      FROM ms_product Where status = 1 And deleted = 0   AND (lat BETWEEN  $min_lat  AND  $max_lat) AND (lng BETWEEN $min_lon  AND  $max_lon )  
    Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
     //echo $sql;
        $querykey =md5("KEY.getProductByDistance.".$lon.".".$lat.".".$distance.".".$page);
        $result = $meminstance->get($querykey);
        
         if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
         //   var_dump(array($min_lat,$max_lat,$min_lon,$max_lon));
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getProductFilter($cat_id,$price_from,$price_to,$lon,$lat,$distance,$order_by,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $cat_id = intval($cat_id);
        $page = $page<=0?1:$page;
        $startRecord = ($page - 1) * $limit;
        //$distance=10;
        if($distance>0){
            $max_lat = getMaxLatitude($lat,$lon,$distance);
            $min_lat = getMinLatitude($lat,$lon,$distance);
            if($max_lat<$min_lat){
                $tem = $max_lat;
                $max_lat = $min_lat;
                $min_lat = $tem;
            }
            $max_lon = getMaxLongitude($lat,$lon,$distance);
            $min_lon = getMinLongitude($lat,$lon,$distance);
            if($max_lon<$min_lon){
                $tem = $max_lon;
                $max_lon = $min_lon;
                $min_lon = $tem;
        }}
        $limit = 100;   
        if($order_by==1) $order = " Order By price ASC ";
        else if($order_by==2) $order = " Order By price DESC ";
        else $order = " Order By id DESC ";
        
        if(empty($price_to))$price_to= 1000000000;
        if(empty($price_from))$price_from= 0;
        
        $sqlCate ="";
        if($cat_id>0) $sqlCate = " And (cate_id = $cat_id OR cate_parent_id = $cat_id)";
        if($distance>0)
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
     use_time,quantity,transport_fee,image,wish_swap,sta_comment,sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer   
    FROM ms_product Where status = 1 And deleted = 0  ".$sqlCate." AND (lat BETWEEN  $min_lat  AND  $max_lat) AND (lng BETWEEN $min_lon  AND  $max_lon )  And (price BETWEEN $price_from AND $price_to)
    ".$order." LIMIT " . $startRecord . ", " . $limit; 
       else 
       $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
     use_time,quantity,transport_fee,image,wish_swap,sta_comment,sta_like,sta_view,lat,lng,create_date,create_user ,type_sell,offer  
    FROM ms_product Where status = 1 And deleted = 0  ".$sqlCate."  And (price BETWEEN $price_from AND $price_to)".$order." LIMIT " . $startRecord . ", " . $limit; 
   
        $querykey =md5("KEY.getProductFilter.".$sql);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
         //   var_dump(array($min_lat,$max_lat,$min_lon,$max_lon));
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             
             $sl = countProductFilter($cat_id,$price_from,$price_to,$lon,$lat,$distance);
             $arrOut = array();
             $arrOut["product"] = $arrPro;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
             
             return $arrOut;  
        }else{
             $sl = countProductFilter($cat_id,$price_from,$price_to,$lon,$lat,$distance);
             $arrOut = array();
             $arrOut["product"] = $result;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
            return $arrOut;
        } 
           
    } 
    
    
    function countProductFilter($cat_id,$price_from,$price_to,$lon,$lat,$distance)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $cat_id = intval($cat_id);
        //$distance=10;
        $max_lat = getMaxLatitude($lat,$lon,$distance);
        $min_lat = getMinLatitude($lat,$lon,$distance);
        if($max_lat<$min_lat){
            $tem = $max_lat;
            $max_lat = $min_lat;
            $min_lat = $tem;
        }
        $max_lon = getMaxLongitude($lat,$lon,$distance);
        $min_lon = getMinLongitude($lat,$lon,$distance);
        if($max_lon<$min_lon){
            $tem = $max_lon;
            $max_lon = $min_lon;
            $min_lon = $tem;
        }
        
        $sql = "SELECT  count(*) as sl
    FROM ms_product Where status = 1 And deleted = 0  And (cate_id = $cat_id OR cate_parent_id = $cat_id) AND (lat BETWEEN  $min_lat  AND  $max_lat) AND (lng BETWEEN $min_lon  AND  $max_lon ) And (price BETWEEN $price_from AND $price_to) ";
     //echo $sql;
        $querykey =md5("KEY.countProductFilter.".$sql);
        $result = $meminstance->get($querykey);
        
         if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $sl = 0;
            $i = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
               
            } 
           
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else{
            return $result;
        } 
           
    }    
    
    function countProductBySQL($sql)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
       
        $querykey =md5("KEY.countProductBySQL.".$sql);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $sl = 0;
            $i = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
               
            } 
           
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getProductByDistanceFT($lon,$lat,$distanceF,$distanceT,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $startRecord = ($page - 1) * $limit;
        //$distance=10;
        $max_lat1 = getMaxLatitude($lat,$lon,$distanceF);
        $min_lat1 = getMinLatitude($lat,$lon,$distanceF);
        if($max_lat1<$min_lat1){
            $tem = $max_lat1;
            $max_lat1 = $min_lat1;
            $min_lat1 = $tem;
        }
        $max_lon1 = getMaxLongitude($lat,$lon,$distanceF);
        $min_lon1 = getMinLongitude($lat,$lon,$distanceF);
        if($max_lon1<$min_lon1){
            $tem = $max_lon1;
            $max_lon1 = $min_lon1;
            $min_lon1 = $tem;
        }
        //--------
        $max_lat2 = getMaxLatitude($lat,$lon,$distanceT);
        $min_lat2 = getMinLatitude($lat,$lon,$distanceT);
        if($max_lat2<$min_lat2){
            $tem = $max_lat2;
            $max_lat2 = $min_lat2;
            $min_lat2 = $tem;
        }
        
        $max_lon2 = getMaxLongitude($lat,$lon,$distanceT);
        $min_lon2 = getMinLongitude($lat,$lon,$distanceT);
        if($max_lon2<$min_lon2){
            $tem = $max_lon2;
            $max_lon2 = $min_lon2;
            $min_lon2 = $tem;
        }
             $limit = 100;   
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
     use_time,quantity,transport_fee,image,wish_swap,sta_comment,sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer  
    FROM ms_product Where status = 1  And deleted = 0  AND ((((lat BETWEEN  $min_lat2  AND  $min_lat1 ) 
    OR (lat BETWEEN  $max_lat1  AND  $max_lat2 )) AND (lng BETWEEN $min_lon2  AND  $max_lon2 )) 
    OR (((lng BETWEEN  $min_lon2  AND  $min_lon1 ) 
    OR (lng BETWEEN  $max_lon1  AND  $max_lon2 )) AND (lat BETWEEN $min_lat2  AND  $max_lat2 )))
    Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
    
    $querykey =md5("KEY.getProductByDistanceFT.".$lon.".".$lat.".".$distanceF.".".$distanceT.".".$page);
    $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
         //   var_dump(array($min_lat,$max_lat,$min_lon,$max_lon));
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
     function getProductByDistanceFTNew($lon,$lat,$distanceF,$distanceT,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $startRecord = ($page - 1) * $limit;
        //$distance=10;
        $max_lat1 = getMaxLatitude($lat,$lon,$distanceF);
        $min_lat1 = getMinLatitude($lat,$lon,$distanceF);
        if($max_lat1<$min_lat1){
            $tem = $max_lat1;
            $max_lat1 = $min_lat1;
            $min_lat1 = $tem;
        }
        $max_lon1 = getMaxLongitude($lat,$lon,$distanceF);
        $min_lon1 = getMinLongitude($lat,$lon,$distanceF);
        if($max_lon1<$min_lon1){
            $tem = $max_lon1;
            $max_lon1 = $min_lon1;
            $min_lon1 = $tem;
        }
        //--------
        $max_lat2 = getMaxLatitude($lat,$lon,$distanceT);
        $min_lat2 = getMinLatitude($lat,$lon,$distanceT);
        if($max_lat2<$min_lat2){
            $tem = $max_lat2;
            $max_lat2 = $min_lat2;
            $min_lat2 = $tem;
        }
        
        $max_lon2 = getMaxLongitude($lat,$lon,$distanceT);
        $min_lon2 = getMinLongitude($lat,$lon,$distanceT);
        if($max_lon2<$min_lon2){
            $tem = $max_lon2;
            $max_lon2 = $min_lon2;
            $min_lon2 = $tem;
        }
             $limit = 100;   
    $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
     use_time,quantity,transport_fee,image,wish_swap,sta_comment,sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer  
    FROM ms_product Where status = 1  And deleted = 0  AND ((((lat BETWEEN  $min_lat2  AND  $min_lat1 ) 
    OR (lat BETWEEN  $max_lat1  AND  $max_lat2 )) AND (lng BETWEEN $min_lon2  AND  $max_lon2 )) 
    OR (((lng BETWEEN  $min_lon2  AND  $min_lon1 ) 
    OR (lng BETWEEN  $max_lon1  AND  $max_lon2 )) AND (lat BETWEEN $min_lat2  AND  $max_lat2 )))
    Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
    
    $sqlCount =" SELECT  count(*) as sl FROM ms_product Where status = 1  And deleted = 0  AND ((((lat BETWEEN  $min_lat2  AND  $min_lat1 ) 
    OR (lat BETWEEN  $max_lat1  AND  $max_lat2 )) AND (lng BETWEEN $min_lon2  AND  $max_lon2 )) 
    OR (((lng BETWEEN  $min_lon2  AND  $min_lon1 ) 
    OR (lng BETWEEN  $max_lon1  AND  $max_lon2 )) AND (lat BETWEEN $min_lat2  AND  $max_lat2 ))) ";
    
    $querykey =md5("KEY.getProductByDistanceFTNew.".$lon.".".$lat.".".$distanceF.".".$distanceT.".".$page);
    $result = $meminstance->get($querykey);
        
    if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
         //   var_dump(array($min_lat,$max_lat,$min_lon,$max_lon));
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             
             $sl = countProductBySQL($sqlCount);
             $arrOut = array();
             $arrOut["product"] = $arrPro;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
             
             return $arrOut;  
        }else{
           $sl = countProductBySQL($sqlCount);   
            $arrOut = array();
            $arrOut["product"] = $result;
            $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
            return $arrOut;
        } 
           
    } 
    
    
    function countProductByCate($cate_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $cate_id = intval($cate_id);
        
        $sql = "SELECT  count(*) as sl FROM ms_product Where status = 1  And deleted = 0  And (cate_id = ? OR cate_parent_id = ?) ";
        $querykey = md5("KEY.countProductByCate." .$cate_id);
       
        $sl = $meminstance->get($querykey);
        
         //if(1>0){
         if (!$sl) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($cate_id,$cate_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
            } 
           
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else{
            return intval($sl);
        } 
    }  
    
    
    function getProductDetail($product_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $product_id = intval($product_id);
        
        $sql = "SELECT  id,title,cate_parent_id,cate_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,status,weight,length,width,height,
    address,province_code,city_code,type_sell,offer  FROM ms_product Where  id = ? "; 
        $querykey =md5("KEY.getProductDetail." .$product_id);
        $result = $meminstance->get($querykey);
       
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
          
            if($row = $q->fetch()) {
                 $arrPro =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro['image'] =   $arrImage;  
                 }  
                
            } 
          
          if(!empty($arrPro)){
             $cate1 = getCateDetail($arrPro['cate_id'] );
             $cate0 = getCateDetail($arrPro['cate_parent_id'] );
             
             if(!empty($cate1))
             $arrPro['cate_name']=$cate1["name"]; else $arrPro['cate_name']="";
             if(!empty($cate0))
             $arrPro['cate_root_name']=$cate0["name"]; else $arrPro['cate_root_name']="";
          }

         $meminstance->set($querykey, $arrPro, 0, TIME_30);
         $connect = null;
         return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    function getTransactionByProductOnProductDetail($buyer_id,$product_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $product_id = intval($product_id);
        
        $transactionIDs = getTransactionIDByProduct($product_id);
        $arrTransaction = array();
        
        if(empty($transactionIDs)) return $arrTransaction;
        
        $sql = "SELECT id,seller_id,buyer_id,address_seller,address_buyer,transaction_type,pay_type,STATUS,product_id,fee_product,fee_transport_seller,fee_transport_buyer,transport_seller_by,transport_buyer_by,discount,fee_total,promotion_code,create_date
         FROM ms_transaction Where id IN (".$transactionIDs.") And ((seller_id= ".$buyer_id.") OR (buyer_id = ".$buyer_id."  )) AND status  = 1 ORDER BY id DESC"; 
       // echo $sql;
        $querykey =md5("KEY.".$sql);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrTransaction = array();
            $i=0;
            while($row = $q->fetch()) {
                $arrTransaction[$i] =  $row;
                $i++;
            } 
         
         $meminstance->set($querykey, $arrTransaction, 0, TIME_15);
         $connect = null;
         return $arrTransaction;  
        }else{
            return $result;
        } 
           
    } 
    
     function getTransactionByProductAndBuyer($buyer_id,$product_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $product_id = intval($product_id);
        
        $transactionIDs = getTransactionIDByProduct($product_id);
        $arrTransaction = array();
        
        if(empty($transactionIDs)) return $arrTransaction;
        
        $sql = "SELECT id,seller_id,buyer_id,address_seller,address_buyer,transaction_type,pay_type,STATUS,product_id,fee_product,fee_transport_seller,fee_transport_buyer,transport_seller_by,transport_buyer_by,discount,fee_total,promotion_code,create_date
         FROM ms_transaction Where id IN (".$transactionIDs.") And (buyer_id = ".$buyer_id."  ) AND status  = 1 ORDER BY id DESC"; 
        //echo $sql;
        $querykey =md5("KEY." .$sql);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrTransaction = array();
            $i=0;
            while($row = $q->fetch()) {
                $arrTransaction[$i] =  $row;
                $i++;
            } 
         
         $meminstance->set($querykey, $arrTransaction, 0, TIME_15);
         $connect = null;
         return $arrTransaction;  
        }else{
            return $result;
        } 
           
    } 
    
    
     function getProductFormUserFollowing($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $startRecord = ($page - 1) * $limit;
        
        $strUserID = getIDUserFollowing($user_id);
        if(empty($strUserID)) {
            $arrPro = array();
            return $arrPro;
        }
        $sql = "SELECT  id,title,cate_id,cate_parent_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer FROM ms_product Where status = 1 And user_id in (".$strUserID.") Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
        $querykey =md5("KEY.getProductFormUserFollowing." .$user_id.".".$page);
        $result = $meminstance->get($querykey);
      
       if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=  baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $user = getUserShopById($row["user_id"]);
                 $arrPro[$i]['create_user'] = $user["fullname"];
                 $arrPro[$i]['avatar_url'] = $user["avatar_url"];
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    }
    
  
    function getCateDetail($cate_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $cate_id = intval($cate_id);
        
        $sql = "SELECT  id,parent_id,name,icon,type_cate,status,create_date FROM ms_category WHERE id = ? "; 
        $querykey =md5("KEY.getCateDetail." .$cate_id);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($cate_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
          
            if($row = $q->fetch()) {
                 $arrPro =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 $arrPro["icon"]=   baseUrlUpload()."shop/category/".$time."/".$row["icon"];
            } 
             $meminstance->set($querykey, $arrPro, 0, TIME_12h);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getUserShop($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT  id,sso_id,username,fullname,avatar_url,email,mobile,mobile_view,birthday,sex,address, 
    lat,lng,sta_product,sta_comment_positive,sta_comment_neutral,sta_comment_negative,verify_mobile,verify_email FROM ms_user WHERE id = ? "; 
        $querykey =md5("KEY.getUserShop." .$user_id);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrUser = null;
            $i = 0;    
            if($row = $q->fetch()) {
                 $arrUser =  $row;
            } 
           
             $meminstance->set($querykey, $arrUser, 0, TIME_30);
             $connect = null;
             return $arrUser;  
        }else{
            return $result;
        } 
           
    } 
    
    function getProductComment($product_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $product_id = intval($product_id);
        $startRecord = ($page - 1) * $limit;
        
        $sql = "SELECT  c.id,c.user_id,c.product_id,c.comment,u.fullname,u.avatar_url,c.create_date 
        FROM ms_product_comment c INNER JOIN ms_user u ON c.user_id = u.id WHERE c.product_id = ? Order By c.id DESC LIMIT " . $startRecord . ", " . $limit; 
        
        $querykey =md5("KEY.getProductComment." .$product_id.".".$page);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrComment = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrComment[$i] =  $row;
                 $i++;
            } 
             $meminstance->set($querykey, $arrComment, 0, TIME_15);
             $connect = null;
             return $arrComment;  
        }else{
            return $result;
        } 
           
    } 
    
    function countCommentProduct($product_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $product_id = intval($product_id);
        
        $sql = "SELECT COUNT(*) AS sl FROM ms_product_comment  WHERE product_id = ?";
        $querykey = md5("KEY.countCommentProduct." .$product_id);
        $sl = $meminstance->get($querykey);
        
        if (!$sl) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($product_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
                   
            } 
           
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else{
            return intval($sl);
        } 
    } 
    
     function postProduct($title,$cate_id,$cate_parent_id,$user_id,$description,$price_sell,$use_status,$use_time,$quantity,$image,$wish_swap,$lat,$lng,$status,$create_user,$weight,$lenght,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize)
    {   
        $lastId = 0;
        try {
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_product (title,cate_id,cate_parent_id,user_id,description,price
            ,use_status,use_time,quantity,image,wish_swap 
        ,lat,lng,STATUS,create_date,update_date,create_user,update_user,weight,LENGTH,width,height,
        address,province_code,city_code,type_sell,image_size,offer)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?,?,?,?,?,?,?,?,?,?,?);";
           
            $offer="";
            $create_user = cleanQuery($create_user);
            $title = cleanQuery($title);
            $description = cleanQuery($description);
            
            if($cate_parent_id==72)   $price_sell  = 0;
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($title,$cate_id,$cate_parent_id,$user_id,$description,$price_sell,$use_status,$use_time,$quantity,$image,$wish_swap,$lat,$lng,$status,$create_user,$create_user,$weight,$lenght,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize,$offer);
            $count = $q->execute($arrV);
            $lastId = $connect->lastInsertId();
            $connect = null;
            
            deleteCacheProductOfUser($user_id);
            $querykey =md5("KEY.getProductSwap." .$user_id); 
            deleteCacheByKey($querykey);
            
            $querykey =md5("KEY.getProductSwapOfUser." .$user_id); 
            deleteCacheByKey($querykey);
            
         } catch (Exception $e) {
             //echo 'Caught exception: ',  $e->getMessage(), "\n";
             $lastId = 0;
        }
        return $lastId;   
    }
    
    function updateProduct($id,$title,$cate_id,$description,$price_sell,$use_status,$use_time,$quantity,$image,$wish_swap,$lat,$lng,$status,$create_user,$weight,$lenght,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize)
    {   
        try {
            $connect = connectDBShop();
            $sql = "Update  ms_product SET title=?,cate_id=?,description=?,price=?
            ,use_status=?,use_time=?,image=?,wish_swap=? 
        ,lat=?,lng=?,STATUS=?,update_date=NOW(),update_user=?,weight=?,LENGTH=?,width=?,height=?,address=?,province_code=?,city_code=?
        ,type_sell=?,image_size=?,cate_parent_id=? Where id = ? ";
            
            $create_user = cleanQuery($create_user);
            $title = cleanQuery($title);
            $description = cleanQuery($description);  
            
            $cateDetail = getCateDetail($cate_id);
            $cate_parent_id =   $cateDetail["parent_id"];
            if($cate_parent_id==72)   $price_sell  = 0;
             
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($title,$cate_id,$description,$price_sell,$use_status,$use_time,$image,$wish_swap,$lat,$lng,$status,$create_user
            ,$weight,$lenght,$width,$height,$address,$province_code,$city_code,$type_sell,$jsonImageSize,$cate_parent_id,$id);
            $count = $q->execute($arrV);
           
            $connect = null;
            $product = getProductDetail($id);  
            deleteCacheProductOfUser($product["user_id"]);
            $querykey =md5("KEY.getProductSwap." .$product["user_id"]); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductDetail." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductByID." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductSwapOfUser." .$product["user_id"]); 
            deleteCacheByKey($querykey);
            
         } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
             $count = 0;
        }
        return $count;   
    } 
    
    function updateTagSwapProduct($id,$wish_swap)
    {   
        try {
            $connect = connectDBShop();
            $sql = "Update  ms_product SET wish_swap= ?,update_date=NOW()  Where id = ? ";
            $wish_swap = cleanQuery($wish_swap);
            
            
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($wish_swap,$id);
            $count = $q->execute($arrV);
           
            $connect = null;
            $product = getProductDetail($id);
            deleteCacheProductOfUser($product["user_id"]);
            $querykey =md5("KEY.getProductSwap." .$product["user_id"]); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductDetail." .$id); 
            deleteCacheByKey($querykey);  
            $querykey =md5("KEY.getProductByID." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductSwapOfUser." .$product["user_id"]); 
            deleteCacheByKey($querykey);
         } catch (Exception $e) {
             $count = 0;
        }
        return $count;   
    } 
    
    function updateQuantityProduct($id,$quantity)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = " Update  ms_product SET quantity = ?,update_date=NOW()  Where id = ? ";
            
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($quantity,$id);
            $count = $q->execute($arrV);
           
            $connect = null;
            $product = getProductDetail($id);
            deleteCacheProductOfUser($product["user_id"]);
            $querykey =md5("KEY.getProductSwap." .$product["user_id"]); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductDetail." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductByID." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductSwapOfUser." .$product["user_id"]); 
            deleteCacheByKey($querykey);
         } catch (Exception $e) {
             $count = 0;
        }
        return $count;   
    } 
    
     function insertProductFavorite($user_id,$product_id)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_product_favorite (user_id, product_id, create_date)
    VALUES(?,?,NOW());";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$product_id);
            $count = $q->execute($arrV);
            $connect = null;
            deleteCacheProductFavorite($user_id) ;
         } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
             $count = 0;
        }
        return $count;   
    } 
    
    
     function deleteProductFavorite($user_id,$product_id)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = "DELETE FROM ms_product_favorite WHERE user_id=? AND product_id = ?";
            
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$product_id);
            $count = $q->execute($arrV);
            $connect = null;
            deleteCacheProductFavorite($user_id) ;   
         } catch (Exception $e) {
             $count = 0;
        }
        return $count;   
    } 
    
    function insertUserFollow($user_id,$user_following_id)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_user_following (user_id, user_following_id, create_date)
    VALUES(?,?,NOW());";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_following_id);
            $count = $q->execute($arrV);
            $connect = null;
            deleteCacheUserFollowing($user_id);
            deleteCacheUserFollower($user_following_id);
         } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
             $count = 0;
        }
        return $count;   
    } 
    
     function insertProductComment($user_id,$product_id,$comment,$create_user)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_product_comment (user_id,product_id,COMMENT,create_date,create_user)
    VALUES(?,?,?,NOW(),?);";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$product_id,$comment,$create_user);
            $count = $q->execute($arrV);
            $connect = null;
            deleteCacheCommentProduct($product_id);
         } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
             $count = 0;
        }
        return $count;   
    } 
    
    function deleteUserFollow($user_id,$user_following_id)
    {   
        $count = 0;
        try {
            $connect = connectDBShop();
            $sql = "DELETE FROM ms_user_following Where user_id=? AND user_following_id= ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_following_id);
            $count = $q->execute($arrV);
            $connect = null;
            deleteCacheUserFollowing($user_id);
            deleteCacheUserFollower($user_following_id);
         } catch (Exception $e) {
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
             $count = 0;
        }
        return $count;   
    } 
    
    
    function uploadImageProduct($user_id,$product_id){
         $uploaddir = '/upload/shop/product/';
         $arrKQ = array();
         $image="";
         
         try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error']||empty($user_id))
            ) {
                //throw new RuntimeException('Invalid parameters.');
               // throw new RuntimeException('1.');
                $arrKQ["result"]=1;
                $arrKQ["image"]=$image;
                return $arrKQ;
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //throw new RuntimeException('No file sent.');
                    $arrKQ["result"]=2;
                    $arrKQ["image"]=$image;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    //throw new RuntimeException('Exceeded filesize limit.');
                    $arrKQ["result"]=3;
                    $arrKQ["image"]=$image;
                default:
                    //throw new RuntimeException('Unknown errors.');
                    $arrKQ["result"]=100;
                    $arrKQ["image"]=$image;
            }

            // You should also check filesize here. 
            if ($_FILES['upfile']['size'] > 10000000) {
                $arrKQ["result"]=3;
                $arrKQ["image"]=$image;
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
                $arrKQ["result"]=5;
                $arrKQ["image"]=$image;
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
             $pathdate = date("Y/md/");
             $file = basename($_FILES['upfile']['name']);
             $file = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $file);
             $file = time().rand(1,1000)."-".$user_id.".".$ext;
             $file = sanitize($file,true);
             
             if($product_id>0){
                 $product = getProductDetail($product_id);
                 $pathdate =    date("Y/md/",strtotime($product['create_date']));
               
             }
             
             $pathUrl= $uploaddir.$pathdate;
             $uploaddir = $_SERVER['DOCUMENT_ROOT'].$uploaddir.$pathdate;
             makeFolder($uploaddir);
             $uploadfile =$uploaddir . $file;
          
             if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile)) {
                //throw new RuntimeException('Failed to move uploaded file.');
                $arrKQ["result"]=4;
                $arrKQ["image"]=$image;
                
            }else{
                $image=$file;
            }
           
            $arrKQ["result"]=0;
            $arrKQ["image"]=$image;
            
        } catch (RuntimeException $e) {
            $arrKQ["result"]=100;
            $arrKQ["image"]=$image;
        }
        return $arrKQ;   
    }
    
    
    function uploadImageProductCP($user_id,$product_id){
         $uploaddir = '/upload/shop/product/';
         $arrKQ = array();
         $image="";
         
         try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error']||empty($user_id))
            ) {
                //throw new RuntimeException('Invalid parameters.');
               // throw new RuntimeException('1.');
                $arrKQ["result"]=1;
                $arrKQ["image"]=$image;
                return $arrKQ;
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //throw new RuntimeException('No file sent.');
                    $arrKQ["result"]=2;
                    $arrKQ["image"]=$image;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    //throw new RuntimeException('Exceeded filesize limit.');
                    $arrKQ["result"]=3;
                    $arrKQ["image"]=$image;
                default:
                    //throw new RuntimeException('Unknown errors.');
                    $arrKQ["result"]=100;
                    $arrKQ["image"]=$image;
            }

            // You should also check filesize here. 
            if ($_FILES['upfile']['size'] > 10000000) {
                $arrKQ["result"]=3;
                $arrKQ["image"]=$image;
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
                $arrKQ["result"]=5;
                $arrKQ["image"]=$image;
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
             $pathdate = date("Y/md/");
             $file = basename($_FILES['upfile']['name']);
             $file = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $file);
             $file = time()."-".$user_id.".".$ext;
             $file = sanitize($file,true);
             
             if($product_id>0){
                 $product = getProductDetail($product_id);
                 $pathdate =    date("Y/md/",strtotime($product['create_date']));
               
             }
             
             $pathUrl= $uploaddir.$pathdate;
             $uploaddir = $_SERVER['DOCUMENT_ROOT'].$uploaddir.$pathdate;
             makeFolder($uploaddir);
             $uploadfile =$uploaddir . $file;
          
             if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile)) {
                //throw new RuntimeException('Failed to move uploaded file.');
                $arrKQ["result"]=4;
                $arrKQ["image"]=$image;
                
            }else{
                $image=baseUrl().'upload/shop/product/'.$pathdate.$file;
            }
           
            $arrKQ["result"]=0;
            $arrKQ["image"]=$image;
            
        } catch (RuntimeException $e) {
            $arrKQ["result"]=100;
            $arrKQ["image"]=$image;
        }
        return $arrKQ;   
    }
    
    
     function getAppHeaderShop($app_header,$app_client_id,$os_version,$imei){
       $app_header = mysql_escape_string($app_header);
       $app_client_id = mysql_escape_string($app_client_id);
       $os_version = mysql_escape_string($os_version);
       $imei = mysql_escape_string(trim($imei));
       
       $arrKq = array();
       //get app header config 
       $arrAppHeader =  checkAppHeaderShop($app_header);
       
       if(empty($arrAppHeader)) return "";
       
       $arrKq["app_header"] = $arrAppHeader;  
       $app_header_id =  $arrAppHeader["id"];
       $os =    $arrAppHeader["os"];     
       // check by app_client_id
       $checkByAppClientID = 0;
       $checkByImei = 0;
       
       if(!empty($app_client_id)&&intval($app_client_id)>0){
           $app_client_id = checkAppClientIdShopExist($app_client_id);
       }
       
       if(!empty($imei)&&intval($app_client_id)== 0){
           $app_client_id = checkImeiShopExist($imei);
       }
       
       if($app_client_id==0){
           $app_client_id = createAppClientIdShop($app_header_id,$arrAppHeader["os"],$os_version,$imei);
          
       }
       
       $arrKq["app_client_id"] = $app_client_id;
       $arrKq["cat"] = getCategoryAndGroup(); 
       $arrKq["event"] = getEventTop(); 
       
       return    $arrKq;
   }
   
   
    function checkAppHeaderShop($app_header)
    {
        $app_header= cleanQuery($app_header);
        $sql = "SELECT id,app_header,type_payment,os,isFree,version,link_update,sms,admob_id,chat_server,chat_port FROM ms_app_header  WHERE app_header = ?" ;
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($app_header));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrAppHeader = array();   
        if($row = $q->fetch()) {
             $arrAppHeader =  $row;
        } 
         $q = NULL;
        $connect = NULL;
        return $arrAppHeader;
    } 
    
     function getAppHeaderShopBuyID($id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $id= intval($id);
        $sql = "SELECT id,app_header,type_payment,os,isFree,VERSION,link_update,sms,admob_id FROM ms_app_header  WHERE id = ?" ;
        
        $querykey =md5("KEY.getAppHeaderShopBuyID.".$id);
        $result = $meminstance->get($querykey);
         
         if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $arrAppHeader = array();   
            if($row = $q->fetch()) {
                 $arrAppHeader =  $row;
            } 
             $q = NULL;
            $connect = NULL;
            return $arrAppHeader;
         }else{
            return $result;   
        }
        
    }  
     
    
    function getAppClientIdShop($app_client_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $app_client_id= cleanQuery($app_client_id);
        $sql = "SELECT * FROM ms_app_client  WHERE id= ? ";
        
        $querykey =md5("KEY.getAppClientIdShop.".$app_client_id);
        $result = $meminstance->get($querykey);
       
        if(!$result){
             $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $q->execute(array($app_client_id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $i=0; 
            $appClient = null;
            if($row = $q->fetch()) {
                $appClient = $row;
                 $i++;
            }
            $q = NULL;
            $connect = NULL;
            return $appClient;
        }else{
            return $result;   
        }
       
    }  
    
    function checkAppClientIdShopExist($app_client_id)
    {
        $app_client_id= cleanQuery($app_client_id);
        $sql = "SELECT * FROM ms_app_client  WHERE id= ? ";
        $connect = connectDBShop(); 
        $q = $connect->prepare($sql);
        $q->execute(array($app_client_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $i=0; $kq=0; 
        if($row = $q->fetch()) {
             $kq =  $row["id"];
             $i++;
        }
       
        $q = NULL;
        $connect = NULL;
        return $kq;
    }  
    
    function checkImeiShopExist($imei)
    {
        $imei= cleanQuery($imei);
        $sql = "SELECT * FROM ms_app_client  WHERE imei= ? ";
        $connect = connectDBShop(); 
        $q = $connect->prepare($sql);
        $q->execute(array($imei));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $i=0; $kq=0; 
        if($row = $q->fetch()) {
             $kq =  $row["id"];
             $i++;
        }
        
        $q = NULL;
        $connect = NULL;
        return $kq;
    } 
    
    
    function createAppClientIdShop($app_header_id,$os,$os_version,$imei){
      
      $connect = connectDBShop(); 
      $insertId = 0;
       if(empty($imei)){
            $sql = "INSERT INTO ms_app_client (os,os_version,app_header_id) VALUES (?,?,?);";
            $q = $connect->prepare($sql);
            $arrV = array($os,$os_version,$app_header_id);
            $count = $q->execute($arrV);
            $insertId = $connect->lastInsertId();
       }else{
           $sql = "INSERT INTO ms_app_client (os,os_version,app_header_id,imei) VALUES (?,?,?,?);";
           $q = $connect->prepare($sql);
           $arrV = array($os,$os_version,$app_header_id,$imei);
           $count = $q->execute($arrV);
           $insertId = $connect->lastInsertId();
       }
        $q = NULL;
        $connect = null;
        return $insertId;
   }
   
   function getUserShopByEmail($email)
    {
       $meminstance = new Memcache();
       $meminstance->pconnect(SERVER_CACHE_IP, 11211);
       $querykey = md5("KEY.getUserShopByEmail." .$email);
       $arrUser = $meminstance->get($querykey);
       
       if(!($arrUser)){
            $sql ="SELECT id,sso_id,username,fullname,avatar_url,email,mobile,birthday,sex, 
        address,verify_mobile,verify_email,lat,lng,sta_product,sta_comment_positive, 
        sta_comment_neutral,sta_comment_negative,create_user,create_date FROM ms_user WHERE email=? ";
            # creating the statement
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $q->execute(array($email));
            $q->setFetchMode(PDO::FETCH_ASSOC); 
            # showing the results
            $arrUser = array();   
            $i=0;  
            if($row = $q->fetch()) {
                 $arrUser =  $row;
                 $i++;
            }
           
            $q = NULL;
            $connect = NULL;
        }
        $meminstance = NULL;
        return $arrUser;
           
    }
    
    function getUserShopBySSOID($sso_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $querykey = md5("KEY.getUserShopBySSOID." .$sso_id);
        $arrUser = $meminstance->get($querykey);
        
         if(!($arrUser)){
            $sql ="SELECT id,sso_id,username,fullname,avatar_url,email,mobile,birthday,sex, 
    address,verify_mobile,verify_email,lat,lng,sta_product,sta_comment_positive, 
    sta_comment_neutral,sta_comment_negative,create_user,create_date FROM ms_user WHERE sso_id= ? ";
            # creating the statement
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $q->execute(array($sso_id));
            $q->setFetchMode(PDO::FETCH_ASSOC); 
             
            # showing the results
            $arrUser = array();   
            $i=0;  
            if($row = $q->fetch()) {
                 $arrUser =  $row;
                 $i++;
            }
            $q = NULL;
            $connect = NULL;
        }
        $meminstance = NULL;
        return $arrUser;
           
    }
    
    function getUserShopById($id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $id= intval($id);
        
        $sql = "SELECT id,app_client_id, sso_id,email,username, fullname,mobile, avatar_url, mobile_view, birthday, 
    sex, address, city, country, STATUS, verify_mobile, verify_email,lat, lng, sta_product, sta_comment_positive, sta_comment_neutral, sta_comment_negative, 
    sta_following, sta_follower, create_user, create_date, modify_user, modify_date FROM ms_user   WHERE id = ? " ;
        $querykey = md5("KEY.getUserShopById." .$id);
        $arrUser = $meminstance->get($querykey);
          
        if(!($arrUser)){
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $q->execute(array($id));
            $q->setFetchMode(PDO::FETCH_ASSOC); 
            # showing the results
            $arrUser = array();   
            if($row = $q->fetch()) {
                 $arrUser =  $row;
            }
            $meminstance->set($querykey, $arrUser, 0, TIME_12h);
            $q = NULL;
            $connect = NULL;
        }
        $meminstance = NULL;
        return $arrUser;
    }  
    
    function getUserShopByIdOther($id,$user_f_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $id= intval($id);
        
        $sql = "Select id,sso_id,username,fullname,avatar_url,email,mobile,mobile_view,birthday,sex,city,country, 
    address,verify_mobile,verify_email,lat,lng,sta_product,sta_comment_positive, 
    sta_comment_neutral,sta_comment_negative,sta_following,sta_follower,create_user,create_date FROM ms_user  WHERE id = ? " ;
        $querykey = md5("KEY.getUserShopByIdOther.".$id.".".$user_f_id);
        $arrUser = $meminstance->get($querykey);
       
        if(!($arrUser)){
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $q->execute(array($user_f_id));
            $q->setFetchMode(PDO::FETCH_ASSOC); 
            # showing the results
            $arrUser = array();   
            if($row = $q->fetch()) {
                 $arrUser =  $row;
                 $arrUser["isFollowing"] = checkHasFollowing($id,$user_f_id);  
            }
            $q = NULL;
            $connect = NULL;
        }
        $meminstance = NULL;
        return $arrUser;
    }   
    
       
    function registerMemberShop($app_client_id,$fullname,$sex,$birthday,$email,$mobile,$sso_id,$lat,$lng){
        $insertId = 0;
        try{
            // init user info
            $avatar=baseUrlUpload()."audio/avatar_d.png";
            $username = "shop".$app_client_id.substr(time(),-3);
            $PASSWORD=md5(md5(time()));
            
            $email = cleanQuery($email);
            $mobile = cleanQuery($mobile);
            $birthday = cleanQuery($birthday);
            
             $fMobile = "";
             $vMobile = "";
             if(!empty($mobile))
            {
                $fMobile = ",mobile";
                $vMobile = ",'".$mobile."'";
            }
            
            $fBirthday = "";
             $vBirthday = "";
            if(!IsNullOrEmptyString($birthday))
            {
                $fBirthday = ",birthday";
                $vBirthday = ",'".$birthday."'";
            }
            
            
            $fEmail = "";
            $vEmail = "";
             if(!IsNullOrEmptyString($email))
            {
                $fEmail = ",email";
                $vEmail = ",'".$email."'";
            }
            
            $fSex = "";
            $vSex = "";
             if(!IsNullOrEmptyString($sex))
            {
                $fSex = ",sex";
                $vSex = ",'".$sex."'";
            }
            
            $sql = "INSERT INTO ms_user (app_client_id, username, PASSWORD, fullname, avatar_url".$fEmail.",sso_id,create_date,create_user
            ".$fMobile.$fBirthday.$fSex.",modify_user,modify_date,lat,lng)VALUES(?,?,?,?,?".$vEmail.",?,NOW(),?".$vMobile.$vBirthday.$vSex.",?,NOW(),?,?)";
             //  echo $sql;
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($app_client_id,$username,$PASSWORD,$fullname,$avatar,
            $sso_id,$fullname,$fullname,$lat,$lng);
          
            $count = $q->execute($arrV);
            $insertId = $connect->lastInsertId();
            
            $q = NULL;
            $connect = null;
            
        }catch (Exception $e) {
           // echo 'Message: ' .$e->getMessage();
            $insertId = 0;
        }
        return $insertId;  
    }
    
    function uploadUserShopInfo($user_id,$fullname,$birthday,$city,$country,$address){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  fullname=?,birthday=?,city=?,country=?,address=?,modify_user=?,modify_date=NOW() Where id = ? ";
            $arrV = array($fullname,$birthday,$city,$country,$address,$fullname,$user_id);
            
            if(IsNullOrEmptyString($birthday))
            {
                $arrV = array($fullname,$city,$country,$address,$fullname,$user_id);
            }
            
            
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            
            $q = NULL;
            $connect = null;
            $userInfo=getUserShopById($user_id);
            $querykey = md5("KEY.getUserShopByEmail." .$userInfo["email"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopBySSOID." .$userInfo["sso_id"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopById." .$user_id); 
            deleteCacheByKey($querykey);
        }catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $kq=0;
        }
        return $kq;  
    }
    
    function updateAvatarUserShop($user_id,$avatar){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  avatar_url=?,modify_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($avatar,$user_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
            $userInfo=getUserShopById($user_id);
            $querykey = md5("KEY.getUserShopByEmail." .$userInfo["email"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopBySSOID." .$userInfo["sso_id"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopById." .$user_id); 
            deleteCacheByKey($querykey);
            
        }catch (Exception $e) {
           // echo 'Message: ' .$e->getMessage();
           $kq=0;
        }
        return $kq;  
    }
    
    
    function updateStaticCommentProduct($product_id){
        $kq = 0;
        try{
            $sql = "Update  ms_product SET sta_comment=(Select count(id) From ms_product_comment Where product_id = ? ) , update_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($product_id,$product_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
        }catch (Exception $e) {
           // echo 'Message: ' .$e->getMessage();
           $kq=0;
        }
        return $kq;  
    }
    
    function updateStaticLikeProduct($product_id){
        $kq = 0;
        try{
            $sql = "Update  ms_product SET sta_like=(Select count(id) From ms_product_favorite Where product_id = ? ) , update_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($product_id,$product_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
        }catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $kq=0;
        }
        return $kq;  
    }
    
    
    function updateStaticUserFollowing($user_id){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  sta_following=(Select count(id) from ms_user_following Where user_id = ? ) ,modify_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
        }catch (Exception $e) {
           // echo 'Message: ' .$e->getMessage();
           $kq=0;
        }
        return $kq;  
    }
    
    function updateStaticUserFollower($user_id){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  sta_follower=(Select count(id) from ms_user_following Where user_following_id = ? ) ,modify_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
        }catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $kq=0;
        }
        return $kq;  
    }
    
    function updateStaticProduct($user_id){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  sta_product=(Select count(id) from ms_product Where user_id = ? ) ,modify_date=NOW() Where id = ? ";
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
        }catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $kq=0;
        }
        return $kq;  
    }
    
    function updateStaticComment($user_id,$status){
        $kq = 0;
        try{
            if($status==1)
            $sql = "Update  ms_user SET  sta_comment_positive=(Select count(id) from ms_user_rate Where user_id = ? And status = 1 ) ,modify_date=NOW() Where id = ? ";
            else if($status==2)
             $sql = "Update  ms_user SET  sta_comment_neutral=(Select count(id) from ms_user_rate Where user_id = ? And status = 2 ) ,modify_date=NOW() Where id = ? ";
            else   
            $sql = "Update  ms_user SET  sta_comment_negative=(Select count(id) from ms_user_rate Where user_id = ? And status = 3 ) ,modify_date=NOW() Where id = ? ";
             
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$user_id);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
        }catch (Exception $e) {
            //echo 'Message: ' .$e->getMessage();
            $kq=0;
        }
        return $kq;  
    }
    
    
    function uploadLoadAvatarUserShop($user_id){
         $uploaddir = '/upload/shop/avatar/';
         $arrKQ = array();
         $image="";
         $userInfo = getUserShopById($user_id);
         $image =$userInfo["avatar_url"];
         
         try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($_FILES['upfile']['error']) ||
                is_array($_FILES['upfile']['error']||empty($user_id))
            ) {
                //throw new RuntimeException('Invalid parameters.');
               // throw new RuntimeException('1.');
                $arrKQ["result"]=1;
                $arrKQ["image"]=$image;
                return $arrKQ;
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    //throw new RuntimeException('No file sent.');
                    $arrKQ["result"]=2;
                    $arrKQ["image"]=$image;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    //throw new RuntimeException('Exceeded filesize limit.');
                    $arrKQ["result"]=3;
                    $arrKQ["image"]=$image;
                default:
                    //throw new RuntimeException('Unknown errors.');
                    $arrKQ["result"]=100;
                    $arrKQ["image"]=$image;
            }

            // You should also check filesize here. 
            if ($_FILES['upfile']['size'] > 10000000) {
                $arrKQ["result"]=3;
                $arrKQ["image"]=$image;
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
                $arrKQ["result"]=5;
                $arrKQ["image"]=$image;
            }

            // You should name it uniquely.
            // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
            // On this example, obtain safe unique name from its binary data.
             $pathdate = date("Y/md/");
             $file = basename($_FILES['upfile']['name']);
             $file = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $file);
             $file = time()."-".$user_id.".".$ext;
             $file = sanitize($file,true);
             $pathUrl= $uploaddir.$pathdate;
             $uploaddir = $_SERVER['DOCUMENT_ROOT'].$uploaddir.$pathdate;
             makeFolder($uploaddir);
             $uploadfile =$uploaddir . $file;
            
             if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$uploadfile)) {
                //throw new RuntimeException('Failed to move uploaded file.');
                $arrKQ["result"]=4;
                $arrKQ["image"]=$image;
                
            }else{
                $image=$file;
                $image="http://".$_SERVER['SERVER_NAME'].$pathUrl . $file;
                updateAvatarUserShop($user_id,$image);
            }
            
            $arrKQ["result"]=0;
            $arrKQ["image"]=$image;
            
        } catch (RuntimeException $e) {
            $arrKQ["result"]=100;
            $arrKQ["image"]=$image;
        }
        return $arrKQ;   
    }
    
    
    
    function getIDProductFavorite($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT product_id FROM ms_product_favorite WHERE user_id = ? "; 

        $querykey =md5("KEY.getIDProductFavorite." .$user_id);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $strUserId = "";
            $i = 0;    
            while($row = $q->fetch()) {
                 $strUserId .=  $row["product_id"].",";
                 $i++;
            } 
             $strUserId = substr($strUserId,0,strlen($strUserId)-1);
             $meminstance->set($querykey, $strUserId, 0, TIME_15);
             $connect = null;
             return $strUserId;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getProductOfUser($user_id,$page,$limit)
    {
        $limit = 30;
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $startRecord = ($page - 1) * $limit;
        
        $sql = "SELECT  id,title,cate_id,user_id,description,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer FROM ms_product Where  user_id = ? And deleted = 0 Order By id DESC LIMIT " . $startRecord . ", " . $limit; 
        $querykey =md5("KEY.getProductOfUser." .$user_id.".".$page);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $like = checkProductFavorite($row["id"],$row["user_id"]);
                 $arrPro[$i]['like'] = $like;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    }
    
     function getProductSwap($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT  id,title,cate_id,user_id,price,use_status, 
    use_time,quantity,transport_fee,image,wish_swap,sta_comment, 
    sta_like,sta_view,lat,lng,create_date,create_user,type_sell,offer FROM ms_product Where  user_id = ? And deleted = 0 And status = 1 And quantity > 0 Order By id DESC "; 
        $querykey =md5("KEY.getProductSwap." .$user_id);
        $result = $meminstance->get($querykey);
        
       if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    }
    
      function countProductByUser($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT  count(*) as sl FROM ms_product Where  user_id = ? ";
        $querykey = md5("KEY.countProductByUser." .$user_id);
       
        $sl = $meminstance->get($querykey);
        if (!$sl) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
            } 
           
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else{
            return intval($sl);
        } 
    }  
    
    function getUserFollowing($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $user_following_ids = getIDUserFollowing($user_id);
        $arr = array();   
        if(empty($user_following_ids))return $arr;
        
        $startRecord = ($page - 1) * $limit;
        $sql = "SELECT id,username,fullname, avatar_url, email, mobile, birthday,sex, address,city, 
        country FROM ms_user WHERE  status = 1 And id IN (".$user_following_ids.") ORDER BY id DESC LIMIT " . $startRecord . ", " . $limit; 
        
        $querykey = md5("KEY.getUserFollowing".".".$user_id.".".$page);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $connect = $connect->query($sql);
            # setting the fetch mode
            $connect->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();   
            $i=0;  
            while($row = $connect->fetch()) {
                 $arr[$i] =  $row;
                 $i++;
            }
            $connect = NULL;
            $meminstance->set($querykey, $arr, 0, TIME_30);
            return $arr;
            
        }else{
            return $result;
        }
           
    } 
    
    function checkHasFollowing($user_id,$user_following_id)
    {
        $user_id= cleanQuery($user_id);
        $sql = "SELECT id FROM ms_user_following  WHERE user_id= ? And user_following_id= ?";
        $connect = connectDBShop(); 
        $q = $connect->prepare($sql);
        $q->execute(array($user_id,$user_following_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $kq=0; 
        if($row = $q->fetch()) {
             $kq =  1;
             
        }
       
        $q = NULL;
        $connect = NULL;
        return $kq;
    }  
    
    
    function getUserFollower($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $user_following_ids = getIDUserFollower($user_id);
        $arr = array();   
        if(empty($user_following_ids))return $arr;
        
        $startRecord = ($page - 1) * $limit;
        $sql = "SELECT id,username,fullname, avatar_url, email, mobile, birthday,sex, address,city, 
        country FROM ms_user WHERE  status = 1 And id IN (".$user_following_ids.") ORDER BY id DESC LIMIT " . $startRecord . ", " . $limit; 
        
        $querykey = md5("KEY.getUserFollower.".$user_id.".".$page);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $connect = $connect->query($sql);
            # setting the fetch mode
            $connect->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arr = array();   
            $i=0;  
            while($row = $connect->fetch()) {
                 $arr[$i] =  $row;
                 $arr[$i]["isFollowing"] = checkHasFollowing($user_id,$row["id"]);
                 $i++;
            }
            $connect = NULL;
            $meminstance->set($querykey, $arr, 0, TIME_30);
            return $arr;
            
        }else{
            return $result;
        }
           
    } 
    
    function getUserByIDs($user_ids)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $last_char = substr($user_ids, -1);
        if(strcmp($last_char,",")==0)
        $user_ids = cleanQuery(substr($user_ids,0,strlen($user_ids)-1));
        $arr = array();
        if(empty($user_ids))  return $arr;
        $sql = "SELECT  id,username,fullname, avatar_url, email, mobile,mobile_view, birthday,sex, address,city, 
        country FROM ms_user WHERE  status = 1 And  id in (".$user_ids.")  "; 
        $querykey =md5("KEY.getUserByIDs.".$user_ids);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
             $arr = array();   
            $i = 0;    
            while($row = $q->fetch()) {
                  $arr[$i] =  $row;
                 $i++;
            } 
           
             $meminstance->set($querykey, $arr, 0, TIME_15);
             $connect = null;
             return $arr;  
        }else{
            return $result;
        } 
           
    }
    
    function getUserByFacebookIDs($user_id,$fb_ids)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $last_char = substr($fb_ids, -1);
        if(strcmp($last_char,",")==0)
        $fb_ids = cleanQuery(substr($fb_ids,0,strlen($fb_ids)-1));
        
        $sql = "SELECT  id,username,fullname, avatar_url, email, mobile, birthday,sex, address,city, 
        country FROM ms_user WHERE  status = 1 And  sso_id in (".$fb_ids.")  "; 
        $querykey =md5("KEY.getUserByFacebookIDs.".$user_id.".".$fb_ids);
        $result = $meminstance->get($querykey);
        
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
             $arr = array();   
            $i = 0;    
            while($row = $q->fetch()) {
                  $arr[$i] =  $row;
                  $arr[$i]["isFollowing"] = checkHasFollowing($user_id,$row["id"]);
                 $i++;
            } 
           
             $meminstance->set($querykey, $arr, 0, TIME_15);
             $connect = null;
             return $arr;  
        }else{
            return $result;
        } 
           
    }
    
    
    function getIDUserFollowing($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT user_following_id FROM ms_user_following WHERE user_id =  ?"; 

        $querykey =md5("KEY.getIDUserFollowing." .$user_id);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $strUserId = "";
            $i = 0;    
            while($row = $q->fetch()) {
                 $strUserId .=  $row["user_following_id"].",";
                 $i++;
            } 
            
             $strUserId = substr($strUserId,0,strlen($strUserId)-1);
             $meminstance->set($querykey, $strUserId, 0, TIME_15);
             $connect = null;
             return $strUserId;  
        }else{
            return $result;
        } 
           
    } 
    
     function getIDUserFollower($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        
        $sql = "SELECT user_id FROM ms_user_following WHERE user_following_id = ? "; 

        $querykey =md5("KEY.getIDUserFollower." .$user_id);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $strUserId = "";
            $i = 0;    
            while($row = $q->fetch()) {
                 $strUserId .=  $row["user_id"].",";
                 $i++;
            } 
             $strUserId = substr($strUserId,0,strlen($strUserId)-1);
             $meminstance->set($querykey, $strUserId, 0, TIME_15);
             $connect = null;
             return $strUserId;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function insertAddress($user_id,$address_user,$province_code,$city_code,$address,$create_user,$tel,$provinceName,$districtName)
    {   
        $connect = connectDBShop();
        $sql = "INSERT INTO ms_user_address (user_id,address_user,
        province_code,city_code,address,create_date,create_user,update_date,update_user,tel,province,city) VALUES (?,?,?,?,?,NOW(),?,NOW(),?,?,?,?)";
       
        # creating the statement
        $q = $connect->prepare($sql);
        $arrV = array($user_id,$address_user,$province_code,$city_code,$address,$create_user,$create_user,$tel,$provinceName,$districtName);
        $count = $q->execute($arrV);
       
        $connect = NULL;
        $querykey =md5("KEY.getAddress." .$user_id);  
        deleteCacheByKey($querykey);
        return $count;   
    } 
    
    
     function updateAddress($id,$address_user,$tel,$province,$province_code,$city,$city_code,$address,$update_user)
    {   
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "UPDATE ms_user_address 
        SET address_user = ? , tel = ? , province = ? , province_code = ? , city = ? , city_code = ?, 
        address = ?  , update_user = ? , update_date = NOW() WHERE id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($address_user,$tel,$province,$province_code,$city,$city_code,$address,$update_user,$id);
            $count = $q->execute($arrV);
            $connect = NULL; 
            $address=getAddressById($id); 
            $querykey =md5("KEY.getAddress." .$address["user_id"]);  
            deleteCacheByKey($querykey);   
        } catch (Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
            $count = 0;
        }  
        
        return $count;   
    } 
    
    function deleteAddress($address_id,$user_id)
    {   
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "DELETE FROM ms_user_address WHERE id = ? And user_id = ?    ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($address_id,$user_id);
            $count = $q->execute($arrV);
            $connect = NULL;  
            $querykey =md5("KEY.getAddress." .$user_id);  
            deleteCacheByKey($querykey);  
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }  
        
        return $count;   
    } 
    
     function insertPaymentMethodByBank($user_id,$bank_name,$bank_branch,$account_name,$account_id)
    {   
        $connect = connectDBShop();
        $sql = "INSERT INTO ms_user_payment_method (user_id,bank_name,bank_branch, 
    account_name,account_id,type_payment,create_date,update_date)
    VALUES (?,?,?,?,?,1,NOW(),NOW())";
       
        # creating the statement
        $q = $connect->prepare($sql);
        $arrV = array($user_id,$bank_name,$bank_branch,$account_name,$account_id);
        $count = $q->execute($arrV);
       
        $connect = NULL;
        $querykey =md5("KEY.getPaymentMethod." .$user_id);  
        deleteCacheByKey($querykey)  ;
        
        return $count;   
    }
    
    function insertPaymentMethodByIdentify($user_id,$bank_name,$bank_branch,$receiver,$id_number,$id_date,$id_place){   
        $connect = connectDBShop();
        $sql = "INSERT INTO ms_user_payment_method (user_id,bank_name,bank_branch,receiver,id_number
    ,id_date,id_place,type_payment,create_date,update_date
    ) VALUES (?,?,?,?,?,?,?,2,NOW(),NOW());";
       
        # creating the statement
        $q = $connect->prepare($sql);
        $arrV = array($user_id,$bank_name,$bank_branch,$receiver
    ,$id_number,$id_date,$id_place);
        $count = $q->execute($arrV);
       
        $connect = NULL;
        $querykey =md5("KEY.getPaymentMethod." .$user_id);  
        deleteCacheByKey($querykey)  ;
        
        return $count;   
    } 
    
    
     function getAddress($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $sql = "SELECT id,user_id,address_user,tel, 
    province,city,address,province_code,city_code  FROM ms_user_address Where user_id = ?  ORDER BY id DESC LIMIT 10
 "; 
        $querykey =md5("KEY.getAddress." .$user_id);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $arrAddress = Array();    
            while($row = $q->fetch()) {
                 $arrAddress[$i] =  $row;
                 $i++;
            } 
             $meminstance->set($querykey, $arrAddress, 0, TIME_15);
             $connect = null;
             return $arrAddress;  
        }else{
            return $result;
        } 
           
    } 
    
    function getAddressById($address_id)
    {
            $address_id = intval($address_id);
            $sql = "SELECT id,user_id,address_user,tel, 
        province,city,address,province_code,city_code  FROM ms_user_address Where id  = ?  "; 
        
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($address_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
     
            $arrAddress = Array();    
            if($row = $q->fetch()) {
                 $arrAddress =  $row;
                
            } 
             $connect = null;
             return $arrAddress;  
           
    } 
    
    
    function getPaymentMethod($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $sql = "SELECT  id,user_id,bank_name,bank_branch, account_name,account_id,receiver,
        id_number,id_date,id_place,verify_code,type_payment,create_date
        FROM ms_user_payment_method  WHERE user_id = ? ORDER BY id DESC LIMIT 0, 10;"; 
        $querykey =md5("KEY.getPaymentMethod." .$user_id);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $arrPayment = Array();    
            while($row = $q->fetch()) {
                 $arrPayment[$i] =  $row;
                 $i++;
            } 
             $meminstance->set($querykey, $arrPayment, 0, TIME_15);
             $connect = null;
             return $arrPayment;  
        }else{
            return $result;
        } 
           
    } 
    
    
    function getPromotionCode($promotion_code)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $sql = "SELECT id, promotion_code, promotion_value, create_date, create_user
        ,update_date, update_user, date_expiration FROM ms_promotion_code WHERE promotion_code = ? AND date_expiration > NOW()"; 
        $querykey =md5("KEY.getPromotionCode." .$promotion_code);
        $result = $meminstance->get($querykey);
      
        if (!$result) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($promotion_code));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $codePro = Array();    
            if($row = $q->fetch()) {
                 $codePro =  $row;
                 $i++;
            } 
             $meminstance->set($querykey, $codePro, 0, TIME_15);
             $connect = null;
             return $codePro;  
        }else{
            return $result;
        } 
           
    } 
  
  
    
    function insertTransaction($seller_id, $buyer_id,$quantity, $address_seller, $address_buyer, 
    $transaction_type, $pay_type, $status, $fee_product, $fee_transport_seller,$fee_transport_buyer, $transport_buyer_by, $discount, 
    $fee_total, $promotion_code,$product_id,$transport_buyer_service)
    {   
        $connect = connectDBShop();
        $sql = "INSERT INTO ms_transaction (seller_id, buyer_id,quantity, address_seller, address_buyer, 
    transaction_type, pay_type, STATUS, fee_product, fee_transport_seller,fee_transport_buyer, transport_buyer_by, discount, 
    fee_total, promotion_code, create_date, update_date,product_id,transport_buyer_service)
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW(),?,?);
";
       //echo $address_buyer;die;
        # creating the statement
        $q = $connect->prepare($sql);
        $arrV = array($seller_id, $buyer_id,$quantity, $address_seller, $address_buyer, 
    $transaction_type, $pay_type, $status, $fee_product, $fee_transport_seller,$fee_transport_buyer, $transport_buyer_by, $discount, 
    $fee_total, $promotion_code,$product_id,$transport_buyer_service);
      
        $count = $q->execute($arrV);
        
        $id = $connect->lastInsertId();
       
        $connect = NULL;
       
        return $id;   
    }
    
    
    function insertTransactionLog($transaction_id,$create_user_id,$seller_id, $buyer_id,$quantity, $address_seller, $address_buyer,$transaction_type, $pay_type, $status, $fee_product, $fee_transport_seller,$fee_transport_buyer, $transport_seller_by, $transport_buyer_by,$discount, $fee_total, $promotion_code,$product_offer_id)
    {  
        $id = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_transaction_log (seller_id, buyer_id,quantity, address_seller, address_buyer, 
        transaction_type, pay_type, STATUS, fee_product, fee_transport_seller,fee_transport_buyer, transport_seller_by,transport_buyer_by, discount,fee_total, promotion_code, create_date, transaction_id,create_user_id,product_id)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?)";
           
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($seller_id, $buyer_id,$quantity, $address_seller, $address_buyer, 
        $transaction_type, $pay_type, $status, $fee_product, $fee_transport_seller,$fee_transport_buyer, $transport_seller_by,$transport_buyer_by, $discount,$fee_total, $promotion_code,$transaction_id,$create_user_id,$product_offer_id);
          
            $count = $q->execute($arrV);
            $id = $connect->lastInsertId();
           
            $connect = NULL;
            return $id;
            } catch (Exception $e) {
           //  echo 'Caught exception: ',  $e->getMessage(), "\n";
        }  
          return $id; 
    }
    
    function insertTransactionItem($transaction_id,$product_id,$user_id,$quantity, $fee_transport)
    {   
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_transaction_item (transaction_id,product_id,user_id,quantity, 
            fee_transport,create_date,update_date)
            VALUES (?,?,?,?,?,NOW(),NOW())";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_id,$product_id,$user_id,$quantity, $fee_transport);
            $count = $q->execute($arrV);
            $connect = NULL;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $count;   
    }
    
     /* function insertTransactionProcess($transaction_id,$processing_step,$manager_id, 
    $user_id,$note)
    {   
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_transaction_process 
    (transaction_id,processing_step,manager_id, 
    user_id,note,create_date,update_date)
    VALUES (?,?,?,?,?,NOW(),NOW())";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_id,$processing_step,$manager_id, 
    $user_id,$note);
            $count = $q->execute($arrV);
            $connect = NULL;
        } catch (Exception $e) {
            $count = 2;
           // echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $count;   
    }*/
    
    function updateAddressBuyer($transaction_id,$address)
    { 
        $count = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET address_buyer = ? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($address,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;   
          } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
     function updateAddressSeller($transaction_id,$address)
    {   
        $count = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET address_seller = ? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($address,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;
          } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
     function updatePaymentTypeByBuyer($transaction_id,$pay_type,$fee_transport_buyer,$transport_buyer_by,$transport_service)
    {  
      $count = 0;
        try{  
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET pay_type = ?,
            fee_transport_buyer=?,transport_buyer_by=?,transport_buyer_service=? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($pay_type,$fee_transport_buyer,$transport_buyer_by,$transport_service,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;
         } catch (Exception $e) {
           // echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
    function updatePaymentTypeSeller($transaction_id,$pay_type,$fee_transport_seller,$transport_seller_by,$transport_service)
    {  
      $count = 0;
        try{  
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET pay_type = ?,
            fee_transport_seller=?,transport_seller_by=?,transport_seller_service=? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($pay_type,$fee_transport_seller,$transport_seller_by,$transport_service,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;
         } catch (Exception $e) {
           // echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
    
    function cancelTransaction($transaction_id)
    {  
     $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET status = 3 Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
    function insertTransactionProcess($transaction_id,$processing_step,$user_id,$note)
    {  
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_transaction_process(transaction_id,processing_step,user_id,note,create_date,update_date ) VALUES (?,?,?,?,NOW(),NOW());";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_id,$processing_step,$user_id,$note);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;
         } catch(Exception $e){
            $count = 2;
            $connect->rollBack();
        }
        return $count;  
    }
    
    function getTransactionProcessStep($transaction_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $transaction_id = intval($transaction_id);
        $sql = "SELECT MAX(processing_step) as step FROM ms_transaction_process WHERE transaction_id  = ? "; 
        $querykey =md5("KEY.getTransactionProcessStep." .$transaction_id);
        $result = $meminstance->get($querykey);
      
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $step = 1;    
        if($row = $q->fetch()) {
            if(!empty($row["step"]))
             $step =  $row["step"];
        } 
         $meminstance->set($querykey, $step, 0, TIME_15);
         $connect = null;
         return $step;  
    }
    
    function getTransactionProcess($transaction_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $transaction_id = intval($transaction_id);
        $sql = "SELECT * FROM ms_transaction_process WHERE transaction_id  = ? "; 
        $querykey =md5("KEY.getTransactionProcess." .$transaction_id);
        $result = $meminstance->get($querykey);
      
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $i = 0;
        $step = 0; 
        $arrStep = array();
        $title_step1= "Tạo giao dich thành công.";
        $title_step2= "TraoDoiDi.vn Tiếp nhận giao dịch.";
        $title_step3= "Khách đóng gói xong và Sẵn sàng giao hàng.";
        $title_step4= "Bắt đầu giao hàng.";
        $title_step5= "Giao hàng thành công.";
        $title_step6= "TraoDoiDi.vn hoàn thành thanh toán.";
        $title_step7= "Kết thúc giao dịch.";
        
        $arrStep[0] = array("transaction_id"=>$transaction_id,"processing_step"=>1,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step1);
        $arrStep[1] = array("transaction_id"=>$transaction_id,"processing_step"=>2,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step2);
        $arrStep[2] = array("transaction_id"=>$transaction_id,"processing_step"=>3,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step3);
        $arrStep[3] = array("transaction_id"=>$transaction_id,"processing_step"=>4,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step4);
        $arrStep[4] = array("transaction_id"=>$transaction_id,"processing_step"=>5,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step5);
        $arrStep[5] = array("transaction_id"=>$transaction_id,"processing_step"=>6,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step6);
        $arrStep[6] = array("transaction_id"=>$transaction_id,"processing_step"=>100,
        "manager_id"=>0,"user_id"=>0,"note"=>"","create_date"=>"","title"=>$title_step7);
          
        while($row = $q->fetch()) {
             if($row["processing_step"]==1) {$arrStep[0] =  $row;$arrStep[0]["title"]=$title_step1;}
             if($row["processing_step"]==2) {$arrStep[1] =  $row;$arrStep[1]["title"]=$title_step2;}
             if($row["processing_step"]==3) {$arrStep[2] =  $row;$arrStep[2]["title"]=$title_step3;}
             if($row["processing_step"]==4) {$arrStep[3] =  $row;$arrStep[3]["title"]=$title_step4;}
             if($row["processing_step"]==5) {$arrStep[4] =  $row;$arrStep[4]["title"]=$title_step5;}
             if($row["processing_step"]==6) {$arrStep[5] =  $row;$arrStep[5]["title"]=$title_step6;}
             if($row["processing_step"]==100) {$arrStep[6] =  $row;$arrStep[6]["title"]=$title_step7;}
             $i++;
        } 
         $meminstance->set($querykey, $arrStep, 0, TIME_15);
         $connect = null;
         return $arrStep;  
    }
    
    function getTransaction($transaction_id)
    {
        $transaction_id = intval($transaction_id);
        $sql = "SELECT * FROM ms_transaction WHERE id  = ? "; 
        
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
       
        $transaction = array();    
        if($row = $q->fetch()) {
             $transaction =  $row;
           
        } 
         $connect = null;
         return $transaction;  
    }  
    
   
    function getListTransactionSell($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $startRecord = ($page - 1) * $limit;
        
        $sql = "select id,seller_id, buyer_id, quantity, address_seller, address_buyer, transaction_type,pay_type, status,fee_product, fee_transport_seller,fee_transport_buyer, transport_buyer_by, discount, fee_total, promotion_code,product_id,create_date   From ms_transaction Where seller_id = ? And transaction_type = 1  Order By id DESC LIMIT " . $startRecord . ", ". $limit; 

        $querykey =md5("KEY.getListTransactionSell." .$user_id.".".$page.".".$limit);
        $result = $meminstance->get($querykey);
      
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $arrTran = array();    
            while($row = $q->fetch()) {
                 $arrTran[$i] =  $row;
                 $product = getProductDetail($row["product_id"]);
                 $arrTran[$i]["p_title"] = $product["title"];
                 $arrTran[$i]["p_price"] = $product["price"];
                 $arrTran[$i]["p_province_code"] = $product["province_code"];     
                 $arrTran[$i]["p_city_code"] = $product["city_code"];     
                 if(count($product["image"])>0)
                 $arrTran[$i]["p_image"] = $product["image"][0];
                 $user_sell = getUserShopById($row["seller_id"]);
                 $user_buy = getUserShopById($row["buyer_id"]);
                 $arrTran[$i]["seller"]=$user_sell["fullname"];
                 $arrTran[$i]["buyer"]=$user_buy["fullname"];
                 $arrTran[$i]["process_step"]=getTransactionProcessStep($row["id"]);
                 $i++;
            } 
             $meminstance->set($querykey, $arrTran, 0, TIME_15);
            
             $sl = countTransactionSell($user_id);
             $arrOut = array();
             $arrOut["transaction"] = $arrTran;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
             $connect = null;
             return $arrOut;  
        }else {
            $arrOut = array();
            $sl = countTransactionSell($user_id);
            $arrOut["transaction"] = $result;
            $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
            return $arrOut;
        }
    } 
    
    function getListTransactionBuy($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $startRecord = ($page - 1) * $limit;
        
        $sql = "select id,seller_id, buyer_id, quantity, address_seller, address_buyer, 
    transaction_type,pay_type, status,fee_product, fee_transport_seller, 
    fee_transport_buyer, transport_buyer_by, discount, fee_total, promotion_code,product_id ,create_date 
    from ms_transaction Where buyer_id = ? And transaction_type = 1   Order By id DESC LIMIT " . $startRecord . ", " . $limit;

        $querykey =md5("KEY.getListTransactionBuy." .$user_id.".".$page.".".$limit);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $arrTran = array();    
            while($row = $q->fetch()) {
                 $arrTran[$i] =  $row;
                
                 $product = getProductDetail($row["product_id"]);
                 $arrTran[$i]["p_title"] = $product["title"];
                 $arrTran[$i]["p_price"] = $product["price"];
                 $arrTran[$i]["p_province_code"] = $product["province_code"];     
                 $arrTran[$i]["p_city_code"] = $product["city_code"];     
                
                  if(count($product["image"])>0)
                 $arrTran[$i]["p_image"] = $product["image"][0];
                 $user_sell = getUserShopById($row["seller_id"]);
                 $user_buy = getUserShopById($row["buyer_id"]);
                 $arrTran[$i]["seller"]=$user_sell["fullname"];
                 $arrTran[$i]["buyer"]=$user_buy["fullname"];
                
                 $arrTran[$i]["process_step"]=getTransactionProcessStep($row["id"]);
                
                 $i++;
            } 
             $meminstance->set($querykey, $arrTran, 0, TIME_15);
             $sl = countTransactionBuy($user_id);
             $arrOut = Array();
             $arrOut["transaction"] = $arrTran;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
             $connect = null;
             return $arrOut;  
        }else {
            $arrOut = array();
            $sl = countTransactionBuy($user_id);
            $arrOut["transaction"] = $result;
            $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
            return $arrOut;
        }
    } 
    
    
    function getListTransactionSwap ($user_id,$page,$limit)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $startRecord = ($page - 1) * $limit;
        
        $sql = "select id,seller_id, buyer_id, quantity, address_seller, address_buyer, 
    transaction_type,pay_type, status,fee_product, fee_transport_seller, 
    fee_transport_buyer, transport_buyer_by,transport_seller_by, discount, fee_total, promotion_code,product_id ,create_date 
    from ms_transaction Where ( seller_id = ?  OR  buyer_id = ? ) And transaction_type = 2   Order By id DESC LIMIT " . $startRecord . ", " . $limit;

        $querykey =md5("KEY.getListTransactionSwap." .$user_id.".".$page.".".$limit);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id,$user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $arrTran = array();    
            while($row = $q->fetch()) {
                 $arrTran[$i] =  $row;
                 
                 $product = getProductDetail($row["product_id"]);
                 $arrTran[$i]["p_title"] = $product["title"];
                 $arrTran[$i]["p_price"] = $product["price"];
                  if(count($product["image"])>0)
                 $arrTran[$i]["p_image"] = $product["image"][0];
                 $arrTran[$i]["p_province_code"] = $product["province_code"];     
                 $arrTran[$i]["p_city_code"] = $product["city_code"];     
                 
                 $user_sell = getUserShopById($row["seller_id"]);
                 $user_buy = getUserShopById($row["buyer_id"]);
                 $arrTran[$i]["seller"]=$user_sell["fullname"];
                 $arrTran[$i]["buyer"]=$user_buy["fullname"];
                 $arrTran[$i]["process_step"]=getTransactionProcessStep($row["id"]);
                 $arrTran[$i]["item"]= getListTransactionItemProduct($row["id"]);
                 $i++;
            } 
             $meminstance->set($querykey, $arrTran, 0, TIME_15);
             $sl = countTransactionSwap($user_id);
             $arrOut = Array();
             $arrOut["transaction"] = $arrTran;
             $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
             
             $connect = null;
             return $arrOut;  
        }else {
            $arrOut = array();
            $sl = countTransactionSwap($user_id);
            $arrOut["transaction"] = $result;
            $arrOut["page"] = ceil(intval($sl/$limit))+($sl%$limit>0?1:0);
            return $arrOut;
        }
    } 
    
    
     function getTransactionDetail($transaction_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $transaction_id = intval($transaction_id);
        
        $sql = "select id,seller_id, buyer_id, quantity, address_seller, address_buyer, 
    transaction_type,pay_type, status,status_payment,fee_product, fee_transport_seller, 
    fee_transport_buyer, transport_buyer_by,transport_seller_by,transport_seller_service,transport_buyer_service, discount, fee_total, promotion_code,product_id ,create_date 
    from ms_transaction Where id= ? ";

        $querykey =md5("KEY.getTransactionDetail." .$transaction_id);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($transaction_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $transaction = null;
            $user_sell = null;
            $user_buy = null;
            $arrItem = array();
            $product= null;    
            
            if($row = $q->fetch()) {
                 $transaction =  $row;
                 $product = getProductDetail($row["product_id"]);
                 $user_sell = getUserShopById($row["seller_id"]);
                 $user_buy = getUserShopById($row["buyer_id"]);
                 $arrItem= getListTransactionItemProduct($row["id"]);
                 $i++;
            } 
             $meminstance->set($querykey, $transaction, 0, TIME_15);
             
             $arrOut = Array();
             $arrOut["transaction"] = $transaction;
             $arrOut["item"] = $arrItem;
             $arrOut["seller"] = $user_sell;
             $arrOut["buyer"] = $user_buy;
             $arrOut["product"] = $product;
             
             $connect = null;
             return $arrOut;  
        }else {
            $arrOut = array();
            $arrOut["transaction"] = $result;
            $product = getProductDetail($result["product_id"]);
            $user_sell = getUserShopById($result["seller_id"]);
            $user_buy = getUserShopById($result["buyer_id"]);
            $arrItem= getListTransactionItemProduct($result["id"]);

            $arrOut["item"] = $arrItem;
            $arrOut["seller"] = $user_sell;
            $arrOut["buyer"] = $user_buy;
            $arrOut["product"] = $product;
             
            return $arrOut;
        }
    } 
    
    
    function getTransactionItem($transaction_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $transaction_id = intval($transaction_id);
        
        $sql = "select id,seller_id, buyer_id, quantity, address_seller, address_buyer, 
    transaction_type,pay_type, status,status_payment,fee_product, fee_transport_seller, 
    fee_transport_buyer, transport_buyer_by,transport_seller_by,transport_seller_service,transport_buyer_service, discount, fee_total, promotion_code,product_id ,create_date 
    from ms_transaction Where id= ? ";

        $querykey =md5("KEY.getTransactionItem." .$transaction_id);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($transaction_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $transaction = null;
            if($row = $q->fetch()) {
                 $transaction =  $row;
                 $i++;
            } 
             $meminstance->set($querykey, $transaction, 0, TIME_15);
             
             $connect = null;
             return $transaction;  
        }else {
            return $result;
        }
    } 
    
    
    function countTransactionSell($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $sql = "select count(*) as sl from ms_transaction Where seller_id = ? And pay_type  = 1 "; 
        $querykey =md5("KEY.countTransactionSell." .$user_id);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
                 $i++;
            } 
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else {
            return $result;
        }
    } 
    
    function countTransactionBuy($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $sql = "select count(*) as sl from ms_transaction Where buyer_id = ? And pay_type  = 1 "; 
        $querykey =md5("KEY.countTransactionBuy." .$user_id);
        $result = $meminstance->get($querykey);
       
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
                 $i++;
            } 
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else {
            return $result;
        }
    }
    
    function countTransactionSwap($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $user_id = intval($user_id);
        $sql = "select count(*) as sl from ms_transaction Where (buyer_id = ? OR seller_id  = ? ) And pay_type  = 2 "; 
        $querykey =md5("KEY.countTransactionSwap." .$user_id);
        $result = $meminstance->get($querykey);
       
       if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id,$user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $i = 0;
            $sl = 0;    
            if($row = $q->fetch()) {
                 $sl =  $row["sl"];
                 $i++;
            } 
             $meminstance->set($querykey, $sl, 0, TIME_15);
             $connect = null;
             return $sl;  
        }else {
            return $result;
        }
    }  
    
     function updateQuantityTransaction($product_id,$sl)
    {  
        $count = 0;
        try {     
            $connect = connectDBShop();
            $connect->beginTransaction();
            $product_id = intval($product_id);
            $sl = intval($sl);
            $sql = "Update  ms_product SET quantity = quantity - ".$sl.", sta_transaction = sta_transaction + ".$sl.",update_date=NOW() Where id =  ".$product_id;
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($product_id);
            $count = $q->execute($arrV);
          
            $connect->commit();
            $connect = NULL;
         } catch (Exception $e) {
          $connect->rollBack();
        }
        return $count;   
    }
    
    function updateQuantityTransactionCancel($product_id,$sl)
    { 
        $count = 0;
        try {    
            $connect = connectDBShop();
            $connect->beginTransaction();
            $product_id = intval($product_id);
            $sl = intval($sl);
            $sql = "Update  ms_product SET quantity = quantity + ".$sl.", sta_transaction = sta_transaction - ".$sl.",update_date=NOW()  Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($product_id);
          
            $count = $q->execute($arrV);
            $connect->commit();
            $connect = NULL;
        } catch (Exception $e) {
          $connect->rollBack();
        }
        return $count;   
    }
    
    
    function getListTransactionItem($transaction_id)
    {
        $transaction_id = intval($transaction_id);
        
        $sql = "select * from ms_transaction_item Where transaction_id = ? ";

        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $i = 0;
        $arrTran = array();    
        while($row = $q->fetch()) {
             $arrTran[$i] =  $row;
             $i++;
        } 
         
         $connect = null;
         return $arrTran;  
       
    } 
    
    
    function getProductIDInTransaction($transaction_id)
    {
        $transaction_id = intval($transaction_id);
        
        $sql = "select product_id from ms_transaction_item Where transaction_id = ? ";

        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $i = 0;
        $productID="";    
        while($row = $q->fetch()) {
             $productID .=$row["product_id"].",";
             $i++;
        } 
         if(strlen($productID)>0)$productID=substr($productID,0,strlen($productID)-1);
         $connect = null;
         return $productID;  
       
    } 
    
    function getTransactionIDByProduct($product_id)
    {
        $product_id = intval($product_id);
        
        $sql = "select transaction_id from ms_transaction_item Where product_id = ? ";

        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($product_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $i = 0;
        $productID="";    
        while($row = $q->fetch()) {
             $productID .=$row["transaction_id"].",";
             $i++;
        } 
         if(strlen($productID)>0)$productID=substr($productID,0,strlen($productID)-1);
         $connect = null;
         return $productID;  
       
    } 
    
    
    
    function getListTransactionItemProduct($transaction_id)
    {
        $transaction_id = intval($transaction_id);
        
        $sql = "select * from ms_transaction_item Where transaction_id = ? ";

        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($transaction_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $i = 0;
        $arrTran = array();    
        while($row = $q->fetch()) {
             $arrTran[$i] =  $row;
             $product = getProductDetail($row["product_id"]);
             $arrTran[$i]["p_title"] =  $product["title"];
             $arrTran[$i]["p_price"] =  $product["price"];
             
             if(count($product["image"])>0){
                  $image=   $product["image"][0];
                  $arrTran[$i]["p_image"] = $image;
             }else {
                 $arrTran[$i]["p_image"] = "";
             }
             
             $i++;
        } 
         
         $connect = null;
         return $arrTran;  
       
    } 
    
    function insertUserRate($user_id,$valuer_id,$transaction_id,$status,$comment)
    { 
        $count = 0;
        try {    
            $connect = connectDBShop();
            $connect->beginTransaction();
            $product_id = intval($user_id);
            $valuer_id = intval($valuer_id);
            $transaction_id = intval($transaction_id);
            $status = intval($status);
            $sql = "INSERT INTO ms_user_rate (user_id,valuer_id,transaction_id,STATUS,COMMENT,create_date) VALUES (?,?,?,?,?,NOW())";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($user_id,$valuer_id,$transaction_id,$status,$comment);
          
            $count = $q->execute($arrV);
            $connect->commit();
            $connect = NULL;
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
          $connect->rollBack();
        }
        return $count;   
    }
    
  
    function insertProductReport($reason,$note,$create_user_id,$product_id)
    { 
        $count = 0;
        try {    
            $connect = connectDBShop();
            $connect->beginTransaction();
            $reason = intval($reason);
            $create_user_id = intval($create_user_id);
            $sql = "INSERT INTO ms_product_report (reason,note,create_date,create_user_id,product_id)
             VALUES (?,?,NOW(),?,?);";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($reason,$note,$create_user_id,$product_id);
          
            $count = $q->execute($arrV);
            $connect->commit();
            $connect = NULL;
        } catch (Exception $e) {
          $connect->rollBack();
        }
        return $count;   
    }
    
     function updateTransportSeller($transaction_id,$transaction_by,$fee)
    { 
        $count = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET transport_seller_by = ?,fee_transport_seller=? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_by,$fee,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;   
          } catch (Exception $e) {
           // echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
    function updateTransportBuyer($transaction_id,$transaction_by,$fee)
    { 
        $count = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "Update  ms_transaction SET transport_buyer_by = ?,fee_transport_buyer=? Where id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($transaction_by,$fee,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
            return $count;   
          } catch (Exception $e) {
           // echo 'Caught exception: ',  $e->getMessage(), "\n";
            $connect->rollBack();
        }
        return $count;  
    }
    
    function searchProduct($keyword,$cat_id,$priceF,$priceT,$lat, $lng
            , $distance ,$order_by ,$page) {
            $limit = 30;
        require_once("http://127.0.0.1:8181/JavaBridge/java/Java.inc");
        $searcher = new java("com.ttv.search.ProductSearch","/home/search/product/");
        //query(String keyword,int cat_id,double priceF,double priceT,double lat, double lng
         //   , double distance ,int order_by ,int page, int rowpage) 
        $page = $page<=0?1:$page;
        $topDocs = $searcher->query($keyword,$cat_id,$priceF,$priceT,$lat, $lng
            , $distance ,$order_by ,$page, $limit); 
          
        $docs = java_values($topDocs) ;
         
        $num_row=count($docs);
        
        $arrGame = array();
        $arrGameKQ = array();
        for($i=0;$i<$num_row;$i++)
        {
        
          $arrGame[$i]["id"] = java_values($docs[$i]->id);   
          $arrGame[$i]["title"] =trim(java_values($docs[$i]->title));
       
          $arrGame[$i]["image"] = java_values($docs[$i]->image);
          $arrGame[$i]["cate_id"] = java_values($docs[$i]->cate_id);
          $arrGame[$i]["cate_parent_id"] = java_values($docs[$i]->cate_parent_id);
          
          $arrGame[$i]["user_id"] = java_values($docs[$i]->user_id);
          $user = getUserShopById($arrGame[$i]["user_id"]);
          $arrGame[$i]["fullname"] =  $user["fullname"];
          $arrGame[$i]["avatar_url"] =  $user["avatar_url"]; 
          
          $arrGame[$i]["price"] = java_values($docs[$i]->price);
          $arrGame[$i]["create_date"] = java_values($docs[$i]->create_date);
          
          $arrGame[$i]["quantity"] = java_values($docs[$i]->quantity);
          $arrGame[$i]["sta_comment"] = java_values($docs[$i]->sta_comment);
          $arrGame[$i]["sta_like"] = java_values($docs[$i]->sta_like);
          $arrGame[$i]["sta_view"] = java_values($docs[$i]->sta_view);
          $arrGame[$i]["lat"] = java_values($docs[$i]->lat);
          $arrGame[$i]["lng"] = java_values($docs[$i]->lng);
          
          $time =  date("Y/md",strtotime($arrGame[$i]["create_date"]));    
         
          if(!empty($arrGame[$i]['image'])){
              $arrImage = json_decode($arrGame[$i]['image']);
              $arrGame[$i]['image'] = baseUrlUpload()."shop/product/".$time."/".$arrImage[0];
          }
          
           $like = checkProductFavorite($arrGame[$i]["id"],$arrGame[$i]["user_id"]);
           $arrGame[$i]['like'] = $like;   
        }
        
        $total = java_values($searcher->getTotalHit());
       
        $arrGameKQ["product"]=$arrGame;
        $page = intval($total/$limit)+($total%$limit>0?1:0);
        $arrGameKQ["page"] = $page;
        return $arrGameKQ;
  }
  
  
   function queryProductRecommend($keyword,$user_id,$price,$lat,$lon,$page) {
            $limit = 30;
        require_once("http://127.0.0.1:8181/JavaBridge/java/Java.inc");
        $searcher = new java("com.ttv.search.ProductSearch","/home/search/product/");
        //query(String keyword,int cat_id,double priceF,double priceT,double lat, double lng
         //   , double distance ,int order_by ,int page, int rowpage) 
        $page = $page<=0?1:$page;
        $topDocs = $searcher->queryProductRecommend($keyword,$user_id,$price,$lat,$lon,$page,$limit); 
          
        $docs = java_values($topDocs) ;
         
        $num_row=count($docs);
        
        $arrGame = array();
        $arrGameKQ = array();
        for($i=0;$i<$num_row;$i++)
        {
        
          $arrGame[$i]["id"] = java_values($docs[$i]->id);   
          $arrGame[$i]["title"] =trim(java_values($docs[$i]->title));
       
          $arrGame[$i]["image"] = java_values($docs[$i]->image);
          $arrGame[$i]["cate_id"] = java_values($docs[$i]->cate_id);
          $arrGame[$i]["cate_parent_id"] = java_values($docs[$i]->cate_parent_id);
          $arrGame[$i]["user_id"] = java_values($docs[$i]->user_id);
          $arrGame[$i]["price"] = java_values($docs[$i]->price);
          $arrGame[$i]["create_date"] = java_values($docs[$i]->create_date);
          
          $arrGame[$i]["quantity"] = java_values($docs[$i]->quantity);
          $arrGame[$i]["sta_comment"] = java_values($docs[$i]->sta_comment);
          $arrGame[$i]["sta_like"] = java_values($docs[$i]->sta_like);
          $arrGame[$i]["sta_view"] = java_values($docs[$i]->sta_view);
          $arrGame[$i]["lat"] = java_values($docs[$i]->lat);
          $arrGame[$i]["lng"] = java_values($docs[$i]->lng);
          
          $time =  date("Y/md",strtotime($arrGame[$i]["create_date"]));    
         
          if(!empty($arrGame[$i]['image'])){
              $arrImage = json_decode($arrGame[$i]['image']);
              $arrGame[$i]['image'] = baseUrlUpload()."shop/product/".$time."/".$arrImage[0];
          }
          
           $like = checkProductFavorite($arrGame[$i]["id"],$arrGame[$i]["user_id"]);
           $arrGame[$i]['like'] = $like;   
        }
        
        $total = java_values($searcher->getTotalHit());
       
        $arrGameKQ["product"]=$arrGame;
        $page = intval($total/$limit)+($total%$limit>0?1:0);
        $arrGameKQ["page"] = $page;
        return $arrGameKQ;
  }
  
  
  function searchProductNearest($keyword,$cat_id,$priceF,$priceT,$lat, $lng
            , $distance,$page) {
            $limit = 30;
        $page = $page<=0?1:$page;
        require_once("http://127.0.0.1:8181/JavaBridge/java/Java.inc");
        $searcher = new java("com.ttv.search.ProductSearch","/home/search/product/");
        $topDocs = $searcher->querySortNearest($keyword,$cat_id,$priceF,$priceT,$lat, $lng
            , $distance ,$page, $limit); ;
        $docs = java_values($topDocs) ;
        $num_row=count($docs);
        
        $arrGame = array();
        $arrGameKQ = array();
        for($i=0;$i<$num_row;$i++)
        {
          
          $arrGame[$i]["id"] = java_values($docs[$i]->id);   
          $arrGame[$i]["title"] =trim(java_values($docs[$i]->title));
       
          $arrGame[$i]["image"] = java_values($docs[$i]->image);
          $arrGame[$i]["cate_id"] = java_values($docs[$i]->cate_id);
          $arrGame[$i]["cate_parent_id"] = java_values($docs[$i]->cate_parent_id);
          $arrGame[$i]["user_id"] = java_values($docs[$i]->user_id);
          $arrGame[$i]["price"] = java_values($docs[$i]->price);
          $arrGame[$i]["create_date"] = java_values($docs[$i]->create_date);
          
          $arrGame[$i]["quantity"] = java_values($docs[$i]->quantity);
          $arrGame[$i]["sta_comment"] = java_values($docs[$i]->sta_comment);
          $arrGame[$i]["sta_like"] = java_values($docs[$i]->sta_like);
          $arrGame[$i]["sta_view"] = java_values($docs[$i]->sta_view);
          
         $time =  date("Y/md",strtotime($arrGame[$i]["create_date"]));    
         
          if(!empty($arrGame[$i]['image'])){
              $arrImage = json_decode($arrGame[$i]['image']);
              $arrGame[$i]['image'] = baseUrlUpload()."shop/product/".$time."/".$arrImage[0];
          }
          $like = checkProductFavorite($arrGame[$i]["id"],$arrGame[$i]["user_id"]);
           $arrGame[$i]['like'] = $like;   
        }
        
        $total = java_values($searcher->getTotalHit());
       
        $arrGameKQ["product"]=$arrGame;
        $page = intval($total/$limit)+($total%$limit>0?1:0);
        $arrGameKQ["page"] = $page;
        return $arrGameKQ;
  }
  
  function checkKeyNotifyShopByAppClient($app_client_id,$user_id)
    {
        $sql = "SELECT id FROM ms_notify_user WHERE app_client_id = ? And user_id = ? " ;
        
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($app_client_id,$user_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $kq = 0;    
        if($row = $q->fetch()) {
             $kq =  1;
               
        } 
       
        $connect = null;
        return $kq;  
       
    } 
    
     function insertNoticeUserShop($app_client_id,$user_id,$device_token,$os_type)
    {
        $count = 0;
        try{
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_notify_user (app_client_id,user_id,device_token,os_type,create_date) 
                     VALUES (:app_client_id,:user_id,:device_token,:os_type,NOW())";
             
            # creating the statement
            $q = $connect->prepare($sql);
            $count = $q->execute(array(':app_client_id'=>$app_client_id,':user_id'=>$user_id,':device_token'=>$device_token,':os_type'=>$os_type));
           
            $connect = null;
        }catch (Exception $e){
            $count = 0;
            
        }
        
        return $count;   
    } 
    
    
    function updateNoticeUserShop($app_client_id,$user_id,$device_token)
    {
        $count = 0;
        try{
             $connect = connectDBShop();
            $sql = "Update  ms_notify_user Set device_token = ? where  app_client_id = ?  and user_id = ?   ";
            # creating the statement
            $q = $connect->prepare($sql);
            $count = $q->execute(array($device_token,$app_client_id,$user_id));
            $connect = null;
        }catch (Exception $e){
            $count = 0;
        }
        
        return $count;   
    }
    
    function insertNoticeShop($object_id, $to_user, $from_user, $content, $icon, $url, $object_type, $create_user)
    {
        $count = 0;
        try{
             $connect = connectDBShop();
            $sql = "INSERT INTO ms_notify (object_id, to_user, from_user, content, icon, url, object_type, STATUS,time_sent,create_date, create_user) VALUES ( ?,?,?,?,?,?,?,1,NOW(),NOW(),?);";
            # creating the statement
            $q = $connect->prepare($sql);
            $count = $q->execute(array($object_id, $to_user, $from_user, $content, $icon, $url, $object_type, $create_user));
            $connect = null;
        }catch (Exception $e){
            $count = 0;
            //echo 'Message: ' .$e->getMessage();
        }
        
        return $count;   
    }  
    
     function getUserFollowerSendNotify($user_id)
    {
        $user_id = intval($user_id);
        
        $sql = "SELECT user_id FROM ms_user_following  WHERE user_following_id = ? "; 
      
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($user_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $arrUserFollower = array();
        $i = 0;    
        while($row = $q->fetch()) {
             $arrUserFollower[$i] =  $row;
             $i++;
        } 
         
         $connect = null;
         return $arrUserFollower;  
       
           
    } 
    
     function getUserLikeProduct($product_id,$userIDNotIn)
    {
        $product_id = intval($product_id);
        if(empty($userIDNotIn))
        $sql = "SELECT user_id FROM   ms_product_favorite WHERE product_id =   ".$product_id; 
        else 
        $sql = "SELECT user_id FROM  ms_product_favorite WHERE product_id = ".$product_id." and user_id not in (".$userIDNotIn.") "; 
    
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute();
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $arrUserFollower = array();
        $i = 0;    
        while($row = $q->fetch()) {
             $arrUserFollower[$i] =  $row;
             $i++;
        } 
         
         $connect = null;
         return $arrUserFollower;  
       
           
    } 
    
    function getActivity($user_id)
    {
        $user_id = intval($user_id);
        $sql = "SELECT id,object_id, to_user, from_user, content,icon,
    object_type, STATUS, time_sent, create_date, create_user
    FROM  ms_notify WHERE to_user = ? ORDER BY id DESC LIMIT 100; "; 
        #1: Product, 2: User, 3 Transaction; 4: Tin nhăn; 5: Inform Event
        
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($user_id));
       
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
         
        # showing the results
        $arrActity = array();
        $i = 0;    
        while($row = $q->fetch()) {
             $arrActity[$i] =  $row;
             if($row["object_type"]==1) {
                 $product = getProductDetail($row["object_id"]);
                 if(!empty($product)){
                     $arrActity[$i]["icon"]=$product["image"][0];
                     $arrActity[$i]["lat"]=$product["lat"];
                     $arrActity[$i]["lng"]=$product["lng"];
                     $arrActity[$i]["cate_id"]=$product["cate_id"];
                     $arrActity[$i]["cate_parent_id"]=$product["cate_parent_id"];
                 }else{
                     $arrActity[$i]["icon"]="";
                     $arrActity[$i]["lat"]=0;
                     $arrActity[$i]["lng"]=0;
                     $arrActity[$i]["cate_id"]=0;
                     $arrActity[$i]["cate_parent_id"]=0;  
                 }
             }
             
             if($row["object_type"]==2){ 
                $arrActity[$i]["isFollowing"] = checkHasFollowing($user_id,$row["object_id"]);    
             }
             
             if($row["object_type"]==3) { 
                 $transaction = getTransactionItem($row["object_id"]);
                 $product = getProductDetail($transaction["product_id"]);
                 $arrActity[$i]["icon"]=$product["image"][0];
                 $arrActity[$i]["lat"]=$product["lat"];
                 $arrActity[$i]["lng"]=$product["lng"];
                 $arrActity[$i]["cate_id"]=$product["cate_id"];
                 $arrActity[$i]["cate_parent_id"]=$product["cate_parent_id"];   
                 $arrActity[$i]["transaction_type"]=$transaction["transaction_type"];   
             }

             if($row["object_type"]==4){
                 $product = getProductDetail($row["object_id"]);
                 $arrActity[$i]["title"] = $product["title"];
                 $arrActity[$i]["icon"]=$product["image"][0];
                 $arrActity[$i]["create_user_id"] = $row["from_user"];
                 $user = getUserShopById($row["from_user"]);
                 $arrActity[$i]["create_user_name"] = $user["fullname"];
                 $arrActity[$i]["create_user_avatar"] = $user["avatar_url"]; 
                       
             }
             
             if($row["object_type"]==5){  
                    $arrActity[$i]["fu_avatar"]="https://static.traodoidi.vn/upload/shop/traodoidi_128.png";  
             }else{
             $userFrom = getUserShopById($row["from_user"]);
             $arrActity[$i]["fu_avatar"]=$userFrom["avatar_url"];
             }
             $i++;
        } 
         
         $connect = null;
         return $arrActity;  
       
           
    } 
    
    
    function updatePaymentStatus($transaction_id,$status_payment)
    {   
        $count =  0;
        try{
            $connect = connectDBShop();
            $sql = "UPDATE ms_transaction SET  status_payment = ? , update_date = NOW()  WHERE id = ? "; 
            $q = $connect->prepare($sql);
            $arrV = array($status_payment,$transaction_id);
            $count = $q->execute($arrV);
            $connect = NULL;
        }catch(Exception $e) {
           // echo 'Message: ' .$e->getMessage();
           $count = 0;
        }
        return $count;   
    }
    
    
     function insertTransaction123PayNotify($mTransactionID, $bankCode, $transactionStatus, $description, 
    $ts,$CHECKSUM)
    {   
        $count =  0;
        $transactionID =explode("_",$mTransactionID);
        $transactionID = intval($transactionID["1"]);
        try{
            $connect = connectDBShop();
            $sql = "INSERT INTO ms_transaction_123pay_notify 
    (mTransactionID,transaction_id, bankCode, transactionStatus, description,ts,CHECKSUM, create_date)
    VALUES (?,?,?,?,?,?,?,NOW());"; 
            $q = $connect->prepare($sql);
            $arrV = array($mTransactionID,$transactionID, $bankCode, $transactionStatus, $description,$ts,$CHECKSUM);
            $count = $q->execute($arrV);
            $connect = NULL;
        }catch(Exception $e) {
              //echo 'Message: ' .$e->getMessage();  
             $count =  0;
        }
        
        return $count;   
    }
    
    function checkTransaction123PayNotify($mTransactionID)
    {
        $mTransactionID= cleanQuery($mTransactionID);
        $sql = "SELECT id FROM ms_transaction_123pay_notify  WHERE mTransactionID = ?" ;
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($mTransactionID));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrAppHeader = array();  
        $kq = 0; 
        if($row = $q->fetch()) {
             $kq =  1;
        } 
         $q = NULL;
        $connect = NULL;
        return $kq;
    }
    
    function deleteProductByUser($product_id,$user_id)
    { 
        $count = 0;
        try{ 
            $connect = connectDBShop();
            $sql = "Update  ms_product Set status = 0 , deleted = 1,update_date=NOW() Where id = ? And user_id = ? ";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($product_id,$user_id);
            $count = $q->execute($arrV);
            $connect = NULL;
           
            deleteCacheProductOfUser($user_id);
            $querykey =md5("KEY.getProductSwap." .$user_id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductDetail." .$product_id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductByID." .$id); 
            deleteCacheByKey($querykey);
            $querykey =md5("KEY.getProductSwapOfUser." .$user_id); 
            deleteCacheByKey($querykey);
            
            return $count;   
          } catch (Exception $e) {
            $connect->rollBack();
        }
        return $count;  
    }
    
    function checkProductInTransaction($product_id)
    {
        $product_id= cleanQuery($product_id);
        $sql = "SELECT id FROM ms_transaction_item  WHERE product_id = ?" ;
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($product_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrAppHeader = array();  
        $kq = 0; 
        if($row = $q->fetch()) {
             $kq =  1;
        } 
         $q = NULL;
        $connect = NULL;
        return $kq;
    }
    
    function checkProductFavorite($product_id,$user_id)
    {
        $sql = "SELECT id FROM ms_product_favorite  WHERE product_id = ? And user_id = ?" ;
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($product_id,$user_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrAppHeader = array();  
        $kq = 0; 
        if($row = $q->fetch()) {
             $kq =  1;
        } 
         $q = NULL;
        $connect = NULL;
        return $kq;
    }
    
    function checkTransaction($product_id,$seller_id,$buyer_id)
    {
        $sql = "SELECT id FROM ms_transaction  WHERE product_id = ? And seller_id = ? And buyer_id = ? And ( status=1 OR  status=2 )" ;
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($product_id,$seller_id,$buyer_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrAppHeader = array();  
        $kq = 0; 
        if($row = $q->fetch()) {
             $kq =  1;
        } 
         $q = NULL;
        $connect = NULL;
        return $kq;
    }
    
     function getMyOfferSell($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $user_id = intval($user_id);
        $sql = "SELECT id,seller_id,buyer_id,product_id,product_swap_ids,price,quantity, 
    message_type,create_date,update_date  FROM ms_offer WHERE seller_id = ?  ORDER BY update_date DESC  "; 
        
        $querykey =md5("KEY.getMyOfferSell.".$user_id);
        $result = $meminstance->get($querykey);
        
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $arrActity = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $product = getProductDetail($row["product_id"]); 
                 
                 if(!empty($product["id"])){
                     $arrActity[$i] =  $row;   
                     $userSell = getUserShopById($user_id);
                     $userBuy = getUserShopById($row["buyer_id"]);  
                     
                     $arrActity[$i]["title"]=$product["title"];
                     $arrActity[$i]["icon"]=$product["image"][0];
                     $arrActity[$i]["lat"]=$product["lat"];
                     $arrActity[$i]["lng"]=$product["lng"];
                     $arrActity[$i]["cate_id"]=$product["cate_id"];
                     $arrActity[$i]["cate_parent_id"]=$product["cate_parent_id"];
                     
                     
                     $arrActity[$i]["seller_avatar"]=$userSell["avatar_url"];
                     $arrActity[$i]["seller_fullname"]=$userSell["fullname"];
                     
                     $arrActity[$i]["buyer_avatar"]=$userBuy["avatar_url"];
                     $arrActity[$i]["buyer_fullname"]=$userBuy["fullname"];
                     
                     $i++;
                 }
            } 
             
             $connect = null;
             $meminstance->set($querykey, $arrActity, 0, TIME_15);    
             return $arrActity;  
        }else{
            return $result;
        }
   } 
   
   function getMyOfferBuy($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $user_id = intval($user_id);
        $sql = "SELECT id,seller_id,buyer_id,product_id,product_swap_ids,price,quantity, 
    message_type,create_date,update_date  FROM ms_offer WHERE buyer_id = ?  ORDER BY update_date DESC  "; 
        
        $querykey =md5("KEY.getMyOfferBuy.".$user_id);
        $result = $meminstance->get($querykey);
       
        //if(1>0){
        if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $arrActity = array();
            $i = 0;    
            while($row = $q->fetch()) {
                $product = getProductDetail($row["product_id"]);   
                 if(!empty($product["id"])){
                     $arrActity[$i] =  $row;
                     $userSell = getUserShopById($row["seller_id"]);
                     $userBuy = getUserShopById($user_id);  
                     
                     $arrActity[$i]["title"]=$product["title"];
                     $arrActity[$i]["icon"]=$product["image"][0];
                     $arrActity[$i]["lat"]=$product["lat"];
                     $arrActity[$i]["lng"]=$product["lng"];
                     $arrActity[$i]["cate_id"]=$product["cate_id"];
                     $arrActity[$i]["cate_parent_id"]=$product["cate_parent_id"];
                     
                     $arrActity[$i]["seller_avatar"]=$userSell["avatar_url"];
                     $arrActity[$i]["seller_fullname"]=$userSell["fullname"];
                     
                     $arrActity[$i]["buyer_avatar"]=$userBuy["avatar_url"];
                     $arrActity[$i]["buyer_fullname"]=$userBuy["fullname"];
                      $i++;
                 }
                
            } 
             
             $connect = null;
             $meminstance->set($querykey, $arrActity, 0, TIME_15);    
             return $arrActity;  
        }else{
            return $result;
        }
   }
   
    function getMyOfferSwap($user_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $user_id = intval($user_id);
        $sql = "SELECT id,seller_id,buyer_id,product_id,product_swap_ids,price,quantity, 
    message_type,create_date,update_date  FROM ms_offer WHERE (buyer_id = ? OR seller_id= ? ) AND message_type= 5 ORDER BY update_date DESC  "; 
        
        $querykey =md5("KEY.getMyOfferSwap.".$user_id);
        $result = $meminstance->get($querykey);
        
        if(1>0){   
        //if(!$result){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id,$user_id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $arrActity = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 
                 $product = getProductDetail($row["product_id"]); 
                 if(!empty($product["id"])){
                     $arrActity[$i] =  $row;   
                     $userFrom = getUserShopById($row["seller_id"]);
                     
                     $arrActity[$i]["title"]=$product["title"];
                     $arrActity[$i]["icon"]=$product["image"][0];
                     $arrActity[$i]["lat"]=$product["lat"];
                     $arrActity[$i]["lng"]=$product["lng"];
                     $arrActity[$i]["cate_id"]=$product["cate_id"];
                     $arrActity[$i]["cate_parent_id"]=$product["cate_parent_id"];
                     
                     $arrActity[$i]["buyer_avatar"]=$userFrom["avatar_url"];
                     $arrActity[$i]["buyer_fullname"]=$userFrom["fullname"];
                     $i++;  
                 }
               
            } 
             
             $connect = null;
             $meminstance->set($querykey, $arrActity, 0, TIME_15);    
             return $arrActity;  
        }else{
            return $result;
        }
   }
   
    function updateMobileUser($user_id,$mobile,$mobile_view){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  mobile= ?,mobile_view= ?, modify_date=NOW() Where id =  ?";
            $arrV = array($mobile,$mobile_view,$user_id);
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
            $userInfo=getUserShopById($user_id);
            $querykey = md5("KEY.getUserShopByEmail." .$userInfo["email"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopBySSOID." .$userInfo["sso_id"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopById." .$user_id); 
            deleteCacheByKey($querykey);
             
        }catch (Exception $e) {
            $kq = 0;
        }
        return $kq;  
    }
    
    function updateMobileUserNotValidateMobile($user_id,$mobile,$mobile_view){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  mobile= ?,mobile_view= ?,verify_mobile=0, modify_date=NOW() Where id =  ?";
            $arrV = array($mobile,$mobile_view,$user_id);
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
            
            $userInfo=getUserShopById($user_id);
            $querykey = md5("KEY.getUserShopByEmail." .$userInfo["email"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopBySSOID." .$userInfo["sso_id"]); 
            deleteCacheByKey($querykey);
            $querykey = md5("KEY.getUserShopById." .$user_id); 
            deleteCacheByKey($querykey);
            
        }catch (Exception $e) {
            $kq = 0;
        }
        return $kq;  
    }
    
    function updateHadValidateMobile($user_id){
        $kq = 0;
        try{
            $sql = "Update  ms_user SET  verify_mobile=1, modify_date=NOW() Where id =  ?";
            $arrV = array($user_id);
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
        }catch (Exception $e) {
            $kq = 0;
        }
        return $kq;  
    }
    
    
    function insertMobileValidate($user_id,$mobile){
        $kq = 0;
        try{
            $sql = "INSERT INTO ms_user_mobile (user_id, mobile, code_validate,
             create_date, update_date, is_sended) VALUES (?,?,?,NOW(),NOW(),0);";
            $arrV = array($user_id,$mobile,"");
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
        }catch (Exception $e) {
            $kq = 0;
        }
        return $kq;  
    }
    
    function deleteMobileValidate($user_id){
        $kq = 0;
        try{
            $sql = "DELETE FROM ms_user_mobile Where user_id = ? ";
            $arrV = array($user_id);
            $connect = connectDBShop(); 
            $q = $connect->prepare($sql);
            $kq = $q->execute($arrV);
            $q = NULL;
            $connect = null;
        }catch (Exception $e) {
            $kq = 0;
        }
        return $kq;  
    }
    
     function getUserMobileValidate($user_id)
    {
        $user_id = intval($user_id);
        $sql = "SELECT *  FROM ms_user_mobile WHERE user_id = ? "; 
         
        # creating the statement
        $connect = connectDBShop();
        $q = $connect->prepare($sql);
        $q->execute(array($user_id));
        # setting the fetch mode
        $q->setFetchMode(PDO::FETCH_ASSOC);
        # showing the results
        $arrUserMobile = null;
        if($row = $q->fetch()) {
             $arrUserMobile =  $row;
        } 
         
         $connect = null;
         return $arrUserMobile;  
       
   }
   
    function getProductSwapOfUser($user_id)
   {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        $sql = "SELECT * FROM ms_product WHERE (type_sell = 2 OR type_sell = 3) AND STATUS = 1 And quantity > 0 AND user_id = ?  Order by id Desc Limit 30 "; 
        $querykey =  md5("KEY.getProductSwapOfUser.".$user_id);
        $result = $meminstance->get($querykey);
        
        if (!($result)) {
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($user_id));
           
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
             
            # showing the results
            $arrPro = array();
            $i = 0;    
            while($row = $q->fetch()) {
                 $arrPro[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date']));
                 if($row['image']!="") {
                      $arrImage =  json_decode($row['image']);
                      $j=0;
                      while($j<count($arrImage)){
                              $arrImage[$j]=   baseUrlUpload()."shop/product/".$time."/".$arrImage[$j];
                              $j++;
                      } 
                      $arrPro[$i]['image'] =   $arrImage;  
                 }  
                 $i++;
            } 
           
             $meminstance->set($querykey, $arrPro, 0, TIME_15);
             $connect = null;
             return $arrPro;  
        }else{
            return $result;
        } 
           
    } 
    
     function queryProductRecommendLimit5($keyword,$user_id,$price,$lat,$lon,$page) {
        $limit = 5;
        require_once("http://127.0.0.1:8181/JavaBridge/java/Java.inc");
        $searcher = new java("com.ttv.search.ProductSearch","/home/search/product/");
        //query(String keyword,int cat_id,double priceF,double priceT,double lat, double lng
         //   , double distance ,int order_by ,int page, int rowpage) 
        $page = $page<=0?1:$page;
        $topDocs = $searcher->queryProductRecommend($keyword,$user_id,$price,$lat,$lon,$page,$limit); 
          
        $docs = java_values($topDocs) ;
         
        $num_row=count($docs);
        
        $arrGame = array();
        $arrGameKQ = array();
        for($i=0;$i<$num_row;$i++)
        {
        
          $arrGame[$i]["id"] = java_values($docs[$i]->id);   
          $arrGame[$i]["title"] =trim(java_values($docs[$i]->title));
       
          $arrGame[$i]["image"] = java_values($docs[$i]->image);
          $arrGame[$i]["cate_id"] = java_values($docs[$i]->cate_id);
          $arrGame[$i]["cate_parent_id"] = java_values($docs[$i]->cate_parent_id);
          $arrGame[$i]["user_id"] = java_values($docs[$i]->user_id);
          $arrGame[$i]["price"] = java_values($docs[$i]->price);
          $arrGame[$i]["create_date"] = java_values($docs[$i]->create_date);
          
          $arrGame[$i]["quantity"] = java_values($docs[$i]->quantity);
          $arrGame[$i]["sta_comment"] = java_values($docs[$i]->sta_comment);
          $arrGame[$i]["sta_like"] = java_values($docs[$i]->sta_like);
          $arrGame[$i]["sta_view"] = java_values($docs[$i]->sta_view);
          $arrGame[$i]["lat"] = java_values($docs[$i]->lat);
          $arrGame[$i]["lng"] = java_values($docs[$i]->lng);
          
          $time =  date("Y/md",strtotime($arrGame[$i]["create_date"]));    
         
          if(!empty($arrGame[$i]['image'])){
              $arrImage = json_decode($arrGame[$i]['image']);
              $arrGame[$i]['image'] = baseUrlUpload()."shop/product/".$time."/".$arrImage[0];
          }
          
           /*$like = checkProductFavorite($arrGame[$i]["id"],$arrGame[$i]["user_id"]);
           $arrGame[$i]['like'] = $like;      */
        }
        
        //$total = java_values($searcher->getTotalHit());
       
        //$arrGameKQ["product"]=$arrGame;
        //$page = intval($total/$limit)+($total%$limit>0?1:0);
        //$arrGameKQ["page"] = $page;
        return $arrGame;
  }
  
  function queryProductRecommendNext($keyword,$user_id,$price,$lat,$lon,$page) {
        $limit = 30;
        require_once("http://127.0.0.1:8181/JavaBridge/java/Java.inc");
        $searcher = new java("com.ttv.search.ProductSearch","/home/search/product/");
        //query(String keyword,int cat_id,double priceF,double priceT,double lat, double lng
         //   , double distance ,int order_by ,int page, int rowpage) 
        $page = $page<=0?1:$page;
        $topDocs = $searcher->queryProductRecommendNext($keyword,$user_id,$price,$lat,$lon,$page,$limit,5); 
          
        $docs = java_values($topDocs) ;
         
        $num_row=count($docs);
        
        $arrGame = array();
        $arrGameKQ = array();
        for($i=0;$i<$num_row;$i++)
        {
        
          $arrGame[$i]["id"] = java_values($docs[$i]->id);   
          $arrGame[$i]["title"] =trim(java_values($docs[$i]->title));
       
          $arrGame[$i]["image"] = java_values($docs[$i]->image);
          $arrGame[$i]["cate_id"] = java_values($docs[$i]->cate_id);
          $arrGame[$i]["cate_parent_id"] = java_values($docs[$i]->cate_parent_id);
          $arrGame[$i]["user_id"] = java_values($docs[$i]->user_id);
          $arrGame[$i]["price"] = java_values($docs[$i]->price);
          $arrGame[$i]["create_date"] = java_values($docs[$i]->create_date);
          
          $arrGame[$i]["quantity"] = java_values($docs[$i]->quantity);
          $arrGame[$i]["sta_comment"] = java_values($docs[$i]->sta_comment);
          $arrGame[$i]["sta_like"] = java_values($docs[$i]->sta_like);
          $arrGame[$i]["sta_view"] = java_values($docs[$i]->sta_view);
          $arrGame[$i]["lat"] = java_values($docs[$i]->lat);
          $arrGame[$i]["lng"] = java_values($docs[$i]->lng);
          
          $time =  date("Y/md",strtotime($arrGame[$i]["create_date"]));    
         
          if(!empty($arrGame[$i]['image'])){
              $arrImage = json_decode($arrGame[$i]['image']);
              $arrGame[$i]['image'] = baseUrlUpload()."shop/product/".$time."/".$arrImage[0];
          }
          
           /*$like = checkProductFavorite($arrGame[$i]["id"],$arrGame[$i]["user_id"]);
           $arrGame[$i]['like'] = $like;      */
        }
        
         $total = java_values($searcher->getTotalHit());
       
         $arrGameKQ["product"]=$arrGame;
         $page = intval($total/$limit)+($total%$limit>0?1:0);
         $arrGameKQ["page"] = $page;
         
        return $arrGameKQ;
  }
  
  
    function getProductSwapMatching($user_id)
   {
        $arrProduct = getProductSwapOfUser($user_id) ; 
        $arrProMatching= array();
        foreach($arrProduct as $product){
             $proMs = queryProductRecommendLimit5($product["wish_swap"],$user_id,$product["price"],$product["lat"],$product["lng"],1);
             $product["matching"] =  $proMs;
             $arrProMatching[] = $product;
        }
        return $arrProMatching;
   }
   
    function getItemSwapMatching($user_id,$product_id)
   {
        $product = getProductDetail($product_id) ; 
        
        $proMs = queryProductRecommendLimit5($product["wish_swap"],$user_id,$product["price"],$product["lat"],$product["lng"],1);
        $product["matching"] =  $proMs;
        
        return $product;
   }
   
   function getProductSwapMatchingNext($product_id,$page)
   {
        $product = getProductDetail($product_id) ; 
        $arrProducts = queryProductRecommendNext($product["wish_swap"],$product["user_id"],$product["price"],$product["lat"],$product["lng"],$page);
        return $arrProducts;
   }
   
   function getEventTop()
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $sql = "SELECT     id, title, image, STATUS, type_inform,create_date FROM ms_inform WHERE STATUS = 1
         AND type_inform = 2 Order By id DESC LIMIT  3"; 
        
        $querykey =md5("KEY.getEventTop");
        $result = $meminstance->get($querykey);
        
        if(!($result)){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array());
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $arrEvent = array();
            $i = 0;
            While($row = $q->fetch()) {
                
                 $arrEvent[$i] =  $row;
                 $time =    date("Y/md",strtotime($row['create_date'])); 
                 $arrEvent[$i]["image"] = "http://cp.traodoidi.vn/upload/shop/inform/".$time."/".$row["image"];
                 $i++;
            } 
             
             $connect = null;
             $meminstance->set($querykey, $arrEvent, 0, TIME_60); 
             return $arrEvent;  
        }else{
            
            return $result;
        }
   }
   
     function getInformDetail($inform_id)
    {
        $meminstance = new Memcache();
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);
        
        $sql = "SELECT  id, title, image, content, STATUS, type_inform,create_date FROM ms_inform WHERE STATUS = 1
         AND id =  ?" ;
        $querykey =md5("KEY.getInformDetail");
        $result = $meminstance->get($querykey);
        
        if(!($result)){
            # creating the statement
            $connect = connectDBShop();
            $q = $connect->prepare($sql);
            $q->execute(array($inform_id));
            # setting the fetch mode
            $q->setFetchMode(PDO::FETCH_ASSOC);
            # showing the results
            $event = null;
            
            if($row = $q->fetch()) {     
                 $event =  $row;
                 $time =    date("Y/md",strtotime($row['create_date'])); 
                 $event["image"] = "http://cp.traodoidi.vn/upload/shop/inform/".$time."/".$row["image"];
            
            } 
             
             $connect = null;
             $meminstance->set($querykey, $event, 0, TIME_30); 
             return $event;  
        }else{
            return $result;
        }
   }
   
   function pushEmailQueue($to_email,$to_name,$email_subject,$template_name,$global_merge_vars) {
       $count = 0;    
       try{
            $from_email = "admin@traodoidi.vn";
            $from_name = "Ban quản trị TraoDoiDi.";
            $email_html="";
            $email_text="";
            $template_content ='';
            $connect = connectDBShop(); 
            
            $sql = "INSERT INTO vtc_swaphub.ms_email_queue  (from_email, from_name, to_email, to_name, 
            email_subject, email_html, email_text, template_name, template_content,global_merge_vars,create_date)   
            VALUES (?,?,?,?,?,?,?,?,?,?, NOW())";
            # creating the statement
            $q = $connect->prepare($sql);
            $arrV = array($from_email,$from_name,$to_email,$to_name,$email_subject,$email_html,$email_text
            ,$template_name,$template_content,$global_merge_vars);
            $count = $q->execute($arrV);
            
            $connect = null;
        }catch (Exception $e) { 
          $count = 0;
        }
        
        return $count;           
    }
   
   function deleteCacheCommentProduct($product_id){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);     
         while($i<100){
            $querykey =md5("KEY.getProductComment." .$product_id.".".$i); 
            $meminstance->delete($querykey);
            $i++;
         }
     }
     
     function deleteCacheProductOfUser($user_id){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);     
         while($i<100){
            $querykey =md5("KEY.getProductOfUser." .$user_id.".".$i);   
            $meminstance->delete($querykey);
            $i++;
         }
     }
     
      function deleteCacheProductFavorite($user_id){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);   
        
        $querykey =md5("KEY.getIDProductFavorite." .$user_id);    
        $meminstance->delete($querykey);   
           
         while($i<10){
            $querykey =md5("KEY.getProductFavorite.".$user_id.".".$i);    
            $meminstance->delete($querykey);
            $i++;
         }
     }
     
     function deleteCacheByKey($querykey){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);     
        $meminstance->delete($querykey);
     }
        
      function deleteCacheUserFollowing($user_id){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);     
         while($i<100){
            $querykey = md5("KEY.getUserFollowing".".".$user_id.".".$i);
            $meminstance->delete($querykey);
            $i++;
         }
     }
     
     function deleteCacheUserFollower($user_id){
        $i=0;
        $meminstance = new Memcache();  
        $meminstance->pconnect(SERVER_CACHE_IP, 11211);     
         while($i<100){
            $querykey = md5("KEY.getUserFollower.".$user_id.".".$i);  
            $meminstance->delete($querykey);
            $i++;
         }
     }
    
?>
