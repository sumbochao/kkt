<?php
    class GscategoryController extends CpController
    {

        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'QT Danh Mục Game Store','link'=>$url->createUrl("GsCategory/index"),'class'=>'');
        }

        public function actionIndex()
        {
            $this->breadcrumbs[] = array('name'=>'DS danh mục game store','link'=>'#','class'=>'active');
            $row_per_page = 20;
            $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
            $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
           
            list($max_page,$count,$data) = GCategory::getDataSearch($keyword,$row_per_page,$page);
           
            
            $this->render('index',array('data'=>$data,'max_page'=>$max_page,'count'=>$count,'page'=>$page));
        }

        public function actionCreate()
        {
            $this->breadcrumbs[] = array('name'=>'Thêm mới danh mục game store','link'=>'#','class'=>'active');
            $this->render('create');
        }

        public function actionEdit()
        {
            $this->breadcrumbs[] = array('name'=>'Sửa danh mục game store','link'=>'#','class'=>'active');
            $id = isset($_GET["id"]) ? intval($_GET["id"]):0;
            $data = GCategory::getCateById($id);
            $this->render('edit',array('data'=>$data));
        }
        // ajax quick save
        public function actionAjaxQuickUpdate()
        {
           
            $id = isset($_POST['id'])? intval($_POST['id']): '';
            $order_view_new= isset($_POST['order_view_new']) ? trim($_POST['order_view_new']):"";
            $data= GCategory::ajaxQuickSave($id,$order_view_new);
            if($data)
            {
                echo 1;exit();
            } 
        }
        public function actionAjaxSaveCategory()
        {
            $time_now = date('Y-m-d H:i:s');
            $create_user = Yii::app()->user->name;
            $cat_name = isset($_POST["cat_name"]) ? trim(strip_tags($_POST["cat_name"])):"";
            $picture = isset($_POST["picture"]) ? trim($_POST["picture"]):"";
            $order_view =  isset($_POST["order_view"]) ? trim($_POST["order_view"]):"";
            if($cat_name ==""){
                echo "Tên danh mục không được để trống";exit;
            }
            if($order_view ==""){
                echo "Muc sắp xếp không được để trống";exit;
            }
            if(Common::generate_slug($cat_name)==''){
                echo "Tên danh mục không hợp lệ";exit;
            }

            $last_id = GCategory::insertCate($cat_name,$picture,$time_now,$create_user,$order);

            if($last_id >0)
            {
                echo 1;exit();
            }

        }

        public function actionAjaxDelete(){
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            $data = GCategory::getCateById($id);
            $image = $data['image'];
            $date = $data['create_date'];
            $location = getcwd();
            $location1 = $location."/upload/gamestore/category/". date('Y/md',strtotime($date))."/". $image ;
            $location2 = $location. "/upload/gamestore/category/". date('Y/md',strtotime($date))."/m_". $image ;
            //var_dump($location2);die;
            @unlink($location1);
            @unlink($location2);
            $result = GCategory::deleteCate($id);
            if($result >0){
                echo 1;exit();
            }else{
                echo "Không tồn tại danh mục này";
            }
        }

        public function actionAjaxUpdate(){
            $update_date = date('Y-m-d H:i:s');
            $update_user = Yii::app()->user->name;
            $cat_name = isset($_POST["cat_name"]) ? trim(strip_tags($_POST["cat_name"])):"";
            $picture = isset($_POST["picture"]) ? trim($_POST["picture"]): "";
            $order_view= isset($_POST["order_view"]) ? trim($_POST["order_view"]):"";
            $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
            if($cat_name ==""){
                echo "Tên danh mục không được để trống";exit;
            }
            if($order_view== "")
            {
                echo "Thứ tự sắp xếp không được để trống";exit;
            }
            $result = GCategory::updateCate($id,$cat_name,$picture,$update_date,$update_user,$order_view);
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }

        }

    }
?>
