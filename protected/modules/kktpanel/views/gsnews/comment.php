

<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>

<script type="text/javascript">
    function deleteComment(id){
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: "<?=$url->createUrl("gsnews/deleteComment");?>",
                data:{
                    id: id,
                },
                success: function(msg){
                    if(msg == 1){
                        alert('Xóa thành công!');
                        location.reload();
                    }
                    else{
                        alert('Có lỗi');
                    }
                } 
            });
        }
    }
    
    function updateComment(id){
        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        $.ajax({
                type: "POST",
                url: "<?=$url->createUrl("gsnews/updateComment");?>",
                data:{
                    id: id,
                    status: status,
                },
                success: function(msg){
                    if(msg == 1)
                    {
                        alert('Cập nhật thành công!');
                        location.reload();
                    }
                    else{
                        alert('Có lỗi');
                    }
                }   
            });
    }
    
</script>

<div class="main clearfix">
    
     <div class="box clearfix bottom30">
        <form name="SearchForm" method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Tin tức Id </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $news_id;?>" name="news">
                    </div>
                </li>
                <li class="clearfix"><label><strong>Nội dung </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $keyword;?>" name="keyword">
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
                        //var_dump($page);
                        //var_dump($max_page);
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>
        
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td>STT</td>
                        <td>Nội dung</td>
                        <td>By</td>
                        <td>Trạng Thái</td>
                        <td>Hành Động</td>
                    </tr>
                    
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td><?php echo $value['comment'];?></td>
                            <td><?php $name=GUser::getDataById($value['user_id']); echo $name['username'] ?><br><?php echo $value['create_date']?></td>
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td>
                                <a href="javascript:void(0);" onclick="updateComment(<?php echo $value['id'];?>)">Lưu</a> -
                                <a href="javascript:void(0);" onclick="deleteComment(<?php echo $value['id'];?>)">Xóa</a> <br>
                            </td>
                        </tr>
                    <?php }?>
                    
                </tbody>
            </table>
        </div>
        
     </div>
    
</div>
