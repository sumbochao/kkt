<?php
class BoxContact extends CPortlet
{
    protected function renderContent()  
    {        
        $newsContact = Contact::getContactYahoo();
        $newsContact2 = Contact::getContactYahoo2();
     //   var_dump($newsContact);
        $this->render("box_contact", array('newsContact'=> $newsContact, 'newsContact2'=>$newsContact2));    
    }
}
?>