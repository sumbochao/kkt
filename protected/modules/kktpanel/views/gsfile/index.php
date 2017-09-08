<?php
    $url = new Url();
    $current_url = Common::getCurrentUrl();
    $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
    $path_paging = str_replace("?page=".$page."&","?",$path_paging);
    $path_paging = str_replace("&page=".$page."&","&",$path_paging);
    //var_dump($path_paging);
?>
<script type="text/javascript">
    function ajaxDelete(id)
    {
        var strUrl = "<?=$url->createUrl("gsfile/ajaxDelete") ?>";
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
    <div class="box clearfix bottom30">
        <div class="box clearfix bottom30">

            <form method="GET">
                <ul class="form4">

                    <li class="clearfix"><label><strong>Hệ điều hành </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="type">
                                <option value="0">--Tất cả--</option>
                                <option value="2" <?php echo ($type == 2 ? 'selected="selected"':'' )?>>- Android -</option>
                                <option value="3" <?php echo ($type == 3 ? 'selected="selected"':'' )?>>- IOS -</option>
                            </select>
                        </div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Version Android</strong>:</label>
                        <div class="filltext"><?php echo $game['version_android'] ?></div>
                    </li>
                    
                    <li class="clearfix"><label><strong>Version Ios</strong>:</label>
                        <div class="filltext"><?php echo $game['version_ios'] ?></div>
                    </li>

                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input type="hidden" name="id" value="<?php echo $game_id;?>" class="btn-bigblue"> 
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
                Tìm thấy <strong class="clred"><?php echo $count ?></strong> kết quả - 
                <a href="<?php echo $url->createUrl("gsfile/createapk",array('game_id'=>$game_id))?>"><input type="button" class="btn-bigblue" value=" Add File Apk"></a>
                <a href="<?php echo $url->createUrl("gsfile/createios",array('game_id'=>$game_id))?>"><input type="button" class="btn-bigblue" value=" Add File Ios"></a>
                <a href="<?php echo $url->createUrl("gsfile/createlink",array('game_id'=>$game_id))?>"><input type="button" class="btn-bigblue" value=" Add Link "></a>
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
                        <td width="15%"><strong>File Path</strong></td>
                        <td width="15%"><strong>Hệ điều hành</strong></td>
                        <td width="15%"><strong>Version</strong></td>
                        <td width="15%"><strong>Version OS</strong></td>
                        <td width="15%"><strong>Hành động</strong></td>
                    </tr>

                    <?php foreach($data as $key=>$value){$key+=1;?>
                        <tr>
                            <td class="middle"><?php echo $key;?></td>
                            <td class="middle"><?php echo $value['file_path'];?></td>
                            <td class="middle">
                                <?php  
                                    if($value['os_type'] == "2"){
                                        echo "Android";  
                                    }elseif($value['os_type'] == "3"){
                                        echo "IOS";
                                    }
                                ?>
                            </td>
                            <td class="middle"><?php echo $value['version'];?></td>
                            <td class="middle"><?php echo $value['version_os'];?></td>
                            <td>
                                <a href="javascript:void(0)" onclick="ajaxDelete('<?php echo $value["id"]?>')">  Xóa  </a>
                            </td>
                        </tr>
                        <?php }?>

                </tbody>
            </table>
        </div>

    </div>

</div>