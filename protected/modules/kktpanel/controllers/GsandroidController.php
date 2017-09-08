<?php
    class GsandroidController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Notify Android','link'=>$url->createUrl("gsandroid/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Notify Android','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $status = isset($_GET["status"]) ? intval($_GET["status"]): 2;
            $type = isset($_GET["type"]) ? intval($_GET["type"]): 3;
            list($max_page,$count,$data) = GAndroid::getDataAndroid($keyword,$status,$type,$page,$row_per_page);
            //var_dump($count);die;
            $this->render('index',array('data'=>$data,'status'=>$status,'type'=>$type,'keyword'=>$keyword,'page'=>$page,'max_page'=>$max_page,'count'=>$count));
        }
        
        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới Notify Android','link'=>'#','class'=>'active');
            $this->render('create');
        }
        
        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Thay đổi Notify Android','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 0;
            $data = GAndroid::getDataById($id);
            //var_dump($data);die;
            $this->render('edit',array('data'=>$data,'id'=>$id));
        }
        
        public function actionAjaxSave()
        {
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $type = isset($_POST['type'])? intval($_POST['type']): "";
            $url = isset($_POST['url'])? trim(strip_tags($_POST['url'])): "";
            $description = isset($_POST['description'])? trim(stripslashes($_POST['description'])): "";
            $time_sent = isset($_POST['time_sent'])? trim(strip_tags($_POST['time_sent'])): "";
            
            if($title == "")
            {
                echo "Title không được để trống"; exit;
            }
            if($url == "")
            {
                echo "Đường link không được để trống"; exit;
            }
            if($description == "")
            {
                echo "Mô tả không được để trống"; exit;
            }
            
            $result = GAndroid::insertAndroid($title,$url,$description,$type,$status,$time_sent,$time,$user);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxUpdate()
        {
            $time = date('Y-m-d H:i:s');
            $user = Yii::app()->user->name;
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $type = isset($_POST['type'])? intval($_POST['type']): "";
            $url = isset($_POST['url'])? trim(strip_tags($_POST['url'])): "";
            $description = isset($_POST['description'])? trim(stripslashes($_POST['description'])): "";
            $time_sent = isset($_POST['time_sent'])? trim(strip_tags($_POST['time_sent'])): "";
            
            if($title == "")
            {
                echo "Title không được để trống"; exit;
            }
            if($url == "")
            {
                echo "Đường link không được để trống"; exit;
            }
            if($description == "")
            {
                echo "Mô tả không được để trống"; exit;
            }
            
            $result = GAndroid::updateAndroid($id,$title,$url,$description,$type,$status,$time_sent);
            //var_dump($result);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GAndroid::deleteAndroid($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $result = GAndroid::quickUpdate($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
    }
?>
