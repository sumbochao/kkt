<?php
class HomeController extends CpController
{
    public function actionIndex(){
        $this->render("index");
    }
    
    public function actionError()
    {        
        $this->layout = false;
        $error = Yii::app()->errorHandler->error;
        var_dump($error);die;
        $this->render(
            "error"            
        );        
    }
    
    public function actionTest(){
        $sql = "INSERT INTO c_rate(month,year,rate_of_user,rate_of_taoviec) VALUE(9,2012,80,20),(10,2012,80,20)";
        $command = Yii::app()->db->createCommand($sql);
        echo $command->execute(); 
    }
}
