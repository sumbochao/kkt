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
        var status = 0;var isHot = 0;var isHome = 0;var isHotApp = 0;
        if($("#status_"+id).is(":checked")){ status = 1; }

        var strUrl = "<?=$url->createUrl("audio/ajaxQuickUpdate") ?>";
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
                    alert(msg);
                }
            }          
        });
    }
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("audio/ajaxDelete") ?>";
        if(confirm('Xóa game này thì tất cả các dữ liệu liên quan sẽ mất hết! Bạn có muốn tiếp tục không ?')){
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
        <form method="GET">
            <ul class="form4">
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
                <li class="clearfix"><label><strong>Từ khóa </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                        <b>Theo</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select style="width:203px;" name="type">
                            <option value="1" <?php echo ($type == 1 ? 'selected="selected"':'' )?>>ID</option>
                            <option value="2" <?php echo ($type == 2 ? 'selected="selected"':'' )?>>Tên</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Category </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="categoryId">
                            <option value="0">--Tất cả--</option>
                            <?php foreach($data_cat as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($categoryId == $key ? 'selected="selected"':'' )?>><?php echo $value;?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Trạng thái</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="status">
                            <option value="2" >- Tất cả -</option> 
                            <?php foreach($arr_status as $key=>$value){?>
                                <option value="<?php echo $key;?>" <?php echo ($status == $key ? 'selected="selected"':'' )?>><?php echo $value?></option>
                                <?php }?>
                        </select>

                    </div>
                </li>
                 <li class="clearfix"><label><strong>Tìm kiếm theo</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="orderBy">
                            <option value="0" <?php echo ($orderBy == 0 ? 'selected="selected"':'' )?>>Thời gian</option>
                            <option value="1" <?php echo ($orderBy == 1 ? 'selected="selected"':'' )?>>Số lượt view</option>
                        </select>
                       &nbsp; Sắp xếp &nbsp;&nbsp;&nbsp;
                        <select style="width:203px;" name="compare">
                            
                            <option value="1" <?php echo ($compare == 1 ? 'selected="selected"':'' )?>>Giảm dần</option>
                            <option value="0" <?php echo ($compare == 0 ? 'selected="selected"':'' )?>>Tăng dần</option>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Lọc theo số view </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:196px;" value="<?php if($view!=0){echo $view ;} ?>" name="view"> 
                        &nbsp; Điều kiện &nbsp;
                        <select style="width:203px;" name="condition">
                            <option value="2">-Tất cả-</option>
                            <option value="1" <?php echo ($condition == 1 ? 'selected="selected"':'' )?>>Lớn hơn hoặc bằng</option>
                            <option value="0" <?php echo ($condition == 0 ? 'selected="selected"':'' )?>>Nhỏ hơn hoặc bằng</option>
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
                <a href="<?php echo $url->createUrl("audio/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                        <td width="5%"><strong>Mã</strong></td>
                        <td width="14%"><strong>Ảnh hiển thị</strong></td>
                        <td width="10%"><strong>Danh mục</strong></td>
                        <td width="11%"><strong>Tiêu đề</strong></td>
                        <td width="5%"><strong>Số chương</strong></td>
                        <td width="5%"><strong>Lượt nghe</strong></td>
                        <td width="5%"><strong>Download</strong></td>
                        <td width="8%"><strong>Trạng thái</strong></td>

                        <td width="8%"><strong>Người tạo</strong></td>
                        <td width="8%"><strong>Ngày tạo</strong></td>                        
                        <td width="11%"><strong>Hành động</strong><br></td>
                    </tr>
                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                            <td><img style="width: 75px; height: 100px;" src="<?php echo Common::getImage($value["image"],"audio",$value["create_date"])?>" /></td>
                            <td>
                                <?php 
                                    $x="";
                                    foreach(AAudio::getCheckCategory($value['id']) as $key1 =>$result){
                                         $x= $x.",".$data_cat[$result];
                                    }
                                    echo ltrim($x, ",");
                                    
                                ?>
                            </td>
                            <td><?php echo $value["title"]?></td>
                            <td><?php echo $value["c_chapter"]?></td>
                            <td><?php echo $value["c_listen"]?></td> 
                            <td><?php echo $value["c_download"]?></td> 
                            <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td><?php echo $value["create_user"]?></td>
                            <td><?php echo date('d-m-Y H:i:s',$value["create_date"])?></td>
                            <td>
                                <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> | 
                                <a href="<?php echo $url->createUrl("audio/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> |
                               
                                <a href="javascript:void(0);" id="notify" onclick="notifyDs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">DS Notify</a> -
                                <a href="javascript:void(0);" id="notify" onclick="notifyJs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">Add Notify</a>
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


<?php 
    //Dialog Relate
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'ds_notify',
            'options'=>array(
                'title'=>'Ds Notify',
                'autoOpen'=>false,
                'show' => 'blind',
                'modal' => 'true',
                'height' => 400,
                'width' => 800,
            ),
        ));
?>

    <div class="main clearfix">
        
        <div class="box">
            <div class="table clearfix">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <thead>
                         <tr class="bg-grey">
                             <td><strong>Stt</strong></td>
                             <td><strong>Content</strong></td>
                             <td><strong>Trạng thái</strong></td>
                             <td><strong>Time Send</strong></td>
                             <td><strong>Time Create</strong></td>
                             <td><strong>Hành Động</strong></td>
                         </tr>
                    </thead>
                    <tbody id="list_notify">
                         
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<?php 
    //Dialog Notify
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
            'id'=>'notify_dialog',
            'options'=>array(
                'title'=>'Notification',
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
            <div class = "box">
                <ul class="form">
                    <li class="clearfix">
                        <strong>Thêm Notify</strong>
                        <hr>
                    </li>
                    
                    <li class="clearfix"><label><strong>Object Id </strong>:</label>
                        <div class="filltext">
                            <input type="text" onkeyup="" style="width:360px" value="" id="name_notify"> 
                            <input type="hidden" value="" id="object_id">
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Nội Dung </strong>:</label>
                        <div class="filltext">
                            <textarea rows="200" cols="300" id="content" onkeyup="countLength('content','counter_content',125)" style="width: 360px;height: 40px;" maxlength="125"></textarea>
                            <p >Max length: <span id="counter_content">125</span> </p>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Time Send </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:360px" value="<?php echo date('Y-m-d H:i:s')?>" id="time"> 
                        </div>
                    </li>
                    
                  
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input id="button_notify" onclick="ajaxSaveNotify();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext" style="color: red;" id="error_notify"></div>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?> 

<script type="text/javascript">

    function notifyDs(id,name)
    {
        $('#list_notify').html('');
        ajaxGetNotify(id);
        $('#ds_notify').dialog('open');
    }

    function notifyJs(id,name)
    {
        $('#error_notify').html('');
        $('#name_notify').val("["+id+"] "+name);
        $('#object_id').val(id);
        $('#notify_dialog').dialog('open');
    }

    function ajaxGetNotify(id)
    {
        var strUrl = "<?=$url->createUrl("audio/ajaxGetNotify") ?>";
        $.ajax({
            type: 'POST',
            url: strUrl,
            data:{
                object_id: id,
            },
            success: function(msg){
                //console.log(msg);
                $('#list_notify').append(msg);
            },
            beforeSend:function(){
                $("#button_notify").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_notify").removeAttr("disabled"); 
            }
        });
    }

    function ajaxDeleteNotify(id,div)
    {
        var strUrl = "<?=$url->createUrl("audio/ajaxDeleteNotify") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
            $.ajax({
                type: 'POST',
                url: strUrl,
                data:{
                    id: id,
                },
                success: function(msg){
                    //console.log(msg);
                    alert('Xóa thành công');
                    $('#'+div).fadeOut();
                },
                beforeSend:function(){
                    $("#button_notify").attr("disabled","disabled");
                },
                complete:function(){
                    $("#button_notify").removeAttr("disabled"); 
                }
            });
        }
    }

    function ajaxSaveNotify()
    {
        var strUrl = "<?=$url->createUrl("audio/ajaxSaveNotify") ?>";
        var object_id = $('#object_id').val();
        var content = $('#content').val();
        var time = $('#time').val();
        $.ajax({
            type: 'POST',
            url: strUrl,
            data:{
                object_id: object_id,
                content: content,
                time: time,
            },
            success: function(msg){
                //console.log(msg);
                if(msg == 1){
                    alert('Thêm thành công');
                    $('#notify_dialog').dialog('close');
                    $('#content').val('');
                    $('#error_notify').html('');
                }else{
                    $("#error_notify").html(msg);
                }
            },
            beforeSend:function(){
                $("#button_notify").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_notify").removeAttr("disabled"); 
            }
        });
    }

    function countLength(txt,obj,limit){
        var len = $("#"+txt).val().length; 
        if(len > limit){
            $("#"+txt).val($("#"+txt).val().substr(0,limit));
            $("#"+obj).html(limit-len+1);
        } 
        else { 
            $("#"+obj).html(limit-len);
        }
    }

</script>
