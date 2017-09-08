<?php
    class FbcampaignController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Tài khoản FaceBook','link'=>$url->createUrl("fbcampaign/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Chiến dịch Facebook','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            //$count = isset($_GET["count"]) ? intval($_GET["count"]):0;
            list($max_page,$count,$data) = FCampaign::getAllData($page,$row_per_page,$keyword);
            //var_dump($data);
            $this->render('index',array('data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page,'keyword'=>$keyword));
        }
        
        public function actionLog()
        {
            $id = isset($_GET["id"]) ? intval($_GET["id"]): 0;
            $data = FCampaignLog::getLog($id);
            $this->render('log',array('data'=>$data));
        }
        
        public function actionAjaxDeleteLog()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FCampaignLog::deleteLog($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxDeleteCampaign()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FCampaign::deleteCampaign($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
    }
?>
