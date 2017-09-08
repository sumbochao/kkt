#!/usr/bin/php5
<?php
   $connect=null;
  
   function conection(){
        $connect = @mysql_connect('27.118.18.223', 'uvtc_kkt2012', 'pvtc_@)!@kkt');
        if (!$connect) die('Could not connect: ' . mysql_error());    
        @mysql_select_db('vtc_kenhkiemtien', $connect);
        @mysql_query("SET NAMES 'utf8'");          
   }
   
   function insertVideo($row)
    {   
        $create_date = time();
        $id = $row["id"];
        $userId = $row["userId"];
        $categoryId = $row["categoryId"];
        $title = $row["title"];
        $title_sms = $row["title_sms"];
        $alias = $row["alias"];
        $picture = $row["picture"];
        $picture_320_240 = $row["picture_320_240"];
        $picture_240_320 = $row["picture_240_320"];
        $introtext = $row["introtext"];
        $file = $row["file"];
        $file_mp4 = $row["file_mp4"];
        $link = $row["link"];
        $link_mp4 = $row["link_mp4"];
        $download = $row["download"];
        $hit = $row["hit"];
        $STATUS = $row["status"];
        $create_date = $row["create_date"];
        $update_date = $row["update_date"];
        $isHot = $row["isHot"];
        $date_of_hot = $row["date_of_hot"];
        $isHome = $row["isHome"];
        $date_of_home = $row["date_of_home"];
        $isHotApp = $row["isHotApp"];
        $date_of_hot_app = $row["date_of_hot_app"];
        $create_user = $row["create_user"];
        $update_user = $row["update_user"];
        $meta_title = $row["meta_title"];
        $meta_keyword = $row["meta_keyword"];
        $meta_description = $row["meta_description"];
        $time_download = $row["time_download"];
        $like_counter = $row["like_counter"];
        $price = $row["price"];
        $app_ids = $row["app_ids"];
        $duration = $row["duration"];
        
        conection();
    
        $sql ="INSERT INTO c_video (id,userId,categoryId,title, title_sms,alias,picture,picture_320_240, 
    picture_240_320, introtext,file,file_mp4,link,link_mp4,download,hit,status,create_date,update_date, 
    isHot,date_of_hot,isHome,date_of_home,isHotApp,date_of_hot_app,create_user,update_user,meta_title,
    meta_keyword,meta_description,time_download,like_counter,price,app_ids,duration )
    VALUES ($id,'$userId',$categoryId,'$title','$title_sms','$alias','$picture','$picture_320_240','$picture_240_320','$introtext','$file','$file_mp4','$link','$link_mp4',$download,$hit,$STATUS,'$create_date','$update_date',$isHot,'$date_of_hot',$isHome,''$date_of_hot'',$isHotApp,''$date_of_hot_app'','$create_user','$update_user','$meta_title','$meta_keyword','$meta_description','$time_download','$like_counter',$price,$app_ids,'$duration')" ;
        @mysql_query($sql); 
        @mysql_close($connect);   
    }  
    
    function getMaxId(){
        conection();
        $sql  = "Select max(id) From c_video";
        $result = @mysql_query($sql);
        $count =@mysql_fetch_array($result);
        mysql_free_result($result);
        @mysql_close($connect);   
        return $count[0];
    }
    
    // Sync Video
    $maxId = getMaxId();
    echo $maxId;
    
    require_once("/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/config.php");
    require_once("/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/kkt_api/functions.php");
    $rowVideos =  GetAllVideoSync($maxId);
   
    foreach($rowVideos as $i=>$row){
         echo $row["id"]."-".$row["title"];
         insertVideo($row);
      }
    
     
?>
