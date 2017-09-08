<?php
class KktGeneralController extends Controller
{
	public function actionIntro()
    {
        $this->render("intro");
    }
    
    public function actionPaymentRule()
    {
        $this->render("payment_rule");
    }
    public function actionHelp()
    {
        $this->render("help");
    }
	public function actionQa()
    {
        $this->render("qa");
    }
	public function actionPrivacy()
    {
        $this->render("privacy");
    }
	public function actionPolicy()
    {
        $this->render("policy");
    }
}
?>