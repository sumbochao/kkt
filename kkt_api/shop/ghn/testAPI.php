<?php
header('Content-type: text/html; charset=utf-8');            
               $fromDistrictCode  = "0201";
               $toDistrictCode = "0202";
               $url = "http://kenhkiemtien.com/kkt_api/shop/ghn/GiaoHangNhanhAPI.php";
               echo $url;echo 1;
?>
<a href="<?=$url?>?action=GetServiceList&fromDistrictCode=<?=$fromDistrictCode?>
&toDistrictCode=<?=$toDistrictCode?>" target="_blank">Danh sach service</a> <br/>
<a href="https://ontime.ghn.vn/Location" target="_blank">Location Code</a>                      <br/>
Lấy danh sach service<br>     
   <form action="<?php echo $url?>?action=GetServiceList" method="post"  ><br>
FromDistrictCode: <input type="text" name="fromDistrictCode">  <br>  
ToDistrictCode:<input type="text" name="toDistrictCode">   <br>  
<input type="submit" value="Service"/>                  <br>  
</form>
Tính Giá Vận Chuyển<br>
<form action="<?php echo $url?>?action=CalculateServiceFees" method="post"  ><br>
FromDistrictCode: <input type="text" name="fromDistrictCode">  <br>  
ToDistrictCode:<input type="text" name="toDistrictCode">   <br>  
serviceID<input type="text" name="serviceID" value=""/>  <br>  
product_ids<input type="text" name="product_ids" value=""/>    <br>  
<input type="submit" value="Calculate"/>                  <br>  
</form>