<?php
    class GsuserController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Người dùng','link'=>$url->createUrl("gsuser/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Người dùng','link'=>'#','class'=>'active');
            $row_per_page = 20;
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $chat = isset($_GET["chat"]) ? intval($_GET["chat"]): 2;
            $discussion = isset($_GET["discussion"]) ? intval($_GET["discussion"]): 2;
            $comment=  isset($_GET["comment"]) ? intval($_GET["comment"]): 2;
            
            list($max_page,$count,$data) = GUser::getAllData($comment,$keyword,$chat,$discussion,$page,$row_per_page);
            
            $this->render('index',array('data'=>$data,'chat'=>$chat,'comment'=>$comment,'discussion'=>$discussion,'keyword'=>$keyword,'max_page'=>$max_page,'page'=>$page,'count'=>$count));
        }
        
        public function actionDetail()
        {
            $this->breadcrumbs[] = array('name'=>'Chi tiết người dùng Người dùng','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 1;
            $data = GUser::getDataById($id);
            //var_dump($data);die;
            $this->render('detail',array('data'=>$data));
        }
        
        public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $chat = isset($_POST['chat'])? intval($_POST['chat']): 0;
            $discussion = isset($_POST['discussion'])? intval($_POST['discussion']): 0;
            $result = GUser::quickUpdate($id,$chat,$discussion);
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
    }
?>
