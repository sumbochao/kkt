<script src="<?php  echo Yii::app()->params['static_url_cp']; ?>/js/export.js" type="text/javascript"></script> 
<div class="main clearfix">
    <div class="box clearfix bottom30">
        <form action="" method="GET">
            <ul class="form4">
                <li class="clearfix"><label><strong>Tên thành viên </strong>:</label>
                    <div class="filltext">
                        <input type="text" name="username" id="username" style="width:196px" value="<?php if(isset($search["username"])) echo $search["username"];?>"> 
                    </div>
                </li>
                <li class="clearfix"><label><strong>Ngày</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="day" id="day">
                            <option value="">-- Tất cả --</option>
                            <?php for($i=1; $i<=31; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["day"]==$i) echo "selected";?> ><?php echo "Ngày " . $i;?></option>
                            <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Tháng</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="month" id="month">
                            <?php for($i=1; $i<=12; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["month"]==$i) echo "selected";?> ><?php echo "Tháng " . $i;?></option>
                            <?php }?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Năm</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="year" id="year">
                            <?php for($i=2012; $i<=2022; $i++) { ?>
                            <option value="<?php echo $i;?>" <?php if($search["year"]==$i) echo "selected";?> ><?php echo "Năm " . $i;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </li>
                <li class="clearfix"><label><strong>Sắp xếp theo</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="order" id="order">
                            <option value="" >Mặc định</option>                            
                            <option value="1" <?php if($search["order"]==1) echo "selected";?> >Doanh thu Từ Thấp đến Cao</option>                            
                            <option value="2" <?php if($search["order"]==2) echo "selected";?> >Doanh thu Từ Cao đến Thấp</option>                            
                            <option value="3" <?php if($search["order"]==3) echo "selected";?> >Sản lượng Từ Thấp đến Cao</option>                            
                            <option value="4" <?php if($search["order"]==4) echo "selected";?> >Sản lượng Từ Cao đến Thấp</option>                            
                        </select>
                    </div>
                </li>
                <li class="clearfix">
                    <label><strong>Export từ </strong>:</label>
                    <div class="filltext clearfix">
                        <input type="text" name="start" id="start" value="<?php if($search["start"]!="") echo $search["start"];?>" style="width:100px"> 
                        <span><strong>Đến </strong>:</span>
                        <input type="text" name="end" id="end" value="<?php if($search["end"]!="") echo $search["end"];?>" style="width:100px"> 
                        (Bắt đầu từ 0)
                    </div>
                </li>
                
                <input type="hidden" id="telco" value="">
                <li class="clearfix"><label>&nbsp;</label>
                    <div class="filltext">
                        <input type="submit" value=" Tìm kiếm " class="btn-bigblue"> 
                        <input type="button" onclick="Export();" value=" Export Excel " class="btn-bigblue"> 
                    </div>
                </li>
            </ul>
        </form>
    </div>
        
    <div class="box"> 
        <input type="hidden" value="<?php echo $currentPage;?>" id="page">       
        <div class="table clearfix">
            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr class="bg-grey">
                        <td width="10%"><strong>Tên đăng nhập</strong></td>                                                                        
                        <td width="15%"><strong>Tên thành viên</strong></td>                                                
                        <td width="15%"><strong>Mobile</strong></td>                                                                        
                        <td width="10%"><strong>Card</strong></td>
                        <td width="10%"><strong>DT sau Telco</strong></td>                                                
                        <td width="10%"><strong>DT Thành viên</strong></td>
                        <td width="10%"><strong>DT KKT</strong></td>
                        <td width="10%"><strong>DT NSX</strong></td>
                        <td width="10%"><strong>Chi tiết</strong></td>
                    </tr>
                    
                    <?php
                    $total_1 = 0;
                    $total_2 = 0;
                    $total_3 = 0;
                    $total_4 = 0;                    
                    $allCard = 0; 
                    foreach($users as $row){                         
                        /* phần card từ game */
                        $total_card = 0;
                        $money_of_telco = 0;
                        $money_of_user = 0;
                        $money_of_taoviec = 0;
                        $money_of_partner = 0;
                        
                        $report_card_game = isset($reports_card_game[$row["id"]]) ? $reports_card_game[$row["id"]] : array();                                                
                        foreach($report_card_game as $rowR){
                            $total_card += $rowR["count(id)"];
                             
                            $money_of_telco += $rowR["sum(price)"] * 0.85;
                            $money_of_user += $rowR["sum(price)"] * ($rowR["percent_wapmaster"] / 100) * 0.85;                       
                            $money_of_taoviec += $rowR["sum(price)"] * ((100 - $rowR["percent_wapmaster"] - $rowR["percent_partner"]) / 100) * 0.85;                       
                            $money_of_partner += $rowR["sum(price)"] * ($rowR["percent_partner"] / 100) * 0.85;                       
                        }
                        
                        $allCard += $total_card;
                        $total_1 += $money_of_telco;                 
                        $total_2 += $money_of_user; 
                        $total_3 += $money_of_taoviec; 
                        $total_4 += $money_of_partner;
                    ?>                    
                    <tr>
                        <td><?php echo $row["username"];?></td>
                        <td><?php echo $row["full_name"];?></td>
                        <td><?php echo $row["mobile"];?></td>                                                
                        <td><span class="clred"><?php echo Common::format_price($total_card);?></span></td>
                        <td class="text-right">
                            <span class="clred">
                                <?php echo Common::format_price(round($money_of_telco));?>
                            </span>                            
                        </td>
                        
                        <td class="text-right">
                            <span class="clred">
                                <?php echo Common::format_price(round($money_of_user));?>
                            </span>                            
                        </td>
                        <td class="text-right">
                            <span class="clred">
                                <?php echo Common::format_price(round($money_of_taoviec));?>
                            </span>                            
                        </td>
                        <td class="text-right">
                            <span class="clred">
                                <?php echo Common::format_price(round($money_of_partner));?>
                            </span>                            
                        </td>
                        <td>
                            <?php 
                                $url_detail =  Url::createUrl("report/userCardDetail", array("id"=>$row["id"], "day"=>$search["day"], "month"=>$search["month"], "year"=>$search["year"]));
                            ?>
                            <a href="<?php echo $url_detail;?>">Chi tiết</a>
                        </td>                        
                    </tr>
                    <?php }?>
                    
                    <tr>
                        <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>                       
                        <td><span class="clred"><?php echo Common::format_price(round($allCard));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_1));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_2));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_3));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_4));?></span></td>                        
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div> 
        
        <?php
            if(empty($search["start"]) && empty($search["end"])){
                $url = new Url();            
                $current_url = Common::getCurrentUrl();
                $path = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
                $path = str_replace("?page=".$currentPage."&","?",$path);
                $path = str_replace("&page=".$currentPage."&","&",$path);
        ?>
        <div class="fillter clearfix">
            <div class="fr">
                <ul class="paging">
                    <?php
                        echo Paging::show_paging_cp($numberPage, $currentPage, $path);
                    ?>
                </ul>
            </div>
        </div>
        <?php } ?>       
    </div>
    
</div>