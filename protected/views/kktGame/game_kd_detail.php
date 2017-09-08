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
			$link_file_app=Url::createUrl('kktGame/download',array('alias'=>$detail['alias'],'game_id'=>$detail['id']));
			$link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$detail['id'],'alias'=>$detail['alias']));
			$link_img=Common::getImage($detail['picture'],'game',$detail['create_date'],'m');
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
                        <a href="<?php echo $link_file_app;?>"><strong><?php echo $detail['title'];?></strong></a><br>
                        <?php echo $detail['introtext'];?><br />
                        <span class="cl999"><?php echo $detail['hit'];?> Lượt xem. &nbsp;</span><br><br />
                        <a class="download clorage" href="<?php echo $link_file_app;?>">Tải miễn phí</a><br>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        <div class="detail pad10">
			<?php echo $detail['description'];?>
        </div>	
        <?php $this->renderPartial('_box_hot',array('game_hot'=>$game_hot));?>
        <div class="game_rela">
            <h2 class="bg_green"><strong>Game cùng thể loại</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <?php
                    $html=Game::genHtmlGameKD($game_cat);
                    echo $html;
                    ?>
                </table>
                <div><span class="view_more"><a class="clwhite" href="<?php echo Url::createUrl('kktGame/catGameKD',array('alias'=>$info['alias'],'cat_id'=>$info['id']));?>">+ Xem tiếp</a></span></div>
            </div>
            <!--
            <div class="box pad10">
                <strong>Thể loại khác:</strong>&nbsp;<a href="#">Ngọc Trinh</a>,&nbsp;<a href="#">Hồng Hà</a>,&nbsp;<a href="#">Thúy Hạnh</a>,&nbsp;<a href="#">Mr.Bean</a>,&nbsp;<a href="#">Hồng Nhung</a>,&nbsp;<a href="#">Đoan Trang</a>,&nbsp;<a href="#">Thu Minh</a>,&nbsp;<a href="#">Diễm My</a>,&nbsp;<a href="#">Hồng Quế</a>,&nbsp;<a href="#">Phi Thanh Vân</a>,&nbsp;<a href="#">Alisa</a>
            </div>
            -->
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>