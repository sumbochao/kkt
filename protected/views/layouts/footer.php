<?php
$control = Yii::app()->controller->id;
$action = Yii::app()->controller->action->id;
$ca = $control.'-'.$action;
?>
<div class="suport_ifo bg_green1 pad10">
    <ul class="list_style">
        <li class="pad_btt5">
            <a href="<?php echo Url::createUrl("/kktGeneral/paymentRule");?>"><strong>Quy định thanh toán</strong></a>
        </li>
        <li class="pad_btt5">
            <a href="<?php echo Url::createUrl("/kktGeneral/privacy");?>"><strong>Quy định sử dụng</strong></a>
        </li>
        <li class="pad_btt5">
            <a href="<?php echo Url::createUrl("/kktGeneral/help");?>"><strong>Trợ giúp</strong></a>
        </li>
        <li class="pad_btt5">
            <a href="<?php echo Url::createUrl("/kktGeneral/qa");?>"><strong>Câu hỏi thường gặp</strong></a>
        </li>
    </ul>
</div>
<div class="footer bg_gray2 pad10">
    <div class="menu_foter clearfix">
        <ul class="list_style">  
           <?php if($ca !='kktHome-index'){?>  
            <li><a href="<?php echo Yii::app()->params["base_url"];?>">Trang chủ</a>&nbsp;|&nbsp;</li> 
            <?php }?>                       
            <?php if(isset($_SESSION["userId"])) { ?>
                <li><a target="_blank" href="http://<?php echo $_SESSION["username"].'.'.Yii::app()->params["domain_member"];?>">Wap cá nhân</a></li>
                <li>&nbsp;|&nbsp;<a href="<?php echo Url::createUrl("kktUser/invite");?>">Link giới thiệu</a></li>
                <li>&nbsp;|&nbsp;                            
                    <a href="<?php echo Url::createUrl("kktUser/logout");?>" class="clorage">
                        <strong>Thoát </strong>(<?php echo $_SESSION["username"];?>)
                    </a>
                </li>        
                                
                <?php } ?>
        </ul>
    </div>
    <div class="ifo_foter cl333 clearfix">
        <span class="cl999">Copyright@kenhkiemtien.com</span><br/>
       <!-- <span class="cl999">Địa chỉ: Lô 6,B20, Khu Đô Thị Định Công - Quận Hoàng Mai - Hà Nội</span>-->
    </div>
</div>
</div>
<?php if(Yii::app()->params["showsql"]){ ?>
    <div class="showSql" style="margin: 20px 0;">                    
        <fieldset>
            <legend>Database</legend>
            <?php echo Yii::app()->db->showSql; ?>
        </fieldset>


    </div>
    <?php } ?>
   <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-35125308-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
    </body>
</html>