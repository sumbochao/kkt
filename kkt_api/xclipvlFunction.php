<?php
    date_default_timezone_set('Asia/Saigon'); 
    require_once("config.php");   
    require_once("MobileDetect.php");
    // Get Comic By Category

    function osDetect(){
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
        if($isIOS ==false && $isAndroid ==false && $isMobile==1  ){
            $isJava=true;
        }
        if($isIOS == true){
            $osType="ios";
        }else if($isAndroid == true){
                $osType="android";
            }else if($isJava == true){
                    $osType="java";
                }else{
                    $osType="web";
        }
        return $mobile ;    
    }
    function getHtmlApp()
    {   
        $arr_apps = array(
        1=>array("title"=>"V-clip","picture"=>"http://kenhkiemtien.com/upload/app/2013/0527/icon-vclip.png","introtext"=>"Tải và cài đặt miễn phí, giải trí với những clip hài hước, nóng hổi, đặc sắc nhất và được cập nhật liên tục.","link_down"=>"http://10h.vn/download.jsp?file=minh/vClip.plist,http://10h.vn/download.jsp?file=minh/vClip.apk,http://10h.vn/download.jsp?file=minh/vClip.jar")
        ,2=>array("title"=>"Truyện Audio 18+ - Truyện Ma","picture"=>"http://kenhkiemtien.com/upload/app/2013/0524/icon_truyenaudio_2001.png","introtext"=>"Truyện Audio là ứng dụng nghe đọc truyện trực tuyến qua wifi, 3G.","link_down"=>"http://10h.vn/download.jsp?file=minh/audio.v1.0.plist,http://10h.vn/download.jsp?file=minh/audio.v1.0.apk,http://10h.vn/download.jsp?file=minh/audio.v1.0.jar")
        ,3=>array("title"=>"Sms Kute Tổng Hợp","picture"=>"http://kenhkiemtien.com/upload/app/2013/0524/icon_smskute_2001.png","introtext"=>"Tổng hợp hàng trăm mẫu tin nhắn sms nghộ nghĩnh tặng bạn bè, người thân yêu nhân dịp Sinh nhật, Lễ tình yêu, SMS Chào buổi sáng, Chúc ngủ ngon, SMS Tình yêu, Noel... ","link_down"=>"http://10h.vn/download.jsp?file=minh/SMSCute.plist,http://10h.vn/download.jsp?file=minh/SMSCute.apk,http://10h.vn/download.jsp?file=minh/SMSCute.jar")
        ,4=>array("title"=>"Nghe nhạc và Cài nhạc chờ","picture"=>"http://kenhkiemtien.com/upload/app/2013/0524/icon_sms_nhac_cho2_appota.png","introtext"=>"Ứng dụng nghe nhạc online, tải nhạc miễn phí. Đặc biệt, với thuê bao Viettel có thể cài đặt và gửi tặng nhạc chờ. Với hàng nghìn bài hát hay và đang được cập nhật liên tục.","link_down"=>"http://10h.vn/download.jsp?file=minh/vMusic.plist,http://10h.vn/download.jsp?file=minh/vMusic.apk")
        ,5=>array("title"=>"Phân tích Kết quả Xổ Số","picture"=>"http://kenhkiemtien.com/upload/app/2013/0524/icon_10h3.png","introtext"=>"Ứng dụng cung cấp kết quả xổ số nhanh nhất, tường thuật trực tiếp KQXS hàng ngày, Soi cầu - Dự đoán kết quả xổ số cực kỳ chính xác. ","link_down"=>"http://10h.vn/download.jsp?file=minh/XoSo.plist,http://10h.vn/download.jsp?file=minh/XoSo.apk")
        );
        $html='';
        if($arr_apps)
            foreach($arr_apps as $row)
            {   
                $link_detail="";
                $link_file_app="";
                //            $link_file_app=Url::createUrl('kktGame/download',array('alias'=>$row['alias'],'game_id'=>$row['id']));
                //            $link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
                $link_img=$row['picture'];
                $img_error='http://kenhkiemtien.com/themes/images/farmvui52.png';
                $arr_link = explode(",",$row['link_down']);
                $link_ios=$arr_link[0];
                $link_android=$arr_link[1];
                if(count($arr_link)>2){
                    $link_java = '|<a class="download clorage" href="'.$arr_link[2].'">&nbsp &nbspJava&nbsp&nbsp</a>';
                }else{
                    $link_java='';
                }
                $icon_hot='<img alt="icon hot" class="ic_hot" src="http://kenhkiemtien.com/themes/images/icon_hot.gif">';

                $html.='<tr>
                <td width="52">
                <a href="'.$link_detail.'" title="'.$row['title'].'">
                <img src="'.$link_img.'" alt="'.$row['title'].'" class="img52" onerror="this.src=\''.$img_error.'\'">
                </a>
                </td>
                <td valign="top" class="item_data">
                <a href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'<br>
                <span class="cl666">'.$row['introtext'].'</span>
                <br>
                <a class="download clorage" href="'.$link_ios.'">&nbsp &nbspIOS&nbsp&nbsp</a>|<a class="download clorage" href="'.$link_android.'">&nbsp&nbspAndroid&nbsp&nbsp'.$link_java.'
                </td>
                </tr>';
        }
        return $html;
    } 
    function getHtmlBoxKenh18($osType)
    {
        $sub_sql='status=1 AND categoryId =18 ';
        $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_video WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT 5";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }

        $html = "";
        if($rows)
        {   
            $html.='<div class="kenh18"><h2 class="bg_green"><strong>Video</strong></h2>';

            $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html.=genHtmlVideo($rows,$osType);

            $link_kenh18='http://xclipvl.com/clip/hot-nhat';
            $html.='</table><div align="center"><span class="view_more" ><a href="'.$link_kenh18.'" class="clwhite">+ Xem tiếp</a></span></div></div>';

        } 
        return $html;
    }
    function genHtmlVideo($video,$osType)
    {   
        $html='';
        if($video)
            foreach($video as $row)
            {   
                if($osType =="ios"){
                    $link_download="http://10h.vn/download.jsp?file=minh/vClip.plist";
                    $link_detail="http://10h.vn/download.jsp?file=minh/vClip.plist";
                } else if($osType =="android"){
                        $link_download="http://10h.vn/download.jsp?file=minh/vClip.apk";
                        $link_detail="http://10h.vn/download.jsp?file=minh/vClip.apk";
                    }else{
                        $link_download="http://10h.vn/download.jsp?file=minh/vClip.jar";
                        $link_detail="http://10h.vn/download.jsp?file=minh/vClip.jar";
                }
                //                    $link_detail="";
                //                    $link_download=Url::createUrl('kktVideo/download',array('video_id'=>$row['id'],'alias'=>$row['alias']));
                //                    $link_img=Common::getImage($row['picture'],'video',$row['create_date'],'');
                //                    $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';

                $link_img = 'http://kenhkiemtien.com/upload/video/'.date('Y', $row['create_date']).'/'.date('md', $row['create_date']).'/'.$row['picture'];
                $img_error='http://kenhkiemtien.com/theme/images/farmvui52.png';
                if($row['isHot']==1)
                {
                    $icon_hot='<img alt="icon hot" class="ic_hot" src="http://kenhkiemtien.com/themes/images/icon_hot.gif">';
                }
                else
                {
                    $icon_hot='<img alt="icon hot" class="ic_new2" src="http://kenhkiemtien.com/themes/images/icon_new2.png">';
                }
                $html.='<tr>
                <td width="52">
                <a href="'.$link_detail.'" title="'.$row['title'].'">
                <img src="'.$link_img.'" alt="'.$row['title'].'" width="100" height ="100" onerror="this.src=\''.$img_error.'\'">
                </a>
                </td>
                <td valign="top" class="item_data">
                <a class="ic_video" target="_blank" href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
                <br />
                <span class="cl666">'.$row['introtext'].'</span>
                <br>                            
                <a class="download clorage" target="_blank" href="'.$link_download.'">Tải miễn phí</a>
                </td>
                </tr>';
        }
        return $html;
    }
    function getHotVideo($page,$num_per_page,$osType)
    {

        $sub_sql='status=1 AND isHot=1';
        $sql1='SELECT count(id) as total FROM c_video WHERE '.$sub_sql.'';
        $result1 = @mysql_query($sql1);
        $arrs  = @mysql_fetch_assoc($result1);
        $total=$arrs['total'];
        $num_page=ceil($total/$num_per_page);
        $begin = ($page - 1) * $num_per_page;
        

        $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_video WHERE ".$sub_sql." ORDER BY date_of_hot DESC LIMIT ".$begin.",".$num_per_page."";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html='';
        $html.=genHtmlVideo($rows,$osType);
        return array($html,$num_page);
        
    }
    function getHtmlBoxAlbum($osType)
    {
        $sub_sql='status=1 AND isHome=1';
        $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY date_of_home DESC LIMIT 5";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html = "";
        if($rows){
            $html.='<div class="clip_vewing bottom10"><h2 class="bg_green"><strong>Ảnh nóng</strong></h2>';

            $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
            $html.=genHtmlAlbum($rows,$osType);

            $link_album="http://xclipvl.com/anh-sexy";
            $html.='</table><div align="center"><span class="view_more" ><a href="'.$link_album.'" class="clwhite">+ Xem tiếp</a></span></div></div>';
        }
        return $html;
    }

    function genHtmlAlbum($album,$osType){
        $html='';
        if($album)
            foreach($album as $row)
            {   
                if($osType =="ios"){
                    $link_download="http://10h.vn/download.jsp?file=minh/vClip.plist";
                    $link_detail="http://10h.vn/download.jsp?file=minh/vClip.plist";
                } else if($osType =="android"){
                        $link_download="http://10h.vn/download.jsp?file=minh/vClip.apk";
                        $link_detail="http://10h.vn/download.jsp?file=minh/vClip.apk";
                    }else{
                        $link_download="http://10h.vn/download.jsp?file=minh/vClip.jar";
                        $link_detail="http://10h.vn/download.jsp?file=minh/vClip.jar";
                }
                //          $link_detail=Url::createUrl('kktAlbum/detail',array('alias'=>$row['alias'],'album_id'=>$row['id']));
                //            $link_download=Url::createUrl('kktAlbum/download',array('album_id'=>$row['id'],'alias'=>$row['alias']));
                // $link_img=Common::getImage($row['picture'],'image',$row['create_date'],'');
                // $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
                $link_img = 'http://kenhkiemtien.com/upload/image/'.date('Y', $row['create_date']).'/'.date('md', $row['create_date']).'/'.$row['picture'];
                $img_error='http://kenhkiemtien.com/theme/images/farmvui52.png';
                if($row['isHot']==1)
                {
                    $icon_hot='<img alt="icon hot" class="ic_hot" src="http://kenhkiemtien.com/themes/images/icon_hot.gif">';
                }
                else
                {
                    $icon_hot='<img alt="icon hot" class="ic_new2" src="http://kenhkiemtien.com/themes/images/icon_new2.png">';
                }
                $html.='<tr>
                <td width="52">
                <a href="'.$link_detail.'" title="'.$row['title'].'">
                <img src="'.$link_img.'" alt="'.$row['title'].'" width="100" height ="100" onerror="this.src=\''.$img_error.'\'">
                </a>
                </td>
                <td valign="top" class="item_data">
                <a class="ic_pic" target="_blank" href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
                <br />
                <span class="cl666">'.$row['introtext'].'</span>
                <br>
                <a class="download clorage" target="_blank" href="'.$link_download.'">Tải miễn phí</a>
                </td>
                </tr>';
        }
        return $html;
    }
    function getLatestAlbum($page,$num_per_page,$osType)
    {
        $sub_sql='status=1';
        $sql1='SELECT count(id) as total FROM c_album WHERE '.$sub_sql.'';
        $result1 = @mysql_query($sql1);
        $arrs  = @mysql_fetch_assoc($result1);
        $total=$arrs['total'];
        $num_page=ceil($total/$num_per_page);
        $begin = ($page - 1) * $num_per_page;

        $sql="SELECT id,title,alias,introtext,picture,download,hit,create_date,isHot FROM c_album WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html='';
        $html.=genHtmlAlbum($rows,$osType);
        return array($html,$num_page);

    }
    function getHtmlBoxNews($osType)
    {
        $sub_sql='status=1 AND isHome=1';
        $sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY date_of_home DESC LIMIT 5";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html = "";
        if($rows){
            $html.='<div class="news_hot"><h2 class="bg_green"><strong>Tin hot</strong></h2>';
            if($rows)
            {
                $html.='<div class="table list_table"><table width="100%" cellspacing="0" cellpadding="0" border="0">';
                $html.=genHtmlNews($rows,$osType);
            }
            $link_news='http://xclipvl.com/tin-tuc';
            $html.='</table><div align="center"><span class="view_more" ><a href="'.$link_news.'" class="clwhite">+ Xem tiếp</a></span></div></div>';
        }
        return $html;
    }
    function getLatestNews($page,$num_per_page,$osType)
    {       
        $sub_sql='status=1';
        $sql1='SELECT count(id) as total FROM c_news WHERE '.$sub_sql.'';
        $result1 = @mysql_query($sql1);
        $arrs  = @mysql_fetch_assoc($result1);
        $total=$arrs['total'];
        $num_page=ceil($total/$num_per_page);
        $begin = ($page - 1) * $num_per_page;

        $sql="SELECT id,title,alias,introtext,picture,hit,create_date,isHot FROM c_news WHERE ".$sub_sql." ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html='';
        $html.=genHtmlNews($rows,$osType);
        return array($html,$num_page);
    }
    function genHtmlNews($news,$osType)
    {
        $html='';
        if($news)
            foreach($news as $row)
            {   

                $link_detail="http://xclipvl.com/kktNews/detail?new_id=".$row['id'];
                $link_download='';  


                $link_img = 'http://kenhkiemtien.com/upload/news/'.date('Y', $row['create_date']).'/'.date('md', $row['create_date']).'/'.$row['picture'];
                $img_error='http://kenhkiemtien.com/theme/images/farmvui52.png';
                if($row['isHot']==1)
                {
                    $icon_hot='<img alt="icon hot" class="ic_hot" src="http://kenhkiemtien.com/themes/images/icon_hot.gif">';
                }
                else
                {
                    $icon_hot='<img alt="icon hot" class="ic_new2" src="http://kenhkiemtien.com/themes/images/icon_new2.png">';
                }
                $html.='<tr>
                <td width="52">
                <a href="'.$link_detail.'" title="'.$row['title'].'">
                <img src="'.$link_img.'" alt="'.$row['title'].'" width="100" height ="100"  onerror="this.src=\''.$img_error.'\'">
                </a>
                </td>
                <td valign="top" class="item_data">
                <a class="ic_news"  href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
                <br>
                <span class="cl666">'.$row['introtext'].'</span>
                <br />
                <span class="cl999">'.$row['hit'].' Lượt xem</span>
                </td>
                </tr>';
        }
        return $html;
    }
    function getNewsById($new_id)
    {   
        $sql="SELECT * FROM c_news WHERE id=".$new_id." AND status=1";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
    function getAudio18($page,$num_per_page,$osType){
        $sql2='SELECT count(id) as total FROM c_category_story_audio WHERE  cat_id =34 OR cat_id =33 ';
        $result2 = @mysql_query($sql2);
        $count  = @mysql_fetch_assoc($result2);
        $total=$count['total'];
        $num_page=ceil($total/$num_per_page);
        $begin = ($page - 1) * $num_per_page;
        
        $sql1='SELECT story_audio_id FROM c_category_story_audio WHERE  cat_id =34 OR cat_id =33 ';
        $result1 = @mysql_query($sql1);
        $arrs="0";
        while($arr = @mysql_fetch_assoc($result1)){
            $arrs .= "," . $arr['story_audio_id']   ; 
        }
        $sql="SELECT id,title,image,author,c_listen,c_download,c_chapter,description,create_date FROM c_story_audio WHERE id IN (".$arrs.") ORDER BY create_date DESC LIMIT ".$begin.",".$num_per_page."";
        $result = @mysql_query($sql);
        while($row = @mysql_fetch_assoc($result)){
            $rows[] = $row;
        }
        $html='';
        $html.=genHtmlAudio($rows,$osType);
        return array($html,$num_page);
    }
    function genHtmlAudio($audio,$osType){
        $html='';
        if($audio)
            foreach($audio as $row)
            {   
                if($osType =="ios"){
                    $link_download="http://10h.vn/download.jsp?file=minh/audio.v1.0.plist";
                    $link_detail="http://10h.vn/download.jsp?file=minh/audio.v1.0.plist";
                } else if($osType =="android"){
                        $link_download="http://10h.vn/download.jsp?file=minh/audio.v1.0.apk";
                        $link_detail="http://10h.vn/download.jsp?file=minh/audio.v1.0.apk";
                    }else{
                        $link_download="http://10h.vn/download.jsp?file=minh/audio.v1.0.jar";
                        $link_detail="http://10h.vn/download.jsp?file=minh/audio.v1.0.jar";
                }
                $link_img = 'http://kenhkiemtien.com/upload/audio/'.date('Y', $row['create_date']).'/'.date('md', $row['create_date']).'/'.$row['image'];
                $img_error='http://kenhkiemtien.com/theme/images/farmvui52.png';
                //if($row['isHot']==1)
                //                {
                $icon_hot='<img alt="icon hot" class="ic_hot" src="http://kenhkiemtien.com/themes/images/icon_hot.gif">';
                // }
                //                else
                //                {
                //                    $icon_hot='<img alt="icon hot" class="ic_new2" src="http://kenhkiemtien.com/themes/images/icon_new2.png">';
                //                }
                $html.='<tr>
                <td width="52">
                <a href="'.$link_detail.'" title="'.$row['title'].'">
                <img src="'.$link_img.'" alt="'.$row['title'].'" width="100" height ="100" onerror="this.src=\''.$img_error.'\'">
                </a>
                </td>
                <td valign="top" class="item_data">
                <a class="ic_pic" target="_blank" href="'.$link_detail.'"><strong>'.$row['title'].'</strong></a>'.$icon_hot.'
                <br />
                <span class="cl666">'.getIntroText($row['description'],200,"...").'</span>
                <br>
                <a class="download clorage" target="_blank" href="'.$link_download.'">Tải miễn phí</a>
                </td>
                </tr>';
        }
        return $html;
    }
    function getIntroText($str,$len,$more){
        if ($str=="" || $str==NULL) 
            return $str;
        if (is_array($str)) 
            return $str;
        $str = trim($str);
        if (strlen($str) <= $len) 
            return $str;
        $str = substr($str,0,$len);
        if ($str != "") 
        {
            if (!substr_count($str," ")) 
            {
                if ($more) 
                    $str .= " ...";
                return $str;
            }
            while(strlen($str) && ($str[strlen($str)-1] != " ")) 
            {
                $str = substr($str,0,-1);
            }
            $str = substr($str,0,-1);
            if ($more) 
                $str .= " ...";
        }
        return $str;
    }
?>