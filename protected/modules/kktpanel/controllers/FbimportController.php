<?php
    /**
     * @author Thanh tung
     *
     */
    
    class FbimportController extends CpController
    {
        
        public function init()
        {
            $url = new Url();
            $this->breadcrumbs[] = array('name'=>'Impost Tài Khoản','link'=>$url->createUrl("fbimport/index"),'class'=>'');
        }
        
        public function actionIndex()
        {
            
            $this->render('index');
        }
        
        public function actionAjaxImport()
        {
            $file = isset($_POST['file'])? trim(strip_tags($_POST['file'])): "";
            
            if($file=="")
            {
                echo "Chưa nhập file";exit;
            }
            
            $file_path = './upload/gamestore/facebook/'.date('Y/md',time()).'/'.$file;
            $arr_data = Yii::app()->yexcel->readActiveSheet($file_path);
            foreach ($arr_data as $data)
            {
                if (filter_var($data["B"], FILTER_VALIDATE_EMAIL))
                {
                    $result = 1;
                    $data["D"] = isset($data["D"])? $data["D"]: "";
                    $data["E"] = isset($data["E"])? $data["E"]: "";
                    try {
                        $result = FAccount::insertAccount($data["B"],$data["C"],$data["D"],$data["E"]);
                    } catch (Exception $e) {
                        
                    }
                }
            }
            
            if($result > 0)
            {
                echo $result;
            }
        }
        
    }
?>
