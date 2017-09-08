<?php $url = new Url()?>
<div id="header">
    <div class="main clearfix">
        <h1 class="logo"><a title="logo của bạn" href="<?php echo $url->createUrl("home/index")?>"><span>Admin Tao Viec</span></a></h1>
        <div class="header-r clearfix">
            Tài khoản cá nhân: <a href="<?php echo $url->createUrl("admin/profile")?>"><strong><?php echo Yii::app()->getModule('kktpanel')->user->name;?></strong></a> 
            ( <a class="exit" href="<?php echo $url->createUrl("admin/logout")?>">Thoát</a> )
        </div>
        <!-- End main-->
    </div>
    <!-- End main-->
</div>
<!-- End header-->
<div id="menu-navi">
    <div class="main">
        <ul class="nav clearfix">    
            <li><a class="active" href="<?php echo $url->createUrl("home/index")?>"><span><strong><i class="home">&nbsp;</i></strong></span></a></li>
            <li><a href="#"><span><strong>QL Content</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("category/index")?>">DS Danh mục</a></li>
                    <li><a href="<?php echo $url->createUrl("audio/index")?>">DS Audio</a></li>
                    <li><a href="<?php echo $url->createUrl("album/index")?>">DS Album ảnh</a></li>
                    <li><a href="<?php echo $url->createUrl("comic/index")?>">DS Truyện Tranh</a></li>
                    <li><a href="<?php echo $url->createUrl("news/index")?>">DS Tin Tức</a></li>
                    <li><a href="<?php echo $url->createUrl("sms/index")?>">DS Tin Nhắn Cute</a></li>
                    <!--
                    <li><a href="<?php echo $url->createUrl("wapgame/index")?>">Quản lý Game Wap</a></li>
                    <li><a href="<?php echo $url->createUrl("game/index")?>">DS Game Store</a></li>
                    <li><a href="<?php echo $url->createUrl("gamelao/index")?>">DS Game Lào</a></li>
                    <li><a href="<?php echo $url->createUrl("video/index")?>">DS Video</a></li>
                    <li><a href="<?php //echo $url->createUrl("tips/index")?>">QL Tip</a></li>
                    <li><a href="<?php //echo $url->createUrl("boxAdv/index")?>">QL Box Quảng Cáo</a></li>
                    <li><a href="<?php //echo $url->createUrl("partner/index")?>">QL Nhà cung cấp</a></li>-->
                </ul>
            </li>
            <li><a href="#"><span><strong>QL Game Store</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("gscategory/index")?>">Danh Mục</a></li>
                    <li><a href="<?php echo $url->createUrl("gspublisher/index")?>">Nhà Phát Hành</a></li>
                    <li><a href="<?php echo $url->createUrl("gsgame/index")?>">Game Store</a></li>
                    <li><a href="<?php echo $url->createUrl("gsgiftcode/index")?>">Gift Code</a></li>
                    <li><a href="<?php echo $url->createUrl("gsnews/index")?>">Tin tức</a></li>
                    <li><a href="<?php echo $url->createUrl("gsgame/review")?>">Game Review</a></li>
                    <li><a href="<?php echo $url->createUrl("gsdiscussion/index")?>">Thảo luận</a></li>
                    <li><a href="<?php echo $url->createUrl("gsbanner/index")?>">Banner</a></li>
                   
                    <li><a href="<?php echo $url->createUrl("gsios/index")?>">DS Notify </a></li>
                    <li><a href="<?php echo $url->createUrl("gsCommentApp/index")?>">Phản hồi Góp ý</a></li>
                    <li><a href="<?php echo $url->createUrl("gsuser/index")?>">DS Người Dùng</a></li>
                </ul>
            </li>
              <li><a href="#"><span><strong>QL FootBall</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("footBallMatch/index")?>">QL Trận đấu</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallNews/index")?>">QL Tin tức</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallVideo/index")?>">QL Video</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallClub/index")?>">DS Club</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallCup/index")?>">DS Cup</a></li>
                    <li><a href="<?php echo $url->createUrl("footBaller/index")?>">DS Cầu thủ</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallCoach/index")?>">DS Huấn luyện viên</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallCountry/index")?>">DS Quốc gia</a></li>
                    <li><a href="<?php echo $url->createUrl("footBallUser/index")?>">DS User</a></li>
                </ul>
            </li>
            <li><a href="#"><span><strong>QL Facebook</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("fbaccount/index")?>">QL Tài khoản</a></li>
                    <li><a href="<?php echo $url->createUrl("fbcampaign/index")?>">QL Chiến dịch</a></li>
                    <li><a href="<?php echo $url->createUrl("fbmember/index")?>">Thành viên FB</a></li>
                    <li><a href="<?php echo $url->createUrl("fbmember/safe")?>">Kết bạn An Toàn</a></li>
                    <li><a href="<?php echo $url->createUrl("fbimport/index")?>">Import Tài khoản</a></li>
                    <li><a href="<?php echo $url->createUrl("facebookApp/index")?>">DS App Facebook</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><span><strong>QL App</strong></span></a>
                <ul class="menu-sub">
                    <!--<li><a href="<?php //echo $url->createUrl("version/index")?>">QL Version</a></li>-->
                    <li><a href="<?php echo $url->createUrl("app/index")?>">QL App</a></li>
                    <li><a href="<?php echo $url->createUrl("wap2u/index")?>">QL App Wap2u</a></li>
                    <!--<li><a href="<?php //echo $url->createUrl("advertise/index")?>">Banner của ứng dụng</a></li>-->
                </ul>
            </li>
           <!-- <li><a href="<?php echo $url->createUrl("member/index")?>"><span><strong>QL Khách hàng</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php //echo $url->createUrl("member/index")?>">Danh sách khách hàng</a></li>
                    <li><a href="<?php //echo $url->createUrl("chat/index")?>">QL Box chat</a></li>
                    <li><a href="<?php //echo $url->createUrl("share/index")?>">QL Box share</a></li>
                </ul>
            </li>-->
            <!--<li><a href="<?php echo $url->createUrl("report/userSms")?>"><span><strong>Thống kê doanh số</strong></span></a>
                <ul class="menu-sub">                    
                    <li><a href="<?php //echo $url->createUrl("report/userSms")?>">Thống kê doanh số Sms</a></li>
                    <li><a href="<?php //echo $url->createUrl("report/userCard")?>">Thống kê doanh số Card</a></li>                                     
                    <!--<li><a href="<?php //echo $url->createUrl("rate/index")?>">Quản lý tỷ lệ khách hàng</a></li>                                     
                    <li><a href="<?php //echo $url->createUrl("rate/sms")?>">Quản lý tỷ lệ sms nhà mạng</a></li>                                     
                    <li><a href="<?php //echo $url->createUrl("rate/card")?>">Quản lý tỷ lệ card nhà mạng</a></li>                                     
                    <li><a href="<?php //echo $url->createUrl("rate/service")?>">Quản lý tỷ lệ thuê đầu số</a></li>                                     
                </ul>
            </li>-->
            <li><a href="<?php echo $url->createUrl("admin/index")?>"><span><strong>QL admin</strong></span></a>
                <ul class="menu-sub">
                    <li><a href="<?php echo $url->createUrl("admin/index")?>">DS Admin</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>