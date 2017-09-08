<?php
    $src = $_GET["src"];
    $w = isset($_GET["w"]) ? intval($_GET["w"]) : 0;
    $h = isset($_GET["h"]) ? intval($_GET["h"]) : 0;
    make_thumb($src, $w, $h);
    function make_thumb($src, $desired_width, $desired_height)
    {

        /* read the source image */
        $source_image = imagecreatefromjpeg($src);
        $width = imagesx($source_image);
        $height = imagesy($source_image);

        /* find the "desired height" of this thumbnail, relative to the desired width  */
        if($width >= $height){
            $desired_height = floor($height * ($desired_width / $width));
        } else {
            $desired_width = floor($width * ($desired_height / $height));
        }            

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        /* copy source image at a resized size */
        imagecopyresized($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        /* create the physical thumbnail image to its destination */
        
        header('Content-type: image/jpeg');
        
        imagejpeg($virtual_image);
    }  
?>
