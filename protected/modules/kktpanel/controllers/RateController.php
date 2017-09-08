<?php
class RateController extends CpController
{
    public function init()
    {
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT thống kê','link'=>$url->createUrl("report/index"),'class'=>'');
    }
    
    public function actionIndex()
    {
        $m = isset($_GET["m"]) ? intval($_GET["m"]) : date("m");
        $y = isset($_GET["y"]) ? intval($_GET["y"]) : date("Y");
        
        /* Lấy tỷ lệ của tháng */
        $rate = ARate::getRate($m, $y);
        
        if(isset($_POST["issue_rate_of_user_min"])){
            $data = array();
            $data["issue_rate_of_user_min"] = trim(strip_tags($_POST["issue_rate_of_user_min"]));
            $data["issue_rate_of_hdc_min"] = trim(strip_tags($_POST["issue_rate_of_hdc_min"]));
            $data["issue_rate_of_producer_min"] = trim(strip_tags($_POST["issue_rate_of_producer_min"]));
            $data["issue_price"] = trim(strip_tags($_POST["issue_price"]));
            $data["issue_price"] = Common::price_format($data["issue_price"]);
            $data["issue_price"] = intval($data["issue_price"]);
            $data["issue_rate_of_user_max"] = trim(strip_tags($_POST["issue_rate_of_user_max"]));
            $data["issue_rate_of_hdc_max"] = trim(strip_tags($_POST["issue_rate_of_hdc_max"]));
            $data["issue_rate_of_producer_max"] = trim(strip_tags($_POST["issue_rate_of_producer_max"]));
            
            $data["rate_of_user_min"] = trim(strip_tags($_POST["rate_of_user_min"]));
            $data["rate_of_hdc_min"] = trim(strip_tags($_POST["rate_of_hdc_min"]));            
            $data["price"] = trim(strip_tags($_POST["price"]));
            $data["price"] = Common::price_format($data["price"]);
            $data["price"] = intval($data["price"]);
            $data["rate_of_user_max"] = trim(strip_tags($_POST["rate_of_user_max"]));
            $data["rate_of_hdc_max"] = trim(strip_tags($_POST["rate_of_hdc_max"]));            
            
            $data["id"] = $rate["id"];
            $result = ARate::UpdateRate($data);
            if($result>=0){
                $this->redirect(Url::createUrl("rate/index", array("m"=>$m, "y"=>$y)));
            }
        }
        
        $this->render(
            "index"
            , array(
                "m"=>$m
                , "y"=>$y
                , "rate"=>$rate
            )
        );
    }
    
    public function actionSms()
    {
        $m = isset($_GET["m"]) ? intval($_GET["m"]) : date("m");
        $y = isset($_GET["y"]) ? intval($_GET["y"]) : date("Y");
        
        /* Lấy tỷ lệ của tháng */
        $rate = ARate::getRateSms($m, $y);
        
        if(isset($_POST["submit"]))
        {
            $data = array();
            foreach($rate as $row){
                $data[$row["id"]] = trim(strip_tags($_POST[$row["id"]]));                                
            }
            
            $result = ARate::updateRateSms($data);
            if($result>=0){
                $this->redirect(Url::createUrl("rate/sms", array("m"=>$m, "y"=>$y)));
            }
        }
        
        $this->render(
            "sms"
            , array(
                "m"=>$m
                , "y"=>$y
                , "rate"=>$rate
            )
        );
    }
    
    public function actionCard()
    {
        $m = isset($_GET["m"]) ? intval($_GET["m"]) : date("m");
        $y = isset($_GET["y"]) ? intval($_GET["y"]) : date("Y");
        
        /* Lấy tỷ lệ của tháng */
        $rate = ARate::getRateCard($m, $y);
        
        if(isset($_POST["submit"]))
        {
            $data = array();
            foreach($rate as $row){
                $data[$row["id"]] = trim(strip_tags($_POST[$row["id"]]));                                
            }
            
            $result = ARate::updateRateCard($data);
            if($result>=0){
                $this->redirect(Url::createUrl("rate/card", array("m"=>$m, "y"=>$y)));
            }
        }
        
        $this->render(
            "card"
            , array(
                "m"=>$m
                , "y"=>$y
                , "rate"=>$rate
            )
        );
    }
    
    public function actionService()
    {
        $m = isset($_GET["m"]) ? intval($_GET["m"]) : date("m");
        $y = isset($_GET["y"]) ? intval($_GET["y"]) : date("Y");
        
        /* Lấy tỷ lệ của tháng */
        $rate = ARate::getRateService($m, $y);
        
        if(isset($_POST["submit"]))
        {
            $data = array();
            foreach($rate as $row){
                $data[$row["id"]] = trim(strip_tags($_POST[$row["id"]]));                                
            }
            
            $result = ARate::updateRateService($data);
            if($result>=0){
                $this->redirect(Url::createUrl("rate/service", array("m"=>$m, "y"=>$y)));
            }
        }
        
        $this->render(
            "service"
            , array(
                "m"=>$m
                , "y"=>$y
                , "rate"=>$rate
            )
        );
    }  
}
?>