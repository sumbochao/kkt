<div class="boxstyle4-cont clearfix">
	<div class="box">
		<div class="title-blue">
			<h3>
				<a href="<?php echo (Url::createUrl('home/index', array('alias'=>Common::generate_slug(LoadConfig::$menu[$type]), 'type'=>$type))); ?>"><span>Sản phẩm nổi bật</span></a>
			</h3>
		</div>
		<div class="box-new">
			<script type="text/javascript">
			<?php $totalNewsHot = count($news); ?>
			var curPos=0;
			function SlideProductHot(index)
			{
				$("#product_hot_"+curPos).css('display', 'none');
				$("#product_hot_"+index).css('display', '');
				
				$("#ico_product_hot_"+curPos).removeClass("active");
				$("#ico_product_hot_"+index).addClass("active");
			
				curPos = index;
				index = (index == <?php echo ($totalNewsHot-1); ?>) ? 0 : (index + 1);
			}
			</script>
			<ul class="list">
				<?php $img_error=Yii::app()->params['static_url'].'demo/default.png'; 
					$i=0; $j=0; foreach ($news as $row) { 
						if($j == 0) {
							$display = "style=\"display:inline;\"";
						}
						else {
							$display = "style=\"display:none;\"";
						}
						
						if(!empty($row['picture'])) {
		                    $urlImage = Common::getImage($row["picture"],'picture/news',$row['create_date'],'') . "?num=". rand(1,101001);    
		                } else {
		                    $urlImage = $img_error;
		                } ?>
		        <?php if($i % 2 == 0) echo ("<span " . $display . " id=\"product_hot_" . $j . "\">");?>        
				<li class="clearfix">
					<h3 class="s12">
						<a href="<?php echo (Url::createUrl('home/detail', array('alias'=>$row['alias'], 'type'=>$row['type'], 'id'=>$row['id']))); ?>"><strong><?php echo ($row['title']);?></strong></a>
					</h3> 
					<a href="<?php echo (Url::createUrl('home/detail', array('alias'=>$row['alias'], 'type'=>$row['type'], 'id'=>$row['id']))); ?>">
						<img class="img-80" alt="<?php echo ($row['title']); ?>" src="<?php echo $urlImage;?>">
					</a>
					<p class="decription"><?php echo stripcslashes($row['introtext']);?></p>
				</li>	
				<?php if(($i+1) % 2 == 0 || (($i+1)==$totalNewsHot)) { $j++; echo ("</span>");}?>
				<?php $i++; } ?>
			</ul>
		</div>
		<div class="bottom_bg clearfix">
			<ul class="paging" style="margin: 23px 0 0 42%; float: right">
				<?php for($i=0; ($i<ceil($totalNewsHot/2)); $i++) { ?>
				<li>
					<a id="ico_product_hot_<?php echo ($i);?>" <?php if($i==0) echo ("class=\"active\"");?> href="javascript:" onmouseover="SlideProductHot(<?php echo ($i);?>);">&nbsp;</a>
				</li>	
				<?php } ?>
			</ul>
		</div>
	</div>
</div>