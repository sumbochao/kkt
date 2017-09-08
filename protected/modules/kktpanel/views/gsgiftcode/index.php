<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxDelete')?>";
        if(confirm('Bạn có chắc chắn muốn xóa không?')){
            $.ajax({
                type: "POST",
                url: strUrl,
                data:{
                    id: id,
                },
                success:function(msg){
                    if(msg == 1){
                        alert('Xóa thành công');
                        location.reload();
                    }else{
                        alert('Có lỗi');
                    }
                }
            });
        }
    }
    
    function ajaxQuickUpdate(id){
        var strUrl = "<?=$url->createUrl("gsgiftcode/ajaxQuickUpdate") ?>";
        var status = 0;var is_hot = 0;var is_market = 0;
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
                    alert(msg);
                }
            }          
        });
    }

</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">

        <form method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Tiêu đề </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $keyword?>" name="keyword">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Game Id </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:195px;margin-right:15px" value="<?php echo $game?>" name="game">
                    </div>
                </li>

                <li class="clearfix"><label><strong>Danh Mục </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="category">
                            <option value="0">--Tất cả--</option>
                            <?php for($i=0;$i<count($category);$i++){?>
                                <option value="<?php echo $category[$i]['id'];?>" <?php echo ($category_id == $category[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $category[$i]['name'];?></option>
                                <?php }?>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Nhà phát hành </strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="category">
                            <option value="0">--Tất cả--</option>
                            <?php for($i=0;$i<count($publisher);$i++){?>
                                <option value="<?php echo $publisher[$i]['id'];?>" <?php echo ($publisher_id == $publisher[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $publisher[$i]['name'];?></option>
                                <?php }?>
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

        <div class="box">
            <div class="fillter clearfix">
                <div class="fl">
                    Tìm thấy <strong class="clred"><?php echo $count; ?></strong> kết quả - 
                    <a href="<?php echo $url->createUrl("gsgiftcode/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
                </div>
                <div class="fr">
                    <ul class="paging">
                        <?php
                            //var_dump($page);
                            //var_dump($max_page);
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
                        <td><strong>STT</strong></td>
                        <td><strong>Tiêu Đề</strong></td>
                        <td><strong>Game</strong></td>
                        <td><strong>Mô tả</strong></td>
                        <td><strong>Tổng số</strong></td>
                        <td><strong>Còn lại</strong></td>
                        <td width="5%"><strong>Trạng thái</strong></td>
                        <td width="15%"><strong>Hành động</strong></td>
                    </tr>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td><?php echo $key;?></td>
                            <td><?php echo $value['title'];?></td>
                            <td>
                                <b><?php $game = GGame::getDataById($value['game_id']); echo $game['name'];?></b>
                                <br>
                                <?php $category = GCategory::getCateById($value['category_id']); echo $category['name']?> -
                                <?php $publisher = GPublisher::getPublisherById($value['publisher_id']); echo $publisher['name']?>
                            </td>
                            <td><?php echo $value['description'];?></td>
                            <td><?php echo $value['total_giftcode'];?></td>
                            <td><?php echo $value['available_giftcode'];?></td>
                              <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                            <td>
                             <a class="s14" href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value["id"]?>')"> Lưu </a> -
                                <a href="<?php echo $url->createUrl("gsgiftcode/edit",array("id"=>$value["id"]))?>"> Sửa </a> - 
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a><br>
                                <a href="<?php echo $url->createUrl("gsgiftcode/code",array("id"=>$value["id"]))?>"> Danh Sách Gift Code </a> 
                                <br>
                                
                                <a href="javascript:void(0);" id="notify" onclick="notifyDs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">DS Notify</a> -
                                <a href="javascript:void(0);" id="notify" onclick="notifyJs('<?php echo $value['id'];?>','<?php echo $value['title']?>')">Add Notify</a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
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
                    
                    <li class="clearfix"><label><strong>Type </strong>:</label>
                        <div class="filltext">
                            Gift Code
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
		var strUrl = "<?=$url->createUrl("gsgiftcode/ajaxGetNotify") ?>";
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
		var strUrl = "<?=$url->createUrl("gsgame/ajaxDeleteNotify") ?>";
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
		var strUrl = "<?=$url->createUrl("gsgiftcode/ajaxSaveNotify") ?>";
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

