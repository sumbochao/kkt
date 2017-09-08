<?php
  class GameController extends Controller
{
    public function actionIndex()
    {   
        
        $this->layout="app";
        $num_per_page = 5;
        $url = new Url();    
        $page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        list($data, $paging) = GameApp::getDataLastest($page, $num_per_page);  
        $this->render("index", array("data"=>$data, "paging"=>$paging));
    }
    public function actionRule()
    {   
        $this->layout="app";
        $this->render("rule");
    }
}
?>
