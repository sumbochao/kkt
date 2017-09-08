<?php
class BoxNews extends CPortlet
{
    protected function renderContent()  
    {	
    	$type = 4;
    	$news = News::getHotNews($type, 10);	
        $this->render("box_news", 
	        array(
		        'news' => $news
		        , 'type' => $type
	        )
        );    
    }
}
?>