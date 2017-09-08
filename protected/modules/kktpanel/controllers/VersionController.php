<?php
class VersionController extends CpController
{
    public function init(){
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT version','link'=>$url->createUrl("version/index"),'class'=>'');
    }
    public function actionIndex(){
        $this->breadcrumbs[] = array('name'=>'Danh sách version','link'=>"#",'class'=>'active');
        $data = AVersion::getAllData();
        $this->render("index",array("data"=>$data));
    }

    public function actionCreate(){
        $this->breadcrumbs[] = array('name'=>'Thêm mới version','link'=>"#",'class'=>'active');
        $this->render("create");
    }
    public function actionAjaxSaveVersion(){
        $url = new Url();
        $error = false;
        $create_date = time();
        $type = isset($_POST["type"]) ? intval($_POST["type"]):0;
        $version = isset($_POST["version"]) ? trim($_POST["version"]):"";
        if($version==""){
            $error[]= "Chưa nhập version";
        }
        $arr_file = array("jar","jad");
        //var_dump($_FILES);die;
        foreach ($arr_file as $value){
            if(!isset($_FILES[$value]["name"])){                  
                $error[]= "Chưa upload file App ".$value;
            }else{
                $arr_name = explode(".",$_FILES[$value]["name"]);
                if($arr_name[count($arr_name)-1] !=$value){
                    $error[]= "Phải upload đúng định dạng file ".$value;                
                }
            }
        }
        if(!$error){
            foreach($arr_file as $value){
                $tmp_name = $_FILES[$value]["tmp_name"];
                switch($type){
                    case 1:
                        $filename = "MyGame.".$value;
                        break; 
                    case 2:
                        $filename = "MyVideo.".$value;
                        break;
                    case 3:
                        $filename = "MyImage.".$value;
                        break;
                } 
                //$file_location = 'E:\wamp\www\hdc\wapcontent\upload\app';
                $file_location = getcwd().'/upload';
                $upload_dir = $file_location.'/'.$filename;
                @move_uploaded_file($tmp_name, "$upload_dir");
            }
            $data_update = array(
            "isNew"=>array("value"=>0,"type"=>1),
            "type"=>array("value"=>$type,"type"=>1),
            );
            $table = "c_version";
            $result = CommonDB::updateRow($table,$data_update,array("type"));
            $data = array(            
            "type"=>array("value"=>$type,"type"=>1),
            "version"=>array("value"=>$version,"type"=>2),
            "isNew"=>array("value"=>1,"type"=>1),
            "create_date"=>array("value"=>$create_date,"type"=>1),
            );                             
            $last_id = CommonDB::insertRow($table,$data);
            if($last_id >0){
                if($type==1){
                    $table = "c_build_game";
                    $params = array(
                    "isBuild"=>array("value"=>0,"type"=>1)
                    );
                    $result = CommonDB::updateRow($table,$params,array());
                }
                $this->redirect($url->createUrl("version/index"));
            }else{
                $this->breadcrumbs[] = array('name'=>'Thêm mới version','link'=>"#",'class'=>'active'); 
                $this->render("create",array("error"=>"Có lỗi trong quá trình xử lý! Hãy thử lại"));exit;
            }
        }else{
            $this->breadcrumbs[] = array('name'=>'Thêm mới version','link'=>"#",'class'=>'active'); 
            $this->render("create",array("error"=>$error));exit;
        }

    }

    public function actionAjaxDelete(){
        $id = isset($_POST["id"]) ? intval($_POST["id"]):0;
        if($id >0){
            $table = "c_version";
            $result = CommonDB::deleteRow($table,array("id"=>$id));
            if($result >0){
                echo 1;
            }else{
                echo "Có lỗi trong quá trình xử lý";exit;
            }
        }
    }

}
