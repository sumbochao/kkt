<div id="header" class="bg_green">
    <div class="main clearfix">
        <ul class="list_style">
            <li <?php if($this->menuUserActive==1) { ?> class="active" <?php } ?> >
                <h1>
                    <a href="<?php echo Yii::app()->params["base_url"];?>" title="logo">
                        <img src="<?php echo Yii::app()->params["static_url"];?>images/logo.png" alt="cung kiem tien tren mobile" />
                    </a>
                </h1>
            </li>
            <li>
                <a target="_blank" href="http://diendan.kenhkiemtien.com">Diễn Đàn</a>
            </li>
            <li <?php if($this->menuUserActive==2) { ?> class="active" <?php } ?> >
                <a href="<?php echo Url::createUrl("/kktUser/index");?>">Cá nhân</a>
            </li>
            <li  <?php if($this->menuUserActive==3) { ?> class="active no_bor_r" <?php } else { ?> class="no_bor_r" <?php } ?> >
                <a href="<?php echo Url::createUrl("/kktUser/listApp");?>">Bán lẻ</a>
            </li>
            <!--<li  <?php if($this->menuUserActive==3) { ?> class="active no_bor_r" <?php } else { ?> class="no_bor_r" <?php } ?> >
                <a href="<?php echo Url::createUrl("/kktUser/gameOnline");?>">Phân phối</a>
            </li>-->
            <li  <?php if($this->menuUserActive==3) { ?> class="active no_bor_r" <?php } else { ?> class="no_bor_r" <?php } ?> >
                <a href="<?php echo Url::createUrl("/kktUser/work");?>">Tiện ích</a>
            </li>            
        </ul>
    </div>
</div> 