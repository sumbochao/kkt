<div id="container">
    <div class="main clearfix">
        <div class="box">
            <div class="tab-static clearfix">
                <div class="fl">Tìm thấy <?php echo $totalReport;?> sms trong <?php echo $numberPage;?> Trang</div>
                <!--<span class="back fr"><a class="clorange" href="#"><strong>Quay trở lại</strong></a></span>            -->
                <div class="fr">
                    <ul class="paging">
                        <?php
                            $current_url = Common::getCurrentUrl();
                            $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
                            $path_paging = str_replace("?page=".$currentPage."&","?",$path_paging);
                            $path_paging = str_replace("&page=".$currentPage."&","&",$path_paging);
                                
                            echo Paging::show_paging_cp($numberPage, $currentPage, $path_paging);
                        ?>
                    </ul>
                </div>
            </div>
            <div class="table clearfix">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr class="bg-grey">
                            <td width="20%"><strong>Cú pháp</strong></td>
                            <td width="10%"><strong>Đầu số</strong></td>                            
                            <td width="10%"><strong>SĐT</strong></td>
                            <td width="10%"><strong>Loại</strong></td>
                            <td width="8%"><strong>DT sau Telco</strong></td>
                            <td width="8%"><strong>DT sau đầu số</strong></td>
                            <td width="8%"><strong>DT Khách hàng</strong></td>
                            <td width="8%"><strong>DT KKT</strong></td>
                            <td width="8%"><strong>DT NSX</strong></td>
                            <td width="10%"><strong>Ngày nhắn tin</strong></td>
                        </tr>
                        <?php foreach($reports as $row){ ?>
                        <tr>
                            <td><?php echo $row["content"];?></td>
                            <td><span class="clred"><?php echo $row["serviceCode"];?></span></td>
                            <td><span class="clred"><?php echo $row["sender"];?></span></td>
                            <td>
                                <?php 
                                    if($row["type"]==1) echo "Game";
                                    else if($row["type"]==2) echo "Video";
                                    else if($row["type"]==3) echo "Image";
                                ?>
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                <?php                                    
                                    $money_back_of_telco = $row["price"] * 0.45;
                                    echo Common::format_price(round($money_back_of_telco));
                                ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                <?php 
                                    $money_back_of_service_code = $money_back_of_telco * 0.85;
                                    echo Common::format_price(round($money_back_of_service_code));
                                ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                <?php                                     
                                    if(trim($row["type"])=="1"){
                                        /* game */
                                        $money_of_user = $money_back_of_service_code * ($row["percent_wapmaster"] / 100);
                                        $money_of_partner = $money_back_of_service_code * ($row["percent_partner"] / 100);
                                        $money_of_taoviec = $money_back_of_service_code - $money_of_user - $money_of_partner;
                                        
                                    } else {
                                        $money_of_user = $money_back_of_service_code * ((100 - $rate["rate_of_user"]) / 100);
                                        $money_of_taoviec = $money_back_of_service_code * ((100 - $rate["rate_of_taoviec"]) / 100);
                                        $money_of_partner = 0;
                                    }
                               
                                    echo Common::format_price(round($money_of_user));
                                ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                <?php                                    
                                    echo Common::format_price(round($money_of_taoviec));
                                ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <span class="clred">
                                <?php                                 
                                    echo Common::format_price(round($money_of_partner));
                                ?>
                                </span>
                            </td>
                            <td><?php echo date("d/m/Y H:i:s", $row["create_date"]);?></td>
                        </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
            </div>
            <!--<div class="box clearfix"> 
                <span class="back fr">
                <a class="clorange" href="#">
                <strong>Quay trở lại</strong>
                </a></span>
            </div>-->
            <div class="fillter clearfix">
                <div class="fr">
                    <ul class="paging">
                        <?php
                            $current_url = Common::getCurrentUrl();
                            $path_paging = strpos($current_url,'?') !==false ? $current_url.'&' : $current_url.'?';
                            $path_paging = str_replace("?page=".$currentPage."&","?",$path_paging);
                            $path_paging = str_replace("&page=".$currentPage."&","&",$path_paging);
                                
                            echo Paging::show_paging_cp($numberPage, $currentPage, $path_paging);
                        ?>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>