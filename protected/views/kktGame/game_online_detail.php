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
			$link_detail=Url::createUrl('kktGame/gameOnlineDetail',array('game_id'=>$detail['id'],'alias'=>$detail['alias']));
			$link_img=Common::getImage($detail['picture'],'game',$detail['create_date'],'m');
			$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
            ?>	
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td width="52" class="nobor">
                        <a href="<?php echo $link_detail;?>" title="<?php echo $detail['title'];?>">
                            <img src="<?php echo $link_img;?>" onerror="this.src='<?php echo $img_error;?>'" class="img52">
                        </a>
                    </td>
                    <td valign="top" class="item_data nobor">
                        <a href="<?php echo $link_detail;?>"><strong><?php echo $detail['title'];?></strong></a><br>
                        <?php echo $detail['introtext'];?><br />
                        <span class="cl999"><?php echo $detail['hit'];?> Lượt xem. &nbsp;</span><br><br />
                        <?php
						if($game_file)
						foreach($game_file as $row)
						{
							$file_app=Common::getFilenameGame($user,$row['filename']);
							?>
                            <a class="download clorage" href="<?php echo $file_app;?>">Tải miễn phí</a>(<?php echo $row['extension'];?>)<br>
                            <?php
						}
                        ?>
                    </td>
                </tr>
            </table>
            </div>
        </div>
        <div class="detail pad10">
			<?php echo $detail['description'];?>
        </div>	
        <?php $this->renderPartial('_box_hot',array('game_hot'=>$game_hot));?>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>