<?php
   require_once("config.php");  
   
    // Get SMS Kute description 
    function getSMSKuteByID($content_id)
    {   
        $sql ="SELECT description FROM  c_smskute 
         WHERE id = ".$content_id;
        //echo $sql."<br>";
        $result = @mysql_query($sql);    
        //var_dump($result);die;
        $arrs  = @mysql_fetch_assoc($result);

        //var_dump($arrs);
        mysql_free_result($result);
        if(empty($arrs))   $arrs =array ("description"=>"Hình Kute này không tồn tại. Bạn vui lòng kiểm tra lại.");  
        return $arrs;
    }  
?>
