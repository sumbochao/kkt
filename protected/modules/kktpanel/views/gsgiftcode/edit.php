<?php
    $url = new Url(); 
    $forder_upload = "gamestore/giftcode";  
    $link_avatar = Yii::app()->params["urlImages"]."upload_avatar.php?forder_upload=".$forder_upload;     
    $link_url = Yii::app()->params["urlImages"]."upload_base.php?forder_upload=".$forder_upload;
?>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->params['static_url']; ?>css/jquery-ui-1.10.4.custom.min.css">
<script type="text/javascript" src="<?php echo Yii::app()->params['static_url']; ?>js/jquery-ui-1.10.4.custom.min.js"></script>

<script type="text/javascript">

    $(function() {
        var availableTags = [
            <?php
                for($i=0;$i<count($game);$i++)
                {
                    echo '"'.$game[$i]['name'].'",';
                }
            ?>
        ];
        $( "#game" ).autocomplete({
            source: availableTags
        });
    });

    function ajaxUpdate(){
        var strUrl = "<?=$url->createUrl('gsgiftcode/ajaxUpdate')?>";
        var title = $('#title').val();
        var game = $('#game').val();
        var total = $('#total').val();
        var available = $('#available').val();
        var description = $('#description').val();
        var excel = $('#excel').val();
        $.ajax({
            type: "POST",
            url: strUrl,
            data:{
                id: '<?php echo $id;?>',
                title: title,
                game: game,
                total: total,
                available: available,
                description: description,
                excel: excel,
            },
            success: function(msg){
                if(msg == 1){
                    alert('Thêm thành công');
                    window.location = '<?php echo $url->createUrl("gsgiftcode/index")?>';
                }else{
                    alert('Có lỗi');
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
                <li class="clearfix"><label><strong>Tên Gift Code </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['title']?>" id="title"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Game </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php $game = GGame::getDataById($data['game_id']); echo $game['name'];?>" id="game"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Tổng số </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['total_giftcode']?>" id="total"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Còn lại </strong>:</label>
                    <div class="filltext">
                        <input type="text" style="width:360px" value="<?php echo $data['available_giftcode']?>" id="available"> 
                    </div>
                </li>

                <li class="clearfix"><label><strong>Giới thiệu </strong>:</label>
                    <div class="filltext">
                        <textarea cols="5" rows="5" style="width:420px; height:120px" id="description"><?php echo $data['description']?></textarea>
                    </div>
                </li>

                <!--<li class="clearfix"><label><strong>Gift Code </strong>:</label>
                    <div class="filltext">
                        <p>
                            <input type="hidden" id="txtFileName_other" readonly="readonly"/>
                            <input type="text" id="urlFile_other" style="border:1px solid #DFDFDF; width: 200px;">                            
                            <span id="spanButtonPlaceHolder_other"></span>
                        </p>

                        <p><i>Định dạng file: *.xls; *.xlsx;(Dung lượng ko được quá 200 MB)</i></p>
                        <br/>
                        <div class="fieldset flash" id="fsUploadProgress_other">
                            <span class="legend">File upload</span>
                        </div>

                        <input type="hidden" id="excel" value=""/>
                        <p id="show_excel"></p>

                    </div>
                </li>-->

                <li>
                    <label><strong>&nbsp; </strong></label>
                    <div class="filltext">
                        <input id="button_save" onclick="ajaxUpdate();" type="button" value=" Thay đổi " class="btn-bigblue"> 
                        &nbsp;
                        <input onclick="history.go(-1)" type="button" value=" Quay lại " class="btn-bigblue">
                    </div>
                </li>

                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext" style="color: red;" id="show_error"></div>
                </li>

            </ul>
        </div>

    </div>
</div>