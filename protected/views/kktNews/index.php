<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Tin nóng</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktNews/index');
				$html=News::genHtmlNews($news);
				echo $html;
				?>
                </table>
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php //$this->renderPartial('_box_cat',array('cats'=>$cats));?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>
