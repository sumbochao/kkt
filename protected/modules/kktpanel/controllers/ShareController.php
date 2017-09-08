<?php
class ShareController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT share của thành viên','link'=>$url->createUrl("share/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 20; $arr_game_id = array();  
        $this->breadcrumbs[] = array('name'=>'Nội dung share','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        list($max_page,$count,$data) = AShare::getDataSearch($from_date,$to_date,$keyword,$type,$page,$row_per_page);

        $this->render("index",array("max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"keyword"=>$keyword,"type"=>$type,"page"=>$page));
    }
    public function actionAjaxDelete(){
        $time_now = time();
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_share";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
}
