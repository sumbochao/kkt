<div class="table clearfix">
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tbody>
            <tr class="bg-grey">
                <td width="5%"><strong>STT</strong></td>
                <td width="10%"><strong>Tên chương/Tên File</strong></td>
                <td width="11%"><strong>Duration</strong></td>
                <td width="5%"><strong>Size</strong></td>
                <td width="10%"><strong>Hành động</strong></td>

            </tr>
            <?php foreach($file_name as $key1=>$value1){$key1+=1;?>
                <tr>
                    <td class="middle"><?php echo $key1."</br>_</br>".$value1["id"]?></td>
                    <td><?php echo $value1["title"]."/</br>".$value1["file"] ;?></td>
                    <td><?php echo $value1["duration"];?></td>
                    <td><?php echo  $value1["size"];?></td>
                    <td>
                        <a class="s14" href="javascript:void(0)" onclick="ajaxGetEditAudioDetail('<?php echo $value1["id"]?>')"> Sửa </a> | 
                        <a href="javascript:void(0)" onclick="ajaxDeleteAudioDetail('<?php echo $value1["id"]?>','<?php echo $value1["story_audio_id"]?>')">  Xóa  </a> |
                    </td>
                </tr>
                <?php }?>
        </tbody>
    </table>
</div>
