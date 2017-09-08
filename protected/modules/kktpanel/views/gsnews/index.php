
<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id){
        var strUrl = "<?=$url->createUrl("gsnews/ajaxDeleteNews") ?>";
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
        var strUrl = "<?=$url->createUrl("gsnews/ajaxQuickUpdate") ?>";
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

    $(function() {
        var availableTags = [
            <?php
                for($i=0;$i<count($game);$i++)
                {
                    echo '"'.$game[$i]['name'].'",';
                }
            ?>
        ];
        $( ".game" ).autocomplete({
            source: availableTags
        });
    });
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
                            <select style="width:203px;" name="publisher">
                                <option value="0">--Tất cả--</option>
                                <?php for($i=0;$i<count($publisher);$i++){?>
                                    <?php
                                        //var_dump($publisher);die;
                                    ?>
                                    <option value="<?php echo $publisher[$i]['id'];?>" <?php echo ($publisher_id == $publisher[$i]['id'] ? 'selected="selected"':'' )?>><?php echo $publisher[$i]['name'];?></option>
                                    <?php }?>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Tìm kiếm theo</strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="orderBy">
                                <option value="3" <?php echo ($orderBy == 3 ? 'selected="selected"':'' )?>>- Tất cả -</option>
                                <option value="1" <?php echo ($orderBy == 1 ? 'selected="selected"':'' )?>>Lượt Like</option>
                                <option value="2" <?php echo ($orderBy == 2 ? 'selected="selected"':'' )?>>Lượt View</option>
                                <option value="0" <?php echo ($orderBy == 0 ? 'selected="selected"':'' )?>>Lượt Comment</option>
                            </select>
                            &nbsp; Sắp xếp &nbsp;&nbsp;&nbsp;
                            <select style="width:203px;" name="compare">
                                <option value="1" <?php echo ($compare == 1 ? 'selected="selected"':'' )?>>Giảm dần</option>
                                <option value="0" <?php echo ($compare == 0 ? 'selected="selected"':'' )?>>Tăng dần</option>
                            </select>
                        </div>
                    </li>

                    <li class="clearfix"><label><strong>Game </strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:195px;margin-right:15px" value="<?php echo $game_id;?>" name="game" class="game">
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
                <a href="<?php echo $url->createUrl("gsnews/create")?>"><input type="button" class="btn-bigblue" value=" Thêm mới "></a>
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
                    <td width="3%"><strong>Mã</strong></td>
                    <td width="40%"><strong>Tin Tức</strong></td>
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
                            <?php $game = GGame::getDataById($value['game_id']); echo $game['name'];?> - 
                            <?php $publisher = GPublisher::getPublisherById($value['publisher_id']); echo $publisher['name']?><br>
                            
                            <img style="width: 50%;" src="<?php echo Yii::app()->params['urlImages']?>gamestore/news/<?php echo date('Y/md',strtotime($value['create_date']))?>/<?php echo $value['image']?>" />
                        </td>
                        <td>
                            Lượt view: <?php echo $value["count_view"]?><br>
                            Lượt like: <?php echo $value["count_like"]?><br>
                            Lượt comment: <?php echo $value["count_comment"]?>
                        </td>
                        <td>
                            <?php echo $value["create_user"]?></br>
                            <?php echo $value["create_date"]?>
                        </td>
                        <td><input type="checkbox" value="1" id="status_<?php echo $value["id"]?>" <?php echo $value["status"]==1 ? 'checked="checked"':'';?>> Hiển thị</td>
                        <td>
                            <a href="javascript:void(0)" onclick="ajaxQuickUpdate('<?php echo $value['id']?>')"> Lưu </a> |
                            <a href="<?php echo $url->createUrl("gsnews/edit",array("id"=>$value["id"]))?>"> Sửa </a> | 
                            <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a> <br>
                            <a href="<?php echo $url->createUrl("gsnews/comment",array("id"=>$value["id"]))?>"> Discussion <br>
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
		var strUrl = "<?=$url->createUrl("gsnews/ajaxGetNotify") ?>";
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
		var strUrl = "<?=$url->createUrl("gsnews/ajaxSaveNotify") ?>";
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