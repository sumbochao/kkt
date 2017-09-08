<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
        
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("footBallUser/ajaxQuickUpdate") ?>";
        var status = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                status:status,
                id:id
            },
            success: function(msg){
                if(msg == 1){
                    alert('Sửa thành công');
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
        <div class="box clearfix bottom30">
            <form method="GET">
                <ul class="form4">

                    <li class="clearfix">
                        <label><strong>Từ ngày </strong>:</label>
                        <div class="filltext">
                            <?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name' => 'from_date',
                                    'id' => 'from_date',
                                    'value' => $from_date,
                                    // additional javascript options for the date picker plugin
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        'dateFormat' => 'dd-mm-yy',
                                        'changeYear' => 'true',
                                        'changeMonth' => 'true',
                                        'showOn' => 'both',
                                        'buttonText' => '...'
                                    ),
                                    'htmlOptions' => array(
                                        'style' => 'width:170px',
                                        'class' => 'form',
                                    ),
                                ));
                            ?> 
                            &nbsp;<b>Đến ngày</b> &nbsp; 
                            <?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name' => 'to_date',
                                    'id' => 'to_date',
                                    'value' => $to_date,
                                    // additional javascript options for the date picker plugin
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        'dateFormat' => 'dd-mm-yy',
                                        'changeYear' => 'true',
                                        'changeMonth' => 'true',
                                        'showOn' => 'both',
                                        'buttonText' => '...'
                                    ),
                                    'htmlOptions' => array(
                                        'style' => 'width:170px',
                                        'class' => 'form',
                                    ),
                                ));
                            ?> 
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Tên User </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $name?>" name="name" id="name">
                            &nbsp;<b>Email</b> &nbsp; 
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $email?>" name="email" id="email">
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
                Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                    
            </div>
            <div class="fr">
                <ul class="paging">
                    <?php
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
                    <td width="3%"><strong>Mã</strong></td>
                    <td width="5%"><strong>App Client ID</strong></td>
                    <td width="5%"><strong>SSO ID</strong></td>
                    <td width="10%"><strong>FullName</strong></td>
                    <td width="20%"><strong>Avatar</strong></td> 
                    <td width="10%"><strong>Mobi</strong></td>   
                    <td width="10%"><strong>Sinh Nhật</strong></td>  
                    <td width="5%"><strong>Sex</strong></td>    
                    <td width="20%"><strong>Địa chỉ</strong></td>     
                    <td width="5%"><strong>Hành động</strong><br></td>
                </tr>

                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                        <td>
                            <?php echo $value["app_client_id"]?>
                        </td>
                        <td>
                            <?php echo $value["sso_id"]?>
                        </td>
                         <td>
                            <?php echo $value["fullname"]?>  <br> <?php echo $value["email"]?>  
                        </td>
                         <td>
                         <?php 
                            if($value['avatar_url']!=""){
                                ?>
                                  <img style="width: 50%;" src="<?php echo $value['avatar_url']?>" />
                                <?php
                            }
                        ?>
                          
                        </td>
                         <td>
                            <?php echo $value["mobile"]?>
                        </td>
                         <td>
                            <?php echo $value["birthday"]?>
                        </td>
                          <td>
                            <?php echo $value["sex"]==0?"Nữ":"Nam"?>
                        </td>
                        
                        <td>
                            <?php echo $value["address"]?></br>
                        </td>
                        <td>
                           
                           
                        </td>
                    </tr>
                <?php }?>

            </tbody>
        </table>
    </div>

</div>
