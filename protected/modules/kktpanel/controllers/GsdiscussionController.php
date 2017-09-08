<?php
    class GsDiscussionController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Thảo luận','link'=>$url->createUrl("gsdiscussion/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Discussion','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $game_id = isset($_GET['game'])? trim(stripcslashes($_GET['game'])): "";
            $keyword = isset($_GET['keyword'])? trim(stripcslashes($_GET['keyword'])): "";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GDiscussion::getAllDiscussion($id,$game_id,$keyword,$page,$row_per_page);
            //var_dump($data);die;
            $this->render('index',array('data'=>$data,'game_id'=>$game_id,'keyword'=>$keyword,'page'=>$page,'count'=>$count,'max_page'=>$max_page,'keyword'=>$keyword,'game_id'=>$game_id));
        }
        
        public function actionDeleteDiscussion()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GDiscussion::deleteDiscussion($id);

            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        public function actionUpdateDiscussion()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $result = GDiscussion::updateDiscussion($id,$status);
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        public function actionComment()
        {
            $this->breadcrumbs[] = array('name'=>'DS Comment Discussion','link'=>'#','class'=>'active');
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $discussion_id = isset($_GET['discussion'])? trim(stripcslashes($_GET['discussion'])): "";
            $keyword = isset($_GET['keyword'])? trim(stripcslashes($_GET['keyword'])): "";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $row_per_page = 20;
            list($max_page,$count,$data) = GCommentDiscussion::getAllComment($id,$discussion_id,$keyword,$page,$row_per_page);
            //echo 1;exit;
            $this->render('comment',array('data'=>$data,'discussion_id'=>$discussion_id,'keyword'=>$keyword,'page'=>$page,'count'=>$count,'max_page'=>$max_page,'keyword'=>$keyword));
        }
        
        public function actionDeleteComment()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = GCommentDiscussion::deleteComment($id);
            
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        public function actionUpdateComment()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $status = isset($_POST['status'])? intval($_POST['status']): "";
            $result = GCommentDiscussion::updateComment($id,$status);
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
    }
?>
