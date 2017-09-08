<?php
class AdminController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản trị admin','link'=>$url->createUrl("admin/index"),'class'=>'');
    }
    public function actionIndex(){
        $this->breadcrumbs[] = array('name'=>'Danh sách admin','link'=>"#",'class'=>'active');
        $username = isset($_GET["username"]) ? trim($_GET["username"]):"";
        $status = isset($_GET["status"]) ? trim($_GET["status"]):"";
        $data = AdminUser::getDataSearch($username,$status);
        $this->render("index",array("data"=>$data,"username"=>$username,"status"=>$status));
    }

    public function actionAjaxSaveAdmin(){
        $time_now = time();
        $username = isset($_POST["username"]) ? trim($_POST["username"]):"";
        $password = isset($_POST["password"]) ? trim($_POST["password"]):"";
        $re_pass = isset($_POST["re_pass"]) ? trim($_POST["re_pass"]):"";
        $email = isset($_POST["email"]) ? $_POST["email"]:"";
        $full_name = isset($_POST["full_name"]) ? trim($_POST["full_name"]):"";
        $status = isset($_POST["status"]) ? trim($_POST["status"]):"";
        $data_user = AdminUser::getDataByUsername($username);
        if($username==""){echo "Tên đăng nhập không được để trống";exit;}
        if($password==""){echo "Password không được để trống";exit;}
        if($password != $re_pass){echo "Mật khẩu nhập lại không đúng";exit;}
        if($data_user){
            echo "Đã tồn tại tài khoản này rồi";exit(); // da ton tai tai khoan nay;
        }
        $data = array(
        "full_name"=>array("value"=>$full_name,"type"=>2),
        "username"=>array("value"=>$username,"type"=>2),
        "password"=>array("value"=>AdminLogin::hashPassword($password),"type"=>2),
        "email"=>array("value"=>$email,"type"=>2),
        "create_date"=>array("value"=>$time_now,"type"=>1),
        "status"=>array("value"=>$status,"type"=>2),
        );
        $table = "c_admin";
        $last_id = CommonDB::insertRow($table,$data);
        if($last_id >0){
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }
    public function actionAjaxQuickUpdate(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $status = isset($_POST["status"]) ? trim($_POST["status"]):"";
        if($status==""){ echo "Chưa chọn trạng thái của admin";exit;}
        if($id >0){
            $data = array(
            "status"=>array("value"=>$status,"type"=>2), 
            "id"=>array("value"=>$id,"type"=>1) 
            );
            $table = "c_admin";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Bạn chưa thay đổi dữ liệu";exit;
            }
        }
    }
    public function actionAjaxResetPass(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $data_admin = AdminUser::getDataById($id);
        if($data_admin){
            //pass mac dinh : username+123
            $new_number = rand(100,999);
            $new_pass = $data_admin["username"].$new_number;
            $data = array(
            "password"=>array("value"=>AdminLogin::hashPassword($new_pass),"type"=>2), 
            "id"=>array("value"=>$id,"type"=>1) 
            );
            $table = "c_admin";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo "Pass mới của admin này là: ".$new_pass;exit;
            }else{
                echo "Pass của admin này giống với pass mặc định : username + 123";exit;
            }
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0; 
        if($id >0){
            $table = "c_authassignment";
            $result = CommonDB::deleteRow($table,array("adminId"=>$id));
            $table = "c_admin";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }

    public function actionProfile(){
        $user = Yii::app()->getModule("kktpanel")->user;
        if($user){
            $data_admin = AdminUser::getDataById($user->id);
            $this->render("profile",array("data_admin"=>$data_admin));
        }
    }

    public function actionAjaxChangePass(){
        $userId = Yii::app()->getModule("kktpanel")->user->id;
        $old_pass = isset($_POST["old_pass"]) ? trim($_POST["old_pass"]):"";
        $new_pass = isset($_POST["new_pass"]) ? trim($_POST["new_pass"]):"";
        $re_pass = isset($_POST["re_pass"]) ? trim($_POST["re_pass"]):"";
        $data_admin = AdminUser::getDataById($userId);
        if(AdminLogin::hashPassword($old_pass)!=$data_admin["password"]){
            echo "Pass cũ không chính xác";exit;
        }
        if(strlen($new_pass) <=6){
            echo "Pass mới phải dài hơn 6 ký tự";exit;
        }
        if($re_pass != $new_pass){
            echo "Nhập lại mật khẩu không đúng";exit();
        }
        $data = array(
        "password"=>array("value"=>AdminLogin::hashPassword($new_pass),"type"=>2), 
        "id"=>array("value"=>$userId,"type"=>1) 
        );
        $table = "c_admin";
        $result = CommonDB::updateRow($table,$data,array("id"));
        if($result >0){
            Yii::app()->getModule("kktpanel")->user->logout();
            echo 1;exit();
        }else{
            echo "Có lỗi trong quá trình xử lý";exit;
        }
    }

    public function actionLogin(){
        //echo 'aaa';die;
        $url = new Url();
        if(Yii::app()->getModule("kktpanel")->user->isGuest){
            $model = new AdminLogin();
            $this->layout="login";
            if(isset($_POST["AdminLogin"])){
                $model->username = mysql_escape_string($_POST["AdminLogin"]["username"]);
                $model->password = mysql_escape_string($_POST["AdminLogin"]["password"]);
                $model->remember = $_POST["AdminLogin"]["remember"];
                //echo $model->remember;die;
                if($model->validate()){     
                    $identity=new UserIdentity($model->username,$model->password);   
                    if($identity->authenticate()){
                       
                        if($model->remember==1){
                            Yii::app()->user->login($identity,3600*24*7);
                        }else{
                            Yii::app()->user->login($identity);
                        }
                        $this->redirect($url->createUrl("home/index"));
                    }
                    else{
                        echo $identity->errorMessage;  
                    }
                }
            }
            $this->render("login",array("model"=>$model));
        }else{
            $this->redirect($url->createUrl("home/index"));
        }
    }
    public function actionPermit(){
        $this->breadcrumbs[] = array('name'=>'Phân quyền admin','link'=>"#",'class'=>'active');
        $userId = isset($_GET["userId"]) ? intval($_GET["userId"]):0;
        $data_admin = AdminUser::getDataById($userId);
        $data_permit = AdminUser::getDataPermitByAdmin($userId);
        if($data_admin){
            $this->render("permit",array("data_admin"=>$data_admin,"data_permit"=>$data_permit));
        }
    }
    public function actionAjaxSavePermit(){
        $username = Yii::app()->user->name;
        $create_date = time();
        $module_permit = isset($_POST["module_permit"]) ? rtrim($_POST["module_permit"],";"):"";
        $adminId = isset($_POST["adminId"]) ? intval($_POST["adminId"]):0;
        if($adminId >0){
            $table = "c_authassignment";
            $result = CommonDB::deleteRow($table,array("adminId"=>$adminId));
            if($module_permit !=""){
                $arr_permits = explode(";",$module_permit);
                $arr_values = array();
                $arr_key = array("adminId","module","permisId","username","create_date");
                for($i=0;$i<count($arr_permits);$i++){
                    $permit = explode(":",$arr_permits[$i]);
                    $arr_values[] = array($adminId,$permit[0],$permit[1],$username,$create_date); 
                }
                $table = "c_authassignment";
                $result = CommonDB::insertManyRows($table,$arr_key,$arr_values);
            }
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
    public function actionAjaxDeletePermit(){
        $userId = isset($_POST["userId"]) ? intval($_POST["userId"]):0;
        if($userId >0){
            $table = "c_authassignment";
            $result = CommonDB::deleteRow($table,array("adminId"=>$userId));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }
    public function actionLogout() {
        $url = new Url();
        Yii::app()->getModule("kktpanel")->user->logout();                           
        $this->redirect($url->createUrl("admin/login"));
    }
}
