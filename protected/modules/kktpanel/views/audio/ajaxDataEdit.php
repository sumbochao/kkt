

<?php if($upload ==0){ ?>
<li id="file_audio_name" class="clearfix" ><label><strong>Tên file</strong>:</label>
    <div class="filltext">
        <input style="width:360px" type="text" value="<?php echo $data_edit[0]['file'];?>" id="file_audio_ftp"/>
    </div>
</li>
<?php } ?>
<li class="clearfix"><label><strong>Tiêu đề chương</strong>:</label>
    <div class="filltext">
        <input style="width:360px" type="text" value="<?php echo $data_edit[0]['title']; ?>" id="title_chapter"/>
    </div>
</li>
<li class="clearfix"><label><strong>Thời gian</strong>:</label>
    <div class="filltext">
        <input style="width:360px" type="text" value="<?php echo $data_edit[0]['duration']; ?>" id="duration"/> (hh:mm:ss)
    </div>
</li>
<li class="clearfix"><label><strong>Dung lượng</strong>:</label>
    <div class="filltext">
        <input style="width:360px" type="text" value="<?php echo $data_edit[0]['size']; ?>" id="size"/> 
        <input type="hidden" id="audio_detail_id" value="<?php echo $data_edit[0]['id']; ?>">
        <input type="hidden" id="story_audio_id" value="<?php echo $data_edit[0]['story_audio_id']; ?>">
    </div>
</li>

