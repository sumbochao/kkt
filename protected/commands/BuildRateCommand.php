<?php
class BuildRateCommand extends CConsoleCommand
{
    public function run($args)
    {
        $month = date("m");
        $year = date("Y");
        if($month==12){
            $next_month = 1;
            $next_year = $year + 1;
        } else {
            $next_month = $month + 1;
            $next_year = $year;
        }
        
        /* Build rate */    
        $result = Rate::buildRate($month, $year, $next_month, $next_year);
        if($result >= 0){
            echo "Build rate Success Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else if($result == -1) {
            echo "Da ton tai rate, Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else {
            echo "Build rate Fail Cron Job At ".date("H:i:s - d/m/Y")." \n";
        }
        
        /* Build rate sms */    
        $result = Rate::buildRateSms($month, $year, $next_month, $next_year);
        if($result >= 0){
            echo "Build rate sms Success Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else if($result == -1) {
            echo "Da ton tai rate sms, Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else {
            echo "Build rate sms Fail Cron Job At ".date("H:i:s - d/m/Y")." \n";
        }
        
        /* Build rate card */    
        $result = Rate::buildRateCard($month, $year, $next_month, $next_year);
        if($result >= 0){
            echo "Build rate card Success Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else if($result == -1) {
            echo "Da ton tai rate card, Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else {
            echo "Build rate card Fail Cron Job At ".date("H:i:s - d/m/Y")." \n";
        }
        
        /* Build rate service code */
        $result = Rate::buildRateService($month, $year, $next_month, $next_year);
        if($result >= 0){
            echo "Build rate Service Success Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else if($result == -1) {
            echo "Da ton tai rate Service, Cron Job At ".date("H:i:s - d/m/Y")." \n";
        } else {
            echo "Build rate Service Fail Cron Job At ".date("H:i:s - d/m/Y")." \n";
        }
    }
}
?>