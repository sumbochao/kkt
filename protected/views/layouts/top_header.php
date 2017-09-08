<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <!--<meta http-equiv="refresh" content="0; url=http://www.kenhkiemtien.com/danh-sach-app" />-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url"];?>css/style.css" media="all" />
    <?php

        if(!isset($this->metaTitle) || $this->metaTitle == "")
            $this->metaTitle = Yii::app()->params['title'];

    ?>
    <title><?php echo CHtml::encode($this->metaTitle); ?></title>
    </head>
    
    <body>
        <div class="wrapper">