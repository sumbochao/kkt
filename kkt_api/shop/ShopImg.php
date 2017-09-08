<?php
  include 'ImageResize.php';
  use \Eventviva\ImageResize;

  $image = new ImageResize('http://traodoidi.vn/upload/shop/product/2016/0603/1464963521434-285.png');
 
                             $image ->scale(50)   
    ->save('image2.jpg')

    ->resizeToWidth(300)
    ->save('image3.jpg')

    ->crop(100, 100)
    ->save('image4.jpg');
    
    $image->resize(800, 600);
    $image->save('image5.png', IMAGETYPE_PNG);
    
    $image->resizeToBestFit(500, 300);
    $image->save('image6.jpg');   
    
    $image->scale(50);
$image->interlace = 1;
$image->save('image7.jpg'); 


$image->resizeToHeight(900);
$image->save('image8.jpg');

?>
