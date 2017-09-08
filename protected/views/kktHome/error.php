<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Địa chỉ này không tồn tại. - Error</title>
        <meta name="robots" content="noindex,nofollow" />        
        <meta http-equiv="refresh" content="30; URL=<?php echo Yii::app()->params["base_url"];?>" />    
        <style type="">
            .mss_expired,.mss_del, .add_zero {background:none;padding:10px;border:1px solid #f2f2f2;margin-bottom: 10px;padding: 20px 10px;text-align:center}
            .mss_expired h3, .mss_del h3, .add_zero h3 {margin:0;padding:15px 0 15px 10px;font-size:18px}
            .clred {
                color: #F50000;
            }
            h3 {
                font-size: 24px;
                line-height: 1.2;
            }
        </style>        
    </head>
    <body>        
        <div class="add_zero" style="width: 720px; text-align: center; margin: 100px auto;">
            <h3 class="clred"><strong>Error <?php //echo $error["code"]; ?></strong></h3><br />
            <div class="error">
                <?php //echo CHtml::encode($error["message"]); ?>
                Không tồn tại trang bạn yêu cầu
            </div>
            <p>Hi! Hãy <a href="http://<?php echo Yii::app()->params["domain_member"];?>"><strong>ấn vào đây</strong></a>,nếu không 30 giây sau sẽ tự động quay về</p>
        </div>
    </body>
</html>
