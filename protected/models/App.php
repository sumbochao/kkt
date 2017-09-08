<?php
    class App extends CActiveRecord
    {
        public function getDataLastest($page,$num_per_page){

            $connect =Yii::app()->db;
            $sql="SELECT count(id) as total FROM c_app WHERE status = 1";
            $command=$connect->createCommand($sql);
            $row = $command->queryRow();
            $total=$row['total'];
            $begin = ($page - 1) * $num_per_page;
            $sql="SELECT * FROM c_app WHERE status = 1  ORDER BY order_app  ASC LIMIT ".$begin.",".$num_per_page."";
            $command=$connect->createCommand($sql);
            $rows = $command->queryAll();            
            /*Paging*/
            $num_page=ceil($total/$num_per_page);
            $url=Url::createUrl('apps/index');
            $url1=$url;
            $url.='/';
            $paging=Paging::show_paging_wap_user($num_page,$page,$url,$url1);
            $a=array($rows,$paging);
            return $a;
        }   
    }
?>
