<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params["static_url_cp"]?>/css/theme.css" media="all" />
        <link href="<?php echo Yii::app()->params['static_url_cp'];?>/js/colorbox/colorbox.css" type="text/css" rel="stylesheet">     
        <script src="<?php  echo Yii::app()->params['static_url']; ?>/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php  echo Yii::app()->params['static_url_cp']; ?>/js/function.js" type="text/javascript"></script> 
        <script src="<?php  echo Yii::app()->params['static_url_cp']; ?>/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script> 
        <title>Trang quản trị - wapcontent</title>
    </head>
    <body>
        <div id="wrapper">
            <!-- End navigation-->
            <?php require_once("header.php");?>
            <div id="pathway">
                <div class="main clearfix">
                    <ul class="path clearfix">
                        <?php echo $this->getBreadcrumbs();?> 
                    </ul>
                </div>
                <!-- End main-->
            </div>
            <div id="container">
                <?php     

                    echo $content;

                ?>
                <!-- End main-->

            </div>
            <!-- End container-->
            <?php require_once("footer.php");?>

            <!-- End Footer -->
        </div>
        <!-- End wrapper-->




    </body>
</html>




