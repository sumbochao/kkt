                         
                <?php
                foreach($newsVideo as $row)
                {
                ?>   
          <div class="ad clearfix">
          
            <a href=""> 
<iframe title="YouTube video player" class="youtube-player" type="text/html" width="290" height="280" src="<?php echo $row['title'];?>" frameborder="0" allowFullScreen></iframe></a>
                <?php
                }
?>
               
  
        </div>

