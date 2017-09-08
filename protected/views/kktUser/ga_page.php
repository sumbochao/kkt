<?php
   $url = new Url();
?>
<div class="container">
    <div class="main clearfix">
        <div class="news pad10 bg_orage3"></div>
        <div class="game_clsic">
        <h2 class="bg_green"><strong>Nhập ga</strong></h2>
        </div>
        <div class="search pad10 bor_top">
            <span><strong><?php echo $upload==1 ? 'Upload file thành công':''?></strong></span>
            <span style="color: red;"><?php echo $error;?></span>
            <form method="post" enctype="multipart/form-data">

                <p><strong>GA:</strong></p>
                <textarea style="width: 80%; height: 100px;" name="ga"><?php echo isset($data["ga"]) && $data["ga"] !="" ? $data["ga"]:$ga;?></textarea>
                <p><strong>File xác nhận:</strong><i>(Chỉ được upload file đuôi .html hoặc .htm)</i></p>
                <p><input name="file_ga" type="file"/></p>
                <input type="submit" value="Cập nhật"/>
            </form>
        </div>
    </div>
</div>