<?php
    $url_help ="#"
?>
<div class="container">
    <div class="main clearfix">
        <div class="news pad10 bg_orage3"></div>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Map domain cá nhân vào <?php echo Yii::app()->params["domain_member"];?> </strong></h2>
            <div class="box pad10 bor_top">

                <strong>Để trỏ domain vào shop giúp việc Seo wap của các bạn được hiệu quả hơn, mời các bạn vui lòng thực hiện theo các bước sau : <br>
                    <br>
                    Bước 1 </strong>. Bạn trỏ tên miền (khai báo bản ghi A) của bạn về địa chỉ IP: 210.245.90.243 <br>
                <strong>Bước 2 </strong>. Khai báo tên miền kênh kiếm tiền của bạn vào ô bên dưới<br/>
                Tham khảo hướng dẫn
            <a target="_blank" href="<?php echo $url_help; ?>"> <span class="clblue">Tại đây</span></a> 
                
            </div>
        </div>
        <div class="search pad10 bor_top">
            <form method="post">
                <input name="domain" type="text" style="width:80%" value="<?php echo $domain_return; ?>">
                <input type="submit" value="Thêm domain"/>
                <span id="result_submit" name="result_submit" style="color: red"><?php echo $mes; ?></span> 
            </form>
        </div>
        <h3 class="s12 bottom3">&nbsp;&nbsp;Danh sách Domain</h3>
        <?php if($list_domain){?>
            <div class="box pad10 bor_top">
                <?php foreach($list_domain as $row){ ?>
                    <span class="mag_r5"><?php echo $row['domain']; ?></span>
                    <a href="<?php echo Url::createUrl("kktUser/deleteDomain",array('id'=>$row['id']));?>" class="del clblue">Xóa</a>  
                    <br/>
                    <?php } ?>
            </div>
            <?php } ?>
    </div>
</div>