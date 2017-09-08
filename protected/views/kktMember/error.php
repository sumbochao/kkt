<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $domain=Common::getSubDomain(); ?> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex,nofollow " />
        <title>Không tồn trang này - Error</title>
        <meta http-equiv="refresh" content="30; URL=http://<?php echo $domain;?>.<?php echo Yii::app()->params["domain_member"];?>" />
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
            <h3 class="clred"><strong>Error <?php echo $error["code"]; ?></strong></h3><br />
            <div class="error">
            <?php echo CHtml::encode($error["message"]); ?>
            </div>
            <p>Để quay về trang chủ bạn vui lòng <a href="http://<?php echo $domain.'.'.Yii::app()->params["domain_member"];?>"><strong>ấn vào đây</strong></a>,hoặc hệ thống sẽ tự động quay về sau 30 giây</p>
        </div>
    </body>
</html>
