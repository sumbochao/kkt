<?php
    class UserController extends Controller
    {

        public function actionIndex()
        {
            if(isset($_POST['username']))
            {
                $username = isset($_POST['username'])? trim(strip_tags($_POST['username'])): "";
                $password = isset($_POST['password'])? trim(strip_tags($_POST['password'])): "";
                //var_dump($_POST['remember']);
                if($_POST['remember'] == "true")
                {
                    setcookie('username',$username,strtotime('+1 year'));
                    setcookie('password',$password,strtotime('+1 year'));
                }
                elseif($_POST['remember'] == "false")
                {
                    setcookie("username", "", time()-3600);
                    setcookie("password", "", time()-3600);
                }
                $password = md5(md5($password));
                $error_user = "";
                $error_pass = "";
                $check_username = User_veso::checkUserName($username);
                //var_dump($check_username);
                if($password == "" )
                {
                    $error_pass = "<span>* Bạn chưa nhập mật khẩu<span></br>";
                }
                if(empty($check_username)==true)
                {
                    $error_user = "<span>* Bạn đã nhập sai tên đăng nhập<span></br>";
                }
                if($password != $check_username['password'])
                {
                    $error_pass = "<span>* Bạn đã nhập sai mật khẩu<span></br>";
                }
                if($username == "")
                {
                    $error_user = "<span>* Bạn chưa nhập tên đăng nhập<span></br>";
                }

                if($error_user != "" || $error_pass != "")
                {
                    echo $error_user;
                    echo $error_pass;
                    exit;
                }
                else
                {
                    $_SESSION['username'] = $username;
                    $_SESSION['avatar'] = Yii::app()->params['urlImages']."user/".date('Y/md',strtotime($check_username['create_date']))."/".$check_username['avatar_url'];
                    //var_dump($_SESSION['avatar']);
                    echo 1;
                    exit;
                }
            }
            else
            {
                $username = "";
                $password = "";
                if(isset($_COOKIE['username']) || isset($_COOKIE['password']))
                {
                    $username = $_COOKIE['username'];
                    $password = $_COOKIE['password'];
                }
                $this->render('index',array('username'=>$username,'password'=>$password));
            }
        }

        public function actionRegister()
        {
            if(isset($_POST['username']))
            {
                $username = isset($_POST['username'])? trim(strip_tags($_POST['username'])): "";
                $password = isset($_POST['password'])? trim(strip_tags($_POST['password'])): "";
                $confirm = isset($_POST['confirm'])? trim(strip_tags($_POST['confirm'])): "";
                $mobile = isset($_POST['mobile'])? $_POST['mobile']: "";
                $picture = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
                $radio = isset($_POST['radio'])? $_POST['radio']: "";

                $check_username = User_veso::checkUserName($username);
                $error_user = "";
                $error_pass = "";
                $error_confirm = "";
                $error_mobile = "";
                $error_picture = "";

                if(strlen($username)<6)
                {
                    $error_user = "<span>* Tên đăng nhập phải có tối thiểu 6 ký tự<span></br>";
                }
                if(empty($check_username)==false)
                {
                    $error_user = "<span>* Tên đăng nhập đã tồn tại<span></br>";
                }
                if($username == "")
                {
                    $error_user = "<span>* Tên đăng nhập không được để trống<span></br>";
                    //echo $error; exit;
                }
                if($password == "")
                {
                    $error_pass = "<span>* Mật khẩu không được để trống<span></br>";
                }
                if(strlen($password)<6)
                {
                    $error_pass = "<span>* Mật khẩu phải có tối thiểu 6 ký tự<span></br>";
                }
                if($confirm == "")
                {
                    $error_confirm = "<span>* Xác nhận không được để trống<span></br>";
                }
                if(strlen($confirm)<6)
                {
                    $error_confirm = "<span>* Xác nhận phải có tối thiểu 6 ký tự<span></br>";
                }
                if($password != $confirm)
                {
                    $error_confirm = "<span>* Xác nhận lại mật khẩu chưa đúng<span></br>";
                }
                if($mobile == "")
                {
                    $error_mobile = "<span>* Số điện thoại không được để trống<span></br>";
                }
                if(substr($mobile,0,1) != 0)
                {
                    $error_mobile = "<span>* Số điện thoại phải bắt đầu từ số 0<span></br>";
                }
                if(strlen($mobile)<10)
                {
                    $error_mobile = "<span>* Số điện thoại bạn nhập chưa chính xác<span></br>";
                }
                if(is_numeric($mobile)==false)
                {
                    $error_mobile = "<span>* Số điện thoại bạn nhập chứa ký tự<span></br>";
                }
                if($radio=="" && $picture=="")
                {
                    $error_picture = "<span>* Ảnh đại diện không được để trống<span></br>";
                }
                //var_dump($check_username);die;
                if($error_user!="" || $error_pass!="" || $error_confirm!="" || $error_mobile!="" || $error_picture!="" )
                {
                    echo $error_user;
                    echo $error_pass;
                    echo $error_confirm;
                    echo $error_mobile;
                    echo $error_picture;
                    //var_dump($error_user);
                }
                else
                {
                    $create_date = date('Y/m/d H:i:s');
                    $avatar_url = Yii::app()->params['urlAvatar']."avatarxs/".date('Y/md',strtotime($create_date))."/".$picture;
                    if($radio!="" && $picture=="")
                    {
                        $location = '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/upload';
                        $location1 = getcwd();
                        if(file_exists($location."/avatarxs/".date('Y/md',strtotime($create_date)))==false)
                        {
                            mkdir($location."/avatarxs/".date('Y/md',strtotime($create_date)),0777,true);
                        }
                        copy($location1."/upload/user/default/".$radio,$location."/avatarxs/".date('Y/md',strtotime($create_date))."/".$radio);
                        $avatar_url = $radio;
                    }
                    //var_dump($avatar_url);
                    $password = md5(md5($password));
                    $data = User_veso::insertUser($username,$password,$mobile,$avatar_url,$create_date);
                    echo $data;
                    exit;
                }
            }
            else
            {
                $this->render('register');
            }
        }

        public function actionChangePass()
        {
            if(isset($_POST['password']))
            {
                $password = isset($_POST['password'])? trim(strip_tags($_POST['password'])): "";
                $password = md5(md5($password));
                $new_password = isset($_POST['new_password'])? trim(strip_tags($_POST['new_password'])): "";
                $confirm = isset($_POST['confirm'])? trim(strip_tags($_POST['confirm'])): "";
                $check_username = User_veso::checkUserName($_SESSION['username']);

                $error_pass = "";
                $error_new = "";
                $error_confirm = "";
                if($password == "")
                {
                    $error_pass = "<span>* Bạn chưa nhập mật khẩu cũ<span></br>";
                }
                if($check_username['password'] != $password )
                {
                    $error_pass = "<span>* Mật khẩu cũ nhập không chính xác<span></br>";
                }
                if($new_password == "")
                {
                    $error_new = "<span>* Bạn chưa nhập mật khẩu mới<span></br>";
                }
                if(strlen($new_password)<6)
                {
                    $error_new = "<span>* Mật khẩu của bạn quá ngắn<span></br>";
                }
                if($confirm == "")
                {
                    $error_confirm = "<span>* Bạn chưa nhập lại mật khẩu<span></br>";
                }
                if($new_password != $confirm)
                {
                    $error_confirm = "<span>* Xác nhận lại mật khẩu chưa đúng<span></br>";
                }
                if($error_pass!='' || $error_new!='' || $error_confirm !='')
                {
                    echo $error_pass;
                    echo $error_new;
                    echo $error_confirm;
                    exit;
                }
                else
                {
                    $modify_date = date('Y-m-d H:i:s');
                    $new_password = md5(md5($new_password)); 
                    $data = User_veso::updatePass($new_password,$_SESSION['username'],$modify_date);
                    echo $data;
                    exit;
                }

                //var_dump($check_username);
            }
            else
            {
                $this->render('changepass');
            }
        }

        public function actionChangeInfo()
        {
            if(isset($_POST['mobile']))
            {
                $mobile = isset($_POST['mobile'])? $_POST['mobile']: "";
                $picture = isset($_POST['picture'])? trim(strip_tags($_POST['picture'])): "";
                $radio = isset($_POST['radio'])? $_POST['radio']: "";
                $error_mobile = "";
                $error_picture = "";

                if($mobile == "")
                {
                    $error_mobile = "<span>* Số điện thoại không được để trống<span></br>";
                }
                if(substr($mobile,0,1) != 0)
                {
                    $error_mobile = "<span>* Số điện thoại phải bắt đầu từ số 0<span></br>";
                }
                if(strlen($mobile)<10)
                {
                    $error_mobile = "<span>* Số điện thoại bạn nhập chưa chính xác<span></br>";
                }
                if(is_numeric($mobile)==false)
                {
                    $error_mobile = "<span>* Số điện thoại bạn nhập chứa ký tự<span></br>";
                }
                if($radio=="" && $picture=="")
                {
                    $error_picture = "<span>* Ảnh đại diện không được để trống<span></br>";
                }
                if($error_mobile!="" || $error_picture!="")
                {
                    echo $error_mobile;
                    echo $error_picture;
                    exit;
                }
                else
                {
                    $last_username = $_SESSION['username'];
                    $data = User_veso::checkUserName($_SESSION['username']);
                    $date = strtotime($data['create_date']);
                    //var_dump($data['create_date']);die;
                    $modify_date = date('Y-m-d H:i:s');
                    //$location = getcwd();
                    //$location .= '/upload/user/'.date('Y/md',$date).'/'.$data['avatar_url'];
//                    $delete = unlink($location);
                    $avatar_url = Yii::app()->params['urlAvatar']."avatarxs/".date('Y/md',$date)."/".$picture;
                    if($radio!="" && $picture=="")
                    {
                        $location = '/home/kktien/domains/kenhkiemtien.com/public_html/kenhkiemtien.com/upload';
                        $location1 = Yii::app()->params['upload_url'];
                        copy($location1."user/default/".$radio,$location."/avatarxs/".date('Y/md',$date)."/".$radio);
                        $avatar_url = Yii::app()->params['urlAvatar']."avatarxs/".date('Y/md',$date)."/".$radio;
                    }
                    $result = User_veso::updateInfo($mobile,$avatar_url,$modify_date,$last_username);
                    $_SESSION['avatar'] = $avatar_url;
                    echo $result;
                    exit;
                }

            }
            else
            {
                $data = User_veso::checkUserName($_SESSION['username']);
                $date = strtotime($data['create_date']);
                $this->render('changeinfo',array('date'=>$date));
            }
        }
        
        public function actionChuDeHot()
        {
            $page = isset($_GET['page'])? intval($_GET['page']): 1;
            $row_page = 3;
            $start = ($page-1)*$row_page;
            $total_data = Thread_hot::countData();
            $total_page = ceil($total_data/$row_page);
            $data = Thread_hot::getData($start,$row_page);
            for($i=0;$i<count($data);$i++)
            {
                $comment[] = Threat_hot_comment::getCommentHot($data[$i]['id']);
            }
            $this->render('chudehot',array('data'=>$data,'total_page'=>$total_page,'page'=>$page,
            'comment'=>$comment));
        }
        
        public function actionDetail()
        {
            $id = isset($_GET['id'])? intval($_GET['id']): "1";
            $data = Thread_hot::getDataDetail($id);
            $page = isset($_GET['page'])? intval($_GET['page']): 1;
            //var_dump($page);die;
            $this->render('detail',array('id'=>$id,'data'=>$data,'page'=>$page));
        }
        
        public function actionComment()
        {
            if(isset($_POST['comment']))
            {
                if(empty($_SESSION['username']))
                {
                    echo 1; exit;
                }
                $comment = isset($_POST['comment'])? stripcslashes($_POST['comment']): "";
                $id_thread = isset($_POST['id_thread'])? stripcslashes($_POST['id_thread']): "";
                $create_user = $_SESSION['username'];
                $create_date = date('Y-m-d H:i:s');
                $data_user = User_veso::checkUserName($create_user);
                $id_user = $data_user['id'];
                $insert = Threat_hot_comment::insertComment($id_thread,$id_user,$comment,$create_date,$create_user);
                $page = isset($_POST['page'])? intval($_POST['page']): "1";
                $row_page = 3;
                $total_data = Threat_hot_comment::countComment($id_thread);
                $total_page = ceil($total_data/$row_page);
                $start = ($page-1)*$row_page;
                $data = Threat_hot_comment::getComment($start,$row_page,$id_thread);
                $this->renderPartial('comment',array('data'=>$data,'total_page'=>$total_page,
                'id_thread'=>$id_thread,'page'=>$page));
            }
            else
            {
                $id_thread = isset($_POST['id_thread'])? stripcslashes($_POST['id_thread']): "";
                $page = isset($_POST['page'])? intval($_POST['page']): "1";
                $row_page = 3;
                $total_data = Threat_hot_comment::countComment($id_thread);
                $total_page = ceil($total_data/$row_page);
                $start = ($page-1)*$row_page;
                $data = Threat_hot_comment::getComment($start,$row_page,$id_thread);
                //var_dump($data);die;
                $this->renderPartial('comment',array('data'=>$data,'total_page'=>$total_page,
                'id_thread'=>$id_thread,'page'=>$page));
            }
        }
        
        public function actionLogout()
        {
            session_destroy();
            $this->redirect(Yii::app()->createUrl('user/index'));
        }

    }
?>
