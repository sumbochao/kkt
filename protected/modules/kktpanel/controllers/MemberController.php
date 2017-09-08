<?php
class MemberController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT thành viên','link'=>$url->createUrl("member/index"),'class'=>'');
    }

    public function actionIndex(){
        /* Xuất excel */        
        $search = array();
        $search["username"] = isset($_GET["username"]) ? trim(strip_tags($_GET["username"])) : "";        
        $search["day"] = isset($_GET["day"]) ? intval($_GET["day"]) : "";
        $search["month"] = isset($_GET["month"]) ? intval($_GET["month"]) : date("m");
        $search["year"] = isset($_GET["year"]) ? intval($_GET["year"]) : date("Y");                        
        $search["start"] = isset($_GET["start"]) ? intval($_GET["start"]) : 0;
        $search["end"] = isset($_GET["end"]) ? intval($_GET["end"]) : 0;
        $search["order"] = isset($_GET["order"]) ? trim(strip_tags($_GET["end"])) : "";
        
        $row_per_page = 20; $arr_game_id = array();  
        $this->breadcrumbs[] = array('name'=>'DS thành viên','link'=>'#','class'=>'active');
        $from_date = isset($_GET["from_date"]) ? trim($_GET["from_date"]):"";
        $to_date = isset($_GET["to_date"]) ? trim($_GET["to_date"]):"";
        $keyword = isset($_GET["keyword"]) ? trim($_GET["keyword"]):"";
        $type = isset($_GET["type"]) ? intval($_GET["type"]):0;
        $active = isset($_GET["active"]) ? intval($_GET["active"]):2;
        $isBan = isset($_GET["isBan"]) ? intval($_GET["isBan"]):2;
        $page = isset($_GET["page"]) ? intval($_GET["page"]):1;
        list($max_page,$count,$data) = AMember::getDataSearch($from_date,$to_date,$keyword,$type,$active,$isBan,$page,$row_per_page);

        $this->render("index",array("max_page"=>$max_page,"count"=>$count,"data"=>$data,
        "from_date"=>$from_date,"to_date"=>$to_date,"keyword"=>$keyword,"type"=>$type,
        "active"=>$active,"isBan"=>$isBan,"page"=>$page,"search"=>$search));
    }
    public function actionAjaxQuickUpdate(){
        $time_now = time();
        $active = isset($_POST["active"]) ? intval($_POST["active"]):0;
        $isBan = isset($_POST["isBan"]) ? intval($_POST["isBan"]):0;
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $data = array(
            "isBan"=>array("value"=>$isBan,"type"=>1),
            "active"=>array("value"=>$active,"type"=>1),
            "id"=>array("value"=>$id,"type"=>1)
            );
            if($active==1){
                $key_active = "";
                $data["key_active"] = array("value"=>$key_active,"type"=>2);
            }
            $table = "c_user";
            $result = CommonDB::updateRow($table,$data,array("id"));
            if($result >0){
                echo 1;exit();
            }else{
                echo "Chưa thay đổi dữ liệu";
            }
        }
    }
    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        $data = AMember::getDataById($id);
        if($data){
            $url_forder = getcwd().'/upload/user/'.$data["username"];
            $del = Common::delete_directory($url_forder);
            if($del){
                $table = "c_my_adv";
                $result = CommonDB::deleteRow($table,array("userId"=>$id));
                $table = "c_build_game";
                $result = CommonDB::deleteRow($table,array("userId"=>$id)); 
                $result = AMember::deleteUserForumByUsername($data["username"]);
                $table = "c_user";
                $result_user = CommonDB::deleteRow($table,array("id"=>$id));
                if($result_user >0){
                    echo 1;exit();
                }
            }else{
                echo "Chưa xóa được foder dữ liệu của thành viên này";exit;
            }
        }else{
            echo "Không tồn tại thành viên này";exit;
        }
    }
}
