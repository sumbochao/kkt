<div class="toppic">
    <h2 class="bg_orage"><strong>Chủ đề</strong></h2>
    <div class="list_item pad10">
        <ul class="list_style">
        	<?php
			if($cats)
			foreach($cats as $row)
			{
				$link_cat=Url::createUrl('kktNews/cat',array('alias'=>$row['alias'],'cat_id'=>$row['id']));
				?>
              	<li><a href="<?php echo $link_cat;?>"><?php echo $row['name'];?></a></li>  
                <?php
			}
            ?>
        </ul>
    </div>
</div>