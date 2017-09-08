<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10 nobor">
            <div class="nav_ctv">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>                    
        </div>
        <div class="game_detail">
            <div class="table list_table">
            <?php
			$link_file_app=Url::createUrl('kktVideo/download',array('alias'=>$detail['alias'],'video_id'=>$detail['id']));
			$link_detail=Url::createUrl('kktVideo/detail',array('video_id'=>$detail['id'],'alias'=>$detail['alias']));
			$link_img=Common::getImage($detail['picture'],'video',$detail['create_date'],'m');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
            ?>	
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="52" class="nobor">
                        <a href="<?php echo $link_file_app;?>" title="<?php echo $detail['title'];?>">
                            <img src="<?php echo $link_img;?>" onerror="this.src='<?php echo $img_error;?>'" class="img52">
                        </a>
                    </td>
                    <td valign="top" class="item_data nobor">
                        <a href="<?php echo $link_file_app;?>"><strong><?php echo $detail['title'];?></strong></a> <br>
                        <span class="cl999"><?php echo $detail['hit'];?> Lượt xem. &nbsp;</span><br><br />
                        <a class="download clorage" href="<?php echo $link_file_app;?>">Tải miễn phí</a><br>
                    </td>
                </tr>
            </table>
            <span class="pad_lr10">Doc khong dau: <a class="clgreen" href="<?php echo Url::createUrl('kktVideo/vi',array('video_id'=>$detail['id'],'alias'=>$detail['alias']));?>"><?php echo Common::change($detail['title']);?></a></span>
            </div>
        </div>
        <?php
		if($video_hot)
		foreach($video_hot as $row)
		{
			$link_detail=Url::createUrl('kktVideo/detail',array('video_id'=>$row['id'],'alias'=>$row['alias']));
			?>
            <div class="news pad10 bg_orage2">
                <span class="s14">Hot: <a class="clorage" href="<?php echo $link_detail;?>"><strong><?php echo $row['title'];?></strong></a> <img alt="icon new" src="<?php echo Yii::app()->params['static_url'];?>/images/icon_new2.png"></span> <br>
            </div>
            <?php
		}
        ?>        
        <div class="game_rela">
            <h2 class="bg_green"><strong>Video cùng thể loại</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <?php
                    $html=Video::genHtmlVideo($video_cat);
                    echo $html;
                    ?>
                </table>
                <div><span class="view_more"><a class="clwhite" href="<?php echo Url::createUrl('kktVideo/cat',array('alias'=>$info['alias'],'cat_id'=>$info['id']));?>">+ Xem tiếp</a></span></div>
            </div>
            <!--
            <div class="box pad10">
                <strong>Thể loại khác:</strong>&nbsp;<a href="#">Ngọc Trinh</a>,&nbsp;<a href="#">Hồng Hà</a>,&nbsp;<a href="#">Thúy Hạnh</a>,&nbsp;<a href="#">Mr.Bean</a>,&nbsp;<a href="#">Hồng Nhung</a>,&nbsp;<a href="#">Đoan Trang</a>,&nbsp;<a href="#">Thu Minh</a>,&nbsp;<a href="#">Diễm My</a>,&nbsp;<a href="#">Hồng Quế</a>,&nbsp;<a href="#">Phi Thanh Vân</a>,&nbsp;<a href="#">Alisa</a>
            </div>
            -->
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('_box_cat',array('cats'=>$cats));?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>