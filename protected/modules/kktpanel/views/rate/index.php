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
                    <div class="title-blue"><h3><strong>Tỷ lệ hợp tác phát hành (Doanh số sau telco nhỏ hơn <?php echo Common::format_price($rate["issue_price"]);?> VNĐ) </strong></h3></div>
                    <li class="clearfix"><label><strong>Khách hàng</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_user_min" value="<?php echo $rate["issue_rate_of_user_min"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>HDC</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_hdc_min" value="<?php echo $rate["issue_rate_of_hdc_min"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Nhà sản xuất</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_producer_min" value="<?php echo $rate["issue_rate_of_producer_min"];?>"> 
                        </div>
                    </li>
                    
                    <div class="title-blue"><h3><strong>Định mức hợp tác phát hành</strong></h3></div>
                    <li class="clearfix"><label><strong>Định mức</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_price" value="<?php echo Common::format_price($rate["issue_price"]);?>"> 
                        </div>
                    </li>
                    
                    <div class="title-blue"><h3><strong>Tỷ lệ hợp tác phát hành (Doanh số sau telco lớn hơn <?php echo Common::format_price($rate["issue_price"]);?> VNĐ) </strong></h3></div>
                    <li class="clearfix"><label><strong>Khách hàng</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_user_max" value="<?php echo $rate["issue_rate_of_user_max"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>HDC</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_hdc_max" value="<?php echo $rate["issue_rate_of_hdc_max"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>Nhà sản xuất</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="issue_rate_of_producer_max" value="<?php echo $rate["issue_rate_of_producer_max"];?>"> 
                        </div>
                    </li>
                    
                    <div class="title-blue"><h3><strong>Tỷ lệ ứng dụng bán lẻ (Doanh số sau telco nhỏ hơn <?php echo Common::format_price($rate["price"]);?> VNĐ) </strong></h3></div>
                    <li class="clearfix"><label><strong>Khách hàng</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="rate_of_user_min" value="<?php echo $rate["rate_of_user_min"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>HDC</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="rate_of_hdc_min" value="<?php echo $rate["rate_of_hdc_min"];?>"> 
                        </div>
                    </li>
                    
                    <div class="title-blue"><h3><strong>Định mức ứng dụng bán lẻ </strong></h3></div>
                    <li class="clearfix"><label><strong>Định mức</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="price" value="<?php echo Common::format_price($rate["price"]);?>"> 
                        </div>
                    </li>
                    
                    <div class="title-blue"><h3><strong>Tỷ lệ ứng dụng bán lẻ (Doanh số sau telco lớn hơn <?php echo Common::format_price($rate["price"]);?> VNĐ) </strong></h3></div>
                    <li class="clearfix"><label><strong>Khách hàng</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="rate_of_user_max" value="<?php echo $rate["rate_of_user_max"];?>"> 
                        </div>
                    </li>
                    <li class="clearfix"><label><strong>HDC</strong>:</label>
                        <div class="filltext">
                            <input type="text" style="width:200px" name="rate_of_hdc_max" value="<?php echo $rate["rate_of_hdc_max"];?>"> 
                        </div>
                    </li>
                    
                    <li class="clearfix"><label>&nbsp;</label>
                        <div class="filltext">
                            <input type="submit" class="btn-bigblue" value=" cập nhật"> 
                        </div>
                    </li>                
                </ul>
            </form>
        </div>

    </div>
</div>