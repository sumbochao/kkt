<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <?php if($hot_video){?>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Siêu nóng bỏng</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktVideo/hot');
				$html=Video::genHtmlVideo($hot_video);
				echo $html;
				?>
                </table>
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
        <?php }?> 
        <?php if($latest_video){?>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Có gì mới</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktVideo/latest');
				$html=Video::genHtmlVideo($latest_video);
				echo $html;
				?>
                </table>
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
         <?php }?>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php //$this->renderPartial('_box_cat',array('cats'=>$cats));?>
        <?php //$this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>