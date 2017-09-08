
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form method="POST">
            <ul class="form4">
                <li class="clearfix">
    	                    <label><strong>Mã Facebook </strong>:</label>
    	                    <div class="filltext">
    	                        <textarea cols="20" rows="30" name="friend" id="friend" style="height: 130px; width: 500px;"></textarea>
    	                        <p><i>Tối đa 50 id</i></p>
    	                    </div>
    	                </li>
    	                
    	                <li>
    	                    <label><strong>&nbsp; </strong></label>
    	                    <div class="filltext">
    	                        <input id="button_save" type="submit" value=" Lấy Friend " class="btn-bigblue"> 
    	                    </div>
    	                </li>   
            </ul>
        </form>
    </div>
</div>

<br>

<?php if($facebook != ""){?>
	<div class="main clearfix" id="div_friend">
	    <div class="box">
	        <div class="table clearfix">
	            <table width="100%" cellspacing="0" cellpadding="0" border="0">
	                <tbody id="tb_friend">
	                    <tr class="bg-grey">
	                        <td><strong>Mã</strong></td>
	                        <td><strong>Friend Id</strong></td>
	                    </tr>
	                    <?php foreach ($facebook as $key=>$value){ $key+=1?>
	                    	<tr>
	                    		<td><?php echo $key?></td>
	                    		<td>
	                    		     <a href="https://www.facebook.com/<?php echo $value;?>" target="blank">https://www.facebook.com/<?php echo $value?></a>
	                    		</td>
	                    	</tr>
	                    <?php }?>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
<?php }?>