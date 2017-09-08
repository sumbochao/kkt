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
                <li class="clearfix"><label><strong>Telco</strong>:</label>
                    <div class="filltext">
                        <select style="width:203px;" name="telco" id="telco">
                            <option value="">-- Tất cả --</option>                            
                            <option value="1" <?php if($search["telco"]=="1") echo "selected";?> >Viettel</option>                            
                            <option value="2" <?php if($search["telco"]=="2") echo "selected";?> >Mobifone</option>                            
                            <option value="3" <?php if($search["telco"]=="3") echo "selected";?> >Vinaphone</option>                            
                            <option value="4" <?php if($search["telco"]=="4") echo "selected";?> >Vietnammobile</option>                            
                            <option value="5" <?php if($search["telco"]=="5") echo "selected";?> >Beeline</option>                            
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
                        <td width="10%"><strong>Tên thành viên</strong></td>                                                
                        <td width="10%"><strong>Mobile</strong></td>                                                                        
                        <td width="5%"><strong>SMS</strong></td>                        
                        <td width="5%"><strong>SMS 5000</strong></td>                        
                        <td width="5%"><strong>SMS 10000</strong></td>                        
                        <td width="5%"><strong>SMS 15000</strong></td>                        
                        <td width="8%"><strong>DT sau Telco</strong></td>                        
                        <td width="8%"><strong>DT sau Đầu số</strong></td>
                        <td width="10%"><strong>DT Thành viên + DT Giới thiệu</strong></td>
                        <td width="8%"><strong>DT KKT</strong></td>
                        <td width="8%"><strong>DT NSX</strong></td>
                        <td width="6%"><strong>Chi tiết</strong></td>
                    </tr>

                    <?php
                        $total_1 = 0;
                        $total_2 = 0;
                        $total_3 = 0;
                        $total_4 = 0;
                        $total_5 = 0;                    
                        $total_6 = 0;                    
                        $allSms = 0;
                        $allSms_5 = 0;
                        $allSms_10 = 0;
                        $allSms_15 = 0;

                        foreach($users as $row){ 
                            /* phần sms từ app */
                            $total_sms = 0;
                            $total_sms_5 = 0;
                            $total_sms_10 = 0;
                            $total_sms_15 = 0;
                            $report = isset($reports[$row["id"]]) ? $reports[$row["id"]] : array();                        
                            $money_back_of_telco = 0;                        
                            $money_back_of_service_code = 0;                        
                            $total_of_telco = 0;                        
                            $total_of_service_code = 0;                        
                            $total_of_user = 0;                        
                            $total_of_hdc = 0;                        
                            $total_of_partner = 0;                        
                            foreach($report as $rowR){  
                                $total_sms += $rowR["count(id)"];
                                $total_sms_5 += $rowR["price"]=="5000" ? $rowR["count(id)"] : 0;
                                $total_sms_10 += $rowR["price"]=="10000" ? $rowR["count(id)"] : 0;
                                $total_sms_15 += $rowR["price"]=="15000" ? $rowR["count(id)"] : 0;

                                $money_back_of_telco += $rowR["price"] * $rowR["count(id)"] * 0.45;                                                       
                            }                       
                            $money_back_of_service_code = $money_back_of_telco * 0.8;

                            $total_of_telco += $money_back_of_telco;                        
                            $total_of_service_code += $money_back_of_service_code;                        
                            $total_of_user += $money_back_of_service_code * ($rate["rate_of_user"] / 100);                        
                            $total_of_hdc += $money_back_of_service_code * ($rate["rate_of_taoviec"] / 100);                                                                        

                            $money_of_telco = 0;
                            $money_of_service_code = 0;
                            $report = isset($reports_game[$row["id"]]) ? $reports_game[$row["id"]] : array();
                            foreach($report as $rowR){
                                $total_sms += $rowR["count(id)"];
                                $total_sms_5 += $rowR["price"]=="5000" ? $rowR["count(id)"] : 0;
                                $total_sms_10 += $rowR["price"]=="10000" ? $rowR["count(id)"] : 0;
                                $total_sms_15 += $rowR["price"]=="15000" ? $rowR["count(id)"] : 0;

                                $money_of_telco = $rowR["count(id)"] * $rowR["price"] * 0.45;
                                $money_of_service_code = $money_of_telco * 0.8;

                                $total_of_telco += $money_of_telco;                        
                                $total_of_service_code += $money_of_service_code;
                                $total_of_user += $money_of_service_code * ($rowR["percent_wapmaster"] / 100);                        
                                $total_of_hdc += $money_of_service_code * ((100 - $rowR["percent_wapmaster"]) / 100);                                                                        
                                $total_of_partner += 0;                                                                                                    
                            }

                            /* Lấy tổng tất cả */
                            $allSms += $total_sms;                        
                            $allSms_5 += $total_sms_5;                        
                            $allSms_10 += $total_sms_10;                        
                            $allSms_15 += $total_sms_15;                        
                            $total_1 += $total_of_telco; 
                            $total_2 += $total_of_service_code; 
                            $total_3 += $total_of_user; 
                            $total_4 += $total_of_hdc; 
                            $total_5 += $total_of_partner;
                            $data_refUID = AMember::getAllUserByrefUID($row["id"]);
                            $total_of_user_ref = 0;

                            foreach($data_refUID as $refUID){
                                $total_of_user_refUID = 0;
                                $money_back_of_telco_refUID = 0;
                                $report_refUID = isset($reports[$refUID]) ? $reports[$refUID] : array();
                                foreach($report_refUID as $rowR_refUID){
                                    $money_back_of_telco_refUID += $rowR_refUID["price"] * $rowR_refUID["count(id)"] * 0.45;                                                       
                                }                        
                                $money_back_of_service_code_refUID = $money_back_of_telco_refUID * 0.8;

                                $total_of_user_refUID += $money_back_of_service_code_refUID * ($rate["rate_of_user"] / 100);                        
                                $money_of_telco_refUID = 0;
                                $money_of_service_code_refUID = 0;
                                $report_refUID = isset($reports_game[$refUID]) ? $reports_game[$refUID] : array();  
                                foreach($report_refUID as $rowR_refUID){

                                    $money_of_telco_refUID = $rowR_refUID["count(id)"] * $rowR_refUID["price"] * 0.45;
                                    $money_of_service_code_refUID = $money_of_telco_refUID * 0.8;
                                    $total_of_user_refUID += $money_of_service_code_refUID * ($rowR_refUID["percent_wapmaster"]/100);                                                                                                                           
                                }
                                $total_of_user_ref +=  $total_of_user_refUID;
                            }
                            $total_of_user_ref = $total_of_user_ref * (5/100);
                            $total_6 += $total_of_user_ref;
                        ?>                    
                        <tr>
                            <td><?php echo $row["username"];?></td>
                            <td><?php echo $row["full_name"];?></td>
                            <td><?php echo $row["mobile"];?></td>                        
                            <td><span class="clred"><?php echo Common::format_price($total_sms);?></span></td>                        
                            <td><span class="clred"><?php echo Common::format_price($total_sms_5);?></span></td>                        
                            <td><span class="clred"><?php echo Common::format_price($total_sms_10);?></span></td>                        
                            <td><span class="clred"><?php echo Common::format_price($total_sms_15);?></span></td>                        
                            <td class="text-right">
                                <span class="clred">
                                    <?php echo Common::format_price(round($total_of_telco));?>
                                </span>                            
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                    <?php echo Common::format_price(round($total_of_service_code));?>
                                </span>                            
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                    <?php echo Common::format_price(round($total_of_user));?> +
                                    <?php echo Common::format_price(round($total_of_user_ref));?> =
                                    <?php echo Common::format_price(round($total_of_user) + round($total_of_user_ref));?>
                                </span>                            
                            </td>         
                            <td class="text-right">
                                <span class="clred">
                                    <?php echo Common::format_price(round($total_of_hdc));?>
                                </span>                            
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                    <?php echo Common::format_price(round($total_of_partner));?>
                                </span>                            
                            </td>
                            <td>
                                <?php 
                                    $url_detail =  Url::createUrl("report/userSmsDetail", array("id"=>$row["id"], "day"=>$search["day"], "month"=>$search["month"], "year"=>$search["year"], "telco"=>$search["telco"]));
                                ?>
                                <a href="<?php echo $url_detail;?>">Chi tiết</a>
                            </td>                        
                        </tr>
                        <?php }?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>                       
                        <td><span class="clred"><?php echo Common::format_price($allSms);?></span></td>                        
                        <td><span class="clred"><?php echo Common::format_price($allSms_5);?></span></td>                        
                        <td><span class="clred"><?php echo Common::format_price($allSms_10);?></span></td>                        
                        <td><span class="clred"><?php echo Common::format_price($allSms_15);?></span></td>                        
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_1));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_2));?></span></td>
                        <td class="text-right">
                        <span class="clred">
                        <?php echo Common::format_price(round($total_3));?> +
                        <?php echo Common::format_price(round($total_6));?> = 
                        <?php echo Common::format_price(round($total_6) + round($total_3));?>
                        </span>
                        </td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_4));?></span></td>
                        <td class="text-right"><span class="clred"><?php echo Common::format_price(round($total_5));?></span></td>                        
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
