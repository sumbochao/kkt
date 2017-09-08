<?php
    class FootBallNewsController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Tin tức','link'=>$url->createUrl("gsnews/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Tin tức','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $cup_id = isset($_GET["cup_id"]) ? intval($_GET["cup_id"]):0;
            $club_id = isset($_GET["club_id"]) ? intval($_GET["club_id"]):0;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;

            list($max_page,$count,$data) = FootBallNews::getAllData($from_date,$to_date,$cup_id,$club_id,$keyword,$page,$row_per_page);
          
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
            $this->breadcrumbs[] = array('name'=>'Thêm mới Tin tức','link'=>'#','class'=>'active');
            $this->render('create',array("countryList"=>$countryList,"cupList"=>$cupList));
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Cập nhật Tin tức','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $countryList = FootBallNews::getCountryList();
            $cupList = FootBallNews::getCupByRate(1);
            $news = FootBallNews::getNewsById($id);
            $club = FootBallNews::getClubByID($news["club_id"]);
            $clubList = FootBallNews::getClubByCountry($club["country"]);

            $this->render('edit',array('news'=>$news,'cupList'=>$cupList,'countryList'=>$countryList,'id'=>$id,'clubList'=>$clubList));
        }

        public function actionAjaxSaveNews()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $title_news = isset($_POST['title_news'])? trim(strip_tags(mysql_escape_string($_POST['title_news']))): "";

            $club_id = isset($_POST['club_id'])? intval($_POST['club_id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $cup_id = isset($_POST['cup_id'])? trim(strip_tags($_POST['cup_id'])): "0";
            $lang_id = isset($_POST['lang_id'])? trim(strip_tags($_POST['lang_id'])): "0";

            $image = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
            $content = mysql_escape_string(isset($_POST['content'])? trim($_POST['content']): "");

            if($title_news == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }


            $result = FootBallNews::insertNews($title_news,$description,$content,$image,$lang_id,$cup_id,$club_id,$status);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxUpdateNews()
        {
            $time_now = date('Y-m-d H:i:s');
            $update_user = Yii::app()->user->name;
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $title_news = isset($_POST['title_news'])? trim(strip_tags(mysql_escape_string($_POST['title_news']))): "";

            $club_id = isset($_POST['club_id'])? intval($_POST['club_id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $cup_id = isset($_POST['cup_id'])? trim(strip_tags($_POST['cup_id'])): "0";
            $lang_id = isset($_POST['lang_id'])? trim(strip_tags($_POST['lang_id'])): "0";

            $image = isset($_POST['picture'])? trim(mysql_escape_string($_POST['picture'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
            $content = mysql_escape_string(isset($_POST['content'])? trim($_POST['content']): "");
            $create_date = mysql_escape_string(isset($_POST['create_date'])? trim($_POST['create_date']): "");    

            if($title_news == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }

            $result = FootBallNews::updateNews($id,$title_news,$description,$content,$image,$lang_id,$cup_id,$club_id,$status,$create_date);
            if($result>0)
            {
                echo $result;exit;
            }
            else
            {
                echo "Chưa thay đổi dữ liệu"; exit;
            }

        }

        public function actionAjaxDeleteNews()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $data = FootBallNews::getNewsById($id);
            $location = getcwd();
            $location1 = $location.'/upload/bongda/news/'.date('Y/md',strtotime($data['create_date']))."/".$data['image'];
            @unlink($location1);
            $result = FootBallNews::deleteNews($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $result = FootBallNews::quickUpdateNews($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }       
        }

        public function actionComment()
        {
            $this->breadcrumbs[] = array('name'=>'DS Comment Tin Tức','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $news_id = isset($_GET['discussion'])? trim(mysql_escape_string($_GET['new'])): "";
            $keyword = isset($_GET['keyword'])? trim(mysql_escape_string($_GET['keyword'])): "";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GCommentNews::getAllComment($id,$news_id,$keyword,$page,$row_per_page);
            $this->render('comment',array('data'=>$data,'news_id'=>$news_id,'keyword'=>$keyword,'page'=>$page,'max_page'=>$max_page,'count'=>$count));
        }

        public function actionDeleteComment()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GCommentNews::deleteComment($id);

            if($result>0)
            {
                echo 1;exit;
            }
        }

        public function actionUpdateComment()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $result = GCommentNews::updateComment($id,$status);
            if($result>0)
            {
                echo 1;exit;
            }
        }

        public function actionAjaxGetNotify()
        {
            $object_id = isset($_POST['object_id'])? trim(mysql_escape_string($_POST['object_id'])): "";
            $object_type = isset($_POST['object_type'])? trim(mysql_escape_string($_POST['object_type'])): "";
            $type = 2; // Tin tức
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
            $object_id = isset($_POST['object_id'])? trim(mysql_escape_string($_POST['object_id'])): "";
            $content = isset($_POST['content'])? trim(mysql_escape_string($_POST['content'])): "";
            $time = isset($_POST['time'])? trim(mysql_escape_string($_POST['time'])): "";
            $type = 2;// Tin tưc
            $status = 1;
            $news = FootBallNews::getNewsById($object_id);

            $timeCreate =    date("Y/md",strtotime($news['create_date']));  
            if($news['image']!="")
                $news['image'] = "http://kenhkiemtien.com/upload/bongda/news/".$timeCreate."/".$news['image'];
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
