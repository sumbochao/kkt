<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging); 
?>
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("gsuser/ajaxQuickUpdate") ?>";
        var chat = 0;var discussion = 0;
        if($("#chat_"+id).is(":checked")){ chat = 1; }
        if($("#discussion_"+id).is(":checked")){ discussion = 1; }
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                chat: chat,
                discussion: discussion,
                id:id,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
                    location.reload();
                }else{
                    alert(msg);
                }
            }          
        });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form name="SearchForm" method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Email or Full Name </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php echo $keyword;?>" name="keyword">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Chat</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="chat">
                            <option value="2" <?php if($chat==2){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="1" <?php if($chat==1){echo 'selected="selected"';}?>>Chặn</option>
                            <option value="0" <?php if($chat==0){echo 'selected="selected"';}?>>Cho Phép</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Comment</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="comment">
                            <option value="2" <?php if($comment==2){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="1" <?php if($comment==1){echo 'selected="selected"';}?>>Chặn</option>
                            <option value="0" <?php if($comment==0){echo 'selected="selected"';}?>>Cho Phép</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Thảo luận</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="discussion">
                            <option value="2" <?php if($discussion==2){echo 'selected="selected"';}?>>--Tất cả--</option>
                            <option value="1" <?php if($discussion==1){echo 'selected="selected"';}?>>Chặn</option>
                            <option value="0" <?php if($discussion==0){echo 'selected="selected"';}?>>Cho Phép</option>
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
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả 
            </div>

            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>

        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="3%"><strong>STT</strong></td>
                        <td><strong>UserName</strong></td>
                        <td><strong>FullName</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Phone</strong></td>
                        <td><strong>Địa chỉ</strong></td>
                        <td><strong>Ngày Tạo</strong></td>
                        <td width="8%"><strong> Chat</strong></td>
                        <td width="8%"><strong>Comment</strong></td>
                        <td width="10%"><strong>Hành Động</strong></td>
                    </tr>

                    <?php //var_dump(1);die;?>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td><?php echo $value['username'];?></td>
                            <td><?php echo $value['fullname'];?></td>
                            <td><?php echo $value['email'];?></td>
                            <td><?php echo $value['mobile'];?></td>
                            <td><?php echo $value['address'];?></td>
                            <td><?php echo $value['create_date'];?></td>
                            
                            <td>
                             <a href="<?php echo $url->createUrl("gsuser/viewBan",array("id"=>$value["id"]))?>">
                           <?php echo $value["is_ban_chat"]==1 ? 'view':'';?></a>
                            <input type="checkbox" value="1" id="chat_<?php echo $value["id"]?>" <?php echo $value["is_ban_chat"]==1 ? 'checked="checked"':'';?>> 
                            <a href="<?php echo $url->createUrl("gsuser/banChat",array("id"=>$value["id"]))?>">Chặn </a>
                            </td>
                            <td>
                              <a href="<?php echo $url->createUrl("gsuser/viewBan",array("id"=>$value["id"]))?>">
                           <?php echo $value["is_ban_comment_new"]==1 ? 'view':'';?></a>
                            <input type="checkbox" value="1" id="discussion_<?php echo $value["id"]?>" <?php echo $value["is_ban_comment_new"]==1 ? 'checked="checked"':'';?>> 
                            <a href="<?php echo $url->createUrl("gsuser/banComment",array("id"=>$value["id"]))?>"> Chặn </a>
                           </td>
                            <td>
                                <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value['id']?>')"> Lưu </a> |
                                <a href="<?php echo $url->createUrl("gsuser/detail",array("id"=>$value["id"]))?>"> Xem Chi Tiết </a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
        </div>
    </div>

</div>
