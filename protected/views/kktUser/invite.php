<div class="container">
    <div class="main clearfix">
        <div class="emb_bann pad10">
            <div class="mag_btt_t5">
                <span>
                    <Strong>Link giới thiệu Thành viên</Strong>
                    <br/>
                    - Bạn đã là thành viên của Kenhkiemtien.com. Bạn hãy giới thiệu và mời các thành viên khác cùng tham gia kiếm tiền online trên kenhkiemtien.com.
                    Bạn sẽ được hưởng ngay 3% doanh thu của tất cả các thành viên bạn đã giới thiệu. 
                    <br/>
                    <br/>
                    - Thật đơn giản Bạn hãy gửi link đăng kí thành viên dưới đây cho những người quan tâm.
                    </br/>
                    </br/>
                    - <a href="">chính sách hưởng doanh thu giới thiệu thành viên</a> 
                    <br/>
                    <br/>
                    <?php
                        $url_invite = 'http://' . $_SERVER["HTTP_HOST"] . Url::createUrl("kktUser/register",array("userId"=>$_SESSION["userId"]));
                    ?>
                    <input type="text" style="width: 100%;" readonly="readonly" value="<?php echo $url_invite;?>" onclick="this.select();"/>
                </span><br />                   
            </div>
        </div>
    </div>
</div>