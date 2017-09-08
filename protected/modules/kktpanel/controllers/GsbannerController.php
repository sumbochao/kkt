<?php
    class GsbannerController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Banner','link'=>$url->createUrl("gsbanner/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Banner','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $game = isset($_GET["game"]) ? intval($_GET["game"]): 0;
            $cate_id = isset($_GET["category"]) ? intval($_GET["category"]): 0;
            $os = isset($_GET["os"]) ? intval($_GET["os"]): 0;
            $position = isset($_GET["position"]) ? intval($_GET["position"]): 0;
            $status = isset($_GET["status"]) ? intval($_GET["status"]): 2;
            list($max_page,$count,$data) = GBanner::getDataBanner($keyword,$game,$cate_id,$os,$position,$status,$page,$row_per_page);
            //var_dump($data);
            
            $category = GCategory::getAllCate();
            $this->render('index',array('category'=>$category,'data'=>$data,'page'=>$page,'keyword'=>$keyword,'game'=>$game,'cate_id'=>$cate_id,'os'=>$os,'position'=>$position,'status'=>$status,'max_page'=>$max_page,'count'=>$count));
        }
        
        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Banner','link'=>'#','class'=>'active');
            $category = GCategory::getAllCate();
            $game = GGame::getName();
            $this->render('create',array('category'=>$category,'game'=>$game));
        }
        
        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Thay đổi Banner','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): 0;
            $data = GBanner::getBannerById($id);
            $game_id = GGame::getDataById($data['game_id']);
            $data['game_id'] = $game_id['name'];
            $category = GCategory::getAllCate();
            $game = GGame::getName();
            //var_dump($data);die;
            $this->render('edit',array('data'=>$data,'category'=>$category,'game'=>$game));
        }
        
        public function actionAjaxSaveBanner()
        {
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            $category = isset($_POST['category'])? trim(strip_tags($_POST['category'])): "";
            $os = isset($_POST['os'])? intval($_POST['os']): 0;
            $position = isset($_POST['position'])? intval($_POST['position']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $image = isset($_POST['image'])? trim(strip_tags($_POST['image'])): "";
            $game_id = GGame::getDataByName($game);
            $game_id = $game_id['id'];
            //var_dump($game_id);die;
            
            if(empty($game_id))
            {
                echo 'Tên game không tồn tại'; exit;
            }
            if($name == "")
            {
                echo "Tên Banner không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
           
            $result = GBanner::insertBanner($name,$game_id,$category,$image,$position,$status,$os,$time,$user);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxUpdateBanner()
        {
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $game = isset($_POST['game'])? trim(strip_tags($_POST['game'])): "";
            $category = isset($_POST['category'])? trim(strip_tags($_POST['category'])): "";
            $os = isset($_POST['os'])? intval($_POST['os']): 0;
            $position = isset($_POST['position'])? intval($_POST['position']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $image = isset($_POST['image'])? trim(strip_tags($_POST['image'])): "";
            $game_id = GGame::getDataByName($game);
            $game_id = $game_id['id'];
            
            if(empty($game_id))
            {
                echo 'Tên game không tồn tại'; exit;
            }
            if($name == "")
            {
                echo "Tên Banner không được để trống"; exit;
            }
            if($image == "")
            {
                echo "Chưa upload ảnh"; exit;
            }
            
            $result = GBanner::updateBanner($id,$name,$game_id,$category,$image,$position,$status,$os,$time,$user);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $data = GBanner::getBannerById($id);
            $location = getcwd();
            $location1 = $location.'/upload/gamestore/banner/'.date('Y/md',strtotime($data['create_date']))."/".$data['image'];
            $location2 = $location.'/upload/gamestore/banner/'.date('Y/md',strtotime($data['create_date']))."/m_".$data['image'];
            @unlink($location1);
            @unlink($location2);
            $result = GBanner::deleteBanner($id);
            //var_dump($result);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $result = GBanner::quickUpdate($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
    }
?>
