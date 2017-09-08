<?php
    class FootBallVideoController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Video','link'=>$url->createUrl("footBallVideo/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Video','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $cup_id = isset($_GET["cup_id"]) ? intval($_GET["cup_id"]):0;
            $club_id = isset($_GET["club_id"]) ? intval($_GET["club_id"]):0;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallVideo::getAllData($from_date,$to_date,$cup_id,$club_id,$keyword,$page,$row_per_page);
            
            $this->render('index',array('data'=>$data,'cup_id'=>$cup_id,'club_id'=>$club_id,'keyword'=>$keyword,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,'count'=>$count,"max_page"=>$max_page));

        }

       
        public function actionGetClubByCountry()
        {
            $country=$_GET['country'];
            $data = FootBallNews::getClubByCountry($country);
            echo json_encode($data);
        }


        public function actionCreate()
        {
            $countryList = FootBallNews::getCountryList();
            $cupList = FootBallNews::getCupByRate(1);
            $arrCup = array();
            $this->breadcrumbs[] = array('name'=>'Thêm mới Video','link'=>'#','class'=>'active');
            $this->render('create',array("countryList"=>$countryList,"cupList"=>$cupList));
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Video','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $countryList = FootBallNews::getCountryList();
            $cupList = FootBallNews::getCupByRate(1);
            $video = FootBallVideo::getVideoByID($id);
            $club = FootBallNews::getClubByID($video["club_id"]);
            $clubList = FootBallNews::getClubByCountry($club["country"]);

            $this->render('edit',array('video'=>$video,'cupList'=>$cupList,'countryList'=>$countryList,'id'=>$id,'clubList'=>$clubList));
        }

        public function actionAjaxSaveVideo()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $title = isset($_POST['title'])? trim(strip_tags(mysql_escape_string($_POST['title']))): "";
            $club_id = isset($_POST['club_id'])? intval($_POST['club_id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $cup_id = isset($_POST['cup_id'])? trim(strip_tags($_POST['cup_id'])): "0";
            $match_id = isset($_POST['match_id'])? trim(strip_tags($_POST['match_id'])): "0";
            $video_up = isset($_POST['video'])? trim(strip_tags($_POST['video'])): "";
            $video_link = isset($_POST['video_link'])? trim(strip_tags($_POST['video_link'])): "";

            $image = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
         
            if($title == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            
            $video = "";
            if($video_up != "") {
                $video = Yii::app()->params['urlImages']."bongda/video/".date('Y/md')."/".$video_up;
            }else{
                $video =$video_link;
            }
            
             if($video == "")
            {
                echo "Chưa upload video hoặc link video"; exit;
            }
            
         
            
            $result = FootBallVideo::insertVideo($title,$description,$image,$video,$cup_id,$club_id,$status,$match_id);
            if($result>0)
            {
                if(intval($match_id)>0) FootBallMatch::updateMatchVideo($match_id,1);
                echo $result;exit;
            }
        }

        public function actionAjaxUpdateVideo()
        {
            $time_now = date('Y-m-d H:i:s');
            $update_user = Yii::app()->user->name;
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $title = isset($_POST['title'])? trim(strip_tags(mysql_escape_string($_POST['title']))): "";
            $club_id = isset($_POST['club_id'])? intval($_POST['club_id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $cup_id = isset($_POST['cup_id'])? trim(strip_tags($_POST['cup_id'])): "0";
            $match_id = isset($_POST['match_id'])? trim(strip_tags($_POST['match_id'])): "0";
            $video_up = isset($_POST['video'])? trim(strip_tags($_POST['video'])): "";
            $video_link = isset($_POST['video_link'])? trim(strip_tags($_POST['video_link'])): "";
            $create_date = isset($_POST['create_date'])? trim(strip_tags($_POST['create_date'])): "";

            $image = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";

            if($title == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            
            $video = "";
            
            if($video_up != "") {
                $video = Yii::app()->params['urlImages']."bongda/video/".date('Y/md')."/".$video_up;
            }else{
                $video =$video_link;
            }
            
             if($video == "")
            {
                echo "Chưa upload video hoặc link video"; exit;
            }

            $result = FootBallVideo::updateVideo($id,$title,$description,$image,$video,$cup_id,$club_id,$status,$match_id,$create_date);
            if($result>0)
            {
                if(intval($match_id)>0) FootBallMatch::updateMatchVideo($match_id,1);
                echo $result;exit;
            }
            else
            {
                echo "Chưa thay đổi dữ liệu"; exit;
            }

        }

        public function actionAjaxDeleteVideo()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $data = FootBallVideo::getVideoByID($id);
            $location = getcwd();
            $location1 = $location.'/upload/bongda/video/'.date('Y/md',strtotime($data['create_date']))."/".$data['image'];
            $video = substr($data["video"],strrpos($data["video"],"/")+1);
            $location2 = $location.'/upload/bongda/video/'.date('Y/md',strtotime($data['create_date']))."/".$video;
          
            @unlink($location1);
            @unlink($location2);
            $result = FootBallVideo::deleteVideo($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $result = FootBallVideo::quickUpdateNews($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }       
        }

        public function actionAjaxGetNotify()
        {
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $type = 3; // Video
            $data = FootBallNotice::getNotice($object_id, $type);
$result = "";
            foreach ($data as $key=>$value)
            {
                $key +=1;
                $result .= "<tr id='". $object_id ."". $value['id'] ."'>";
                $result .= "<td>". $key ."</td>";
                $result .= "<td>". $value['content'] ."</td>";
                if($value['status'] == 0)
                {
                    $result .= "<td>Inactive</td>";
                }
                else
                {
                    $result .= "<td>Active</td>";
                }
                $result .= "<td>". $value['time_sent'] ."</td>";
                $result .= "<td>". $value['create_date'] ."</td>";
                $result .= "<td><a href='javascript:void(0);' onclick='ajaxDeleteNotify(". $value['id'] .",". $object_id ."". $value['id'] .");'>Delete</a></td>";
                $result .= "</tr>";
            }

            echo $result;

        }

        public function actionAjaxDeleteNotify()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";

            $result = FootBallNotice::deleteNotice($id);

            if($result > 0)
            {
                echo $result;
            }
        }

        public function actionAjaxSaveNotify()
        {
            $create_date = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $content = isset($_POST['content'])? trim(strip_tags($_POST['content'])): "";
            $time = isset($_POST['time'])? trim(strip_tags($_POST['time'])): "";
            $type = 3;// Video
            $status = 1;
            $news = FootBallVideo::getVideoByID($object_id);

            $timeCreate =    date("Y/md",strtotime($news['create_date']));  
            if($news['image']!="")
                $news['image'] = "http://kenhkiemtien.com/upload/bongda/video/".$timeCreate."/".$news['image'];
            $icon = $news["image"];



            if($content == "")
            {
                echo "Nội dung không được để trống";exit;
            }
            if($time == "")
            {
                echo "Thời gian gửi không được để trống";exit;
            }
            if(strtotime($time) === false)
            {
                echo "Thời gian gửi không đúng định dạng";exit;
            }

            $result = FootBallNotice::insertNoticeGame($object_id, $content, $type, $status, $time, $create_date, $create_user,$icon);

            if($result>0)
            {
                echo $result;exit;
            }
        }

    }
?>
