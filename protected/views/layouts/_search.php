<?php
    $keyword = isset ( $_GET ['keyword'] ) && ($_GET ['keyword']!='Nhập tìm kiếm') ?  Common::cleanQuery($_GET ['keyword']) : '';
    $keyword=str_replace('+',' ',$keyword);
?>
<div class="search pad10 bor_top">
    <form method="get" action="<?php echo Url::createUrl('kktSearch/index');?>">
        <input type="text" class="" value="<?php if($keyword!='') echo $keyword; else echo 'Nhập tìm kiếm';?>" style="width:93%" onfocus="if (this.value == this.defaultValue) this.value = '';" onblur="if (this.value == this.defaultValue || this.value == '') this.value = this.defaultValue" id="keyword" name="keyword"><input type="submit" class="btn btn_active" value="Tìm kiếm">
    </form>
</div>