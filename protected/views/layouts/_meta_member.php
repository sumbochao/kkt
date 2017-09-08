<meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="vi" http-equiv="content-language" />
<?php

        if(!isset($this->metaTitle) || $this->metaTitle == "")
            $this->metaTitle = Yii::app()->params['title'];

    ?>
<title><?php echo CHtml::encode(substr(rtrim($this->metaTitle,", "),0, 200)); ?></title>
<meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords) ;?>"/>  
<meta name="description" content="<?php echo $this->metaDescription; ?>"/> 
<?php
	if($this->linkCanoncical!='')
	{
	?>
	<link rel="canonical" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$this->linkCanoncical;?>" /> 
	<?php
	}
?>
<meta name="robots" content="index,follow" />
<meta name="revisit-after" content="1 days"/>
<meta name="COPYRIGHT" content="Wapsite" />
<link rel="stylesheet" type="text/css" href="<?php  echo Yii::app()->params['static_url']; ?>css/style.css" media="all" />
<script src="<?php  echo Yii::app()->params['static_url']; ?>js/jquery-1.7.2.min.js" type="text/javascript"></script>