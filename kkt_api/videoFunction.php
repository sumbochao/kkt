<?php
  function getAllVideoMp4(){
        $sql = "SELECT categoryId,title,picture_320_240,file_mp4,create_date FROM c_video WHERE 1 ORDER BY create_date DESC";
        $result = @mysql_query($sql);   
        while($row = @mysql_fetch_assoc($result)){
            $row['file_mp4'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$row['create_date'])."/".$row['file_mp4'];
            $row['picture_320_240'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$row['create_date'])."/".$row['picture_320_240'];
            unset($row['create_date']);
            $rows[] = $row;
        }
        //$arr1 = array();
//        foreach($rows1 as $key =>$value){
//            $value['picture'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$value['create_date'])."/".$value['picture'];
//            $value['picture_240_320'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$value['create_date'])."/".$value['picture_240_320'];
//            $value['picture_320_240'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$value['create_date'])."/".$value['picture_320_240'];
//            $value['file'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$value['create_date'])."/".$value['file'];
//            $value['file_mp4'] = "http://kenhkiemtien.com/upload/video/".date("Y/md",$value['create_date'])."/".$value['file_mp4'];
//            $arr1[$key] = $value;
//        }
        return $rows;
    }
?>
