<?php
    $url = new Url();
?>
<div class="main clearfix">
    <div class="admin clearfix">
        <div class="col30">
            <h1><strong>QL Danh mục</strong></h1>
            <ol>
                <li><a href="<?php echo $url->createUrl("category/index")?>">Danh sách Danh mục</a></li>
            </ol>
        </div>
        <div class="col30">
            <h1><strong>QL Content</strong></h1>
            <ol>
                <li><a href="<?php echo $url->createUrl("game/index")?>">DS Game Store</a></li>
                <li><a href="<?php echo $url->createUrl("album/index")?>">DS Album ảnh</a></li>
                <li><a href="<?php echo $url->createUrl("video/index")?>">DS Video</a></li>
                <li><a href="<?php echo $url->createUrl("audio/index")?>">DS Audio</a></li>
                <li><a href="<?php echo $url->createUrl("comic/index")?>">DS Truyện Tranh</a></li>
                <li><a href="<?php echo $url->createUrl("wapgame/index")?>">Quản lý Game Wap</a></li>
                <li><a href="<?php echo $url->createUrl("news/index")?>">DS Tin Tức</a></li>
                <li><a href="<?php echo $url->createUrl("sms/index")?>">DS Tin nhắn cute</a></li>
                <li><a href="<?php echo $url->createUrl("gamelao/index")?>">DS Game Lào</a></li>
            </ol>
        </div>
        <div class="col30">
            <h1><strong>QT Ứng dụng</strong></h1>
            <ol>
                <li><a href="<?php echo $url->createUrl("app/index")?>">QL App</a></li>
                <li><a href="<?php echo $url->createUrl("wap2u/index")?>">QL App Wap2u</a></li>
            </ol>
        </div>
        <div class="col30">
            <!--<h1><strong>QT Khách hàng</strong></h1>
            <ol>
                <li><a href="<?php //echo $url->createUrl("member/index")?>">Danh sách khách hàng</a></li>
                <li><a href="<?php //echo $url->createUrl("chat/index")?>">QL Box chat</a></li>
                <li><a href="<?php //echo $url->createUrl("share/index")?>">QL Box share</a></li>
            </ol>-->
        </div>
        <div class="col30">
             <h1><strong>QL admin</strong></h1>
            <ol>
                <li><a href="<?php echo $url->createUrl("admin/index")?>">DS Admin</a></li> 
            </ol>
        </div>

        <div class="col30">
            <!--<h1><strong>Thống kê doanh số</strong></h1>
            <ol>
                <li><a href="<?php //echo $url->createUrl("report/hdc")?>">Thống kê doanh số TTV</a></li>
                <li><a href="<?php //echo $url->createUrl("report/user")?>">Thống kê doanh số User</a></li>              
            </ol>-->
           
        </div>

    </div>
</div>