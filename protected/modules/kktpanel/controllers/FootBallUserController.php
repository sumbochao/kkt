<?php
    class FootBallUserController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Thành viên','link'=>$url->createUrl("footBallVideo/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Thành viên','link'=>'#','class'=>'active');
            $row_per_page = 20; 
            $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
            $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
            $email = isset($_GET["email"]) ? trim($_GET["email"]):"";
            $name = isset($_GET["name"]) ? trim($_GET["name"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            
            list($max_page,$count,$data) = FootBallUser::getAllData($from_date,$to_date,$name,$email,$page,$row_per_page);

            $this->render('index',array('data'=>$data,'name'=>$name,'from_date'=>$from_date,'to_date'=>$to_date,'page'=>$page,'row_per_page'=>$row_per_page,
            'count'=>$count,"max_page"=>$max_page,"email"=>$email));

        }

          public function actionAjaxQuickUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $status = isset($_POST['status'])? intval($_POST['status']): 0;
            $result = FootBallUser::quickUpdateUser($id,$status);
            if($result>0)
            {
                echo $result;exit;
            }       
        }



    }
?>
