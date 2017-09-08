<?php
    $url = new Url();

    $login = Yii::app()->facebook->getLoginUrl(
        array(
            'scope' => 'read_stream,public_profile,user_friends,email,user_birthday'
        )
    );

    //echo 1;
    $user = Yii::app()->facebook->getUser();
    $invite_friend = "";
    if($user>0)
    {
        $result = Yii::app()->facebook->api('/me');
        $user_name = $result['name'];
        
        if(isset($result['email'])){
            $user_email = $result['email'];
            $account = FAccount::getIdByEmail($user_email);
            if($account != false){
                //var_dump($account['id']);
                if(!empty($result['birthday']))
                FAccount::updateBirthday($account['id'],$result['birthday']);
                FInvittable::deleteFriend($account['id']);
                $invite_friend = Yii::app()->facebook->api('/me/invitable_friends?limit=5000');
                $invite_friend = $invite_friend['data'];
                //var_dump($invite_friend);die;
                
                for($i=0;$i<count($invite_friend);$i++)
                {
                try{
                    $fids = explode("_", $invite_friend[$i]["picture"]["data"]["url"]);
                    $name = isset($invite_friend[$i]['name'])?$invite_friend[$i]['name']:"";
                    $url_image = isset($invite_friend[$i]["picture"]["data"]["url"])?$invite_friend[$i]["picture"]["data"]["url"]:"";
                    $fid = isset($fids[1])?$fids[1]:"0";
                    
                    FInvittable::insertFriend($account['id'],$invite_friend[$i]['id'],$fid,addslashes($name),$url_image);
                    }catch (Exception $e){
                        echo 'Message: ' .$e->getMessage();
                    }
                }
            }
        }
    }
    
  
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://connect.facebook.net/en_US/sdk.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
        FB.init({
            appId      : '264501217006830',
            status     : true,
            xfbml      : true,
            version    : 'v2.2'
        });
        
        

        <?php if($facebook != ""){?>
            document.getElementById('add').onclick = function(){
                <?php                    
                    foreach($facebook as $value){
                    ?>
                    var link = $('#link').val();           
                    FB.ui({ 
                        method: 'send',
                        to: '<?php echo $value['id'];?>',
                        link: link,
                        },
                        function(response){
                            
                        }
                    );
                    <?php }?>
            }
        <?php }?>

    });

    function requestMessage(id){
        
        var link = $('#link').val();
        FB.ui({ 
            method: 'send',
            to: id,
            link: link,
            },
            function(response){
                
            }
        );

    }
</script>
<script type="text/javascript" id="js_friend"></script>

<div class="main clearfix">
    <div class="box clearfix bottom30">
        <ul class="form4">
            <li>
                <label><strong>Tài khoản </strong>:</label>
                <div class="filltext">
                    <?php
                        if(isset($user_name))
                        {
                            echo $user_name;
                        }else{
                            echo "Chưa đăng nhập";
                        }
                    ?>
                </div>
            </li>
            <li class="clearfix"><label>&nbsp;</label>
                <div class="filltext">
                    <?php if($user == 0){?>
                        <a href="<?php echo $login;?>">
                            <input type="button" class="btn-bigblue" value=" Đăng nhập ">
                        </a>
                    <?php }else{?>
                        <a onclick="window.location = '<?php echo $url->createUrl("fbmember/logout")?>';" href="javascript:void(0)">
                            <input type="button" class="btn-bigblue" value=" Thoát ">
                        </a>
                    <?php }?>
                </div>
            </li>
            <?php if($user>0){?>
                <form method="POST">
                
                    <li class="clearfix">
                        <label><strong>Mã Facebook </strong>:</label>
                        <div class="filltext">
                            <textarea cols="20" rows="30" name="friend" id="friend" style="height: 130px; width: 500px;"></textarea>
                            <p><i>Tối đa 50 id</i></p>
                        </div>
                    </li>

                    
                    <li>
                        <label><strong>&nbsp; </strong></label>
                        <div class="filltext">
                            <input id="button_save" type="submit" value=" Lấy Friend " class="btn-bigblue"> 
                        </div>
                    </li>
                </form>

                <li>
                    <label><strong>&nbsp; </strong></label>
                    <div class="filltext">
                        <div class="progressbar progressbar-blue" style="display: none;">
                            <div class="progressbar-inner" ></div>
                        </div>
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext" style="color: red;" id="show_error"></div>
                </li>
            <?php }?>
        </ul>
    </div>
</div>
<br>

<?php if($facebook != ""){?>
    <div class="main clearfix" id="div_friend">
        <div class="box">
            <div class="fillter clearfix">
                <div class="fl">
                    <a href="javascript:void(0)" id="add" onclick="requestFriend();">
                        <input type="button" class="btn-bigblue" value="Send All ">
                    </a>
                </div>
            </div>
              <li class="clearfix">
                        <label><strong>Link </strong>:</label>
                        <div class="filltext">
                            <input  type="text" id="link" name="link" size="50"  >
                            <p><i>Tối đa 50 id</i></p>
                        </div>
                   </li>
                    
            <div class="table clearfix">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody id="tb_friend">
                        <tr class="bg-grey">
                            <td><strong>Mã</strong></td>
                            <td><strong>Friend Id</strong></td>
                            <td><strong>Kết bạn</strong></td>
                        </tr>
                        <?php foreach ($facebook as $key=>$value){ $key+=1?>
                            <tr>
                                <td><?php echo $key?></td>
                                <td><?php echo $value['id']?></td>
                                <td>
                                    <a href="javascript:void(0);" onclick="requestMessage('<?php echo $value['id']?>')">Gui tin nhan</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php }?>