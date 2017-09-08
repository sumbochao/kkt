<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>            
        </div>
        <?php $this->widget('BoxHot');?>
        <?php if($hot_games){?>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Top Games Mobile Kinh Điển</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktGame/hotGameKD');
				$html=Game::genHtmlGameKD($hot_games);
				echo $html;
				?>
                </table>
            <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span></div>
            </div>
		</div>
        <?php }?>
        <?php if($latest_games){?>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Games Mobile Kinh Điển mới</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$link_more=Url::createUrl('kktGame/latestGameKD');
				$html=Game::genHtmlGameKD($latest_games);
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