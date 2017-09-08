
<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>

<script type="text/javascript">
    
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("gsbanner/ajaxDelete") ?>";
        if(confirm('Bạn có chắn chắn muốn xóa?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id:id,
                },
                success: function(msg){
                    if(msg==1){
                        alert('Xóa thành công');
                        location.reload();
                    }
                    else{
                        alert('Có lỗi');
                    }
                }
            });
        }
    }
    
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("gsbanner/ajaxQuickUpdate") ?>";
        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id:id,
                    status: status,
                },
                success: function(msg){
                    if(msg==1){
                        alert('Sửa thành công');
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
    
        <div class="box clearfix bottom30">
            <form method="GET">
            
                <ul class="form4">
                    <li class="clearfix"><label><strong>Tên Banner </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Game ID </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $game?>" name="game">
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Category </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="category">
                                <option value="0">--Tất cả--</option>
                                <?php for($i=0;$i<count($category);$i++){?>
                                    <option value="<?php echo $category[$i]['id'];?>" <?php echo ($cate_id == $category[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $category[$i]['name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Hệ điều hành </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="os">
                                <option value="0">--Tất cả--</option>
                                <option value="2" <?php if($os==2){echo 'selected="selected"';}?>>Android</option>
                                <option value="3" <?php if($os==3){echo 'selected="selected"';}?>>IOS</option>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Vị trí </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="position">
                                <option value="0">--Tất cả--</option>
                                <option value="1" <?php if($position==1){echo 'selected="selected"';}?>>Top Hot</option>
                                <option value="2" <?php if($position==2){echo 'selected="selected"';}?>>Top News</option>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Hiển thị </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="status">
                                <option value="2" <?php if($status==2){echo 'selected="selected"';}?>>--Tất cả--</option>
                                <option value="1" <?php if($status==1){echo 'selected="selected"';}?>>-Hiển thị-</option>
                                <option value="0" <?php if($status==0){echo 'selected="selected"';}?>>-Không-</option>
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
    
    </div>
    
    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
                Tìm thấy <strong class="clred"><?php echo $count ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("gsbanner/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                    <td width="4%"><strong>STT</strong></td>
                    <td width="50%"><strong>Banner</strong></td>
                    <td width="10%"><strong>OS</strong></td>
                    <td width="10%"><strong>Vị Trí</strong></td>
                    <td width="10%"><strong>Trạng Thái</strong></td>
                    <td width="10%"><strong>Hành động</strong></td>
                </tr>
                
                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td><?php echo $key;?></td>
                        <td>
                            <strong><?php echo $value['name']?></strong>
                            <br>
                            <?php $game = GGame::getDataById($value['game_id']);echo $game['name'];?> - <?php $cate = GCategory::getCateById($value['cate_id']);echo $cate['name'];?>
                            <br>
                            <img style="width: 50%;" src="<?php echo Yii::app()->params['urlImages']?>gamestore/banner/<?php echo date('Y/md',strtotime($value['create_date']))?>/<?php echo $value['image']?>" />
                        </td>
                        <td><?php if($value['os']==2){echo "Android";}else{echo "IOS";}?></td>
                        <td><?php if($value['position']==1){echo "Top Hot";}else{echo "Top New";}?></td>
                        <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                        <td>
                            <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value['id']?>')"> Lưu </a> |
                            <a href="<?php echo $url->createUrl("gsbanner/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                            <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> 
                        </td>
                    </tr>
                <?php }?>
                
            </tbody>
        </table>
    </div>
    
</div>
