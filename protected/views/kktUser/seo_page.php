<?php
   $url = new Url();
?>
<div class="container">
    <div class="main clearfix">
        <div class="news pad10 bg_orage3"></div>
        <div class="game_clsic">
        <h2 class="bg_green"><strong>SEO cho trang nội dung</strong></h2>
        </div>
        <div class="search pad10 bor_top">
            <form method="post">
                <select name="type" onchange="window.location='<?php echo $url->createUrl("kktUser/seoPage").'?typePage='?>'+this.value">
                   <?php foreach(LoadConfig::$page_seo as $key=>$value){?>
                    <option value="<?php echo $key;?>" <?php echo $typePage==$key ? 'selected="selected"':''?>><?php echo $value;?></option>
                   <?php }?>
                </select>
                <p><strong>Title:</strong></p>
                <input maxlength="70" name="metaTitle" type="text" style="width:80%" value="<?php echo isset($data["metaTitle"]) && $data["metaTitle"] !="" ? $data["metaTitle"]:$metaTitle;?>">
                <br/><span class="cl999">Tối đa 70 kí tự</span>
                <p><strong>Keyword:</strong></p>
                <input maxlength="70" name="metaKeyword" type="text" style="width:80%" value="<?php echo isset($data["metaKeyword"]) && $data["metaKeyword"] !="" ? $data["metaKeyword"]:$metaKeyword;?>">
                <br/><span class="cl999">Tối đa 5 Keyword, mỗi keyword cách nhau dấu ","</span>
                <p><strong>Description:</strong></p>
                <textarea maxlength="70" style="width: 80%; height: 100px;" name="metaDescription"><?php echo isset($data["metaDescription"]) && $data["metaDescription"] !="" ? $data["metaDescription"]:$metaDescription;?></textarea>
                <br/><span class="cl999">Tối đa 155 kí tự</span>
                <p></p><input type="submit" value="Cập nhật"/>
            </form>
        </div>
    </div>
</div>