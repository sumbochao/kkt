<html xmlns="http://www.w3.org/1999/xhtml">
	    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
		<meta content="IE=EmulateIE7" http-equiv="X-UA-Compatible" />
		<meta content="vi" http-equiv="content-language" />
 	    </head>
<body>
<?php 
    require_once("http://210.245.90.243:8181/JavaBridge/java/Java.inc");
	$searcher = new java("com.ttv.search.GameAndroidSearch","/home/search/gameAndroid/");
	//var_dump($searcher);
	//echo 1;die;
	$topDocs = $searcher->query("ban sung",1, 10); ;
	$topDocs = $searcher->queryRecomment("khat von*");
	$docs = java_values($topDocs) ;
	$num_row=count($docs);
	echo $num_row;
	for($i=0;$i<$num_row;$i++)
	{
	  echo "<br>".$i.$docs[$i]->name.$docs[$i]->id;	
			 
	}
	//echo "Total=".$searcher->getTotalHit();

?>
</body>
</html>
	

