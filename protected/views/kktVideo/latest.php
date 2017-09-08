<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <div class="game_onlne">
            <h2 class="bg_green"><strong>Có gì mới</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$html=Video::genHtmlVideo($latest_video);
				echo $html;
				?>
                </table>
            </div>
		</div>
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('_box_cat',array('cats'=>$cats));?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>