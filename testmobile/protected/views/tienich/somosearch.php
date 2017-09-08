

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
    
    function boxSearch(page){
        var search = $('.boxsearchSM').val();
        var url = "<?=$url->createUrl('tienich/search');?>";
        $.ajax({
            type:"POST",
            url: url,
            data: {
                search: search,
                page: page,
            },
            success:function(msg){
                $('.Main').html(msg);
            }
        });
    }
    
    function paging(search){
        var url = "<?=$url->createUrl('tienich/search');?>";
        var page = $('#paging').val();
        $.ajax({
            type:"POST",
            url: url,
            data: {
                search: search,
                page: page,
            },
            success:function(msg){
                $('.Main').html(msg);
            }
        });
    }
    
    function pageSearch(a,b){
        //alert('test');
        var url = "<?=$url->createUrl('tienich/search')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                page: a,
                search: b,
            },
            success:function(msg){
                $('.Main').html(msg);
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
    <div class="titleCHAT">
        Giải Mộng Sổ Mơ Số Đề
    </div>
    <div class="SM">
        <div class="searchSM">
            <input name="a" type="text" value="<?php echo $search;?>" placeholder="Nhập từ khóa tìm kiếm" size="5" maxlength="100" class="boxsearchSM" />
            <center>
                <div style="margin:20px 0 20px 0;">
                    <a href="javascript:void(0);" onclick="boxSearch(1);" class="buttonsearchSMS">Tìm Kiếm</a>
                </div>
            </center>
        </div>
        <div class="searchLetters"></div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="bg_cam">
                <td class="SM_1"><p style="color: #000;">STT</p></td>
                <td class="SM_2"><p style="color: #000;">Bạn mơ thấy gì</p></td>
                <td class="SM_2"><p style="color: #000;">Cặp số tương ứng</p></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#e6e6e6">
        
            
            <?php for($i=0;$i<count($data);$i++){?>
                <tr <?php if($i%2==0){echo 'class="bg_white"';}else{echo 'class="bg_xam"';}?> >
                    <td class="SM_1"><?php echo $i+1;?></td>
                    <td class="SM_2"><strong class="red"><?php echo $data[$i]['title_long'];?></strong></td>
                    <td class="SM_2"><strong class="cam"><?php echo $data[$i]['result'];?></strong></td>
                </tr>
            <?php }?>
            
            
        </table>
        <!--<div class="trangSM">
            Trang 
            <input value="<?php //echo $page;?>" id="paging" style="width:20px; text-align: right;">
            trong
            <?php //echo $total_page;?>
            <a href="javascript:void(0);" class="button_KQ" onclick="paging('<?php //echo $search;?>');">Đến</a>
        </div>-->
        
        <div class="trangSM">
            Trang
            <?php
                if(isset($search))
                {
                    $pageing = Common::pageSearch($total_page,$page,$search);
                    echo $pageing;
                }
                else
                {
                    $pageing = Common::pageSomo($total_page,$page);
                    echo $pageing;
                }
            ?>
        </div>
        
        <div class="sms_LOTOTT" style="padding-bottom:8px;">
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