<?php
    class SmsController extends CpController
    {

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS Tin nhắn cute','link'=>'#','class'=>'active');
           
            $data_cat = ACategory::getAllData(7);
            //$row = ASms::getSms();
             
            $row_per_page = 5;
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
            $category = isset($_GET["category"]) ? intval($_GET["category"]):0;
            //var_dump($category);
            
            list($max_page,$count,$row) = ASms::searchSms($category,$page,$row_per_page);
            //var_dump(2);
            //var_dump($max_page);
            
            
            $this->render('index',array("row"=>$row,'data_cat'=>$data_cat,
            'max_page'=>$max_page,'count'=>$count,'page'=>$page,
            'category'=>$category));
            
        }

        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Tạo Tin nhắn cute','link'=>'#','class'=>'active');
            $data_cat = ACategory::getAllData(7);
            //var_dump($data_cat);die;
            $this->render('create',array('data_cat'=>$data_cat));
        }

        public function actionAjaxSave()
        {
            $time_now = time();
            $create_user = Yii::app()->user->name;
            $description = isset($_POST["description"])? htmlspecialchars(trim(strip_tags($_POST['description'])),ENT_QUOTES) :"";
            $status = isset($_POST["status"])? intval($_POST['status']) :0;
            $ishot = isset($_POST["ishot"])? intval($_POST['ishot']) :0;
            $category = isset($_POST["category"])? intval($_POST['category']) :61;

            $game_app_id = ASms::insertSms($category,$status,$ishot,$description,$create_user,$time_now);
            
            if($game_app_id >0){
                echo 1;
            }else{
                echo "Có lỗi xảy ra trong quá trình xử lý";exit;
            }

        }

        public function actionUpdate()
        {
            $id = $_GET['id'];
            $this->breadcrumbs[] = array('name'=>'Sửa tin nhắn cute','link'=>'#','class'=>'active');
            $data_cat = ACategory::getAllData(7);
            $row = ASms::getSmsId($id);
            $row = $row[0];
            //var_dump($row);
            $this->render('update',array('row'=>$row,'data_cat'=>$data_cat));
        }

        public function actionAjaxUpdate()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0;
            $description = isset($_POST["description"])? htmlspecialchars(trim(strip_tags($_POST['description'])),ENT_QUOTES) : "";
            $status = isset($_POST["status"])? intval($_POST['status']) :0;
            $hot = isset($_POST["hot"])? intval($_POST['hot']) :0;
            $category = isset($_POST["category"])? intval($_POST['category']) :61;

            $game_app_id = ASms::updateSms($category,$status,$hot,$description,$id);
            //var_dump($game_app_id);die;
            
            if($game_app_id >0){
                echo 1;
            }else{
                echo "Có lỗi xảy ra trong quá trình xử lý";exit;
            }

        }

        public function actionAjaxDelete()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0; 
            $game_app_id = ASms::deleteSms($id);
            if($game_app_id >0){
                echo 1;
            }else{
                echo "Có lỗi xảy ra trong quá trình xử lý";exit;
            }

        }

        public function actionAjaxQuick()
        {
            $id = isset($_POST['id'])? intval($_POST['id']): 0; 
            $status = isset($_POST["status"])? intval($_POST['status']) :0;
            $hot = isset($_POST["status"])? intval($_POST['hot']) :0;
            $game_app_id = ASms::quickSms($status,$hot,$id);
            //var_dump($game_app_id); die;
            if($game_app_id >0){
                echo 1;
            }else{
                echo "Chưa thay đổi dữ liệu";exit;
            }

        }
    }
?>
