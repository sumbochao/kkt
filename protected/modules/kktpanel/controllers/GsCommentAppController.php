<?php
  class GsCommentAppController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Nhận xét GameStore','link'=>$url->createUrl("gsCommentApp/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            
            $this->breadcrumbs[] = array('name'=>'DS Nhận xét','link'=>'#','class'=>'active');
            $type = isset($_GET['type'])? intval($_GET['type']): "0";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GCommentApp::getAllComment($type,$page,$row_per_page);
          
            $this->render('index',array('data'=>$data,'type'=>$type,'page'=>$page,'count'=>$count,'max_page'=>$max_page));
        }
        
        public function actionAjaxDeleteCommentApp()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GCommentApp::deleteComment($id);

            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        
        
    }
?>
