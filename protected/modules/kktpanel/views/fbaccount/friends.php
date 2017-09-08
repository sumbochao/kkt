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
    
    <form id="searchFriend" action="<?=$url->createUrl("fbaccount/friendList") ?>" method="get" >
        <input type="text" name="username" id="username" value="<?php echo $username?>"/>
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
        <input type="submit" value="Tim Kiem" />
    </form>
        
      


    </div>

    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
              
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
                        <td><strong>Mã</strong></td>
                        <td><strong>Friend Id</strong></td>
                        <td><strong>Tên</strong></td>
                        <td><strong>Image</strong></td>
                        <td><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key?></td>
                            <td><a href="https://www.facebook.com/<?php echo $value["fid"]?>" target="_blank"><?php echo $value["fid"]?><a></td>
                            <td><?php echo $value["name"]?></td>
                            <td>
                               <img src="<?=$value["url"]?>" />
                            </td>
                            <td>
                              
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>

</div>