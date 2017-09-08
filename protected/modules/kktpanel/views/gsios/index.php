<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
    //var_dump($path_paging);
?>

<script type="text/javascript">
    function ajaxDelete(id){
        strUrl = "<?=$url->createUrl('gsios/ajaxDelete')?>";
        if(confirm('Bạn có chắc chắn muốn xóa?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id:id,
                },
                success:function(msg){
                    if(msg==1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
        }
    }
    
    function ajaxQuickUpdate(id){
        strUrl = "<?=$url->createUrl('gsios/ajaxQuickUpdate')?>";
        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id:id,
                    status: status,
                },
                success:function(msg){
                    if(msg==1){
                        alert('Lưu thành công');
                        location.reload();
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">

        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Nội dung </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Trạng Thái</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="2" <?php if($status==2){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="1" <?php if($status==1){echo 'selected="selected"';}?>>Active</option>
                            <option value="0" <?php if($status==0){echo 'selected="selected"';}?>>Inactive</option>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Kiểu </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="type">
                            <option value="0" <?php if($type==0){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="1" <?php if($type==1){echo 'selected="selected"';}?>>Thông báo quản trị</option>
                            <option value="2" <?php if($type==2){echo 'selected="selected"';}?>>Tb Game</option>
                            <option value="3" <?php if($type==3){echo 'selected="selected"';}?>>Tb Giftcode</option>
                            <option value="4" <?php if($type==4){echo 'selected="selected"';}?>>Tb Tin tức</option>
                            <option value="5" <?php if($type==5){echo 'selected="selected"';}?>>Tb Chat</option>
                            <option value="6" <?php if($type==6){echo 'selected="selected"';}?>>Tb Thảo luận</option>
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
                Tìm thấy <strong class="clred"><?php echo $count ?></strong> kết quả - 
                
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
                    <td><strong>Nội dung</strong></td>
                    <td><strong>Đối tượng ID</strong></td>
                    <td><strong>Url</strong></td>
                    <td><strong>Kiểu</strong></td>
                    <td><strong>Trạng Thái</strong></td>
                    <td><strong>Hành động</strong></td>
                </tr>
                
                <?php foreach($data as $key=>$value){$key+=1;
                 //1: Tb Quan tri;2: Game; 3 Giftcode; 4: Tin tuc; 5: Chat; 6: Comment TL;
                switch($value['type']){
                    case 1:
                    $type = "Tb Quan tri";
                    break;
                     case 2:
                    $type = "Tb Game";
                    break;
                     case 3:
                    $type = "Tb Giftcode";
                    break;
                     case 4:
                    $type = "Tb Tin tức";
                    break;
                     case 5:
                    $type = "Tb Chat";
                    break;
                     case 6:
                    $type = "Tb Thảo luận";
                    break;
                    
                }
                ?>
               
                    <tr>
                        <td><?php echo $key;?></td>
                        <td><?php echo $value['content'];?></td>
                        <td><?php echo $value['object_id'];?></td>
                        <td><?php echo $value['url'];?></td>
                        <td>
                            <?php 
                                echo $type;
                            ?>
                        </td>
                         <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Active</td>
                         <td>
                            <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> 
                         </td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
    </div>
    
</div>