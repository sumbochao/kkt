<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("footBallVideo/ajaxDeleteVideo") ?>";
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
        var strUrl = "<?=$url->createUrl("footBallVideo/ajaxQuickUpdate") ?>";
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

                    <li class="clearfix"><label><strong>Giải Đấu </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $cup_id_name?>" name="cup_id" id="cup_id">
                            &nbsp;<b>Câu Lạc bộ</b> &nbsp; 
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $club_id_name?>" name="club_id">
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
                <a href="<?php echo $url->createUrl("footBallVideo/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                    <td width="40%"><strong>Tiêu đề</strong></td>
                    <td width="8%"><strong>Thông số</strong></td>
                    <td width="5%"><strong>Ngày tạo</strong></td>     
                    <td width="5%"><strong>Hiển thị</strong></td>                    
                    <td width="8%"><strong>Hành động</strong><br></td>
                </tr>

                <?php foreach($data as $key=>$value){$key+=1;?>
                    <tr>
                        <td class="middle"><?php echo $key."</br>_</br>".$value["id"]?></td>
                        <td>
                            <b><?php echo $value["title"]?></b>
                            <br>
                            <img style="width: 50%;" src="<?php echo Yii::app()->params['urlImages']?>bongda/video/<?php echo  date('Y/md', strtotime($value['create_date']))?>/<?php echo $value['image']?>" />
                           
                        </td>
                        <td>
                        </td>
                        <td>
                            <?php echo $value["create_user"]?></br>
                            <?php echo $value["create_date"]?>
                        </td>
                        <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                        <td>
                            <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value['id']?>')"> Lưu </a> |
                            <a href="<?php echo $url->createUrl("footBallVideo/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                            <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> <br>
                            <a href="javascript:void(0);" id="notify" onclick="notifyDs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">DS Notify</a> -
                            <a href="javascript:void(0);" id="notify" onclick="notifyJs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">Add Notify</a>
                        </td>
                    </tr>
                <?php }?>

            </tbody>
        </table>
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
                    
                    <li class="clearfix"><label><strong>Type </strong>:</label>
                        <div class="filltext">
                            Tin Tức
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
		var strUrl = "<?=$url->createUrl("footBallVideo/ajaxGetNotify") ?>";
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
		var strUrl = "<?=$url->createUrl("footBallVideo/ajaxDeleteNotify") ?>";
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
		var strUrl = "<?=$url->createUrl("footBallVideo/ajaxSaveNotify") ?>";
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