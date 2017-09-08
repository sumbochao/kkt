<?php
class AdminLogController extends CpController{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'Quản trị log admin','link'=>$url->createUrl("adminLog/index"),'class'=>'');
    }
    public function actionIndex(){
        $row_per_page = 50;
        $this->breadcrumbs[] = array('name'=>'Danh sách log','link'=>"#",'class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $username = isset($_GET["username"]) ? trim($_GET["username"]):"";
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $action = isset($_GET["action"]) ? intval($_GET["action"]):0;
        $object = isset($_GET["object"]) ? intval($_GET["object"]):0;     
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;     
        list($max_page,$count,$data) = AAdminLog::getDataSearch($from_date,$to_date,$username,$keyword,$action,$object,$page,$row_per_page);
        $this->render("index",array("data"=>$data,"page"=>$page,"count"=>$count,"max_page"=>$max_page,
        "from_date"=>$from_date,"to_date"=>$to_date,"username"=>$username,"keyword"=>$keyword,
        "action"=>$action,"object"=>$object));
    }
}