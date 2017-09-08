<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
 
    public function authenticate()
    {
        $user=AdminLogin::model()->findByAttributes(array('username'=>$this->username,'status'=>1));
        if($user===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if(!$user->validatePassword($this->password)){
            
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            echo $this->errorCode;die;
        }
        else
        {
            $this->_id=$user->id;
            $this->username=$user->username; 
            $this->errorCode=self::ERROR_NONE;
            
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}