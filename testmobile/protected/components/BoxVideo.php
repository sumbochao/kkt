<?php
class BoxVideo extends CPortlet
{
    protected function renderContent()  
    {        
          $newsVideo = Video::getVideo();
     //   var_dump($newsContact);
        $this->render("box_video",  array('newsVideo'=> $newsVideo));    
    }
}
?>