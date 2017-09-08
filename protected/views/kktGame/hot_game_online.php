<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <div class="game_onlne">
            <h2 class="bg_green"><strong>Top Games Mobile Online</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktGame/hotGameOnline');
				$html=Game::genHtmlGameOnline($hot_games,$hot_games_file,$device,$user);
				echo $html;
				?>
                </table>
            </div>
		</div>
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('_box_cat',array('cats'=>$cats,'type'=>1));?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>