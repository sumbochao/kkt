<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <div class="game_onlne">
            <h2 class="bg_green"><strong>Chuyên mục: <?php echo $info['name'];?></strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				echo $html;
				?>
                </table>
            </div>
		</div>
        <?php $this->renderPartial('_box_hot',array('game_hot'=>$game_hot));?>
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>