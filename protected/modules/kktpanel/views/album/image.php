<?php $url = new Url();?>
<script type="text/javascript">
function ajaxDeleteImage(id){
        var strUrl = "<?=$url->createUrl("album/ajaxDeleteImage") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa không ?')){
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
    <div class="box">
        <div class="fillter clearfix">
            <div class="fl"><strong>Có <span class="clred"><?php echo count($data_image);?> </span> ảnh thuộc album: <b><?php echo $data_album["title"]?></b></strong></div>
        </div>
        <div class="box-bor1 clearfix">
            <ul class="list-col4">
            <?php foreach($data_image as $key=>$value){?>
                <li>
                    <h3><a href="#"><strong><?php echo $value["file"]?></strong></a></h3>
                    <p class="bottom5"><img class="img-100" alt="pic" src="<?php echo Common::getImage($value["file"],"image",$value["create_date"])?>" class="img-theme"></p>
                    <p class="Group"><a href="javascript:void(0)" onclick="ajaxDeleteImage('<?php echo $value["id"];?>')">Xóa</a></p>
                </li>
            <?php }?>
            </ul>
        </div>
        <div class="fillter clearfix">
            <div class="fl"><strong>Có <span class="clred"><?php echo count($data_image);?> </span> ảnh thuộc album: <b><?php echo $data_album["title"]?></b></strong></div>
        </div>
    </div>
</div>