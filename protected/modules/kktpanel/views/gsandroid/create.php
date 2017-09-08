<?php
    $url = new Url(); 
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['urlImages']; ?>lib_upload/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    function ajaxSave(){
        //alert('test');
        var strUrl = "<?=$url->createUrl('gsandroid/ajaxSave')?>";
        var title = $('#title').val();
        var status = $('#status').val();
        var type = $('#type').val();
        var url = $('#url').val();
        var time_sent = $('#time_sent').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data:{
                title: title,
                status: status,
                type: type,
                url: url,
                time_sent: time_sent,
                description: CKEDITOR.instances.description.getData(),
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsandroid/index")?>';
                }else{
                    $("#show_error").html(msg);
                }
            },
            beforeSend:function(){
                $("#button_save").attr("disabled","disabled");
            },
            complete:function(){
                $("#button_save").removeAttr("disabled"); 
            } 
        });
    }
</script>
<div class="main clearfix">
    <div class="box clearfix bottom30">  

        <div clas = "box">
            <ul class="form">

                <li class="clearfix"><label><strong>Title </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="title"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Trạng Thái</strong>:</label>
                    <div class="filltext">
                        <select id="status" style="width: 203px;">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>Chức năng </strong>:</label>
                    <div class="filltext">
                        <select id="type" style="width: 203px;">
                            <option value="0">Mở chức năng app</option>
                            <option value="1">Mở 1 website</option>
                            <option value="2">Cài đặt App</option>
                        </select>
                    </div>
                </li>

                <li class="clearfix"><label><strong>URL </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="" id="url"> 
                    </div>
                </li>
                
                <li class="clearfix"><label><strong>Thời gian gửi </strong>:</label>
                    <?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'name' => 'time_sent',
                                    'id' => 'time_sent',
                                    'value' => '',
                                    // additional javascript options for the date picker plugin
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        'dateFormat' => 'yy-mm-dd 00:00:00',
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
                </li>

                <li class="clearfix"><label><strong>Chức năng </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"></textarea>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'description' );
                        </script>
                    </div>
                </li>
                
                

                <li class="clearfix"><label><strong>&nbsp;</strong></label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxSave();" type="button" value=" Thêm mới " class="btn-bigblue"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>

            </ul>
        </div>

    </div>
</div>