<script src="<?php  echo Yii::app()->params['static_url_cp']; ?>/js/export.js" type="text/javascript"></script> 
<?php
    $url = new Url();
    $type_cats = LoadConfig::$type_cat; 
    $arr_status = LoadConfig::$status;
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxQuickUpdate(id){
        var active = 0;var isBan = 0;
        if($("#active_"+id).is(":checked")){ active = 1; }
        if($("#isBan_"+id).is(":checked")){isBan = 1;}
        var strUrl = "<?=$url->createUrl("member/ajaxQuickUpdate") ?>";
        $.ajax({
            type: "POST",
            url: strUrl,
            data: {
                active:active,
                isBan:isBan,
                id:id
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
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("member/ajaxDelete") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa thông tin về thành viên này không ?')){
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
</script>
<div class="main clearfix">
   
    <div class="box clearfix bottom30">
        
        <div class="col-600">
            <form method="GET">
                <ul class="form">
                    <li class="clearfix"><label><strong>Từ ngày </strong>:</label>
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
                            &nbsp;đến ngày &nbsp; 
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
                    <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:196px;margin-right:28px" value="<?php echo $keyword?>" name="keyword"> &nbsp; Trong
                            <select style="width:203px;" name="type">
                                <option value="1" <?php echo ($type == 1 ? 'selected="selected"':'' )?>>ID</option>
                                <option value="2" <?php echo ($type == 2 ? 'selected="selected"':'' )?>>Tên</option>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="active">
                                <option value="2" >- Tất cả -</option> 
                                <?php foreach($arr_status as $key=>$value){?>
                                    <option value="<?php echo $key;?>" <?php echo ($active == $key ? 'selected="selected"':'' )?>><?php echo $value?></option>
                                    <?php }?>
                            </select>
                            Bị khóa &nbsp;
                            <select style="width:203px;" name="isBan">
                                <option value="2">- Tất cả -</option> 
                                <option value="1" <?php echo ($isBan == 1 ? 'selected="selected"':'' )?>>Có</option>
                                <option value="0" <?php echo ($isBan == 0 ? 'selected="selected"':'' )?>>Không</option>
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
        <div class="col-450">
            <ul class="form1">
                <li class="clearfix"><label><strong>Tên thành viên export </strong>:</label>
                    <div class="filltext">
                        <input type="text" name="username" id="username" style="width:196px" value="<?php if(isset($search["username"])) echo $search["username"];?>"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Ngày</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="day" id="day">
                            <option value="">-- Tất cả --</option>
                            <?php for($i=1; $i<=31; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["day"]==$i) echo "selected";?> ><?php echo "Ngày " . $i;?></option>
                            <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tháng</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="month" id="month">
                            <?php for($i=1; $i<=12; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["month"]==$i) echo "selected";?> ><?php echo "Tháng " . $i;?></option>
                            <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Năm</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="year" id="year">
                            <?php for($i=2012; $i<=2022; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["year"]==$i) echo "selected";?> ><?php echo "Năm " . $i;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sắp xếp theo</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="order" id="order">
                            <option value="" >Mặc định</option>                            
                            <option value="1" <?php if($search["order"]==1) echo "selected";?> >Doanh thu Từ Thấp đến Cao</option>                            
                            <option value="2" <?php if($search["order"]==2) echo "selected";?> >Doanh thu Từ Cao đến Thấp</option>                            
                            <option value="3" <?php if($search["order"]==3) echo "selected";?> >Sản lượng Từ Thấp đến Cao</option>                            
                            <option value="4" <?php if($search["order"]==4) echo "selected";?> >Sản lượng Từ Cao đến Thấp</option>                            
                        </select>
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Export từ </strong>:</label>
                    <div class="filltext clearfix">
                        <input type="text" name="start" id="start" value="<?php if($search["start"]!="") echo $search["start"];?>" style="width:100px"> 
                        <span><strong>Đến </strong>:</span>
                        <input type="text" name="end" id="end" value="<?php if($search["end"]!="") echo $search["end"];?>" style="width:100px"> 
                        (Bắt đầu từ 0)                        
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Hoặc export trang </strong>:</label>
                    <div class="filltext clearfix">                        
                        <input type="text" id="page" value="" style="width:100px">
                    </div>
                </li>
                
                <input type="hidden" id="telco" value="">
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">                        
                        <input type="button" onclick="Export();" value=" Export Excel " class="btn-bigblue"> 
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="box">
        <div class="fillter clearfix">
            <div class="fl">Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả </div>
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
                        <td width="5%"><strong>Mã</strong></td>
                        <td width="14%"><strong>Username</strong></td>
                        <td width="17%"><strong>Fullname</strong></td>
                        <td width="20%"><strong>Địa chỉ</strong></td>
                        <td width="8%"><strong>Mobile</strong></td>
                        <td width="10%"><strong>Email</strong></td>
                        <td width="8%"><strong>Trạng thái</strong></td>
                        <td width="8%"><strong>Khóa tài khoản</strong></td>
                        <td width="11%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php    
                        foreach($data as $key=>$value){
                        ?>
                        <tr>
                            <td class="middle"><?php echo $value["id"]?></td>
                            <td><a target="_blank" href="http://<?php echo $value["username"]?>.wapthugian.com"><strong><?php echo $value["username"]?></strong></a></td>
                            <td><?php echo $value["full_name"] ?></td>
                            <td><?php echo $value["address"]?></td>
                            <td><?php echo $value["mobile"]?></td> 
                            <td><?php echo $value["email"]?></td>         
                            <td><input type="checkbox" value="1" id="active_<?php echo $value["id"]?>" <?php echo $value["active"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td><input type="checkbox" value="1" id="isBan_<?php echo $value["id"]?>" <?php echo $value["isBan"]==1 ? 'checked="checked"':'';?>> Có</td>
                            <td>
                                <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <!--<a class="s14" href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')"> Xóa </a> |--> 
                            </td>
                        </tr>
                        <?php }?>
                </tbody>
            </table>
        </div>
        <div class="fillter clearfix">
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($max_page,$page,$path_paging);
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>