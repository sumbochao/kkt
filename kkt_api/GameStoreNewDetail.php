<?php
    header('Content-type: text/html; charset=utf-8');       
    require_once("GameStoreDAO.php");
    require_once("function/utils.php");
    
    $id = isset($_GET['id']) ?$_GET['id'] :"0" ;
    $id  = intval($id);
 ?>
 <html>
 <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <style>
        blockquote {display: block;-webkit-margin-before: 1em;-webkit-margin-after: 1em;-webkit-margin-start: 5px;-webkit-margin-end: 5px;}
        .images{width:100% !important;height:auto;display:block;}
        img{width:100% !important;height:auto;display:block;}
    </style>
    </head><body>
    <blockquote>
       
<?php    
    $output = getNewsDetailContent($id);
    if(!empty($output)){
         echo "<center><img src='".$output["image"]."' width=100% /></center>";
         echo $output["content"];
    }
    else
     echo "Not Found";
    
?>
</blockquote>
</body></html>