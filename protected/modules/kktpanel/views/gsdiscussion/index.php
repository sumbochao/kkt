
<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function deleteDiscussion(id){
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: "<?=$url->createUrl("gsdiscussion/deleteDiscussion");?>",
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

    function updateDiscussion(id){
        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        $.ajax({
            type: "POST",
            url: "<?=$url->createUrl("gsdiscussion/updateDiscussion");?>",
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
                <li class="clearfix"><label><strong>Game Id </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $game_id;?>" name="game">
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
                        <td><strong>STT</strong></td>
                        <td><strong>Hình ảnh</strong></td>
                        <td><strong>Nội dung</strong></td>
                        <td><strong>Game</strong></td>
                        <td><strong>By</strong></td>
                        <td><strong>Trạng Thái</strong></td>
                        <td><strong>Hành Động</strong></td>
                    </tr>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td>
                                <?php //if(file_exists(Yii::app()->params['urlImages'].'gamestore/discussion/'.date('Y/md',strtotime($value['create_date'])).'/'.$value['image']  )){?>  
                                    <img src="<?php echo Yii::app()->params['urlImages'];?>gamestore/discussion/<?php echo date('Y/md',strtotime($value['create_date']))?>/<?php echo $value['image']?>" style="width: 75px;height: 75px;">
                                    <?php //}else{?>
                                    <!--<img src="<?php //echo Yii::app()->params['static_url'];?>/images/avata_default.gif" style="width: 75px;height: 75px;">-->
                                    <?php //}?>
                            </td>
                            <td><?php echo $value['content'];?></td>
                            <td><?php $game = GGame::getDataById($value['game_id']); echo $game['name']?></td>
                            <td><?php $name=GUser::getDataById($value['user_id']); echo $name['username'] ?><br><?php echo $value['create_date']?></td>
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td>
                                <a href="javascript:void(0);" onclick="updateDiscussion(<?php echo $value['id'];?>)">Lưu</a> -
                                <a href="javascript:void(0);" onclick="deleteDiscussion(<?php echo $value['id'];?>)">Xóa</a> <br>
                                <a href="<?php echo $url->createUrl('gsdiscussion/comment',array('id'=>$value['id']))?>">Discussion</a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
        </div>     
    </div>

</div>