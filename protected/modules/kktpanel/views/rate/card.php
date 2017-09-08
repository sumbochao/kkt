<div id="container">
    <div class="main clearfix">
        <div class="box clearfix bottom30">
            <form action="" method="GET">
                <ul class="form4">
                    <li class="clearfix"><label><strong>Tháng </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="m">
                                <?php for($i=1; $i<=12; $i++) { ?>
                                <option value="<?php echo $i;?>" <?php if($m==$i) echo "selected";?> >Tháng <?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Năm </strong>:</label>
                        <div class="filltext">
                            <select style="width:203px;" name="y">
                                <?php for($i=2012; $i<=2022; $i++) { ?>
                                <option value="<?php echo $i;?>" <?php if($y==$i) echo "selected";?> >Năm <?php echo $i;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </li>
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input type="submit" class="btn-bigblue" value=" Tìm kiếm"> 
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <div class="box clearfix bottom30">
            <form action="" method="POST">
                <ul class="form4">
                    <div class="title-blue"><h3><strong>Tỷ lệ của nhà mạng</strong></h3></div>
                    <?php foreach($rate as $row) { ?>                    
                    <li class="clearfix"><label><strong><?php echo $row["telco_name"] . " - " . Common::format_price($row["money"]);?></strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="<?php echo $row["id"];?>" value="<?php echo $row["rate_of_telco"];?>"> 
                        </div>
                    </li>
                    <?php }?>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input type="submit" name="submit" class="btn-bigblue" value=" cập nhật"> 
                        </div>
                    </li>                
                </ul>
            </form>
        </div>

    </div>
</div>