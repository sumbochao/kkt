<?php
  class AppsController extends Controller
{
    public function actionError()
    {        
        $this->layout = false;
        $error = Yii::app()->errorHandler->error;
        //var_dump($error);die;
        $this->render(
            "error"            
        );        
    }
    public function actionIndex()
    {   
        
        $this->layout="app";
        $num_per_page = 10;
        $url = new Url();    
        $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        list($data, $paging) = App::getDataLastest($page, $num_per_page);
        $this->render("index", array("data"=>$data, "paging"=>$paging));
    }
}
?>
