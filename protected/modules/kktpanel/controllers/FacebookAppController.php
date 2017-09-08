<?php

class FacebookAppController extends CpController
{
    public function init()
    {
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Facebook App','link'=>$url->createUrl("facebookApp/index"),'class'=>'');
    }
    
    public function actionIndex()
    {
        $row_per_page = 20;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        $keyword = isset($_GET['keyword']) ? trim(strip_tags($_GET['keyword'])): "";
        list($max_page,$count,$data) = FacebookApp::getAllData2($page,$row_per_page,$keyword);
        $this->render('index',array('data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page,'keyword'=>$keyword));
        
    }
    
    public function actionEdit(){
        $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
        $fbApp = FacebookApp::getById($id);
        //var_dump($fbApp);die;
        $this->render('edit',array('data'=>$fbApp));
    }
    
    public function actionAdd()
    {
        $this->render('add');
    }
    
    public function actionAjaxDeleteAccount()
    {
        $app_id = isset($_POST['app_id'])? intval($_POST['app_id']): "";
        $result = FacebookApp::deleteAccount($app_id);
        if($result>0)
        {
            echo $result;exit;
        }
    }
    
    public  function actionChangeAccount()
    {
        $app_id_old = $_POST['app_id_old'];
        $app_id = $_POST['app_id'];
        $app_secret = $_POST['app_secret'];
        $title = $_POST['title'];
        $status = $_POST['status'];
        $model = FacebookApp::changeAccount($app_id_old, $app_id, $app_secret, $title, $status);
        $url = new Url();
        $this->redirect($url->createUrl("facebookapp/index"));
    }
    // Ajax update
    public function actionAjaxUpdate()
    {
        $id =isset($_POST['id'])? trim(strip_tags($_POST['id'])): "";
        $app_id = isset($_POST['app_id'])? trim(strip_tags($_POST['app_id'])): "";
        $app_secret= isset($_POST['app_secret'])? trim(strip_tags($_POST['app_secret'])): "";
        $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
        $status = isset($_POST['status'])? trim(strip_tags($_POST['status'])): "";
        
        if($app_id == "")
        {
            echo "Tên app id  không được để trống"; exit;
        }
        if($app_secret == "")
        {
            echo "Tên app secret không được để trống"; exit;
        }
        if($title == "")
        {
            echo "Tên tiêu đề app không được để trống"; exit;
        }
        if($status == "")
        {
            echo "Trạng thái app không được để trống"; exit;
        }
        $model= FacebookApp::changeAccount($id, $app_id, $app_secret, $title, $status);
        if ($model >0)
        {
            echo $model;exit();
        }
        else
        {
            echo "Không update được APP "; exit();
        }
    }
    //Ajax
    public  function actionAjaxSaveApp()
    {
        $app_id = isset($_POST['app_id'])? trim(strip_tags($_POST['app_id'])): "";
        $app_secret= isset($_POST['app_secret'])? trim(strip_tags($_POST['app_secret'])): "";
        $title = isset($_POST['title'])? trim(strip_tags($_POST['title'])): "";
        $status = isset($_POST['status'])? trim(strip_tags($_POST['status'])): "";
        
        if($app_id == "")
        {
            echo "Tên app id  không được để trống"; exit;
        }
        if($app_secret == "")
        {
            echo "Tên app secret không được để trống"; exit;
        }
        if($title == "")
        {
            echo "Tên tiêu đề app không được để trống"; exit;
        }
        if($status == "")
        {
            echo "Trạng thái app không được để trống"; exit;
        }
        $result = FacebookApp::addInfor($app_id, $app_secret, $title, $status);
        if($result>0)
        {
            echo $result;exit;
        }
        else 
        {
            echo "Không tạo mới được APP. App Id có thể đã tồn tại."; exit();
        }
    }
    
    public function actionSuccessful()
    {
        try {
            $app_id = $_POST['app_id'];
            $app_secret = $_POST['app_secret'];
            $title = $_POST['title'];
            $status = $_POST['status'];
            
            $model = FacebookApp::addInfor($app_id, $app_secret, $title, $status);
        } catch (Exception $e) {
            echo "Loi:" . $e->getMessage();
        }
        $url = new Url();
        $this->redirect($url->createUrl("facebookapp/index"));
      
    }
}
?>