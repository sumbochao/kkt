<?php
    class FbaccountController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Tài khoản FaceBook','link'=>$url->createUrl("fbaccount/index"),'class'=>'');
        }
        
        public function actionIndex()
        {   
            $this->breadcrumbs[] = array('name'=>'DS facebook account','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $email = isset($_GET['email'])? trim(strip_tags($_GET['email'])): null;
            $status = isset($_GET['status'])? intval($_GET['status']): -1;
             
            list($max_page,$count,$data) = FAccount::getAllData($page,$row_per_page,$keyword,$status);;
            $arrApp = FacebookApp::getAllLive();
            //var_dump($data);
            $this->render('index',array('data'=>$data,"arrApp"=>$arrApp,'max_page'=>$max_page,'count'=>$count,'page'=>$page,'keyword'=>$keyword,"email"=>$email,"status"=>$status));
        }
        
        public function actionIndexadd()
        {
            $this->breadcrumbs[] = array('name'=>'DS facebook account','link'=>'#','class'=>'active');
            $row_per_page = 20;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $email = isset($_GET['email'])? trim(strip_tags($_GET['email'])): null;
             $status = isset($_GET['status'])? intval($_GET['status']): -1;
            list($max_page,$count,$data) = FAccount::getAllData($page,$row_per_page,$keyword,$status);
            //var_dump($data);
            $this->render('indexadd',array('data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page,'keyword'=>$keyword,"email"=>$email,"status"=>$status));
        }
        
        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm facebook account','link'=>'#','class'=>'active');
            $this->render('create');
        }
        
        public function actionEdit()
        {
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $data = FAccount::getAccountById($id);
           
            $this->render('edit',array('id'=>$id,'data'=>$data));
        }
        
        public function actionLogin()
        {
            $this->render('login');
        }
        
        public function actionLogout()
        {
            $params = array('next'=> 'http://kenhkiemtien.com/kktpanel/fbaccount/destroy');
            $logout = Yii::app()->facebook->getLogoutUrl($params);
            
            $this->redirect($logout);
        }
        
        public function actionDestroy()
        {
            Yii::app()->facebook->destroySession();
            $this->redirect('index');
        }
        
        public function actionAjaxSaveAccount()
        {
            $username = isset($_POST['username'])? trim(strip_tags($_POST['username'])): "";
            $password = isset($_POST['password'])? trim(strip_tags($_POST['password'])): "";
            $link = isset($_POST['link'])? trim(strip_tags($_POST['link'])): "";
            $note = isset($_POST['note'])? trim(strip_tags($_POST['note'])): "";
            $status = isset($_POST['status'])? trim(strip_tags($_POST['status'])): "0";
            
            $birthday = isset($_POST['birthday'])? trim(strip_tags($_POST['birthday'])): "";
            $mobile = isset($_POST['mobile'])? trim(strip_tags($_POST['mobile'])): "";
             
            if($username == "")
            {
                echo "Tên user không được để trống"; exit;
            }
            if($password == "")
            {
                echo "Password không được để trống"; exit;
            }
            
            $result = FAccount::insertAccount($username,$password,$link,$note,$birthday,$mobile,$status);
            if($result>0)
            {
                echo $result;exit;
            }
            
        }
        
        public function actionAjaxUpdateAccount()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $username = isset($_POST['username'])? trim(strip_tags($_POST['username'])): "";
            $password = isset($_POST['password'])? trim(strip_tags($_POST['password'])): "";
            $link = isset($_POST['link'])? trim(strip_tags($_POST['link'])): "";
            $note = isset($_POST['note'])? trim(strip_tags($_POST['note'])): "";
            $status = isset($_POST['status'])? trim(strip_tags($_POST['status'])): "0";
            
            $birthday = isset($_POST['birthday'])? trim(strip_tags($_POST['birthday'])): "";
            $mobile = isset($_POST['mobile'])? trim(strip_tags($_POST['mobile'])): "";
            
            if($username == "")
            {
                echo "Tên user không được để trống"; exit;
            }
            if($password == "")
            {
                echo "Password không được để trống"; exit;
            }
            
            $result = FAccount::updateAccount($id,$username,$password,$link,$note,$birthday,$mobile,$status);
            if($result>0)
            {
                echo $result;exit;
            }
        }
        
        public function actionAjaxDeleteAccount()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FInvittable::deleteFriend($id);
            $result = FAccount::deleteAccount($id);
            if($result>0)
            {
                echo $result;exit;
            }
        }
    
        public function actionAjaxAddUserToApp()
        {
            $userIds = isset($_POST['userIds'])? $_POST['userIds']: "0";
            $appId = isset($_POST['appId'])? $_POST['appId']: "0";
            $arrUserId = explode(",",$userIds);
            
            foreach($arrUserId as $id){
                FAppAccount::insert($appId,$id);
            }
            
            echo 1;
        }
    
    
        public function actionAjaxDeleteFriend()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FInvittable::deleteFriend($id);
            if($result>0)
            {
                echo 1;exit;
            }
        }
        
        public function actionAjaxSaveFriend()
        {
            $friend = isset($_POST['friend'])? trim(strip_tags($_POST['friend'])): "";
            $fid = isset($_POST['fid'])? trim(strip_tags($_POST['fid'])): "";
            $name = isset($_POST['name'])? trim(strip_tags($_POST['name'])): "";
            $image = isset($_POST['image'])? trim(strip_tags($_POST['image'])): "";
            $email = isset($_POST['email'])? trim(strip_tags($_POST['email'])): "";
          
            //var_dump($email);die;
            $friend = explode(",",$friend);
            $fid = explode(",",$fid);
            $name = explode(",",$name);
            $image = explode(",",$image);
       
            $id = FAccount::getIdByEmail($email);
            $id = $id['id'];
            
            $result = FInvittable::deleteFriend($id);
            for($i=0;$i<count($friend);$i++)
            {
                $result = FInvittable::insertFriend($id,$friend[$i],$fid[$i],addslashes($name[$i]),$image[$i]);
            }
            
      //      FAccount::updateCountFriend($id,count($friend));
            
            if($result>0)
            {
                echo $result;exit;
            }
        }
		
		 public function actionFriendList()
        {
            $this->breadcrumbs[] = array('name'=>'Danh Sach Friends','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $username = isset($_GET["username"]) ? $_GET["username"]:"";
            $row_per_page = 100; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            //var_dump($page);
            list($max_page,$count,$data) = FInvittable::getAllFriend($id,$username,$page,$row_per_page);
            //var_dump($data);die;
            $this->render('friends',array('id'=>$id,'username'=>$username,'data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page));
        }
        
    }
?>
