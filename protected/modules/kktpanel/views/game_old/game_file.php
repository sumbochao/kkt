<?php $url = new Url();?>
<script type="text/javascript">
    function ajaxDeleteGameFile(id){
        var strUrl = "<?=$url->createUrl("game/ajaxDeleteGameFile") ?>";
        if(confirm('Bạn có chắc chắn muốn xóa file game này không ?')){
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
            <div class="fl">
                <a href="<?php echo $url->createUrl("game/createGameFile",array("gameId"=>$gameId))?>"><input type="button" class="btn-bigblue" value=" Thêm mới File"></a>
            </div>
        </div>
        <div class="table clearfix">
            <?php if($data_game["type"]==0){ ?>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr class="bg-grey">
                            <td width="5%"><strong>Id </strong></td>
                            <td width="10%"><strong>Tên file</strong></td>
                            <td width="8%"><strong>Size </strong></td>
                            <td width="5%"><strong>Dowload</strong></td>
                            <td width="8%"><strong>Ngày tạo</strong></td>
                            <td width="60%" style="text-align:left"><strong>Dòng máy</strong></td>
                            <td width="15%"><strong>Hành động</strong></td>
                        </tr>
                        <?php foreach($data as $key=>$value){
                                $handset = rtrim($value["handset"],",");
                                if(strlen($handset) >100){ $handset_short = substr($handset,0,100).'...';} else {$handset_short = $handset;}
                            ?> 
                            <tr>
                                <td><?php echo $value["id"];?></td>
                                <td><?php echo $value["filename"];?></td>
                                <td><?php echo $value["filesize"];?></td>
                                <td><?php echo $value["download"];?></td>
                                <td><?php echo date('d-m-y H:i:s',$value["create_date"]);?></td>
                                <td style="text-align:left" title="<?php echo $handset;?>"><?php echo $handset_short;?></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="ajaxDeleteGameFile('<?php echo $value["id"];?>')">  Xóa  </a> |
                                    <a href="<?php echo $url->createUrl("game/editGameFile",array("id"=>$value["id"],"gameId"=>$value["gameId"]))?>">Sửa</a>
                                </td>
                            </tr>
                            <?php }?>
                    </tbody>
                </table>    
                <?php }else{?>
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr class="bg-grey">
                            <td width="5%"><strong>Id </strong></td>
                            <td width="15%"><strong>Mã game Link</strong></td>
                            <td width="9%"><strong>Đối tác </strong></td>
                            <td width="5%"><strong>Dowload</strong></td>
                            <td width="60%" style="text-align:left"><strong>Dòng máy</strong></td>
                            <td width="16%"><strong>Hành động</strong></td>
                        </tr>
                        <?php foreach($data as $key=>$value){
                                $handset = rtrim($value["handset"],",");
                            ?> 
                            <tr>
                                <td><?php echo $value["id"];?></td>
                                <td><?php echo $value["linkId"];?></td>
                                <td><?php echo LoadConfig::$supplier[$value["supplier"]];?></td>
                                <td><?php echo $value["download"];?></td>
                                <td style="text-align:left"><?php echo $handset;?></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="ajaxDeleteGameFile('<?php echo $value["id"];?>')">  Xóa  </a> |
                                    <a href="<?php echo $url->createUrl("game/editGameFile",array("id"=>$value["id"],"gameId"=>$value["gameId"]))?>">Sửa</a>
                                </td>
                            </tr>
                            <?php }?>
                    </tbody>
                </table>
                <?php }?>
        </div>
    </div>
</div>