<?php   

    $connect = @mysql_connect('localhost', 'asm_user', 'asm_password@2012');
    if (!$connect) die('Could not connect: ' . mysql_error());    
    @mysql_select_db('ttv_asm', $connect);
    @mysql_query("SET NAMES 'utf8'");          
    
    function baseUrl(){
        return "http://kenhkiemtien.com/";
    }
?>