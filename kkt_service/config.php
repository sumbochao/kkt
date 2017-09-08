<?php   
    $connect = @mysql_connect('127.0.0.1', 'uvtc_kkt2012', 'pvtc_@)!@kkt');
    if (!$connect) die('Could not connect: ' . mysql_error());    
    @mysql_select_db('vtc_kenhkiemtien', $connect);
    @mysql_query("SET NAMES 'utf8'");          
    
    function baseUrl(){
        return "http://kenhkiemtien.com/";
    }
?>
