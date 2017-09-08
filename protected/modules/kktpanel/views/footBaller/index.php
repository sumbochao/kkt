<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("footBaller/ajaxDeleteNews") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id: id,  
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

    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("footBaller/ajaxQuickUpdate") ?>";
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

                    <li class="clearfix"><label><strong>Tên cầu thủ </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $name?>" name="name" id="name">
                            &nbsp;<b>Quốc gia</b> &nbsp; 
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $country?>" name="country" id="country">
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
                <a href="<?php echo $url->createUrl("footBaller/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                    <td width="10%"><strong>Tên</strong></td>
                    <td width="10%"><strong>Avatar</strong></td>
                    <td width="5%"><strong>Quốc gia</strong></td>     
                    <td width="5%"><strong>Sinh nhât</strong></td> 
                    <td width="5%"><strong>Cao/Nặng</strong></td>
                    <td width="5%"><strong>Club</strong></td>   
                    <td width="5%"><strong>Số áo</strong></td>   
                    <td width="5%"><strong>Vị trí</strong></td> 
                    <td width="5%"><strong>Ngày join</strong></td>
                    <td width="5%"><strong>Phí CN</strong></td>  
                    <td width="8%"><strong>Hành động</strong><br></td>
                </tr>

                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                         <td>
                            <b><?php echo $value["name"]?></b>
                         </td>
                        <td>
                        <?php 
                            if($value['avatar']!=""){
                        ?>
                                  <img style="width: 50%;" src="<?php echo Yii::app()->params['urlImages']?>bongda/footballer/<?php echo  date('Y/md', strtotime($value['create_date']))?>/<?php echo $value['avatar']?>" />     
                        <?php
                            }
                        ?>
                        </td>
                        <td>
                            <?php echo $value["country"]?>
                            
                        </td>
                         <td>
                            <?php echo $value["birthday"]?>
                            
                        </td>
                         <td>
                            <?php echo $value["height"]?> / <?php echo $value["weight"]?>
                            
                        </td>
                        <td>    
                            <?php echo $value["club_name"]?>
                            
                        </td>
                        <td>
                            <?php echo $value["clubshirtno"]?>
                            
                        </td>
                         <td>
                            <?php echo $value["position"]?>
                            
                        </td>
                         <td>
                            <?php echo $value["join_date"]?>
                            
                        </td>
                         <td>
                            <?php echo $value["transfer_free"]?>
                            
                        </td>
                        <td>
                            <a href="<?php echo $url->createUrl("footBaller/edit",array("id"=>$value["id"],"page"=>$page))?>"> Sửa </a> | 
                            
                        </td>
                    </tr>
                <?php }?>

            </tbody>
        </table>
    </div>

</div>
     