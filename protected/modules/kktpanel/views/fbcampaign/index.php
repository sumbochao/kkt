<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDeleteLog(id)
    {
        var strUrl = "<?=$url->createUrl("fbcampaign/ajaxDeleteLog") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data: {
                    id:id
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert(msg);
                    }
                }   
            });
        }
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">

        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value=" Tìm kiếm" class="btn-bigblue"> 
                    </div>
                </li>

            </ul>
        </form>

    </div>

    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả 
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                        //var_dump(1);die;
                    ?>
                </ul>
            </div>
        </div>

        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>

                    <tr class="bg-grey">
                        <td><strong>Mã</strong></td>
                        <td><strong>Tên chiến dịch</strong></td>
                        <td><strong>Mã ứng dụng</strong></td>
                        <td><strong>Số lần gửi</strong></td>
                        <td><strong>Hành động</strong></td>
                    </tr>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key?></td>
                            <td><?php echo $value["title"]?></td>
                            <td><?php echo $value["fb_app_id"]?></td>
                            <td><?php echo $value["count_sent"]?></td>
                            <td>
                                <a href="<?php echo $url->createUrl("fbcampaign/log",array("id"=>$value["id"]))?>"> Log </a> -
                                <a href="javascript:void(0)" onclick="ajaxDeleteLog('<?php echo $value["id"]?>')">  Xóa Log  </a>
                            </td>
                        </tr>
                    <?php }?>

                </tbody>
            </table>
        </div>

    </div>
</div>
