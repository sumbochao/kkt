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
            version    : 'v2.0'
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
                                    id: "<?php echo $value['id'];?>"
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
    <!--<div class="box clearfix bottom30">

    <form method="POST">
    <ul class="form4">
    <li class="clearfix"><label><strong>Nhập mã số bạn </strong>:</label>
    <div class="filltext">
    <textarea cols="5" rows="5" style="width:420px; height:120px" name="friend"></textarea>
    </div>
    </li>

    <li class="clearfix"><label>&nbsp;</label>
    <div class="filltext">
    <input type="submit" value=" Lấy Danh Sách " class="btn-bigblue"> 
    </div>
    </li>

    <li class="clearfix"><label>&nbsp;</label>
    <div class="filltext">
    <a href="javascript:void(0)" id="add">
    <input type="button" value="Thêm bạn" class="btn-bigblue"> 
    </a>
    </div>
    </li>

    </ul>
    </form>
    </div>-->

    <div class="box clearfix bottom30">
        <form method="GET">
            <ul class="form4">

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <a href="javascript:void(0)" id="add">
                            <input type="button" class="btn-bigblue" value=" Thêm bạn ">
                        </a>
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
                        <td><strong>Friend Id</strong></td>
                        <td><strong>Tên</strong></td>
                        <td><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key?></td>
                            <td><?php echo $value["friend_id"]?></td>
                            <td><?php echo $value["name"]?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="requestFriend('<?php echo $value["friend_id"]?>','<?php echo $value["id"]?>')">  Thêm bạn  </a> -
                                <a href="javascript:void(0)" onclick="ajaxDeleteFriend('<?php echo $value["id"]?>')">  Xóa  </a> <br>
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>

    </div>

</div>