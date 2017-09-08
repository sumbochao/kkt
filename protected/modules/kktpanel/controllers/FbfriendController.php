<?php
    class FbfriendController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Kết bạn facebook','link'=>$url->createUrl("fbfriend/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'Kết bạn Facebook','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $row_per_page = 50; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]): 1;
            //var_dump($page);
            $keyword = isset($_GET['keyword'])? trim(strip_tags($_GET['keyword'])): "";
            $status = isset($_GET["status"]) ? intval($_GET["status"]): 2;
            list($max_page,$count,$data) = FFriends::getAllData($id,$page,$row_per_page,$keyword,$status);
            //var_dump($data);die;
            $this->render('index',array('id'=>$id,'data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page,'keyword'=>$keyword,'status'=>$status));
        }

        public function actionAjaxExcelFriend()
        {
            $code = "";
            $i = isset($_POST['i'])? intval($_POST['i']): "";
            $email = isset($_POST['email'])? trim(strip_tags($_POST['email'])): "";
            //$id = isset($_POST['id'])? intval($_POST['id']): "";
            $excel = isset($_POST['excel'])? trim(strip_tags($_POST['excel'])): "";
            $id = FAccount::getIdByEmail($email);
            $id = $id['id'];
            //var_dump($id);die;
            if($excel=="")
            {
                echo "Chưa nhập file";exit;
            }

            $check = substr($excel,-3,3);
            if($check == 'txt')
            {
                $file_path = './upload/gamestore/facebook/'.date('Y/md',time()).'/'.$excel;
                $file = fopen($file_path,"r");
                $code = fread($file,filesize($file_path));
                //var_dump($code);die;
                $arr_data = explode("\n",$code);
                //var_dump($arr_data);die;
                //var_dump($arr_data[$i]);die;
                $i = $i - 1;
                if(isset($arr_data[$i]))
                {
                    $result = FFriends::insertFriend($id,$arr_data[$i]);
                    if($result>0){
                        echo $arr_data[$i];exit;
                    }
                }else
                {
                    exit;
                }
                fclose($file);    
            }elseif($check == "xls" || $check == "lsx")
            {
                
                $file_path = './upload/gamestore/facebook/'.date('Y/md',time()).'/'.$excel;
                $arr_data = Yii::app()->yexcel->readActiveSheet($file_path);
                //var_dump($arr_data);die;
                if(isset($arr_data[$i]['A']))
                {
                    $result = FFriends::insertFriend($id,$arr_data[$i]['A']);
                    if($result>0){
                        echo $arr_data[$i]['A'];exit;
                    }
                }else
                {
                    exit;
                }
            }
            else
            {
                echo "End";    
            }
        }

        public function actionAdd()
        {
            $id = isset($_GET['id'])? intval($_GET['id']): "";
            $row_per_page = 100; 
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            list($max_page,$count,$data) = FFriends::getAllFriend($id,$page,$row_per_page);
            //var_dump($data);die;
            $this->render('add',array('data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page));
        }

        public function actionAjaxDeleteFriend()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FFriends::deleleFriend($id);
            if($result>0){
                echo $result;exit();
            }
        }

        public function actionAjaxDeleteAll()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FFriends::deleleAll($id);
            if($result>0){
                echo 1;exit();
            }
        }

        public function actionAjaxRequestFriend()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): "";
            $result = FFriends::updateRequestFriend($id);
            if($result>0){
                echo $result;exit();
            }
        }

    }
?>
