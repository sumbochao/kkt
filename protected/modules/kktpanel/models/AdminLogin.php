<?php
class AdminLogin extends CActiveRecord{

    public $remember;
    
    public static function model($className = __CLASS__) {
        return parent::model ( $className );
    }

    public function rules()
    {
        return array(
            array('username','passExists'),
        );
    }         

    public function tableName() {                  
        return 'c_admin';
    }
    
    public function validatePassword($password)
    {
        return $this->hashPassword($password)===$this->password;
    }
 
    public function hashPassword($password)
    {
        return md5(md5($password));
    }
      
    public function passExists($attribute, $params) {
        if (!$this->hasErrors($attribute))
        {
            $connect = Yii::app()->db;
            $pass = $this->hashPassword($this->password);
            $command = $connect->createCommand("SELECT id FROM c_admin WHERE username= '".$this->username."' AND password ='".$pass."'");
            $user = $command->queryRow();
            if (is_null($user) || $user==false)
            {
                $this->addError('username', 'Tài khoản và mật khẩu không chính xác!');
                return false;
            }
        }
    }


    
}
