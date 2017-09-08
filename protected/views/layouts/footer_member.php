<?php $domain=Common::getSubDomain(); ?>
<div class="footer bg_gray2 pad10">    
    <div class="ifo_foter cl333 clearfix">
        <?php
            $session=new CHttpSession;
            $session->open();
            $link = $_SERVER['HTTP_HOST'];
            if($session['domain']!=null) $link = $session['domain'];
            $session->close();
        ?>
        <span class="cl999">© 2012 by <em class="clorage"><a class="clorage" href="http://<?php echo $link;?>"><?php echo $link ;?></a></em></span>
    </div>
</div>
</div>
<?php
    $domains = Common::getUserDomain();
    if(count($domains)==3){
        $username = $domains[0];
    }elseif($_SERVER["HTTP_HOST"] !="kenhkiemtien.com"){
        $data_user_domain = ShopDomain::getOneDomain($_SERVER["HTTP_HOST"]);
        if($data_user_domain){
            $username = $data_user_domain["user_name"];
        }

    }else{
        $username = "dola";
    }
    $data_config = ShopConfig::getDataByUsername($username);
    if($data_config){
        echo $data_config["ga"];
    }
?>
</body>
</html>
