<div class="container">
    <div class="main clearfix">
        <!-- box top user -->
        <?php $this->widget("BoxTopUser");?>
        <!-- end box top user -->
        
        <div class="bg_green nobor pad10">
            <div class="tab-static">
                <ul class="list_style clearfix">
                    <li class="fl"><strong class="clwhite s14">Doanh thu tổng hợp</strong></li>
                </ul>
            </div>

        </div>
        <div class="box tablestatc pad10">
            <div class="seach-yea mag_btt_t5 clearfix">
                <form action="" method="GET">
                    <ul class="list_style">
                        <li class="clearfix">
                            <label class="fl">Tìm theo Năm: </label>
                            <div class="fl mag0 clearfix">                                
                                <input type="text" class="fl" name="year" value="<?php if(isset($_GET["year"])) echo $year;?>">
                                <input type="submit" class="bt_orage fl" value="Tìm kiếm">
                            </div>
                        </li>
                    </ul>
                </form>    
            </div>
            
            <div class="table">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <tr>
                            <th width="9%">Tháng</th>
                            <th width="8%">Sản lượng SMS</th>
                            <th width="8%">Sản lượng Card</th>
                            <th width="15%" class="text_r">DT Sau Telco</th>
                            <th width="15%" class="text_r">DT Sau Đầu số</th>
                            <th width="15%" class="text_r">DT của Tôi</th>
                            <th width="15%" class="text_r">DT CKT</th>
                            <th width="15%" class="text_r">DT NSX</th>
                        </tr>
                        <?php
                        $total_sms = 0;                                                
                        $total_card = 0;                                                
                        $total_back_telco = 0;                                                
                        $total_back_service_code = 0;                                                
                        $total_of_user = 0;                                                
                        $total_of_hdc = 0;                                                
                        $total_of_producer = 0;                                                
                        foreach($report as $month=>$row) {
                            $total_sms += $row["total_sms"];    
                            $total_card += $row["total_card"];    
                            $total_back_telco += $row["money_back_telco"];    
                            $total_back_service_code += $row["money_back_service_code"];    
                            $total_of_user += $row["money_of_user"];    
                            $total_of_hdc += $row["money_of_hdc"];    
                            $total_of_producer += $row["money_of_producer"];    
                        ?>
                            <tr>
                                <td><?php echo "Tháng " . $month . "/" . $year;?></td>
                                <td class="clorage"><?php echo Common::format_price($row["total_sms"]);?></td>
                                <td class="clorage"><?php echo Common::format_price($row["total_card"]);?></td>
                                <td class="clorage text_r"><?php echo Common::format_price($row["money_back_telco"]);?></td>
                                <td class="clorage text_r"><?php echo Common::format_price($row["money_back_service_code"]);?></td>
                                <td class="clorage text_r"><?php echo Common::format_price($row["money_of_user"]);?></td>
                                <td class="clorage text_r"><?php echo Common::format_price($row["money_of_hdc"]);?></td>
                                <td class="clorage text_r bor_r"><?php echo Common::format_price($row["money_of_producer"]);?></td>                                
                            </tr>
                        <?php 
                        }
                        ?>
                        <tr>
                            <td class="text_r"><strong>Tổng</strong></td>
                            <td class="clorage"><strong><?php echo Common::format_price($total_sms);?></strong></td>                            
                            <td class="clorage"><strong><?php echo Common::format_price($total_card);?></strong></td>                                                        
                            <td class="clorage text_r"><strong><?php echo Common::format_price($total_back_telco);?></strong></td>                            
                            <td class="clorage text_r"><strong><?php echo Common::format_price($total_back_service_code);?></strong></td>                            
                            <td class="clorage text_r"><strong><?php echo Common::format_price($total_of_user);?></strong></td>                            
                            <td class="clorage text_r"><strong><?php echo Common::format_price($total_of_hdc);?></strong></td>                            
                            <td class="clorage text_r bor_r"><strong><?php echo Common::format_price($total_of_producer);?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>

        <?php if(!empty($myAdv)) { ?>
        <div class="clip_vewing bottom10">
            <h2 class="bg_green"><strong>Quảng cáo của tôi</strong></h2>
            <div class="table list_table">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <?php foreach($myAdv as $row): ?>
                        <tr>
                            <td width="52">
                                <a title="pic" href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>">
                                    <img class="img52" src="<?php echo Common::getImage($row["picture"], "user/" . $row["username"] ."/picture", $row["create_date"], "");?>" />
                                </a>
                            </td>
                            <td class="item_data" valign="top">
                                <a href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>" class="ic_video">
                                    <strong><?php echo $row["title"];?></strong>
                                </a><br />
                                <span class="cl999"><?php echo Common::format_price($row["download"]);?> lượt tải</span><br />
                                <a class="sal_now clorage" href="<?php echo Url::createUrl("kktUser/myAdvDetail", array("id"=>$row["id"]));?>">Bán ngay</a>
                            </td>
                        </tr>
                        <?php endforeach;?>                        
                    </tbody>
                </table>
                <!--<div class="pages pad10">
                    <a href="#">« Trước</a>&nbsp;|&nbsp;<span>Trang 1 trong 769</span>&nbsp;|&nbsp;<a href="#">Sau »</a>
                </div>-->
            </div>
        </div>
        <?php } ?>
    </div>
</div> 