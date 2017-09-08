<div class="boxstyle4-cont clearfix">
	<div class="box">
		<div class="title-blue">
			<h3>
				<a href="#"><span>Hỗ trợ trực tuyến</span>
				</a>
			</h3>
		</div>
        <a><strong><span>Hỗ trợ 1 :</span></strong></a>
		<div style="padding-bottom: 25px" class="box-new"> 
               <?php
                if($newsContact)
                foreach($newsContact as $row)
                {
                    ?>
         <p class="ic_phone"><strong class="s14"><?php echo $row['phone'];?></strong></p>
         <p class="ic_email"><a href="#"><strong><?php echo $row['email'];?></strong></a></p>
			<ul class="list-support clearfix">          
                    <li class="clearfix"><a href="ymsgr:sendIM?<?php echo $row['user_yahoo'];?>"><?php echo $row['full_name'];?></a></li>
                    <li class="clearfix"><a href="ymsgr:sendIM?<?php echo $row['user_yahoo2'];?>"><?php echo $row['name2'];?></a></li>
                    <a href="skype:<?php echo $row['user_skype2'];?>?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_transparent_34x34.png" style="border: none;" width="30" height="30" alt="Skype Me™!" /><strong><?php echo $row['user_skype2'];?></strong></a>
                    <?php    
                }
                ?>
            </ul> 
		</div>
          <a><strong><span>Hỗ trợ 2 :</span></strong></a>
        <div style="padding-bottom: 25px" class="box-new"> 
               <?php
                if($newsContact2)
                foreach($newsContact2 as $row)
                {
                    ?>
         <p class="ic_phone"><strong class="s14"><?php echo $row['phone'];?></strong></p>
         <p class="ic_email"><a href="#"><strong><?php echo $row['email'];?></strong></a></p>
            <ul class="list-support clearfix">          
                    <li class="clearfix"><a href="ymsgr:sendIM?<?php echo $row['user_yahoo'];?>"><?php echo $row['full_name'];?></a></li>
                    <li class="clearfix"><a href="ymsgr:sendIM?<?php echo $row['user_yahoo2'];?>"><?php echo $row['name2'];?></a></li>
                    <a href="skype:<?php echo $row['user_skype2'];?>?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_blue_transparent_34x34.png" style="border: none;" width="30" height="30" alt="Skype Me™!" /><strong><?php echo $row['user_skype2'];?></strong></a>
                    <?php    
                }
                ?>
            </ul> 
        </div>
             
	</div>
</div>