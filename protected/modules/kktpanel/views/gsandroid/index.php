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
        strUrl = "<?=$url->createUrl('gsandroid/ajaxDelete')?>";
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
        strUrl = "<?=$url->createUrl('gsandroid/ajaxQuickUpdate')?>";
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
                <li class="clearfix"><label><strong>Title </strong>:</label>
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
                            <option value="3" <?php if($type==3){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="0" <?php if($type==0){echo 'selected="selected"';}?>>Mở chức năng App</option>
                            <option value="1" <?php if($type==1){echo 'selected="selected"';}?>>Mở 1 website</option>
                            <option value="2" <?php if($type==2){echo 'selected="selected"';}?>>Cài đặt App</option>
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
                <a href="<?php echo $url->createUrl("gsandroid/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                    <td><strong>Tiêu Đề</strong></td>
                    <td><strong>Url</strong></td>
                    <td><strong>Kiểu</strong></td>
                    <td><strong>Trạng Thái</strong></td>
                    <td><strong>Hành động</strong></td>
                </tr>
                
                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td><?php echo $key;?></td>
                        <td><?php echo $value['title'];?></td>
                        <td><?php echo $value['url'];?></td>
                        <td>
                            <?php 
                                if($value['type']==0){echo 'Mở chức năng App';}
                                elseif($value['type']==1){echo 'Mở 1 websiet';}
                                elseif($value['type']==2){echo 'Cài đặt App';}
                            ?>
                        </td>
                         <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Active</td>
                         <td>
                            <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value['id']?>')"> Lưu </a> |
                            <a href="<?php echo $url->createUrl("gsandroid/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                            <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> 
                         </td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
    </div>
    
</div>