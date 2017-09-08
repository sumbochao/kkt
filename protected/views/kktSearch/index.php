<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10">
            <div class="nav_ctv bottom10">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>
        <div class="game_clsic">
            <h2 class="bg_green"><strong>Từ khóa: <?php echo $keyword;?></strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				if($search)
				foreach($search as $row)
				{
					$icon_type='';
					$link_detail='';
					$link_img='';
					$img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
					if($row['type']==1)
					{
						$icon_type='class="ic_game"';
						$link_img=Common::getImage($row['picture'],'game',$row['create_date'],'m');
						if($row['isOnline']==1)
						{
							$link_detail=Url::createUrl('kktGame/gameOnlineDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
						}
						else
						{
							$link_detail=Url::createUrl('kktGame/gameKDDetail',array('game_id'=>$row['id'],'alias'=>$row['alias']));
						}
					}
					else if($row['type']==2)
					{
						$icon_type='class="ic_video"';
						$link_img=Common::getImage($row['picture'],'video',$row['create_date'],'m');
						$link_detail=Url::createUrl('kktVideo/detail',array('video_id'=>$row['id'],'alias'=>$row['alias']));
					}
					else if($row['type']==3)
					{
						$icon_type='class="ic_pic"';
						$link_img=Common::getImage($row['picture'],'image',$row['create_date'],'m');
						$link_detail=Url::createUrl('kktAlbum/detail',array('album_id'=>$row['id'],'alias'=>$row['alias']));
					}
					else
					{
						$icon_type='class="ic_news"';
						$link_img=Common::getImage($row['picture'],'news',$row['create_date'],'m');
						$link_detail=Url::createUrl('kktNews/detail',array('new_id'=>$row['id'],'alias'=>$row['alias']));	
					}
					?>
                    <tr>
                        <td width="52">
                            <a title="<?php echo $row['title'];?>" href="<?php echo $link_detail;?>">
                                <img onerror="this.src='<?php echo $img_error;?>'" src="<?php echo $link_img;?>" class="img52 mag_r5" alt="<?php echo $row['title'];?>"/>
                            </a>
                        </td>
                        <td valign="top" class="item_data">
                            <a href="<?php echo $link_detail;?>"><strong><?php echo $row['title'];?></strong></a>
                            <br>
                            <span class="cl666"><?php echo $row['introtext'];?></span>
                            <br>
                            <span class="cl999"><?php echo $row['hit'];?> Lượt xem &nbsp;|&nbsp;</span><a href="<?php echo $link_detail;?>" class="download clorage">Tải miễn phí</a>
                        </td>
                    </tr>
                    
                    <?php
				}
                ?>
                </table>
            </div>
        </div>
        <?php $this->renderPartial('application.views.layouts._search');?>   
        <div class="pages pad10">
            <?php echo $paging;?>
        </div>
        <?php //$this->widget('BoxFooter');?>
    </div>
</div>