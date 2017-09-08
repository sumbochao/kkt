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
				$html=Album::genHtmlAlbum($album);
				echo $html;
				?>
                </table>
            </div>
		</div>
        <?php
		if($hot_album)
		foreach($hot_album as $row)
		{
			$link_detail=Url::createUrl('kktAlbum/detail',array('album_id'=>$row['id'],'alias'=>$row['alias']));
			?>
			<div class="news pad10 bg_orage2">
				<span class="s14">Hot: <a class="clorage" href="<?php echo $link_detail;?>"><strong><?php echo $row['title'];?></strong></a> <img alt="icon new" src="<?php echo Yii::app()->params['static_url'];?>/images/icon_new2.png"></span> <br>
			</div>
			<?php
		}
		?>
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
	</div>
</div>