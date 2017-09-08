<?php
    class FbmemberController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Thành viên','link'=>$url->createUrl("fbmember/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            
        	$arr_facebook = "";
        	//var_dump(1);die;
        	if(isset($_POST['friend']))
        	{
        		$friend = isset($_POST['friend'])? $_POST['friend'] : "";
        		$arr_friend = explode("\n",$friend);
        		foreach ($arr_friend as $data)
        		{
        			$data = trim($data);
        			/* $facebook = @file_get_contents("http://graph.facebook.com/".$data);
        			$facebook = @json_decode($facebook);
        			$facebook = @get_object_vars($facebook); */
        			$arr_facebook[] = array('id'=>$data);
        		}
        		
        	}
        	//var_dump(1);die;
            $this->render('index',array('facebook'=>$arr_facebook));
        }
        //test thu
         public function actionIndex1()
        {
            
            $arr_facebook = "";
            //var_dump(1);die;
            if(isset($_POST['friend']))
            {
                $link = isset($_POST['link']) ? $_POST['link'] : "";
                $friend = isset($_POST['friend'])? $_POST['friend'] : "";
                $arr_friend = explode("\n",$friend);
                foreach ($arr_friend as $data)
                {
                    $data = trim($data);
                    /* $facebook = @file_get_contents("http://graph.facebook.com/".$data);
                    $facebook = @json_decode($facebook);
                    $facebook = @get_object_vars($facebook); */
                    $arr_facebook[] = array('id'=>$data);
                }
                
            }
            //var_dump(1);die;
            $this->render('index1',array('facebook'=>$arr_facebook,'link'=>$link));
        }
        public function actionSafe()
        {
            $arr_friend = "";
            if(isset($_POST['friend']))
            {
                $friend = isset($_POST['friend'])? $_POST['friend'] : "";
                $arr_friend = explode("\n",$_POST['friend']);
            }
            $this->render('safe',array('facebook'=>$arr_friend));
        }
        
        public function actionLogout()
        {
            //Yii::app()->facebook->destroySession();
            $params = array('next'=> 'http://kenhkiemtien.com/kktpanel/fbmember/destroy');
            $logout = Yii::app()->facebook->getLogoutUrl($params);
            //var_dump($logout);die;
            $this->redirect($logout);
        }
        
        public function actionDestroy()
        {
            Yii::app()->facebook->destroySession();
            $this->redirect('index');
        }

    }
?>
