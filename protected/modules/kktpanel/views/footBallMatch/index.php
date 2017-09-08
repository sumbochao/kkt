<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("footBallMatch/ajaxDeleteNews") ?>";
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
        var strUrl = "<?=$url->createUrl("footBallMatch/ajaxQuickUpdate") ?>";
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
                                        'dateFormat' => 'yy-mm-dd',
                                        'altFormat' => 'yy-mm-dd',
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
                                        'dateFormat' => 'yy-mm-dd',
                                        'altFormat' => 'yy-mm-dd',
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

                    <li class="clearfix"><label><strong>Câu lạc bộ </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $name?>" name="name" id="name">
                            &nbsp;<b>Mã đội bóng</b> &nbsp; 
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $code?>" name="code" id="code">
                            &nbsp;<b>Cup ID</b> &nbsp; 
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $cup_id?>" name="cup_id" id="cup_id">
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                        <select name="status" id="status">
                                <option value="" <?php echo strcasecmp("",$status)==0?"selected":""?>></option>
                                <option value="HT" <?php echo strcasecmp("HT",$status)==0?"selected":""?>>HT</option>    
                                <option value="Live" <?php echo strcasecmp("Live",$status)==0?"selected":""?>>Live</option>    
                                <option value="FT" <?php echo strcasecmp("FT",$status)==0?"selected":""?>>FT</option>
                               
                            </select>
                        &nbsp;<b>Order By</b> &nbsp; 
                            <select name="order_by" id="order_by">
                                <option value="id" <?php echo strcasecmp("id",$order_by)==0?"selected":""?>>ID ASC</option>    
                                <option value="id DESC" <?php echo strcasecmp("id DESC",$order_by)==0?"selected":""?>>ID DESC</option>    
                                <option value="match_time" <?php echo strcasecmp("match_time",$order_by)==0?"selected":""?>>match_time ASC</option>
                                <option value="match_time DESC" <?php echo strcasecmp("match_time DESC",$order_by)==0?"selected":""?>>match_time DESC</option> 
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
                    <td width="5%"><strong>CUP</strong></td>
                    <td width="5%"><strong>Vòng</strong></td>
                    <td width="5%"><strong>Time</strong></td>     
                    <td width="10%"><strong>Club 1</strong></td>     
                    <td width="5%"><strong>Kết quả</strong></td> 
                    <td width="10%"><strong>Club 2</strong></td>
                    <td width="5%"><strong>Sân</strong></td>
                    <td width="5%"><strong>Trọng tài</strong></td>  
                    <td width="5%"><strong>Status</strong></td>
                    <td width="8%"><strong>Hành động</strong><br></td>
                </tr>

                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                         <td>
                            <b><?php echo $value["cup_name"]?></b> <br>(<?php echo $value["cup_id"]?>)    
                         </td>
                        <td>
                            <?php echo $value["round"]?>  <br/> <?php echo $value["season"]?>   
                        </td>
                        <td>
                            <?php echo $value["match_time"]?>
                        </td>
                         <td>
                            <?php echo $value["club_name_1"]?><br>(<?php echo $value["club_code_1"]?>:<?php echo $value["club_id_1"]?>)  
                        </td>
                         <td>
                            <?php echo $value["result"]?> <br>(<?php echo $value["result_1"]?>)   
                        </td>
                         <td>
                           <?php echo $value["club_name_2"]?><br>(<?php echo $value["club_code_2"]?>:<?php echo $value["club_id_2"]?>)  
                        </td>
                         <td>
                            <?php echo $value["stadium"]?>
                        </td>
                         <td>
                            <?php echo $value["referee"]?>
                        </td>
                         <td>
                            <?php echo $value["status"]?><br/>
                            <hr>
                            <?php echo $value["match_minute"]?>
                        </td>
                        <td>
                            <a href="<?php echo $url->createUrl("footBallMatch/edit",array("id"=>$value["id"],"page"=>$page))?>"> Sửa </a> |  <a href="<?php echo $url->createUrl("footBallVideo/create",array("match_id"=>$value["id"]))?>"> Add Video</a>
                            
                        </td>
                    </tr>
                <?php }?>

            </tbody>
        </table>
    </div>

</div>
     