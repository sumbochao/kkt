<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>

<script type="text/javascript">
    function ajaxDeleteCode(id){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxDeleteCode')?>";
        if(confirm('Bạn có chắc chắn muốn xóa không?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id: id,
                    status : status,
                },
                success:function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
        }
    }
    function ajaxUpdateStatus(id,giftcode_id)
    {   
        
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxUpdateStatus')?>";
        $.ajax({
            type :"GET",
            url: strUrl,
            data:{
                id:id,
                giftcode_id:giftcode_id
            },
            success:function(msg){
               
                    if(msg == 1){
                        alert('Thay Đổi Thành Công');
                        location.reload();
                       
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
    }
</script>

<div class="main clearfix">
    <div class="box clearfix">
        <ul class="form4">
            <li class="clearfix">
                <label><strong>Tiêu đề </strong>:</label>
                <div class="filltext">
                    <b><?php echo $giftcode['title']?></b>
                </div>
            </li>
            <li class="clearfix"><label><strong>Tên Game </strong>:</label>
                <div class="filltext">
                    <b><?php $game = GGame::getDataById($giftcode['game_id']); echo $game['name'];?></b>
                </div>
            </li>
            <li class="clearfix"><label><strong>Thể Loại </strong>:</label>
                <div class="filltext">
                    <b><?php $category = GCategory::getCateById($giftcode['category_id']); echo $category['name']?></b>
                </div>
            </li>
            <li class="clearfix"><label><strong>Nhà Phát Hành </strong>:</label>
                <div class="filltext">
                    <b><?php $publisher = GPublisher::getPublisherById($giftcode['publisher_id']); echo $publisher['name']?></b>
                </div>
            </li>
            <li class="clearfix">
                <label><strong>Số lượng </strong>:</label>
                <div class="filltext">
                    <b><?php echo $giftcode['total_giftcode']?></b>
                </div>
            </li>
            <li class="clearfix">
                <label><strong>Còn lại </strong>:</label>
                <div class="filltext">
                    <b><?php echo $giftcode['available_giftcode']?></b>
                </div>
            </li>
        </ul>
    </div>
</div>

<br>

<div class="main clearfix">
    <div class="box clearfix bottom30">

        <form method="GET">
            <ul class="form4">

                <li class="clearfix">
                    <div class="filltext">
                        <input type="hidden" style="width:195px;margin-right:15px" value="<?php echo $id?>" name="id">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Trạng Thái </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="2" <?php echo ($status == 2 ? 'selected="selected"':'' )?>>--Tất cả--</option>
                            <option value="1" <?php echo ($status == 1 ? 'selected="selected"':'' )?>>Active</option>
                            <option value="0" <?php echo ($status == 0 ? 'selected="selected"':'' )?>>Inactive</option>
                        </select>
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
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("gsgiftcode/createExcel",array('id'=>$id))?>"><input type="button" class="btn-bigblue" value=" Thêm mới bằng excel "></a>
                <a href="<?php echo $url->createUrl("gsgiftcode/createText",array('id'=>$id))?>"><input type="button" class="btn-bigblue" value=" Thêm mới bằng text "></a>
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
                        //var_dump($page);
                        //var_dump($max_page);
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>
    </div>
    
    
    
    <div class="table clearfix">
        <table width="100%" cellspacing="0" cellpadding="0" border="0"> 
            <tbody>
                <tr class="bg-grey">
                    <td><strong>STT</strong></td>
                    <td><strong>Gift Code</strong></td>
                    <td width="25%"><strong>Người sử dụng</strong></td>
                    <td width="15%"><strong>Trạng Thái</strong></td>
                    <td width="10%"><strong>Hành động</strong></td>
                </tr>

                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td><?php echo $key;?></td>
                        <td><?php echo $value['code'];?></td>
                        <td>
                            <?php 
                                //var_dump($value['user_id']);
                                if($value['user_id'] != 0)
                                {
                                    $user = GUser::getDataById($value['user_id']);
                                    //var_dump($user);
                                    echo $user['username'];
                                }
                            ?>
                        </td>
                        
                        <td><a href="javascript:void(0)" onclick="ajaxUpdateStatus('<?php echo $value["id"]?>',<?php echo $giftcode['id']?>)">  <?php echo $value['status']==1?"Active":"InActive";?>  </a></td>
                        <td>
                            <a href="<?php //echo $url->createUrl("gsgiftcode/editcode",array("id"=>$value["id"],'giftcode_id'=>$id))?>"> Sửa </a> - 
                            <a href="javascript:void(0)" onclick="ajaxDeleteCode('<?php echo $value["id"]?>')">  Xóa  </a>
                        </td>
                    </tr>
                    <?php }?>

            </tbody>
        </table>
    </div>
</div>