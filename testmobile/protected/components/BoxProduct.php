<?php
class BoxProduct extends CPortlet
{
    protected function renderContent()  
    {	
    	$type = 3;
    	$news = News::getHotNews($type, 10);	
        $this->render("box_product", 
	        array(
		        'news' => $news
		        , 'type' => $type
	        )
        );    
    }
}
?>