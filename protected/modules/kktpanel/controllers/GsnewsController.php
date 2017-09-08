<?php
    class GsNewsController extends CpController
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
            $category_id = isset($_GET["category"]) ? intval($_GET["category"]):0;
            $publisher_id = isset($_GET["publisher"]) ? intval($_GET["publisher"]):0;
            $game_id = isset($_GET["game"]) ? intval($_GET["game"]):0;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
            $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):3;
            $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            $game = GGame::getName();
            list($max_page,$count,$data) = GNews::getAllData($from_date,$to_date,$category_id,$publisher_id,$keyword,$type,$orderBy,$compare,$page,$row_per_page);
            //echo 1;die;
            $this->render('index',array('data'=>$data,'category'=>$category,'publisher'=>$publisher,'max_page'=>$max_page,'from_date'=>$from_date,'to_date'=>$to_date,
            'category_id'=>$category_id,'keyword'=>$keyword,'type'=>$type,'orderBy'=>$orderBy,'compare'=>$compare,'page'=>$page,
            'row_per_page'=>$row_per_page,'game'=>$game,'game_id'=>$game_id,'publisher_id'=>$publisher_id,'count'=>$count
            ));
        }

        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Tin tức','link'=>'#','class'=>'active');
            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            $game = GGame::getName();
            $this->render('create',array('category'=>$category,'publisher'=>$publisher,'game'=>$game));
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Tin tức','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            $game = GGame::getName();
            $data = GNews::getNewsById($id);
            $data['game_id']= GGame::getDataById($data['game_id']);
            $data['game_id']=$data['game_id']['name'];
          
            $this->render('edit',array('data'=>$data,'category'=>$category,'publisher'=>$publisher,'id'=>$id,'game'=>$game));
        }

        public function actionAjaxSaveNews()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $title_news = isset($_POST['title_news'])? trim(strip_tags(mysql_escape_string($_POST['title_news']))): "";
           
            //$category = isset($_POST['category'])? intval($_POST['category']): 0;
            //$publisher = isset($_POST['publisher'])? intval($_POST['publisher']): 0;
           
            $event = isset($_POST['event'])? intval($_POST['event']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            $game = GGame::getDataByName($game);
            $game_id = $game['id'];
            
            $publisher = $game["publisher_id"];
            $category = $game["category_id"];
            $image = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
            $content = mysql_escape_string(isset($_POST['content'])? trim($_POST['content']): "");
           
            if(empty($game))
            {
                echo 'Tên game không tồn tại'; exit;
            }
            if($title_news == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }

            $result = GNews::insertNews($title_news,$description,$content,$image,$game_id,$category,$publisher,$time_now,$create_user,$event,$status);
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
            $title_news = mysql_escape_string(isset($_POST['title_news'])? trim(strip_tags($_POST['title_news'])): "");
            //$category = isset($_POST['category'])? intval($_POST['category']): 0;
            //$publisher = isset($_POST['publisher'])? intval($_POST['publisher']): 0;
            
            $event = isset($_POST['event'])? intval($_POST['event']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
           
            $game = GGame::getDataByName($game);
            $game_id = $game['id'];
            $publisher = $game["publisher_id"];
            $category = $game["category_id"];
            
            
            $image = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $description = mysql_escape_string(isset($_POST['description'])? trim(strip_tags($_POST['description'])): "");
            $content = mysql_escape_string(isset($_POST['content'])? trim($_POST['content']): "");

            if(empty($game))
            {
                echo 'Tên game không tồn tại'; exit;
            }
            if($title_news == "")
            {
                echo "Tên bài viết không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            $result = GNews::updateNews($id,$title_news,$category,$game_id,$publisher,$image,$description,$content,$event,$status);
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
            $data = GNews::getNewsById($id);
            $location = getcwd();
            $location1 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/".$data['image'];
            $location2 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/m_".$data['image'];
            @unlink($location1);
            @unlink($location2);
            $result = GNews::deleteNews($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $result = GNews::quickUpdateNews($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }       
        }
        
        public function actionComment()
        {
            $this->breadcrumbs[] = array('name'=>'DS Comment Tin Tức','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $news_id = isset($_GET['discussion'])? trim(stripcslashes($_GET['new'])): "";
            $keyword = isset($_GET['keyword'])? trim(stripcslashes($_GET['keyword'])): "";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GCommentNews::getAllComment($id,$news_id,$keyword,$page,$row_per_page);
            //var_dump($data);die;
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
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $type = 4;
        
            $data = GNotice::getNotice($object_id, $type);
        
            //var_dump($data);die;
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
        
            $result = GNotice::deleteNotice($id);
        
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
            $type = 4;
            $status = 1;
            $news = GNews::getNewsById($object_id);
            
             $timeCreate =    date("Y/md",strtotime($news['create_date']));  
             if($news['image']!="")
             $news['image'] = "http://kenhkiemtien.com/upload/gamestore/news/".$timeCreate."/".$news['image'];
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
             
            $result = GNotice::insertNoticeGame($object_id, $content, $type, $status, $time, $create_date, $create_user,$icon);
             
            if($result>0)
            {
                echo $result;exit;
            }
        }

    }
?>
