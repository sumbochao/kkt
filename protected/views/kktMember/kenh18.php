<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
            <?php $this->widget('BoxHot');?>
        </div>
        <?php echo $video;?>
        <?php echo $album;?>
        <?php echo $news;?>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
	</div>
</div>