<?php
define("PHPMAILER_ROOT", dirname(__FILE__) . '/');
require(PHPMAILER_ROOT . 'phpmailer/class.phpmailer.php');  
    
class Mailer
{
    public $mail;
    public $content;
    public $title;
    
    public function __construct($mailObject)
    {
        $this->mail = $mailObject;   
    }
    
    public function setContent($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }
    
    public function sendMail($email)
    {
        try {              
            $this->mail->SMTPDebug  = 0;
            $this->mail->SMTPAuth   = true;
            $this->mail->Host       = "mail.taoviec.com";
            $this->mail->Port       = 25;            
            $this->mail->Username   = "no-reply@taoviec.com";
            $this->mail->Password   = "Noreply!@#";
            $this->mail->AddAddress($email, "taoviec.com");
            $this->mail->SetFrom("no-reply@taoviec.com", "Ban quản trị TaoViec");
            $this->mail->AddReplyTo("no-reply@taoviec.com", "Ban quản trị TaoViec");
            $this->mail->Subject = $this->title;
            $this->mail->CharSet  = 'UTF-8';
           
            $this->mail->MsgHTML($this->content);

            $this->mail->Send();
            $send_error = "";
        } catch (phpmailerException $e) {
            $send_error = $e->errorMessage(); //Pretty error messages from PHPMailer
        } 
        catch (Exception $e) {
            $send_error = $e->getMessage(); //Boring error messages from anything else!
        }
        echo $send_error;
    }   
}
?>
