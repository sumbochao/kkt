<?php
    class MyActiveRecord extends CActiveRecord 
    {
        private static $db_gamestore = null;

        protected static function getGameStoreDbConnection()
        {
            if (self::$db_gamestore !== null)
                return self::$db_gamestore;
            else
            {
                self::$db_gamestore = Yii::app()->db_gamestore;
                if (self::$db_gamestore instanceof CDbConnection)
                {
                    self::$db_gamestore->setActive(true);
                    return self::$db_gamestore;
                }
                else
                    throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }
?>
