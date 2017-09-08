<?php
    /**
     * @author thanhtung
     *
     */
    class GsGameController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Game Store','link'=>$url->createUrl("gsgame/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS game store','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
          
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $category_id = isset($_GET["category"]) ? intval($_GET["category"]):0;
            $publisher_id = isset($_GET["publisher"]) ? intval($_GET["publisher"]):0;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $type = isset($_GET["type"]) ? intval($_GET["type"]):2;
            $status = isset($_GET["status"]) ? intval($_GET["status"]):2;
            $orderBy = isset($_GET["orderBy"]) ? intval($_GET["orderBy"]):3;
            $compare = isset($_GET["compare"]) ? intval($_GET["compare"]):1;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $hedieuhanh = isset($_GET["hedieuhanh"]) ? intval($_GET["hedieuhanh"]):0;
            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            list($max_page,$count,$data) = GGame::getAllGame($hedieuhanh,$from_date,$to_date,$category_id,$publisher_id,$keyword,$type,$status,$orderBy,$compare,$page,$row_per_page);
           
            $this->render('index',array('data'=>$data,'category'=>$category,'publisher'=>$publisher,'max_page'=>$max_page,'count'=>$count,'from_date'=>$from_date,
                'to_date'=>$to_date,'category_id'=>$category_id,'publisher_id'=>$publisher_id,'keyword'=>$keyword,'type'=>$type,'status'=>$status,'orderBy'=>$orderBy,
                'compare'=>$compare,'page'=>$page,'hedieuhanh'=>$hedieuhanh));
        }
        
        public function actionAjaxUpdatePosition()
        {
         
            $position = isset($_POST['position'])? $_POST['position']: "";
            $parent = isset($_POST['parent'])? $_POST['parent']: "";
            $position1 = explode(',', $position);
            
             foreach ($position1 as $key=>$value){
                 
                if($value != ""){
                    GGView::updatePosition($key, $value);
                }
            }
            
        }

        public function actionAjaxAddHot()
        {
             $count = GGView::CountTypeId(1);
             
             $game_id = isset($_POST['game_id']) ? intval($_POST['game_id']):0 ;
             $statusdata = GGView::getStatus($game_id,1);
             if ($statusdata ['type_view']==1) {
                $result =  GGView::deleteView($game_id);
            }
            else{
                $result = GGView::InsertGameHot($game_id,$count+1);
            }
             
             echo $result;
        }


        public function actionAjaxAddNew()
        {
            $count = GGView::CountTypeId(2);
             $game_id = isset($_POST['game_id']) ? intval($_POST['game_id']):0 ;
             $statusdata = GGView::getStatus($game_id,2);
             if ($statusdata ['type_view']==2) {
                $result =  GGView::deleteView($game_id);
            }
            else{
                $result = GGView::InsertGameNew($game_id,$count+1);
            }
             echo $result;exit();
                         
        }
        public function actionAjaxAddMiniGame()
        {
             $count = GGView::CountTypeId(3);
             $game_id = isset($_POST['game_id']) ? intval($_POST['game_id']):0 ;
            $statusdata = GGView::getStatus($game_id,3);
             if ($statusdata ['type_view']==3) {
                $result =  GGView::deleteView($game_id);
            }
            else{
                $result = GGView::InsertGameMini($game_id,$count+1);
            }
            echo $result;exit;              
        }
        
        public function actionAjaxDeleteViewNew()
        {
            $id = isset($_POST['id']) ? intval($_POST['id']):0 ;
  
            $result = GGView::deleteId($id);
            echo $result;exit;           
        }
        
        public function actionAjaxDeleteViewMiniGame()
        {
            $id = isset($_POST['id']) ? intval($_POST['id']):0 ;
  
            $result = GGView::deleteId($id);
            echo $result;exit;           
        }
        public function actionAjaxDeleteViewHot()
        {
            $id = isset($_POST['id']) ? intval($_POST['id']):0 ;
  
            $result = GGView::deleteId($id);
            echo $result;exit;           
        }
        public function  actionViewhot()
        {
             $row_per_page = 20; 
            $this->breadcrumbs[] = array('name'=>'View Game Hot','link'=>'#','class'=>'active');
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
           
            list($max_page,$count,$data) = GGView::getViewHot($row_per_page,$page);
            $this->render('viewhot',array('data'=>$data,'max_page'=>$max_page,'count'=>$count));
        }
        public function actionViewnew()
        {
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
             $this->breadcrumbs[] = array('name'=>'View Game New','link'=>'#','class'=>'active');
            list($max_page,$count,$data) = GGView::getviewnew($row_per_page,$page);
            
            $this->render('viewnew',array('data'=>$data,'max_page'=>$max_page,'count'=>$count));
            
             
        }
        public function actionViewminigame()
        {
            
             $row_per_page = 20; 
             $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            
             $this->breadcrumbs[] = array('name'=>'View Game Mini','link'=>'#','class'=>'active');
             
             list($max_page,$count,$data) =  GGView::getGameMini($row_per_page,$page);
             
             $this->render('viewminigame',array('data'=>$data,'max_page'=>$max_page,'count'=>$count));
             
        }
        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới game store','link'=>'#','class'=>'active');
            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            $this->render('create',array('category'=>$category,'publisher'=>$publisher));
        }

        public function actionAjaxDeleteImage()
        {
            $banner= isset($_POST['banner'])? $_POST['banner'] : "";
            $image = isset($_POST['image'])? $_POST['image'] : "";
            $date = isset($_POST['date'])? $_POST['date'] : "";
            $total_image = isset($_POST['total_image'])? $_POST['total_image'] : "";
            
            $location = getcwd();
            $location1 = $location."/upload/gamestore/game/". date('Y/md')."/". $image ;
            if($date!="")
            {
                $location1 = $location."/upload/gamestore/game/". date('Y/md',strtotime($date))."/". $image ;
            }
            $location2 = $location."/upload/gamestore/game/". date('Y/md')."/m_". $image ;
            if($date!="")
            {
                $location2 = $location."/upload/gamestore/game/". date('Y/md',strtotime($date))."/m_". $image ;
            }
            @unlink($location1);
            @unlink($location2);
            $image = '"'.$image.'",';
            $new_image = str_replace($image,"",$total_image);
             echo $new_image;exit;
        }

        public function actionAjaxDeleteApk()
        {
            $link = isset($_POST['link'])? $_POST['link']: "";
            $location = getcwd();
            $location .= "/".$link;
            $result = unlink($location);
            echo 1;exit;
        }

        public function actionAjaxDeleteIpa()
        {
            $link = isset($_POST['link'])? $_POST['link']: "";
            $location = getcwd();
            $location .= "/".$link;
            unlink($location);
            echo 1;exit;
        }

        public function actionAjaxSaveGame()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name; 
           
            $url_scheme=  isset($_POST['url_scheme']) ? trim(strip_tags($_POST['url_scheme'])) : "";
            $title_game = isset($_POST['title_game'])? trim(strip_tags(mysql_escape_string($_POST['title_game']))): "";
            $category = isset($_POST['category'])? intval($_POST['category']): 1;
            $publisher = isset($_POST['publisher'])? intval($_POST['publisher']): 1;
            $bundle_id = isset($_POST['bundle_id'])? trim(strip_tags($_POST['bundle_id'])): "";
            $packet_id = isset($_POST['packet_id'])? trim(strip_tags($_POST['packet_id'])): "";
            $is_hot = isset($_POST['is_hot'])? intval($_POST['is_hot']): 1;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $picture = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $banner= isset($_POST['banner']) ? trim(strip_tags($_POST['banner'])) : "";
             
            $video_game = isset($_POST['video_game'])? trim(strip_tags($_POST['video_game'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
            $content = isset($_POST['content'])? trim(stripslashes($_POST['content'])): "";
            $tags = isset($_POST['tags'])? trim(strip_tags($_POST['tags'])): "";
            $images = isset($_POST['images'])? trim(strip_tags($_POST['images'])): "";
            $images = substr($images,0,-1);
            $images = '['.$images.']';
            $file_apk = isset($_POST['file_apk'])? trim(strip_tags($_POST['file_apk'])): "";
            $size_apk = isset($_POST['size_apk'])? trim(strip_tags($_POST['size_apk'])): "";
            $version_apk = isset($_POST['version_apk'])? trim(strip_tags($_POST['version_apk'])): "";
            $version_os_apk = isset($_POST['version_os_apk'])? trim(strip_tags($_POST['version_os_apk'])): "";
            $file_ipa = isset($_POST['file_ipa'])? trim(strip_tags($_POST['file_ipa'])): "";
            $size_ipa = isset($_POST['size_ipa'])? trim(strip_tags($_POST['size_ipa'])): "";
            $version_ipa = isset($_POST['version_ipa'])? trim(strip_tags($_POST['version_ipa'])): "";
            $version_os_ipa = isset($_POST['version_os_ipa'])? trim(strip_tags($_POST['version_os_ipa'])): "";
            $email = isset($_POST['email'])? trim(strip_tags($_POST['email'])): "";
            $website = isset($_POST['website'])? trim(strip_tags($_POST['website'])): "";
            $fanpage = isset($_POST['fanpage'])? trim(strip_tags($_POST['fanpage'])): "";
            $phone = isset($_POST['phone'])? trim(strip_tags($_POST['phone'])): "";
            $itune_id = isset($_POST['itune_id'])? trim(strip_tags($_POST['itune_id'])): "";
            $room_name = 'room'.time();
            $room_pass = md5(md5("roomgame2014"));
            $rate_view =isset($_POST['rate_view'])? intval($_POST['rate_view']): 1;
         
            $is_ipa = 0;
            if($bundle_id != "")
            {
                $is_ipa = 1;
            }
            $is_apk = 0;
            if($packet_id != "")
            {
                $is_apk = 1;
            }
           
            if($title_game == "")
            {
                echo "Tên game không được để trống"; exit;
            }

            if($picture == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            if(preg_match("/[^0-9]/",$phone))
            {
                echo "Số điện thoại chứa ký tự";exit;
            }
            //Chenk Bundle_id 
          
            if($bundle_id != "")
            {
                $chenk_bundle_id = GGame::checkBundle($bundle_id);
                if($chenk_bundle_id != false)
                {
                    echo "Bundle Id đã tồn tại";exit;
                }
            } 
            //Chenk Packet_id
            if($packet_id != "")
            {
                $chenk_packet_id = GGame::checkPacket($packet_id);
                if($chenk_packet_id != false)
                {
                    echo "Packet Id đã tồn tại";exit;
                }
            }
            
            $publisher_name = GPublisher::getPublisherById($publisher);
            $publisher_name = $publisher_name['name'];
          
            $result = GGame::insertGame($banner,$url_scheme,$rate_view,$title_game,$description,$content,$picture,$images,$video_game,$category,$publisher,$version_ipa,$version_apk,$version_os_ipa,$version_os_apk,$size_ipa,$size_apk,$tags,$is_hot,$status,$time_now,$create_user,$is_ipa,$is_apk,$email,$website,$fanpage,$phone,$room_name,$room_pass,$bundle_id,$packet_id,$publisher_name,$itune_id);
            $result = GCategory::insertCountGame($category);
            $result = GPublisher::insertCountGame($publisher);
            $test = GGame::createRoom($room_name,$room_pass); 
           
             
            if ($result > 0)
            {
                echo 1;exit;
            }
           

        }

        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): '';
            $data = GGame::getDataById($id);
            $category = $data['category_id'];
            $publisher = $data['publisher_id']; 
            $location = getcwd();
            $location1 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/".$data['icon'];
            $location2 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/m_".$data['icon'];
            $location3 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/".$data['file_apk'];
            $location4 = $location.'/upload/gamestore/game/'.date('Y/md',strtotime($data['create_date']))."/".$data['file_ipa'];
            @unlink($location1);
            @unlink($location2);
            @unlink($location3);
            @unlink($location4);
            $images = json_decode($data['images']);
            
            $result = GGame::deleteGame($id);

            $result = GCategory::insertCountGame($category);

            $result = GPublisher::insertCountGame($publisher);

            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): '0';
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $is_hot = isset($_POST["is_hot"]) ? intval($_POST["is_hot"]):0;
            $is_market = isset($_POST["is_market"]) ? intval($_POST["is_market"]):0;
            $is_play = isset($_POST["is_play"]) ? intval($_POST["is_play"]):0;

            $result = GGame::quickUpdate($id,$status,$is_hot,$is_market,$is_play);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Sửa game store','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $category = GCategory::getAllCate();
            $publisher = GPublisher::GetAllPublisher();
            $data = GGame::getDataById($id);
            $this->render('edit',array('id'=>$id,'data'=>$data,'category'=>$category,'publisher'=>$publisher));
        }

        public function actionAjaxUpdateGame()
        {
            
            $id = isset($_POST['id'])? intval($_POST['id']): 1;
            $time_now = date('Y-m-d H:i:s');
            $update_user = Yii::app()->user->name;
            $url_scheme = isset($_POST['url_scheme'])? trim(strip_tags(mysql_escape_string($_POST['url_scheme']))): "";
            
            $title_game = isset($_POST['title_game'])? trim(strip_tags(mysql_escape_string($_POST['title_game']))): "";
            $category = isset($_POST['category'])? intval($_POST['category']): 1;
            $publisher = isset($_POST['publisher'])? intval($_POST['publisher']): 1;
            $bundle_id = isset($_POST['bundle_id'])? trim(strip_tags($_POST['bundle_id'])): "";
            $packet_id = isset($_POST['packet_id'])? trim(strip_tags($_POST['packet_id'])): "";
            $is_hot = isset($_POST['is_hot'])? intval($_POST['is_hot']): 1;
            $status = isset($_POST['status'])? intval($_POST['status']): 1;
            $picture = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
            $banner= isset($_POST['banner']) ? trim(strip_tags($_POST['banner'])) : "";
            $video_game = isset($_POST['video_game'])? trim(strip_tags($_POST['video_game'])): "";
            $description = isset($_POST['description'])? trim(strip_tags(mysql_escape_string($_POST['description']))): "";
            $content = isset($_POST['content'])? trim(stripslashes($_POST['content'])): "";
            $tags = isset($_POST['tags'])? trim(strip_tags($_POST['tags'])): "";
            $images = isset($_POST['images'])? trim(strip_tags($_POST['images'])): "";
            $images = substr($images,0,-1);
            $images = '['.$images.']';
            $file_apk = isset($_POST['file_apk'])? trim(strip_tags($_POST['file_apk'])): "";
            $size_apk = isset($_POST['size_apk'])? trim(strip_tags($_POST['size_apk'])): "";
            $version_apk = isset($_POST['version_apk'])? trim(strip_tags($_POST['version_apk'])): "";
            $version_os_apk = isset($_POST['version_os_apk'])? trim(strip_tags($_POST['version_os_apk'])): "";
            $file_ipa = isset($_POST['file_ipa'])? trim(strip_tags($_POST['file_ipa'])): "";
            $size_ipa = isset($_POST['size_ipa'])? trim(strip_tags($_POST['size_ipa'])): "";
            $version_ipa = isset($_POST['version_ipa'])? trim(strip_tags($_POST['version_ipa'])): "";
            $version_os_ipa = isset($_POST['version_os_ipa'])? trim(strip_tags($_POST['version_os_ipa'])): "";
            $email = isset($_POST['email'])? trim(strip_tags($_POST['email'])): "";
            $website = isset($_POST['website'])? trim(strip_tags($_POST['website'])): "";
            $fanpage = isset($_POST['fanpage'])? trim(strip_tags($_POST['fanpage'])): "";
            $phone = isset($_POST['phone'])? trim(strip_tags($_POST['phone'])): ""; 
            $itune_id = isset($_POST['itune_id'])? trim(strip_tags($_POST['itune_id'])): "";
            $rate_view=isset($_POST['rate_view']) ? intval($_POST['rate_view']):1;
            $is_ipa = 0;
           
            if($bundle_id != "")
            {
                $is_ipa = 1;
            }
            $is_apk = 0;
            if($packet_id != "")
            {
                $is_apk = 1;
            }
            
            if($title_game == "")
            {
                echo "Tên game không được để trống"; exit;
            }
            if($picture == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            if(preg_match("/[^0-9]/",$phone))
            {
                echo "Số điện thoại chứa ký tự";exit;
            }

            //Chenk Bundle_id 
            if($bundle_id != "")
            {
                $chenk_bundle_id = GGame::checkBundle($bundle_id);
                if($chenk_bundle_id != false && $chenk_bundle_id['id']!=$id )
                {
                    echo "Bundle Id đã tồn tại";exit;
                }
            }
            //Chenk Packet_id
            if($packet_id != "")
            {
                $chenk_packet_id = GGame::checkPacket($packet_id);
                if($chenk_packet_id != false && $chenk_packet_id['id']!=$id )
                {
                    echo "Packet Id đã tồn tại";exit;
                }
            }
            
            $publisher_name = GPublisher::getPublisherById($publisher);
            $publisher_name = $publisher_name['name'];
            
           
            $result = GGame::updateGame($banner,$url_scheme,$rate_view,$id,$title_game,$description,$content,$picture,$images,$video_game,$category,$publisher,$version_ipa,$version_apk,$version_os_ipa,$version_os_apk,$size_ipa,$size_apk,$tags,$is_hot,$status,$time_now,$update_user,$is_ipa,$is_apk,$email,$website,$fanpage,$phone,$bundle_id,$packet_id,$publisher_name,$itune_id);

            if($result>0)
            {
                $result = GCategory::insertCountGame($category);
                $result = GPublisher::insertCountGame($publisher);
                echo 1;exit;
            }

        }

        public function actionReview()
        {
            $this->breadcrumbs[] = array('name'=>'DS game review','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): 0;
            $game_id = isset($_GET['game'])? trim(stripcslashes($_GET['game'])): "";
            $keyword = isset($_GET['keyword'])? trim(stripcslashes($_GET['keyword'])): "";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GGameReview::getAllReview($id,$game_id,$keyword,$page,$row_per_page);
            $this->render('review',array('data'=>$data,'game_id'=>$game_id,'keyword'=>$keyword,'page'=>$page,'count'=>$count,'max_page'=>$max_page,'keyword'=>$keyword,'game_id'=>$game_id));
        }

        public function actionDeleteReview()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GGameReview::deleteReview($id);

            if($result>0)
            {
                echo 1;exit;
            }
        }

        public function actionUpdateReview()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $result = GGameReview::updateReview($id,$status);
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        public function actionAjaxGetNotify()
        {
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $type = 2;
            
            $data = GNotice::getNotice($object_id, $type);
       
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
        	$type = 2;
        	$status = 1;
                
             $game = GGame::getDataById($object_id);
             $timeCreate =    date("Y/md",strtotime($game['create_date']));  
             if($game['icon']!="")
             $game['icon'] = "http://kenhkiemtien.com/upload/gamestore/game/".$timeCreate."/".$game['icon'];
             $icon = $game["icon"];
        	
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
        
        public function actionAjaxGetRelate()
        {
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $data = GGame::getRelate($object_id);
            if($data['game_relate'] != null)
            {
                $data = json_decode($data['game_relate']);
                $result = "";
                foreach ($data as $key=>$game)
                {
                    $key += 1; 
                    $value = GGame::getDataById($game);
                    if(!empty($value)){
                         $category = GCategory::getCateById($value['category_id']);
                        $publisher = GPublisher::getPublisherById($value['publisher_id']);
                        $result .= "<tr id='". $object_id."". $value['id'] ."'>";
                        $result .= "<td>". $key ."</td>";
                        $result .= "<td>";
                        $result .= "<img style='width: 75px; height: 75px;' src='".Yii::app()->params['urlImages']."gamestore/game/".date('Y/md',strtotime($value['create_date']))."/". $value['icon']."'>";
                        $result .= "</td>";
                        $result .= "<td>";
                        $result .= "<b>".$value["name"]."</b>";
                        $result .= "<br>";
                        $result .=  $category['name']." - ".$publisher['name'];
                        $result .= "</td>";
                        $result .= "<td>";
                        $result .= "<a href='javascript:void(0);' onclick='ajaxDeleteRelate(". $object_id .",". $value['id'] .",". $object_id ."". $value['id'] .")'>Delete</a>";
                        $result .= "</td>";
                        $result .= "</tr>";
                    }
                   
                }
                
                echo $result;
            }
            
        }
        
        public function actionAjaxDeleteRelate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            
            $data = GGame::getRelate($id);
            $data = $data['game_relate'];
            
            $data = str_replace('"'.$game.'",', "", $data);
            $data = str_replace('"'.$game.'"', "", $data);
            
            $result = GGame::updateRelate($id,$data);
            if($result>0)
            {
                echo $result;exit;
            }
            
        }
        
        public function actionAjaxSearchRelate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
        	$game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
        	$publisher = isset($_POST['publisher'])? intval($_POST['publisher']): 0;
        	
        	$data = GGame::searchRelate($game,$publisher);
        	
        	$result = "";
        	foreach ($data as $key=>$value)
        	{
        	    $category = GCategory::getCateById($value['category_id']);
        	    $publisher = GPublisher::getPublisherById($value['publisher_id']);
        	    $key +=1;
        	    $result .= "<tr id='". $id."". $value['id'] ."'>";
        	    $result .= "<td>". $key ."</td>";
        	    $result .= "<td>";
        	    $result .= "<img style='width: 75px; height: 75px;' src='".Yii::app()->params['urlImages']."gamestore/game/".date('Y/md',strtotime($value['create_date']))."/". $value['icon']."'>";
        	    $result .= "</td>";
        	    $result .= "<td>";
        	    $result .= "<b>".$value["name"]."</b>";
        	    $result .= "<br>";
        	    $result .=  $category['name']." - ".$publisher['name'];
        	    $result .= "</td>";
        	    $result .= "<td>";
        	    $result .= "<a href='javascript:void(0);' onclick='ajaxSaveRelate(". $id .",". $value['id'] .",". $id ."". $value['id'] .")'>Thêm</a>";
        	    $result .= "</td>";
        	    $result .= "</tr>";
        	}
        	echo $result;
        }
        
        public function actionAjaxSaveRelate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            
            $data = GGame::getDataById($id);
            $relate = $data['game_relate'];
            if(is_null($relate) || $relate=="")
            {
                $relate = '["'.$game.'"]';
            }
            elseif($relate == '[]')
            {
                $relate = '["'.$game.'"]';
            }
            else 
            {
                $relate = str_replace("]", "", $relate);
                $relate .= ',"'.$game.'"]';
            }
            
            //$relate = '["'.$game.'"]';
            $result = GGame::updateRelate($id,$relate);
            if($result>0)
            {
                echo $result;exit;
            }
            
        }
        
    }
?>
