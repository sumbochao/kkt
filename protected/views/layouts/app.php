<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
        <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" name="viewport">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <link media="all" href="<?php echo Yii::app()->params["static_url"];?>css/app.css?v=3.9" type="text/css" rel="stylesheet">
        <title>Danh sách App</title>
    </head>

    <body>
        <div id="wrapper">
            <div class="header">
                <div class="main">
                    <div class="logo">
                        <img width="137" height="40" src="<?php echo Yii::app()->params["static_url"];?>images/logo.png">
                    </div>
                </div>
            </div>
            <div class="container">
                <?php echo $content; ?>
            </div>
            <div id="footer">
                <div class="item mag0">
                    <div class="bg_blue" style="height: 28px;">
                        <ul class="list_style clearfix">
                            <li class="fl active"><a class="active block" title="" href="<?php echo Url::createUrl("game/rule"); ?>">Điều Khoản</a></li>
                            <li class="fl active"><a class="active block" title="" href="#">Liên Hệ</a></li>
                        </ul>
                    </div>
                    <div class="box pad10 pad-bt0">
                        <p>Copyright@kenhkiemtien.com</p>
                    </div>
                </div>
            </div>
        </div>


    </body></html>