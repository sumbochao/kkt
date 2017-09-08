<?php
class KktWapthugianController extends Controller{
    public function actionIndex(){
        
    }
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            $this->renderPartial('error',array("error"=>$error));
        }
        else
        {
            throw new CHttpException(404, 'Trang không tồn tại.');
        }
    }
}
