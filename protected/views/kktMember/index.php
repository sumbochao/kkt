<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        
        
        <?php if($games){?>
        <div class="game_onlne"><h2 class="bg_green"><strong>Top Games Mobile</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <?php
                        $link_more=Url::createUrl('kktGame/gameKD');
                        $html=Game::genHtmlGameKD($games);
                        echo $html;
                    ?>
                </table>
                <div><span class="view_more"><a class="clwhite" href="<?php echo $link_more;?>">+ Xem tiếp</a></span>
                </div>
            </div>
        </div>
        <?php }?>
        <?php echo $kenh18;?>
        
        <?php echo $view;?>
        <?php echo $hot_news;?>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php //$this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>