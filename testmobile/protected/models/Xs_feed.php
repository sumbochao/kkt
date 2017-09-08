<?php
    class Xs_feed extends CActiveRecord
    {

        public static function getData()
        {
            $connect = Yii::app()->db;
            $sql = "SELECT * FROM xs_feed";
            $command = Yii::app()->db->createCommand($sql);
            $data = $command->queryAll();
            return $data;
        }

    }
?>
