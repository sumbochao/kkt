<?php
    class GsPublisherController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Nhà phát hành','link'=>$url->createUrl("gspublisher/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Nhà phát hành','link'=>'#','class'=>'active');
            $row_per_page = 20;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            list($max_page,$count,$data) = GPublisher::getDataSearch($keyword,$row_per_page,$page);
            //var_dump($data);die;
            $this->render('index',array('data'=>$data,'keyword'=>$keyword,'max_page'=>$max_page,'count'=>$count,'page'=>$page));
        }
        public function actionAjaxQuickSave()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $order_view = isset($_POST["order_view"]) ? trim($_POST["order_view"]): "";
            $data = GPublisher::quickSave($id,$order_view);
            echo $data;
                        exit();
            
        }

        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới nhà phát hành','link'=>'#','class'=>'active');
            $this->render('create');
        }
        
        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Sửa nhà phát hành','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $data = GPublisher::getPublisherById($id);
            //var_dump($data);
            $this->render('edit',array('data'=>$data));
        }
        
        public function actionAjaxSavePublisher()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $pub_name = isset($_POST["pub_name"]) ? trim(strip_tags($_POST["pub_name"])):"";
            $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
            
            if($pub_name ==""){
                echo "Tên nhà phát hành không được để trống";exit;
            }
            if(Common::generate_slug($pub_name)==''){
                echo "Tên nhà phát hành không hợp lệ";exit;
            }
            
            $result = GPublisher::insertPublisher($pub_name,$picture,$time_now,$create_user);
            if($result>0)
            {
                echo $result;exit;
            }
            
        }
        
        public function actionAjaxDelete()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $data = GPublisher::getPublisherById($id);
            $image = $data['image'];
            $date = $data['create_date'];
            $location = getcwd();
            $location1 = $location."/upload/gamestore/publisher/". date('Y/md',strtotime($date))."/". $image ;
            $location2 = $location. "/upload/gamestore/publisher/". date('Y/md',strtotime($date))."/m_". $image ;
            //var_dump($location2);die;
            @unlink($location1);
            @unlink($location2);
            $result = GPublisher::deletePublisher($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxUpdate()
        {
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $update_date = date('Y-m-d H:i:s');
            $update_user = Yii::app()->user->name;
            $pub_name = isset($_POST["pub_name"]) ? trim(strip_tags($_POST["pub_name"])):"";
            $picture = isset($_POST["picture"]) ? trim($_POST["picture"]): "";
            if($pub_name ==""){
                echo "Tên danh mục không được để trống";exit;
            }
            $result = GPublisher::updatePulisher($id,$pub_name,$picture,$update_date,$update_user);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
    }
?>
