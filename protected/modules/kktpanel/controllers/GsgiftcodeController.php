<?php
    class GsgiftcodeController extends CpController
    {

        public function init()
        {
            $url = new Url();
            //$file_path = './upload/gamestore/giftcode/2014/0730/example2.xlsx';
            //$data = Yii::app()->yexcel->readActiveSheet($file_path);
            //var_dump($data);
            $this->breadcrumbs[] = array('name'=>'QT Gift Code','link'=>$url->createUrl("gsgiftcode/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Gift Code','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $game = isset($_GET["game"]) ? intval($_GET["game"]): 0;
            $category_id = isset($_GET["category"]) ? intval($_GET["category"]): 0;
            $publisher_id = isset($_GET["publisher"]) ? intval($_GET["publisher"]): 0;

            list($max_page,$count,$data) = GGiftcode::getGiftcode($keyword,$game,$category_id,$publisher_id,$page,$row_per_page);
            //var_dump($data);

            $category = GCategory::getAllCate();
            $publisher = GPublisher::getAllPublisher();
            $this->render('index',array('data'=>$data,'keyword'=>$keyword,'game'=>$game,'category_id'=>$category_id,'publisher_id'=>$publisher_id,'category'=>$category,'publisher'=>$publisher,'page'=>$page,'max_page'=>$max_page,'count'=>$count));
        }
        
        public function actionAjaxUpdateStatus()
        {

            $id = isset($_GET['id'])? intval($_GET['id']): 0;
            $giftcode_id= isset($_GET['giftcode_id'])? intval($_GET['giftcode_id']): 0;
            $statusdata = GGiftcodeStore::getStatus($id);
            
            if ($statusdata ['status']==1) {
                $status = 0;
            }
            else{
                $status = 1;
            }
            
            
            $result = GGiftcodeStore::updateStatus($id,$status);
            GGiftcode::updateGiftcodeAvailable($giftcode_id);
            echo $result;exit();
        }
        
        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Gift Code','link'=>'#','class'=>'active');
            $game = GGame::getName();
            $this->render('create',array('game'=>$game));
        }
      
        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Thay đổi Gift Code','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): 0;
            $data = GGiftcode::getDataById($id);
            $game = GGame::getName();
            $this->render('edit',array('data'=>$data,'game'=>$game,'id'=>$id));
        }

        public function actionAjaxSave()
        {
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            $total = isset($_POST['total'])? intval($_POST['total']): "";
            $available = isset($_POST['available'])? intval($_POST['available']): "";
            $description = isset($_POST['description'])? trim(strip_tags($_POST['description'])): "";
            $excel = isset($_POST['excel'])? trim(strip_tags($_POST['excel'])): "";
            $game = GGame::getDataByName($game);
            $game_id = $game['id'];
            $category_id = $game['category_id'];
            $publisher_id = $game['publisher_id'];
            //var_dump($total);die;

            if($title == "")
            {
                echo 'Tên Gift Code không được để trống';exit;
            }
            if(!isset($game_id))
            {
                echo 'Game không tồn tại';exit;
            }
            if($total<0)
            {
                echo 'Chưa có tổng số giftcode';exit;
            }
            if($available<0)
            {
                echo 'Chưa có tổng số giftcode còn lại';exit;
            }
            if($description == "")
            {
                echo 'Mô tả không được để trống';exit;
            }

            $result1 = GGiftcode::insertGiftcode($title,$game_id,$category_id,$publisher_id,$total,$available,$description,$time,$user);
            if($excel != "")
            {
                $giftcode_id = GGiftcode::getId();
                $giftcode_id = $giftcode_id['id'];
                $result2 =  $this->insertGiftcodeStore($excel,$giftcode_id);
            }

            if($result1>0){
                echo 1;exit();
            }
        }


        public function insertGiftcodeStore($excel,$giftcode_id)
        {
            //var_dump($excel);
            //var_dump($giftcode_id);die;
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $status = 1;
            $data = GGiftcode::getDataById($giftcode_id);
            $date = $data['create_date'];
            $file_path = './upload/gamestore/giftcode/'.date('Y/md',strtotime($date)).'/'.$excel;
            //var_dump($file_path);die;
            $arr_data = Yii::app()->yexcel->readActiveSheet($file_path);
            //var_dump($arr_data);die;
            $result = GGiftcodeStore::insertMultiData($giftcode_id,$arr_data,$status,$time,$user);
            if($result>0){
                echo 1;exit();
            }
        }

        public function actionAjaxUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            $total = isset($_POST['total'])? intval($_POST['total']): "";
            $available = isset($_POST['available'])? intval($_POST['available']): "";
            $description = isset($_POST['description'])? trim(strip_tags($_POST['description'])): "";
            $game = GGame::getDataByName($game);
            $game_id = $game['id'];
            $category_id = $game['category_id'];
            $publisher_id = $game['publisher_id'];

            if($title == "")
            {
                echo 'Tên Gift Code không được để trống';exit;
            }
            if(!isset($game_id))
            {
                echo 'Game không tồn tại';exit;
            }
             if($total<0)
            {
                echo 'Chưa có tổng số giftcode';exit;
            }
            if($available<0)
            {
                echo 'Chưa có tổng số giftcode còn lại';exit;
            }
            if($description == "")
            {
                echo 'Mô tả không được để trống';exit;
            }

            $result = GGiftcode::updateGiftcode($id,$title,$game_id,$category_id,$publisher_id,$total,$available,$description);
            if($result>0){
                echo 1;exit();
            }

        }

        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result1 = GGiftcode::deleteGiftcode($id);
            $result2 = GGiftcodeStore::deleteData($id);
            if($result1>0)
            {
                echo 1;exit();
            }
        }
        
        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): '';
            $status = isset($_POST["status"]) ? intval($_POST["status"]):0;
            $result = GGiftcode::updateStatus($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }
        }

        public function actionCode()
        {
            $this->breadcrumbs[] = array('name'=>'DS Gift Code Store','link'=>'#','class'=>'active');
            $row_per_page = 100; 
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 1;
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            $status = isset($_GET['status'])? intval($_GET['status']): 2;
            list($max_page,$count,$data) = GGiftcodeStore::getData($status,$id,$page,$row_per_page);
            $giftcode = GGiftcode::getDataById($id);
            //var_dump(1);die;
            $this->render('code',array('data'=>$data,'id'=>$id,'giftcode'=>$giftcode,'status'=>$status,'page'=>$page,'max_page'=>$max_page,'count'=>$count));
        }

        public function actionCreateExcel()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới bằng Excel','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 1;
            $data = GGiftcode::getDataById($id);
            $create_date = $data['create_date'];
            $this->render('excel',array('id'=>$id,'create_date'=>$create_date));
        }

        public function actionAjaxExcel()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]): 0;
            $excel = isset($_POST['excel'])? trim(strip_tags($_POST['excel'])): "";
            if($excel=="")
            {
                echo "Chưa nhập file";exit;
            }
            //var_dump($id);die;
            $result = $this->insertGiftcodeStore($excel,$id);
            //var_dump($result);
            if($result>0)
            {
                echo 1;exit();
            }
        }

        public function actionCreateText()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới bằng Text','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 1;
            $this->render('text',array('id'=>$id));
        }

        public function actionAjaxText()
        {   
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $status = 1;
            $id = isset($_POST["id"]) ? intval($_POST["id"]): 0;
            $text = isset($_POST['text'])? trim(stripslashes($_POST['text'])): "";
            $data = explode("\n",$text);
            $result = GGiftcodeStore::insertData($id,$data,$status,$time,$user);
            if($result>0)
            {
                echo 1;exit();
            }
        }

        public function actionAjaxDeleteCode()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]): 0;
            $result = ajaxUpdateStatus::deleteDataById($id);
            if($result>0)
            {
                echo 1;exit();
            }
        }

        public function actionEditCode()
        {
            $this->breadcrumbs[] = array('name'=>'Thay đổi bằng Gift Code','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 0;
            $giftcode_id = isset($_GET["giftcode_id"]) ? intval($_GET["giftcode_id"]): 0;
            $data = GGiftcodeStore::getDataById($id);
            //var_dump($giftcode_id);die;
            $this->render('editcode',array('data'=>$data,'id'=>$id,'giftcode_id'=>$giftcode_id));
        }

        public function actionAjaxUpdateCode()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]): 0;
            $code = isset($_POST['code'])? trim(stripslashes($_POST['code'])): "";
            $status = isset($_POST["status"]) ? intval($_POST["status"]): 0;
            $result = GGiftcodeStore::uploadData($id,$status,$code);
            if($result>0)
            {
                echo 1;exit();
            }
        }
        
        public function actionAjaxGetNotify()
        {
            $object_id = isset($_POST['object_id'])? trim(strip_tags($_POST['object_id'])): "";
            $type = 3;
        
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
            $type = 3;
            $status = 1;
            $giftcode = GGiftcode::getDataById($object_id);
            $game = GGame::getDataById($giftcode["game_id"]);
            
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

    }
?>
