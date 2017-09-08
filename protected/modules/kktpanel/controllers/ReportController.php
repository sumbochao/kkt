<?php
class ReportController extends CpController
{
    public $output = array();
    
    public function init()
    {
        $url = new Url();
        $this->breadcrumbs[] = array('name'=>'QT thống kê','link'=>$url->createUrl("report/index"),'class'=>'');
    }
    
    
    public function actionUserSms()
    {
        $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
        $numberRecordPerPage = 30;
        
        $search = array();
        $search["username"] = isset($_GET["username"]) ? trim(strip_tags($_GET["username"])) : "";        
        $search["day"] = isset($_GET["day"]) ? intval($_GET["day"]) : "";
        $search["month"] = isset($_GET["month"]) ? intval($_GET["month"]) : date("m");
        $search["year"] = isset($_GET["year"]) ? intval($_GET["year"]) : date("Y");                        
        $search["start"] = isset($_GET["start"]) ? trim(strip_tags($_GET["start"])) : "";
        $search["end"] = isset($_GET["end"]) ? trim(strip_tags($_GET["end"])) : "";        
        $search["order"] = isset($_GET["order"]) ? trim(strip_tags($_GET["order"])) : "";        
        $search["telco"] = isset($_GET["telco"]) ? trim(strip_tags($_GET["telco"])) : "";        
        
        /* Lấy tỷ lệ ăn chia của tháng tìm kiếm */    
        $rate = ARate::getRateInMonth($search);
        
        /* Lấy danh sách user */
        $users = AReport::GetUser($search, $currentPage, $numberRecordPerPage);
        $totalUser = AReport::GetTotalUser($search);
        $numberPage = ceil($totalUser / $numberRecordPerPage);
        
        $search["list_user_id"] = "0";
        foreach($users as $row){
            $search["list_user_id"] .= ", " . $row["id"];
        }        

        /* Lấy log sms của các thành viên này */
        $reports = AReport::getReportSmsListUser($search);       

        $reports_game = AReport::getReportSmsGameListUser($search);       

        $this->render(
            "user_sms"
            , array(
                "search"=>$search
                , "users"=>$users                
                , "reports"=>$reports                
                , "reports_game"=>$reports_game                                                
                , "rate"=>$rate                
                , "currentPage"=>$currentPage                
                , "numberPage"=>$numberPage                
            )
        );   
    } 
    
    public function actionUserSmsDetail()
    {
        $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;    
        $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
        $numberRecordPerPage = 50;
                        
        $search["userId"] = isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : 0;        
        $search["day"] = isset($_GET["day"]) ? intval($_GET["day"]) : 0;
        $search["month"] = isset($_GET["month"]) ? intval($_GET["month"]) : 0;
        $search["year"] = isset($_GET["year"]) ? intval($_GET["year"]) : 0;
        $search["telco"] = isset($_GET["telco"]) ? intval($_GET["telco"]) : 0;
        
        /* Lấy tỷ lệ ăn chia của tháng tìm kiếm */    
        $rate = ARate::getRateInMonth($search);        
        
        /* Lấy log sms của các thành viên này */
        $reports = AReport::getReportSmsByUser($search, $currentPage, $numberRecordPerPage);                         
        $totalReport = AReport::getTotalReportSmsByUser($search);                 
        $numberPage = ceil($totalReport / $numberRecordPerPage);
        
        $this->render(
            "user_sms_detail"
            , array(
                "search"=>$search                
                , "reports"=>$reports                                
                , "numberPage"=>$numberPage                                
                , "currentPage"=>$currentPage                                
                , "totalReport"=>$totalReport                                                
                , "rate"=>$rate                
            )
        );
    }
    
    public function actionUserCard()
    {
        $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
        $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
        $numberRecordPerPage = 30;
        
        $search = array();
        $search["username"] = isset($_GET["username"]) ? trim(strip_tags($_GET["username"])) : "";        
        $search["day"] = isset($_GET["day"]) ? intval($_GET["day"]) : "";
        $search["month"] = isset($_GET["month"]) ? intval($_GET["month"]) : date("m");
        $search["year"] = isset($_GET["year"]) ? intval($_GET["year"]) : date("Y");                        
        $search["start"] = isset($_GET["start"]) ? trim(strip_tags($_GET["start"])) : "";
        $search["end"] = isset($_GET["end"]) ? trim(strip_tags($_GET["end"])) : "";        
        $search["order"] = isset($_GET["order"]) ? trim(strip_tags($_GET["order"])) : "";        
        
        /* Lấy danh sách user */
        $users = AReport::GetUserCard($search, $currentPage, $numberRecordPerPage);
        $totalUser = AReport::GetTotalUserCard($search);
        $numberPage = ceil($totalUser / $numberRecordPerPage);
        
        $search["list_user_id"] = "0";
        foreach($users as $row){
            $search["list_user_id"] .= ", " . $row["id"];
        }        
        
        /* Lấy log card game của các thành viên này */
        $reports_card_game = AReport::getReportCardGameListUser($search);
        
        $this->render(
            "user_card"
            , array(
                "search"=>$search
                , "users"=>$users                                
                , "reports_card_game"=>$reports_card_game                                                
                , "currentPage"=>$currentPage                
                , "numberPage"=>$numberPage                
            )
        );   
    }
    
    public function actionUserCardDetail()
    {
        $currentPage = isset($_GET["page"]) ? intval($_GET["page"]) : 1;    
        $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
        $numberRecordPerPage = 50;
                        
        $search["userId"] = isset($_GET["id"]) ? trim(strip_tags($_GET["id"])) : 0;        
        $search["month"] = isset($_GET["month"]) ? intval($_GET["month"]) : 0;
        $search["year"] = isset($_GET["year"]) ? intval($_GET["year"]) : 0;
        
        /* Lấy log card của các thành viên này */
        $reports = AReport::getReportCardByUser($search, $currentPage, $numberRecordPerPage);                 
        $totalReport = AReport::getTotalReportCardByUser($search);                 
        $numberPage = ceil($totalReport / $numberRecordPerPage);
        
        $this->render(
            "user_card_detail"
            , array(
                "search"=>$search                
                , "reports"=>$reports                                
                , "numberPage"=>$numberPage                                
                , "currentPage"=>$currentPage                                
                , "totalReport"=>$totalReport                                                
            )
        );
    }
    
    public function actionExportSms()
    {
        $this->layout = false;        
        if(isset($_POST["username"])){                    
            $currentPage = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
            $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
            $numberRecordPerPage = 30;
        
            $search = array();
            $search["username"] = trim(strip_tags($_POST["username"]));
            $search["month"] = intval(trim(strip_tags($_POST["month"])));
            $search["year"] = intval(trim(strip_tags($_POST["year"])));
            $search["start"] = trim(strip_tags($_POST["start"]));
            $search["end"] = trim(strip_tags($_POST["end"]));            
                        
            Yii::import('application.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();            
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                ),
            );        
                    
            $objPHPExcel->setActiveSheetIndex(0);        
            $objPHPExcel->getActiveSheet()->setTitle('Đối soát');
            
            /* style mặc định */
            $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);                            
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);                    
            
            /* gán dữ liệu */
            $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Bảng tổng hợp doanh thu dịch vụ trang taoviec.com');        
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'Tháng ' . $search["month"] . " Năm " .  $search["year"]);                    
            $objPHPExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);                                    
            
            
            $objPHPExcel->getActiveSheet()->setCellValue("A4", 'STT');                    
            $objPHPExcel->getActiveSheet()->setCellValue("B4", 'Tên người bán hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("C4", 'Tên đăng nhập');                    
            $objPHPExcel->getActiveSheet()->setCellValue("D4", 'Tổng doanh thu');                    
            $objPHPExcel->getActiveSheet()->setCellValue("E4", 'Doanh thu sau telco');                    
            $objPHPExcel->getActiveSheet()->setCellValue("F4", 'Doanh thu sau đầu số');                    
            $objPHPExcel->getActiveSheet()->setCellValue("G4", 'Doanh thu sau HDC');                    
            $objPHPExcel->getActiveSheet()->setCellValue("H4", 'Doanh thu sau Khách hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("I4", 'Doanh thu sau NSX');                                                    
            $objPHPExcel->getActiveSheet()->getStyle('A4:I4')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A4:I4')->getFont()->setBold(true);
            
            /* Lấy tỷ lệ telco sms trong tháng tìm kiếm */
            $rateTelco = ARate::getRateTelcoInMonth($search);
            
            /* Lấy tỷ lệ đầu số trong tháng tìm kiếm */
            $rateServiceCode = ARate::getRateServiceCodeInMonth($search);

            /* Lấy tỷ lệ ăn chia của tháng tìm kiếm */    
            $rate = ARate::getRateInMonth($search);
            
            /* Lấy danh sách user */
            $users = AReport::GetUser($search, $currentPage, $numberRecordPerPage);
            
            $search["list_user_id"] = "0";
            foreach($users as $row){
                $search["list_user_id"] .= ", " . $row["id"];
            }        
            
            /* Lấy log sms của các thành viên này */
            $reports = AReport::getReportListUser($search);
            
            /* Lấy log sms game của các thành viên này */
            $reports_sms_game = AReport::getReportSmsGameListUser($search);
            
            $i = 5;
            $total_1 = 0;
            $total_2 = 0;
            $total_3 = 0;
            $total_4 = 0;
            $total_5 = 0;
            $total_6 = 0;            
            foreach($users as $j=>$row){ 
                /* phần sms từ app */
                $total_money = 0;
                
                $total_sms = 0;
                $report = isset($reports[$row["id"]]) ? $reports[$row["id"]] : array();                        
                $money_back_of_telco = 0;
                foreach($report as $rowR){
                    $total_money += $rowR["price"] * $rowR["count(id)"];
                    $total_sms += $rowR["count(id)"];
                    $rate_telco = isset($rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]]) ? $rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]] : 0;                            
                    $money_back_of_telco += $rowR["price"] * ((100 - $rate_telco) / 100) * $rowR["count(id)"];
                }
                $rate_of_service_code = Common::buildRateServiceCode($rateServiceCode, $money_back_of_telco);
                $money_back_of_service_code = $money_back_of_telco - $money_back_of_telco * ($rate_of_service_code / 100);                        
                
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco);
                $money_of_user = $money_back_of_service_code * ($rate_user["rate_of_user"] / 100);                        
                $money_of_hdc = $money_back_of_service_code * ($rate_user["rate_of_hdc"] / 100);                        
                $money_of_producer = $money_back_of_service_code * ($rate_user["rate_of_producer"] / 100);                        
                
                /* phần sms từ game */
                $total_sms_game = 0;
                $report_sms_game = isset($reports_sms_game[$row["id"]]) ? $reports_sms_game[$row["id"]] : array();                        
                $money_back_of_telco_sms_game = 0;
                foreach($report_sms_game as $rowR){
                    $total_money += $rowR["price"] * $rowR["count(id)"];
                    $total_sms_game += $rowR["count(id)"];
                    $rate_telco = isset($rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]]) ? $rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]] : 0;                            
                    $money_back_of_telco_sms_game += $rowR["price"] * ((100 - $rate_telco) / 100) * $rowR["count(id)"];
                }
                $rate_of_service_code = Common::buildRateServiceCode($rateServiceCode, $money_back_of_telco_sms_game);
                $money_back_of_service_code_sms_game = $money_back_of_telco_sms_game - $money_back_of_telco_sms_game * ($rate_of_service_code / 100);                        
                
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco_sms_game);
                $money_of_user += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_user"] / 100);                        
                $money_of_hdc += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_hdc"] / 100);                        
                $money_of_producer += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_producer"] / 100);                                                                        
                                        
                $total_back_telco = $money_back_of_telco + $money_back_of_telco_sms_game;
                $total_back_service_code = $money_back_of_service_code + $money_back_of_service_code_sms_game;
                $total_sms = $total_sms + $total_sms_game;                        
                
                $total_back_telco = $total_back_telco / 1.1;
                $total_back_service_code = $total_back_service_code / 1.1;
                $money_of_user = $money_of_user / 1.1;
                $money_of_hdc = $money_of_hdc / 1.1;
                $money_of_producer = $money_of_producer / 1.1;
                
                /* Lấy tổng tất cả */
                $total_1 += $total_money; 
                $total_2 += $total_back_telco; 
                $total_3 += $total_back_service_code; 
                $total_4 += $money_of_user; 
                $total_5 += $money_of_hdc; 
                $total_6 += $money_of_producer; 
                     
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':I' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->setCellValue("A" . $i, $j+1);
                $objPHPExcel->getActiveSheet()->setCellValue("B" . $i, $row["full_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue("C" . $i, $row["username"]);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("D" . $i, Common::format_price(round($total_money)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("E" . $i, Common::format_price(round($total_back_telco)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("F" . $i, Common::format_price(round($total_back_service_code)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("G" . $i, Common::format_price(round($money_of_hdc)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("H" . $i, Common::format_price(round($money_of_user)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("I" . $i, Common::format_price(round($money_of_producer)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
             
                $i++;
            } 
            
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $i . ':C' . $i);        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'TỔNG');                    
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':I' . $i)->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':I' . $i)->getFont()->setBold(true);      

            $objPHPExcel->getActiveSheet()->setCellValueExplicit("D" . $i, Common::format_price(round($total_1)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("E" . $i, Common::format_price(round($total_2)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("F" . $i, Common::format_price(round($total_3)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("G" . $i, Common::format_price(round($total_4)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("H" . $i, Common::format_price(round($total_5)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("I" . $i, Common::format_price(round($total_6)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('I' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    
            $curr_dir = getcwd();         
            $curr_dir .= "/upload/report/" ;            
            $filename = "doi-soat-sms-" . date("Y-m-d_H_i_s", time()) . ".xlsx";
            $pathname = $curr_dir . $filename;
            $objWriter->save($pathname);
                     
            $link_download = Url::createUrl("report/download", array("p"=>"report/", "fn"=>$filename, "fnt"=>$filename));
            $this->output["message"] = $link_download;            
        } else {
            $this->output["status"] = false;            
        }   
        echo json_encode($this->output);                        
    }
    
    public function actionExportCard()
    {
        $this->layout = false;        
        if(isset($_POST["username"])){                    
            $currentPage = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
            $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
            $numberRecordPerPage = 30;
        
            $search = array();
            $search["username"] = trim(strip_tags($_POST["username"]));
            $search["month"] = intval(trim(strip_tags($_POST["month"])));
            $search["year"] = intval(trim(strip_tags($_POST["year"])));
            $search["start"] = trim(strip_tags($_POST["start"]));
            $search["end"] = trim(strip_tags($_POST["end"]));
                        
            Yii::import('application.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();            
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                ),
            );        
                    
            $objPHPExcel->setActiveSheetIndex(0);        
            $objPHPExcel->getActiveSheet()->setTitle('Đối soát Card');
            
            /* style mặc định */
            $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);                            
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);                                
            
            /* gán dữ liệu */
            $objPHPExcel->getActiveSheet()->mergeCells('A1:H1');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Bảng tổng hợp doanh thu dịch vụ trang taoviec.com');        
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A2:H2');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'Tháng ' . $search["month"] . " Năm " .  $search["year"]);                    
            $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($styleArray);                                    
            
            $objPHPExcel->getActiveSheet()->setCellValue("A4", 'STT');                    
            $objPHPExcel->getActiveSheet()->setCellValue("B4", 'Tên người bán hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("C4", 'Tên đăng nhập');                    
            $objPHPExcel->getActiveSheet()->setCellValue("D4", 'Tổng doanh thu');                    
            $objPHPExcel->getActiveSheet()->setCellValue("E4", 'Doanh thu sau telco');                                
            $objPHPExcel->getActiveSheet()->setCellValue("F4", 'Doanh thu sau HDC');                    
            $objPHPExcel->getActiveSheet()->setCellValue("G4", 'Doanh thu sau Khách hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("H4", 'Doanh thu sau NSX');                                                    
            $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A4:H4')->getFont()->setBold(true);
            
            /* Lấy tỷ lệ telco card trong tháng tìm kiếm */
            $rateTelcoCard = ARate::getRateTelcoCardInMonth($search);                

            /* Lấy tỷ lệ ăn chia của tháng tìm kiếm */    
            $rate = ARate::getRateInMonth($search);
            
            /* Lấy danh sách user */
            $users = AReport::GetUserCard($search, $currentPage, $numberRecordPerPage);
            
            $search["list_user_id"] = "0";
            foreach($users as $row){
                $search["list_user_id"] .= ", " . $row["id"];
            }        
            
            /* Lấy log card game của các thành viên này */
            $reports_card_game = AReport::getReportCardGameListUser($search);
            
            $i = 5;
            $total_1 = 0;
            $total_2 = 0;
            $total_3 = 0;
            $total_4 = 0;
            $total_5 = 0;
                        
            foreach($users as $j=>$row){                 
                /* phần card từ game */
                $total_money = 0;
                $total_card = 0;
                $money_of_user = 0;
                $money_of_hdc = 0;
                $money_of_producer = 0;
                $report_card_game = isset($reports_card_game[$row["id"]]) ? $reports_card_game[$row["id"]] : array();                                                
                $total_money_card_game = array();
                
                foreach($report_card_game as $rowR){
                    $total_money +=  $rowR["sum(price)"];
                    $total_card += $rowR["count(id)"];
                    
                    if(!isset($total_money_card_game[$rowR["provider_code"]])) $total_money_card_game[$rowR["provider_code"]] = 0;
                    $total_money_card_game[$rowR["provider_code"]] += $rowR["sum(price)"];
                }
                
                $money_back_of_telco_card_game = 0;
                foreach($report_card_game as $rowR){
                    $rate_telco = Common::buildRateCard($rateTelcoCard[$rowR["provider_code"]], $total_money_card_game[$rowR["provider_code"]]);
                    $money_back_of_telco_card_game += $rowR["sum(price)"] * ((100 - $rate_telco) / 100);                           
                }                        
                                         
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco_card_game);
                $money_of_user += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_user"] / 100);                        
                $money_of_hdc += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_hdc"] / 100);                        
                $money_of_producer += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_producer"] / 100);                        
                
                $total_back_telco = $money_back_of_telco_card_game / 1.1;                        
                $money_of_user = $money_of_user / 1.1;
                $money_of_hdc = $money_of_hdc / 1.1;
                $money_of_producer = $money_of_producer / 1.1;
                
                /* Lấy tổng tất cả */
                $total_1 += $total_money; 
                $total_2 += $total_back_telco;                 
                $total_3 += $money_of_user; 
                $total_4 += $money_of_hdc; 
                $total_5 += $money_of_producer; 
                     
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':H' . $i)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->setCellValue("A" . $i, $j+1);
                $objPHPExcel->getActiveSheet()->setCellValue("B" . $i, $row["full_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue("C" . $i, $row["username"]);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("D" . $i, Common::format_price(round($total_money)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("E" . $i, Common::format_price(round($total_back_telco)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("F" . $i, Common::format_price(round($money_of_hdc)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("G" . $i, Common::format_price(round($money_of_user)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("H" . $i, Common::format_price(round($money_of_producer)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
             
                $i++;
            } 
            
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $i . ':C' . $i);        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'TỔNG');                    
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':H' . $i)->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':H' . $i)->getFont()->setBold(true);      

            $objPHPExcel->getActiveSheet()->setCellValueExplicit("D" . $i, Common::format_price(round($total_1)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("E" . $i, Common::format_price(round($total_2)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                        
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("F" . $i, Common::format_price(round($total_3)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('F' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("G" . $i, Common::format_price(round($total_4)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('G' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("H" . $i, Common::format_price(round($total_5)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('H' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    
            $curr_dir = getcwd();         
            $curr_dir .= "/upload/report/" ;            
            $filename = "doi-soat-card-" . date("Y-m-d_H_i_s", time()) . ".xlsx";
            $pathname = $curr_dir . $filename;
            $objWriter->save($pathname);
                     
            $link_download = Url::createUrl("report/download", array("p"=>"report/", "fn"=>$filename, "fnt"=>$filename));
            $this->output["message"] = $link_download;            
        } else {
            $this->output["status"] = false;            
        }   
        echo json_encode($this->output);                        
    }
    
    public function actionExport()
    {
        $this->layout = false;        
        if(isset($_POST["username"])){                    
            $currentPage = !empty($_POST["page"]) ? intval($_POST["page"]) : 1;
            $currentPage = $currentPage==0 ? $currentPage=1 : $currentPage;
            $numberRecordPerPage = 30;
        
            $search = array();
            $search["username"] = trim(strip_tags($_POST["username"]));
            $search["day"] = intval(trim(strip_tags($_POST["day"])));
            $search["month"] = intval(trim(strip_tags($_POST["month"])));
            $search["year"] = intval(trim(strip_tags($_POST["year"])));
            $search["start"] = trim(strip_tags($_POST["start"]));
            $search["end"] = trim(strip_tags($_POST["end"]));            
            $search["telco"] = trim(strip_tags($_POST["telco"]));            
            $search["order"] = trim(strip_tags($_POST["order"]));            
                        
            Yii::import('application.vendors.PHPExcel',true);
            $objPHPExcel = new PHPExcel();            
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ),
                ),
            );        
                    
            $objPHPExcel->setActiveSheetIndex(0);        
            $objPHPExcel->getActiveSheet()->setTitle('Đối soát');
            
            /* style mặc định */
            $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);        
            $objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);                            
            
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);        
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);                    
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);                    
            
            /* gán dữ liệu */
            $objPHPExcel->getActiveSheet()->mergeCells('A1:Q1');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Bảng tổng hợp doanh thu dịch vụ trang taoviec.com');        
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getFont()->setBold(true);
            
            $objPHPExcel->getActiveSheet()->mergeCells('A2:Q2');        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'Tháng ' . $search["month"] . " Năm " .  $search["year"]);                    
            $objPHPExcel->getActiveSheet()->getStyle('A2:Q2')->applyFromArray($styleArray);                                    
            
            
            $objPHPExcel->getActiveSheet()->setCellValue("A4", 'STT');                    
            $objPHPExcel->getActiveSheet()->setCellValue("B4", 'Tên người bán hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("C4", 'Ngày sinh');                    
            $objPHPExcel->getActiveSheet()->setCellValue("D4", 'Số Điện Thoại');                    
            $objPHPExcel->getActiveSheet()->setCellValue("E4", 'Số CMT');                    
            $objPHPExcel->getActiveSheet()->setCellValue("F4", 'Ngày cấp CMT');                    
            $objPHPExcel->getActiveSheet()->setCellValue("G4", 'Nơi cấp');                    
            $objPHPExcel->getActiveSheet()->setCellValue("H4", 'Địa chỉ thường chú');                    
            $objPHPExcel->getActiveSheet()->setCellValue("I4", 'Số tài khoản');                    
            $objPHPExcel->getActiveSheet()->setCellValue("J4", 'Tại ngân hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("K4", 'Tên đăng nhập');                    
            $objPHPExcel->getActiveSheet()->setCellValue("L4", 'Tổng doanh thu');                    
            $objPHPExcel->getActiveSheet()->setCellValue("M4", 'Doanh thu sau telco');                    
            $objPHPExcel->getActiveSheet()->setCellValue("N4", 'Doanh thu sau đầu số');                    
            $objPHPExcel->getActiveSheet()->setCellValue("O4", 'Doanh thu sau HDC');                    
            $objPHPExcel->getActiveSheet()->setCellValue("P4", 'Doanh thu sau Khách hàng');                    
            $objPHPExcel->getActiveSheet()->setCellValue("Q4", 'Doanh thu sau NSX');                                                    
            $objPHPExcel->getActiveSheet()->getStyle('A4:Q4')->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle('A4:Q4')->getFont()->setBold(true);
            
            /* Lấy tỷ lệ telco sms trong tháng tìm kiếm */
            $rateTelco = ARate::getRateTelcoInMonth($search);
            
            /* Lấy tỷ lệ telco card trong tháng tìm kiếm */
            $rateTelcoCard = ARate::getRateTelcoCardInMonth($search);
            
            /* Lấy tỷ lệ đầu số trong tháng tìm kiếm */
            $rateServiceCode = ARate::getRateServiceCodeInMonth($search);

            /* Lấy tỷ lệ ăn chia của tháng tìm kiếm */    
            $rate = ARate::getRateInMonth($search);
            
            /* Lấy danh sách user */
            $users = AReport::GetUserExport($search, $currentPage, $numberRecordPerPage);
            
            $search["list_user_id"] = "0";
            foreach($users as $row){
                $search["list_user_id"] .= ", " . $row["id"];
            }        
            
            /* Lấy log sms của các thành viên này */
            $reports = AReport::getReportListUser($search);
            
            /* Lấy log sms game của các thành viên này */
            $reports_sms_game = AReport::getReportSmsGameListUser($search);
            
            /* Lấy log card game của các thành viên này */
            $reports_card_game = AReport::getReportCardGameListUser($search);
            
            $i = 5;
            $total_1 = 0;
            $total_2 = 0;
            $total_3 = 0;
            $total_4 = 0;
            $total_5 = 0;
            $total_6 = 0;            
            foreach($users as $j=>$row){ 
                /* phần sms từ app */
                $total_money = 0;
                
                $total_sms = 0;
                $report = isset($reports[$row["id"]]) ? $reports[$row["id"]] : array();                        
                $money_back_of_telco = 0;
                foreach($report as $rowR){
                    $total_money += $rowR["price"] * $rowR["count(id)"];
                    $total_sms += $rowR["count(id)"];
                    $rate_telco = isset($rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]]) ? $rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]] : 0;                            
                    $money_back_of_telco += $rowR["price"] * ((100 - $rate_telco) / 100) * $rowR["count(id)"];
                }
                $rate_of_service_code = Common::buildRateServiceCode($rateServiceCode, $money_back_of_telco);
                $money_back_of_service_code = $money_back_of_telco - $money_back_of_telco * ($rate_of_service_code / 100);                        
                
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco);
                $money_of_user = $money_back_of_service_code * ($rate_user["rate_of_user"] / 100);                        
                $money_of_hdc = $money_back_of_service_code * ($rate_user["rate_of_hdc"] / 100);                        
                $money_of_producer = $money_back_of_service_code * ($rate_user["rate_of_producer"] / 100);                        
                
                /* phần sms từ game */
                $total_sms_game = 0;
                $report_sms_game = isset($reports_sms_game[$row["id"]]) ? $reports_sms_game[$row["id"]] : array();                        
                $money_back_of_telco_sms_game = 0;
                foreach($report_sms_game as $rowR){
                    $total_money += $rowR["price"] * $rowR["count(id)"];
                    $total_sms_game += $rowR["count(id)"];
                    $rate_telco = isset($rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]]) ? $rateTelco[$rowR["telco"] . "_" . $rowR["serviceCode"]] : 0;                            
                    $money_back_of_telco_sms_game += $rowR["price"] * ((100 - $rate_telco) / 100) * $rowR["count(id)"];
                }
                $rate_of_service_code = Common::buildRateServiceCode($rateServiceCode, $money_back_of_telco_sms_game);
                $money_back_of_service_code_sms_game = $money_back_of_telco_sms_game - $money_back_of_telco_sms_game * ($rate_of_service_code / 100);                        
                
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco_sms_game);
                $money_of_user += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_user"] / 100);                        
                $money_of_hdc += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_hdc"] / 100);                        
                $money_of_producer += $money_back_of_service_code_sms_game * ($rate_user["issue_rate_of_producer"] / 100);                                                                        
                                        
                $total_back_telco = $money_back_of_telco + $money_back_of_telco_sms_game;
                $total_back_service_code = $money_back_of_service_code + $money_back_of_service_code_sms_game;
                $total_sms = $total_sms + $total_sms_game;                        
                
                /* phần card từ game */                
                $total_card = 0;                
                $report_card_game = isset($reports_card_game[$row["id"]]) ? $reports_card_game[$row["id"]] : array();                                                
                $total_money_card_game = array();
                
                foreach($report_card_game as $rowR){
                    $total_money +=  $rowR["sum(price)"];
                    $total_card += $rowR["count(id)"];
                    
                    if(!isset($total_money_card_game[$rowR["provider_code"]])) $total_money_card_game[$rowR["provider_code"]] = 0;
                    $total_money_card_game[$rowR["provider_code"]] += $rowR["sum(price)"];
                }
                
                $money_back_of_telco_card_game = 0;
                foreach($report_card_game as $rowR){
                    $rate_telco = Common::buildRateCard($rateTelcoCard[$rowR["provider_code"]], $total_money_card_game[$rowR["provider_code"]]);
                    $money_back_of_telco_card_game += $rowR["sum(price)"] * ((100 - $rate_telco) / 100);                           
                }                        
                                         
                $rate_user = Common::buildRateUser($rate, $money_back_of_telco_card_game);
                $total_back_telco += $money_back_of_telco_card_game;
                $money_of_user += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_user"] / 100);                        
                $money_of_hdc += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_hdc"] / 100);                        
                $money_of_producer += $money_back_of_telco_card_game * ($rate_user["issue_rate_of_producer"] / 100);                        
                
                /*
                $total_back_telco = $total_back_telco / 1.1;
                $total_back_service_code = $total_back_service_code / 1.1;
                $money_of_user = $money_of_user / 1.1;
                $money_of_hdc = $money_of_hdc / 1.1;
                $money_of_producer = $money_of_producer / 1.1;
                */
                
                /* Lấy tổng tất cả */
                $total_1 += $total_money; 
                $total_2 += $total_back_telco; 
                $total_3 += $total_back_service_code; 
                $total_4 += $money_of_user; 
                $total_5 += $money_of_hdc; 
                $total_6 += $money_of_producer; 
                
                $bithday = !empty($row["birthday"]) ? date("d/m/Y", $row["birthday"]) : "";
                $date_of_identity = !empty($row["date_of_identity"]) ? date("d/m/Y", $row["date_of_identity"]) : "";
                
                $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':Q' . $i)->applyFromArray($styleArray);
                
                $objPHPExcel->getActiveSheet()->setCellValue("A" . $i, $j+1);
                $objPHPExcel->getActiveSheet()->setCellValue("B" . $i, $row["full_name"]);
                $objPHPExcel->getActiveSheet()->setCellValue("C" . $i, $bithday);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("D" . $i, $row["mobile"], PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("E" . $i, $row["identity_number"], PHPExcel_Cell_DataType::TYPE_STRING);                
                $objPHPExcel->getActiveSheet()->setCellValue("F" . $i, $date_of_identity);
                $objPHPExcel->getActiveSheet()->setCellValue("G" . $i, $row["which_of_identity"]);
                $objPHPExcel->getActiveSheet()->setCellValue("H" . $i, $row["permanent_address"]);
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("I" . $i, $row["account_number"], PHPExcel_Cell_DataType::TYPE_STRING);                
                $objPHPExcel->getActiveSheet()->setCellValue("J" . $i, $row["account_bank"]);
                $objPHPExcel->getActiveSheet()->setCellValue("K" . $i, $row["username"]);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("L" . $i, Common::format_price(round($total_money)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("M" . $i, Common::format_price(round($total_back_telco)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("N" . $i, Common::format_price(round($total_back_service_code)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("O" . $i, Common::format_price(round($money_of_hdc)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('O' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("P" . $i, Common::format_price(round($money_of_user)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('P' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
                
                $objPHPExcel->getActiveSheet()->setCellValueExplicit("Q" . $i, Common::format_price(round($money_of_producer)), PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle('Q' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
             
                $i++;
            } 
            
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $i . ':K' . $i);        
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'TỔNG');                    
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':Q' . $i)->applyFromArray($styleArray);                        
            $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':Q' . $i)->getFont()->setBold(true);      

            $objPHPExcel->getActiveSheet()->setCellValueExplicit("L" . $i, Common::format_price(round($total_1)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('L' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("M" . $i, Common::format_price(round($total_2)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('M' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("N" . $i, Common::format_price(round($total_3)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('N' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("O" . $i, Common::format_price(round($total_4)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('O' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("P" . $i, Common::format_price(round($total_5)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('P' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objPHPExcel->getActiveSheet()->setCellValueExplicit("Q" . $i, Common::format_price(round($total_6)), PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('Q' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);            
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    
            $curr_dir = getcwd();         
            $curr_dir .= "/upload/report/" ;            
            $filename = "doi-soat-" . date("Y-m-d_H_i_s", time()) . ".xlsx";
            $pathname = $curr_dir . $filename;
            $objWriter->save($pathname);
                     
            $link_download = Url::createUrl("report/download", array("p"=>"report/", "fn"=>$filename, "fnt"=>$filename));
            $this->output["message"] = $link_download;            
        } else {
            $this->output["status"] = false;            
        }   
        echo json_encode($this->output);                        
    }
    
    public function actionDownload()
    { 
        $this->layout = false;               
        $dir_path = getcwd()."/upload/";                
         
        //lấy tên file cần download từ URL
        $fileNameTrue = isset($_GET['fnt']) ? $_GET['fnt']:'';
        $fileName = isset($_GET['fn']) ? $_GET['fn']:'';
        $filePath = isset($_GET['p']) ? $_GET['p']:'';
        $upload_dir = $dir_path.$filePath;
        
        //thực hiện quá trình kiểm tra
        if (!is_file($upload_dir.$fileName) || !is_readable($upload_dir.$fileName) ) 
        {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo "Tên file không hợp lệ hoặc file ko tồn tại";
            exit(-1);
        }
         
        //mở file để đọc với chế độ nhị phân (binary)
        $fp = fopen($upload_dir.$fileName, "rb");
         
        //gởi header đến cho browser
        header('Content-type: application/octet-stream');
        header('Content-disposition: attachment; filename="'.$fileNameTrue.'"');
        header('Content-length: ' . filesize($upload_dir.$fileName));
         
        //đọc file và trả dữ liệu về cho browser
        fpassthru($fp);
        fclose($fp);
    }    
}
