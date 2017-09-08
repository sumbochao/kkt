<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>          
        </div>
        <?php $this->widget('BoxHot');?>
        <?php if($hot_games){?>
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
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
        <?php }?>
        <?php if($latest_games){?>
        <div class="game_onlne">
            <h2 class="bg_green"><strong>Games Mobile Online mới</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktGame/latestGameOnline');
				$html=Game::genHtmlGameOnline($latest_games,$latest_games_file,$device,$user);
				echo $html;
				?>
                </table>
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
        <?php }?>
        <?php $this->renderPartial('application.views.layouts._search');?>
    	<?php $this->renderPartial('application.views.layouts._privacy');?>
	</div>
</div>