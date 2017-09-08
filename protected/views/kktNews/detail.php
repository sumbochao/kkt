<div class="container">
    <div class="main clearfix">
        <div class="bg_033 pad10 nobor">
            <div class="nav_ctv">
                <?php $this->renderPartial('application.views.layouts._menu');?>
            </div>                    
        </div>
        <div class="news_detail">
            <div class="table list_table">
                <?php
                $link_detail=Url::createUrl('kktNews/detail',array('new_id'=>$detail['id'],'alias'=>$detail['alias']));
                $link_img=Common::getImage($detail['picture'],'news',$detail['create_date'],'m');
                $img_error=Yii::app()->params['static_url'].'/images/farmvui52.png';
				$total_img=0;
				$description=$detail['description'];
				preg_match_all('/src=["](.*?)["]/si',$description,$match);
				$total_img=isset($match[0]) ? sizeof($match[0]):0;
                ?>
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td width="52" class="nobor">
                            <a href="<?php echo $link_detail;?>" title="<?php echo $detail['title'];?>">
                                <img src="<?php echo $link_img;?>" onerror="this.src='<?php echo $img_error;?>'" class="img52">
                            </a>
                        </td>
                        <td valign="top" class="item_data nobor">
                            <a href="<?php echo $link_detail;?>"><strong><?php echo $detail['title'];?></strong></a> <br>
                            <span class="cl999"><?php echo $detail['hit'];?> Lượt xem. <?php echo $total_img;?> ảnh</span><br>
                        </td>
                    </tr>
                </table>
                <span class="pad_lr10">Doc khong dau: <a class="clgreen" href="<?php echo Url::createUrl('kktNews/vi',array('new_id'=>$detail['id'],'alias'=>$detail['alias']));?>"><?php echo Common::change($detail['title']);?></a></span>
            </div>
        </div>
        <div class="news_cont pad10 bor_top">
             <div class="table">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td>                        	
                            <h4 class="tit-detail clorage"><strong><?php echo $detail['title'];?></strong></h4>
                            <div class="tool mag_btt_t5 cl999">
                                <span class="time"><?php echo date('H:i',$detail['create_date']);?></span> - <span class="date"><?php echo date('d/m/Y',$detail['create_date']);?></span>
                            </div>
                            <!--
                            <ul class="list_style">
                                <li><a href="#">Jang Geun Suk cũng "tậu" nhà triệu đô</a></li>
                                <li><a href="#"> Taylor Swift tậu nhà triệu đô cho bố mẹ</a></li>
                                <li><a href="#">T.O.P "chịu chơi" khi tậu nhà... 3 triệu đô"</a></li>
                                <li><a href="#">Jay Chou "tậu" biệt thự 400 tỷ cạnh nhà... Nicole Kidman?</a></li>
                            </ul>
                            -->
                            <?php echo $description;?>
                        </td>
                    </tr>
                </table>
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