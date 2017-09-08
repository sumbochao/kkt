<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);

    $forder_upload = "gamestore/facebook";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;

    $login = Yii::app()->facebook->getLoginUrl(
        array(
            'scope' => 'read_stream,public_profile,user_friends,email'
        )
    );
    
    $login_add = Yii::app()->facebook->getLoginUrl(
        array(
            'scope' => 'read_stream,public_profile,user_friends,email',
            'redirect_uri' => 'http://kenhkiemtien.com/kktpanel/fbaccount/indexadd'
        )
    );

    $user = Yii::app()->facebook->getUser();
    $user_email = "";
    $invite_friend = "";
    if($user > 0)
    {
        $result = Yii::app()->facebook->api('/me');
        if(!isset($result['email']))
        {
            $result['email'] = $email;
            if(!isset($result['email']))
            {
                $this->redirect($url->createUrl('login'));
            }
        }
        $user_name = $result['name'];
        $user_email = $result['email'];
        $user_data = FAccount::getDataByEmail($user_email);
        FInvittable::deleteFriend($user_data['id']);

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
            FInvittable::insertFriend($user_data['id'],$invite_friend[$i]['id'],$fid,addslashes($name),$url_image);
            }catch (Exception $e){
                echo "Message: ".$e->getMessage();
            }
        }
        
        FAccount::updateCountFriend($user_data['id'],count($invite_friend));
        
    }
?>

<link rel="stylesheet" href="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/css/swfupload.css" type="text/css" />

<style type="text/css">

    .progressbar{

        width:400px;
        height:16px;
        padding:0px;

        background:#cfcfcf;
        border-width:1px;
        border-style:solid;
        border-color: #aaa #bbb #fff #bbb;    
        box-shadow:inset 0px 2px 3px #bbb;    
    }

    .progressbar,
    .progressbar-inner{
        border-radius:4px;
        -moz-border-radius:4px;
        -webkit-border-radius:4px;
        -o-border-radius:4px;
    }

    .progressbar-inner{
        width:0%; /* Change to actual percentage */
        height:100%;
        background:#999;

        background-size:18px 18px;
        background-color: #ac0;   
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
        transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
        transparent 75%, transparent);
        background-image: -ms-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
        transparent 75%, transparent);
        background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
        transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, .2) 25%, transparent 25%,
        transparent 50%, rgba(255, 255, 255, .2) 50%, rgba(255, 255, 255, .2) 75%,
        transparent 75%, transparent);

        box-shadow:inset 0px 2px 8px rgba(255, 255, 255, .5), inset -1px -1px 0px rgba(0, 0, 0, .2);
    }

    .progressbar-blue .progressbar-inner{
        background-color:#7ce;
        width:90%;
    }

    .progressbar .progressbar-inner{
        -webkit-transition:width 0.5s ease-in;  
        -moz-transition:width 0.5s ease-in; 
        -o-transition:width 0.5s ease-in; 
        transition:width 0.5s ease-in; 
    }

</style>

<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/swfupload.queue.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/fileprogress.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/js/handlers.js"></script>
<script type="text/javascript">

    window.onload = function() {
        var configUploadDataOther = {
            flash_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/js/swfupload.swf",
            create_date:0,
            button_image_url:"<?php echo Yii::app()->params["urlImages"];?>lib_upload/images/buttonUpload.png",
            upload_url: "<?php echo $link_avatar;?>", 
            file_types: "*.xls;*.xlsx;*.txt", 
            file_upload_limit : 20, 
            file_queue_limit : 1, 
            debug : false
        }
        configUploadOther(configUploadDataOther);
    }

    function uploadResponseOther(serverData){  
        try {
            $("#txtFileName_other").val(""); 
            var response = $.parseJSON(serverData); // eval( "(" + serverData + ")" );      
            if(response.code==404){
                alert(response.message);return false;
            }  
            var filename = response.filename;    
            var path = response.path;
            var message = response.message;
            var code = response.code;
            var extension = response.extension;
            var filesize = response.filesize;
            $("#excel").val(filename);
            $("#show_excel").html('</br><p class="'+filesize+'" ><a target="_blank" href="<?php echo Yii::app()->params["urlImages"].$forder_upload.'/';?>'+path +'/'+ filename +'"alt="'+filename+'" >'+filename+'</a><input onclick="ajaxDeleteIpa();$(this).parent().remove();" type="button" value=" Xóa " class="btn-bigblue"></p>');
        } catch (e) {

        };
    }

    function ajaxDeleteAccount(id){
        var strUrl = "<?=$url->createUrl("fbaccount/ajaxDeleteAccount") ?>";
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

    function ajaxDeleteFriend(id)
    {
        var strUrl = "<?=$url->createUrl("fbaccount/ajaxDeleteFriend") ?>";
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

     function ajaxSaveFriend(friend,fid,name,image,email)
    {
        var strUrl = "<?=$url->createUrl("fbaccount/ajaxSaveFriend") ?>";
         
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                friend: friend,
                fid: fid,
                name: name,
                image: image,
                email: email
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    location.reload();
                }else{
                    alert(msg);
                }
            }   
        });
    }


    function ajaxExcelFriend(email,i,process){
        var strUrl = "<?=$url->createUrl('fbfriend/ajaxExcelFriend')?>";
        var excel = $('#excel').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data:{
                email: email,
                i: i,
                excel: excel
            },
            success: function(msg){
                $('.progressbar-inner').css("width",process);
                if(msg == 1){
                    alert('Thêm thành công');
                }else{
                    //alert(msg);
                    $("#show_error").html(msg);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('.progressbar-inner').css("width",process);
                if(thrownError == "CDbException")
                {
                    $("#show_error").html('Dữ liệu đã tồn tại');
                }
            }
        });
    }

    function runExcel(email){
        $("#button_save").attr("disabled","disabled");
        $('.progressbar-inner').css("width","0%")
        $('.progressbar').show();
        var i = 0;
        var tem_process = 0;
        var run = setInterval(
            function(){
                i += 1;
                tem_process += 0.5;
                var process = tem_process + "%";
                ajaxExcelFriend(email,i,process);
                //ajaxExcelFriend(id,i);
                if(i == 200){
                    clearInterval(run);
                    $("#button_save").removeAttr("disabled"); 
                    //alert('Thêm bạn xong');
                    //$('.progressbar').hide();
                    //window.location = '<?php //echo $url->createUrl("fbfriend/index",array('id'=>$id))?>';
                };
            }
            ,2000);
    }

</script>

<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form method="GET">
            <ul class="form4">
                <li>
                    <label><strong>Tài khoản </strong>:</label>
                    <div class="filltext">
                        <?php
                            
                            if(isset($user_name))
                            {
                            ?>
                            <a href="<?php echo $url->createUrl("fbaccount/friendList",array("id"=>$user_data["id"]))?>" target="_blank">
                            <?php
                                echo $user_name;
                            ?>
                            </a> 
                            <?php 
                            }else{
                                echo "Chưa đăng nhập";
                            }
                        ?>
                    </div>
                </li>
                <li>
                    <label><strong>Email </strong>:</label>
                    <div class="filltext">
                        <?php
                            if(isset($user_email))
                            {
                                echo $user_email;
                            }
                            else
                            {
                                echo "Chưa đăng nhập";
                            }
                        ?>
                    </div>
                </li>
                
                <?php
                    if($user > 0){
                    ?>
                    <li><label>&nbsp;</label>
                        <div class="filltext">
                            <a href="<?php echo $url->createUrl("fbfriend/index",array("id"=>$user_data["id"]))?>">
                                <input type="button" class="btn-bigblue" value=" DS Kết bạn ">
                            </a>
                            <a id="login" href="javascript:void(0)" onclick='$("#mydialog").dialog("open"); return false;'> 
                                <input type="button" class="btn-bigblue" value=" Lấy Friends ">
                             </a> 
                        </div>
                    </li>
                <?php }?>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <?php if($user == 0){?>
                            <a href="<?php echo $login;?>">
                                <input type="button" class="btn-bigblue" value=" Đăng nhập ">
                            </a>
                            <?php }else{?>
                            <a onclick="window.location = '<?php echo $url->createUrl("fbaccount/logout")?>';" href="javascript:void(0)">
                                <input type="button" class="btn-bigblue" value=" Thoát ">
                            </a>
                            <?php }?>
                    </div>
                </li>

                <?php
                    if($user > 0){
                    ?>
                    <li class="clearfix"><label><strong>Thêm Friend </strong>:</label>
                        <div class="filltext">
                            <p>
                                <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                                <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                                <span id="spanButtonPlaceHolder_other"></span>
                            </p>

                            <p><i>Định dạng file: *.xls; *.xlsx; *.txt(Dung lượng ko được quá 200 MB)</i></p>
                            <br/>
                            <div class="fieldset flash" id="fsUploadProgress_other">
                                <span class="legend">File upload</span>
                            </div>

                            <input type="hidden" id="excel" value=""/>
                            <p id="show_excel"></p>

                        </div>
                    </li>

                    <li>
                        <label><strong>&nbsp; </strong></label>
                        <div class="filltext">
                            <input id="button_save" onclick="runExcel('<?php echo $user_email;?>');" type="button" value=" Lấy Friend " class="btn-bigblue"> 
                        </div>
                    </li>

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
        </form>
    </div>
</div>
<br>
<div class="main clearfix">

    <div class="box clearfix bottom30">
        <form method="GET">
            <ul class="form4">
                <li class="clearfix">
                    <div class="filltext">
                    <table>
                    <tr>
                    <td>
                  <label>  <strong>Từ khóa </strong>:</label>
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                        <input type="hidden" value="<?php echo $email ?>" name="email">
                    </td><td>
                    <label>    <strong>Status </strong>:</label>   
                        <select name="status" id="status">
                                <option value="-1" <?php echo  $status==-1?"selected":"" ?>>--All--</option>
                                <option value="0" <?php echo  $status==0?"selected":"" ?>>Live</option>
                                <option value="1" <?php echo  $status==1?"selected":"" ?>>Xác nhận bạn bè cấp 1</option>
                                <option value="2" <?php echo  $status==2?"selected":"" ?>>Xác nhận bạn bè câp 2</option>
                                <option value="3" <?php echo  $status==3?"selected":"" ?>>Xác nhận CMT</option>
                                <option value="4" <?php echo  $status==4?"selected":"" ?>>Khóa hoàn toàn</option>
                            </select>
                    </div></td><td> <input type="submit" value=" Tìm kiếm" class="btn-bigblue"/> </td>
                    </tr></table>
                </li>

            </ul>
        </form>
    </div>

    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("fbaccount/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td><strong>Username</strong></td>
                        <td><strong>Password</strong></td>
                        <td><strong>Birthday <br> Mobile</strong></td>
                        <td><strong>Số Friend</strong></td>
                        <td><strong>Trạng Thái</strong></td>
                        <td><strong>Note</strong></td>
                        <td><strong>Hành động</strong></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;
                     $color="white";
                        
                        if($value["status"]==1||$value["status"]==2){
                            $color="yellow";
                        }
                        
                         if($value["status"]==3||$value["status"]==4){
                            $color="red";
                        }
                    ?>
                        <tr>
                            <td class="middle"><?php echo $key?></td>
                            <td style="background-color :<?php echo $color;?> ;">
                            <a  href="<?php echo empty($value["link"])?"javascript:void(1)":$value["link"]?>" target="_blank"><?php echo $value["username"]?></a></td>
                            <td><?php echo $value["password"]?></td>
                            <td><?php echo $value["password"]?><br/><?php echo $value["mobile"]?></td>
                            <td>
                            <a href="<?php echo $url->createUrl("fbaccount/friendList",array("id"=>$value["id"]))?>">
                                <?php 
                                    $count = FInvittable::countFriend($value["id"]);
                                    echo $count['count'];
                                ?>
                                </a>
                            </td>
                             <td><?php echo $value["status"]==0?"Live":"";
                                echo $value["status"]==1?"Xác nhận bạn C1":"";
                                echo $value["status"]==2?"Xác nhận bạn C2":"";
                                echo $value["status"]==3?"Xác nhận CMT":"";
                                echo $value["status"]==4?"Khóa":"";
                            ?></td>
                            <td><?php echo $value["note"];?></td>
                            <td>
                                <a href="<?php echo $url->createUrl("fbaccount/edit",array("id"=>$value["id"]))?>"> Sửa </a> -
                                <a href="javascript:void(0)" onclick="ajaxDeleteAccount('<?php echo $value["id"]?>')">  Xóa  </a>
                                <br>
                                <?php if($user_email == $value["username"]){?>
                                    <a href="<?php echo $url->createUrl("fbfriend/index",array("id"=>$value["id"]))?>"> DS Friends </a> -
                                    <a id="login" href="javascript:void(0)" onclick='$("#mydialog").dialog("open"); return false;'> Lấy Friend </a>
                                <?php }?>

                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php  if($user > 0){?>

    <?php
        /** Start Widget DIALOG **/
        $cjuidialog['heading']='CJuiDialog : Alert';
        $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'mydialog',
            'options'=>array(
                'title'=>'Danh sách friend',
                'autoOpen'=>false,
                'show' => 'blind',
                'modal' => 'true',
                'height' => 400,
                'width' => 800,
            ),
        ));
    ?>
    <div class="main clearfix">
        <div class="box clearfix bottom30">
            <ul class="form4">

                <li>
                    <div class="filltext">
                        <?php
                            $value_friend = json_encode($invite_friend);
                            //var_dump(1);die;
                        
                             $value_friend = "";$value_fid = "";
                            $value_img = "";$value_name = "";
                            
                            for($i=0;$i<count($invite_friend);$i++)
                            {
                                 $fids = explode("_", $invite_friend[$i]["picture"]["data"]["url"]);
                                $name = isset($invite_friend[$i]['name'])?$invite_friend[$i]['name']:"";
                                $url_image = isset($invite_friend[$i]["picture"]["data"]["url"])?$invite_friend[$i]["picture"]["data"]["url"]:"";
                                
                                if($i != count($invite_friend)-1)
                                {
                                    $value_friend .= $invite_friend[$i]['id'].",";
                                      $value_fid .= $fid.",";
                                    $value_img .= $url_image.",";
                                    $value_name .=str_replace("'","",$name).",";
                                }
                                if($i == count($invite_friend)-1)
                                {
                                    $value_friend .= $invite_friend[$i]['id'];
                                    
                                    $value_fid .= $fid;
                                    $value_img .= $url_image;
                                    $value_name .= str_replace("'","",$name);
                                }
                            }
                            //var_dump(1);die;

                        ?>
                        <a href="javascript:void(0)" onclick='ajaxSaveFriend("<?php echo $value_friend;?>","<?php echo $value_fid;?>","<?php echo $value_name;?>","<?php echo $value_img;?>","<?php echo $user_email;?>");'>
                            <input type="button" class="btn-bigblue" value=" Thêm Friend ">
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="box">
            <div class="fillter clearfix">
                <div class="fl">
                    Tìm thấy <strong class="clred"><?php echo count($invite_friend); //var_dump(1);die;?></strong> kết quả 
                </div>
            </div>

            <div class="table clearfix">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr class="bg-grey">
                            <td><strong>Tên</strong></td>
                            <td><strong>Code</strong></td>
                        </tr>
                        <?php foreach($invite_friend as $value){ ?>
                            <tr>
                                <td>
                                    <?php echo $value['name'];?>
                                </td>
                                <td>
                                    <?php echo $value['id'];?>
                                </td>
                            </tr>
                            <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        /** End Widget **/
    }
?>

