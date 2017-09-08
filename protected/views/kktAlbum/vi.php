<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10 nobor">
            <div class="nav_ctv">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>                    
        </div>
        <div class="pic_detail">
            <div class="table list_table">
                <?php
                $link_file_app=Url::createUrl('kktAlbum/download',array('alias'=>$detail['alias'],'album_id'=>$detail['id']));
                $link_detail=Url::createUrl('kktAlbum/detail',array('album_id'=>$detail['id'],'alias'=>$detail['alias']));
                $link_img=Common::getImage($detail['picture'],'image',$detail['create_date'],'');
                $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
                ?>	
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td width="52" class="nobor">
                            <a href="<?php echo $link_file_app;?>" title="<?php echo $detail['title'];?>">
                                <img width="160px;" src="<?php echo $link_img;?>" onerror="this.src='<?php echo $img_error;?>'" class="img52">
                            </a>
                        </td>
                        <td valign="top" class="item_data nobor">
                            <a href="<?php echo $link_file_app;?>"><strong><?php echo $detail['title'];?></strong></a> <br>
                            <span class="cl999"><?php echo $detail['hit'];?> Lượt xem. <?php echo sizeof($images);?> ảnh</span><br><br />
                            <a class="download clorage" href="<?php echo $link_file_app;?>">Tải miễn phí</a>
                        </td>
                    </tr>
                </table>
                <span class="pad_lr10">Doc khong dau: <a class="clgreen" href="<?php echo Url::createUrl('kktAlbum/vi',array('album_id'=>$detail['id'],'alias'=>$detail['alias']));?>"><?php echo Common::change($detail['title']);?></a></span>
            </div>
        </div>
        <div class="list_pic pad10 bor_top">
             <ul class="list_style">
             	<?php
				if($images)
				{
					$k=0;
					foreach($images as $row)
					{
						$link_img=Common::getImage($row['file'],'image',$row['create_date'],'m');
						echo '<li><img src="'.$link_img.'"></li>';
						$k++;
						if($k==3) break;
					}
					
				}
                ?>
             </ul>
             <div class="box pad10 bor_top">
                <a href="<?php echo $link_file_app;?>" class="download clorage"><strong>Tải trọn bộ <?php echo sizeof($images);?> ảnh</strong></a>
            </div>
        </div>	
        <div class="clip_vewing bottom10">
            <h2 class="bg_green"><strong>Clip liên quan</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$html=Video::genHtmlVideo($hot_video);
				echo $html;
				?>
                </table>
                <div><span class="view_more"><a class="clwhite" href="<?php echo Url::createUrl('kktVideo/hot');?>">+ Xem tiếp</a></span></div>
            </div>
        </div>
        <div class="news_hot">
            <h2 class="bg_green"><strong>Tin liên quan</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <?php
				$html=News::genHtmlNews($news);
				echo $html;
				?>    
                </table>
                <div><span class="view_more"><a class="clwhite" href="<?php echo Url::createUrl('kktNews/cat',array('cat_id'=>$info['id'],'alias'=>$info['alias']));?>">+ Xem tiếp</a></span></div>
            </div>
        </div>
        
        <?php $this->renderPartial('application.views.layouts._search');?>
        <?php $this->renderPartial('_box_cat',array('cats'=>$cats));?>
        <?php $this->renderPartial('application.views.layouts._privacy');?>
    </div>
 </div>
