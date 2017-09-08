<?php
    require_once("config.php");   
	date_default_timezone_set('Asia/Saigon'); 
    // Get Comic By Category
     function getComicIDs($catId,$page,$limit)
    {
      //  $startRecord = ($page - 1) * $limit;
        $sql = "SELECT   comic_id FROM  c_category_comic WHERE cat_id = ".$catId;
        $result = @mysql_query($sql);
        $arr_audio_id ="0";     

        while($arr = @mysql_fetch_array($result)){
            $arr_audio_id=$arr_audio_id.",".$arr["comic_id"];  
        }
        mysql_free_result($result);
        return $arr_audio_id;
    } 
    
     function getComicIDHots($catId)
    {
       // $startRecord = ($page - 1) * $limit;
        $sql = "SELECT   comic_id FROM  c_category_comic WHERE isHot = 1 And  cat_id = ".$catId;
        $result = @mysql_query($sql);
        $arr_audio_id ="0";     

        while($arr = @mysql_fetch_array($result)){
            $arr_audio_id=$arr_audio_id.",".$arr["comic_id"];  
        }
        mysql_free_result($result);
        return $arr_audio_id;
    } 
    
    function countComic($comicIDS,$appID){
        $condition="";
        if($comicIDS!=""){
            $condition.=" AND id IN(".$comicIDS.")";
        }
        $condition.=" AND ".$appID." & app_ids = ".$appID;
        
        $sql = "SELECT count(id) as count FROM c_comic WHERE 1 And status_view = 1 " . $condition ;

        $result = @mysql_query($sql);
        $count =@mysql_fetch_array($result);

        mysql_free_result($result);
        return $count[0];
    }
    
     function countComicHot($comicIDS,$appID){
        $condition="";
        if($comicIDS!=""){
            $condition.=" AND id IN(".$comicIDS.")";
        }
        $condition.=" AND ".$appID." & app_ids = ".$appID;
        
        $sql = "SELECT count(id) as count FROM c_comic WHERE isHot = 1 And status_view = 1 " . $condition ;
        //echo $sql;

        $result = @mysql_query($sql);
        $count =@mysql_fetch_array($result);

        mysql_free_result($result);
        return $count[0];
    }
    
    function countComicSearch($keyword,$appID){
        $condition="";
        $keyword=convert_vi_to_en($keyword);
        if($keyword!=""){
            $condition.=" AND title_no_sign like '%".$keyword."%'";
        }
        $condition.=" AND ".$appID." & app_ids = ".$appID;
        
        $sql = "SELECT count(id) as count FROM c_comic WHERE 1 And status_view = 1 " . $condition ;
        
       // echo $sql."<br>";;

        $result = @mysql_query($sql);
        $count =@mysql_fetch_array($result);

        mysql_free_result($result);
        return $count[0];
    }
    
    
   function getComicByCategory($appId ,$catId, $orderBy,$limit, $page)
    {
        $startRecord = ($page - 1) * $limit;
        $comicIDS =  getComicIDs($catId,$page,$limit);     
        $totalItem = countComic($comicIDS,$appId); 
        $max_page = ceil(intval($totalItem/$limit))+($totalItem%$limit==0?0:1);
        
        $condition="";
        if($comicIDS!=""){
            $condition.=" AND id IN(".$comicIDS.")";
        }
        $condition.=" AND ".$appId." & app_ids = ".$appId;
        $sql = "SELECT id,title,image,c_chapter,author,tags,hit,isHot,STATUS,get_link_by,price FROM c_comic
           WHERE 1 And status_view = 1 " . $condition . " Order by $orderBy DESC LIMIT " . $startRecord . ", " . $limit;
        $result = @mysql_query($sql);
       // echo $sql."<br>";
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row["image"] =    "http://kenhkiemtien.com" . $row["image"];  
            $rows[] = $row;
        }

        mysql_free_result($result);
        return array($rows,$max_page);   
    }
    
    
    function getComicHotByCategory($appId ,$catId, $orderBy,$limit, $page)
    {
        $startRecord = ($page - 1) * $limit;
        $comicIDS =  getComicIDs($catId,$page,$limit);     
        $totalItem = countComicHot($comicIDS,$appId); 
        $max_page = ceil(intval($totalItem/$limit))+($totalItem%$limit==0?0:1);
        
        $condition="";
        if($comicIDS!=""){
            $condition.=" AND id IN(".$comicIDS.")";
        }
        $condition.=" AND ".$appId." & app_ids = ".$appId;
        $sql = "SELECT id,title,image,c_chapter,author,tags,hit,isHot,STATUS,get_link_by,price FROM c_comic
           WHERE isHot = 1  And status_view = 1 " . $condition . " Order by $orderBy DESC LIMIT " . $startRecord . ", " . $limit;
        $result = @mysql_query($sql);
       // echo $sql."<br>";
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row["image"] =    "http://kenhkiemtien.com" . $row["image"];  
            $rows[] = $row;
        }

        mysql_free_result($result);
        return array($rows,$max_page);   
    }
    
    
    
    function searchComic($appId,$keyword,$limit, $page)
    {
        $catId = 0;
        $keyword=convert_vi_to_en($keyword);
        $startRecord = ($page - 1) * $limit;
        $comicIDS =  getComicIDs($catId,$page,$limit);     
        $totalItem = countComicSearch($keyword,$appId); 
        $max_page = ceil(intval($totalItem/$limit))+($totalItem%$limit==0?0:1);
        
        $condition="";
        if($keyword!=""){
            $condition.=" AND title_no_sign like '%".$keyword."%'"; 
        }
        $condition.=" AND ".$appId." & app_ids = ".$appId;
        
        $sql = "SELECT id,title,image,c_chapter,author,tags,hit,isHot,STATUS,get_link_by,price FROM c_comic
           WHERE 1 And status_view = 1 " . $condition . " Order by id desc LIMIT " . $startRecord . ", " . $limit;
        $result = @mysql_query($sql);
        
       // echo $sql."<br>";
        $rows = array();
        while($row = @mysql_fetch_assoc($result)){
            $row["image"] =    "http://kenhkiemtien.com" . $row["image"];  
            $rows[] = $row;
        }

        mysql_free_result($result);
        return array($rows,$max_page);   
    }
    
    // Get Comic detail info from Kho Truyen
    function getComicDetail($appId,$content_id)
    {   
        $sql ="SELECT id,title,image,c_chapter,author,content,tags,hit,isHot,STATUS,get_link_by,price FROM  c_comic 
         WHERE id = ".$content_id." AND ".$appId." & app_ids = ".$appId ;
        //echo $sql."<br>";
        $result = @mysql_query($sql);    
        $arrs  = @mysql_fetch_assoc($result);
        mysql_free_result($result);    

        $arrs["image"] =    "http://kenhkiemtien.com" . $arrs["image"];    
        return $arrs;
    }  
    
    
     // Get Comic detail info from Tu truyen
    function getComicDetailAndChapter($appId,$content_id)
    {   
        $sql ="SELECT id,title,image,c_chapter,author,content,tags,hit,isHot,STATUS,get_link_by,price FROM  c_comic 
         WHERE id = ".$content_id." AND ".$appId." & app_ids = ".$appId ;
        //echo $sql."<br>";
        $result = @mysql_query($sql);    
        $arr_comic  = @mysql_fetch_assoc($result);
        
         $arr_comic["image"] =    "http://kenhkiemtien.com" . $arr_comic["image"];    
        mysql_free_result($result);  
         
        $sql = "SELECT id,comic_id,title,total_file,create_date FROM c_comic_chapter Where comic_id = ".$content_id." Order by id"; 
        // echo $sql."<br>";
        $result = @mysql_query($sql);  
        $rows_chapter = array();  
        while($row = @mysql_fetch_assoc($result)){
            $rows_chapter[] = $row;
        }

        mysql_free_result($result);      
        return array($arr_comic,$rows_chapter);
    }  
    
    
     // Get Comic detail info from Kho Truyen
    function getComicFile($chapterId,$get_by)
    {   
        $link = $get_by==1?"link":"link_source"; 
        $sql ="SELECT ".$link." FROM c_comic_chapter_file Where chapter_id = ".$chapterId." Order by id " ;
        $result = @mysql_query($sql); 
        $arrs = array(); 
        while($row = @mysql_fetch_array($result)){   
            $arrs[]  = $row[$link];
        }

        mysql_free_result($result);      
        return $arrs;
    }  
    
    
     // Get Comic Index
    function getComicIndex($appId,$orderBy,$limit)
    {   
        $get_by = 2;
        $link = $get_by==1?"link":"link_source"; 
        $sql ="SELECT  id,name FROM   c_category  WHERE STATUS = 1 AND $appId& app_ids = $appId Order by id " ;
       
        $result = @mysql_query($sql); 
        $arrs = array(); 
        $arr_cat = array();  
        while($row = @mysql_fetch_array($result)){  
            $arr_cat["id"] =    $row["id"];
            $arr_cat["name"] =    $row["name"];
            $arr_cat["comics"] = array(); 
            $cat_id = $row["id"];
            
            $sql_2 ="SELECT c.id,c.title,c.image,c.c_chapter,c.author,c.tags,c.hit,c.isHot,c.get_link_by,c.price FROM
                c_comic c LEFT JOIN c_category_comic cat ON c.id = cat.comic_id 
                WHERE  c.status_view = 1 And cat.cat_id = $cat_id AND $appId& c.app_ids = $appId ORDER BY $orderBy DESC LIMIT 2 " ;  
            $result_2 = @mysql_query($sql_2);  
            while($row_comic = @mysql_fetch_assoc($result_2)){
                    $row_comic["image"] =    "http://kenhkiemtien.com" . $row_comic["image"];
                    $arr_cat["comics"][] = $row_comic; 
                 }          
            $arrs[] =    $arr_cat;
        }
        
        mysql_free_result($result);  
        mysql_free_result($result_2);          
        return $arrs;
    }  
    
    
     // Get Comic Index
    function getComicHotIndex($appId,$orderBy,$limit)
    {   
        $get_by = 2;
        $link = $get_by==1?"link":"link_source"; 
        $sql ="SELECT  id,name FROM   c_category  WHERE STATUS = 1 AND $appId& app_ids = $appId Order by id " ;
        
        $result = @mysql_query($sql); 
        $arrs = array(); 
        $arr_cat = array();  
        while($row = @mysql_fetch_array($result)){  
            $arr_cat["id"] =    $row["id"];
            $arr_cat["name"] =    $row["name"];
            $arr_cat["comics"] = array(); 
            $cat_id = $row["id"];
            
            $sql_2 ="SELECT c.id,c.title,c.image,c.c_chapter,c.author,c.tags,c.hit,c.isHot,c.get_link_by,c.price FROM
                c_comic c LEFT JOIN c_category_comic cat ON c.id = cat.comic_id 
                WHERE  c.status_view = 1 And  c.isHot = 1 And cat.cat_id = $cat_id AND $appId& c.app_ids = $appId ORDER BY $orderBy DESC LIMIT 2 " ;  
            $result_2 = @mysql_query($sql_2);  
            while($row_comic = @mysql_fetch_assoc($result_2)){
                    $row_comic["image"] =    "http://kenhkiemtien.com" . $row_comic["image"];  
                    $arr_cat["comics"][] = $row_comic; 
                 }          
            $arrs[] =    $arr_cat;
        }
        
        mysql_free_result($result);  
        mysql_free_result($result_2);          
        return $arrs;
    }  
     
    
     // Update comic hit
    function setComicHit($comicId)
    {   
        $sql ="Update c_comic SET hit = hit + 1 Where id =  $comicId " ;
        @mysql_query($sql);   
    }  
    
    // save comic payment
    function saveComicPayment($comicId,$userId,$exp_date)
    {   
        $create_date = time();
        $sql ="INSERT INTO c_comic_payment (content_id, user_id,exp_date,create_date,modify_date) VALUES  (
        $comicId,$userId,$exp_date,$create_date,$create_date) " ;
        @mysql_query($sql);    
    }  
    
     // Update exp_date 
     function updateExpDate($paymentId,$expDate)
    {   
        $sql ="Update c_comic_payment SET exp_date =  $expDate  Where id =  $paymentId " ;
        @mysql_query($sql);   
    }  
    
     // save customer_id 
    function saveCustomerId($os,$app_header_id)
    {   
        $create_date = time();
        $sql ="INSERT INTO c_customer_id (os,app_header_id) VALUES ($os,$app_header_id) " ;
        @mysql_query($sql);    
        $id = mysql_insert_id();
        return $id;
    }  
    
    // check customerId 
    function getAppHeader($app_header)
    {   
        $sql ="SELECT  id,app_header,type_payment,os,isFree,sms_confirm,sms_mcv,version,link_update,sms FROM c_app_header WHERE app_header = '$app_header' " ;
        $result =  @mysql_query($sql);  
        $arr = array();    
        if($row = @mysql_fetch_assoc($result)){
            $arr =  $row;
        }
        mysql_free_result($result);          
        return $arr;   
    }  
    
    
     // get exp_date  
    function getExpDate($user_id)
    {   
        $sql ="SELECT  exp_date FROM c_comic_payment WHERE user_id = $user_id and exp_date > 0   Order by Id Desc limit 1 " ;
        $result =  @mysql_query($sql);  
        $exp_date =0;
        if($row = @mysql_fetch_assoc($result)){
            $exp_date =  $row[1];
        }
        
        mysql_free_result($result);          
        return $exp_date;   
    } 
    
     // get exp_date  
    function getPaymentByTime($user_id)
    {   
        $sql ="SELECT  id,content_id,user_id,exp_date  FROM c_comic_payment WHERE user_id = $user_id and exp_date > 0   Order by Id Desc limit 1 " ;
        $result =  @mysql_query($sql);  
        $arr = array();    
        if($row = @mysql_fetch_assoc($result)){
            $arr =  $row;
        }
        mysql_free_result($result);          
        return $arr;   
    }   
    
    // check comic payment
    function checkComicPayment($app_header,$content_id,$userId)
    {   
        $appHeader=getAppHeader($app_header);
        $isFree = $appHeader["isFree"];   
        if($isFree==1) return 1;
        $typePayment = $appHeader["type_payment"];
        $kq = 0;
        switch($typePayment){
            case 1:
                 $sql ="SELECT exp_date FROM c_comic_payment Where content_id = 0 And user_id =  $userId Order By id DESC Limit 1 " ;
                 $result =  @mysql_query($sql);  
                 if($row = @mysql_fetch_assoc($result)){
                    $exp_date = $row["exp_date"];
                    $kq = time()<$exp_date?1:0 ;
                 }
                 mysql_free_result($result);       
                 break;
             case 2:
                 $sql ="SELECT id FROM c_comic_payment Where content_id = $content_id And user_id =  $userId " ;
                 $result =  @mysql_query($sql);  
                 $num_rows = mysql_num_rows($result);
                 $kq =  $num_rows>0?1:0;
                 mysql_free_result($result);       
                  
                 break;
             default:
               $kq = 0;
                break;
        }
        return  $kq;
    }  
    
    // Get comic category
     function getCategory($appId,$type)
    {
        $sql = "SELECT id,name,picture,create_date FROM c_category WHERE status = 1 AND type=".$type." AND ".$appId." & app_ids = ".$appId." ORDER BY id ASC"; 
        $result = @mysql_query($sql); 
   
        $arr = array();    
        while($row = @mysql_fetch_assoc($result)){
            $arr[] =  $row;
            if($row['picture']!="")
            $arr[]['picture'] = "http://kenhkiemtien.com/upload/category/".date("Y/md",$row['create_date'])."/".$row['picture'];
        }
        mysql_free_result($result);          
        return $arr;   
    }  
    
    
     function convert_vi_to_en($str) {
        $str = preg_replace("/(Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ)/", 'a', $str);
        $str = preg_replace("/(Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»�|áº¿|á»‡|á»ƒ|á»…)/", 'e', $str);
        $str = preg_replace("/(Ã¬|Ã­|á»‹|á»‰|Ä©)/", 'i', $str);
        $str = preg_replace("/(Ã²|Ã³|á»�|á»�|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»�|á»›|á»£|á»Ÿ|á»¡)/", 'o', $str);
        $str = preg_replace("/(Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯)/", 'u', $str);
        $str = preg_replace("/(á»³|Ã½|á»µ|á»·|á»¹)/", 'y', $str);
        $str = preg_replace("/(Ä‘)/", 'd', $str);
        $str = preg_replace("/(Ã€|Ã�|áº |áº¢|Ãƒ|Ã‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´)/", 'A', $str);
        $str = preg_replace("/(Ãˆ|Ã‰|áº¸|áºº|áº¼|ÃŠ|á»€|áº¾|á»†|á»‚|á»„)/", 'E', $str);
        $str = preg_replace("/(ÃŒ|Ã�|á»Š|á»ˆ|Ä¨)/", 'I', $str);
        $str = preg_replace("/(Ã’|Ã“|á»Œ|á»Ž|Ã•|Ã”|á»’|á»�|á»˜|á»”|á»–|Æ |á»œ|á»š|á»¢|á»ž|á» )/", 'O', $str);
        $str = preg_replace("/(Ã™|Ãš|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®)/", 'U', $str);
        $str = preg_replace("/(á»²|Ã�|á»´|á»¶|á»¸)/", 'Y', $str);
        $str = preg_replace("/(Ä�)/", 'D', $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
    
   // echo convert_vi_to_en("kênh kiếm tiền đồ chơi");
    // Tesst;
   // echo 64;
   // $appId=64;
   // $comicIDS =  getComicIDs(52);
   //echo countComic($comicIDS,$appId)."<br>";
   // getComic(52, 1, 10,"create_date",$appId)     ;
   //getComicDetailAndChapter(1,$appId) ;
   //getComicFile(1,2);
   // getComicIndex(64,"id",2);
   // getCategory($appId,6);
  // getComicByCategory(64 ,"52", "id",2, 1) ;
   //countComicSearch("vua",$appId);
  // searchComic($appId,'vua',10,1);
?>