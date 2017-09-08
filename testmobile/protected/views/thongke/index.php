
<?php
    $url = new Url();
?>

<script type="text/javascript">
    $(document).ready(function(){

        $('#mienbac').addClass('active');

        loadChat("<?=$url->createUrl('home/chat')?>");

        setInterval(function(){
            var url = "<?=$url->createUrl('home/chat')?>";
            loadChat(url);
            },5000);

        $(".tableTK ul li").each(function(){
            $(this).find(".line_boxTK2").animate({
                width:$(this).attr("data")
                },3000);
        });

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
    <div class="titleCHAT"> Thống kê nhanh Xổ số Miền Bắc </div>
    <div class="TK">
        <div class="titleTK"> 12 bộ số ra nhiều nhất trong 10 ngày qua </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">
            <ul>

                <?php for($i=0;$i<count($bosoranhieu);$i++){ ?>
                    <li data="<?php echo $bosoranhieu[$i]['percent'];?>%">
                        <div class="numberTK_1">
                            <div class="boxTK_2"><?php echo $bosoranhieu[$i]['boso'];?></div>
                        </div>
                        <div class="numberTK_2">
                            <div class="line_boxTK">
                                <div class="line_boxTK2"></div>
                            </div>
                        </div>
                        <div class="numberTK_3">
                            <div class="boxTK_3"><?php echo $bosoranhieu[$i]['percent'];?>%</div>
                        </div>
                    </li>
                    <?php } ?>

            </ul>
        </div>

        <div class="titleTK"> 12 bộ số ra ít nhất trong 10 ngày qua </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">
            <ul>

                <?php for($i=0;$i<count($bosorait);$i++){ ?>
                    <li data="<?php echo $bosorait[$i]['percent'];?>%">
                        <div class="numberTK_1">
                            <div class="boxTK_2"><?php echo $bosorait[$i]['boso'];?></div>
                        </div>
                        <div class="numberTK_2">
                            <div class="line_boxTK">
                                <div class="line_boxTK2"></div>
                            </div>
                        </div>
                        <div class="numberTK_3">
                            <div class="boxTK_3"><?php echo $bosorait[$i]['percent'];?>%</div>
                        </div>
                    </li>
                    <?php } ?>

            </ul>
        </div>

        <div class="titleTK" id="lientiep">
            Những bộ số ra liên tiếp (Lô rơi)
        </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">

            <?php for($i=0;$i<count($bosolientiep);$i++){?>
                <div class="numberTK_4">
                    <div class="boxTK_1">
                        <?php echo $bosolientiep[$i]['dodai_chuky'];?> lần
                    </div>
                    <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-arrow4.png" width="4" height="7" class="boxTK_icon" />    
                    <div class="boxTK_2"><?php echo $bosolientiep[$i]['boso'];?></div>
                </div>
                <?php }?>

            <div class="both"></div>
        </div>
        
        <div class="titleTK" id="gan">
            Những bộ số không ra liên tiếp 10 ngày trở lên
        </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">

            <?php for($i=0;$i<count($bosokhan);$i++){?>
                <div class="numberTK_4">
                    <div class="boxTK_1">
                        <?php echo $bosokhan[$i]['sn'];?> lần
                    </div>
                    <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-arrow4.png" width="4" height="7" class="boxTK_icon" />    
                    <div class="boxTK_2"><?php echo $bosokhan[$i]['boso'];?></div>
                </div>
                <?php }?>

            <div class="both"></div>
        </div>

        <div class="titleTK"> Thống kê đầu số xuất hiện trong 10 ngày qua: </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">
            <ul>

                <?php for($i=0;$i<count($arr_dau);$i++){ ?>
                    <li data="<?php echo $arr_dau[$i]['percent'];?>%">
                        <div class="numberTK_1">
                            <div class="boxTK_2"><?php echo $arr_dau[$i]['dau_so'];?></div>
                        </div>
                        <div class="numberTK_2">
                            <div class="line_boxTK">
                                <div class="line_boxTK2"></div>
                            </div>
                        </div>
                        <div class="numberTK_3">
                            <div class="boxTK_3"><?php echo $arr_dau[$i]['percent'];?>%</div>
                        </div>
                    </li>
                    <?php } ?>

            </ul>
        </div>
        
        <div class="titleTK"> Thống kê đầu số xuất hiện trong 10 ngày qua: </div>
        <div class="lineTK">
            <div class="lineTK2"></div>
        </div>
        <div class="tableTK">
            <ul>

                <?php for($i=0;$i<count($arr_dit);$i++){ ?>
                    <li data="<?php echo $arr_dit[$i]['percent'];?>%">
                        <div class="numberTK_1">
                            <div class="boxTK_2"><?php echo $arr_dit[$i]['dit_so'];?></div>
                        </div>
                        <div class="numberTK_2">
                            <div class="line_boxTK">
                                <div class="line_boxTK2"></div>
                            </div>
                        </div>
                        <div class="numberTK_3">
                            <div class="boxTK_3"><?php echo $arr_dit[$i]['percent'];?>%</div>
                        </div>
                    </li>
                    <?php } ?>

            </ul>
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
        <!--<div name="CHAT" class="From" contenteditable="true"></div>-->
    </div>
    <div style="padding:15px 20px 20px 0; text-align:right;">
        <img src="<?php echo Yii::app()->params['static_url'];?>images/xo-so-10h-icon-yahoo.png" width="22" height="22" style="padding-right:10px;" /><a href="javascript:void(0);" onclick="messenger();" class="button_KQ">Gửi bình luận</a>
    </div>
</div>