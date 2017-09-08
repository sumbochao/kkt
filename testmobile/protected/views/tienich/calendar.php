
<?php
    $url = new Url();
?>

<script type="text/javascript">
    $(document).ready(function(){

        loadChat("<?=$url->createUrl('home/chat')?>");

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

    });

    function messenger(){
        var messenger = $('.From').val();
        var url = "<?=$url->createUrl('home/chat'); ?>";
        $.ajax({
            type: "GET",
            url: url,
            global: false,
            data: {
                messenger: messenger,
            },
            success: function(msg){
                if(msg==1){
                    alert('Bạn phải đăng nhập để tán gẫu');
                }
                if(msg==0){
                    alert('Bạn phải chưa nhập nội dung');
                }
                else
                {
                    $("#CHAT").html(msg);
                    $('.From').val('');
                }
            }
        });
    };

    function loadChat(url){
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{},
            success: function(msg){
                $("#CHAT").html(msg);
            }
        });
    }
    
    loadBoxNote();
    
    function loadBoxNote()
    {
        var url = "<?=$url->createUrl('home/boxnote'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            global: false,
            data:{},
            success: function(msg){
                $("#boxnote").html(msg);
            }
        });
    }

</script>


<div class="bg_white shadow m-t-10">
    <div class="Note" id="boxnote"></div>
</div>
<div class="bg_white m-t-10 shadow">    
    <div class="titleLMT">
        Lịch quay xổ số mở thưởng & mã tỉnh dùng cho nhắn tin
    </div>
    <div class="tableLMT">
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">
            <tr class="bg_xam">
                <td class="dayLMT"><strong class="red">Mở thưởng</strong></td>
                <td class="tinhLMT">
                    <strong>Miền Bắc<br /> (mã: MB)</strong><br />
                    Quay lúc: <strong class="red">18h15’</strong>
                </td>
                <td class="tinhLMT">
                    <strong>Miền Trung<br />  (mã: MT)</strong><br />
                    Quay lúc: <strong class="red">17h15’</strong>    
                </td>
                <td class="tinhLMT">
                    <strong>Miền Nam<br /> (mã: MN)</strong><br />
                    Quay lúc: <strong class="red">16h15’</strong>
                </td>
            </tr>
            <tr class="bg_white">
                <td class="dayLMT">Thứ 2</td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($mon);$i++){?>
                        <?php if($mon[$i]['region'] == 1){?>
                            <?php echo $mon[$i]['name'];?>: <strong class="red"><?php echo $mon[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($mon);$i++){?>
                        <?php if($mon[$i]['region'] == 2){?>
                            <?php echo $mon[$i]['name'];?>: <strong class="red"><?php echo $mon[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($mon);$i++){?>
                        <?php if($mon[$i]['region'] == 3){?>
                            <?php echo $mon[$i]['name'];?>: <strong class="red"><?php echo $mon[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr>
                <td class="dayLMT bg_white">Thứ 3</td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($tue);$i++){?>
                        <?php if($tue[$i]['region'] == 1){?>
                            <?php echo $tue[$i]['name'];?>: <strong class="red"><?php echo $tue[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($tue);$i++){?>
                        <?php if($tue[$i]['region'] == 2){?>
                            <?php echo $tue[$i]['name'];?>: <strong class="red"><?php echo $tue[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($tue);$i++){?>
                        <?php if($tue[$i]['region'] == 3){?>
                            <?php echo $tue[$i]['name'];?>: <strong class="red"><?php echo $tue[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr class="bg_white">
                <td class="dayLMT">Thứ 4</td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($wed);$i++){?>
                        <?php if($wed[$i]['region'] == 1){?>
                            <?php echo $wed[$i]['name'];?>: <strong class="red"><?php echo $wed[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($wed);$i++){?>
                        <?php if($wed[$i]['region'] == 2){?>
                            <?php echo $wed[$i]['name'];?>: <strong class="red"><?php echo $wed[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($wed);$i++){?>
                        <?php if($wed[$i]['region'] == 3){?>
                            <?php echo $wed[$i]['name'];?>: <strong class="red"><?php echo $wed[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr>
                <td class="dayLMT bg_white">Thứ 5</td>
                <td class="tinhLMT bg_xam">
                   <?php for($i=0;$i<count($thu);$i++){?>
                        <?php if($thu[$i]['region'] == 1){?>
                            <?php echo $thu[$i]['name'];?>: <strong class="red"><?php echo $thu[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($thu);$i++){?>
                        <?php if($thu[$i]['region'] == 2){?>
                            <?php echo $thu[$i]['name'];?>: <strong class="red"><?php echo $thu[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($thu);$i++){?>
                        <?php if($thu[$i]['region'] == 3){?>
                            <?php echo $thu[$i]['name'];?>: <strong class="red"><?php echo $thu[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr class="bg_white">
                <td class="dayLMT">Thứ 6</td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($fri);$i++){?>
                        <?php if($fri[$i]['region'] == 1){?>
                            <?php echo $fri[$i]['name'];?>: <strong class="red"><?php echo $fri[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($fri);$i++){?>
                        <?php if($fri[$i]['region'] == 2){?>
                            <?php echo $fri[$i]['name'];?>: <strong class="red"><?php echo $fri[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($fri);$i++){?>
                        <?php if($fri[$i]['region'] == 3){?>
                            <?php echo $fri[$i]['name'];?>: <strong class="red"><?php echo $fri[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr>
                <td class="dayLMT bg_white">Thứ 7</td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($sat);$i++){?>
                        <?php if($sat[$i]['region'] == 1){?>
                            <?php echo $sat[$i]['name'];?>: <strong class="red"><?php echo $sat[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($sat);$i++){?>
                        <?php if($sat[$i]['region'] == 2){?>
                            <?php echo $sat[$i]['name'];?>: <strong class="red"><?php echo $sat[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT bg_xam">
                    <?php for($i=0;$i<count($sat);$i++){?>
                        <?php if($sat[$i]['region'] == 3){?>
                            <?php echo $sat[$i]['name'];?>: <strong class="red"><?php echo $sat[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
            <tr class="bg_white">
                <td class="dayLMT">Chủ nhật</td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($sun);$i++){?>
                        <?php if($sun[$i]['region'] == 1){?>
                            <?php echo $sun[$i]['name'];?>: <strong class="red"><?php echo $sun[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($sun);$i++){?>
                        <?php if($sun[$i]['region'] == 2){?>
                            <?php echo $sun[$i]['name'];?>: <strong class="red"><?php echo $sun[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
                <td class="tinhLMT">
                    <?php for($i=0;$i<count($sun);$i++){?>
                        <?php if($sun[$i]['region'] == 3){?>
                            <?php echo $sun[$i]['name'];?>: <strong class="red"><?php echo $sun[$i]['code'];?></strong><br />
                            <?php }?>
                        <?php }?>
                </td>
            </tr>
        </table>
        <div class="sms_LOTOTT" style="padding-bottom:5px;">
            <?php echo Yii::app()->params['static_sms'];?>
        </div>
    </div>
</div>
<div class="CHAT shadow">
    <div class="titleCHAT">
        Tán Gẫu
    </div>
    <div class="boxCHAT" id="CHAT"> </div>
    <div class="userCHAT">
        <textarea name="CHAT" placeholder="Nhập nội dung chat" cols="50" rows="2" class="From"></textarea>
    </div>
    <div style="padding:15px 20px 20px 0; text-align:right;">
        <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-yahoo.png" width="22" height="22" style="padding-right:10px;" /><a href="javascript:void(0);" onclick="messenger();" class="button_KQ">Gửi bình luận</a>
    </div>
</div>