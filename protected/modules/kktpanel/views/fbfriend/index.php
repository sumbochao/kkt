<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://connect.facebook.net/en_US/sdk.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        FB.init({
            appId      : '351382901706185',
            status     : true,
            xfbml      : true,
            version    : 'v2.2'
        });

        document.getElementById('add').onclick = function(){
            <?php 
                foreach($data as $value){
                ?>
                FB.ui({ 
                    method: 'friends',
                    id: '<?php echo $value['friend_id'];?>',
                    },
                    function(response){
                        if (response && !response.error_code) {
                            $.ajax({
                                type: "POST",
                                url: "<?=$url->createUrl("fbfriend/ajaxRequestFriend") ?>",
                                data: {
                                    id: "<?php echo $value['id'];?>",
                                },
                                success: function(msg){
                                    //alert(msg);
                                }   
                            });
                        } else {
                            //alert('Error while posting.');
                        }
                    }
                );
                <?php }?>

        }
    });

    function ajaxDeleteFriend(id){
        var strUrl = "<?=$url->createUrl("fbfriend/ajaxDeleteFriend") ?>";
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
    
    function ajaxDeleteAll(id){
        var strUrl = "<?=$url->createUrl("fbfriend/ajaxDeleteAll") ?>";
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

    function requestFriend(friend_id,id){

        FB.ui({ 
            method: 'friends',
            id: friend_id,
            },
            function(response){
                if (response && !response.error_code) {
                    $.ajax({
                        type: "POST",
                        url: "<?=$url->createUrl("fbfriend/ajaxRequestFriend") ?>",
                        data: {
                            id: id
                        },
                        success: function(msg){
                            //alert(msg);
                        }   
                    });
                } else {
                    //alert('Error while posting.');
                }
            }
        );

    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">

        <form method="GET">
            <ul class="form4">

                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                        <input type="hidden" style="width:195px;margin-right:15px" value="<?php echo $id?>" name="id">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Trạng thái </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="2" <?php echo ($status == 2 ? 'selected="selected"':'' )?>>- Tất cả -</option>
                            <option value="1" <?php echo ($status == 1 ? 'selected="selected"':'' )?>>- Đã gửi kết bạn -</option>
                            <option value="0" <?php echo ($status == 0 ? 'selected="selected"':'' )?>>- Chưa gửi kết bạn -</option>
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
                <a href="javascript:void(0)" id="add">
                    <input type="button" class="btn-bigblue" value=" Thêm bạn ">
                </a>
                <a href="javascript:void(0)" onclick="ajaxDeleteAll('<?php echo $id;?>')">
                    <input type="button" class="btn-bigblue" value=" Xóa hết ">
                </a>
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
                        <td><strong>Friend Id</strong></td>
                        <td><strong>Tên</strong></td>
                        <td><strong>Mời kết bạn</strong></td>
                        <td><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key?></td>
                            <td><a href="https://www.facebook.com/<?php echo $value["friend_id"]?>"><?php echo $value["friend_id"]?><a></td>
                            <td><?php echo $value["name"]?></td>
                            <td>
                                <?php 
                                    if($value['is_request'] == 0){
                                        echo "Chưa gửi kết bạn";
                                    }elseif($value['is_request'] == 1){
                                        echo "Đã gửi kết bạn";
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="requestFriend('<?php echo $value["friend_id"]?>','<?php echo $value["id"]?>')">  Thêm bạn  </a> -
                                <a href="javascript:void(0)" onclick="ajaxDeleteFriend('<?php echo $value["id"]?>')">  Xóa  </a> 
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>